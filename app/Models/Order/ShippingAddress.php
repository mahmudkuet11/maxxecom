<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = [
        'order_id',
        'name',
        'street1',
        'street2',
        'city_name',
        'state_or_province',
        'country',
        'country_name',
        'phone',
        'postal_code',
        'address_id',
        'shipping_service_selected',
        'shipping_service_cost',
    ];
}
