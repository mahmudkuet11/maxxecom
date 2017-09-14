<?php

namespace App\Event;


use App\Models\Store;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StorePriceSyncProgress
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $storeName;
    public $totalRows;
    public $completedRows;

    public function __construct($storeName, $totalRows, $completedRows)
    {
        $this->storeName = $storeName;
        $this->totalRows = $totalRows;
        $this->completedRows = $completedRows;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

