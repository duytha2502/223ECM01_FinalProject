<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coupon extends Model
{
    protected $table = 'coupons';

    /**
     * The roles that belong to the Coupon
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function coupons(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_id', 'id', 'value');
    }
    
}
