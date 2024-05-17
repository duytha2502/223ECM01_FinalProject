<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubOrderItem extends Model
{
    // protected $table = 'sub_order_items';
    // /**
    //  * Get the user that owns the SubOrderItem
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function product(): BelongsTo
    // {
    //     return $this->belongsTo(Product::class, 'product_id', 'id');
    // }
}
