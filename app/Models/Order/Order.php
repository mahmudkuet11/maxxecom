<?php

namespace App\Models\Order;

use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'store_id',
        'ebay_order_id',
        'sales_record_no',
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
        'sales_tax_percent',
        'sales_tax_state',
        'sales_tax_amount',
        'internal_status',
    ];

    public function getSoldDateAttribute(){
        return Carbon::parse($this->created_time)->format('M-d-y');
    }

    public function getPaidDateAttribute(){
        $paid_date = $this->paid_time;
        if($paid_date){
            return Carbon::parse($paid_date)->format("M-d-y");
        }
        return '';
    }

    public function getSalesTaxStateValueAttribute(){
        return $this->sales_tax_state == '' ? 'No Sales Tax' : $this->sales_tax_state;
    }

    public function scopeAwaitingPayment($builder){
        return $builder->where('order_status', 'Active')->orWhere('order_status', 'InProcess');
    }

    public function scopeAwaitingShipment($builder){
        return $builder->where('order_status', 'Completed')->whereNotNull('paid_time');
    }

    public function checkoutStatus(){
        return $this->hasOne(CheckoutStatus::class);
    }

    public function shippingAddress(){
        return $this->hasOne(ShippingAddress::class);
    }
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
