<?php

namespace App\Providers;

use App\View\Components\ContentHeader;
use App\View\Components\AuthError;
use App\View\Components\AuthStatus;
use App\View\Components\Badge;
use App\View\Components\Error;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        # Auth Error
        Blade::component(AuthError::class, 'auth-error');

        # Auth Status
        Blade::component(AuthStatus::class, 'auth-status');

        # Validation error
        Blade::component(Error::class, 'error');

        # content header
        Blade::component(ContentHeader::class, 'content-header');

        # bagde
        Blade::component(Badge::class, 'badge');
    }
}
