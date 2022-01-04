<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeFirstVerbalWarning;
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
        //dd($first_warning_dt);
        return view('employee-warning',compact('emp_role','first_warning_dt','first_getw'));
         
    }
    public function edit_VerbalWarning_list(Request $request){ 
        $userd = Auth::user()->id;
        
        $first_warning_dt = EmployeeFirstVerbalWarning::all();
        $first_war_edit = EmployeeFirstVerbalWarning::where('id', $request->editid)->first();
      //  $string_id = EmployeeFirstVerbalWarning::where('id', $userd)->pluck('id')->all();
       // dd($first_war_edit);
        return view('employee-warning',compact('first_war_edit','first_warning_dt'));
         
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
        $emp= EmployeeFirstVerbalWarning::where('id',$request->id)->delete();
        if($emp==1){
            echo json_encode("1");
        }
        else{
            echo json_encode("0");
        }
    }
}
