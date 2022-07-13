<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\EmployeeFirstVerbalWarning;
use App\EmployeeSecondVerbalWarning;
use App\EmployeeThirdVerbalWarning;
use App\ProfilePersonalInformations; 
use App\ProfileEmergencyContact; 
use App\TerminationType;
use App\Promotion;
use App\Termination;
use App\ChangeEmpinformationtion;
use Auth;
use Illuminate\Support\Carbon;
use Validator;
use Redirect;
use DB;
use App\EmployeeDocument; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
class ProfileController extends Controller
{
    public function Profile_employees($id)
	{
        // $userd = Auth::user()->id;
		$userd = $id;
        $emp_profile=Employee::where('id',$userd)->first();
		$per_info=ProfilePersonalInformations::where('emp_id',$userd)->first();  
		$contact=ProfileEmergencyContact::where('emp_id',$userd)->first();	
		$promotiondata = Promotion::where('employeeid', $id)->get();
		$terminate_emp = Termination::where('employee_id', $userd)->first();
		$first_war = EmployeeFirstVerbalWarning::where('emp_id',$userd)->first();  
		$second_war = EmployeeSecondVerbalWarning::where('emp_id',$userd)->first();
		$third_war = EmployeeThirdVerbalWarning::where('emp_id',$userd)->first();
		$documents = EmployeeDocument::where('employee_id',$id)->get();
		$emp_id = Employee::where('id',$id)->first();	
		$change_emp = ChangeEmpinformationtion::where('emp_id',$id)->where('approve_status',1)->first();	 
		$app_status = ProfilePersonalInformations::where('emp_id',$userd)->where('approve_status',1)->pluck('approve_status')->first();  
		$emp_approve_status = ChangeEmpinformationtion::where('emp_id',$userd)->where('approve_status',1)->pluck('approve_status')->first();   
        return view('profile',compact('emp_profile','documents','per_info','contact', 'promotiondata', 'id','userd', 'terminate_emp','first_war','second_war','third_war','emp_id','app_status','change_emp','emp_approve_status'));
    }
	 
