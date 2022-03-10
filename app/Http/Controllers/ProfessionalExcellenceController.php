<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfessionalExcellence;
use App\SpecialInitiatives;
use App\PersonalExcellence;
use App\CommentsRole;
use App\AdditionCommentRole;
use App\AppraiseeStrength;
use App\PersonalGoal;
use App\Employee;
use App\ProfessionalGoalsAchieved;
use App\ProfessionalGoalsForthcoming;
use App\TrainingRequirements;
use App\OtherGeneralComment;
use App\PerfomanceManagerUse;
use App\PerformanceIdentity;
use App\KeyprofessionalExcellences;
use Auth;
use Validator;
use DB;
class ProfessionalExcellenceController extends Controller
{	
	public function ProfessionalExcellence(){        
        $userd = Auth::user()->id; 	
        $professional=ProfessionalExcellence::where('emp_id', $userd)->first();       
        $personal=PersonalExcellence::where('emp_id', $userd)->first(); 
        $specialInitiatives=SpecialInitiatives::where('emp_id', $userd)->get();
        $comments_role=CommentsRole::where('emp_id', $userd)->get();
        $add_comments=AdditionCommentRole::where('emp_id', $userd)->get()->toArray();	
        $add_comments_id=AdditionCommentRole::where('emp_id', $userd)->get();
        $add_appraiseest=AppraiseeStrength::where('emp_id', $userd)->get()->toArray();	
        $add_appraiseest_id=AppraiseeStrength::where('emp_id', $userd)->get();
        $add_personalgoal=PersonalGoal::where('emp_id', $userd)->get()->toArray();	
        $add_personalgoal_id=PersonalGoal::where('emp_id', $userd)->get();
        $professional_achived=ProfessionalGoalsAchieved::where('emp_id', $userd)->get();
        $professional_forthcoming=ProfessionalGoalsForthcoming::where('emp_id', $userd)->get();
        $training_requirements=TrainingRequirements::where('emp_id', $userd)->get();
        $general_comment=OtherGeneralComment::where('emp_id', $userd)->get();
        $perfomancemanageruse=PerfomanceManagerUse::where('emp_id', $userd)->get(); 
        $add_manager_id=PerfomanceManagerUse::where('emp_id', $userd)->get();
        $add_perfoIdent=PerformanceIdentity::where('emp_id', $userd)->get(); 
        $add_perfoIdent_id=PerformanceIdentity::where('emp_id', $userd)->get();
        $add_perfoIdent_man=PerformanceIdentity::where('emp_id', $userd)->where('user_role','2')->get(); 
        $add_perfoIdent_employ=PerformanceIdentity::where('emp_id', $userd)->where('user_role','3')->get(); 
		$emps=Employee::where('id', $userd)->first();          
        $prof_excel=KeyprofessionalExcellences::where('emp_id', $userd)->first();
          
        return view('performance',compact('professional','emps','personal','specialInitiatives','comments_role','add_comments','add_comments_id','add_appraiseest','add_appraiseest_id','add_personalgoal','add_personalgoal_id','professional_achived','professional_forthcoming','training_requirements','general_comment','perfomancemanageruse','add_manager_id','add_perfoIdent','add_perfoIdent_id','prof_excel','add_perfoIdent_man','add_perfoIdent_employ'));
         
    } 
	
	public function add_ProfessionalExcellence(Request $request){
        $userd = Auth::user()->id;          
        $string_id = Employee::where('id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);              
        $test_usee= ProfessionalExcellence::where('id', $userd)->first();
        $prof_emp=ProfessionalExcellence::where('id', $emp_id)->first();
         
		if(!empty($test_usee) && !empty($prof_emp)){   
        $professional= ProfessionalExcellence::where('id', $userd)->first();          
        $professional->quality_employee=$request->quality_employee;
        $professional->tat_employee=$request->tat_employee;
        $professional->pms_new_ideas_employee=$request->pms_new_ideas_employee;
        $professional->team_productivity_employee=$request->team_productivity_employee;
        $professional->knowledge_sharing_employee=$request->knowledge_sharing_employee;
        $professional->emails_calls_employee=$request->emails_calls_employee;
        $professional->quality_manager=$request->quality_manager;
        $professional->tat_manager=$request->tat_manager;
        $professional->pms_new_ideas_manager=$request->pms_new_ideas_manager;
        $professional->team_productivity_manager=$request->team_productivity_manager;
        $professional->knowledge_sharing_manager=$request->knowledge_sharing_manager;
        $professional->emails_calls_manager=$request->emails_calls_manager;
        $professional->total_percentage_employee=$request->total_percentage_employee;
        $professional->total_percentage_manager=$request->total_percentage_manager; 
        $professional->save();
         }		
		else 
		{ 
        $professional =new ProfessionalExcellence();            
       //$professional->user_id = $userd;
        $professional->emp_id = $userd;
        $professional->quality_employee=$request->quality_employee;
        $professional->tat_employee=$request->tat_employee;
        $professional->pms_new_ideas_employee=$request->pms_new_ideas_employee;
        $professional->team_productivity_employee=$request->team_productivity_employee;
        $professional->knowledge_sharing_employee=$request->knowledge_sharing_employee;
        $professional->emails_calls_employee=$request->emails_calls_employee;
        $professional->quality_manager=$request->quality_manager;
        $professional->tat_manager=$request->tat_manager;
        $professional->pms_new_ideas_manager=$request->pms_new_ideas_manager;
        $professional->team_productivity_manager=$request->team_productivity_manager;
        $professional->knowledge_sharing_manager=$request->knowledge_sharing_manager;
        $professional->emails_calls_manager=$request->emails_calls_manager;
        $professional->total_percentage_employee=$request->total_percentage_employee;
        $professional->total_percentage_manager=$request->total_percentage_manager;         
        $professional->save();       	  
		}
        return redirect("/performance#professionalexcel");	   
    }

    public function store_KeyprofessionalExcellences(Request $request)
    {  
        $eid = $request->empid;         
        $settings=KeyprofessionalExcellences::where('emp_id',$eid)->first();  
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
                $settings->total_achieved_employee=$request->total_achieved_employee;
                $settings->total_scored_employee=$request->total_scored_employee;
                $settings->total_achieved_manager=$request->total_achieved_manager;
                $settings->total_scored_manager=$request->total_scored_manager;
                $settings->save();
             
        }
        else{
                $settings = new KeyprofessionalExcellences();                 
                $settings->emp_id = Auth::user()->id;
                $settings->percentage_achieved_employee=json_encode($final_achieved);
                $settings->points_scored_employee=json_encode($final_scored);
                $settings->percentage_achieved_manager=json_encode($final_achieved_man);
                $settings->points_scored_manager=json_encode($final_scored_man);
                $settings->total_achieved_employee=$request->total_achieved_employee;
                $settings->total_scored_employee=$request->total_scored_employee;
                $settings->total_achieved_manager=$request->total_achieved_manager;
                $settings->total_scored_manager=$request->total_scored_manager;
                $settings->save();
             
        }

        return back();                 
    } 
	 
}
