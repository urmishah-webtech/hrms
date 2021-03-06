<?php

namespace App\Http\Controllers;
use App\PersonalGoal;
use Illuminate\Http\Request;
use App\Employee;
use Auth;
class PersonalGoalController extends Controller
{
    public function store_PersonalGoal(Request $request)
    {    
        $data = $request->all();
        $userd = Auth::user()->id;
        $last_year = $request->goal_last_year;
        $current_year = $request->goal_current_year;
        $id = $request->getid;     

        foreach($last_year as $key => $input) {
            if($last_year[$key] || $current_year[$key])
            {
                if(isset($id[$key]))
                {
                    $score= PersonalGoal::where('id',$id[$key])->first();  
                    $score->goal_last_year = $last_year[$key] ? $last_year[$key] : '';  
                    $score->goal_current_year = $current_year[$key] ? $current_year[$key] : '';
                    $score->save();   
                }   
                else 
                {                  
                    $scores = new PersonalGoal();
                    $scores->emp_id = $userd;
                    $scores->goal_last_year = $last_year[$key] ? $last_year[$key] : ''; 
                    $scores->goal_current_year = $current_year[$key] ? $current_year[$key] : ''; 
                    $scores->save();                 
                }
            }
        }
        return redirect("/performance#PersonalGoal");        
    }
}
