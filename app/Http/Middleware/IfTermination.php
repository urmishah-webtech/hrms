<?php

namespace App\Http\Middleware;

use Closure;
use App\Termination;


class IfTermination
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
		$termination = Termination::where('employee_id',Auth::user()->id)->pluck('employee_id')->first();
		 
		if($termination == Auth::user()->id)
		{	 
			return back()->with('error',"You have been Terminated");
		}
		else
		{ 
			return $next($request);
		}
		 
    }
}
