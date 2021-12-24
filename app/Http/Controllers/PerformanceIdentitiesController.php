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
        $string_id = Employee::where('user_id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);     
        $user_role = $request->user_role;     
        $name = $request->name;
        $signature = $request->signature;
        $date = $request->date;
        $id = $request->getid;
        
        foreach($name as $key => $input) 
        {
            if($name[$key] || $signature[$key] || $date[$key])
            {    
                if(isset($id[$key]))
                { 
                $score= PerformanceIdentity::where('id',$id[$key])->first();
                $score->name = $name[$key] ? $name[$key] : ''; 
                $score->signature = $signature[$key] ? $signature[$key] : '';
                $score->date = $date[$key] ? $date[$key] : ''; 
                $score->save();
                }   
                else 
		        {   
                $scores = new PerformanceIdentity();
                $scores->user_id = Auth::user()->id;
                $scores->emp_id = $emp_id;
                $scores->user_role = $user_role[$key] ? $user_role[$key] : '';  
                $scores->name = $name[$key] ? $name[$key] : '';
                $scores->signature = $signature[$key] ? $signature[$key] : '';
                $scores->date = $date[$key] ? $date[$key] : '';                 
                $scores->save();
                }
            }
        }
        return back();                 
    } 
}
