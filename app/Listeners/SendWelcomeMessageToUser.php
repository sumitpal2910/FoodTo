<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\SendWelcomeMessageToUser as JobSendWelcomeMessageToUser;
use App\Jobs\ThrottledMail;
use App\Mail\EmailVerification;
use App\Models\User;

class SendWelcomeMessageToUser
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        # using job
        JobSendWelcomeMessageToUser::dispatch($event->user)->onQueue('low');

        # using redis rete limit
        ThrottledMail::dispatch(new EmailVerification($event->user), $event->user)->onQueue('high');
    }
}
