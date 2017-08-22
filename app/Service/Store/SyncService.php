<?php

namespace App\Service\Store;

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
}