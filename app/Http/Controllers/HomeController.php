<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\EmployeeLeave;
use Carbon\Carbon;
use App\Resignation;
use App\Promotion;
use App\Appraisal;
use Auth;
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
        if(Auth::user()->role_id==2){
        $per_status_complete= Employee::where('perfomance_status','1')->where('man_id',Auth::user()->id)->get()->count();
        }else{
        $per_status_complete= Employee::where('perfomance_status','1')->get()->count();
        }
        if(Auth::user()->role_id==2){
        $per_status_incomp= Employee::where('perfomance_status','0')->where('man_id',Auth::user()->id)->get()->count();
        }
        else{
        $per_status_incomp= Employee::where('perfomance_status','0')->get()->count();
        }
        $man_total= Employee::where('role_id','2')->get()->count();
        if(Auth::user()->role_id==1){
           $emp = Employee::where('role_id','3')->orderBy('id', 'DESC')->limit(3)->get();
        }elseif(Auth::user()->role_id==2){
            $emp = Employee::where('role_id','3')->where('man_id',Auth::user()->id)->orderBy('id', 'DESC')->limit(3)->get();
        }
        $today_date=Carbon::today()->format('Y-m-d');
        $total_emp=Employee::where('role_id','!=',1)->count();
        $on_leave=EmployeeLeave::where([ ['from_date', '>=', $today_date], ['to_date', '<=', $today_date],])  ->orWhere([['from_date', '>=', $today_date],['to_date', '<=', $today_date],])->orWhere([['from_date', '<=', $today_date],['to_date', '>=', $today_date],])->get()->groupBy('employee_id')->count();
        $on_leave_data=EmployeeLeave::where([ ['from_date', '>=', $today_date], ['to_date', '<=', $today_date],]) ->orWhere([['from_date', '>=', $today_date],['to_date', '<=', $today_date],])->orWhere([['from_date', '<=', $today_date],['to_date', '>=', $today_date],])->limit(2)->get();
        $progress_leave = $on_leave*100/$total_emp;
        $planed_leave=DB::select("SELECT e2.* FROM `employee_leaves` e1 inner join `employee_leaves` e2 on date(e1.updated_at) < (e2.from_date) and e2.id=e1.id and e1.from_date <= (select current_date) and e1.to_date >= (select current_date);
        ");
        $plan_count = count($planed_leave);
        $unplan_data=$on_leave-$plan_count;
        if($on_leave != 0){$plan_data = $plan_count*100/$on_leave;}else{$plan_data=0;}
        if($on_leave != 0){$unplan_count=$unplan_data*100/$on_leave;}else{$unplan_count=0;}
        $pending_req=EmployeeLeave::where('status', 1)->get()->count();
        $pending_persent = $pending_req/100;

   //     $emp = Employee::where('role_id','3')->orderBy('id', 'DESC')->limit(3)->get();
        $res = Resignation::orderBy('id', 'DESC')->limit(3)->get();
        $promotion = Promotion::orderBy('id', 'DESC')->limit(5)->get();
        $appraisal = Appraisal::orderBy('id', 'DESC')->limit(5)->get();

        return view('index',compact('emp_total','per_status_complete','per_status_incomp','man_total', 'emp', 'res', 'promotion', 'appraisal','on_leave','on_leave_data','total_emp','progress_leave','plan_count','unplan_count','pending_persent','unplan_data','plan_data','pending_req'));
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
        if(Auth::user()->role_id==2){
        $per_status_complete= Employee::where('perfomance_status','1')->where('man_id',Auth::user()->id)->get()->count();
        }else{
        $per_status_complete= Employee::where('perfomance_status','1')->get()->count();
        }
        if(Auth::user()->role_id==2){
        $per_status_incomp= Employee::where('perfomance_status','0')->where('man_id',Auth::user()->id)->get()->count();
        }
        else{
        $per_status_incomp= Employee::where('perfomance_status','0')->get()->count();
        }
        $man_total= Employee::where('role_id','2')->get()->count();
        $today_date=Carbon::today()->format('Y-m-d');
        $total_emp=Employee::where('role_id','!=',1)->count();
        $on_leave=EmployeeLeave::where([ ['from_date', '>=', $today_date], ['to_date', '<=', $today_date],])  ->orWhere([['from_date', '>=', $today_date],['to_date', '<=', $today_date],])->orWhere([['from_date', '<=', $today_date],['to_date', '>=', $today_date],])->get()->groupBy('employee_id')->count();
        $on_leave_data=EmployeeLeave::where([ ['from_date', '>=', $today_date], ['to_date', '<=', $today_date],]) ->orWhere([['from_date', '>=', $today_date],['to_date', '<=', $today_date],])->orWhere([['from_date', '<=', $today_date],['to_date', '>=', $today_date],])->limit(2)->get();
        $progress_leave = $on_leave*100/$total_emp;
        $planed_leave=DB::select("SELECT e2.* FROM `employee_leaves` e1 inner join `employee_leaves` e2 on date(e1.updated_at) < (e2.from_date) and e2.id=e1.id and e1.from_date <= (select current_date) and e1.to_date >= (select current_date);
        ");
        $plan_count = count($planed_leave);
        $unplan_data=$on_leave-$plan_count;
        if($on_leave != 0){$plan_data = $plan_count*100/$on_leave;}else{$plan_data=0;}
        if($on_leave != 0){$unplan_count=$unplan_data*100/$on_leave;}else{$unplan_count=0;}
        $pending_req=EmployeeLeave::where('status', 1)->get()->count();
        $pending_persent = $pending_req/100;

        $emp = Employee::where('role_id','3')->orderBy('id', 'DESC')->limit(3)->get();
        $res = Resignation::orderBy('id', 'DESC')->limit(3)->get();
        $promotion = Promotion::orderBy('id', 'DESC')->limit(5)->get();
        $appraisal = Appraisal::orderBy('id', 'DESC')->limit(5)->get();

		return view('index',compact('emp_total','per_status_complete','per_status_incomp','man_total', 'emp', 'res', 'promotion', 'appraisal','on_leave','on_leave_data','total_emp','progress_leave','plan_count','unplan_count','pending_persent','unplan_data','plan_data','pending_req'));
		}
		else
		{
			return view('employee-dashboard');
		}
    }

}
