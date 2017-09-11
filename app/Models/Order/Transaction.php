<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'order_id',
        'sales_record_no',
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
        'shipment_tracking_details',
    ];

    public function getSubTotalAttribute(){
        return $this->quantity * $this->transaction_price;
    }

    public function getBuyerNameAttribute(){
        return $this->buyer_user_first_name . ' ' . $this->buyer_user_last_name;
    }

    public function skus(){
        return $this->hasMany(Sku::class);
    }
}
