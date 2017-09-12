<?php

namespace App\Models\Order;

use App\Enum\InternalOrderStatus;
use App\Enum\TrackingNumberScope;
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
    }

    public static function parseInitialStatus(Order $order){
        if($order->shipped_time != null) return InternalOrderStatus::PAID_AND_SHIPPED;
        if($order->paid_time == null) return InternalOrderStatus::AWAITING_PAYMENT;
        return InternalOrderStatus::AWAITING_SHIPMENT;
    }

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }

    public function invoice(){
        return $this->hasOne(Invoice::class);
    }

    public function tracking_numbers(){
        return $this->hasMany(TrackingNumber::class, 'reference_id')->where('scope', TrackingNumberScope::SKU);
    }
}
