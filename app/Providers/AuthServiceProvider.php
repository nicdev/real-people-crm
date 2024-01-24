<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Mail\Introduction;
use App\Models\Company;
use App\Models\Contact;
use App\Models\ContactEvent;
use App\Models\User;
use App\Policies\CompanyPolicy;
use App\Policies\ContactEventPolicy;
use App\Policies\ContactPolicy;
use App\Policies\IntroductionPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Contact::class => ContactPolicy::class,
        Company::class => CompanyPolicy::class,
        ContactEvent::class => ContactEventPolicy::class,
        User::class => UserPolicy::class,
        Introduction::class => IntroductionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
