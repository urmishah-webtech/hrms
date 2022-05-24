<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalExcellence;
use App\Employee;
use Auth;
use DB;

class PersonalExcellencesController extends Controller
{   
    public function add_PersonalExcellence1(Request $request){   
                  
        $userd = Auth::user()->id;                 
        $test_usee= PersonalExcellence::where('emp_id', $userd)->first();
       
		if(!empty($test_usee)){   
        $personal= PersonalExcellence::where('emp_id', $userd)->first();          
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
        $personal->emp_id = $userd;
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
	
	/*Json Data*/
	public function add_PersonalExcellence(Request $request)
    {  
        $eid = $request->empid;        
        $settings=PersonalExcellence::where('emp_id',$eid)->first();  
        $rate_arr=array();
        $final_achieved=array();
        $final_scored=array();
        $final_achieved_man=array();
        $final_scored_man=array();
        array_push($rate_arr,$request->key_no);
        $rate_count=count($rate_arr);
        if(!empty($rate_arr)){
            $i=0;
            foreach($request->key_no as $key => $val){
            $final_achieved[$val]['percentage_achieved_employee']=$request->percentage_achieved_employee[$i];
            $final_scored[$val]['points_scored_employee']=$request->points_scored_employee[$i]; 
            $final_achieved_man[$val]['percentage_achieved_manager']=$request->percentage_achieved_manager[$i];
            $final_scored_man[$val]['points_scored_manager']=$request->points_scored_manager[$i];             
            $i++;
           }
        }
        if($settings){
             
                $settings->percentage_achieved_employee=json_encode($final_achieved);
                $settings->points_scored_employee=json_encode($final_scored);
                $settings->percentage_achieved_manager=json_encode($final_achieved_man);
                $settings->points_scored_manager=json_encode($final_scored_man);
                $settings->total_score_employee=$request->total_score_employee;
                $settings->total_score_manager=$request->total_score_manager;
                $settings->total_percentage_employee=$request->total_percentage_employee;
                $settings->total_percentage_manager=$request->total_percentage_manager;
                $settings->save();
             
        }
        else{
                $settings = new PersonalExcellence();                 
                $settings->emp_id = Auth::user()->id;
                $settings->percentage_achieved_employee=json_encode($final_achieved);
                $settings->points_scored_employee=json_encode($final_scored);
                $settings->percentage_achieved_manager=json_encode($final_achieved_man);
                $settings->points_scored_manager=json_encode($final_scored_man);
                $settings->total_score_employee=$request->total_score_employee;
                $settings->total_score_manager=$request->total_score_manager;
                $settings->total_percentage_employee=$request->total_percentage_employee;
                $settings->total_percentage_manager=$request->total_percentage_manager;
                $settings->save();
             
        }

        return back();                 
    }
}
