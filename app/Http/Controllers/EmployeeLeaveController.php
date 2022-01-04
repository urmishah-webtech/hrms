<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveType;
use App\EmployeeLeave;
use Auth;
class EmployeeLeaveController extends Controller
{
    public function index()
    {
        $lt=LeaveType::first();
        $total_leaves=0;
        $total_leaves+=is_null($lt->annual_days)?0:$lt->annual_days;
        $total_leaves+=is_null($lt->sick_days)?0:$lt->sick_days;
        $total_leaves+=is_null($lt->hospitalisation_days)?0:$lt->hospitalisation_days;
        $data=EmployeeLeave::where('employee_id',Auth::id())->get();
        $taken_leaves=0;
        if(!empty($data)){
            foreach($data as $val)
            {
                $taken_leaves+=$val->number_of_days;
            }        
        }
        $remaining_leaves=$total_leaves-$taken_leaves;
        return view('leaves-employee',compact('lt','data','total_leaves','taken_leaves','remaining_leaves'));
    }
}
