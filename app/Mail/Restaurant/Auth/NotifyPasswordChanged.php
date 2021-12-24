<?php

namespace App\Mail\Restaurant\Auth;

use App\Models\Restaurant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyPasswordChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $restaurant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notify Password Changed')
            ->markdown('emails.restaurant.auth.notify-password-changed');
    }
}
