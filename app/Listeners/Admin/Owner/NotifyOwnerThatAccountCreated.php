<?php

namespace App\Listeners\Admin\Owner;

use App\Jobs\ThrottledMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\Owner\Notification\ListingSuccessfull;

class NotifyOwnerThatAccountCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //ThrottledMail::dispatch(new ListingSuccessfull(($event->restaurant), $event->restaurant))
    }
}
