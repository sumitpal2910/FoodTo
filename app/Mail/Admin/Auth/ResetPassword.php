<?php

namespace App\Mail\Admin\Auth;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Admin $admin, $token)
    {
        $this->admin =  $admin;
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
            ->markdown('emails.admin.auth.reset-password');
    }
}
