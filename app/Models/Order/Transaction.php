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

    public function getHasMoreThanOneSKUAttribute(){
        return preg_match("/[a-zA-Z0-9]+(-[a-zA-Z0-9]+)+-[A-Za-z]+/", $this->sku);
    }

    public function getSKUsAttribute(){
        $skus = explode("-", $this->sku);
        array_splice($skus, count($skus)-1, 1);
        return $skus;
    }

    public function getFormattedSKUAttribute(){
        if($this->hasMoreThanOneKSU){
            return $this->SKUs;
        }else{
            if($this->sku == '') return '';
            else {
                return explode('-', $this->sku)[0];
            }
        }
    }

    public function getHasSKUAttribute(){
        return $this->sku != '';
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
