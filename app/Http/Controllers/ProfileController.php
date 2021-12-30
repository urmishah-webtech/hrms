<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\ProfilePersonalInformations; 
use App\ProfileEmergencyContact; 
use Auth;
use Illuminate\Support\Carbon;
use Validator;
use Redirect;
use DB;
 
class ProfileController extends Controller
{
    public function Profile_employees()
	{
        $userd = Auth::user()->id;
        $emp_profile=Employee::where('user_id',$userd)->first(); 		 
		$per_info=ProfilePersonalInformations::where('user_id',$userd)->first();
		$contact=ProfileEmergencyContact::where('user_id',$userd)->first();		
        return view('profile',compact('emp_profile','per_info','contact'));
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
		$per_info=ProfilePersonalInformations::where('user_id',$userd)->first();		
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
			$personal->save();
		}
		else 
		{		
			$personal=new ProfilePersonalInformations();
			$personal->user_id = Auth::user()->id;
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
		$per_info=ProfileEmergencyContact::where('user_id',$userd)->first();		
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
			$personal->user_id = Auth::user()->id;
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
}
