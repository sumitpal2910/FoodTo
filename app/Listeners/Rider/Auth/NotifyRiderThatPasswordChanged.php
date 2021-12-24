<?php

namespace App\Listeners\Rider\Auth;

use App\Jobs\ThrottledMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Rider\Auth\NotifyPasswordChanged;

class NotifyRiderThatPasswordChanged
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        ThrottledMail::dispatch(new NotifyPasswordChanged($event->rider), $event->rider);
    }
}
