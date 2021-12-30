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
use Auth;
use Validator;
use DB;
class ProfessionalExcellenceController extends Controller
{	
	public function ProfessionalExcellence(){        
        $userd = Auth::user()->id; 	
        $professional=ProfessionalExcellence::where('user_id', $userd)->first();       
        $personal=PersonalExcellence::where('user_id', $userd)->first(); 
        $specialInitiatives=SpecialInitiatives::where('user_id', $userd)->get();
        $comments_role=CommentsRole::where('user_id', $userd)->get();
        $add_comments=AdditionCommentRole::where('user_id', $userd)->get()->toArray();	
        $add_comments_id=AdditionCommentRole::where('user_id', $userd)->get();
        $add_appraiseest=AppraiseeStrength::where('user_id', $userd)->get()->toArray();	
        $add_appraiseest_id=AppraiseeStrength::where('user_id', $userd)->get();
        $add_personalgoal=PersonalGoal::where('user_id', $userd)->get()->toArray();	
        $add_personalgoal_id=PersonalGoal::where('user_id', $userd)->get();
        $professional_achived=ProfessionalGoalsAchieved::where('user_id', $userd)->get();
        $professional_forthcoming=ProfessionalGoalsForthcoming::where('user_id', $userd)->get();
        $training_requirements=TrainingRequirements::where('user_id', $userd)->get();
        $general_comment=OtherGeneralComment::where('user_id', $userd)->get();
        $perfomancemanageruse=PerfomanceManagerUse::where('user_id', $userd)->get(); 
        $add_manager_id=PerfomanceManagerUse::where('user_id', $userd)->get();
        $add_perfoIdent=PerformanceIdentity::where('user_id', $userd)->get(); 
        $add_perfoIdent_id=PerformanceIdentity::where('user_id', $userd)->get();
		$emps=Employee::where('user_id', $userd)->first();
        
        return view('performance',compact('professional','emps','personal','specialInitiatives','comments_role','add_comments','add_comments_id','add_appraiseest','add_appraiseest_id','add_personalgoal','add_personalgoal_id','professional_achived','professional_forthcoming','training_requirements','general_comment','perfomancemanageruse','add_manager_id','add_perfoIdent','add_perfoIdent_id'));
		
    }
	
	public function add_ProfessionalExcellence(Request $request){
        $userd = Auth::user()->id;          
        $string_id = Employee::where('user_id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);              
        $test_usee= ProfessionalExcellence::where('user_id', $userd)->first();
        $prof_emp=ProfessionalExcellence::where('emp_id', $emp_id)->first();
         
		if(!empty($test_usee) && !empty($prof_emp)){   
        $professional= ProfessionalExcellence::where('user_id', $userd)->first();          
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
        $professional->user_id = $userd;
        $professional->emp_id = $emp_id;
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
	 
}
