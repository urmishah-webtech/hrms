<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Auth;
class NotificationController extends Controller
{
    public function index(){
        $notifications = Notification::where('employeeid', Auth::id())->get();
        return view('activities', compact('notifications'));
    }
    public function clear_notification(Request $request){
        $deleted_data=Notification::where('employeeid',$request->id)->delete();
    }
	public function add_read_notification_status(Request $request){
		$status=Notification::where('employeeid',$request->emp_id)->where('created_at',$request->created_at)->first();         
		$status->read_at=$request->read_at;;   
		$status->save();  
		return redirect('activities');
	}
}
