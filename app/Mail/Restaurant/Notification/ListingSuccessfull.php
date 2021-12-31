<?php

namespace App\Mail\Restaurant\Notification;

use App\Models\Restaurant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ListingSuccessfull extends Mailable
{
    use Queueable, SerializesModels;

    public $restaurant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Listing Successfull')
            ->markdown('emails.restaurant.notification.listing-successfull');
    }
}
