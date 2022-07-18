<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveType;
use App\EmployeeLeave;
use App\Employee;
use Auth;
use Carbon\Carbon;
use App\Notification;
use App\Events\leaveAdded;
use DB;

class EmployeeLeaveController extends Controller
{
    public function index()
    {
        $lt=LeaveType::first();  
        $total_leaves=0;
        $sick_days=0;
        $hospitalisation_days=0;
        $maternity_days=0;
        $paternity_days=0;
        if($lt){
        $total_leaves+=is_null($lt->annual_days)?0:$lt->annual_days;
        $total_leaves+=is_null($lt->sick_days)?0:$lt->sick_days;
        $total_leaves+=is_null($lt->hospitalisation_days)?0:$lt->hospitalisation_days;
		if(Auth::user()->gender==1){
			$total_leaves+=is_null($lt->maternity_days)?0:$lt->maternity_days;
		}
		if(Auth::user()->gender==0){
			$total_leaves+=is_null($lt->paternity_days)?0:$lt->paternity_days;
		}
		
        $sick_days=is_null($lt->sick_days)?0:$lt->sick_days;
        $hospitalisation_days+=is_null($lt->hospitalisation_days)?0:$lt->hospitalisation_days;
		if(Auth::user()->gender==1){
			$maternity_days+=is_null($lt->maternity_days)?0:$lt->maternity_days;
		}
		if(Auth::user()->gender==0){
			$paternity_days+=is_null($lt->paternity_days)?0:$lt->paternity_days;
		}
		
        }
        $data=EmployeeLeave::where('employee_id',Auth::id())->orderBy('id','desc')->get();
        $my_manager_name=Employee::where('id',Auth::user()->man_id)->first();
        
        $total_sicks = EmployeeLeave::where('employee_id',Auth::id())->where('leave_type_id',1)->get();
        $total_sick_taken =0;
        foreach($total_sicks as $val){
            $total_sick_taken+=$val->number_of_days;
        }
       
        $total_hospitalisations= EmployeeLeave::where('employee_id',Auth::id())->where('leave_type_id',2)->get();
        $total_hospitalisation_taken=0;
        foreach($total_hospitalisations as $val){
            $total_hospitalisation_taken+=$val->number_of_days;
        }

        $total_maternities = EmployeeLeave::where('employee_id',Auth::id())->where('leave_type_id',3)->get();
        $total_maternity_taken = 0;
        foreach($total_maternities as $val){
            $total_maternity_taken+=$val->number_of_days; 
        }

        $total_paternity_taken = 0;
        $total_paternities= EmployeeLeave::where('employee_id',Auth::id())->where('leave_type_id',4)->get();
        foreach($total_paternities as $val){
            $total_paternity_taken+=$val->number_of_days;
        }

        $taken_leaves=0;
        if(!empty($data)){
            foreach($data as $val)
            {
                $taken_leaves+=$val->number_of_days;
            }        
        }
        $remaining_leaves=$total_leaves-$taken_leaves;
		$remaining_maternity=$maternity_days-$total_maternity_taken;   
		  
        return view('leaves-employee',compact('total_maternity_taken','total_paternity_taken',
        'maternity_days','paternity_days','total_hospitalisation_taken','hospitalisation_days','total_sick_taken','sick_days','lt','data','total_leaves','taken_leaves','remaining_leaves','my_manager_name','remaining_maternity'));
    } 
    public function save_leave(Request $request){
	
		
        $el=new EmployeeLeave();
        $el->remaining_leave=$request->remaining_leaves;
        $fdate = strtotime($request->start_date);
        $el->from_date=date('Y-m-d',$fdate);
        $tdate = strtotime($request->end_date);
        $el->to_date=date('Y-m-d',$tdate);
        $el->number_of_days=$request->number_of_days;
        $el->leave_reason=$request->leave_reason;
        $el->leave_type_id=$request->leave_type_id;
        $el->employee_id=Auth::id();
        $el->manager_id=Auth::user()->man_id;
		$fileName= NULL;
		if(isset($request->document_add)){
			$fileName = time().'.'.$request->document_add->extension();  
			$request->document_add->move(public_path('employee_documents'), $fileName);
		}
		 
		$el->employee_documents = $fileName;   
		 
        $el->save();
        $admin_ids=array();
        $admins=Employee::where('role_id',1)->get();
        $message = Auth::user()->first_name.' '.Auth::user()->last_name.' has put leave';
		$man_leave= "leaves";
        foreach($admins as $val)
        {
            array_push($admin_ids,$val->id); 
            Notification::create(['employeeid' =>$val->id, 'message' => $message, 'slug' =>$man_leave]);

        }
        Notification::create(['employeeid' => Auth::user()->man_id, 'message' => $message, 'slug' =>$man_leave]);
        event(new leaveAdded($message,Auth::user()->man_id,$admin_ids,));

        return json_encode("1");
    }
    public function delete_leave(Request $request,$id){
        $data=EmployeeLeave::where('id',$id)->first();
        if($data){
            $leave_date=Carbon::createFromFormat('Y-m-d',$data->from_date);
            $today_date=Carbon::today()->format('Y-m-d');
            $result = $leave_date->lt($today_date);
            if($data->status!=1){
                return back()->with('error','You can not delete now !!');
            }
            else if($result==true){
                return back()->with('error','Timelimit for deleting is over ! you cant delete now');
            }
            elseif(!EmployeeLeave::where('employee_id',Auth::id())->where('id',$id)->exists()){
                return back()->with('error','anauthorized access !!');
            }
            else{
                EmployeeLeave::where('id',$id)->delete();
            }
        }
        return back();
    }
    public function edit_leave(Request $request,$id){
        $lt=LeaveType::first();
        $total_leaves=0;
        $taken_leaves=0;
		$sick_days=0;
        $hospitalisation_days=0;
		$maternity_days=0;
		$paternity_days=0;
        if($lt){
				$total_leaves+=is_null($lt->annual_days)?0:$lt->annual_days;
				$total_leaves+=is_null($lt->sick_days)?0:$lt->sick_days;
				$total_leaves+=is_null($lt->hospitalisation_days)?0:$lt->hospitalisation_days;
				if(Auth::user()->gender==1){
					$total_leaves+=is_null($lt->maternity_days)?0:$lt->maternity_days;
				}
				if(Auth::user()->gender==0){
					$total_leaves+=is_null($lt->paternity_days)?0:$lt->paternity_days;
				}
				$sick_days=is_null($lt->sick_days)?0:$lt->sick_days;
				$hospitalisation_days+=is_null($lt->hospitalisation_days)?0:$lt->hospitalisation_days;
				if(Auth::user()->gender==1){
					$maternity_days+=is_null($lt->maternity_days)?0:$lt->maternity_days;
				}
				if(Auth::user()->gender==0){
					$paternity_days+=is_null($lt->paternity_days)?0:$lt->paternity_days;
				}
            }
		$total_sicks = EmployeeLeave::where('employee_id',Auth::id())->where('leave_type_id',1)->get();
        $total_sick_taken =0;
        foreach($total_sicks as $val){
            $total_sick_taken+=$val->number_of_days;
        }
       
        $total_hospitalisations= EmployeeLeave::where('employee_id',Auth::id())->where('leave_type_id',2)->get();
        $total_hospitalisation_taken=0;
        foreach($total_hospitalisations as $val){
            $total_hospitalisation_taken+=$val->number_of_days;
        }

        $total_maternities = EmployeeLeave::where('employee_id',Auth::id())->where('leave_type_id',3)->get();
        $total_maternity_taken = 0;
        foreach($total_maternities as $val){
            $total_maternity_taken+=$val->number_of_days; 
        }

        $total_paternity_taken = 0;
        $total_paternities= EmployeeLeave::where('employee_id',Auth::id())->where('leave_type_id',4)->get();
        foreach($total_paternities as $val){
            $total_paternity_taken+=$val->number_of_days;
        }
            $el=EmployeeLeave::where('employee_id',Auth::id())->orderBy('id','desc')->get();           
            if(!empty($el)){
                foreach($el as $val)
                {
                    $taken_leaves+=$val->number_of_days;
                }        
            }
        $remaining_leaves=$total_leaves-$taken_leaves;
        $data=EmployeeLeave::where('id',$id)->first();
        return view('edit_emp_leave',compact('total_maternity_taken','total_paternity_taken',
        'total_hospitalisation_taken'
		,'total_sick_taken','data','total_leaves',
		'remaining_leaves','maternity_days','paternity_days','sick_days','hospitalisation_days'));
    }
    public function update_leave(Request $request){
		
				
        $data=EmployeeLeave::where('id',$request->id)->first();   
        if($data){

            $leave_date=Carbon::createFromFormat('Y-m-d',$data->from_date);
            $today_date=Carbon::today()->format('Y-m-d');
            $result = $leave_date->lt($today_date);
            if($data->status!=1){
                return response()->json(['message'=>'You can not edit  !!','status'=>0]);
            }
            else if($result==true){
                return response()->json(['message'=>'Timelimit for editing is over ! you cant delete now','status'=>0]);
            }
            else{
                $data->remaining_leave=$request->remaining_leaves;
                $fdate = strtotime($request->start_date);
                $data->from_date=date('Y-m-d',$fdate);
                $tdate = strtotime($request->end_date);
                $data->to_date=date('Y-m-d',$tdate);
                $data->number_of_days=$request->number_of_days;
                $data->leave_reason=$request->leave_reason;
                $data->leave_type_id=$request->leave_type_id;
                $data->employee_id=Auth::id();
				$fileName= NULL;
				if(isset($request->document_add)){
					$fileName = time().'.'.$request->document_add->extension();  
					$request->document_add->move(public_path('employee_documents'), $fileName);
				}
				$data->employee_documents=is_null($fileName)?$data->employee_documents:$fileName;
                $data->save();
            }
            
        }
        else{
            return back()->with('error','Record Not Found !!');
        }
    }
	
