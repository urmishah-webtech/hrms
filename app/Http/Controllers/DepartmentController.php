<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Designation;
use App\Employee;
use Validator;
class DepartmentController extends Controller
{
    public function add_department (Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if($validator->fails()){
            return back()->with('error', 'Error in creating department');
        }
        $dept=new Department();
        $dept->name=$request->name;
        $dept->save();
        return back();
    }
    public function departments()
    {
        $depts= Department::get();
        return view('departments',compact('depts'));
    }
    public function edit_department(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if($validator->fails()){
            return back()->with('error', 'Error in updating department');
        }
        $dept= Department::find($request->id);
        if($dept){
            $dept->name=$request->name;
            $dept->save();
        }
        else{
            return back();
        }
        return back();
    }
    public function delete_department(Request $request){
        if(Designation::where('department_id',$request->id)->exists()){
            return response()->json(['error'=>'2']);
        }
        elseif(Employee::where('department_id',$request->id)->exists())
        {
            return response()->json(['error'=>'3']);
        }
        else{
            $dept= Department::where('id',$request->id)->delete();

            if($dept==1){
                echo json_encode("1");
            }
            else{
                echo json_encode("0");
            }
        }
    }
}
