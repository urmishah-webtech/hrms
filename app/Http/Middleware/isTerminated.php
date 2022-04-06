<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use App\Termination;
class isTerminated
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
	   
        if (Termination::where('employee_id',auth()->user()->id)->exists())
        {	 
            Auth::logout();
            return redirect()->route('login')->with('error',"No More Access, You Are Terminated ");
        }
		return $next($request);		 
    }
}
