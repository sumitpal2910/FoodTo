<?php

namespace App\Listeners\Restaurant\Auth;

use App\Jobs\ThrottledMail;
use App\Mail\Restaurant\Auth\ResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendResetPasswordLink
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        ThrottledMail::dispatch(new ResetPassword($event->restaurant, $event->token), $event->restaurant)->onQueue('high');
    }
}
