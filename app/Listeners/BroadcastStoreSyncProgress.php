<?php

namespace App\Listeners;

use App\Event\StoreSyncProgress;
use GuzzleHttp\Client;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadcastStoreSyncProgress
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
     * @param  StoreSyncProgress  $event
     * @return void
     */
    public function handle(StoreSyncProgress $event)
    {
        $orders = $event->orders;
        $store = $event->store;
        $total_pages = (int)$orders->PaginationResult->TotalNumberOfPages;
        $current_page = (int)$orders->PageNumber;
        $completed = floor(($current_page / $total_pages) * 100);
        $client = new Client();
        $client->request('GET', 'http://127.0.0.1:3000?store='. $store->id .'&completed=' . $completed);
    }
}
