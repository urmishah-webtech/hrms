<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class IsAdmin
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
        
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 ||  Auth::user()->role_id == 6  || Auth::user()->role_id == 5){
            return $next($request);
        }
		 return redirect('employee-dashboard')->with('error',"You don't have admin access.");
    }
}
