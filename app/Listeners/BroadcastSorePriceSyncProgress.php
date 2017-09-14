<?php

namespace App\Listeners;


use App\Event\StoreSyncProgress;
use Symfony\Component\Console\Output\ConsoleOutput;

class BroadcastSorePriceSyncProgress
{
    function __construct()
    {

    }

    public function handle(StoreSyncProgress $event){
        $storeName = $event->storeName;
        $totalRows = $event->totalRows;
        $completedRows  = $event->completedRows;

        $console = new ConsoleOutput();
        $console->writeln('Store name: ' . $storeName . ' completed: ' . ($completedRows/$totalRows)*100 . '%');

    }
}