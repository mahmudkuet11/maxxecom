<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;

class ShippingServiceOption extends Model
{
    protected $fillable = [
        'item_id',
        'shipping_service',
        'shipping_service_cost',
        'shipping_service_additional_cost',
        'shipping_service_priority',
        'shipping_time_min',
        'shipping_time_max',
        'free_shipping',
    ];
}
