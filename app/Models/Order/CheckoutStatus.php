<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class CheckoutStatus extends Model
{
    protected $table = 'checkout_status';

    protected $fillable = [
        'order_id',
        'ebay_payment_status',
        'status',
    ];
}
