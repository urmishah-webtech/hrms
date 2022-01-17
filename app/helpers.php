<?php

use App\Employee;
use App\Notification;

function getnotifications($user){
    return Notification::where('employeeid', $user)->orderBy('id', 'DESC')->get();
}

function getemployeename($id){
    $emp = Employee::find($id);
    if ($emp) {
        return $emp->first_name.' '.$emp->last_name;
    } else {
        return '';
    }
}