	public function maternity_remaining_leave_type(Request $request){			 
		$taken_maternity=0;
		$maternity_days=0;
		$lt=LeaveType::first(); 
		if(Auth::user()->gender==1){
			$maternity_days+=is_null($lt->maternity_days)?0:$lt->maternity_days;
		}
		if($request->id){
		$leave=DB::table('employee_leaves')->where('id','!=',$request->id)->where('employee_id',Auth::user()->id)->where('leave_type_id',$request->typeid)->get('number_of_days');  
		} else {
		$leave=DB::table('employee_leaves')->where('employee_id',Auth::user()->id)->where('leave_type_id',$request->typeid)->get('number_of_days'); 
		}
		foreach($leave as $val1)
		{
			$taken_maternity+=$val1->number_of_days;
		} 		    
		$total_mat = $maternity_days-$taken_maternity;
		if($total_mat >= $request->days){
			$status= true;
		}
		else{
			$status= false;
		}
		return response()->json($status); 
    }
	
	public function Sick_remaining_leave_type(Request $request){			 
		$taken_sick=0;
		$sick_days=0;
		$lt=LeaveType::first(); 
		 
			$sick_days+=is_null($lt->sick_days)?0:$lt->sick_days;
		 
		$leave=DB::table('employee_leaves')->where('employee_id',Auth::user()->id)->where('leave_type_id',$request->typeid)->get('number_of_days');  
		foreach($leave as $val1)
		{
			$taken_sick+=$val1->number_of_days;
		} 		    
		$total_sick = $sick_days-$taken_sick;
		if($total_sick >= $request->days){
			$status= true;
		}
		else{
			$status= false;
		}
		return response()->json($status); 
    }
	
