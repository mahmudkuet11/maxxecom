<?php

namespace App\Jobs;

use App\Models\Store;
use App\Service\Order\OrderService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SyncOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public function __construct()
    {
        //
    }

    public function handle(OrderService $service)
    {
        $stores = Store::all();
        foreach ($stores as $store){
            $service->fetchUnSynced($store->id);
        }
    }
}
