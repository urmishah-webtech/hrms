<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Employee;
use App\Events\PromotionAdded;
use App\Notification;
use App\Promotion;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use Auth;


class PromotionController extends Controller
{
    public function index(){
        $employees = Employee::where('role_id', '!=', 1);
        $query = Promotion::with('employee', 'desfrom', 'desto', 'getdepartment');
        if (auth()->user()->role_id == 2 || Auth::user()->role_id==6) {
            $getemployees = $employees->where('man_id', auth()->user()->id)->pluck('id')->toArray();
            $employees = $employees->where('man_id', auth()->user()->id);
            $query = $query->whereIn('employeeid', $getemployees);
        }
        if (request()->has('employee')) {
            $query = $query->where('employeeid', request()->get('employee'));
        } 
        $employees = $employees->get();
        $data = $query->orderBy('id', 'DESC')->get();
        return view('promotion', compact('employees', 'data'));
    }

    public function getDesignation(){
        $empid = $_GET['empid'];
        $getemployee = Employee::find($empid);
        $currentdesignation = Designation::find($getemployee->designation_id);
        $designationforpromotion = Designation::where('department_id', $getemployee->department_id)->get()->except($getemployee->designation_id);
        return response(['status' => 1, 'currentdesignation' => $currentdesignation, 'designationforpromotion' => $designationforpromotion]);
    }

    public function addPromotion(Request $request){
        $validator = Validator::make($request->all(), [
            'employeeid' => 'required',
            'promotionform' => 'required',
            'promotionto' => 'required',
            'date' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $newpromotion = Promotion::create(['employeeid' => $request->employeeid, 'promotionform' => $request->promotionform, 'promotionto' => $request->promotionto, 'department' => $request->department, 'date' => $date]);
        Employee::where('id', $request->employeeid)->update(['designation_id'=> $request->promotionto]);
        $designationfrom = optional($newpromotion->desfrom)->name;
        $designationto = optional($newpromotion->desto)->name;
        $message = 'Congratulations! You are promoted from '.$designationfrom.' to '.$designationto;
        Notification::create(['employeeid' => $newpromotion->employeeid, 'message' => $message]);
        event(new PromotionAdded($message, $newpromotion->employeeid));
        return redirect()->back()->with('msg', 'Created Successfully');
    }

    public function editPromotion(){
        $id = $_GET['proid'];
        $data = Promotion::find($id);
        $employee = ($data->employee)->first_name.' '.($data->employee)->last_name;
        $currentdesignation = Designation::find($data->promotionform);
        $designationforpromotion = Designation::where('department_id', $data->department)->get()->except($data->promotionform);
        return response(['status' => 1, 'currentdesignation' => $currentdesignation, 'designationforpromotion' => $designationforpromotion, 'employee' => $employee, 'data' => $data]);
    }

    public function updatePromotion(Request $request){
        $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        Promotion::where('id', $request->id)->update(['employeeid' => $request->employeeid, 'promotionform' => $request->promotionform, 'promotionto' => $request->promotionto, 'date' => $date]);
        Employee::where('id', $request->employeeid)->update(['designation_id'=> $request->promotionto]);
        return redirect()->back()->with('msg', 'Updated Successfully');
    }

    public function deletePromotion(Request $request){
        $data = Promotion::find($request->id);
        if (!empty($data)) {
            $data->delete();
        }
        return redirect()->back()->with('msg', 'Deleted Successfully');
    }
}
