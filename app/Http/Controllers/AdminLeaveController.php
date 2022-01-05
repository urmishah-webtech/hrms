<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveType;
use App\EmployeeLeave;
use App\Employee; 
use Auth;
use Carbon\Carbon;

class AdminLeaveController extends Controller
{
    public function index()
    {
        $data=EmployeeLeave::orderBy('status','asc')->get();
        $total_emp=Employee::where('role')->count();
        return view('leaves',\compact('data'));
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
}
