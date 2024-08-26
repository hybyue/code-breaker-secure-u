<?php

namespace App\Providers;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    protected $listen = [
        Logout::class => [
            LogSuccessfulLogout::class,
        ],
    ];
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
