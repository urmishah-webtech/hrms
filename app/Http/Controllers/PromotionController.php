<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Employee;
use App\Promotion;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index(){
        $employees = Employee::all();
        if (request()->has('employee')) {
            $data = Promotion::where('employeeid', request()->get('employee'))->orderBy('id', 'DESC')->get();
        } else {
            $data = Promotion::orderBy('id', 'DESC')->get();
        }
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
        Promotion::create(['employeeid' => $request->employeeid, 'promotionform' => $request->promotionform, 'promotionto' => $request->promotionto, 'department' => $request->department, 'date' => $date]);
        Employee::where('id', $request->employeeid)->update(['designation_id'=> $request->promotionto]);
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
