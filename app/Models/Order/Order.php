<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'store_id',
        'ebay_order_id',
        'order_status',
        'adjustment_amount',
        'amount_paid',
        'amount_saved',
        'order_created_at',
        'payment_method',
        'sub_total',
        'total',
        'buyer_user_id',
        'paid_time',
        'shipped_time',
        'payment_hold_status',
        'extended_order_id',
    ];
}
