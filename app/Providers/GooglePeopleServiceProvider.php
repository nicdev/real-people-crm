<?php

namespace App\Providers;

use App\Services\GooglePeopleService;
use Illuminate\Support\ServiceProvider;

class GooglePeopleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(GooglePeopleService::class, function () {
            return new GooglePeopleService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
