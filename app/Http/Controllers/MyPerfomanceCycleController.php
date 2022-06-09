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
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use DB;

class MyPerfomanceCycleController extends Controller
{	
	public function my_performance_data($id){
		$urlid = $id;
		$userd = Auth::user()->id; 	
        $dep=Department::get();
        $des=Designation::get(); 
        $emps=Employee::where('id',$id)->where('role_id', '!=',1)->get();  
        $emp_id=Employee::get('id');	 
		$professional_emp =KeyprofessionalExcellences::where('emp_id',$id)->get();   
		$personal_emp =PersonalExcellence::where('emp_id',$id)->get();   
		$special_emp =SpecialInitiatives::where('emp_id',$id)->get();   
		$comment_emp =OtherGeneralComment::where('emp_id',$id)->get();   
		$appraisee_emp =AppraiseeStrength::where('emp_id',$id)->get();   
		
        return view('my-performance',compact('dep','des','emps','emp_id','professional_emp','personal_emp','special_emp','comment_emp','urlid','appraisee_emp'));
    }
	
	public function add_myperformance_datewise($id)
	{    
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
		/**/
		$emps=Employee::where('id', $userd)->first();    
		
		$emps_prof1= DB::table('employees as emp')
					->join('keyprofessional_excellences as prof', 'emp.id', '=', 'prof.emp_id')
					->join('new_personal_behavioral_excellence as personal', 'emp.id', '=', 'personal.emp_id')
					->join('special_initiatives as special', 'emp.id', '=', 'special.emp_id')
					->join('other_general_comments as comment', 'emp.id', '=', 'comment.emp_id') 
					->get();  
		
		DB::table('keyprofessional_excellences')->leftJoin('employees', 'employees.id', '=', 'keyprofessional_excellences.emp_id')->where('employees.id', $userd)->where('keyprofessional_excellences.emp_id', $userd)->get();       
		 
		
        $per_excel=PersonalExcellence::where('emp_id', $userd)->first();
		$keyprofessional=KeyprofessionalExcellences::where('emp_id', $id)->pluck('id')->first(); 
		$prof_excel=KeyprofessionalExcellences::where('id',$keyprofessional)->first();
		//dd($keyprofessional);
		
        return view('add-myperformance',compact('professional','emps','personal','specialInitiatives','comments_role','add_comments','add_comments_id','add_appraiseest','add_appraiseest_id','add_personalgoal','add_personalgoal_id','professional_achived','professional_forthcoming','training_requirements','general_comment','perfomancemanageruse','add_manager_id','add_perfoIdent','add_perfoIdent_id','prof_excel','add_perfoIdent_man','add_perfoIdent_employ','per_excel','emps_prof1','keyprofessional'));
	}
	
	 public function myperformance_manager_ProfessionalExcellence(Request $request)
    {        
        $eid = $request->empid;         
        $settings=KeyprofessionalExcellences::where('emp_id',$eid)->first();  
        $rate_arr=array();
        $final_achieved=array(); 
        $final_achieved_man=array(); 
        array_push($rate_arr,$request->key_no);
        $rate_count=count($rate_arr);
        if(!empty($rate_arr)){
            $i=0;
            foreach($request->key_no as $key => $val){
            $final_achieved[$val]['percentage_achieved_employee']=$request->percentage_achieved_employee[$i];
            $final_achieved_man[$val]['percentage_achieved_manager']=$request->percentage_achieved_manager[$i];
               
            $i++;
           }
        } 
                $settings = new KeyprofessionalExcellences();
                $settings->user_id = Auth::user()->id;
                $settings->emp_id = $eid;
                $settings->percentage_achieved_employee=json_encode($final_achieved);                
                $settings->percentage_achieved_manager=json_encode($final_achieved_man);                
                $settings->total_achieved_employee=$request->total_achieved_employee;
                $settings->total_scored_employee=$request->total_scored_employee;
                $settings->total_achieved_manager=$request->total_achieved_manager;
                $settings->total_scored_manager=$request->total_scored_manager;
                $settings->perfomance_date=Carbon::createFromFormat('m/d/Y', $request->perfomance_date)->format('Y-m-d');
				$settings->complete_perfomance_by_emp = 1;   
                $settings->save(); 
    
        return back();  
    }
	
	public function myperformance_PersonalExcellence(Request $request)
    {  
		$eid = $request->empid;         
        $settings=PersonalExcellence::where('emp_id',$eid)->first();  
        $rate_arr=array();
        $final_achieved=array(); 
        $final_achieved_man=array(); 
        array_push($rate_arr,$request->key_no);
        $rate_count=count($rate_arr);
        if(!empty($rate_arr)){
            $i=0;
            foreach($request->key_no as $key => $val){
            $final_achieved[$val]['percentage_achieved_employee']=$request->percentage_achieved_employee[$i]; 
            $final_achieved_man[$val]['percentage_achieved_manager']=$request->percentage_achieved_manager[$i]; 
            $i++;
           }
        }
        
                $settings = new PersonalExcellence();
                $settings->user_id = Auth::user()->id;
                $settings->emp_id = $eid;
                $settings->percentage_achieved_employee=json_encode($final_achieved); 
                $settings->percentage_achieved_manager=json_encode($final_achieved_man); 
                $settings->total_score_employee=$request->total_score_employee;
                $settings->total_score_manager=$request->total_score_manager;
                $settings->total_percentage_employee=$request->total_percentage_employee;
                $settings->total_percentage_manager=$request->total_percentage_manager;
				$settings->perfomance_date=Carbon::createFromFormat('m/d/Y', $request->perfomance_date)->format('Y-m-d');
				$settings->complete_perfomance_by_emp = 1; 
                $settings->save();
				 
        return back(); 
    }
	
	 public function myperformance_SpecialInitiatives(Request $request)
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
                 
                    $scores = new SpecialInitiatives();
                    $scores->emp_id = $add_empid;
                    $scores->by_employee = $emp_text[$key] ? $emp_text[$key] : '';  
                    $scores->managers_comment = $manager_text[$key] ? $manager_text[$key] : '';  
					$scores->perfomance_date=Carbon::createFromFormat('m/d/Y', $request->perfomance_date)->format('Y-m-d');
					$scores->complete_perfomance_by_emp = 1; 
                    $scores->save();   

					 
                
            }
        }
        return back();	   
    }
	
	public function myperformance_OtherGeneralComment(Request $request)
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
				$scores = new OtherGeneralComment();
				$scores->emp_id = $add_empid;
				$scores->employee_comments = $emp_text[$key] ? $emp_text[$key] : '';  
				$scores->managers_comments = $manager_text[$key] ? $manager_text[$key] : ''; 
				$scores->perfomance_date=Carbon::createFromFormat('m/d/Y', $request->perfomance_date)->format('Y-m-d');
				$scores->complete_perfomance_by_emp = 1; 
				$scores->save();   
 
            }
        }
        return back();   
    } 
}