<?php

namespace App\Listeners\Admin\Auth;

use App\Jobs\ThrottledMail;
use App\Mail\Admin\Auth\ResetPassword;
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
        ThrottledMail::dispatch(new ResetPassword($event->admin, $event->token), $event->admin)
            ->onQueue('high');
    }
}
