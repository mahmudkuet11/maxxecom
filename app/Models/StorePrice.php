<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorePrice extends Model
{
    protected $fillable = [
        'store',
        'sku',
        'price',
        'shipping_cost',
        'handling_cost',
    ];
}
