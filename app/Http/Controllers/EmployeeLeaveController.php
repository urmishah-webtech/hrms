<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveType;
class EmployeeLeaveController extends Controller
{
    public function index()
    {
        $lt=LeaveType::get();
        return view('leaves-employee',compact('lt'));
    }
}
