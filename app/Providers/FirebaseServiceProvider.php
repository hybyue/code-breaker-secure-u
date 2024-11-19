<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Database::class, function ($app) {
            $factory = (new Factory)
                ->withServiceAccount(storage_path(env('FIREBASE_CREDENTIALS')))
                ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));

            return $factory->createDatabase();
        });
    }

    public function boot(): void
    {
        //
    }
}