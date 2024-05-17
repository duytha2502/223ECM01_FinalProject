<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubOrder extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany(Product::class, 'sub_order_items', 'sub_order_id', 'product_id')->withPivot('quantity', 'price');
    }
    public function order()
    {

        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // /**
    //  * Get all of the comments for the SubOrder
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function subOrderItems(): HasMany
    // {
    //     return $this->hasMany(SubOrderItem::class, 'sub_order_id', 'id');
    // }
}
