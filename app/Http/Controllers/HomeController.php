<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Resignation;
use App\Promotion;
use App\Appraisal;
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
        $emp = Employee::where('role_id','3')->orderBy('id', 'DESC')->limit(3)->get();
        $res = Resignation::orderBy('id', 'DESC')->limit(3)->get();
        $promotion = Promotion::orderBy('id', 'DESC')->limit(5)->get();
        $appraisal = Appraisal::orderBy('id', 'DESC')->limit(5)->get();
        return view('index',compact('emp_total','per_status_complete','per_status_incomp','man_total', 'emp', 'res', 'promotion', 'appraisal'));
    }

    public function editPromotion(){
        $id = $_GET['proid'];
        $data = Promotion::find($id);
        $employee = ($data->employee)->first_name.' '.($data->employee)->last_name;
        $currentdesignation = Designation::find($data->promotionform);
        $designationforpromotion = Designation::where('department_id', $data->department)->get()->except($data->promotionform);
        return response(['status' => 1, 'currentdesignation' => $currentdesignation, 'designationforpromotion' => $designationforpromotion, 'employee' => $employee, 'data' => $data]);
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
