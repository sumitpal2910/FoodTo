<?php

namespace App\Events\Rider\Auth;

use App\Models\Rider;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RiderPasswordChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $rider;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Rider $rider)
    {
        $this->rider = $rider;
    }
}
