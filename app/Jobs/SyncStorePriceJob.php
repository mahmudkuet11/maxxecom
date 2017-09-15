<?php

namespace App\Jobs;

use App\Service\Store\PriceService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\Console\Output\ConsoleOutput;

class SyncStorePriceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 2;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        try {
            $priceService = new PriceService();
            $priceService->save();
            return true;
        } catch (\Exception $e) {
            $console = new ConsoleOutput();
            $console->writeln($e->getMessage());
            $console->writeln($e->getFile());
            $console->writeln($e->getLine());
        }


    }
}
