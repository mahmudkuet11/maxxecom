<?php

namespace App\Jobs;

use App\Models\Store;
use App\Service\Console;
use App\Service\Store\ItemService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use DB;

class SyncStoreListing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $store;
    public $tries = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function handle()
    {
        \Redis::publish('sync:listing', json_encode([
            'store_id'    =>  $this->store->id,
            'msg'   =>  'Store listing has been started.'
        ]));
        $itemService = new ItemService();
        try {
            $itemService->syncListings($this->store);
        } catch (\Exception $e) {
            Console::writeln($e->getMessage());
            throw $e;
        }finally{
            \Cache::forget('sync:listing:' . $this->store->id);
        }
    }
}
