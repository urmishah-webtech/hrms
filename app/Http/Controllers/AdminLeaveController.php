<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveType;
use App\EmployeeLeave;
use App\Employee; 
use Auth;
use Carbon\Carbon;
use DB;

class AdminLeaveController extends Controller
{
    public function index()
    {
        $data=EmployeeLeave::orderBy('status','asc')->get();
        $total_emp=Employee::where('role_id','!=',1)->count();
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
        //$present_emp = $total_emp - $from_date;       
        $planed_leave=DB::select("SELECT e2.* FROM employee_leaves e1 inner join employee_leaves e2 on date(e1.updated_at) < (e2.from_date) and e2.id=e1.id and e1.from_date < (select current_date)");
        $plan_count = count($planed_leave);
        //dd($plan_count);
       // $un_planed_leave=EmployeeLeave::whereDate('updated_at', '>=', $today_date)->get()->count();
        $un_planed_leave=DB::select("SELECT e2.* FROM employee_leaves e1 inner join employee_leaves e2 on date(e1.updated_at) = (e2.from_date) and e2.id=e1.id;");
        $unplan_count = count($un_planed_leave);
        $pending_req=EmployeeLeave::where('status', 1)->get()->count();        
        $employee_tb = EmployeeLeave::get();
        $search_leave_type='';
        return view('leaves',\compact('data','employee_tb','total_emp','present_emp','plan_count','unplan_count','pending_req'));
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
        return back();
    }
    public function search_leave_employee(Request $request){
        $employee_tb = EmployeeLeave::get();
         
        $emp=new EmployeeLeave;
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
            // $emp=EmployeeLeave::where('from_date', '>=', $search_from_date)->where('to_date', '<=', $search_to_date);
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
         
        return view('leaves',compact('employee_tb','data', 'search_employee_name','search_leave_type','search_leave_status','search_from_date','search_to_date'));
    }
}
