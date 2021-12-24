<?php

namespace App\Events\Restaurant\Auth;

use App\Models\Restaurant;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RestaurantPasswordChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $restaurant;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }
}
