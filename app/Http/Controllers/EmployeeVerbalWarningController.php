<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeFirstVerbalWarning;
use App\EmployeeSecondVerbalWarning;
use App\EmployeeThirdVerbalWarning;
use App\Employee;
use Auth;

class EmployeeVerbalWarningController extends Controller
{
    public function EmployeeFirstVerbalWarning_list(){ 
        $userd = Auth::user()->id;
        $emp_role = Employee::where('role_id', 3)->get('id'); 
        $emp_name = Employee::where('role_id','!=',1)->get(); 
        $manager_emp = Employee::where('man_id',Auth::id())->get();        
        $first_getw = EmployeeFirstVerbalWarning::where('emp_id',$userd)->get();
        $first_warning_dt = EmployeeFirstVerbalWarning::get();
        $first_war_edit = EmployeeFirstVerbalWarning::get('id');
        $second_emp = EmployeeSecondVerbalWarning::where('emp_id',$userd)->get();
        $second_adman = EmployeeSecondVerbalWarning::all();
        $third_emp = EmployeeThirdVerbalWarning::where('emp_id',$userd)->get();
        $third_adman = EmployeeThirdVerbalWarning::all();
        $manager_e = Employee::where('man_id',Auth::id())->get()->pluck('id')->toArray();
        $war_man = EmployeeFirstVerbalWarning::whereIN('emp_id', $manager_e)->get();
        $war_manag_second = EmployeeSecondVerbalWarning::whereIN('emp_id', $manager_e)->get();
        $war_manag_third = EmployeeThirdVerbalWarning::whereIN('emp_id', $manager_e)->get();
        return view('employee-warning',compact('emp_name','emp_role','first_warning_dt','first_getw','second_emp','second_adman','third_emp','third_adman','war_man','war_manag_second','war_manag_third','manager_emp'));
         
    }
    public function store_EmployeeFirstVerbalWarning(Request $request)
    {    
        $data = $request->all(); 
        $userd = Auth::user()->id;  
        $string_id = Employee::where('id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);       
        $employee_nameid = $request->emp_id;   
        $employee_comments = $request->employee_comments;
        $managers_comments = $request->managers_comments;
        $admin_comments = $request->admin_comments;
        $areas_for_improvement = $request->areas_for_improvement;        
       
	
        $fileName= NULL;	
        $file_arr=array();
        //dd($request->file('fileadd'));
		if(isset($request->fileadd) && !empty($request->fileadd)){	
            foreach ($request->fileadd as $key => $file) {	
                $fileName = time().'.'.$file->extension();  	
                $file->move(public_path('employee_documents'), $fileName);	
                array_push($file_arr,$fileName);
            }	
				
		}
        $i=0;
        foreach($employee_comments as $key => $input) 
        {
            if($employee_comments[$key] || $employee_nameid[$key] || $managers_comments[$key] || $admin_comments[$key] || $areas_for_improvement[$key])
            {                
                $scores = new EmployeeFirstVerbalWarning();                
                $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                $scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                $scores->managers_comments = $managers_comments[$key] ? $managers_comments[$key] : '';  
                $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                $scores->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';
                $scores->warning_by = $emp_id;
                $scores->status = 1;
				$scores->document = $file_arr[$key] ? $file_arr[$key] : '';
                $scores->save();                
            }
           
            $i++;

        }
       
        return back();       
    }
    public function update_EmployeeFirstVerbalWarning(Request $request)
    {    
        $data = $request->all(); 
        $userd = Auth::user()->id;  
        $string_id = Employee::where('id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);       
        $employee_nameid = $request->emp_id;   
        $employee_comments = $request->employee_comments;
        $managers_comments = $request->managers_comments;
        $admin_comments = $request->admin_comments;
        $areas_for_improvement = $request->areas_for_improvement;        
        $id = $request->getid;
		           
		
		$i=0; 

        foreach($employee_comments as $key => $input) 
        {
            if($employee_comments[$key] || $employee_nameid[$key] || $managers_comments[$key] || $admin_comments[$key] || $areas_for_improvement[$key])
            {    
                if(isset($id[$key]))
                {          
                    $scores= EmployeeFirstVerbalWarning::where('id',$id[$key])->first();   

                    $fileName= NULL;    
                    $file_arr=array();
                    if(!$scores->document){
                        if(isset($request->fileadd) && !empty($request->fileadd)){
                            foreach ($request->fileadd as $key1 => $file) { 

                                $fileName = time().'.'.$file->extension();      
                                $file->move(public_path('employee_documents'), $fileName);  
                                array_push($file_arr,$fileName);
                            }
                        }
                    }    

                    $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                    $scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                    $scores->managers_comments = $managers_comments[$key] ? $managers_comments[$key] : '';  
                    $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                    $scores->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';
                    $scores->warning_by = $emp_id;
					$scores->document=(!$file_arr)?$scores->document:$file_arr[$key];
					 
                    $scores->save();  
                }
                else
                {	
                    $fileName= NULL;    
                    $file_arr=array();
                    if(isset($request->fileadd) && !empty($request->fileadd)){
                        foreach ($request->fileadd as $key1 => $file) { 

                            $fileName = time().'.'.$file->extension();      
                            $file->move(public_path('employee_documents'), $fileName);  
                            array_push($file_arr,$fileName);
                            $scores = new EmployeeSecondVerbalWarning(); 
                             $scores->document= (!$fileName) ? $fileName : $fileName;   
                        }
                    }
					 
                    $scores = new EmployeeFirstVerbalWarning();               
                    $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                    $scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                    $scores->managers_comments = $managers_comments[$key] ? $managers_comments[$key] : '';  
                    $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                    $scores->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';
                    $scores->warning_by = $emp_id;
				//	$files = $request->fileadd;

					//$scores->document= $file_arr[$key] ? $file_arr[$key] : ''; 
                    $scores->save();
                }              
            }
			$i++;
        }
        return back();       
    }
    public function delete_EmployeeVerbalWarning(Request $request){        
        $warning= EmployeeFirstVerbalWarning::where('id',$request->id)->delete();
        if($warning==1){ dd();
            echo json_encode("1");
        }
        else{
            echo json_encode("0");
        }
    }
    public function store_EmployeeSecondVerbalWarning(Request $request)
    {    

        $data = $request->all(); 
        $userd = Auth::user()->id;  
        $string_id = Employee::where('id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);      
        $employee_nameid = $request->emp_id;       
        $employee_comments = $request->employee_comments;
        $managers_comments = $request->managers_comments;
        $admin_comments = $request->admin_comments;
        $areas_for_improvement = $request->areas_for_improvement;   

        $fileName= NULL;   
        $file_arr=array();
        if(isset($request->fileadd) && !empty($request->fileadd)){  

            foreach ($request->fileadd as $key => $file) { 
            
                $fileName = time().'.'.$file->extension();      
                $file->move(public_path('employee_documents'), $fileName);  
                array_push($file_arr,$fileName);
            }   
                
        }     
        $i=0;
        foreach($employee_comments as $key => $input) 
        {
            if($employee_comments[$key] || $employee_nameid[$key] || $managers_comments[$key] || $admin_comments[$key] || $areas_for_improvement[$key])
            {                
                $scores = new EmployeeSecondVerbalWarning();                
                $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                $scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                $scores->managers_comments = $managers_comments[$key] ? $managers_comments[$key] : '';  
                $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                $scores->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';
                $scores->warning_by = $emp_id;
                $scores->document = $file_arr[$key] ? $file_arr[$key] : '';
                $scores->status = 1;
                $scores->save();                
            }

            $i++;
        }
        return back();       
    }
    public function update_EmployeeSecondVerbalWarning(Request $request)
    {    
        
        $data = $request->all(); 
        $userd = Auth::user()->id;  
        $string_id = Employee::where('id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);      
        $employee_nameid = $request->emp_id;       
        $employee_comments = $request->employee_comments;
        $managers_comments = $request->managers_comments;
        $admin_comments = $request->admin_comments;
        $areas_for_improvement = $request->areas_for_improvement;        
        $id = $request->getid;

        

        foreach($employee_comments as $key => $input) 
        {
            if($employee_comments[$key] || $employee_nameid[$key] || $managers_comments[$key] || $admin_comments[$key] || $areas_for_improvement[$key])
            {     
                if(isset($id[$key]))
                {

                    $score = EmployeeSecondVerbalWarning::where('id',$id[$key])->first(); 
                   // dd($score->document);
                  $fileName= NULL;    
                    $file_arr=array();
                    if(!$score->document){
                        if(isset($request->fileadd) && !empty($request->fileadd)){
                            foreach ($request->fileadd as $key1 => $file) { 

                                $fileName = time().'.'.$file->extension();      
                                $file->move(public_path('employee_documents'), $fileName);  
                                array_push($file_arr,$fileName);
                            }
                        }
                    }

                  // dd($admin_comments[$key],$file_arr);
                    $score->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                    $score->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                    $score->managers_comments = $managers_comments[$key] ? $managers_comments[$key] : '';  
                    $score->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                    $score->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';
                    $score->document=(!$file_arr)?$score->document:$file_arr[$key];
                    $score->warning_by = $emp_id; 
                    $score->save();
                }
                else 
                {
                    $fileName= NULL;    
                    $file_arr=array();
                    if(isset($request->fileadd) && !empty($request->fileadd)){
                        foreach ($request->fileadd as $key1 => $file) { 

                            $fileName = time().'.'.$file->extension();      
                            $file->move(public_path('employee_documents'), $fileName);  
                            array_push($file_arr,$fileName);
                            $scores = new EmployeeSecondVerbalWarning(); 
                             $scores->document= (!$fileName) ? $fileName : $fileName;   
                        }
                    }
                    
                   // dump($file_arr[$key]);
                    $scores = new EmployeeSecondVerbalWarning();                
                    $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                    $scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                    $scores->managers_comments = $managers_comments[$key] ? $managers_comments[$key] : '';  
                    $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                    $scores->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';

                    //$scores->document= (!$file_arr[$key]) ? $file_arr[$key] : '';
                    $scores->warning_by = $emp_id;
                    $scores->save();
                }                
            }
        }
        return back();        
    }
    public function delete_EmployeeSecondVerbalWarning(Request $request){        
        $warning= EmployeeSecondVerbalWarning::where('id',$request->id)->delete();
        if($warning==1){ dd();
            echo json_encode("1");
        }
        else{
            echo json_encode("0");
        }
    }
    public function store_EmployeeThirdVerbalWarning(Request $request)
    {    
        $data = $request->all(); 
        $userd = Auth::user()->id;  
        $string_id = Employee::where('id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id); 

        $employee_comments = $request->employee_comments;
        $managers_comments = $request->managers_comments;
        $admin_comments = $request->admin_comments;       
       $employee_nameid = $request->emp_id;  

       $fileName= NULL;   
        $file_arr=array();
        if(isset($request->fileadd) && !empty($request->fileadd)){  
            foreach ($request->fileadd as $key => $file) {  
                $fileName = time().'.'.$file->extension();      
                $file->move(public_path('employee_documents'), $fileName);  
                array_push($file_arr,$fileName);
            }   
                
        }     
        $i=0;

        foreach($employee_comments as $key => $input) 
        {
            if($employee_comments[$key] || $employee_nameid[$key] || $managers_comments[$key] || $admin_comments[$key])
            {                
                $scores = new EmployeeThirdVerbalWarning();                
                $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                $scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                $scores->managers_comments = $managers_comments[$key] ? $managers_comments[$key] : '';  
                $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                $scores->document = $file_arr[$key] ? $file_arr[$key] : '';
                $scores->warning_by = $emp_id;
                $scores->status = 1;
                $scores->save();                
            }
            $i++;
        }
        return back();       
    }
    public function update_EmployeeThirdVerbalWarning(Request $request)
    {     
        $data = $request->all(); 
        $userd = Auth::user()->id;  
        $string_id = Employee::where('id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id); 
        $employee_comments = $request->employee_comments;
        $managers_comments = $request->managers_comments;
        $admin_comments = $request->admin_comments;       
        $employee_nameid = $request->emp_id;
        $id = $request->getid;    


        foreach($employee_comments as $key => $input) 
        {
            if($employee_comments[$key] || $employee_nameid[$key] || $managers_comments[$key] || $admin_comments[$key])
            {   
                if(isset($id[$key]))
                {              
                    $scores= EmployeeThirdVerbalWarning::where('id',$id)->first();
                     $fileName= NULL;    
                    $file_arr=array();
                    if(!$score->document){
                        if(isset($request->fileadd) && !empty($request->fileadd)){
                            foreach ($request->fileadd as $key1 => $file) { 

                                $fileName = time().'.'.$file->extension();      
                                $file->move(public_path('employee_documents'), $fileName);  
                                array_push($file_arr,$fileName);
                            }
                        }
                    }

                    $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                    $scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                    $scores->managers_comments = $managers_comments[$key] ? $managers_comments[$key] : '';  
                    $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                    $scores->document=is_null($file_arr[$key])?$scores->document:$file_arr[$key];
                    $scores->warning_by = $emp_id;
                    $scores->save();
                }
                else
                {
                     $fileName= NULL;    
                    $file_arr=array();
                    if(isset($request->fileadd) && !empty($request->fileadd)){
                        foreach ($request->fileadd as $key1 => $file) { 

                            $fileName = time().'.'.$file->extension();      
                            $file->move(public_path('employee_documents'), $fileName);  
                            array_push($file_arr,$fileName);
                            $scores = new EmployeeSecondVerbalWarning(); 
                             $scores->document= (!$fileName) ? $fileName : $fileName;   
                        }
                    }

                    $scores = new EmployeeThirdVerbalWarning();                
                    $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                    $scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                    $scores->managers_comments = $managers_comments[$key] ? $managers_comments[$key] : '';  
                    $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                   // $scores->document= $file_arr[$key] ? $file_arr[$key] : '';
                    $scores->warning_by = $emp_id;
                    $scores->save();
                }                
            }
        }
        return back();       
    }
    public function delete_EmployeeThirdVerbalWarning(Request $request){        
        $warning= EmployeeThirdVerbalWarning::where('id',$request->id)->delete();
        if($warning==1){ dd();
            echo json_encode("1");
        }
        else{
            echo json_encode("0");
        }
    }
    public function Profile_EmployeeVerbalWarning_list($id){ 
        $userd = Auth::user()->id;
        $first_comment = EmployeeFirstVerbalWarning::where('emp_id', $id)->get();
        $second_comment = EmployeeSecondVerbalWarning::where('emp_id', $id)->get();
        $third_comment = EmployeeThirdVerbalWarning::where('emp_id', $id)->get(); 
        $emp_role = Employee::where('role_id', 3)->get('id');         
        $first_getw = EmployeeFirstVerbalWarning::where('emp_id',$userd)->get();
        $first_warning_dt = EmployeeFirstVerbalWarning::all();
        $first_war_edit = EmployeeFirstVerbalWarning::get('id');
        $second_emp = EmployeeSecondVerbalWarning::where('emp_id',$userd)->get();
        $second_adman = EmployeeSecondVerbalWarning::all();
        $third_emp = EmployeeThirdVerbalWarning::where('emp_id',$userd)->get();
        $third_adman = EmployeeThirdVerbalWarning::all();
        return view('/profile-employee-warning',compact('first_comment', 'second_comment', 'third_comment', 'emp_role','first_warning_dt','first_getw','second_emp','second_adman','third_emp','third_adman'));
         
    }
    public function changeFirstWarningstatus($type,$id){ 
        $data=EmployeeFirstVerbalWarning::where('id',$id)->first();
        $data->status=$type;
        $data->save();
        return back();
    }
    public function changeSecondWarningstatus($type,$id){ 
        $data=EmployeeSecondVerbalWarning::where('id',$id)->first();
        $data->status=$type;
        $data->save();
        return back();
    }
    public function changeThirdWarningstatus($type,$id){ 
        $data=EmployeeThirdVerbalWarning::where('id',$id)->first();
        $data->status=$type;
        $data->save();
        return back();
    }
}
