<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\Designation;
use Auth;
class ProfileController extends Controller
{
    public function Profile_employees(){
        $userd = Auth::user()->id;
        $emp_profile=Employee::where('user_id',$userd)->first();
         
        return view('profile',compact('emp_profile'));
    }
}
