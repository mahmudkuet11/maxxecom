<?php

namespace App\Models;

use App\Enum\Ebay\Scope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'site_id',
        'auth_token',
        'oauth_token',
        'is_syncing'
    ];

    public function getNeedToSyncAttribute(){
        if(!$this->orderSynchronization) return true;
        $last_synced_at = Carbon::parse($this->orderSynchronization->last_synced_at);
        $now = Carbon::now();
        if($last_synced_at->diffInMinutes($now) > config('order.min_sync_after')){
            return true;
        }
        return false;
    }

    public function orderSynchronization(){
        return $this->hasOne(Synchronization::class)->where('scope', Scope::ORDER);
    }

}
