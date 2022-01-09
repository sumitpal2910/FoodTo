<?php

namespace App\Providers;

use App\Models\RestaurantManager;
use App\Models\RestaurantOwner;
use App\Policies\RestaurantOwnerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        RestaurantOwner::class => RestaurantOwnerPolicy::class,
        "App\Models\RestaurantManager" => "App\Policies\RestaurantManagerPolicy",
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
