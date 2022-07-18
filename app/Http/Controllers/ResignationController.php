<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Events\EmployeeResignation;
use App\Notification;
use App\Resignation;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;

class ResignationController extends Controller
{
    public function index(){
        $getrole = auth()->user();
        $selfresignation = Resignation::where('employeeid', $getrole->id)->exists();
        $check = 0;
        if (!empty($getrole)) {
            $role = $getrole->role_id;
            if ($role != 1) {
                if ($selfresignation) {
                    $self = Resignation::where('employeeid', $getrole->id)->orderBy('id', 'DESC')->first();
                    // dd($self);
                    if ($self->status == 'Disapproved') {
                        $check = 1;
                    }
                }else{
                    $check = 1;
                }
            }
            $query = Resignation::with('employee', 'decisionmaker', 'getdepartment');
            if ($role == 2 || $role == 6 ) {
                $getemployees = Employee::where('man_id', $getrole->id)->pluck('id')->toArray();
                $query = $query->whereIn('employeeid', $getemployees)->orWhere('employeeid', $getrole->id);
            } 
            if($role == 3) {
                $query = $query->where('employeeid', $getrole->id);
            }
            $data = $query->orderBy('id', 'DESC')->get();
        } else {
            $role = '';
            $data = '';
        }
        return view('resignation', compact('data', 'role', 'check'));
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
		$man_name = Employee::where('id',$emp->man_id)->pluck('first_name')->first();   
		$hr_name = Employee::where('role_id',5)->pluck('first_name')->first();   
        $noticedate = Carbon::createFromFormat('d/m/Y', $request->noticedate)->format('Y-m-d');
        $resignationdate = Carbon::createFromFormat('d/m/Y', $request->resignationdate)->format('Y-m-d');
        Resignation::create(['employeeid' => $request->employeeid, 'department' => $department, 'noticedate' => $noticedate, 'resignationdate' => $resignationdate, 'reason' => $request->reason]);
        $empmessage = 'Your resignation request has been sent to '.$man_name.' (Reporting manager)  and '.$hr_name.' (HR Manager).';
		$resignations = "resignation";
        Notification::create(['employeeid' => $request->employeeid, 'message' => $empmessage, 'slug' => $resignations]);
        event(new EmployeeResignation($empmessage, $request->employeeid, $resignations));
        $empname = getemployeename($request->employeeid);
        $message = $empname.' has sent a resignation request.';
        $adminid = Employee::where('role_id', 1)->first()->id;
		$hrid = Employee::where('role_id', 5)->first()->id;
        Notification::create(['employeeid' => $adminid, 'message' => $message, 'slug' => $resignations]);
        event(new EmployeeResignation($message, $adminid, $resignations));
		Notification::create(['employeeid' => $hrid, 'message' => $message, 'slug' => $resignations]);
        event(new EmployeeResignation($message, $hrid, $resignations));
        $managerid = Employee::where('id', $request->employeeid)->first()->man_id;
        if (!empty($managerid)) {
            Notification::create(['employeeid' => $managerid, 'message' => $message, 'slug' => $resignations]);
            event(new EmployeeResignation($message, $managerid, $resignations));
        }
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
        $message = 'Your resignation request has been '.$request->status.' by '.getemployeename($request->decisionby);
        $emp = Resignation::where('id', $request->id)->first()->employeeid;
        Notification::create(['employeeid' => $emp, 'message' => $message]);
        event(new EmployeeResignation($message, $emp));
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
