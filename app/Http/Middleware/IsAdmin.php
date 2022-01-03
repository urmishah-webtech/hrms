<?php

namespace App\Http\Middleware;

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
        
        if(auth()->user()->role_type == "admin" || auth()->user()->role_type == "manager"){
            return $next($request);
        }
		 return redirect('employee-dashboard')->with('error',"You don't have admin access.");
    }
}
