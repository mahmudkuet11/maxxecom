<?php

namespace App\Jobs;

use App\Models\Store;
use App\Service\Store\StoreService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\Console\Output\ConsoleOutput;

class SetupStoreJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $store;
    public $tries = 2;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function handle(StoreService $service)
    {
        $this->store->update(['is_syncing'=>true]);
        try{
            $service->setUp($this->store);
        }catch (\Exception $e){
            $console = new ConsoleOutput();
            $console->writeln($e->getMessage());
            throw $e;
        }finally{
            $this->store->update(['is_syncing'=>false]);
        }
    }
}
