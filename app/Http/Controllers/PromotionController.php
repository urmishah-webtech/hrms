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
        $data = Promotion::all();
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
        return redirect()->back()->with('msg', 'Created Successfully');
    }
}
