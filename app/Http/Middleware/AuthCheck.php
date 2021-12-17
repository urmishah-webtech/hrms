<?php

namespace App\Http\Middleware;

use Closure;
 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
//use Redirect;
class AuthCheck
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
			if (Auth::user()->role_type == "admin")
			{	 
				return $next($request);		 
			}
			else 
			{	  
				return $next($request);		 				 
			}
		}
		else{
		  return response()->view('auth.login');
		}	
		return $next($request);
    }
}
