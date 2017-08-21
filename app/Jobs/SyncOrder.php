<?php

namespace App\Jobs;

use App\Models\Store;
use App\Service\Order\OrderService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\Console\Output\ConsoleOutput;

class SyncOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $store;
    public $tries = 3;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function handle(OrderService $service)
    {
        $this->store->update(['is_syncing'=>true]);
        try{
            (new ConsoleOutput())->writeln("<info>fetch unsynced ". $this->store->id ."</info>");
            $service->fetchUnSynced($this->store->id);
        }catch (\Exception $e){
            throw $e;
        }finally{
            $this->store->update(['is_syncing'=>false]);
        }
    }
}
