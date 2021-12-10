<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 
use App\Module;
use Validator;

use Illuminate\Http\Request;

class NotificationsettController extends Controller
{
    public function notificationsetting()
    {
        $modules=Module::get();        
        return view('notifications-settings',compact('modules'));
    }
    public function changeNotificationAccess(Request $request){
        
        $modules=Module::where('id',$request->id)->first();
        $modules->notification_status=$request->notification_status;
        $modules->save();
        return json_encode("1");
    }
}