	public function Edit_Sick_remaining_leave_type(Request $request){			 
		$taken_sick=0;
		$sick_days=0;
		$lt=LeaveType::first(); 
		 
			$sick_days+=is_null($lt->sick_days)?0:$lt->sick_days;
		  
		$leave=DB::table('employee_leaves')->where('id','!=',$request->id)->where('employee_id',Auth::user()->id)->where('leave_type_id',$request->typeid)->get('number_of_days');  
		foreach($leave as $val1)
		{
			$taken_sick+=$val1->number_of_days;
		} 		    
		$total_sick = $sick_days-$taken_sick;
		if($total_sick >= $request->days){
			$status= true;
		}
		else{
			$status= false;
		}
		return response()->json($status); 
    }
	
	public function Hospitalisation_remaining_leave_type(Request $request){			 
		$taken_hospital=0;
		$hospitalisation_days=0;
		$lt=LeaveType::first(); 
		
		$hospitalisation_days+=is_null($lt->hospitalisation_days)?0:$lt->hospitalisation_days;		 
		if($request->id){
		$leave=DB::table('employee_leaves')->where('id','!=',$request->id)->where('employee_id',Auth::user()->id)->where('leave_type_id',$request->typeid)->get('number_of_days');  
		} else {
		$leave=DB::table('employee_leaves')->where('employee_id',Auth::user()->id)->where('leave_type_id',$request->typeid)->get('number_of_days');  
		}
		foreach($leave as $val1)
		{
			$taken_hospital+=$val1->number_of_days;
		} 		    
		$total_hospital = $hospitalisation_days-$taken_hospital;  
		if($total_hospital >= $request->days){
			$status= true;
		}
		else{
			$status= false;
		}
		return response()->json($status); 
    }
	
	public function Paternity_remaining_leave_type(Request $request){			 
		$taken_paternity=0;
		$paternity_days=0;
		$lt=LeaveType::first(); 
		
		if(Auth::user()->gender==0){
			$paternity_days+=is_null($lt->paternity_days)?0:$lt->paternity_days;
		}	 
		if($request->id){ 
		$leave=DB::table('employee_leaves')->where('id','!=',$request->id)->where('employee_id',Auth::user()->id)->where('leave_type_id',$request->typeid)->get('number_of_days');
		} else {
		$leave=DB::table('employee_leaves')->where('employee_id',Auth::user()->id)->where('leave_type_id',$request->typeid)->get('number_of_days'); 
		}		
		foreach($leave as $val1)
		{
			$taken_paternity+=$val1->number_of_days;
		} 		    
		$total_paternity = $paternity_days-$taken_paternity;
		if($total_paternity >= $request->days){
			$status= true;
		}
		else{
			$status= false;
		}
		return response()->json($status); 
    }
}
