<?php

namespace App\Http\Middleware;

use Closure;

class IfAdmin
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
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 5){
            return $next($request);
        }
		 return redirect('employee-dashboard')->with('error',"You don't have admin access.");
    }
}
