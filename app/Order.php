<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{

    protected $guarded = [];

    /**
     * Get all of the comments for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function items()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')->withPivot('quantity', 'price');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getShippingFullAddressAttribute()
    {

        return  $this->shipping_fullname."<br>".$this->shipping_address . ', ' . $this->shipping_city . ', ' . $this->shipping_state . ', ' . $this->shipping_zipcode . "<br> phone: " . $this->shipping_phone;
    }

    public function subOrders()
    {
        return $this->hasMany(SubOrder::class);
    }

    public function subOrder()
    {

        return $this->belongsTo(SubOrder::class);
    }

    public function generateSubOrders()
    {
        $orderItems = $this->items;

        foreach($orderItems->groupBy('shop_id') as $shopId => $products) {

            $shop = Shop::find($shopId);

            $suborder = $this->subOrders()->create([
                'order_id'=> $this->id,
                'seller_id'=> $shop->user_id ?? 1,
                'grand_total'=> $products->sum('pivot.price'),
                'item_count'=> $products->count(),
            ]);

            foreach($products as $product) {
                $suborder->items()->attach($product->id, ['price' => $product->pivot->price, 'quantity' => $product->pivot->quantity]);
            }

        }

    }

    public function markDeclined()
    {

        $this->status = 'decline';
        $this->save();

        $this->subOrders()->update(['status'=>'decline']);
    }
}
