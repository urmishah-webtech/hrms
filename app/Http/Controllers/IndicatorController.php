<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Indicator;
use App\Designation;
use App\Notification;
use App\Department;
use App\Employee;
use Validator;
use Redirect;
use Auth;
use DB;
use App\Events\IndicatorStatus;
class IndicatorController extends Controller
{
    public function indicators(){
        $indicators=Indicator::get();
        $designations=Designation::get();
        $employees=Employee::get();
        $admin_emp=Employee::where('role_id','!=',1)->get();
        $login_emp = Indicator::where('employee_id', Auth::user()->id)->get();
        $employee_id = Indicator::get('employee_id'); 
        $manager_e = Employee::where('man_id',Auth::id())->get()->pluck('id')->toArray();
        $indi_man = Indicator::whereIN('employee_id', $manager_e)->get();
        $select_emp_man = Employee::where('man_id',Auth::id())->get();
        //$designations=Designation::with('indicator_designation')->get();          
        return view('performance-indicator',compact('indicators','designations', 'employees','login_emp','indi_man','select_emp_man','admin_emp'));
    }
    public function add_indicator (Request $request){
        
        $validator = Validator::make($request->all(), [
            'designation' => 'required',
            'employee' => 'required',
        ]);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }
        $indicat =new Indicator();
        $indicat->designation_id=$request->designation;
        $indicat->employee_id=$request->employee;
        $indicat->customer_experience=$request->customer_experience;
        $indicat->marketing=$request->marketing;
        $indicat->management=$request->management;
        $indicat->administration=$request->administration;
        $indicat->presentation_skills=$request->presentation_skills;
        $indicat->quality_of_work=$request->quality_of_work;
        $indicat->efficiency=$request->efficiency;
        $indicat->integrity=$request->integrity;
        $indicat->professionalism=$request->professionalism;
        $indicat->teamwork=$request->teamwork;
        $indicat->critical_thinking=$request->critical_thinking;
        $indicat->conflict_management=$request->conflict_management;
        $indicat->attendance=$request->attendance;
        $indicat->ability_to_meet_deadline=$request->ability_to_meet_deadline;
        $indicat->status=$request->status;        
        $indicat->save();
        return back();
        
    }
    public function edit_indicator(Request $request){               
        $validator = Validator::make($request->all(), [
            'designation' => 'required',
            'employee' => 'required',
        ]);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }
        $indicat= Indicator::find($request->id);              
        if($indicat){
            $indicat->designation_id=$request->designation;
            $indicat->employee_id=$request->employee;
            $indicat->customer_experience=$request->customer_experience;
            $indicat->marketing=$request->marketing;
            $indicat->management=$request->management;
            $indicat->administration=$request->administration;
            $indicat->presentation_skills=$request->presentation_skills;
            $indicat->quality_of_work=$request->quality_of_work;
            $indicat->efficiency=$request->efficiency;
            $indicat->integrity=$request->integrity;
            $indicat->professionalism=$request->professionalism;
            $indicat->teamwork=$request->teamwork;
            $indicat->critical_thinking=$request->critical_thinking;
            $indicat->conflict_management=$request->conflict_management;
            $indicat->attendance=$request->attendance;
            $indicat->ability_to_meet_deadline=$request->ability_to_meet_deadline;
            $indicat->status=$request->status;
            $indicat->save();
        }
        else{
            return back();
        }
        return back();
    }
    public function delete_indicator(Request $request){         
            $indicat= Indicator::where('id',$request->id)->delete();
            if($indicat==1){
                echo json_encode("1");
            }
            else{
                echo json_encode("0");
            }
         
    }    
    public function changestatusDropdown($type,$id){ 
        $data=Indicator::where('id',$id)->first();
        $data->status=$type;
        $data->save();
        $type_name=($type=='1')?'Active':'Inactive';    
        $message='Hi, Your Performance Indicator Status has been '.$type_name;
        Notification::create(['employeeid' => $data->employee_id, 'message' => $message]);
        event(new IndicatorStatus($message,$data->employee_id));
        return back();
    }
}
