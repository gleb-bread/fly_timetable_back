<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserValidationService;
use App\Services\ResponseService;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
