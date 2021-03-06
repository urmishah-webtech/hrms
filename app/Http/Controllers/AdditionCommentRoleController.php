<?php

namespace App\Http\Controllers;
use App\AdditionCommentRole;
use Illuminate\Http\Request;
use App\Employee;
use Auth;

class AdditionCommentRoleController extends Controller
{
    public function store_AdditionCommentRole(Request $request)
    {    
        $data = $request->all();
        $userd = Auth::user()->id;        
        $leads = $request->strengths;
        $subject_ids = $request->areas_improvement;
        $id = $request->getid;      

        foreach($leads as $key => $input) {
            if($leads[$key] || $subject_ids[$key])
            {
                if(isset($id[$key]))
                {
                    $score= AdditionCommentRole::where('id',$id[$key])->first();  
                    $score->strengths = $leads[$key] ? $leads[$key] : '';  
                    $score->areas_improvement = $subject_ids[$key] ? $subject_ids[$key] : '';
                    $score->save();   
                }   
                else 
                {                  
                    $scores = new AdditionCommentRole();
                    $scores->emp_id = $userd;
                    $scores->strengths = $leads[$key] ? $leads[$key] : ''; 
                    $scores->areas_improvement = $subject_ids[$key] ? $subject_ids[$key] : ''; 
                    $scores->save();                 
                }
            }
        }
        return redirect("/performance#AdditionCommentRole");        
    }
}
