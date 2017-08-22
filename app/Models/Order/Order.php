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
        'created_time',
        'payment_method',
        'sub_total',
        'total',
        'buyer_user_id',
        'paid_time',
        'shipped_time',
        'payment_hold_status',
        'extended_order_id',
    ];

    public function checkoutStatus(){
        return $this->hasOne(CheckoutStatus::class);
    }

    public function shippingAddress(){
        return $this->hasOne(ShippingAddress::class);
    }
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
