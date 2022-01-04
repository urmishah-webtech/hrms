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
        $getrole = auth()->user();
        if (!empty($getrole)) {
            $role = $getrole->role_id;
            if ($role == 3) {
                $data = Resignation::orderBy('id', 'DESC')->get();
            } else {
                $data = Resignation::where('employeeid', $getrole->id)->get();
            }
        } else {
            $role = '';
            $data = '';
        }
        return view('resignation', compact('data', 'role'));
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

    public function editResignation(){
        $id = $_GET['resid'];
        $data = Resignation::find($id);
        $employee = ($data->employee)->first_name.' '.($data->employee)->last_name;
        $loggedinuser = auth()->user()->id;
        return response(['status' => 1, 'data' => $data, 'employee' => $employee, 'loggedinuser' => $loggedinuser]);
    }

    public function updateResignation(Request $request){
        Resignation::where('id', $request->id)->update(['decisionby' => $request->decisionby, 'status' => $request->status, 'twoweeknotice' => $request->twoweeknotice, 'rehireable' => $request->rehireable]);
        return redirect()->back()->with('msg', 'Updated successfully');
    }

    public function deleteResignation(Request $request){
        $data = Resignation::find($request->id);
        if (!empty($data)) {
            $data->delete();
        }
        return redirect()->back()->with('msg', 'Deleted Successfully');
    }
}
