<?php

namespace App\Mail\Rider\Auth;

use App\Models\Rider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $rider;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Rider $rider, $token)
    {
        $this->rider = $rider;
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
            ->markdown('emails.rider.auth.reset-password');
    }
}
