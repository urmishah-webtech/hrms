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
		
		$manger_emp_icon = DB::table('employees')->leftJoin('keyprofessional_excellences as ke','employees.id','ke.emp_id')->
        leftJoin('new_personal_behavioral_excellence as be','employees.id','be.emp_id')->
        leftJoin('special_initiatives as si','employees.id','si.emp_id')->
        leftJoin('appraisee_strengths as as','employees.id','as.emp_id')->
        leftJoin('other_general_comments as gc','employees.id','gc.emp_id')
        ->where('ke.complete_perfomance_by_manager',0)->where('be.complete_perfomance_by_manager',0)->
        where('si.complete_perfomance_by_manager',0)->where('gc.complete_perfomance_by_manager',0)->where('employees.id','be.emp_id')->select('employees.id','employees.first_name','employees.last_name','ke.perfomance_date')->first();  
		 	
        return view('/employees-performance',compact('dep','des','emps','emp_id','manger_emp_icon'));
    }
	
    public function edit_employees($id,$perfomance_date)
	{    
		$url_pdate = $perfomance_date;
		$professional_id = KeyprofessionalExcellences::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->pluck('id')->first();  
		$personal_id = PersonalExcellence::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->pluck('id')->first();   
		$appraisee_id = AppraiseeStrength::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->pluck('id')->first();    
		$comment_id = OtherGeneralComment::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->pluck('id')->first(); 
		$emp_id = Employee::where('id',$id)->first();
		$date_professional = KeyprofessionalExcellences::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->first(); 
		$date_Personal = PersonalExcellence::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->first(); 
		$date_Special = SpecialInitiatives::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->first(); 
		$date_Appraisee = AppraiseeStrength::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->first(); 
		$date_Comment = OtherGeneralComment::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->first(); 
		$emp_hrcomp = Employee::where('id',$id)->pluck('id')->first();		
        $userd = Auth::user()->id; 	
        $emps=Employee::where('id',$id)->first();        
        $professional=ProfessionalExcellence::where('emp_id', $id)->first();          
        $personal=PersonalExcellence::where('emp_id', $id)->where('perfomance_date', $perfomance_date)->first(); 
        $specialInitiatives=SpecialInitiatives::where('emp_id', $id)->where('perfomance_date',$perfomance_date)->get();  
        $comments_role=CommentsRole::where('emp_id', $id)->get();
        $add_comments=AdditionCommentRole::where('emp_id', $id)->get()->toArray();
        $add_comments_id=AdditionCommentRole::where('emp_id', $id)->get();
        $add_appraiseest=AppraiseeStrength::where('emp_id', $id)->where('perfomance_date',$perfomance_date)->get()->toArray();	
        $add_appraiseest_id=AppraiseeStrength::where('emp_id', $id)->where('perfomance_date',$perfomance_date)->get();
        $add_personalgoal=PersonalGoal::where('emp_id', $id)->get()->toArray();	
        $add_personalgoal_id=PersonalGoal::where('emp_id', $id)->get();
        $professional_achived=ProfessionalGoalsAchieved::where('emp_id', $id)->get();
        $professional_forthcoming=ProfessionalGoalsForthcoming::where('emp_id', $id)->get();
        $training_requirements=TrainingRequirements::where('emp_id', $id)->get();
        $general_comment=OtherGeneralComment::where('emp_id', $id)->where('perfomance_date',$perfomance_date)->get();
        $perfomancemanageruse=PerfomanceManagerUse::where('emp_id', $id)->get();
        $add_perfoIdent=PerformanceIdentity::where('emp_id', $id)->get(); 
        $add_perfoIdent_man=PerformanceIdentity::where('emp_id', $id)->where('user_role','2')->get(); 
        $add_perfoIdent_employ=PerformanceIdentity::where('emp_id', $id)->where('user_role','3')->get(); 
		$manager_user = Employee::where('role_id',2)->orWhere('role_id',6)->orderby('role_id','DESC')->get();
        $prof_excel=KeyprofessionalExcellences::where('emp_id', $id)->where('perfomance_date',$perfomance_date)->first();
		$per_excel=PersonalExcellence::where('emp_id', $id)->where('perfomance_date',$perfomance_date)->first();   
		   
		return view('/edit-performance',compact('emp_id','professional','emps','personal','specialInitiatives','comments_role','add_comments','add_comments_id','add_appraiseest','add_appraiseest_id','add_personalgoal','add_personalgoal_id','professional_achived','professional_forthcoming','training_requirements','general_comment','perfomancemanageruse','add_perfoIdent','manager_user','prof_excel','add_perfoIdent_man','add_perfoIdent_employ','emp_hrcomp','per_excel','date_professional','date_Personal','date_Special','date_Comment','date_Appraisee','url_pdate','professional_id','personal_id','comment_id','appraisee_id'));
	}
	
	public function edit_employees_view($id,$perfomance_date)
	{    
		$url_pdate = $perfomance_date;
		$professional_id = KeyprofessionalExcellences::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->pluck('id')->first();  
		$personal_id = PersonalExcellence::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->pluck('id')->first();   
		$appraisee_id = AppraiseeStrength::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->pluck('id')->first();    
		$comment_id = OtherGeneralComment::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->pluck('id')->first(); 
		$emp_id = Employee::where('id',$id)->first();
		$date_professional = KeyprofessionalExcellences::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->first(); 
		$date_Personal = PersonalExcellence::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->first(); 
		$date_Special = SpecialInitiatives::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->first(); 
		$date_Appraisee = AppraiseeStrength::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->first(); 
		$date_Comment = OtherGeneralComment::where('emp_id',$id)->where('perfomance_date', $perfomance_date)->first(); 
		$emp_hrcomp = Employee::where('id',$id)->pluck('id')->first();		
        $userd = Auth::user()->id; 	
        $emps=Employee::where('id',$id)->first();        
        $professional=ProfessionalExcellence::where('emp_id', $id)->first();          
        $personal=PersonalExcellence::where('emp_id', $id)->where('perfomance_date', $perfomance_date)->first(); 
        $specialInitiatives=SpecialInitiatives::where('emp_id', $id)->where('perfomance_date',$perfomance_date)->get();  
        $comments_role=CommentsRole::where('emp_id', $id)->get();
        $add_comments=AdditionCommentRole::where('emp_id', $id)->get()->toArray();
        $add_comments_id=AdditionCommentRole::where('emp_id', $id)->get();
        $add_appraiseest=AppraiseeStrength::where('emp_id', $id)->where('perfomance_date',$perfomance_date)->get()->toArray();	
        $add_appraiseest_id=AppraiseeStrength::where('emp_id', $id)->where('perfomance_date',$perfomance_date)->get();
        $add_personalgoal=PersonalGoal::where('emp_id', $id)->get()->toArray();	
        $add_personalgoal_id=PersonalGoal::where('emp_id', $id)->get();
        $professional_achived=ProfessionalGoalsAchieved::where('emp_id', $id)->get();
        $professional_forthcoming=ProfessionalGoalsForthcoming::where('emp_id', $id)->get();
        $training_requirements=TrainingRequirements::where('emp_id', $id)->get();
        $general_comment=OtherGeneralComment::where('emp_id', $id)->where('perfomance_date',$perfomance_date)->get();
        $perfomancemanageruse=PerfomanceManagerUse::where('emp_id', $id)->get();
        $add_perfoIdent=PerformanceIdentity::where('emp_id', $id)->get(); 
        $add_perfoIdent_man=PerformanceIdentity::where('emp_id', $id)->where('user_role','2')->get(); 
        $add_perfoIdent_employ=PerformanceIdentity::where('emp_id', $id)->where('user_role','3')->get(); 
		$manager_user = Employee::where('role_id',2)->orWhere('role_id',6)->orderby('role_id','DESC')->get();
        $prof_excel=KeyprofessionalExcellences::where('emp_id', $id)->where('perfomance_date',$perfomance_date)->first();
		$per_excel=PersonalExcellence::where('emp_id', $id)->where('perfomance_date',$perfomance_date)->first();   
		   
		return view('/edit-performance-view',compact('emp_id','professional','emps','personal','specialInitiatives','comments_role','add_comments','add_comments_id','add_appraiseest','add_appraiseest_id','add_personalgoal','add_personalgoal_id','professional_achived','professional_forthcoming','training_requirements','general_comment','perfomancemanageruse','add_perfoIdent','manager_user','prof_excel','add_perfoIdent_man','add_perfoIdent_employ','emp_hrcomp','per_excel','date_professional','date_Personal','date_Special','date_Comment','date_Appraisee','url_pdate','professional_id','personal_id','comment_id','appraisee_id'));
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
		$pri_id = $request->professional_id;  
        $eid = $request->empid;     
		$perfomance_date = $request->perfomance_date;  
        $settings=KeyprofessionalExcellences::where('id',$pri_id)->where('emp_id',$eid)->first();  
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
        if($settings){  
                $settings= KeyprofessionalExcellences::where('id',$pri_id)->first();
                $settings->percentage_achieved_employee=json_encode($final_achieved);              
                $settings->percentage_achieved_manager=json_encode($final_achieved_man);               
                $settings->total_achieved_employee=$request->total_achieved_employee;
                $settings->total_scored_employee=$request->total_scored_employee;
                $settings->total_achieved_manager=$request->total_achieved_manager;
                $settings->total_scored_manager=$request->total_scored_manager;
				$settings->perfomance_date=Carbon::createFromFormat('Y-m-d', $request->perfomance_date)->format('Y-m-d');
				if($settings->complete_perfomance_by_emp != 1){
				$settings->complete_perfomance_by_emp=$request->complete_perfomance_by_emp;
				} 
				if($settings->complete_perfomance_by_manager != 1){
				$settings->complete_perfomance_by_manager=$request->complete_perfomance_by_manager;
				}
                $settings->save();
				 
        }
        else{ 
                $settings = new KeyprofessionalExcellences();
                $settings->user_id = Auth::user()->id;
                $settings->emp_id = $eid;
                $settings->percentage_achieved_employee=json_encode($final_achieved);                
                $settings->percentage_achieved_manager=json_encode($final_achieved_man);                
                $settings->total_achieved_employee=$request->total_achieved_employee;
                $settings->total_scored_employee=$request->total_scored_employee;
                $settings->total_achieved_manager=$request->total_achieved_manager;
                $settings->total_scored_manager=$request->total_scored_manager;
				$settings->perfomance_date=Carbon::createFromFormat('Y-m-d', $request->perfomance_date)->format('Y-m-d');
				if($settings->complete_perfomance_by_emp != 1){
				$settings->complete_perfomance_by_emp=$request->complete_perfomance_by_emp;
				} 
				if($settings->complete_perfomance_by_manager != 1){
				$settings->complete_perfomance_by_manager=$request->complete_perfomance_by_manager;
				}				 
                $settings->save(); 
             
        }                 
		  
        return redirect('/edit-performance/'.$request->empid.'/'.$perfomance_date.'/#professionalexcel_next');
	   
    }
    public function add_manager_PersonalExcellence(Request $request)
    { 
		$pri_id = $request->personal_id;  
		$eid = $request->empid;         
        $settings=PersonalExcellence::where('id',$pri_id)->where('emp_id',$eid)->first();  
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
        if($settings){  
                $settings= PersonalExcellence::where('id',$pri_id)->first();
                $settings->percentage_achieved_employee=json_encode($final_achieved); 
                $settings->percentage_achieved_manager=json_encode($final_achieved_man); 
                $settings->total_score_employee=$request->total_score_employee;
                $settings->total_score_manager=$request->total_score_manager;
                $settings->total_percentage_employee=$request->total_percentage_employee;
                $settings->total_percentage_manager=$request->total_percentage_manager;
				$settings->perfomance_date=Carbon::createFromFormat('Y-m-d', $request->perfomance_date)->format('Y-m-d');
				if($settings->complete_perfomance_by_emp != 1){
				$settings->complete_perfomance_by_emp=$request->complete_perfomance_by_emp;
				} 
				if($settings->complete_perfomance_by_manager != 1){
				$settings->complete_perfomance_by_manager=$request->complete_perfomance_by_manager;
				}  
                $settings->save(); 
        }
        else{
                $settings = new PersonalExcellence();
                $settings->user_id = Auth::user()->id;
                $settings->emp_id = $eid;
                $settings->percentage_achieved_employee=json_encode($final_achieved); 
                $settings->percentage_achieved_manager=json_encode($final_achieved_man); 
                $settings->total_score_employee=$request->total_score_employee;
                $settings->total_score_manager=$request->total_score_manager;
                $settings->total_percentage_employee=$request->total_percentage_employee;
                $settings->total_percentage_manager=$request->total_percentage_manager;
				$settings->perfomance_date=Carbon::createFromFormat('Y-m-d', $request->perfomance_date)->format('Y-m-d');
				if($settings->complete_perfomance_by_emp != 1){
				$settings->complete_perfomance_by_emp=$request->complete_perfomance_by_emp;
				} 
				if($settings->complete_perfomance_by_manager != 1){
				$settings->complete_perfomance_by_manager=$request->complete_perfomance_by_manager;
				}
                $settings->save(); 
        }
		 
        return redirect('/edit-performance/'.$request->empid.'/'.$request->perfomance_date.'/#personal_Behavioralexce_next');
	   
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
					$score->perfomance_date=Carbon::createFromFormat('Y-m-d', $request->perfomance_date)->format('Y-m-d'); 
					if($score->complete_perfomance_by_emp != 1){
					$score->complete_perfomance_by_emp=$request->complete_perfomance_by_emp;
					} 
					if($score->complete_perfomance_by_manager != 1){
					$score->complete_perfomance_by_manager=$request->complete_perfomance_by_manager;
					}	
					$score->save(); 
					}		
                else 
                { 
                    $scores = new SpecialInitiatives();
                    $scores->emp_id = $add_empid;
                    $scores->by_employee = $emp_text[$key] ? $emp_text[$key] : '';  
                    $scores->managers_comment = $manager_text[$key] ? $manager_text[$key] : '';  
					$scores->perfomance_date=Carbon::createFromFormat('Y-m-d', $request->perfomance_date)->format('Y-m-d');
					if($scores->complete_perfomance_by_emp != 1){
					$scores->complete_perfomance_by_emp=$request->complete_perfomance_by_emp;
					} 
					if($scores->complete_perfomance_by_manager != 1){
					$scores->complete_perfomance_by_manager=$request->complete_perfomance_by_manager;
					}
                    $scores->save();    
                }
            }
        }
        return redirect('/edit-performance/'.$request->empid.'/'.$request->perfomance_date.'/#specialInitiatives_next');	   
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
					$score->perfomance_date=Carbon::createFromFormat('Y-m-d', $request->perfomance_date)->format('Y-m-d');
                    $score->save();
                }		
                else 
                { 
                    $scores = new CommentsRole();
                    $scores->emp_id = $add_empid;
                    $scores->by_employee = $emp_text[$key] ? $emp_text[$key] : '';  
                    $scores->managers_comment = $manager_text[$key] ? $manager_text[$key] : '';  
					$scores->perfomance_date=Carbon::createFromFormat('Y-m-d', $request->perfomance_date)->format('Y-m-d');
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
                    $score= AdditionCommentRole::where('id',$id_arry[$key])->where('perfomance_date',$perfomance_date)->first();  
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
					$score->perfomance_date=Carbon::createFromFormat('Y-m-d', $request->perfomance_date)->format('Y-m-d'); 
					if($score->complete_perfomance_by_manager != 1){
					$score->complete_perfomance_by_manager=$request->complete_perfomance_by_manager;
					}
                    $score->save(); 
                }		
                else 
                { 
                    $scores = new AppraiseeStrength();
                    $scores->emp_id = $add_empid;
                    $scores->strengths = $strengths[$key] ? $strengths[$key] : '';  
                    $scores->areas_improvement = $areas_imp[$key] ? $areas_imp[$key] : ''; 
					$scores->perfomance_date=Carbon::createFromFormat('Y-m-d', $request->perfomance_date)->format('Y-m-d');	
					if($scores->complete_perfomance_by_manager != 1){
					$scores->complete_perfomance_by_manager=$request->complete_perfomance_by_manager;
					}	
                    $scores->save();   
                }
            }
        }
        return redirect('/edit-performance/'.$request->empid.'/'.$request->perfomance_date.'/#AppraiseeStrength'); 
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
					$score->perfomance_date=Carbon::createFromFormat('Y-m-d', $request->perfomance_date)->format('Y-m-d'); 
					if($score->complete_perfomance_by_emp != 1){
					$score->complete_perfomance_by_emp=$request->complete_perfomance_by_emp;
					} 
					if($score->complete_perfomance_by_manager != 1){
					$score->complete_perfomance_by_manager=$request->complete_perfomance_by_manager;
					}
                    $score->save(); 
                }		
                else 
                { 
                    $scores = new OtherGeneralComment();
                    $scores->emp_id = $add_empid;
                    $scores->employee_comments = $emp_text[$key] ? $emp_text[$key] : '';  
                    $scores->managers_comments = $manager_text[$key] ? $manager_text[$key] : '';
					$scores->perfomance_date=Carbon::createFromFormat('Y-m-d', $request->perfomance_date)->format('Y-m-d');
					if($scores->complete_perfomance_by_emp != 1){
					$scores->complete_perfomance_by_emp=$request->complete_perfomance_by_emp;
					} 
					if($scores->complete_perfomance_by_manager != 1){
					$scores->complete_perfomance_by_manager=$request->complete_perfomance_by_manager;
					}
                    $scores->save();  
                }
            }
        }
        return redirect('/edit-performance/'.$request->empid.'/'.$request->perfomance_date.'/#GeneralComment_next');   
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
        return back();  
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
		$key_date = $request->perfomance_date; 
		if($userd != $request->empid && (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)){ 
			$status=KeyprofessionalExcellences::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->first();         
			$status->complete_perfomance_by_hr=1;   
			$status->save();
		}
        elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 6){
            $status=KeyprofessionalExcellences::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->first();         
			$status->complete_perfomance_by_manager=1;   
			$status->save();
        }
        else{
            $status=KeyprofessionalExcellences::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->first();         
			$status->complete_perfomance_by_emp=1;   
			$status->save();
        }
		


		if($userd != $request->empid && (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)){ 
			$status=PersonalExcellence::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->first(); 
			$status->complete_perfomance_by_hr=1;   
			$status->save();
		}
        elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 6){
            $status=PersonalExcellence::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->first(); 
			$status->complete_perfomance_by_manager=1;   
			$status->save();
        }
        else{
            $status=PersonalExcellence::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->first(); 
			$status->complete_perfomance_by_emp=1;   
			$status->save();
        }
		


		if($userd != $request->empid && (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)){ 
			$status=SpecialInitiatives::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->get();
			foreach($status as $key => $input)
			{  
				$score=SpecialInitiatives::where('id',$input->id)->first(); 
				$score->complete_perfomance_by_hr=1;   
				$score->save();  
			}
        } 
        elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 6){
            $status=SpecialInitiatives::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->get();
			foreach($status as $key => $input)
			{  
				$score=SpecialInitiatives::where('id',$input->id)->first(); 
				$score->complete_perfomance_by_manager=1;   
				$score->save();  
			} 
        }
		else{
            $status=SpecialInitiatives::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->get();
			foreach($status as $key => $input)
			{  
				$score=SpecialInitiatives::where('id',$input->id)->first(); 
				$score->complete_perfomance_by_emp=1;   
				$score->save();  
			}
        }



		if($userd != $request->empid && (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)){ 
		    $status=AppraiseeStrength::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->get(); 
			foreach($status as $key => $input)
			{  
				$score=AppraiseeStrength::where('id',$input->id)->first(); 
				$score->complete_perfomance_by_hr=1;   
				$score->save();  
			}
		}
        elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 6){
            $status=AppraiseeStrength::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->get(); 
			foreach($status as $key => $input)
			{  
				$score=AppraiseeStrength::where('id',$input->id)->first(); 
				$score->complete_perfomance_by_manager=1;   
				$score->save();  
			}
        }
        else{
            $status=AppraiseeStrength::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->get(); 
			foreach($status as $key => $input)
			{  
				$score=AppraiseeStrength::where('id',$input->id)->first(); 
				$score->complete_perfomance_by_emp=1;   
				$score->save();  
			}
        }
		

		if($userd != $request->empid && (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)){ 
			$status=OtherGeneralComment::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->get();
			foreach($status as $key => $input)
			{  
				$score=OtherGeneralComment::where('id',$input->id)->first(); 
				$score->complete_perfomance_by_hr=1;   
				$score->save();  
			}
        } 
        elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 6){
            $status=OtherGeneralComment::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->get();
			foreach($status as $key => $input)
			{  
				$score=OtherGeneralComment::where('id',$input->id)->first(); 
				$score->complete_perfomance_by_manager=1;   
				$score->save();  
			}
        }
		else{
            $status=OtherGeneralComment::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->get();
			foreach($status as $key => $input)
			{  
				$score=OtherGeneralComment::where('id',$input->id)->first(); 
				$score->complete_perfomance_by_emp=1;   
				$score->save();  
			}
        }
		
		if($userd == $request->empid || Auth::user()->role_id == 3){  
        $status=Employee::where('id',$request->empid)->first();         
        $status->perfomance_status=1; 
        $status->save();  
		}
		
		$email_em=Employee::where('id',$request->empid)->first();   
		$manager_ids = $email_em->man_id;  
		//$man_ids = Employee::where('id',$manager_ids)->first();
		$man_email = Employee::where('id',$manager_ids)->pluck('email')->first();    
		$emp_fname = Employee::where('id',$request->empid)->pluck('first_name')->first();  
		$emp_lname = Employee::where('id',$request->empid)->pluck('last_name')->first();  
		
		$details = [
			'title' => 'Employee Performance Status',
			'body' => $emp_fname ." ". $emp_lname."'s". ' Performance Status has been Complete' 
			 
		]; 
		Mail::to($man_email)->send(new \App\Mail\CompleteStatus($details));
 
        $message='Hi, '. $emp_fname ." ". $emp_lname."'s ". 'Performance Status has been Complete';
		$myperformance = 'my-performance/'.$request->empid;
        Notification::create(['employeeid' => $email_em->man_id, 'message' => $message, 'slug' => $myperformance]);
        event(new EmployeePerfomanceStatus($message,$email_em->man_id,$myperformance));
		if(Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
		{  return redirect('performance-dashboard');
		}else{
        return redirect('success_status');
		}
    }
	
	 public function add_Perfomance_reject_status(Request $request)
    {   	
        
        $userd = Auth::user()->id;  
		$key_date = $request->perfomance_date; 
		 
		if($userd != $request->empid){ 
			$status=KeyprofessionalExcellences::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->first();         
			$status->complete_perfomance_by_hr=2;   
			$status->save();
		}
		
		if($userd != $request->empid){ 
			$status=PersonalExcellence::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->first(); 
			$status->complete_perfomance_by_hr=2;   
			$status->save();
		}
		
		if($userd != $request->empid){ 
			$status=SpecialInitiatives::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->get();
			foreach($status as $key => $input)
			{  
				$score=SpecialInitiatives::where('id',$input->id)->first(); 
				$score->complete_perfomance_by_hr=2;   
				$score->save();  
			}
        } 
		
		if($userd != $request->empid){ 
		    $status=AppraiseeStrength::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->get(); 
			foreach($status as $key => $input)
			{  
				$score=AppraiseeStrength::where('id',$input->id)->first(); 
				$score->complete_perfomance_by_hr=2;   
				$score->save();  
			}
		}
		
		if($userd != $request->empid){ 
			$status=OtherGeneralComment::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->get();
			foreach($status as $key => $input)
			{  
				$score=OtherGeneralComment::where('id',$input->id)->first(); 
				$score->complete_perfomance_by_hr=2;   
				$score->save();  
			}
        }
		$email_em=Employee::where('id',$request->empid)->first();  
		$manager_ids = $email_em->man_id; 
		$man_email = Employee::where('id',$manager_ids)->pluck('email')->first();    
		$emp_fname = Employee::where('id',$request->empid)->pluck('first_name')->first();  
		$emp_lname = Employee::where('id',$request->empid)->pluck('last_name')->first();
		$details = [
			'title' => 'Performance Status',
			'body' => $emp_fname ." ". $emp_lname."'s". ' Performance Status has been Rejected' 
			 
		]; 
		Mail::to($man_email)->send(new \App\Mail\RejectStatus($details)); 
		return back(); 
	}
	
	public function success_Perfomance_status()
	{
		return view('success_status');
	}
	
	public function add_Perfomance_status_user_for_employee(Request $request)
    {   
        /* $userd = Auth::user()->id; 
		$key_date = $request->perfomance_date;  
        $status=KeyprofessionalExcellences::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->first();         
        $status->complete_perfomance_by_hr=$request->complete_perfomance_by_hr; 
        $status->save();
		
		$status=PersonalExcellence::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->first();
        $status->complete_perfomance_by_hr=$request->complete_perfomance_by_hr; 
        $status->save();
		
		$status=SpecialInitiatives::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->first();
        $status->complete_perfomance_by_hr=$request->complete_perfomance_by_hr; 
        $status->save();
		
		$status=AppraiseeStrength::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->first();
        $status->complete_perfomance_by_hr=$request->complete_perfomance_by_hr; 
        $status->save();
		
		$status=OtherGeneralComment::where('emp_id',$request->empid)->where('perfomance_date',$key_date)->first();
        $status->complete_perfomance_by_hr=$request->complete_perfomance_by_hr; 
        $status->save();

		$e_ids = $status->emp_id; 
		$man_ids = Employee::where('id',$e_ids)->first(); 
		$man_email = Employee::where('id',$man_ids)->pluck('email')->first();    
		$emp_fname = Employee::where('id',$request->empid)->pluck('first_name')->first();  
		$emp_lname = Employee::where('id',$request->empid)->pluck('last_name')->first();  
		
		$details = [
			'title' => 'Employee Performance Status',
			'body' => $emp_fname ." ". $emp_lname."'s". ' Performance Status has been Complete' 
			 
		];
		Mail::to($man_email)->send(new \App\Mail\CompleteStatus($details));

        $message='Hi, Your Employee Performance Status has been Complete';
        Notification::create(['employeeid' => $status->emp_id, 'message' => $message]);
        event(new EmployeePerfomanceStatus($message,$status->emp_id));
        return back(); */
    }
	
	public function add_Perfomance_date_for_employee(Request $request)
    {   
        $emp_hidden = $request->pri_id;  
		if($emp_hidden){
			$status = new KeyprofessionalExcellences();         
			$status->perfomance_date=Carbon::createFromFormat('d/m/Y', $request->perfomance_date)->format('Y-m-d');
			$status->emp_id=Auth::user()->id; 
			$status->save();
        
		} else{
			$status=KeyprofessionalExcellences::where('id',$request->pri_id)->first();         
        $status->perfomance_date=Carbon::createFromFormat('d/m/Y', $request->perfomance_date)->format('Y-m-d');
		$status->save();
		}
		
		$status=PersonalExcellence::where('emp_id',$request->empid)->first();         
        $status->perfomance_date=Carbon::createFromFormat('d/m/Y', $request->perfomance_date)->format('Y-m-d');	 
        $status->save(); 
		
		$status=SpecialInitiatives::where('emp_id',$request->empid)->first();         
        $status->perfomance_date=Carbon::createFromFormat('d/m/Y', $request->perfomance_date)->format('Y-m-d');	 
        $status->save(); 
		
		$status=AppraiseeStrength::where('emp_id',$request->empid)->first();         
        $status->perfomance_date=Carbon::createFromFormat('d/m/Y', $request->perfomance_date)->format('Y-m-d');	 
        $status->save(); 
		
		$status=OtherGeneralComment::where('emp_id',$request->empid)->first();         
        $status->perfomance_date=Carbon::createFromFormat('d/m/Y', $request->perfomance_date)->format('Y-m-d');	 
        $status->save(); 
		
        return back();
    }
	
	public function performance_dashboard(){
		$manger_emp = DB::table('employees')->leftJoin('keyprofessional_excellences as ke','employees.id','ke.emp_id')->leftJoin('new_personal_behavioral_excellence as be','employees.id','be.emp_id')->
        leftJoin('special_initiatives as si','employees.id','si.emp_id')->
        leftJoin('appraisee_strengths as as','employees.id','as.emp_id')->
        leftJoin('other_general_comments as gc','employees.id','gc.emp_id')
        ->where('ke.complete_perfomance_by_manager',1)->where('be.complete_perfomance_by_manager',1)->
        where('si.complete_perfomance_by_manager',1)->where('gc.complete_perfomance_by_manager',1)
        ->where('ke.complete_perfomance_by_hr',0)->where('be.complete_perfomance_by_hr',0)->
        where('si.complete_perfomance_by_hr',0)->where('gc.complete_perfomance_by_hr',0)->
        select('employees.id','employees.first_name','employees.last_name','ke.perfomance_date','ke.complete_perfomance_by_hr')->groupBy('ke.perfomance_date','employees.last_name','employees.first_name')->get();
		
		$accept_emp = DB::table('employees')->leftJoin('keyprofessional_excellences as ke','employees.id','ke.emp_id')->leftJoin('new_personal_behavioral_excellence as be','employees.id','be.emp_id')->
        leftJoin('special_initiatives as si','employees.id','si.emp_id')->
        leftJoin('appraisee_strengths as as','employees.id','as.emp_id')->
        leftJoin('other_general_comments as gc','employees.id','gc.emp_id')
        ->where('ke.complete_perfomance_by_manager',1)->where('be.complete_perfomance_by_manager',1)->
        where('si.complete_perfomance_by_manager',1)->where('gc.complete_perfomance_by_manager',1)
        ->where('ke.complete_perfomance_by_hr',1)->where('be.complete_perfomance_by_hr',1)->
        where('si.complete_perfomance_by_hr',1)->where('gc.complete_perfomance_by_hr',1)->
        select('employees.id','employees.first_name','employees.last_name','ke.perfomance_date','ke.complete_perfomance_by_hr')->groupBy('ke.perfomance_date','employees.last_name','employees.first_name')->get();
		
		$reject_emp = DB::table('employees')->leftJoin('keyprofessional_excellences as ke','employees.id','ke.emp_id')->leftJoin('new_personal_behavioral_excellence as be','employees.id','be.emp_id')->
        leftJoin('special_initiatives as si','employees.id','si.emp_id')->
        leftJoin('appraisee_strengths as as','employees.id','as.emp_id')->
        leftJoin('other_general_comments as gc','employees.id','gc.emp_id')
        ->where('ke.complete_perfomance_by_manager',1)->where('be.complete_perfomance_by_manager',1)->
        where('si.complete_perfomance_by_manager',1)->where('gc.complete_perfomance_by_manager',1)
        ->where('ke.complete_perfomance_by_hr',2)->where('be.complete_perfomance_by_hr',2)->
        where('si.complete_perfomance_by_hr',2)->where('gc.complete_perfomance_by_hr',2)->
        select('employees.id','employees.first_name','employees.last_name','ke.perfomance_date','ke.complete_perfomance_by_hr')->groupBy('ke.perfomance_date','employees.last_name','employees.first_name')->get();
		
		
		$pending_emp = DB::table('employees')->join('keyprofessional_excellences as ke','employees.id','ke.emp_id')->leftJoin('new_personal_behavioral_excellence as be','employees.id','be.emp_id')->
        leftJoin('special_initiatives as si','employees.id','si.emp_id')->
        leftJoin('appraisee_strengths as as','employees.id','as.emp_id')->
        leftJoin('other_general_comments as gc','employees.id','gc.emp_id')->
        where('man_id',Auth::user()->id)
        ->where('ke.complete_perfomance_by_emp',1)->where('be.complete_perfomance_by_emp',1)->
        where('si.complete_perfomance_by_emp',1)->where('gc.complete_perfomance_by_emp',1)
        ->where('ke.complete_perfomance_by_manager','!=',1)->where('be.complete_perfomance_by_manager','!=',1)->
        where('si.complete_perfomance_by_manager','!=',1)->where('gc.complete_perfomance_by_manager','!=',1)->
        select('employees.id','employees.first_name','employees.last_name','ke.perfomance_date')->groupBy('ke.perfomance_date','employees.last_name','employees.first_name')->get();
		
		$reviewed_emp = DB::table('employees')->join('keyprofessional_excellences as ke','employees.id','ke.emp_id')->leftJoin('new_personal_behavioral_excellence as be','employees.id','be.emp_id')->
        leftJoin('special_initiatives as si','employees.id','si.emp_id')->
        leftJoin('appraisee_strengths as as','employees.id','as.emp_id')->
        leftJoin('other_general_comments as gc','employees.id','gc.emp_id')->
        where('man_id',Auth::user()->id)
        ->where('ke.complete_perfomance_by_emp',1)->where('be.complete_perfomance_by_emp',1)->
        where('si.complete_perfomance_by_emp',1)->where('gc.complete_perfomance_by_emp',1)
        ->where('ke.complete_perfomance_by_manager',1)->where('be.complete_perfomance_by_manager',1)->
        where('si.complete_perfomance_by_manager',1)->where('gc.complete_perfomance_by_manager',1)->
        select('employees.id','employees.first_name','employees.last_name','ke.perfomance_date')->groupBy('ke.perfomance_date','employees.last_name','employees.first_name')->get();
		
		return view('performance-dashboard',compact('manger_emp','pending_emp','accept_emp','reject_emp','reviewed_emp'));
	}
}
