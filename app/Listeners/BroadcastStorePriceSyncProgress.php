<?php

namespace App\Listeners;

use App\Event\StorePriceSyncProgress;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Console\Output\ConsoleOutput;

class BroadcastStorePriceSyncProgress
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StorePriceSyncProgress  $event
     * @return void
     */
    public function handle(StorePriceSyncProgress $event)
    {
        $storeName = $event->storeName;
        $completedRows  = $event->completedRows;

        $console = new ConsoleOutput();
        $console->writeln("Store Name: {$storeName} , Completed {$completedRows} rows");
    }
}
