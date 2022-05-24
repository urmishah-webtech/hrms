<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class EditEmployeePermission
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
        if(Auth::check()){		   
			if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 6  || Auth::user()->role_id == 5)
			{	 
				return $next($request);	 
			}
			else 
			{	  
				return redirect("home");		 				 
			}
		}
		else{
		  return response()->view('auth.login');
		}	
		return $next($request);
    }
}
