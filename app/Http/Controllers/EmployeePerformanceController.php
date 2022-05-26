<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use App\Department;
use App\Designation;
use App\ProfessionalExcellence;
use App\SpecialInitiatives;
use App\PersonalExcellence;
use App\CommentsRole;
use App\AdditionCommentRole;
use App\AppraiseeStrength;
use App\PersonalGoal;
use App\Employee;
use App\EmployeeLeave;
use App\ProfessionalGoalsAchieved;
use App\ProfessionalGoalsForthcoming;
use App\TrainingRequirements;
use App\OtherGeneralComment;
use App\PerfomanceManagerUse;
use App\PerformanceIdentity;
use App\KeyprofessionalExcellences;
use App\User;
use Auth;
use App\Notification;
use App\Events\EmployeePerfomanceStatus;
use Illuminate\Support\Carbon;

class EmployeePerformanceController extends Controller
{
    public function get_employees(){
        $dep=Department::get();
        $des=Designation::get();
       // $des_man = 
        if(Auth::user()->role_id == 2 || Auth::user()->role_id==6
        ){$emps=Employee::where('man_id',Auth::id())->where('role_id', '!=',1)->get();}
        else{$emps=Employee::where('role_id', '!=',1)->get();}   
        $emp_id=Employee::get('id');		
        return view('/employees-performance',compact('dep','des','emps','emp_id'));
    }
    public function edit_employees($id)
	{   
		$emp_id = Employee::where('id',$id)->first();
		$emp_hrcomp = Employee::where('id',$id)->pluck('id')->first();		
        $userd = Auth::user()->id; 	
        $emps=Employee::where('id',$id)->first();        
        $professional=ProfessionalExcellence::where('emp_id', $id)->first();          
        $personal=PersonalExcellence::where('emp_id', $id)->first(); 
        $specialInitiatives=SpecialInitiatives::where('emp_id', $id)->get();
        $comments_role=CommentsRole::where('emp_id', $id)->get();
        $add_comments=AdditionCommentRole::where('emp_id', $id)->get()->toArray();
        $add_comments_id=AdditionCommentRole::where('emp_id', $id)->get();
        $add_appraiseest=AppraiseeStrength::where('emp_id', $id)->get()->toArray();	
        $add_appraiseest_id=AppraiseeStrength::where('emp_id', $id)->get();
        $add_personalgoal=PersonalGoal::where('emp_id', $id)->get()->toArray();	
        $add_personalgoal_id=PersonalGoal::where('emp_id', $id)->get();
        $professional_achived=ProfessionalGoalsAchieved::where('emp_id', $id)->get();
        $professional_forthcoming=ProfessionalGoalsForthcoming::where('emp_id', $id)->get();
        $training_requirements=TrainingRequirements::where('emp_id', $id)->get();
        $general_comment=OtherGeneralComment::where('emp_id', $id)->get();
        $perfomancemanageruse=PerfomanceManagerUse::where('emp_id', $id)->get();
        $add_perfoIdent=PerformanceIdentity::where('emp_id', $id)->get(); 
        $add_perfoIdent_man=PerformanceIdentity::where('emp_id', $id)->where('user_role','2')->get(); 
        $add_perfoIdent_employ=PerformanceIdentity::where('emp_id', $id)->where('user_role','3')->get(); 
		$manager_user = Employee::where('role_id',2)->orWhere('role_id',6)->orderby('role_id','DESC')->get();
        $prof_excel=KeyprofessionalExcellences::where('emp_id', $id)->first();
		$per_excel=PersonalExcellence::where('emp_id', $id)->first();   
		 
		return view('/edit-performance',compact('emp_id','professional','emps','personal','specialInitiatives','comments_role','add_comments','add_comments_id','add_appraiseest','add_appraiseest_id','add_personalgoal','add_personalgoal_id','professional_achived','professional_forthcoming','training_requirements','general_comment','perfomancemanageruse','add_perfoIdent','manager_user','prof_excel','add_perfoIdent_man','add_perfoIdent_employ','emp_hrcomp','per_excel'));
	}
	public function add_managerid_EmployeeBasicInfo(Request $request)
	{	$id = $request->id;
		$man_id=Employee::where('id',$id)->first(); 		
		if($man_id)
		{
			$emp_add= Employee::where('id', $id)->first();          
            $emp_add->man_id=$request->man_id;
            $emp_add->save();

            $leave_emp_add= EmployeeLeave::where('employee_id', $id)->first(); 
            if($leave_emp_add){    
            $leave_emp_add->manager_id=$request->man_id;
            $leave_emp_add->save();
            }
		}
		return back();
	}
    public function add_manager_ProfessionalExcellence(Request $request)
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
                $settings= KeyprofessionalExcellences::where('emp_id', $eid)->first();
                $settings->percentage_achieved_employee=json_encode($final_achieved);
                $settings->points_scored_employee=json_encode($final_scored);
                $settings->percentage_achieved_manager=json_encode($final_achieved_man);
                $settings->points_scored_manager=json_encode($final_scored_man);
                $settings->total_achieved_employee=$request->total_achieved_employee;
                $settings->total_scored_employee=$request->total_scored_employee;
                $settings->total_achieved_manager=$request->total_achieved_manager;
                $settings->total_scored_manager=$request->total_scored_manager;
                $settings->save();
				
