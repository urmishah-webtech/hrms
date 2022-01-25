<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PerformanceIdentity;
use Auth;
use App\Employee;
use Illuminate\Support\Carbon;
 

class PerformanceIdentitiesController extends Controller
{
    public function store_PerformanceIdentity(Request $request)
    {  
        $data = $request->all();
        $userd = Auth::user()->id;
        $user_role = $request->user_role;     
        $name = $request->name;
        $signature = $request->signature;
        $date = $request->date;
        $id = $request->getid; 
        $add_empid = $request->empid;  
        foreach($name as $key => $input) 
        {
            if($name[$key] || $signature[$key])
            {    
                if(isset($id[$key]))
                {  
                $score= PerformanceIdentity::where('id',$id[$key])->first();
                $score->name = $name[$key] ? $name[$key] : ''; 
                $score->signature = $signature[$key] ? $signature[$key] : '';
                $score->date = Carbon::createFromFormat('d/m/Y', $date[$key])->format('Y-m-d');
                $score->save();
                }   
                else 
		        {   
                $scores = new PerformanceIdentity();
                $scores->emp_id = $add_empid;
                $scores->user_id = $userd;
                $scores->user_role = $user_role[$key] ? $user_role[$key] : '';  
                $scores->name = $name[$key] ? $name[$key] : '';
                $scores->signature = $signature[$key] ? $signature[$key] : '';
                $scores->date = Carbon::createFromFormat('d/m/Y', $date[$key])->format('Y-m-d') ? Carbon::createFromFormat('d/m/Y', $date[$key])->format('Y-m-d') : ''; 
                $scores->save();
                }
            }
        }
        return redirect("/performance#PerfomanceIdentitie");                
    } 
}
