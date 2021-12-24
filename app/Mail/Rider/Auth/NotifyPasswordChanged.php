<?php

namespace App\Mail\Rider\Auth;

use App\Models\Rider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyPasswordChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $rider;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Rider $rider)
    {
        $this->rider = $rider;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notify Password changed')
            ->markdown('emails.rider.auth.notify-password-changed');
    }
}
