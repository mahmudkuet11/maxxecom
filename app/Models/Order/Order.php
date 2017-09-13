<?php

namespace App\Models\Order;

use App\Enum\Acl\Permission;
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

    public function scopeFilterStoreByUser($builder){
        $stores = \Auth::user()->user_stores->pluck('store_id')->toArray();
        return $builder->whereIn('store_id', $stores);
    }

    public function scopeAwaitingPayment($builder){
        $storeIds = auth()->user()->permissions
            ->where('permission', Permission::search(Permission::VIEW_AWAITING_PAYMENT))
            ->pluck('store_id')->all();
        return $builder->whereHas('transactions.skus', function($query){
            $query->where('status', InternalOrderStatus::AWAITING_PAYMENT);
        })->whereIn('store_id', $storeIds);
    }

    public function scopeAwaitingShipment($builder){
        $storeIds = auth()->user()->permissions
            ->where('permission', Permission::search(Permission::VIEW_AWAITING_SHIPMENT))
            ->pluck('store_id')->all();
        return $builder->whereHas('transactions.skus', function($query){
            $query->where('status', InternalOrderStatus::AWAITING_SHIPMENT);
        })->whereIn('store_id', $storeIds);
    }

    public function scopeAwaitingOrder($builder){
        $storeIds = auth()->user()->permissions
            ->where('permission', Permission::search(Permission::VIEW_AWAITING_ORDER))
            ->pluck('store_id')->all();
        return $builder->whereHas('transactions.skus', function($query){
            $query->where('status', InternalOrderStatus::AWAITING_ORDER);
        })->whereIn('store_id', $storeIds);
    }

    public function scopePrintLabel($builder){
        $storeIds = auth()->user()->permissions
            ->where('permission', Permission::search(Permission::VIEW_PRINT_LABEL))
            ->pluck('store_id')->all();
        return $builder->whereHas('transactions.skus', function($query){
            $query->where('status', InternalOrderStatus::PRINT_LABEL);
        })->whereIn('store_id', $storeIds);
    }

    public function scopeAwaitingTracking($builder){
        $storeIds = auth()->user()->permissions
            ->where('permission', Permission::search(Permission::VIEW_AWAITING_TRACKING))
            ->pluck('store_id')->all();
        return $builder->whereHas('transactions.skus', function($query){
            $query->where('status', InternalOrderStatus::AWAITING_TRACKING);
        })->whereIn('store_id', $storeIds);
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
