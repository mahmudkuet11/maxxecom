<?php

namespace App\Event;

use App\Models\Store;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StoreSyncProgress
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orders;
    public $store;

    public function __construct($orders, Store $store)
    {
        $this->orders = $orders;
        $this->store = $store;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
