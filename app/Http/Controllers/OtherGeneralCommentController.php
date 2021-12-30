<?php

namespace App\Http\Controllers;
use App\OtherGeneralComment;
use Illuminate\Http\Request;
use App\Employee;
use Auth;

class OtherGeneralCommentController extends Controller
{
    public function store_OtherGeneralComment(Request $request)
    {    
        $data = $request->all();    
        $userd = Auth::user()->id;
        $string_id = Employee::where('user_id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);         
        $emp_text = $request->DynamicTextBoxemp;
        $manager_text = $request->DynamicTextBoxman;
        $id = $request->getid;
       
        foreach($emp_text as $key => $input) 
        {
            if($emp_text[$key] || $manager_text[$key])
            {    
                if(isset($id[$key]))
                { 
                $score= OtherGeneralComment::where('id',$id[$key])->first();  
                $score->employee_comments = $emp_text[$key] ? $emp_text[$key] : ''; 
                $score->managers_comments = $manager_text[$key] ? $manager_text[$key] : ''; 
                $score->save();
                }   
                else 
		        {   
                $scores = new OtherGeneralComment();
                $scores->user_id = Auth::user()->id;
                $scores->emp_id = $emp_id;
                $scores->employee_comments = $emp_text[$key] ? $emp_text[$key] : '';  
                $scores->managers_comments = $manager_text[$key] ? $manager_text[$key] : '';  
                $scores->save();
                }
            }
        }
        return redirect("/performance#GeneralComment");     
    } 
}
