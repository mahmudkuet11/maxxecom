<?php

namespace App\Models\Order;

use App\Enum\InternalOrderStatus;
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

    public function getInvoicesAttribute(){
        $invoices = collect([]);
        $this->transactions->each(function($transaction) use ($invoices){
            $transaction->skus->each(function($sku) use ($invoices){
                if($sku->invoice){
                    $invoices->push($sku->invoice);
                }
            });
        });
        return $invoices;
    }

    public function getSkusAttribute(){
        $skus = collect([]);
        $this->transactions->each(function($transaction) use ($skus){
            $transaction->skus->each(function($sku) use ($skus){
                $skus->push($sku);
            });
        });
        return $skus;
    }

    public function scopeFilterByUser($builder){
        $stores = \Auth::user()->user_stores->pluck('store_id')->toArray();
        return $builder->whereIn('store_id', $stores);
    }

    public function scopeAwaitingPayment($builder){
        return $builder->whereHas('transactions.skus', function($query){
            $query->where('status', InternalOrderStatus::AWAITING_PAYMENT);
        });
    }

    public function scopeAwaitingShipment($builder){
        return $builder->whereHas('transactions.skus', function($query){
            $query->where('status', InternalOrderStatus::AWAITING_SHIPMENT);
        });
    }

    public function scopeAwaitingOrder($builder){
        return $builder->whereHas('transactions', function($query){
            $query->where('status', 'awaiting_order');
        });
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
}
