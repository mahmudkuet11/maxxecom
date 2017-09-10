<?php

namespace App\Models\Order;

use App\Enum\InternalOrderStatus;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $fillable = [
        'transaction_id',
        'sku',
        'status'
    ];

    public static function parseSkus($sku_string){
        $skus = explode("-", $sku_string);
        array_splice($skus, count($skus)-1, 1);
        return $skus;
    }

    public static function updateSkuStatus(Order $order, Sku $sku){
        if($sku->status == InternalOrderStatus::AWAITING_PAYMENT){
            if($order->paid_time){
                $sku->update(['status'=>InternalOrderStatus::AWAITING_SHIPMENT]);
            }
        }
        if($sku->status == InternalOrderStatus::PRINT_LABEL){
            //@Todo Check tracking number and change status to paid and shipped
        }
    }

    public static function parseInitilaStatus(Order $order){
        if($order->paid_time == null) return InternalOrderStatus::AWAITING_PAYMENT;
        return InternalOrderStatus::AWAITING_SHIPMENT;
    }

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }

    public function invoice(){
        return $this->hasOne(Invoice::class);
    }
}
