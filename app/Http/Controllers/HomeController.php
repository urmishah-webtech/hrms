<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Resignation;
use Auth;
use Carbon\Carbon;
use DB;

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
        if(Auth::user()->role_id==3){
        $per_status_complete= Employee::where('perfomance_status','1')->where('man_id',Auth::user()->id)->get()->count(); 
        }else{
        $per_status_complete= Employee::where('perfomance_status','1')->get()->count(); 
        }
        if(Auth::user()->role_id==3){
        $per_status_incomp= Employee::where('perfomance_status','0')->where('man_id',Auth::user()->id)->get()->count();
        }
        else{
        $per_status_incomp= Employee::where('perfomance_status','0')->get()->count();
        } 
        $man_total= Employee::where('role_id','2')->get()->count(); 
        $currentyear = Carbon::now()->year;
        $lastsixyears = [$currentyear];
        for ($i=1; $i < 7; $i++) { 
            array_push($lastsixyears, $currentyear-$i);
        }
        $newemp = [];
        foreach ($lastsixyears as $key => $value) {
            $newemptemp = Employee::where( DB::raw('YEAR(joing_date)'), '=', $value )->count();
            array_push($newemp, $newemptemp);
        }
        $resignedemp = [];
        foreach ($lastsixyears as $key => $value) {
            $resemptemp = Resignation::where('status', 'Approved')->where( DB::raw('YEAR(resignationdate)'), '=', $value )->count();
            array_push($resignedemp, $resemptemp);
        }
        foreach ($lastsixyears as $key => $value) {
            $data['y'] = $value;
            $data['a'] = $newemp[$key];
            $data['b'] = $resignedemp[$key];
            $final[$key] = $data;
        }
        $linechartdata = json_encode($final);
        return view('index',compact('emp_total','per_status_complete','per_status_incomp','man_total', 'linechartdata'));
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
