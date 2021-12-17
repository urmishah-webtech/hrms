<?php

namespace App\Http\Middleware;

use Closure;

class AlreadyLoggedIn
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
        if(Session()->has('loginId') && (url('login')==$request->url() || (url('register')==$request->url())))
		{
			return back();
		}
        return $next($request);
    }
}
