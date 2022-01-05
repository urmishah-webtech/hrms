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
        $first_getw = EmployeeFirstVerbalWarning::where('emp_id',$userd)->get();
        $first_warning_dt = EmployeeFirstVerbalWarning::all();
        $first_war_edit = EmployeeFirstVerbalWarning::get('id');
        $second_emp = EmployeeSecondVerbalWarning::where('emp_id',$userd)->get();
        $second_adman = EmployeeSecondVerbalWarning::all();
        $third_emp = EmployeeThirdVerbalWarning::where('emp_id',$userd)->get();
        $third_adman = EmployeeThirdVerbalWarning::all();
        return view('employee-warning',compact('emp_role','first_warning_dt','first_getw','second_emp','second_adman','third_emp','third_adman'));
         
    }
    public function store_EmployeeFirstVerbalWarning(Request $request)
    {    
        $data = $request->all(); 
        $userd = Auth::user()->id;  
        $string_id = Employee::where('id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);          
        $employee_comments = $request->employee_comments;
        $managers_comments = $request->managers_comments;
        $admin_comments = $request->admin_comments;
        $areas_for_improvement = $request->areas_for_improvement;        
       
        foreach($employee_comments as $key => $input) 
        {
            if($employee_comments[$key] || $managers_comments[$key] || $admin_comments[$key] || $areas_for_improvement[$key])
            {                
                $scores = new EmployeeFirstVerbalWarning();                
                $scores->emp_id = $emp_id;
                $scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                $scores->managers_comments = $managers_comments[$key] ? $managers_comments[$key] : '';  
                $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                $scores->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';
                $scores->save();                
            }
        }
        return back();       
    }
    public function update_EmployeeFirstVerbalWarning(Request $request)
    {    
        $id = $request->getid;      
        $score= EmployeeFirstVerbalWarning::where('id',$id)->first();  
        $score->employee_comments = $request->employee_comments;
        $score->managers_comments = $request->managers_comments;
        $score->admin_comments = $request->admin_comments;
        $score->areas_for_improvement = $request->areas_for_improvement; 
        $score->save();
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
        $employee_comments = $request->employee_comments;
        $managers_comments = $request->managers_comments;
        $admin_comments = $request->admin_comments;
        $areas_for_improvement = $request->areas_for_improvement;        
       
        foreach($employee_comments as $key => $input) 
        {
            if($employee_comments[$key] || $managers_comments[$key] || $admin_comments[$key] || $areas_for_improvement[$key])
            {                
                $scores = new EmployeeSecondVerbalWarning();                
                $scores->emp_id = $emp_id;
                $scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                $scores->managers_comments = $managers_comments[$key] ? $managers_comments[$key] : '';  
                $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                $scores->areas_for_improvement = $areas_for_improvement[$key] ? $areas_for_improvement[$key] : '';
                $scores->save();                
            }
        }
        return back();       
    }
    public function update_EmployeeSecondVerbalWarning(Request $request)
    {    
        $id = $request->getid;      
        $score= EmployeeSecondVerbalWarning::where('id',$id)->first();  
        $score->employee_comments = $request->employee_comments;
        $score->managers_comments = $request->managers_comments;
        $score->admin_comments = $request->admin_comments;
        $score->areas_for_improvement = $request->areas_for_improvement; 
        $score->save();
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
       
        foreach($employee_comments as $key => $input) 
        {
            if($employee_comments[$key] || $managers_comments[$key] || $admin_comments[$key])
            {                
                $scores = new EmployeeThirdVerbalWarning();                
                $scores->emp_id = $emp_id;
                $scores->employee_comments = $employee_comments[$key] ? $employee_comments[$key] : '';  
                $scores->managers_comments = $managers_comments[$key] ? $managers_comments[$key] : '';  
                $scores->admin_comments = $admin_comments[$key] ? $admin_comments[$key] : '';
                $scores->save();                
            }
        }
        return back();       
    }
    public function update_EmployeeThirdVerbalWarning(Request $request)
    {    
        $id = $request->getid;      
        $score= EmployeeThirdVerbalWarning::where('id',$id)->first();  
        $score->employee_comments = $request->employee_comments;
        $score->managers_comments = $request->managers_comments;
        $score->admin_comments = $request->admin_comments;
        $score->save();
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
}
