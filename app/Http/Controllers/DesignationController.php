<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Designation;
use Validator;
class DesignationController extends Controller
{
    public function designations(){
        $desig=Designation::get();
        $dept=Department::get();
        return view('designations',compact('desig','dept'));
    }
    public function add_designation (Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'dept' => 'required',
        ]);
        if($validator->fails()){
            return back()->with('error', 'Error in creating designataion');
        }
        $des=new Designation();
        $des->name=$request->name;
        $des->department_id=$request->dept;
        $des->save();
        return back();
        
    }
    public function edit_designation(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'dept' => 'required',
        ]);
        if($validator->fails()){
            return back()->with('error', 'Error in updating designataion');
        }
        $des= Designation::find($request->id);
        if($des){
            $des->name=$request->name;
            $des->department_id=$request->dept;
            $des->save();
        }
        else{
            return back();
        }
        return back();
    }
    public function delete_designation(Request $request){
        $dept= Designation::where('id',$request->id)->delete();
        if($dept==1){
            echo json_encode("1");
        }
        else{
            echo json_encode("0");
        }
    }
}
