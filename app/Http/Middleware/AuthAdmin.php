<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) 
    {
        if(Auth::check()) {
            if(Auth::User()->role == 'user') {
                return redirect("/");
            }
        }
        return $next($request);
    }
}
