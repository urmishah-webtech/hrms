<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('employee-dashboard');
    }
	public function adminHome()
    {
        $emp_total= Employee::where('role_type','employee')->get()->count(); 
        return view('index',compact('emp_total'));
    }
	public function HomepageUrl()
    {
        if (Auth::user()->role_type == "admin" || Auth::user()->role_type == "manager")
		{	
            $emp_total= Employee::where('role_type','employee')->get()->count();
			 return view('index',compact('emp_total'));
		}
		else 
		{	  
			return view('employee-dashboard');	 				 
		}		 
    }
	 
}
