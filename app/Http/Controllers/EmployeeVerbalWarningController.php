<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeFirstVerbalWarning;
use App\EmployeeSecondVerbalWarning;
use App\EmployeeThirdVerbalWarning;
use App\employee_all_verbal_warnings;
use App\Events\EmployeeWarning;
use App\Notification;
use App\Employee;
use Auth;
use Illuminate\Support\Facades\Response;

class EmployeeVerbalWarningController extends Controller
{
    public function EmployeeFirstVerbalWarning_list(){ 
        $userd = Auth::user()->id;
        $emp_role = Employee::where('role_id', 3)->get('id'); 
        $emp_name = Employee::where('role_id','!=',1)->get(); 
        $manager_emp =  Employee::where('man_id',Auth::id())->get();    
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
        $all_all_warning = employee_all_verbal_warnings::with('employee_name')->get();
        $getrecord = [];
        $emp_name1 = [];
       // dd($emp_name);

        return view('employee-warning',compact('emp_name','emp_role','first_warning_dt','first_getw','second_emp','second_adman','third_emp','third_adman','war_man','war_manag_second','war_manag_third','manager_emp','all_all_warning','getrecord','emp_name1'));
         
    }

     public function downloadwarmingimage($download)
    {
       
        $filepath = public_path('/images/chain/'.$download);

        return Response::download($filepath); 
    }
    public function store_EmployeeFirstVerbalWarning(Request $request)
    {    
        $data = $request->all(); 
        $userd = Auth::user()->id;  

        $checkexists = employee_all_verbal_warnings::where('emp_id', $request->emp_id)->exists();

        if($checkexists)
        {
            return back();
        }

        $string_id = Employee::where('id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);  

        $fileaddnamejson = (array) null;
        if($request->hasFile('fileadd'))
        {
            foreach($request->file('fileadd') as $image)
            {
                    $fileadd = $image;
                    $fileaddName = rand() . '.' . $fileadd->getClientOriginalExtension();
                    $fileaddPath = public_path('/images/chain/');
                    $fileadd->move($fileaddPath, $fileaddName);
                    $fileaddnamejson[] = $fileaddName;
            }
        }



        $warnings_all = new employee_all_verbal_warnings();                
        $warnings_all->emp_id = ($request->emp_id) ? $request->emp_id : '';
       // $warnings_all->employee_comments_first = json_encode($request->employee_comments);
        $warnings_all->hr_input_first = ($request->hr_input) ? json_encode($request->hr_input) : '';  
        $warnings_all->admin_comments_first = ($request->admin_comments) ? json_encode($request->admin_comments) : '';
        $warnings_all->areas_for_improvement_first = ($request->areas_for_improvement) ? json_encode($request->areas_for_improvement) : '';
        $warnings_all->warning_by = $emp_id;
        $warnings_all->warmingstatus = 1;
        $warnings_all->employee_documents_first = ($fileaddnamejson) ? json_encode($fileaddnamejson) : '';
        $warnings_all->save();  

        $man_name = Employee::where('id',$request->emp_id)->pluck('first_name')->first();   
        $adminid = Employee::where('role_id', 1)->first()->id;
        $hrid = Employee::where('role_id', 5)->first()->id;
        $empmessage = 'Your  First Warning Created by '.$man_name.' (Reporting manager)';
        Notification::create(['employeeid' => $warnings_all->emp_id, 'message' => $empmessage]);
        event(new EmployeeWarning($empmessage, $warnings_all->emp_id));
        $empname = Employee::find($request->emp_id)->pluck('first_name')->first();  
        $message = $empname.' Received First Warning from '.$man_name.' (Reporting manager)';
        Notification::create(['employeeid' => $adminid, 'message' => $message]);
        event(new EmployeeWarning($message, $adminid));
        Notification::create(['employeeid' => $hrid, 'message' => $message]);
        event(new EmployeeWarning($message, $hrid));

        /*$employee_nameid = $request->emp_id;   
        $employee_comments = $request->employee_comments;
        $hr_input = $request->hr_input;
        $admin_comments = $request->admin_comments;
        $areas_for_improvement = $request->areas_for_improvement; */       
       
	
       // $fileName= NULL;	
        //$file_arr=array();
        //dd($request->file('fileadd'));
       // $i=0;
        // dd($request->all()); 
        /*foreach($admin_comments as $key => $input) 
        {
            if($admin_comments[$key] || $employee_nameid[$key] ||  $areas_for_improvement[$key] || $hr_input[$key])
            {  

                $fileName= NULL;   

                if(isset($request->fileadd[$i]) && !empty($request->fileadd[$i])){
                        $fileName = rand().'.'.$request->fileadd[$key]->extension();      
                        $request->fileadd[$i]->move(public_path('employee_documents'), $fileName);  
                         $imagesave = $fileName;  
                        
                }else{
                    $imagesave = 'NULL' ;   
                }    

                $scores = new EmployeeFirstVerbalWarning();                
                $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
               // $scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                $scores->hr_input = $hr_input[$key] ? $hr_input[$key] : '';  
                $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                $scores->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';
                $scores->warning_by = $emp_id;
                $scores->status = 1;
				$scores->document = $imagesave;
                $scores->save();                
            }
           
            $i++;
			
			
        }*/

        $emp = Employee::find($request->emp_id)->first();    
            $man_name = Employee::where('id',$emp->man_id)->pluck('first_name')->first();   
            $adminid = Employee::where('role_id', 1)->first()->id;
            $hrid = Employee::where('role_id', 5)->first()->id;
            $empmessage = 'Your  First Warning Created by '.$man_name.' (Reporting manager)';
            Notification::create(['employeeid' => $warnings_all->emp_id, 'message' => $empmessage]);
            event(new EmployeeWarning($empmessage, $warnings_all->emp_id));
            $empname = Employee::find($request->emp_id)->pluck('first_name')->first();  
            $message = $empname.' Received First Warning from '.$man_name.' (Reporting manager)';
            Notification::create(['employeeid' => $adminid, 'message' => $message]);
            event(new EmployeeWarning($message, $adminid));
            Notification::create(['employeeid' => $hrid, 'message' => $message]);
            event(new EmployeeWarning($message, $hrid));
        return back();       
    }

    public function EditEmployeeWarning($id){


        $getrecord = employee_all_verbal_warnings::find($id);

        $emp_name1 = Employee::find($getrecord->emp_id);
        // dd($getrecord);
        return view('employee-warning-edit',compact('getrecord','emp_name1'));
       // return response()->json([
         //   'status' => 200,
           // 'warning' => $getrecord,
           // 'emp_name' => $emp_name,  
        //]);

    }
    public function showEmployeeWarning($id){

        $getrecord = employee_all_verbal_warnings::where('emp_id',$id)->first();
        if($getrecord){
             return response()->json([
                'getrecordid' => $getrecord->id,
                'status' => 200 
            ]);
        }else{
            return response()->json([
                'status' => 400 
            ]);
        }

    }
    public function update_EmployeeFirstVerbalWarning(Request $request)
    {    
        $data = $request->all(); 
        $userd = Auth::user()->id;  
        $string_id = Employee::where('id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);       
        $employee_nameid = $request->emp_id;   

        $warnings_all =  employee_all_verbal_warnings::find($request->indexid);  

        if($request->hasFile('edit_fileadd'))
        {
            foreach($request->file('edit_fileadd') as $image1)
            {
                $edit_fileadd = $image1;
                $edit_fileaddName = rand() . '.' . $edit_fileadd->getClientOriginalExtension();
                $edit_fileaddPath = public_path('/images/chain/');
                $edit_fileadd->move($edit_fileaddPath, $edit_fileaddName);
                $edit_fileaddNamejson[] = $edit_fileaddName;
            }
        }else{
            $edit_fileaddNamejson = ($warnings_all->employee_documents_first) ? $warnings_all->employee_documents_first : '';
        }

        if($request->hasFile('second_fileadd_second'))
        {
            foreach($request->file('second_fileadd_second') as $image2)
            {
                $edit_fileadd = $image2;
                $second_fileadd_secondName = rand() . '.' . $edit_fileadd->getClientOriginalExtension();
                $edit_fileaddPath = public_path('/images/chain/');
                $edit_fileadd->move($edit_fileaddPath, $second_fileadd_secondName);
                $second_fileadd_secondjson[] = $second_fileadd_secondName;
            }
        }else{
            $second_fileadd_secondjson[] = ($warnings_all->employee_documents_second) ? $warnings_all->employee_documents_second : '';
        }

        if($request->hasFile('third_fileadd_third'))
        {
            foreach($request->file('third_fileadd_third') as $image3)
            {
                $edit_fileadd = $image3;
                $third_fileadd_thirdName = rand() . '.' . $edit_fileadd->getClientOriginalExtension();
                $edit_fileaddPath = public_path('/images/chain/');
                $edit_fileadd->move($edit_fileaddPath, $third_fileadd_thirdName);
                $third_fileadd_thirdNamejson[] = $third_fileadd_thirdName;
            }
        }else{
            $third_fileadd_thirdNamejson[] = ($warnings_all->employee_documents_third) ? $warnings_all->employee_documents_third : '';
        }

        
        if($request->status == 1){                      
            $warnings_all->emp_id = $retVal = ($request->edit_emp_id) ? $request->edit_emp_id : $warnings_all->emp_id;
            $warnings_all->hr_input_first = ($request->edit_hr_input) ? json_encode($request->edit_hr_input) : $warnings_all->hr_input_first;  
            $warnings_all->admin_comments_first = ($request->edit_admin_comments) ? json_encode($request->edit_admin_comments) : $warnings_all->admin_comments_first;
            $warnings_all->areas_for_improvement_first = ($request->edit_areas_for_improvement) ? json_encode($request->edit_areas_for_improvement) : $warnings_all->areas_for_improvement_first;
            $warnings_all->employee_documents_first = json_encode($edit_fileaddNamejson);
        }

        if($request->status == 2){

            $warnings_all->hr_input_second = ($request->second_hr_input_second) ? json_encode($request->second_hr_input_second) : $warnings_all->hr_input_second;  
            $warnings_all->admin_comments_second = ($request->second_admin_comments_second) ? json_encode($request->second_admin_comments_second) : $warnings_all->admin_comments_second;
            $warnings_all->areas_for_improvement_second = ($request->second_areas_for_improvement_second) ? json_encode($request->second_areas_for_improvement_second) : $warnings_all->areas_for_improvement_second;
            $warnings_all->employee_documents_second =  json_encode($second_fileadd_secondjson);
            $warnings_all->warmingstatus = ($request->status) ? $request->status : $warnings_all->status;

            $emp = Employee::find($warnings_all->emp_id)->first();    
            $man_name = Employee::where('id',$warnings_all->emp_id)->pluck('first_name')->first();   
            $adminid = Employee::where('role_id', 1)->first()->id;
            $hrid = Employee::where('role_id', 5)->first()->id;
            $empmessage = 'Your Second Warning Created by '.$man_name.' (Reporting manager)';
            Notification::create(['employeeid' => $warnings_all->emp_id, 'message' => $empmessage]);
            event(new EmployeeWarning($empmessage, $warnings_all->emp_id));
            $empname = Employee::find($warnings_all->emp_id)->pluck('first_name')->first();  
            $message = $empname.' Received Second Warning from '.$man_name.' (Reporting manager)';
            Notification::create(['employeeid' => $adminid, 'message' => $message]);
            event(new EmployeeWarning($message, $adminid));
            Notification::create(['employeeid' => $hrid, 'message' => $message]);
            event(new EmployeeWarning($message, $hrid));
        }

        if($request->status == 3){
            $warnings_all->hr_input_third = ($request->third_hr_input_third) ? json_encode($request->third_hr_input_third) : $warnings_all->hr_input_third;  
            $warnings_all->admin_comments_third = ($request->third_admin_comments_third) ? json_encode($request->third_admin_comments_third) : $warnings_all->admin_comments_third;
          //  $warnings_all->areas_for_improvement_third = ($request->edit_areas_for_improvement) ? $request->edit_areas_for_improvement : $warnings_all->areas_for_improvement_third;
            $warnings_all->employee_documents_third = json_encode($third_fileadd_thirdNamejson);
            $warnings_all->warmingstatus = ($request->status) ? $request->status : $warnings_all->status;

            $emp = Employee::find($warnings_all->emp_id)->first();    
            $man_name = Employee::where('id',$warnings_all->emp_id)->pluck('first_name')->first();   
            $adminid = Employee::where('role_id', 1)->first()->id;
            $hrid = Employee::where('role_id', 5)->first()->id;
            $empmessage = 'Your Third Warning Created by '.$man_name.' (Reporting manager)';
            Notification::create(['employeeid' => $warnings_all->emp_id, 'message' => $empmessage]);
            event(new EmployeeWarning($empmessage, $warnings_all->emp_id));
            $empname = Employee::find($warnings_all->emp_id)->pluck('first_name')->first();  
            $message = $empname.' Received Third Warning from '.$man_name.' (Reporting manager)';
            Notification::create(['employeeid' => $adminid, 'message' => $message]);
            event(new EmployeeWarning($message, $adminid));
            Notification::create(['employeeid' => $hrid, 'message' => $message]);
            event(new EmployeeWarning($message, $hrid));
        }
        $warnings_all->update();  

		/*$i=0; 

        foreach($admin_comments as $key => $input) 
        {
            if($admin_comments[$key] || $employee_nameid[$key] || $hr_input[$key] ||$areas_for_improvement[$key])
            {    
                if(isset($id[$key]))
                {          
                    $scores= EmployeeFirstVerbalWarning::where('id',$id)->first();   

                    $fileName= NULL;
                    if(isset($request->fileadd[$key]) && !empty($request->fileadd[$key])){
                        $fileName = rand().'.'.$request->fileadd[$key]->extension();      
                        $request->fileadd[$key]->move(public_path('employee_documents'), $fileName); 
                        $imagesave = $fileName;  
                    }else{
                        $imagesave = $scores->document;
                    }   

                    $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                    //$scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                    $scores->hr_input = $hr_input[$key] ? $hr_input[$key] : '';  
                    $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                    $scores->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';
                    $scores->warning_by = $emp_id;
					$scores->document=$imagesave; 
                    $scores->save();  
                }
                else
                {	
                    $fileName= NULL;    
                    if(isset($request->fileadd[$key]) && !empty($request->fileadd[$key])){
                            $fileName = rand().'.'.$request->fileadd[$key]->extension();      
                            $request->fileadd[$key]->move(public_path('employee_documents'), $fileName);  
             
                             $imagesave = $fileName;   
                    }else{
                        $imagesave = 'NULL' ;   
                    }


                    $scores = new EmployeeFirstVerbalWarning();               
                    $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                    //$scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                    $scores->hr_input = $hr_input[$key] ? $hr_input[$key] : '';  
                    $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                    $scores->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';
                    $scores->warning_by = $emp_id;
                    $scores->document= $imagesave; 
                    $scores->save();
                }              
            }
			$i++;
        }*/
        return back();       
    }
    public function delete_EmployeeVerbalWarning(Request $request){    

        $warning= employee_all_verbal_warnings::where('id',$request->id)->delete();
        if($warning==1){
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
        //$employee_comments = $request->employee_comments;
        $hr_input = $request->hr_input;
        $admin_comments = $request->admin_comments;
        $areas_for_improvement = $request->areas_for_improvement;   

        $i=0;
        foreach($admin_comments as $key => $input) 
        {
            if($admin_comments[$key] || $employee_nameid[$key] || $areas_for_improvement[$key] || $hr_input[$key])
            {        

                $fileName= NULL;   

                if(isset($request->fileadd[$i]) && !empty($request->fileadd[$i])){
                    $fileName = rand().'.'.$request->fileadd[$key]->extension();      
                    $request->fileadd[$i]->move(public_path('employee_documents'), $fileName);  
                    $imagesave = $fileName;  
                        
                }else{
                    $imagesave = 'NULL' ;   
                }

                $scores = new EmployeeSecondVerbalWarning();                
                $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                //$scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                $scores->hr_input = $hr_input[$key] ? $hr_input[$key] : '';  
                $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                $scores->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';
                $scores->warning_by = $emp_id;
                $scores->document = $imagesave;
                $scores->status = 1;
                $scores->save();                
            }

            $i++;
			
			$emp = Employee::find($request->emp_id)->first();    
			$man_name = Employee::where('id',$emp->man_id)->pluck('first_name')->first();   
			$adminid = Employee::where('role_id', 1)->first()->id;
			$hrid = Employee::where('role_id', 5)->first()->id;
			$empmessage = 'Your Second Warning Created by '.$man_name.' (Reporting manager)';
			Notification::create(['employeeid' => $scores->emp_id, 'message' => $empmessage]);
			event(new EmployeeWarning($empmessage, $scores->emp_id));
			$empname = Employee::find($request->emp_id)->pluck('first_name')->first();  
			$message = $empname.' Received Second Warning from '.$man_name.' (Reporting manager)';
			Notification::create(['employeeid' => $adminid, 'message' => $message]);
			event(new EmployeeWarning($message, $adminid));
			Notification::create(['employeeid' => $hrid, 'message' => $message]);
			event(new EmployeeWarning($message, $hrid));
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
       // $employee_comments = $request->employee_comments;
        $hr_input = $request->hr_input;
        $admin_comments = $request->admin_comments;
        $areas_for_improvement = $request->areas_for_improvement;        
        $id = $request->getid;

        

        foreach($admin_comments as $key => $input) 
        {
            if($admin_comments[$key] || $employee_nameid[$key] || $hr_input[$key] ||  $areas_for_improvement[$key])
            {     
                if(isset($id[$key]))
                {

                    $score = EmployeeSecondVerbalWarning::where('id',$id[$key])->first(); 
                   // dd($score->document);
                    $fileName= NULL;
                    if(isset($request->fileadd[$key]) && !empty($request->fileadd[$key])){
                        $fileName = rand().'.'.$request->fileadd[$key]->extension();      
                        $request->fileadd[$key]->move(public_path('employee_documents'), $fileName); 
                        $imagesave = $fileName;  
                    }else{
                        $imagesave = $score->document;
                    }

                  // dd($admin_comments[$key],$file_arr);
                    $score->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                    //$score->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                    $score->hr_input = $hr_input[$key] ? $hr_input[$key] : '';  
                    $score->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                    $score->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';
                    $score->document=$imagesave;
                    $score->warning_by = $emp_id; 
                    $score->save();
                }
                else 
                {
                    $fileName= NULL;    
                    if(isset($request->fileadd[$key]) && !empty($request->fileadd[$key])){
                        $fileName = rand().'.'.$request->fileadd[$key]->extension();      
                        $request->fileadd[$key]->move(public_path('employee_documents'), $fileName);  
         
                        $imagesave = $fileName;   
                    }else{

                        $imagesave = 'NULL' ;   
                    }

                    $scores = new EmployeeSecondVerbalWarning();                
                    $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                   // $scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                    $scores->hr_input = $hr_input[$key] ? $hr_input[$key] : '';  
                    $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                    $scores->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';
                    $scores->warning_by = $emp_id;
                    $scores->document = $imagesave;
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

        //$employee_comments = $request->employee_comments;
        $hr_input = $request->hr_input;
        $admin_comments = $request->admin_comments;       
        $employee_nameid = $request->emp_id;  

        $i=0;

        foreach($admin_comments as $key => $input) 
        {
            if($admin_comments[$key] || $employee_nameid[$key] || $hr_input[$key])
            {      

                $fileName= NULL;   

                if(isset($request->fileadd[$i]) && !empty($request->fileadd[$i])){
                    $fileName = rand().'.'.$request->fileadd[$key]->extension();      
                    $request->fileadd[$i]->move(public_path('employee_documents'), $fileName);  
                    $imagesave = $fileName;  
                        
                }else{
                    $imagesave = 'NULL' ;   
                }

                $scores = new EmployeeThirdVerbalWarning();                
                $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                //$scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                $scores->hr_input = $hr_input[$key] ? $hr_input[$key] : '';  
                $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                $scores->document = $imagesave;
                $scores->warning_by = $emp_id;
                $scores->status = 1;
                $scores->save();                
            }
            $i++;
			
			$emp = Employee::find($request->emp_id)->first();    
			$man_name = Employee::where('id',$emp->man_id)->pluck('first_name')->first();   
			$adminid = Employee::where('role_id', 1)->first()->id;
			$hrid = Employee::where('role_id', 5)->first()->id;
			$empmessage = 'Your Third Warning Created by '.$man_name.' (Reporting manager)';
			Notification::create(['employeeid' => $scores->emp_id, 'message' => $empmessage]);
			event(new EmployeeWarning($empmessage, $scores->emp_id));
			$empname = Employee::find($request->emp_id)->pluck('first_name')->first();  
			$message = $empname.' Received Third Warning from '.$man_name.' (Reporting manager)';
			Notification::create(['employeeid' => $adminid, 'message' => $message]);
			event(new EmployeeWarning($message, $adminid));
			Notification::create(['employeeid' => $hrid, 'message' => $message]);
			event(new EmployeeWarning($message, $hrid));
        }
        return back();       
    }
    public function update_EmployeeThirdVerbalWarning(Request $request)
    {     
        $data = $request->all(); 
        $userd = Auth::user()->id;  
        $string_id = Employee::where('id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id); 
        //$employee_comments = $request->employee_comments;
        $hr_input = $request->hr_input;
        $admin_comments = $request->admin_comments;       
        $employee_nameid = $request->emp_id;
        $id = $request->getid;    


        foreach($admin_comments as $key => $input) 
        {
            if($admin_comments[$key] || $employee_nameid[$key] || $hr_input[$key])
            {   
                if(isset($id[$key]))
                {              
                    $scores= EmployeeThirdVerbalWarning::where('id',$id[$key])->first();
                    
                    $fileName= NULL;
                    if(isset($request->fileadd[$key]) && !empty($request->fileadd[$key])){
                        $fileName = rand().'.'.$request->fileadd[$key]->extension();      
                        $request->fileadd[$key]->move(public_path('employee_documents'), $fileName); 
                        $imagesave = $fileName;  
                    }else{
                        $imagesave = $scores->document;
                    }

                    $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                    //$scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                    $scores->hr_input = $hr_input[$key] ? $hr_input[$key] : '';  
                    $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                    $scores->document=$imagesave;
                    $scores->warning_by = $emp_id; 
                    $scores->save();
                }
                else
                {
                    $fileName= NULL;    
                    if(isset($request->fileadd[$key]) && !empty($request->fileadd[$key])){
                        $fileName = rand().'.'.$request->fileadd[$key]->extension();      
                        $request->fileadd[$key]->move(public_path('employee_documents'), $fileName);  
         
                        $imagesave = $fileName;   
                    }else{

                        $imagesave = 'NULL' ;   
                    }

                    $scores = new EmployeeThirdVerbalWarning();                
                    $scores->emp_id = $employee_nameid[$key] ? $employee_nameid[$key] : '';
                    //$scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                    $scores->hr_input = $hr_input[$key] ? $hr_input[$key] : '';  
                    $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                    $scores->document = $imagesave;
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
        $data=employee_all_verbal_warnings::where('id',$id)->first();
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
