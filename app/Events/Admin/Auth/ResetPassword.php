<?php

namespace App\Events\Admin\Auth;

use App\Models\Admin;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResetPassword
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $admin;
    public $token;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Admin $admin, $token)
    {
        $this->admin = $admin;
        $this->token = $token;
    }
}