				$settings=Employee::where('id',$eid)->first();    
				$settings->complete_professional_excellence = 1; 
				$settings->save();
        }
        else{
                $settings = new KeyprofessionalExcellences();
                $settings->user_id = Auth::user()->id;
                $settings->emp_id = $eid;
                $settings->percentage_achieved_employee=json_encode($final_achieved);
                $settings->points_scored_employee=json_encode($final_scored);
                $settings->percentage_achieved_manager=json_encode($final_achieved_man);
                $settings->points_scored_manager=json_encode($final_scored_man);
                $settings->total_achieved_employee=$request->total_achieved_employee;
                $settings->total_scored_employee=$request->total_scored_employee;
                $settings->total_achieved_manager=$request->total_achieved_manager;
                $settings->total_scored_manager=$request->total_scored_manager;
                $settings->save();
				 
				$settings=Employee::where('id',$eid)->first();    
				$settings->complete_professional_excellence = 1; 
				$settings->save();
             
        }                 
    
        return redirect("/edit-performance/{$eid}/#professionalexcel"); 
	   
    }
    public function add_manager_PersonalExcellence(Request $request)
    {
        /* $userd = Auth::user()->id;  
        $id = $request->getid;
        $add_empid = $request->empid;
         
		if(!empty($id)){
            $personal= PersonalExcellence::where('emp_id', $id)->first();          
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
            $personal->emp_id = $add_empid;
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
		} */
		
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
            //$final_scored[$val]['points_scored_employee']=$request->points_scored_employee[$i]; 
            $final_achieved_man[$val]['percentage_achieved_manager']=$request->percentage_achieved_manager[$i];
            //$final_scored_man[$val]['points_scored_manager']=$request->points_scored_manager[$i];          
            $i++;
           }
        }
        if($settings){
                $settings= PersonalExcellence::where('emp_id', $eid)->first();
                $settings->percentage_achieved_employee=json_encode($final_achieved);
                //$settings->points_scored_employee=json_encode($final_scored);
                $settings->percentage_achieved_manager=json_encode($final_achieved_man);
                //$settings->points_scored_manager=json_encode($final_scored_man);
                $settings->total_score_employee=$request->total_score_employee;
                $settings->total_score_manager=$request->total_score_manager;
                $settings->total_percentage_employee=$request->total_percentage_employee;
                $settings->total_percentage_manager=$request->total_percentage_manager;
                $settings->save();
				
				$settings=Employee::where('id',$eid)->first();    
				$settings->complete_personal_excellence = 1; 
				$settings->save();
             
        }
        else{
                $settings = new PersonalExcellence();
                $settings->user_id = Auth::user()->id;
                $settings->emp_id = $eid;
                $settings->percentage_achieved_employee=json_encode($final_achieved);
               // $settings->points_scored_employee=json_encode($final_scored);
                $settings->percentage_achieved_manager=json_encode($final_achieved_man);
                //$settings->points_scored_manager=json_encode($final_scored_man);
                $settings->total_score_employee=$request->total_score_employee;
                $settings->total_score_manager=$request->total_score_manager;
                $settings->total_percentage_employee=$request->total_percentage_employee;
                $settings->total_percentage_manager=$request->total_percentage_manager;
                $settings->save();
				
				$settings=Employee::where('id',$eid)->first();    
				$settings->complete_personal_excellence = 1; 
				$settings->save();
             
        }
		
        return redirect("/edit-performance/{$eid}/#PersonalExcellence");
	   
    }
    public function add_manager_SpecialInitiatives(Request $request)
    {
        $data = $request->all();
        $userd = Auth::user()->id;  
        $emp_text = $request->DynamicTextBoxemp;
        $manager_text = $request->DynamicTextBoxman;
        $id = $request->getid;
        $id_arry = $request->getid_arry;
        $add_empid = $request->empid;
         
        foreach($emp_text as $key => $input) 
        {
            if($emp_text[$key] || $manager_text[$key])
            { 
                if(isset($id_arry[$key]) && !empty($id))
                {
                    $score= SpecialInitiatives::where('id',$id_arry[$key])->first();  
                    $score->by_employee = $emp_text[$key] ? $emp_text[$key] : ''; 
                    $score->managers_comment = $manager_text[$key] ? $manager_text[$key] : ''; 
                    $score->save();
					
					$settings=Employee::where('id',$add_empid)->first();    
					$settings->complete_special_initiative = 1; 
					$settings->save();
                }		
                else 
                { 
                    $scores = new SpecialInitiatives();
                    $scores->emp_id = $add_empid;
                    $scores->by_employee = $emp_text[$key] ? $emp_text[$key] : '';  
                    $scores->managers_comment = $manager_text[$key] ? $manager_text[$key] : '';  
                    $scores->save();   

					$settings=Employee::where('id',$add_empid)->first();    
					$settings->complete_special_initiative = 1; 
					$settings->save();
                }
            }
        }
        return redirect("/edit-performance/{$add_empid}/#specialInitiatives");	   
    }
    public function add_manager_CommentsRole(Request $request)
    {
        $data = $request->all();
        $userd = Auth::user()->id;  
        $emp_text = $request->DynamicTextBoxemp;
        $manager_text = $request->DynamicTextBoxman;
        $id_arry = $request->getid_arry;
        $id = $request->getid;       
        $add_empid = $request->empid;
         
        foreach($emp_text as $key => $input) 
        {
            if($emp_text[$key] || $manager_text[$key])
            { 
                if(isset($id_arry[$key]) && !empty($id))
                {
                    $score= CommentsRole::where('id',$id_arry[$key])->first();  
                    $score->by_employee = $emp_text[$key] ? $emp_text[$key] : ''; 
                    $score->managers_comment = $manager_text[$key] ? $manager_text[$key] : ''; 
                    $score->save();
                }		
                else 
                { 
                    $scores = new CommentsRole();
                    $scores->emp_id = $add_empid;
                    $scores->by_employee = $emp_text[$key] ? $emp_text[$key] : '';  
                    $scores->managers_comment = $manager_text[$key] ? $manager_text[$key] : '';  
                    $scores->save();         	  
                }
            }
        }
        return redirect("/edit-performance/{$add_empid}/#CommentsRole");		   
    }
    public function add_manager_AdditionCommentRole(Request $request)
    {
        $data = $request->all();
        $userd = Auth::user()->id;  
        $strengths = $request->strengths;
        $areas_imp = $request->areas_improvement;
        $id_arry = $request->getid_arry;
        $id = $request->getid;       
        $add_empid = $request->empid;
         
        foreach($strengths as $key => $input) 
        {
            if($strengths[$key] || $areas_imp[$key])
            { 
                if(isset($id_arry[$key]) && !empty($id))
                {
                    $score= AdditionCommentRole::where('id',$id_arry[$key])->first();  
                    $score->strengths = $strengths[$key] ? $strengths[$key] : ''; 
                    $score->areas_improvement = $areas_imp[$key] ? $areas_imp[$key] : ''; 
                    $score->save();
                }		
                else 
                { 
                    $scores = new AdditionCommentRole();
                    $scores->emp_id = $add_empid;
                    $scores->strengths = $strengths[$key] ? $strengths[$key] : '';  
                    $scores->areas_improvement = $areas_imp[$key] ? $areas_imp[$key] : '';  
                    $scores->save();         	  
                }
            }
        }
        return redirect("/edit-performance/{$add_empid}/#AdditionCommentRole");   
    }
    public function add_manager_AppraiseeStrength(Request $request)
    {
        $data = $request->all();
        $userd = Auth::user()->id;  
        $strengths = $request->strengths;
        $areas_imp = $request->areas_improvement;
        $id_arry = $request->getid_arry;
        $id = $request->getid;       
        $add_empid = $request->empid;
         
        foreach($strengths as $key => $input) 
        {
            if($strengths[$key] || $areas_imp[$key])
            { 
                if(isset($id_arry[$key]) && !empty($id))
                {
                    $score= AppraiseeStrength::where('id',$id_arry[$key])->first();  
                    $score->strengths = $strengths[$key] ? $strengths[$key] : ''; 
                    $score->areas_improvement = $areas_imp[$key] ? $areas_imp[$key] : ''; 
                    $score->save();
					
					$settings=Employee::where('id',$add_empid)->first();    
					$settings->complete_appraisee_strength = 1; 
					$settings->save();					
                }		
                else 
                { 
                    $scores = new AppraiseeStrength();
                    $scores->emp_id = $add_empid;
                    $scores->strengths = $strengths[$key] ? $strengths[$key] : '';  
                    $scores->areas_improvement = $areas_imp[$key] ? $areas_imp[$key] : '';  
                    $scores->save();   
						
					$settings=Employee::where('id',$add_empid)->first();    
					$settings->complete_appraisee_strength = 1; 
					$settings->save();
                }
            }
        }
        return redirect("/edit-performance/{$add_empid}/#AppraiseeStrength");   
    }
    public function add_manager_PersonalGoal(Request $request)
    {
        $data = $request->all();
        $userd = Auth::user()->id;  
        $last_year = $request->goal_last_year;
        $current_year = $request->goal_current_year;
        $id_arry = $request->getid_arry;
        $id = $request->getid;       
        $add_empid = $request->empid;
         
        foreach($last_year as $key => $input) 
        {
            if($last_year[$key] || $current_year[$key])
            { 
                if(isset($id_arry[$key]) && !empty($id))
                {
                    $score= PersonalGoal::where('id',$id_arry[$key])->first();  
                    $score->goal_last_year = $last_year[$key] ? $last_year[$key] : '';  
                    $score->goal_current_year = $current_year[$key] ? $current_year[$key] : '';
                    $score->save();
                }		
                else 
                { 
                    $scores = new PersonalGoal();
                    $scores->emp_id = $add_empid;
                    $scores->goal_last_year = $last_year[$key] ? $last_year[$key] : ''; 
                    $scores->goal_current_year = $current_year[$key] ? $current_year[$key] : '';  
                    $scores->save();         	  
                }
            }
        }
        return redirect("/edit-performance/{$add_empid}/#PersonalGoal");   
    }
    public function add_manager_ProfessionalGoalsAchieved(Request $request)
    {
        $data = $request->all();
        $userd = Auth::user()->id;  
        $emp_text = $request->DynamicTextBoxemp;
        $manager_text = $request->DynamicTextBoxman;
        $id_arry = $request->getid_arry;
        $id = $request->getid;       
        $add_empid = $request->empid;
         
        foreach($emp_text as $key => $input) 
        {
            if($emp_text[$key] || $manager_text[$key])
            { 
                if(isset($id_arry[$key]) && !empty($id))
                {
                    $score= ProfessionalGoalsAchieved::where('id',$id_arry[$key])->first();  
                    $score->by_employee = $emp_text[$key] ? $emp_text[$key] : ''; 
                    $score->managers_comment = $manager_text[$key] ? $manager_text[$key] : ''; 
                    $score->save();
                }		
                else 
                { 
                    $scores = new ProfessionalGoalsAchieved();
                    $scores->emp_id = $add_empid;
                    $scores->by_employee = $emp_text[$key] ? $emp_text[$key] : '';  
                    $scores->managers_comment = $manager_text[$key] ? $manager_text[$key] : '';  
                    $scores->save();         	  
                }
            }
        }
        return redirect("/edit-performance/{$add_empid}/#ProfessionalAchived");   
    }
    public function add_manager_ProfessionalGoalsForthcoming(Request $request)
    {
        $data = $request->all();
        $userd = Auth::user()->id;  
        $emp_text = $request->DynamicTextBoxemp;
        $manager_text = $request->DynamicTextBoxman;
        $id_arry = $request->getid_arry;
        $id = $request->getid;       
        $add_empid = $request->empid;
         
        foreach($emp_text as $key => $input) 
        {
            if($emp_text[$key] || $manager_text[$key])
            { 
                if(isset($id_arry[$key]) && !empty($id))
                {
                    $score= ProfessionalGoalsForthcoming::where('id',$id_arry[$key])->first();  
                    $score->by_employee = $emp_text[$key] ? $emp_text[$key] : ''; 
                    $score->managers_comment = $manager_text[$key] ? $manager_text[$key] : ''; 
                    $score->save();
                }		
                else 
                { 
                    $scores = new ProfessionalGoalsForthcoming();
                    $scores->emp_id = $add_empid;
                    $scores->by_employee = $emp_text[$key] ? $emp_text[$key] : '';  
                    $scores->managers_comment = $manager_text[$key] ? $manager_text[$key] : '';  
                    $scores->save();         	  
                }
            }
        }
        return redirect("/edit-performance/{$add_empid}/#ProfForthcoming");   
    }
    public function add_manager_TrainingRequirements(Request $request)
    {
        $data = $request->all();
        $userd = Auth::user()->id;  
        $emp_text = $request->DynamicTextBoxemp;
        $manager_text = $request->DynamicTextBoxman;
        $id_arry = $request->getid_arry;
        $id = $request->getid;       
        $add_empid = $request->empid;
         
        foreach($emp_text as $key => $input) 
        {
            if($emp_text[$key] || $manager_text[$key])
            { 
                if(isset($id_arry[$key]) && !empty($id))
                {
                    $score= TrainingRequirements::where('id',$id_arry[$key])->first();  
                    $score->by_employee = $emp_text[$key] ? $emp_text[$key] : ''; 
                    $score->managers_comment = $manager_text[$key] ? $manager_text[$key] : ''; 
                    $score->save();
                }		
                else 
                { 
                    $scores = new TrainingRequirements();
                    $scores->emp_id = $add_empid;
                    $scores->by_employee = $emp_text[$key] ? $emp_text[$key] : '';  
                    $scores->managers_comment = $manager_text[$key] ? $manager_text[$key] : '';  
                    $scores->save();         	  
                }
            }
        }
        return redirect("/edit-performance/{$add_empid}/#TrainingRequirement");   
    }
    public function add_manager_OtherGeneralComment(Request $request)
    {
        $data = $request->all();
        $userd = Auth::user()->id;  
        $emp_text = $request->DynamicTextBoxemp;
        $manager_text = $request->DynamicTextBoxman;
        $id_arry = $request->getid_arry;
        $id = $request->getid;       
        $add_empid = $request->empid;
         
        foreach($emp_text as $key => $input) 
        {
            if($emp_text[$key] || $manager_text[$key])
            { 
                if(isset($id_arry[$key]) && !empty($id))
                {
                    $score= OtherGeneralComment::where('id',$id_arry[$key])->first();  
                    $score->employee_comments = $emp_text[$key] ? $emp_text[$key] : ''; 
                    $score->managers_comments = $manager_text[$key] ? $manager_text[$key] : ''; 
                    $score->save();
					
					$settings=Employee::where('id',$add_empid)->first();    
					$settings->complete_other_general_comments = 1; 
					$settings->save();
                }		
                else 
                { 
                    $scores = new OtherGeneralComment();
                    $scores->emp_id = $add_empid;
                    $scores->employee_comments = $emp_text[$key] ? $emp_text[$key] : '';  
                    $scores->managers_comments = $manager_text[$key] ? $manager_text[$key] : ''; 
                    $scores->save();   

					$settings=Employee::where('id',$add_empid)->first();    
					$settings->complete_other_general_comments = 1; 
					$settings->save();	
                }
            }
        }
        return redirect("/edit-performance/{$add_empid}/#GeneralComment");   
    }
    public function add_manager_PerfomanceManagerUse(Request $request)
    {
        $data = $request->all();
        $userd = Auth::user()->id;  
        $issues = $request->issues;     
        $select_val = $request->select_option;
        $details = $request->yes_details;
        $id_arry = $request->getid_arry;
        $id = $request->getid;       
        $add_empid = $request->empid;
         
        foreach($select_val as $key => $input) 
        {
            if($select_val[$key] || $details[$key])
            { 
                if(isset($id_arry[$key]) && !empty($id))
                {
                    $score= PerfomanceManagerUse::where('id',$id_arry[$key])->first();
                    $score->select_option = $select_val[$key] ? $select_val[$key] : ''; 
                    $score->yes_details = $details[$key] ? $details[$key] : ''; 
                    $score->save();
					
					$settings=Employee::where('id',$add_empid)->first();    
					$settings->complete_managers_use = 1; 
					$settings->save();
                }		
                else 
                { 
                    $scores = new PerfomanceManagerUse();
                    $scores->emp_id = $add_empid;
                    $scores->issues = $issues[$key] ? $issues[$key] : '';
                    $scores->select_option = $select_val[$key] ? $select_val[$key] : ''; 
                    $scores->yes_details = $details[$key] ? $details[$key] : '';   
                    $scores->save();  

					$settings=Employee::where('id',$add_empid)->first();    
					$settings->complete_managers_use = 1; 
					$settings->save();
                }
            }
        }
        return redirect("/edit-performance/{$add_empid}/#PerfomanceManagerUse"); 	   
    }
    public function add_manager_PerformanceIdentity(Request $request)
    {
        $data = $request->all();
        $userd = Auth::user()->id;  
        $user_role = $request->user_role;     
        $name = $request->name;
        $signature = $request->signature;
        $date =  $request->date;
        $id_arry = $request->getid_arry;
        $id = $request->getid;       
        $add_empid = $request->empid;
          
        foreach($name as $key => $input) 
        {
            if($name[$key] || $signature[$key] || $date[$key])
            { 
                if(isset($id_arry[$key]) && !empty($id))
                {   
                    $score= PerformanceIdentity::where('id',$id_arry[$key])->first();  //dd($score);
                     
                    $score->name = $name[$key] ? $name[$key] : ''; 
                    $score->signature = $signature[$key] ? $signature[$key] : '';
                    $score->date = Carbon::createFromFormat('d/m/Y', $date[$key])->format('Y-m-d') ? Carbon::createFromFormat('d/m/Y', $date[$key])->format('Y-m-d') : '';  
                    $score->save();
                }		
                else 
                {  
                    $scores = new PerformanceIdentity();
                    $scores->emp_id = $add_empid;
                    $scores->user_id = $userd;
                    $scores->user_role = $user_role[$key] ? $user_role[$key] : '';  
                    $scores->name = $name[$key] ? $name[$key] : '';
                    $scores->signature = $signature[$key] ? $signature[$key] : '';
                    $scores->date = Carbon::createFromFormat('d/m/Y', $date[$key])->format('Y-m-d') ? Carbon::createFromFormat('d/m/Y', $date[$key])->format('Y-m-d') : ''; 
                    
                    $scores->save();         	  
                }
            }
        }
        return redirect("/edit-performance/{$add_empid}/#PerfomanceIdentitie");  
    }
    public function search_employee_Perfomance(Request $request){
        $dep=Department::get();
        $des=Designation::get();
        $emp= Employee::where('role_id','!=',1);
        $search_employee_id=$request->search_employee_id;
        $search_name=$request->search_name;
        $search_designation=$request->search_designation;
        if($search_employee_id!=""){
            $emp=$emp->where('employee_id',$search_employee_id);
        }
        if($search_name!=""){
            $emp=$emp->where('first_name',$search_name);
        }
        if($search_designation!=""){
            $emp=$emp->where('designation_id',$search_designation);
        }
        if(Auth::user()->role_id==2 || Auth::user()->role_id==6){
        $emp->where('man_id',Auth::id())->get();
        }
        $emps=$emp->get();
         
        return view('employees-performance',compact('dep','des','emps',
        'search_employee_id','search_name','search_designation'));
    }
    public function add_Perfomance_status_user(Request $request)
    {   
        $userd = Auth::user()->id; 
		 
        $status=Employee::where('id',$request->empid)->first();             
        $status->perfomance_status=$request->perfomance_status;
        $status->performance_completed_by=$request->user_id;
        $status->save();

        $message='Hi, Your Employee Performance Status has been Complete';
        Notification::create(['employeeid' => $status->id, 'message' => $message]);
        event(new EmployeePerfomanceStatus($message,$status->id));
        return back();
    }
}
