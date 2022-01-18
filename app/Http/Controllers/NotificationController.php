<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
class NotificationController extends Controller
{
    public function clear_notification(Request $request){
        $deleted_data=Notification::where('employeeid',$request->id)->delete();
    }
}
