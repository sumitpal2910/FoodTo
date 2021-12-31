<?php

namespace App\Mail\Restaurant\Auth;

use App\Models\Restaurant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $restaurant;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Restaurant $restaurant, $token)
    {
        $this->restaurant= $restaurant;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset Password')
            ->markdown('emails.restaurant.auth.reset-password');
    }
}
