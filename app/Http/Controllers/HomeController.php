<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\EmployeeFirstVerbalWarning;
use App\EmployeeSecondVerbalWarning;
use App\EmployeeThirdVerbalWarning;
use App\Termination;
use Auth;
use Carbon\Carbon;
use DB;
use App\EmployeeLeave;
use App\Resignation;
use App\Promotion;
use App\Appraisal;
use App\PersonalExcellence;
use App\Department;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userd = Auth::user()->id;
        $third_withdraw = EmployeeThirdVerbalWarning::where('emp_id',$userd)->where('status',0)->get();
        $third_war = EmployeeThirdVerbalWarning::where('emp_id',$userd)->where('status',1)->get();
        $second_withdraw = EmployeeSecondVerbalWarning::where('emp_id',$userd)->where('status',0)->get();
        $second_war = EmployeeSecondVerbalWarning::where('emp_id',$userd)->where('status',1)->get();
        $first_withdraw = EmployeeFirstVerbalWarning::where('emp_id',$userd)->where('status',0)->get();
        $first_war = EmployeeFirstVerbalWarning::where('emp_id',$userd)->where('status',1)->get();
        $terminate_emp = Termination::where('employee_id', $userd)->get();
        $promotiondata = Promotion::where('employeeid', $userd)->get();
        $personal_excellence=PersonalExcellence::where('emp_id',$userd)->first();
        $on_leave_data=EmployeeLeave::where('employee_id',$userd)->get();
        $resignation = Resignation::where('employeeid', $userd)->orderBy('id', 'DESC')->get();
        return view('employee-dashboard',compact('third_withdraw','third_war','second_withdraw','second_war','first_withdraw','first_war','terminate_emp','promotiondata','personal_excellence','on_leave_data', 'resignation'));
    }
	public function adminHome()
    {
        $manager_emp = Employee::where('man_id',Auth::user()->id)->pluck('id')->toArray();
        if(Auth::user()->role_id==2 || Auth::user()->role_id==6){
        $emp_total= Employee::where('role_id','!=','1')->where('man_id',Auth::id())->get()->count();
        }
        else{
        $emp_total= Employee::where('role_id','!=','1')->get()->count();

        }
        if(Auth::user()->role_id==2 || Auth::user()->role_id==6){
        $per_status_complete= Employee::where('perfomance_status','1')->where('man_id',Auth::user()->id)->get()->count();
        }else{
        $per_status_complete= Employee::where('perfomance_status','1')->get()->count();
        }
        if(Auth::user()->role_id==2 || Auth::user()->role_id==6){
        $per_status_incomp= Employee::where('perfomance_status','0')->where('man_id',Auth::user()->id)->get()->count();
        }
        else{
        $per_status_incomp= Employee::where('perfomance_status','0')->get()->count();
        }
        $man_total= Employee::where('role_id','2')->get()->count();
        if(Auth::user()->role_id==1 || Auth::user()->role_id==5){
           $emp = Employee::where('role_id','3')->orderBy('id', 'DESC')->limit(3)->get();
           $res = Resignation::orderBy('id', 'DESC')->limit(3)->get();
           $promotion = Promotion::orderBy('id', 'DESC')->limit(5)->get();
           $appraisal = Appraisal::orderBy('id', 'DESC')->limit(5)->get();
        }elseif(Auth::user()->role_id==2 || Auth::user()->role_id==6){
            $emp = Employee::where('man_id',Auth::user()->id)->orderBy('id', 'DESC')->limit(5)->get();

            $res = Resignation::whereIn('employeeid', $manager_emp)->orwhere('employeeid', Auth::user()->id)->limit(5)->get();
            $promotion = Promotion::whereIn('employeeid', $manager_emp)->orwhere('employeeid', Auth::user()->id)->limit(5)->get();
            $appraisal = Appraisal::whereIn('employee_id', $manager_emp)->orwhere('employee_id', Auth::user()->id)->limit(5)->get();
        }
        $today_date=Carbon::today()->format('Y-m-d');

        //leave
        if(Auth::user()->role_id==1 || Auth::user()->role_id==5){
        $total_emp=Employee::where('role_id','!=',1)->count();
        $on_leave=EmployeeLeave::where([ ['from_date', '>=', $today_date], ['to_date', '<=', $today_date],])  ->orWhere([['from_date', '>=', $today_date],['to_date', '<=', $today_date],])->orWhere([['from_date', '<=', $today_date],['to_date', '>=', $today_date],])->get()->groupBy('employee_id')->count();
        $on_leave_data=EmployeeLeave::where([ ['from_date', '>=', $today_date], ['to_date', '<=', $today_date],]) ->orWhere([['from_date', '>=', $today_date],['to_date', '<=', $today_date],])->orWhere([['from_date', '<=', $today_date],['to_date', '>=', $today_date],])->limit(2)->get();
        if($total_emp!=0){$progress_leave = $on_leave*100/$total_emp;}else{$progress_leave=0;}
        $planed_leave=DB::select("SELECT e2.* FROM `employee_leaves` e1 inner join `employee_leaves` e2 on date(e1.updated_at) < (e2.from_date) and e2.id=e1.id and e1.from_date <= (select current_date) and e1.to_date >= (select current_date);
        ");
        $plan_count = count($planed_leave);
        $unplan_data=$on_leave-$plan_count;
        if($on_leave != 0){$plan_data = $plan_count*100/$on_leave;}else{$plan_data=0;}
        if($on_leave != 0){$unplan_count=$unplan_data*100/$on_leave;}else{$unplan_count=0;}
        $pending_req=EmployeeLeave::where('status', 1)->get()->count();
        $pending_persent = $pending_req/100;
        }
        else{
            $total_emp=Employee::where('role_id','!=',1)->where('man_id',Auth::id())->count();
            $on_leave=EmployeeLeave::where([ ['from_date', '>=', $today_date], ['to_date', '<=', $today_date],])->orWhere([['from_date', '>=', $today_date],['to_date', '<=', $today_date],])->orWhere([['from_date', '<=', $today_date],['to_date', '>=', $today_date],])->where('manager_id',Auth::id())->get()->groupBy('employee_id')->count();
            $on_leave_data=EmployeeLeave::where([ ['from_date', '>=', $today_date], ['to_date', '<=', $today_date],]) ->orWhere([['from_date', '>=', $today_date],['to_date', '<=', $today_date],])->orWhere([['from_date', '<=', $today_date],['to_date', '>=', $today_date],])->where('manager_id',Auth::id())->limit(2)->get();
            if($total_emp!=0){$progress_leave = $on_leave*100/$total_emp;}else{$progress_leave=0;}
            $userd=Auth::id();
            $planed_leave=DB::select("SELECT e2.* FROM `employee_leaves` e1 inner join `employee_leaves` e2 on date(e1.updated_at) < (e2.from_date) and e2.id=e1.id and e1.from_date <= (select current_date) and e1.to_date >= (select current_date) and e1.manager_id = '$userd';
            ");
            $plan_count = count($planed_leave);
            $unplan_data=$on_leave-$plan_count;
            if($on_leave != 0){$plan_data = $plan_count*100/$on_leave;}else{$plan_data=0;}
            if($on_leave != 0){$unplan_count=$unplan_data*100/$on_leave;}else{$unplan_count=0;}
            $pending_req=EmployeeLeave::where('status', 1)->where('manager_id',Auth::id())->get()->count();
            $pending_persent = $pending_req/100;
        }
        //end leave

        $last_month_emp_count=Employee::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->where('role_id','!=',1)->get()->count();
        $current_month_emp_count=Employee::whereMonth('created_at', '=', Carbon::now()->month)->where('role_id','!=',1)->get()->count();
        if($last_month_emp_count!=0){$emp_per=(($current_month_emp_count-$last_month_emp_count)/$last_month_emp_count)*100;}else{$emp_per=0;}

        $promotion_month = Promotion::whereMonth('date', '=', Carbon::now()->month)->get()->count();
        $promotion_previousmonth = Promotion::whereMonth('date', '=', Carbon::now()->subMonth()->month)->get()->count();
        if($promotion_previousmonth != 0){$pro_per=(($promotion_month-$promotion_previousmonth)/$promotion_previousmonth)*100;}else{$pro_per=0;};

        // $promotion_month = Promotion::whereMonth('date', '=', Carbon::now()->month)->get();
        // $promotion_previousmonth = Promotion::whereMonth('date', '=', Carbon::now()->subMonth()->month)->get();

        $last_month_resi_count=Resignation::whereMonth('resignationdate', '=', Carbon::now()->subMonth()->month)->get()->count();
        $current_month_resi_count=Resignation::whereMonth('resignationdate', '=', Carbon::now()->month)->get()->count();
        if($last_month_resi_count != 0){$resi_per=(($current_month_resi_count-$last_month_resi_count)/$last_month_resi_count)*100;}else{$resi_per = 0;}

        $last_month_ter_count=Termination::whereMonth('termination_date', '=', Carbon::now()->subMonth()->month)->get()->count();
        $current_month_ter_count=Termination::whereMonth('termination_date', '=', Carbon::now()->month)->get()->count();
        if($last_month_ter_count!=0){$ter_per=(($current_month_ter_count-$last_month_ter_count)/$last_month_ter_count)*100;}else{$ter_per=0;}

        $currentyear = Carbon::now()->year;
        $lastsixyears = [$currentyear];
        for ($i=1; $i < 7; $i++) {
            array_push($lastsixyears, $currentyear-$i);
        }
        $newemp = [];
        foreach ($lastsixyears as $key => $value) {
            $newemptemp = Employee::where( DB::raw('YEAR(joing_date)'), '=', $value )->count();
            array_push($newemp, $newemptemp);
        }
        $resignedemp = [];
        foreach ($lastsixyears as $key => $value) {
            $resemptemp = Resignation::where('status', 'Approved')->where( DB::raw('YEAR(resignationdate)'), '=', $value )->count();
            array_push($resignedemp, $resemptemp);
        }
        foreach ($lastsixyears as $key => $value) {
            $data['y'] = "".$value."";
            $data['a'] = $newemp[$key];
            $data['b'] = $resignedemp[$key];
            $final[$key] = $data;
        }
        $linechartdata = json_encode($final);
        $my_leaves=EmployeeLeave::where('employee_id',Auth::user()->id)->orderBy('created_at','desc')->take(5)->get();
        $terminated_emp_under_me=Employee::join('termination as t','t.employee_id','employees.id')->where('man_id',Auth::user()->id)->get()->count();


        //Warning
        $third_withdraw = EmployeeThirdVerbalWarning::whereIn('emp_id',$manager_emp)->orwhere('emp_id', Auth::user()->id)->get();
        $third_war = EmployeeThirdVerbalWarning::whereIn('emp_id',$manager_emp)->orwhere('emp_id', Auth::user()->id)->where('status',1)->get();
        $second_withdraw = EmployeeSecondVerbalWarning::whereIn('emp_id',$manager_emp)->orwhere('emp_id', Auth::user()->id)->get();
        $second_war = EmployeeSecondVerbalWarning::whereIn('emp_id',$manager_emp)->orwhere('emp_id', Auth::user()->id)->where('status',1)->get();
        $first_withdraw = EmployeeFirstVerbalWarning::whereIn('emp_id',$manager_emp)->orwhere('emp_id', Auth::user()->id)->get();
        $first_war = EmployeeFirstVerbalWarning::whereIn('emp_id',$manager_emp)->orwhere('emp_id', Auth::user()->id)->where('status',1)->get();
        $terminate_emp = Termination::whereIn('employee_id', $manager_emp)->orwhere('employee_id', Auth::user()->id)->get();

        /// Personal Excellence admin
        $excel_80100 = PersonalExcellence::where('total_percentage_manager','>=',80)->where('total_percentage_manager','<=',100)->get('total_percentage_manager')->count();
        $excel_6079 = PersonalExcellence::where('total_percentage_manager','>=',60)->where('total_percentage_manager','<=',79)->get('total_percentage_manager')->count();
        $excel_4059 = PersonalExcellence::where('total_percentage_manager','>=',40)->where('total_percentage_manager','<=',59)->get('total_percentage_manager')->count();
        $excel_2039 = PersonalExcellence::where('total_percentage_manager','>=',20)->where('total_percentage_manager','<=',39)->get('total_percentage_manager')->count();
        $excel_119 = PersonalExcellence::where('total_percentage_manager','>=',1)->where('total_percentage_manager','<=',19)->get('total_percentage_manager')->count();
        $excel_total_entry = PersonalExcellence::get()->count();
        if($excel_total_entry != 0){$width_80100 = ($excel_80100*100)/$excel_total_entry;} else{$width_80100 = 0;}
        if($excel_total_entry != 0){$width_6079 = ($excel_6079*100)/$excel_total_entry;} else{$width_6079 = 0;}
        if($excel_total_entry != 0){$width_4059 = ($excel_4059*100)/$excel_total_entry;} else{$width_4059 = 0;}
        if($excel_total_entry != 0){$width_2039 = ($excel_2039*100)/$excel_total_entry;} else{$width_2039 = 0;}
        if($excel_total_entry != 0){$width_119 = ($excel_119*100)/$excel_total_entry;} else{$width_119 = 0;}

        /// Manager
        $man_empls =  Employee::where('man_id',Auth::user()->id)->get('id')->pluck('id')->toArray();
        $man_excel_80100 = PersonalExcellence::whereIn('emp_id',$man_empls)->where('total_percentage_manager','>=',80)->where('total_percentage_manager','<=',100)->get('total_percentage_manager')->count();
        $man_excel_6079 = PersonalExcellence::whereIn('emp_id',$man_empls)->where('total_percentage_manager','>=',60)->where('total_percentage_manager','<=',79)->get('total_percentage_manager')->count();
        $man_excel_4059 = PersonalExcellence::whereIn('emp_id',$man_empls)->where('total_percentage_manager','>=',40)->where('total_percentage_manager','<=',59)->get('total_percentage_manager')->count();
        $man_excel_2039 = PersonalExcellence::whereIn('emp_id',$man_empls)->where('total_percentage_manager','>=',20)->where('total_percentage_manager','<=',39)->get('total_percentage_manager')->count();
        $man_excel_119 = PersonalExcellence::whereIn('emp_id',$man_empls)->where('total_percentage_manager','>=',1)->where('total_percentage_manager','<=',19)->get('total_percentage_manager')->count();
        $man_excel_total_entry = PersonalExcellence::whereIn('emp_id',$man_empls)->get()->count();
        if($man_excel_total_entry != 0){$man_width_80100 = ($man_excel_80100*100)/$man_excel_total_entry;} else{$man_width_80100 = 0;}
        if($man_excel_total_entry != 0){$man_width_6079 = ($man_excel_6079*100)/$man_excel_total_entry;} else{$man_width_6079 = 0;}
        if($man_excel_total_entry != 0){$man_width_4059 = ($man_excel_4059*100)/$man_excel_total_entry;} else{$man_width_4059 = 0;}
        if($man_excel_total_entry != 0){$man_width_2039 = ($man_excel_2039*100)/$man_excel_total_entry;} else{$man_width_2039 = 0;}
        if($man_excel_total_entry != 0){$man_width_119 = ($man_excel_119*100)/$man_excel_total_entry;} else{$man_width_119 = 0;}

		//$manger_emp = Employee::where('complete_professional_excellence',1)->where('complete_personal_excellence',1)->where('complete_special_initiative',1)->where('complete_other_general_comments',1)->where('complete_professional_excellence_by_manager',1)->where('complete_personal_excellence_by_manager',1)->where('complete_special_initiative_by_manager',1)->where('complete_appraisee_strength_by_manager',1)->where('complete_other_general_comments_by_manager',1)->get();
		$manger_emp = DB::table('employees')->leftJoin('keyprofessional_excellences as ke','employees.id','ke.emp_id')->
        leftJoin('new_personal_behavioral_excellence as be','employees.id','be.emp_id')->
        leftJoin('special_initiatives as si','employees.id','si.emp_id')->
        leftJoin('appraisee_strengths as as','employees.id','as.emp_id')->
        leftJoin('other_general_comments as gc','employees.id','gc.emp_id')
        ->where('ke.complete_perfomance_by_manager',1)->where('be.complete_perfomance_by_manager',1)->
        where('si.complete_perfomance_by_manager',1)->where('gc.complete_perfomance_by_manager',1)
        ->where('ke.complete_perfomance_by_hr','!=',1)->where('be.complete_perfomance_by_hr','!=',1)->
        where('si.complete_perfomance_by_hr','!=',1)->where('gc.complete_perfomance_by_hr','!=',1)->
        select('employees.id','employees.first_name','employees.last_name','ke.perfomance_date')->groupBy('ke.perfomance_date','employees.last_name','employees.first_name')->
        get();
       
     
		$pending_emp = DB::table('employees')->join('keyprofessional_excellences as ke','employees.id','ke.emp_id')->
        leftJoin('new_personal_behavioral_excellence as be','employees.id','be.emp_id')->
        leftJoin('special_initiatives as si','employees.id','si.emp_id')->
        leftJoin('appraisee_strengths as as','employees.id','as.emp_id')->
        leftJoin('other_general_comments as gc','employees.id','gc.emp_id')->
        where('man_id',Auth::user()->id)
        ->where('ke.complete_perfomance_by_emp',1)->where('be.complete_perfomance_by_emp',1)->
        where('si.complete_perfomance_by_emp',1)->where('gc.complete_perfomance_by_emp',1)
        ->where('ke.complete_perfomance_by_hr','!=',1)->where('be.complete_perfomance_by_hr','!=',1)->
        where('si.complete_perfomance_by_hr','!=',1)->where('gc.complete_perfomance_by_hr','!=',1)->
        select('employees.id','employees.first_name','employees.last_name','ke.perfomance_date')->groupBy('ke.perfomance_date','employees.last_name','employees.first_name')->
        get();
       

        return view('index',compact('manger_emp','pending_emp','emp_total','per_status_complete','per_status_incomp','man_total', 'emp', 'res', 'promotion', 'appraisal','on_leave','on_leave_data','total_emp','progress_leave','plan_count','unplan_count','pending_persent','unplan_data','plan_data','pending_req', 'linechartdata',
        'last_month_emp_count','current_month_emp_count','emp_per','last_month_resi_count','current_month_resi_count','resi_per','promotion_month', 'promotion_previousmonth','pro_per','excel_80100','excel_6079','excel_4059','excel_2039','excel_119','excel_total_entry','width_80100','width_6079','width_4059','width_2039','width_119','third_withdraw','third_war',
        'second_withdraw','second_war','first_withdraw','first_war','terminate_emp','my_leaves','terminated_emp_under_me','last_month_ter_count','current_month_ter_count','ter_per','man_excel_80100','man_excel_6079','man_excel_4059','man_excel_2039','man_excel_119','man_width_80100','man_width_6079','man_width_4059','man_width_2039','man_width_119'));

    }

    public function editPromotion(){
        $id = $_GET['proid'];
        $data = Promotion::find($id);
        $employee = ($data->employee)->first_name.' '.($data->employee)->last_name;
        $currentdesignation = Designation::find($data->promotionform);
        $designationforpromotion = Designation::where('department_id', $data->department)->get()->except($data->promotionform);
        return response(['status' => 1, 'currentdesignation' => $currentdesignation, 'designationforpromotion' => $designationforpromotion, 'employee' => $employee, 'data' => $data]);
    }

	public function HomepageUrl()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 5 || Auth::user()->role_id==6)
		{
            $manager_emp = Employee::where('man_id',Auth::user()->id)->pluck('id')->toArray();
            if(Auth::user()->role_id==2 || Auth::user()->role_id==6){
            $emp_total= Employee::where('role_id','!=','1')->where('man_id',Auth::id())->get()->count();
            }
            else{
            $emp_total= Employee::where('role_id','!=','1')->get()->count();
    
            }
            if(Auth::user()->role_id==2 || Auth::user()->role_id==6){
            $per_status_complete= Employee::where('perfomance_status','1')->where('man_id',Auth::user()->id)->get()->count();
            }else{
            $per_status_complete= Employee::where('perfomance_status','1')->get()->count();
            }
            if(Auth::user()->role_id==2 || Auth::user()->role_id==6){
            $per_status_incomp= Employee::where('perfomance_status','0')->where('man_id',Auth::user()->id)->get()->count();
            }
            else{
            $per_status_incomp= Employee::where('perfomance_status','0')->get()->count();
            }
            $man_total= Employee::where('role_id','2')->get()->count();
            if(Auth::user()->role_id==1 || Auth::user()->role_id == 5){
               $emp = Employee::where('role_id','3')->orderBy('id', 'DESC')->limit(3)->get();
               $res = Resignation::orderBy('id', 'DESC')->limit(3)->get();
               $promotion = Promotion::orderBy('id', 'DESC')->limit(5)->get();
               $appraisal = Appraisal::orderBy('id', 'DESC')->limit(5)->get();
            }elseif(Auth::user()->role_id==2 || Auth::user()->role_id==6){
                $emp = Employee::where('man_id',Auth::user()->id)->orderBy('id', 'DESC')->limit(5)->get();
    
                $res = Resignation::whereIn('employeeid', $manager_emp)->orwhere('employeeid', Auth::user()->id)->limit(5)->get();
                $promotion = Promotion::whereIn('employeeid', $manager_emp)->orwhere('employeeid', Auth::user()->id)->limit(5)->get();
                $appraisal = Appraisal::whereIn('employee_id', $manager_emp)->orwhere('employee_id', Auth::user()->id)->limit(5)->get();
            }
			
			
            $today_date=Carbon::today()->format('Y-m-d');
    
            //leave
            if(Auth::user()->role_id==1 || Auth::user()->role_id == 5){
            $total_emp=Employee::where('role_id','!=',1)->count();
            $on_leave=EmployeeLeave::where([ ['from_date', '>=', $today_date], ['to_date', '<=', $today_date],])  ->orWhere([['from_date', '>=', $today_date],['to_date', '<=', $today_date],])->orWhere([['from_date', '<=', $today_date],['to_date', '>=', $today_date],])->get()->groupBy('employee_id')->count();
            $on_leave_data=EmployeeLeave::where([ ['from_date', '>=', $today_date], ['to_date', '<=', $today_date],]) ->orWhere([['from_date', '>=', $today_date],['to_date', '<=', $today_date],])->orWhere([['from_date', '<=', $today_date],['to_date', '>=', $today_date],])->limit(2)->get();
            if($total_emp!=0){$progress_leave = $on_leave*100/$total_emp;}else{$progress_leave=0;}
            $planed_leave=DB::select("SELECT e2.* FROM `employee_leaves` e1 inner join `employee_leaves` e2 on date(e1.updated_at) < (e2.from_date) and e2.id=e1.id and e1.from_date <= (select current_date) and e1.to_date >= (select current_date);
            ");
            $plan_count = count($planed_leave);
            $unplan_data=$on_leave-$plan_count;
            if($on_leave != 0){$plan_data = $plan_count*100/$on_leave;}else{$plan_data=0;}
            if($on_leave != 0){$unplan_count=$unplan_data*100/$on_leave;}else{$unplan_count=0;}
            $pending_req=EmployeeLeave::where('status', 1)->get()->count();
            $pending_persent = $pending_req/100;
            }
            else{
                $total_emp=Employee::where('role_id','!=',1)->where('man_id',Auth::id())->count();
                $on_leave=EmployeeLeave::where([ ['from_date', '>=', $today_date], ['to_date', '<=', $today_date],])->orWhere([['from_date', '>=', $today_date],['to_date', '<=', $today_date],])->orWhere([['from_date', '<=', $today_date],['to_date', '>=', $today_date],])->where('manager_id',Auth::id())->get()->groupBy('employee_id')->count();
                $on_leave_data=EmployeeLeave::where([ ['from_date', '>=', $today_date], ['to_date', '<=', $today_date],]) ->orWhere([['from_date', '>=', $today_date],['to_date', '<=', $today_date],])->orWhere([['from_date', '<=', $today_date],['to_date', '>=', $today_date],])->where('manager_id',Auth::id())->limit(2)->get();
                if($total_emp!=0){$progress_leave = $on_leave*100/$total_emp;}else{$progress_leave=0;}
                $userd=Auth::id();
                $planed_leave=DB::select("SELECT e2.* FROM `employee_leaves` e1 inner join `employee_leaves` e2 on date(e1.updated_at) < (e2.from_date) and e2.id=e1.id and e1.from_date <= (select current_date) and e1.to_date >= (select current_date) and e1.manager_id = '$userd';
                ");
                $plan_count = count($planed_leave);
                $unplan_data=$on_leave-$plan_count;
                if($on_leave != 0){$plan_data = $plan_count*100/$on_leave;}else{$plan_data=0;}
                if($on_leave != 0){$unplan_count=$unplan_data*100/$on_leave;}else{$unplan_count=0;}
                $pending_req=EmployeeLeave::where('status', 1)->where('manager_id',Auth::id())->get()->count();
                $pending_persent = $pending_req/100;
            }
            //end leave
    
            $last_month_emp_count=Employee::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->where('role_id','!=',1)->get()->count();
            $current_month_emp_count=Employee::whereMonth('created_at', '=', Carbon::now()->month)->where('role_id','!=',1)->get()->count();
            if($last_month_emp_count!=0){$emp_per=(($current_month_emp_count-$last_month_emp_count)/$last_month_emp_count)*100;}else{$emp_per=0;}
    
            $promotion_month = Promotion::whereMonth('date', '=', Carbon::now()->month)->get()->count();
            $promotion_previousmonth = Promotion::whereMonth('date', '=', Carbon::now()->subMonth()->month)->get()->count();
            if($promotion_previousmonth != 0){$pro_per=(($promotion_month-$promotion_previousmonth)/$promotion_previousmonth)*100;}else{$pro_per=0;};
    
            // $promotion_month = Promotion::whereMonth('date', '=', Carbon::now()->month)->get();
            // $promotion_previousmonth = Promotion::whereMonth('date', '=', Carbon::now()->subMonth()->month)->get();
    
            $last_month_resi_count=Resignation::whereMonth('resignationdate', '=', Carbon::now()->subMonth()->month)->get()->count();
            $current_month_resi_count=Resignation::whereMonth('resignationdate', '=', Carbon::now()->month)->get()->count();
            if($last_month_resi_count != 0){$resi_per=(($current_month_resi_count-$last_month_resi_count)/$last_month_resi_count)*100;}else{$resi_per = 0;}
    
            $last_month_ter_count=Termination::whereMonth('termination_date', '=', Carbon::now()->subMonth()->month)->get()->count();
            $current_month_ter_count=Termination::whereMonth('termination_date', '=', Carbon::now()->month)->get()->count();
            if($last_month_ter_count!=0){$ter_per=(($current_month_ter_count-$last_month_ter_count)/$last_month_ter_count)*100;}else{$ter_per=0;}
    
            $currentyear = Carbon::now()->year;
            $lastsixyears = [$currentyear];
            for ($i=1; $i < 7; $i++) {
                array_push($lastsixyears, $currentyear-$i);
            }
            $newemp = [];
            foreach ($lastsixyears as $key => $value) {
                $newemptemp = Employee::where( DB::raw('YEAR(joing_date)'), '=', $value )->count();
                array_push($newemp, $newemptemp);
            }
            $resignedemp = [];
            foreach ($lastsixyears as $key => $value) {
                $resemptemp = Resignation::where('status', 'Approved')->where( DB::raw('YEAR(resignationdate)'), '=', $value )->count();
                array_push($resignedemp, $resemptemp);
            }
            foreach ($lastsixyears as $key => $value) {
                $data['y'] = "".$value."";
                $data['a'] = $newemp[$key];
                $data['b'] = $resignedemp[$key];
                $final[$key] = $data;
            }
            $linechartdata = json_encode($final);
            $my_leaves=EmployeeLeave::where('employee_id',Auth::user()->id)->orderBy('created_at','desc')->take(5)->get();
            $terminated_emp_under_me=Employee::join('termination as t','t.employee_id','employees.id')->where('man_id',Auth::user()->id)->get()->count();
    
    
            //Warning
            $third_withdraw = EmployeeThirdVerbalWarning::whereIn('emp_id',$manager_emp)->orwhere('emp_id', Auth::user()->id)->get();
            $third_war = EmployeeThirdVerbalWarning::whereIn('emp_id',$manager_emp)->orwhere('emp_id', Auth::user()->id)->where('status',1)->get();
            $second_withdraw = EmployeeSecondVerbalWarning::whereIn('emp_id',$manager_emp)->orwhere('emp_id', Auth::user()->id)->get();
            $second_war = EmployeeSecondVerbalWarning::whereIn('emp_id',$manager_emp)->orwhere('emp_id', Auth::user()->id)->where('status',1)->get();
            $first_withdraw = EmployeeFirstVerbalWarning::whereIn('emp_id',$manager_emp)->orwhere('emp_id', Auth::user()->id)->get();
            $first_war = EmployeeFirstVerbalWarning::whereIn('emp_id',$manager_emp)->orwhere('emp_id', Auth::user()->id)->where('status',1)->get();
            $terminate_emp = Termination::whereIn('employee_id', $manager_emp)->orwhere('employee_id', Auth::user()->id)->get();
    
            /// Personal Excellence admin
            $excel_80100 = PersonalExcellence::where('total_percentage_manager','>=',80)->where('total_percentage_manager','<=',100)->get('total_percentage_manager')->count();
            $excel_6079 = PersonalExcellence::where('total_percentage_manager','>=',60)->where('total_percentage_manager','<=',79)->get('total_percentage_manager')->count();
            $excel_4059 = PersonalExcellence::where('total_percentage_manager','>=',40)->where('total_percentage_manager','<=',59)->get('total_percentage_manager')->count();
            $excel_2039 = PersonalExcellence::where('total_percentage_manager','>=',20)->where('total_percentage_manager','<=',39)->get('total_percentage_manager')->count();
            $excel_119 = PersonalExcellence::where('total_percentage_manager','>=',1)->where('total_percentage_manager','<=',19)->get('total_percentage_manager')->count();
            $excel_total_entry = PersonalExcellence::get()->count();
            if($excel_total_entry != 0){$width_80100 = ($excel_80100*100)/$excel_total_entry;} else{$width_80100 = 0;}
            if($excel_total_entry != 0){$width_6079 = ($excel_6079*100)/$excel_total_entry;} else{$width_6079 = 0;}
            if($excel_total_entry != 0){$width_4059 = ($excel_4059*100)/$excel_total_entry;} else{$width_4059 = 0;}
            if($excel_total_entry != 0){$width_2039 = ($excel_2039*100)/$excel_total_entry;} else{$width_2039 = 0;}
            if($excel_total_entry != 0){$width_119 = ($excel_119*100)/$excel_total_entry;} else{$width_119 = 0;}
    
            /// Manager
            $man_empls =  Employee::where('man_id',Auth::user()->id)->get('id')->pluck('id')->toArray();
            $man_excel_80100 = PersonalExcellence::whereIn('emp_id',$man_empls)->where('total_percentage_manager','>=',80)->where('total_percentage_manager','<=',100)->get('total_percentage_manager')->count();
            $man_excel_6079 = PersonalExcellence::whereIn('emp_id',$man_empls)->where('total_percentage_manager','>=',60)->where('total_percentage_manager','<=',79)->get('total_percentage_manager')->count();
            $man_excel_4059 = PersonalExcellence::whereIn('emp_id',$man_empls)->where('total_percentage_manager','>=',40)->where('total_percentage_manager','<=',59)->get('total_percentage_manager')->count();
            $man_excel_2039 = PersonalExcellence::whereIn('emp_id',$man_empls)->where('total_percentage_manager','>=',20)->where('total_percentage_manager','<=',39)->get('total_percentage_manager')->count();
            $man_excel_119 = PersonalExcellence::whereIn('emp_id',$man_empls)->where('total_percentage_manager','>=',1)->where('total_percentage_manager','<=',19)->get('total_percentage_manager')->count();
            $man_excel_total_entry = PersonalExcellence::whereIn('emp_id',$man_empls)->get()->count();
            if($man_excel_total_entry != 0){$man_width_80100 = ($man_excel_80100*100)/$man_excel_total_entry;} else{$man_width_80100 = 0;}
            if($man_excel_total_entry != 0){$man_width_6079 = ($man_excel_6079*100)/$man_excel_total_entry;} else{$man_width_6079 = 0;}
            if($man_excel_total_entry != 0){$man_width_4059 = ($man_excel_4059*100)/$man_excel_total_entry;} else{$man_width_4059 = 0;}
            if($man_excel_total_entry != 0){$man_width_2039 = ($man_excel_2039*100)/$man_excel_total_entry;} else{$man_width_2039 = 0;}
            if($man_excel_total_entry != 0){$man_width_119 = ($man_excel_119*100)/$man_excel_total_entry;} else{$man_width_119 = 0;}
    
			 
            return view('index',compact('emp_total','per_status_complete','per_status_incomp','man_total', 'emp', 'res', 'promotion', 'appraisal','on_leave','on_leave_data','total_emp','progress_leave','plan_count','unplan_count','pending_persent','unplan_data','plan_data','pending_req', 'linechartdata',
            'last_month_emp_count','current_month_emp_count','emp_per','last_month_resi_count','current_month_resi_count','resi_per','promotion_month', 'promotion_previousmonth','pro_per','excel_80100','excel_6079','excel_4059','excel_2039','excel_119','excel_total_entry','width_80100','width_6079','width_4059','width_2039','width_119','third_withdraw','third_war',
            'second_withdraw','second_war','first_withdraw','first_war','terminate_emp','my_leaves','terminated_emp_under_me','last_month_ter_count','current_month_ter_count','ter_per','man_excel_80100','man_excel_6079','man_excel_4059','man_excel_2039','man_excel_119','man_width_80100','man_width_6079','man_width_4059','man_width_2039','man_width_119'));
		}
		else
		{
			$userd = Auth::user()->id;
            $third_withdraw = EmployeeThirdVerbalWarning::where('emp_id',$userd)->where('status',0)->get();
            $third_war = EmployeeThirdVerbalWarning::where('emp_id',$userd)->where('status',1)->get();
            $second_withdraw = EmployeeSecondVerbalWarning::where('emp_id',$userd)->where('status',0)->get();
            $second_war = EmployeeSecondVerbalWarning::where('emp_id',$userd)->where('status',1)->get();
            $first_withdraw = EmployeeFirstVerbalWarning::where('emp_id',$userd)->where('status',0)->get();
            $first_war = EmployeeFirstVerbalWarning::where('emp_id',$userd)->where('status',1)->get();
            $terminate_emp = Termination::where('employee_id', $userd)->get();
            $promotiondata = Promotion::where('employeeid', $userd)->get();
            $personal_excellence=PersonalExcellence::where('emp_id',$userd)->first();
            $on_leave_data=EmployeeLeave::where('employee_id',$userd)->get();
            $resignation = Resignation::where('employeeid', $userd)->orderBy('id', 'DESC')->get();
            return view('employee-dashboard',compact('third_withdraw','third_war','second_withdraw','second_war','first_withdraw','first_war','terminate_emp','promotiondata','personal_excellence','on_leave_data', 'resignation'));
		}
    }
    public function test2(){
        $row['department']='store/kitchen';
        $data = Department::where("name", "like",'%'.$row['department'].'%')
        ->orderByRaw('name like ? desc', $row['department'])
        ->orderByRaw('instr(name,?) asc', $row['department'])
        ->orderBy('name')->first();
        dd($data);

    }
}
