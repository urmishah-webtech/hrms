<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveType;
use App\EmployeeLeave;
use App\Employee; 
use Auth;
use Carbon\Carbon;
use DB;
use App\Notification;
use App\Events\LeaveApprove;
use Response;
use DateTime;
class AdminLeaveController extends Controller
{
    public function index()
    {
		 
		$man_comment=EmployeeLeave::where('manager_id',Auth::user()->id)->pluck('id')->toArray();  
		 		
        if(Auth::user()->role_id==2 || Auth::user()->role_id==6 ){
            $view =$this->manger_leave_list();
            return $view;
        }else{
        $data=EmployeeLeave::orderBy('status','asc')->get();
        $total_emp=Employee::where('role_id','!=',1)->count();
        $today_date=Carbon::today()->format('Y-m-d'); 

        $on_leave=EmployeeLeave::where([
            ['from_date', '>=', $today_date],
            ['to_date', '<=', $today_date],
        ])
        ->orWhere([
            ['from_date', '>=', $today_date],
            ['to_date', '<=', $today_date],
        ])
        ->orWhere([
            ['from_date', '<=', $today_date],
            ['to_date', '>=', $today_date],
        ])->get()->groupBy('employee_id')->count();

       // $total_emp=Employee::where('role_id',3)->count();
        $today_date=Carbon::today()->format('Y-m-d'); 
        $from_date=EmployeeLeave::whereDate('from_date', '<=', $today_date)->whereDate('to_date', '>=', $today_date)->get()->count();
        $present_emp = $total_emp - $on_leave;        
        $planed_leave=DB::select("SELECT e2.* FROM `employee_leaves` e1 inner join `employee_leaves` e2 on date(e1.updated_at) < (e2.from_date) and e2.id=e1.id and e1.from_date <= (select current_date) and e1.to_date >= (select current_date);
        ");
        $plan_count = count($planed_leave);
        //   $un_planed_leave=DB::select("SELECT e2.* FROM employee_leaves e1 inner join employee_leaves e2 on date(e1.updated_at) = (e2.from_date) and e2.id=e1.id;");
        $unplan_count=$on_leave-$plan_count;
        $pending_req=EmployeeLeave::where('status', 1)->get()->count();        
        $employee_tb = Employee::where('role_id','!=',1)->get();

        $search_leave_type='';
        return view('leaves',\compact('data','employee_tb','total_emp','present_emp','plan_count','unplan_count','pending_req','man_comment'));
        }
    }
    public function change_leave_status($type,$id){
        $data=EmployeeLeave::where('id',$id)->first();
        $data->status=$type;
        $data->approved_by=Auth::id();
        $leave_date=Carbon::createFromFormat('Y-m-d',$data->from_date);
        $today_date=Carbon::today()->format('Y-m-d');
        $result = $leave_date->lt($today_date);
		 
        if($result==true){
            return back()->with('error','Timelimit for Changing Status is over ! you cant change now');
        }
        $data->save();
        $type_name=($type=='2')?'approved':'rejected';
        $message='Hi, Your leave has been '.$type_name;
        Notification::create(['employeeid' => $data->employee_id, 'message' => $message]);
        event(new LeaveApprove($message,$data->employee_id));
        return back();
    }
    public function search_leave_employee(Request $request){
        if(Auth::user()->role_id==2 || Auth::user()->role_id==6){
            $employee_tb = Employee::where('role_id','!=',1)->where('man_id',Auth::id())->get();
        }
        else{
        $employee_tb = Employee::where('role_id','!=',1)->get();
        }
        if(Auth::user()->role_id==2 || Auth::user()->role_id==6){
            $emp=EmployeeLeave::where('manager_id',Auth::id());
        }else{
        $emp=new   EmployeeLeave;
        }
        $search_employee_name=$request->search_employee_name;
        $search_leave_type=$request->search_leave_type; 
        $search_leave_status=$request->search_leave_status;
        $search_from_date=$request->search_from_date;
        $search_to_date=$request->search_to_date;
        
        if($search_employee_name!=""){
            $emp=$emp->where('employee_id',$search_employee_name);
        }
        if($search_leave_type!=""){
            $emp=$emp->where('leave_type_id',$search_leave_type);
        } 
        if($search_leave_status!=""){
            $emp=$emp->where('status',$search_leave_status);
        }
        if($search_from_date!=""){
            $emp=$emp->where('from_date',$search_from_date);
        }
        if($search_to_date!=""){
            $emp=$emp->where('to_date',$search_to_date);
        }
        if($search_from_date!="" && $search_to_date!=""){
         $emp=EmployeeLeave::where([
             ['from_date', '>=', $search_from_date],
             ['to_date', '<=', $search_to_date],
         ])
         ->orWhere([
             ['from_date', '>=', $search_from_date],
             ['to_date', '<=', $search_to_date],
         ])
         ->orWhere([
             ['from_date', '<=', $search_from_date],
             ['to_date', '>=', $search_to_date],
         ]);
        }
        
        $data=$emp->get();
        $total_emp=Employee::where('role_id','!=',1)->count();
        $today_date=Carbon::today()->format('Y-m-d'); 

        $on_leave=EmployeeLeave::where([
            ['from_date', '>=', $today_date],
            ['to_date', '<=', $today_date],
        ])
        ->orWhere([
            ['from_date', '>=', $today_date],
            ['to_date', '<=', $today_date],
        ])
        ->orWhere([
            ['from_date', '<=', $today_date],
            ['to_date', '>=', $today_date],
        ])->get()->groupBy('employee_id')->count();

       // $total_emp=Employee::where('role_id',3)->count();
        $today_date=Carbon::today()->format('Y-m-d'); 
        $from_date=EmployeeLeave::whereDate('from_date', '<=', $today_date)->whereDate('to_date', '>=', $today_date)->get()->count();
        $present_emp = $total_emp - $on_leave;        
        $planed_leave=DB::select("SELECT e2.* FROM `employee_leaves` e1 inner join `employee_leaves` e2 on date(e1.updated_at) < (e2.from_date) and e2.id=e1.id and e1.from_date <= (select current_date) and e1.to_date >= (select current_date);
        ");
        $plan_count = count($planed_leave);
        //   $un_planed_leave=DB::select("SELECT e2.* FROM employee_leaves e1 inner join employee_leaves e2 on date(e1.updated_at) = (e2.from_date) and e2.id=e1.id;");
        $unplan_count=$on_leave-$plan_count;
        if(Auth::user()->role_id==2 || Auth::user()->role_id==6 ){
            
            $pending_req=EmployeeLeave::where('status', 1)->where('manager_id',Auth::id())->get()->count();        
           
        }
        else{
        $pending_req=EmployeeLeave::where('status', 1)->get()->groupBy('employee_id')->count();        
        }
        return view('leaves',compact('employee_tb','data', 'search_employee_name','search_leave_type','search_leave_status','search_from_date','search_to_date',
        'total_emp','present_emp','plan_count','unplan_count','pending_req'));
    }
    public function manger_leave_list(){
        $data=EmployeeLeave::orderBy('status','asc')->where('manager_id',Auth::id())->get();
        $total_emp=Employee::where('role_id','!=',1)->count();
        $today_date=Carbon::today()->format('Y-m-d'); 

        $on_leave=EmployeeLeave::where([
            ['from_date', '>=', $today_date],
            ['to_date', '<=', $today_date],
        ])
        ->orWhere([
            ['from_date', '>=', $today_date],
            ['to_date', '<=', $today_date],
        ])
        ->orWhere([
            ['from_date', '<=', $today_date],
            ['to_date', '>=', $today_date],
        ])->get()->groupBy('employee_id')->count();

        $today_date=Carbon::today()->format('Y-m-d'); 
        $from_date=EmployeeLeave::whereDate('from_date', '<=', $today_date)->whereDate('to_date', '>=', $today_date)->get()->count();
        $present_emp = $total_emp - $on_leave;        
        $planed_leave=DB::select("SELECT e2.* FROM `employee_leaves` e1 inner join `employee_leaves` e2 on date(e1.updated_at) < (e2.from_date) and e2.id=e1.id and e1.from_date <= (select current_date) and e1.to_date >= (select current_date);
        ");
        $plan_count = count($planed_leave);
        //   $un_planed_leave=DB::select("SELECT e2.* FROM employee_leaves e1 inner join employee_leaves e2 on date(e1.updated_at) = (e2.from_date) and e2.id=e1.id;");
        $unplan_count=$on_leave-$plan_count;
        $pending_req=EmployeeLeave::where('status', 1)->get()->where('manager_id',Auth::id())->count(); 
        $employee_tb = Employee::where('role_id','!=',1)->where('man_id',Auth::id())->get();
        $search_leave_type='';
        $view= view('leaves',\compact('data','employee_tb','total_emp','present_emp','plan_count','unplan_count','pending_req'));
        return $view;
    }
    public function leave_calender()
    {
        return view('leave_calender');
    }
    public function leave_render(){
        $result = array();
        $count = 0;
        if(Auth::user()->role_id==2 || Auth::user()->role_id==6){
        $info2 = EmployeeLeave::where('manager_id',Auth::id())->get();
        }
        elseif(Auth::user()->role_id!=1 || Auth::user()->role_id!=5){
         $info2 = EmployeeLeave::where('employee_id',Auth::id())->get();
        }else{
        $info2 = EmployeeLeave::get();
        }  
        foreach($info2 as $value){
            $color = sprintf("#%06x",rand(0,16777215));
            $date = new DateTime($value->to_date);
            $date->modify('+1 day');

            $result[$count]['id']              = $value->id;
            $result[$count]['title']           = $value->employee->first_name.' '.$value->employee->last_name;
            $result[$count]['start']           = $value->from_date;
            $result[$count]['end']             = $date->format('Y-m-d');
			if($value->status == 1){
            $result[$count]['backgroundColor'] = '#ffbc34';
            $result[$count]['borderColor']     = '#ffbc34';
            }
			if($value->status == 2){
            $result[$count]['backgroundColor'] = '#28a745';
            $result[$count]['borderColor']     = '#28a745';
            }	
			if($value->status == 3){
            $result[$count]['backgroundColor'] = '#f62d51';
            $result[$count]['borderColor']     = '#f62d51';
            }
             
          
            $count++;
        }

        return json_encode($result);
    }
	
	public function add_manager_comment(Request $request){
		 
		$man_comment = EmployeeLeave::where('id',$request->id)->first();
		$man_comment->manager_comment=$request->manager_comment;
		$man_comment->status=3;
		$man_comment->save();
		return back(); 
	}
}
