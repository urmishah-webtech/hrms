<?php

namespace App\Http\Controllers;
use App\SpecialInitiatives;
use Illuminate\Http\Request;
use App\Employee;
use Auth;

class SpecialInitiativesController extends Controller
{
    public function store_SpecialInitiatives(Request $request)
    {    
        $data = $request->all(); 
        $userd = Auth::user()->id;                
        $emp_text = $request->DynamicTextBoxemp;
        $manager_text = $request->DynamicTextBoxman;
        $id = $request->getid;
       
        foreach($emp_text as $key => $input) 
        {
            if($emp_text[$key] || $manager_text[$key])
            {    
                if(isset($id[$key]))
                { 
                $score= SpecialInitiatives::where('id',$id[$key])->first();  
                $score->by_employee = $emp_text[$key] ? $emp_text[$key] : ''; 
                $score->managers_comment = $manager_text[$key] ? $manager_text[$key] : ''; 
                $score->save();
				
				$score=Employee::where('id',$userd)->first();    
				$score->complete_special_initiative = 1; 
				$score->save();
                }   
                else 
		        {   
                $scores = new SpecialInitiatives();                 
                $scores->emp_id = $userd;
                $scores->by_employee = $emp_text[$key] ? $emp_text[$key] : '';  
                $scores->managers_comment = $manager_text[$key] ? $manager_text[$key] : '';  
                $scores->save();
				
				$scores=Employee::where('id',$userd)->first();    
				$scores->complete_special_initiative = 1; 
				$scores->save();
                }
            }
        }
        return redirect("/performance#specialInitiatives");       
    }   
}
