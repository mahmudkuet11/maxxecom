<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'sku_id',
        'store_type',
        'store_name',
        'next_state',
        'sold_price',
        'product_cost',
        'shipping_cost',
        'handling_cost',
        'fees',
        'profit',
        'order_id',
        'message',
    ];

    public function sku(){
        return $this->belongsTo(Sku::class);
    }
}
