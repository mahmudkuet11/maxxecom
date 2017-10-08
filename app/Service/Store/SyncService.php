<?php

namespace App\Service\Store;

use App\Enum\Ebay\Scope;
use App\Models\Store;
use App\Models\Synchronization;
use Carbon\Carbon;

class SyncService
{
    public function setLastSyncTime(Store $store, Carbon $syncTime, $scope){
        Synchronization::updateOrCreate([
            'store_id'  =>  $store->id,
            'scope' =>  $scope
        ], [
            'last_synced_at'    =>  $syncTime
        ]);
    }

    public function getLastSyncedTime(Store $store){
        $sync = Synchronization::where('store_id', $store->id)
            ->where('scope', Scope::ORDER)
            ->first();
        if($sync){
            return Carbon::parse($sync->last_synced_at);
        }
        return Carbon::now()->subDays(7);
    }

}