<?php

namespace App\Listeners\Admin\Auth;

use App\Jobs\ThrottledMail;
use App\Mail\Admin\Auth\NotifyPasswordChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminThatPasswordChanged implements ShouldQueue
{


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        # send mail
        ThrottledMail::dispatch(new NotifyPasswordChanged($event->admin), $event->admin);
    }
}
