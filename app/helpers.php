<?php

use App\Notification;

function getnotifications($user){
    return Notification::where('employeeid', $user)->orderBy('id', 'DESC')->get();
}