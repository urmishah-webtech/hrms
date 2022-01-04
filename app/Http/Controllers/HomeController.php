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
        $emp_total= Employee::where('role_id','3')->get()->count(); 
        $per_status_complete= Employee::where('perfomance_status','1')->get()->count(); 
        $per_status_incomp= Employee::where('perfomance_status','0')->get()->count(); 
        return view('index',compact('emp_total','per_status_complete','per_status_incomp'));
    }
	public function HomepageUrl()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
		{	
            $emp_total= Employee::where('role_id','3')->get()->count();
            $per_status_complete= Employee::where('perfomance_status','1')->get()->count(); 
            $per_status_incomp= Employee::where('perfomance_status','0')->get()->count();
			return view('index',compact('emp_total','per_status_complete','per_status_incomp'));
		}
		else 
		{	  
			return view('employee-dashboard');	 				 
		}		 
    }
	 
}
