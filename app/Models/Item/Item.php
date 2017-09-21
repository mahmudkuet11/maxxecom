<?php

namespace App\Models\Item;

use App\Enum\ListingType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'store_id',
        'buy_it_now_price',
        'item_id',
        'start_time',
        'view_item_url',
        'view_item_url_for_natural_search',
        'is_global_shipping',
        'listing_duration',
        'listing_type',
        'quantity',
        'current_price',
        'is_global_shipping',
        'shipping_service_cost',
        'shipping_type',
        'end_time',
        'title',
        'sku',
        'gallery_url',
        'listing_status',
    ];

    public function getTimeLeftAttribute(){
        $startTime = Carbon::parse($this->start_time);
        $endTime = Carbon::parse($this->end_time);
        $diff = $endTime->diffForHumans($startTime);
        return $diff;
    }

    public function scopeFilterByUser($builder){
        $stores = \Auth::user()->user_stores->pluck('store_id')->toArray();
        return $builder->whereIn('store_id', $stores);
    }

    public function scopeActive($builder){
        return $builder->where('listing_status', ListingType::search(ListingType::ACTIVE));
    }
}
