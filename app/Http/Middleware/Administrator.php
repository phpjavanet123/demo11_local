<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Administrator
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
		if (Auth::check() && Auth::user()->role_id == 1) {
			return $next($request);
		}
		else {
		    //It is USER so redirect to his home page - where he has button "Logout" if I redirect to "/" - no logout button
			return redirect('/home');
		}
    }
}
