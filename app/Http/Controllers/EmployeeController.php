<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use App\Department;
use App\Designation; 
use DB;
use Validator;
use Illuminate\Support\Carbon;
use App\Employee;
use App\EmpPermission;
use App\Module;
use App\PermissionModule;
use App\Role;
use Illuminate\Support\Str;
use App\User;
use Hash;
use Auth;
class EmployeeController extends Controller
{
    public function employees(){
        $dep=Department::get();
        $des=Designation::get();
        $emps=Employee::get();
        $last_emp_id=DB::table('employees')->latest('id')->first();
        $modules=Module::get();
        $emp_permissions=EmpPermission::get();
        $permission_modules=PermissionModule::get();
		$roles=Role::get();
        return view('employees',compact('dep','des','emps','modules','emp_permissions','permission_modules','last_emp_id','roles'));
    }
    public function getDesignationAjax(Request $request){
        $des=DB::table('designations')->where('department_id',$request->deptId)->get();
        return response()->json($des);
    }
    public function add_employee(Request $request){
    
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required|unique:employees',
            'email' => 'required:unique:employees',
            'password' => 'required',
            'employee_id' => 'required|unique:employees',
			'role_id' => 'required',
            'joing_date' => 'required',
            'phone_no' => 'required',
            'company_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'confirm_password'=>'required_with:password|same:password'

        ]); 
        if($validator->fails()){
           
            return Redirect::back()->withErrors($validator);
        }
		 
		/*$usert=new User();		
        $usert->name=$request->first_name;
        $usert->email=$request->email;
        $usert->password=Hash::make($request->password);
        $usert->role_id=Str::lower($request->role_id);
		$usert->gender=$request->gender;
        $usert->save();*/
		
        $emp=new Employee();
		//$emp->user_id = $usert->id;
        $emp->first_name=$request->first_name;
        $emp->last_name=$request->last_name;
        $emp->user_name=$request->user_name;
        $emp->email=$request->email;
        $emp->password=bcrypt($request->password);
        $emp->employee_id=$request->employee_id;
        $emp->gender=$request->gender;
		$emp->role_id=$request->role_id;
        $emp->joing_date=Carbon::createFromFormat('d/m/Y', $request->joing_date)->format('Y-m-d')
        ;
        $emp->phone_no=$request->phone_no;
        $emp->company_id=$request->company_id;
        $emp->department_id=$request->department_id;
        $emp->designation_id=$request->designation_id;
        $emp->save();

        $expl=array();
        if($request->permission_modules!=''){
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
        }
        return back();
    }
    public function update_employee(Request $request){
    
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required|unique:employees,user_name,'.$request->id,
            'email' => 'required|unique:employees,email,'.$request->id,
			'role_id' => 'required',
            'joing_date' => 'required',
            'phone_no' => 'required',
           // 'employee_id'=>'required|unique:employees,employee_id,'.$request->id,
            'company_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'confirm_password'=>'required_with:password|same:password'
        ]);
        if($validator->fails()){
           
            return Redirect::back()->withErrors($validator);
        }
        $emp=Employee::where('id',$request->id)->first();
        $emp->first_name=$request->first_name;
        $emp->last_name=$request->last_name;
        $emp->user_name=$request->user_name;
        $emp->email=$request->email;
        if($request->password!=''){
        $emp->password=$request->password;
        }
       
        $emp->employee_id=$request->employee_id;
		$emp->role_id=$request->role_id;
        $emp->joing_date=Carbon::createFromFormat('d/m/Y', $request->joing_date)->format('Y-m-d')
        ;
        $emp->phone_no=$request->phone_no;
        $emp->company_id=$request->company_id;
        $emp->department_id=$request->department_id;
        $emp->designation_id=$request->designation_id;

        $emp->save();

        $expl=array();
        $permission_modules=DB::table('permission_modules')->where('employee_id',$request->id )->delete();
        if(isset($request->permission_modules)){
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
        }
        return back();
    }
    public function edit_employee(Request $request){
        $emp=Employee::where('id',$request->id)->get()->toArray();
        $permission_modules=PermissionModule::where('employee_id',$request->id)->get()->toArray();
        return response()->json(['permission_modules'=>$permission_modules,'emp'=>$emp]);
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
    public function search_employee(Request $request){
        $dep=Department::get();
        $des=Designation::get();
        $emp=new Employee;
        $search_employee_id=$request->search_employee_id;
        $search_name=$request->search_name;
        $search_designation=$request->search_designation;
        if($search_employee_id!=""){
            $emp=$emp->where('employee_id',$search_employee_id);
        }
        if($search_name!=""){
            $emp=$emp->where('first_name',$search_name);
        }
        if($search_designation!=""){
            $emp=$emp->where('designation_id',$search_designation);
        }
        $emps=$emp->get();
        $modules=Module::get();
        $emp_permissions=EmpPermission::get();
        $permission_modules=PermissionModule::get();
        return view('employees',compact('dep','des','emps','modules','emp_permissions','permission_modules',
        'search_employee_id','search_name','search_designation'));
    }
}
