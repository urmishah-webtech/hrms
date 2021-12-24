<?php

namespace App\Http\Controllers;
use App\AppraiseeStrength;
use Illuminate\Http\Request;
use App\Employee;
use Auth;

class AppraiseeStrengthsController extends Controller
{
    public function store_AppraiseeStrength(Request $request)
    {    
        $data = $request->all();
        $userd = Auth::user()->id;
        $string_id = Employee::where('user_id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);
        $strength = $request->strengths;
        $improvement = $request->areas_improvement;
        $id = $request->getid;    

        foreach($strength as $key => $input) {
            if($strength[$key] || $improvement[$key])
            {
                if(isset($id[$key]))
                {
                    $score= AppraiseeStrength::where('id',$id[$key])->first();  
                    $score->strengths = $strength[$key] ? $strength[$key] : '';  
                    $score->areas_improvement = $improvement[$key] ? $improvement[$key] : '';
                    $score->save();   
                }   
                else 
                {                  
                    $scores = new AppraiseeStrength();
                    $scores->user_id = Auth::user()->id;
                    $scores->emp_id = $emp_id;
                    $scores->strengths = $strength[$key] ? $strength[$key] : ''; 
                    $scores->areas_improvement = $improvement[$key] ? $improvement[$key] : ''; 
                    $scores->save();                 
                }
            }
        }
        return back();        
    }
}
