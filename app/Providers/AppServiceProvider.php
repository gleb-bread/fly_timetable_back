<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserValidationService;
use App\Services\ResponseService;
use App\Services\UserPermissionsService;
use App\Services\ErrorService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserValidationService::class, function ($app) {
            return new UserValidationService();
        });

        $this->app->singleton(ResponseService::class, function ($app) {
            return new ResponseService();
        });

        $this->app->singleton(UserPermissionsService::class, function ($app) {
            return new UserPermissionsService();
        });

        $this->app->singleton(ErrorService::class, function ($app) {
            return new ErrorService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
