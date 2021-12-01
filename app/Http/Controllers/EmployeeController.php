<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Designation;
use DB;
use Validator;
use Illuminate\Support\Carbon;
use App\Employee;
use App\EmpPermission;
use App\Module;
use App\PermissionModule;
class EmployeeController extends Controller
{
    public function employees(){
        $dep=Department::get();
        $des=Designation::get();
        $emps=Employee::get();
        $modules=Module::get();
        $emp_permissions=EmpPermission::get();
        $permission_modules=PermissionModule::get();
        return view('employees',compact('dep','des','emps','modules','emp_permissions','permission_modules'));
    }
    public function getDesignationAjax(Request $request){
        $des=DB::table('designations')->where('department_id',$request->deptId)->get();
        return response()->json($des);
    }
    public function add_employee(Request $request){
    
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'employee_id' => 'required',
            'joing_date' => 'required',
            'phone_no' => 'required',
            'company_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
        ]);
        if($validator->fails()){
            return back()->with('error', 'Error in creating Employee');
        }
        $emp=new Employee();
        $emp->first_name=$request->first_name;
        $emp->last_name=$request->last_name;
        $emp->user_name=$request->user_name;
        $emp->email=$request->email;
        $emp->password=$request->password;
        $emp->employee_id=$request->employee_id;
        $emp->joing_date=Carbon::createFromFormat('d/m/Y', $request->joing_date)->format('Y-m-d')
        ;
        $emp->phone_no=$request->phone_no;
        $emp->company_id=$request->company_id;
        $emp->department_id=$request->department_id;
        $emp->designation_id=$request->designation_id;
        $emp->save();

        $expl=array();
        foreach($request->permission_modules as $val){
            $exp=\explode('_',$val);
            array_push($expl,$exp);
        }
        foreach($expl as $value){
            $permission_module= new PermissionModule();
            $permission_module->module_id=$value[0];
            $permission_module->emp_permission_id=$value[1];
            $permission_module->employee_id=$emp->id;
            $permission_module->save();
        }
        return back();
    }
    public function delete_employee(Request $request){
        $emp= Employee::where('id',$request->id)->delete();
        if($emp==1){
            echo json_encode("1");
        }
        else{
            echo json_encode("0");
        }
    }
}
