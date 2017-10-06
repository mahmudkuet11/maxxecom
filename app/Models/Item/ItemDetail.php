<?php

namespace App\Models\Item;

use App\Enum\Ebay\ItemCondition;
use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    protected $fillable = [
        'item_id',
        'auto_pay',
        'country',
        'currency',
        'description',
        'ebay_item_id',
        'start_time',
        'end_time',
        'listing_type',
        'location',
        'payment_method',
        'paypal_email',
        'primary_category_id',
        'primary_category_name',
        'secondary_category_id',
        'upc',
        'brand',
        'quantity',
        'shipping_package',
        'weight_major',
        'weight_minor',
        'package_length',
        'package_width',
        'package_depth',
        'sales_tax_percent',
        'sales_tax_state',
        'is_shipping_included_in_tax',
        'use_ebay_tax_table',
        'shipping_type',
        'ship_to_location',
        'exclude_ship_to_location',
        'site',
        'store_category_id',
        'store_category2_id',
        'uuid',
        'postal_code',
        'gallery_url',
        'dispatch_time_max',
        'refund_option',
        'returns_within_option',
        'returns_accepted_option',
        'return_policy_description',
        'return_shipping_cost_paid_by',
        'return_restocking_fee',
        'condition_id',
        'hide_from_search',
        'out_of_stock_control',
    ];

    public function getConditionNameAttribute(){
        return ItemCondition::getNameByID($this->condition_id);
    }


}
