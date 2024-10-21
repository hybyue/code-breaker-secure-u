<?php

use App\Http\Middleware\UserActivity;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use \Inspector\Laravel\Middleware\WebRequestMonitoring;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up'
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([

            'user-access' => \App\Http\Middleware\UserAccess::class,
            'user-activity' => \App\Http\Middleware\UserActivity::class,
        ]);

        $middleware->appendToGroup('web', UserActivity::class);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
