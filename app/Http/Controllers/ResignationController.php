<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Resignation;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;

class ResignationController extends Controller
{
    public function index(){
        $employees = Employee::all();
        $data = Resignation::orderBy('id', 'DESC')->get();
        return view('resignation', compact('employees', 'data'));
    }

    public function addResignation(Request $request){
        $validator = Validator::make($request->all(), [
            'employeeid' => 'required',
            'noticedate' => 'required',
            'resignationdate' => 'required',
            'reason' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $emp = Employee::find($request->employeeid);
        if (!empty($emp)) {
            $department = $emp->department_id;
        } else {
            $department = '';
        }
        $noticedate = Carbon::createFromFormat('d/m/Y', $request->noticedate)->format('Y-m-d');
        $resignationdate = Carbon::createFromFormat('d/m/Y', $request->resignationdate)->format('Y-m-d');
        Resignation::create(['employeeid' => $request->employeeid, 'department' => $department, 'noticedate' => $noticedate, 'resignationdate' => $resignationdate, 'reason' => $request->reason]);
        return redirect()->back()->with('msg', 'Created Successfully');
    }
}
