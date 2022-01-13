<?php

namespace App\Providers;

use App\Models\Food;
use App\Models\FoodTiming;
use App\Models\Topping;
use App\Models\RestaurantManager;
use App\Models\RestaurantOwner;
use App\Policies\FoodPolicy;
use App\Policies\FoodTimingPolicy;
use App\Policies\RestaurantManagerPolicy;
use App\Policies\ToppingPolicy;
use App\Policies\RestaurantOwnerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Food::class => FoodPolicy::class,
        Topping::class => ToppingPolicy::class,
        FoodTiming::class => FoodTimingPolicy::class,
        RestaurantOwner::class => RestaurantOwnerPolicy::class,
        RestaurantManager::class => RestaurantManagerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Gate::define('update-owner', [RestaurantOwnerPolicy::class, 'update']);
    }
}
