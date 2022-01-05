<?php

namespace App\Http\Controllers;
use App\TrainingRequirements;
use Illuminate\Http\Request;
use App\Employee;
use Auth;
class TrainingRequirementsController extends Controller
{
    public function store_TrainingRequirements(Request $request)
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
                $score= TrainingRequirements::where('id',$id[$key])->first();  
                $score->by_employee = $emp_text[$key] ? $emp_text[$key] : ''; 
                $score->managers_comment = $manager_text[$key] ? $manager_text[$key] : ''; 
                $score->save();
                }   
                else 
		        {   
                $scores = new TrainingRequirements();
                $scores->emp_id = $userd;
                $scores->by_employee = $emp_text[$key] ? $emp_text[$key] : '';  
                $scores->managers_comment = $manager_text[$key] ? $manager_text[$key] : '';  
                $scores->save();
                }
            }
        }
        return redirect("/performance#TrainingRequirement");      
    } 
}
