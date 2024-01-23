<?php

namespace App\Providers;

use App\Services\GooglePeopleService as GooglePeopleServiceInstance;
use Illuminate\Support\ServiceProvider;

class GooglePeopleService extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('GooglePeopleService', function () {
            return new GooglePeopleServiceInstance();
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
