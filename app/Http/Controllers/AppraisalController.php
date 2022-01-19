<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Appraisal;
use App\Employee;
use Validator;
use DB;
use Auth;
use Redirect;
use App\Notification;
use App\Events\AppraisalStatus;


class AppraisalController extends Controller
{
    public function appraisal(){
        $appraisal=Appraisal::get();
        $employees=Employee::get();  
        $login_emp = Appraisal::where('employee_id', Auth::user()->id)->get(); 
        $manager_e = Employee::where('man_id',Auth::id())->get()->pluck('id')->toArray();
        $appr_man = Appraisal::whereIN('employee_id', $manager_e)->get(); 
        $select_emp_man = Employee::where('man_id',Auth::id())->get(); 
        $admin_emp=Employee::where('role_id','!=',1)->get();       
        return view('performance-appraisal',compact('appraisal','employees','login_emp','appr_man','select_emp_man','admin_emp'));
    }
    public function add_appraisal (Request $request){
        
        $validator = Validator::make($request->all(), [
            'employees' => 'required',
            'appraisal_date' => 'required',           
        ]);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }
        $apprais =new Appraisal();
        $apprais->employee_id=$request->employees;
        $apprais->appraisal_date=Carbon::createFromFormat('d/m/Y', $request->appraisal_date)->format('Y-m-d')
        ;
        $apprais->customer_experience=$request->customer_experience;
        $apprais->marketing=$request->marketing;
        $apprais->management=$request->management;
        $apprais->administration=$request->administration;
        $apprais->presentation_skills=$request->presentation_skills;
        $apprais->quality_of_work=$request->quality_of_work;
        $apprais->efficiency=$request->efficiency;
        $apprais->integrity=$request->integrity;
        $apprais->professionalism=$request->professionalism;
        $apprais->teamwork=$request->teamwork;
        $apprais->critical_thinking=$request->critical_thinking;
        $apprais->conflict_management=$request->conflict_management;
        $apprais->attendance=$request->attendance;
        $apprais->ability_to_meet_deadline=$request->ability_to_meet_deadline;
        $apprais->status=$request->status;        
        $apprais->save();
        return back();
        
    }
    public function edit_appraisal(Request $request){               
        $validator = Validator::make($request->all(), [
            'employees' => 'required',
            'appraisal_date' => 'required', 
        ]);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }
        $apprais= Appraisal::find($request->id);        
        if($apprais){
            $apprais->employee_id=$request->employees;
            $apprais->appraisal_date=Carbon::createFromFormat('d/m/Y', $request->appraisal_date)->format('Y-m-d')
        ;
            $apprais->customer_experience=$request->customer_experience;
            $apprais->marketing=$request->marketing;
            $apprais->management=$request->management;
            $apprais->administration=$request->administration;
            $apprais->presentation_skills=$request->presentation_skills;
            $apprais->quality_of_work=$request->quality_of_work;
            $apprais->efficiency=$request->efficiency;
            $apprais->integrity=$request->integrity;
            $apprais->professionalism=$request->professionalism;
            $apprais->teamwork=$request->teamwork;
            $apprais->critical_thinking=$request->critical_thinking;
            $apprais->conflict_management=$request->conflict_management;
            $apprais->attendance=$request->attendance;
            $apprais->ability_to_meet_deadline=$request->ability_to_meet_deadline;
            $apprais->status=$request->status;
            $apprais->save();
        }
        else{
            return back();
        }
        return back();
    }
    public function delete_appraisal(Request $request){         
        $apprais= Appraisal::where('id',$request->id)->delete();
        if($apprais==1){
            echo json_encode("1");
        }
        else{
            echo json_encode("0");
        }
     
    }
    public function change_appraisal_status($type,$id){     
        /*$modules=Appraisal::where('id',$request->id)->first();         
        $modules->status=$request->status;
        $modules->save();
        return json_encode("1");*/

        $data=Appraisal::where('id',$id)->first();
        $data->status=$type;
        $data->save();
        $type_name=($type=='1')?'Active':'Inactive';    
        $message='Hi, Your Performance Appraisal Status has been '.$type_name;
        Notification::create(['employeeid' => $data->employee_id, 'message' => $message]);
        event(new AppraisalStatus($message,$data->employee_id));
        return back();
    }
}
