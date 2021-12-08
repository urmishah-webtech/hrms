<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Appraisal;
use App\Employee;
use Validator;
use DB;
class AppraisalController extends Controller
{
    public function appraisal(){
        $appraisal=Appraisal::get();
        $employees=Employee::get();  
        //dd($employees);               
        return view('performance-appraisal',compact('appraisal','employees'));
    }
    public function add_appraisal (Request $request){
        
        $validator = Validator::make($request->all(), [
            'appraisal_date' => 'required',           
        ]);
        if($validator->fails()){
            return back()->with('error', 'Error in creating Appraisal');
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
            'appraisal_date' => 'required', 
        ]);
        if($validator->fails()){
            return back()->with('error', 'Error in updating Appraisal');
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
}
