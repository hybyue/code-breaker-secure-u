<?php

namespace App\Providers;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Http\View\Composers\AdminComposer;
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
        View::composer('admin.layouts.admin', AdminComposer::class);
    }
}
