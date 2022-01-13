<?php

namespace App\Providers;

//Restaurant
use App\Events\Restaurant\Auth\ResetPassword as RestaurantResetPassword;
use App\Events\Restaurant\Auth\RestaurantPasswordChanged;

use App\Listeners\Restaurant\Auth\SendResetPasswordLink as RestaurantSendResetPasswordLink;
use App\Listeners\Restaurant\Auth\NotifyRestaurantThatPasswordChanged;

// Rider
use App\Events\Rider\Auth\RiderPasswordChanged;
use App\Events\Rider\Auth\RiderResetPassword;

use App\Listeners\Rider\Auth\SendPasswordResetLinkToRider;
use App\Listeners\Rider\Auth\NotifyRiderThatPasswordChanged;


use App\Events\UserRegistered;
use App\Listeners\SendWelcomeMessageToUser;
use App\Models\District;
use App\Models\Food;
use App\Models\State;
use App\Observers\DistrictObserver;
use App\Observers\FoodObserver;
use App\Observers\StateObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserRegistered::class => [
            SendWelcomeMessageToUser::class,
        ],

        /**
         * ADMIN
         */

        // Authencation related events
        AdminResetPassword::class => [
            # send a password reset link to admin
            AdminSendResetPasswordLink::class
        ],
        AdminPasswordChanged::class => [
            # send a notification mail to admin after password reset
            NotifyAdminThatPasswordChanged::class
        ],

        /**
         * OWNER
         */
        // Authencation
        RestaurantResetPassword::class => [
            # send a password reset link toRestaurant
            RestaurantSendResetPasswordLink::class
        ],
        RestaurantPasswordChanged::class => [
            # send a notification email to Restaurant that password has changed
            NotifyRestaurantThatPasswordChanged::class
        ],

        /**
         * RIDER
         */
        // Authencation
        RiderResetPassword::class => [
            # send a password reset link to rider
            SendPasswordResetLinkToRider::class,
        ],
        RiderPasswordChanged::class => [
            # send a notification email to rider that password has changed
            NotifyRiderThatPasswordChanged::class
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        State::observe(StateObserver::class);
        District::observe(DistrictObserver::class);
        Food::observe(FoodObserver::class);
    }
}
