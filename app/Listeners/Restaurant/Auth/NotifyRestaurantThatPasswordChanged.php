<?php

namespace App\Listeners\Restaurant\Auth;

use App\Jobs\ThrottledMail;
use App\Mail\Restaurant\Auth\NotifyPasswordChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyRestaurantThatPasswordChanged implements ShouldQueue
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
        ThrottledMail::dispatch(new NotifyPasswordChanged($event->restaurant), $event->restaurant);
    }
}
