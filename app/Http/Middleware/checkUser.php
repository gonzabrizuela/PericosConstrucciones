<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkUser {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        
        if (Auth::user()->type == 1) { 
            
            return redirect('/home');
        }
        if((Auth::user()->type != 1) && (Auth::user()->type != 2))
        {
            return redirect()->route('loguser.index');
        }

        return $next($request);
    }

}