	public function add_profile_personal_informations(Request $request){
		$userd = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'marital_status' => 'required',
            'nationality' => 'required' 
        ]);
        if($validator->fails()){
           
            return Redirect::back()->withErrors($validator);
        }
		$per_info=ProfilePersonalInformations::where('emp_id',$userd)->first();		
		if(!empty($per_info))
		{			
			$personal=ProfilePersonalInformations::where('id',$request->id)->first();
			$personal->passport_no=$request->passport_no;
			$personal->passport_expiry_date=Carbon::createFromFormat('d/m/Y', $request->passport_expiry_date)->format('Y-m-d');
			$personal->tel=$request->tel;
			$personal->nationality=$request->nationality;
			$personal->religion=$request->religion;
			$personal->marital_status=$request->marital_status;
			$personal->employment_of_spouse=$request->employment_of_spouse;
			$personal->No_of_children=$request->No_of_children;  
			$personal->approve_status = 0 ; 
			$personal->save();
		}
		else 
		{		
			$personal=new ProfilePersonalInformations();
			$personal->emp_id = Auth::user()->id;
			$personal->passport_no=$request->passport_no;
			$personal->passport_expiry_date=Carbon::createFromFormat('d/m/Y', $request->passport_expiry_date)->format('Y-m-d');
			$personal->tel=$request->tel;
			$personal->nationality=$request->nationality;
			$personal->religion=$request->religion;
			$personal->marital_status=$request->marital_status;
			$personal->employment_of_spouse=$request->employment_of_spouse;
			$personal->No_of_children=$request->No_of_children;        
			$personal->save(); 
		}
        return back();
    }

	public function employee_document(Request $request){
		$validator = Validator::make($request->all(), [
            'title' => 'required',
            'file' => 'required|mimes:jpeg,png,pdf,doc,docs' 
        ]);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }
		$fileName= NULL;
		if(isset($request->file)){
			$fileName = time().'.'.$request->file->extension();  
			$request->file->move(public_path('employee_documents'), $fileName);
		}
		$empDoc = new EmployeeDocument();
		$empDoc->title = $request->title;
		$empDoc->path = $fileName;
		$empDoc->employee_id = $request->id;
		$empDoc->save();
		return Redirect::back()->with("success","Uploaded Successfully");
	}

	public function add_profile_emergency_contact(Request $request){
		$userd = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'primary_name' => 'required',
            'primary_relationship' => 'required',
			'primary_phone1' => 'required' 			
        ]);
        if($validator->fails()){           
            return Redirect::back()->withErrors($validator);
        }
		$per_info=ProfileEmergencyContact::where('emp_id',$userd)->first();		
		if(!empty($per_info))
		{			
			$personal=ProfileEmergencyContact::where('id',$request->id)->first();
			$personal->primary_name=$request->primary_name;
			$personal->primary_relationship=$request->primary_relationship; 
			$personal->primary_phone1=$request->primary_phone1;
			$personal->primary_phone2=$request->primary_phone2;
			$personal->secondary_name=$request->secondary_name;
			$personal->secondary_relationship=$request->secondary_relationship;
			$personal->secondary_phone1=$request->secondary_phone1;
			$personal->secondary_phone2=$request->secondary_phone2;        
			$personal->save();
		}
		else 
		{		
			$personal=new ProfileEmergencyContact();
			$personal->emp_id = Auth::user()->id;
			$personal->primary_name=$request->primary_name;
			$personal->primary_relationship=$request->primary_relationship; 
			$personal->primary_phone1=$request->primary_phone1;
			$personal->primary_phone2=$request->primary_phone2;
			$personal->secondary_name=$request->secondary_name;
			$personal->secondary_relationship=$request->secondary_relationship;
			$personal->secondary_phone1=$request->secondary_phone1;
			$personal->secondary_phone2=$request->secondary_phone2;      
			$personal->save(); 
		}
        return back();
    } 
	public function employee_document_delete($id){
		$del= EmployeeDocument::where('id',$id)->delete();
		if($del){
			return Redirect::back()->with("success","Deleted Successfully");
		}
		else{
			return Redirect::back()->with("error","Error while Deleting");
		}
	}
	
	 public function send_mail_personalinfo_adminapprove(Request $request)
    {
		  
		$emp_id = Auth::user()->id;
		$admin_email = Employee::where('role_id',1)->pluck('email')->first();  
		$hr_email = Employee::where('role_id',5)->pluck('email')->first();  
		$details = [
			'title' => 'Personal Informations Changes Request',
			'body' => 'Please Allow Admin to Change Employee Personal Informations',
			'emp_id' => $emp_id
		];
		Mail::to($admin_email)->send(new \App\Mail\AdminApprove($details));
		Mail::to($hr_email)->send(new \App\Mail\AdminApprove($details)); 
		 
		return back();
	}
	
	 public function send_mail_adminapprove(Request $request)
    {
		 
		$first_name = $request->first_name;
		$old_first_name = $request->old_first_name;
		$last_name = $request->last_name;
		$old_last_name = $request->old_last_name;
		$phone_no = $request->phone_no;
		$old_phone_no = $request->old_phone_no;
		$emp_id = Auth::user()->id;
		$admin_email = Employee::where('role_id',1)->pluck('email')->first();  
		$hr_email = Employee::where('role_id',5)->pluck('email')->first();  
		$details = [
			'title' => 'Personal Informations Changes Request',
			'body' => 'The following employee has requested for change',
			'emp_id' => $emp_id,
			'first_name' => $first_name,
			'old_first_name' => $old_first_name,
			'last_name' => $last_name,
			'old_last_name' => $old_last_name,
			'phone_no' => $phone_no,
			'old_phone_no' => $old_phone_no
		];
		Mail::to($admin_email)->send(new \App\Mail\EmpinfoChangeRequest($details));
		Mail::to($hr_email)->send(new \App\Mail\EmpinfoChangeRequest($details)); 
		
		$emp=new ChangeEmpinformationtion();  
		$emp->emp_id = $request->id;
        $emp->first_name=is_null($request->first_name)?$emp->first_name:$request->first_name;  
        $emp->last_name=is_null($request->last_name)?$emp->last_name:$request->last_name;
		$emp->phone_no=$request->phone_no;
		$emp->approve_status=1;
		$emp->save();
		 
		return back();
	}
	public function add_approve_status_for_employee(Request $request)
    {    
        $userd = Auth::user()->id;  
        $status=ProfilePersonalInformations::where('emp_id',$request->id)->first();             
        $status->approve_status=$request->approve_status; 
        $status->save(); 
        return back();
    }
	public function change_emp_info_approve_status(Request $request)
    {    
        $userd = Auth::user()->id;  
		$emp=Employee::where('id',$request->id)->first();
        $emp->first_name=is_null($request->first_name)?$emp->first_name:$request->first_name;  
        $emp->last_name=is_null($request->last_name)?$emp->last_name:$request->last_name;
		$emp->phone_no=$request->phone_no;
		$emp->save();
		
        $status=ChangeEmpinformationtion::where('emp_id',$request->id)->where('approve_status',1)->first(); 
        $status->approve_status=0; 
        $status->save(); 
        return back();
    }
}
