<?php

namespace App\Event;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StorePriceSyncProgress
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $storeName;
    public $completedRows;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($storeName, $completedRows)
    {
        $this->storeName = $storeName;
        $this->completedRows = $completedRows;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
