<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'store_id',
        'buy_it_now_price',
        'item_id',
        'start_time',
        'view_item_url',
        'view_item_url_for_natural_search',
        'is_global_shipping',
        'listing_duration',
        'listing_type',
        'quantity',
        'current_price',
        'is_global_shipping',
        'shipping_service_cost',
        'shipping_type',
        'end_time',
        'title',
        'sku',
        'gallery_url',
        'listing_status',
    ];
}
