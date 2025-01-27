<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
    //  * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    //  */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next, $userType)
    {
        if (auth()->user()->type == $userType) {
            return $next($request);
        }
        // if (1) {
        //     return $next($request);
        // }

        abort(401);
        /* return response()->view('errors.check-permission'); */
    }
}
