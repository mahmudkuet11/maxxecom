<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'order_id',
        'buyer_email',
        'buyer_user_first_name',
        'buyer_user_last_name',
        'transaction_created_at',
        'item_id',
        'site',
        'item_title',
        'sku',
        'condition',
        'quantity',
        'ebay_transaction_id',
        'transaction_price',
        'order_line_item_id',
    ];
}
