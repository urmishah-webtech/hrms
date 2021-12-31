<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalExcellence;
use App\Employee;
use Auth;
use DB;

class PersonalExcellencesController extends Controller
{   
    public function add_PersonalExcellence(Request $request){   
                  
        $userd = Auth::user()->id;
        $string_id = Employee::where('user_id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);          
        $test_usee= PersonalExcellence::where('user_id', $userd)->first();
       
		if(!empty($test_usee)){   
        $personal= PersonalExcellence::where('user_id', $userd)->first();          
        $personal->plan_leave_employee=$request->plan_leave_employee;
        $personal->time_cons_employee=$request->time_cons_employee;
        $personal->team_collaboration_employee=$request->team_collaboration_employee;
        $personal->professionalism_employee=$request->professionalism_employee;
        $personal->policy_employee=$request->policy_employee;
        $personal->initiatives_employee=$request->initiatives_employee;
        $personal->improvement_employee=$request->improvement_employee;
        $personal->plan_leave_manager=$request->plan_leave_manager;
        $personal->time_cons_manager=$request->time_cons_manager;
        $personal->team_collaboration_manager=$request->team_collaboration_manager;
        $personal->professionalism_manager=$request->professionalism_manager;
        $personal->policy_manager=$request->policy_manager;
        $personal->initiatives_manager=$request->initiatives_manager;
        $personal->improvement_manager=$request->improvement_manager;
        $personal->total_score_employee=$request->total_score_employee; 
        $personal->total_score_manager=$request->total_score_manager; 
        $personal->total_percentage_employee=$request->total_percentage_employee; 
        $personal->total_percentage_manager=$request->total_percentage_manager;  
        $personal->save();
        }		
		else 
		{ 
        $personal =new PersonalExcellence();            
        $personal->user_id = $userd;
        $personal->emp_id = $emp_id;
        $personal->plan_leave_employee=$request->plan_leave_employee;
        $personal->time_cons_employee=$request->time_cons_employee;
        $personal->team_collaboration_employee=$request->team_collaboration_employee;
        $personal->professionalism_employee=$request->professionalism_employee;
        $personal->policy_employee=$request->policy_employee;
        $personal->initiatives_employee=$request->initiatives_employee;
        $personal->improvement_employee=$request->improvement_employee;
        $personal->plan_leave_manager=$request->plan_leave_manager;
        $personal->time_cons_manager=$request->time_cons_manager;
        $personal->team_collaboration_manager=$request->team_collaboration_manager;
        $personal->professionalism_manager=$request->professionalism_manager;
        $personal->policy_manager=$request->policy_manager;
        $personal->initiatives_manager=$request->initiatives_manager;
        $personal->improvement_manager=$request->improvement_manager;
        $personal->total_score_employee=$request->total_score_employee; 
        $personal->total_score_manager=$request->total_score_manager; 
        $personal->total_percentage_employee=$request->total_percentage_employee; 
        $personal->total_percentage_manager=$request->total_percentage_manager;         
        $personal->save();       	  
		}
        return redirect("/performance#PersonalExcellence");
	   
    }
}
