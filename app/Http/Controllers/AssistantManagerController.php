<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Notification;
use App\Events\AssignAssitantmanager;
use Auth;

class AssistantManagerController extends Controller
{
    public function Assistant_Manager(){
		$assi_manager = Employee::where('role_id',2)->orwhere('role_id',6)->orwhere('role_id',1)->orwhere('role_id',5)->get(); 
		return view('assistant_manager',compact('assi_manager')); 
	}
	
	public function add_Assistant_Manager(Request $request){
			
		$emp=Employee::where('id',$request->id)->first();
		$emp->assi_manager_id=$request->assi_manager_id;    
        $emp->save();
		
		$auth_name = auth::user()->first_name;   
		$message='Hi, Your have been Assign Assitant Manager from '.$auth_name;
		$link = 'assistant_manager';
        Notification::create(['employeeid' => $emp->assi_manager_id, 'message' => $message, 'slug' =>$link]);
        event(new AssignAssitantmanager($message,$emp->assi_manager_id,$link));
		
		return back();
	}
}
