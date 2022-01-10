<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveType;
use App\EmployeeLeave;
use App\Employee;
use Auth;
use Carbon\Carbon;
class EmployeeLeaveController extends Controller
{
    public function index()
    {
        $lt=LeaveType::first();
        $total_leaves=0;
        if($lt){
        $total_leaves+=is_null($lt->annual_days)?0:$lt->annual_days;
        $total_leaves+=is_null($lt->sick_days)?0:$lt->sick_days;
        $total_leaves+=is_null($lt->hospitalisation_days)?0:$lt->hospitalisation_days;
        }
        $data=EmployeeLeave::where('employee_id',Auth::id())->orderBy('id','desc')->get();
        $my_manager_name=Employee::where('id',Auth::user()->manager_id)->first();
       
        $taken_leaves=0;
        if(!empty($data)){
            foreach($data as $val)
            {
                $taken_leaves+=$val->number_of_days;
            }        
        }
        $remaining_leaves=$total_leaves-$taken_leaves;
        return view('leaves-employee',compact('lt','data','total_leaves','taken_leaves','remaining_leaves','my_manager_name'));
    } 
    public function save_leave(Request $request){

        $on_leave_already=EmployeeLeave::where([
            ['from_date', '>=', date('Y-m-d',strtotime($request->start_date))],
            ['to_date', '<=', date('Y-m-d',strtotime($request->end_date))],
            ['employee_id',Auth::id()],
        ])
        ->orWhere([
            ['from_date', '>=', date('Y-m-d',strtotime($request->start_date))],
            ['to_date', '<=', date('Y-m-d',strtotime($request->end_date))],
        ])
        ->orWhere([
            ['from_date', '<=', date('Y-m-d',strtotime($request->start_date))],
            ['to_date', '>=', date('Y-m-d',strtotime($request->end_date))],
        ])->first();

        if($on_leave_already)
        {
            return json_encode(0);
        }

        $el=new EmployeeLeave();
        $el->remaining_leave=$request->remaining_leaves;
        $fdate = strtotime($request->start_date);
        $el->from_date=date('Y-m-d',$fdate);
        $tdate = strtotime($request->end_date);
        $el->to_date=date('Y-m-d',$tdate);
        $el->number_of_days=$request->number_of_days;
        $el->leave_reason=$request->leave_reason;
        $el->leave_type_id=$request->leave_type_id;
        $el->employee_id=Auth::id();
        $el->save();
        return json_encode("1");
    }
    public function delete_leave(Request $request,$id){
        $data=EmployeeLeave::where('id',$id)->first();
        if($data){
            $leave_date=Carbon::createFromFormat('Y-m-d',$data->from_date);
            $today_date=Carbon::today()->format('Y-m-d');
            $result = $leave_date->lt($today_date);
            if($data->status!=1){
                return back()->with('error','You can not delete now !!');
            }
            else if($result==true){
                return back()->with('error','Timelimit for deleting is over ! you cant delete now');
            }
            elseif(!EmployeeLeave::where('employee_id',Auth::id())->where('id',$id)->exists()){
                return back()->with('error','anauthorized access !!');
            }
            else{
                EmployeeLeave::where('id',$id)->delete();
            }
        }
        return back();
    }
    public function edit_leave(Request $request,$id){
        $lt=LeaveType::first();
        $total_leaves=0;
        $taken_leaves=0;
        if($lt){
            $total_leaves+=is_null($lt->annual_days)?0:$lt->annual_days;
            $total_leaves+=is_null($lt->sick_days)?0:$lt->sick_days;
            $total_leaves+=is_null($lt->hospitalisation_days)?0:$lt->hospitalisation_days;
            }
            $el=EmployeeLeave::where('employee_id',Auth::id())->orderBy('id','desc')->get();           
            if(!empty($el)){
                foreach($el as $val)
                {
                    $taken_leaves+=$val->number_of_days;
                }        
            }
        $remaining_leaves=$total_leaves-$taken_leaves;
        $data=EmployeeLeave::where('id',$id)->first();
        return view('edit_emp_leave',compact('data','total_leaves','remaining_leaves'));
    }
    public function update_leave(Request $request){
        $data=EmployeeLeave::where('id',$request->id)->first();   
        if($data){

            $leave_date=Carbon::createFromFormat('Y-m-d',$data->from_date);
            $today_date=Carbon::today()->format('Y-m-d');
            $result = $leave_date->lt($today_date);
            if($data->status!=1){
                return response()->json(['message'=>'You can not edit  !!','status'=>0]);
            }
            else if($result==true){
                return response()->json(['message'=>'Timelimit for editing is over ! you cant delete now','status'=>0]);
            }
            else{
                $data->remaining_leave=$request->remaining_leaves;
                $fdate = strtotime($request->start_date);
                $data->from_date=date('Y-m-d',$fdate);
                $tdate = strtotime($request->end_date);
                $data->to_date=date('Y-m-d',$tdate);
                $data->number_of_days=$request->number_of_days;
                $data->leave_reason=$request->leave_reason;
                $data->leave_type_id=$request->leave_type_id;
                $data->employee_id=Auth::id();
                $data->save();
            }
            
        }
        else{
            return back()->with('error','Record Not Found !!');
        }
    }
}
