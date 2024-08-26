<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\ServiceProvider;

class LogSuccessfulLogout extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
    public function handle(Logout $event)
    {
        $user = $event->user;

        if ($user instanceof User) {
            Cache::forget('user-is-online-' . $user->id);
            $user->update(['last_seen' => now()]);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
