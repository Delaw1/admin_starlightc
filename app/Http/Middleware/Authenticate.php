<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         return $request;
    //         // return route('login');
    //     }

        
    // }

    public function handle($request, Closure $next)
    {
        if(Auth::guest()) {
            return redirect('/login');
        } else {
            if(Auth::User()->role != 'user') {
                return redirect("/admin");
            }
        }
        return $next($request); 
    }
}
