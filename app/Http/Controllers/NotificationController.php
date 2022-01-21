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
}
