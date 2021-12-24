<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PerfomanceManagerUse;
use App\Employee;
use Auth;


class PerfomanceManagerUseController extends Controller
{
    public function store_PerfomanceManagerUse(Request $request)
    {  
        $data = $request->all();  
        $userd = Auth::user()->id;
        $string_id = Employee::where('user_id', $userd)->pluck('id')->all();
        $emp_id=implode("id",$string_id);  
        $issues = $request->issues;     
        $select_val = $request->select_option;
        $details = $request->yes_details;
        $id = $request->getid;
       
        foreach($details as $key => $input) 
        {
            if($select_val[$key] || $details[$key])
            {    
                if(isset($id[$key]))
                { 
                $score= PerfomanceManagerUse::where('id',$id[$key])->first();
                $score->select_option = $select_val[$key] ? $select_val[$key] : ''; 
                $score->yes_details = $details[$key] ? $details[$key] : ''; 
                $score->save();
                }   
                else 
		        {   
                $scores = new PerfomanceManagerUse();
                $scores->user_id = Auth::user()->id;
                $scores->emp_id = $emp_id;
                $scores->issues = $issues[$key] ? $issues[$key] : '';
                $scores->select_option = $select_val[$key] ? $select_val[$key] : ''; 
                $scores->yes_details = $details[$key] ? $details[$key] : '';  
                $scores->save();
                }
            }
        }
        return back();                 
    } 
}
