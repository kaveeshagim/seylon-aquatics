<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\TestOrder;

class OrderStatusChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct($pendingOrders, $inProgressOrders, $shippedOrders, $completedOrders)
    {
        $this->pendingOrders = $pendingOrders;
        $this->inProgressOrders = $inProgressOrders;
        $this->shippedOrders = $shippedOrders;
        $this->completedOrders = $completedOrders;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new Channel('orders');
    }

        public function broadcastAs()
    {
        return 'OrderStatusChanged';
    }

}
