<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('index');
    }
	public function HomepageUrl()
    {
        if (Auth::user()->role_type == "admin" || Auth::user()->role_type == "manager")
		{	 
			 return view('index');
		}
		else 
		{	  
			return view('employee-dashboard');	 				 
		}		 
    }
}
