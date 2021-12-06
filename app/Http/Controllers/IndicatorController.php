<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Indicator;
use App\Designation;
use App\Department;
use Validator;
use DB;
class IndicatorController extends Controller
{
    public function indicators(){
        $indicators=Indicator::get();
        $designations=Designation::get();
        //$designations=Designation::with('indicator_designation')->get();          
        return view('performance-indicator',compact('indicators','designations'));
    }
    public function add_indicator (Request $request){
        
        $validator = Validator::make($request->all(), [
            'customer_experience' => 'required',
            'marketing' => 'required',
        ]);
        if($validator->fails()){
            return back()->with('error', 'Error in creating Indicators');
        }
        $indicat =new Indicator();
        $indicat->designation_id=$request->designation;
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
            'customer_experience' => 'required',
            'marketing' => 'required',
        ]);
        if($validator->fails()){
            return back()->with('error', 'Error in updating designataion');
        }
        $indicat= Indicator::find($request->id);
        if($indicat){
            $indicat->designation_id=$request->designation;
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
}
