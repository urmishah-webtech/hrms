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
use App\Imports\EmployeeMain;
use Maatwebsite\Excel\Facades\Excel;
use File;
use App\Termination;
use App\Location;
class EmployeeController extends Controller
{
    public function employees(){
	//$termination = Termination::where('employee_id',Auth::user()->id)->pluck('employee_id')->toArray();     
	     
        $dep=Department::get();
        $location=Location::get();
        $des=Designation::get();
        if(Auth::user()->role_id==2 || Auth::user()->role_id==6){
            $emps=Employee::where('man_id',Auth::id())->get();
        }
        else{
        $emps=Employee::get();
        }
        $last_emp_id=DB::table('employees')->latest('id')->first();
        $modules=Module::get();
        $emp_permissions=EmpPermission::get();
        $permission_modules=PermissionModule::get();
		$roles=Role::get();
        return view('employees',compact('location','dep','des','emps','modules','emp_permissions','permission_modules','last_emp_id','roles'));
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
		$fileName= NULL;
		if(isset($request->document_add)){
			$fileName = time().'.'.$request->document_add->extension();  
			$request->document_add->move(public_path('employee_documents'), $fileName);
		}
		 
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
		$emp->employee_documents = $fileName;  
        $emp->location_id=$request->location_id;
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
        if(Auth::user()->role_id==3 || Auth::user()->role_id==2)
        {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required', 
                'phone_no' => 'required',
                'confirm_password'=>'required_with:password|same:password'
            ]); 
        }
       
        else{
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
        }
        if($validator->fails()){
           
            return Redirect::back()->withErrors($validator);
        }
		$fileName= NULL;
		if(isset($request->document_add)){
			$fileName = time().'.'.$request->document_add->extension();  
			$request->document_add->move(public_path('employee_documents'), $fileName);
		}
        $emp=Employee::where('id',$request->id)->first();
        $emp->first_name=is_null($request->first_name)?$emp->first_name:$request->first_name;
        $emp->last_name=is_null($request->last_name)?$emp->last_name:$request->last_name;
        $emp->user_name=is_null($request->user_name)?$emp->user_name:$request->user_name;
        $emp->email=is_null($request->email)?$emp->email:$request->email;
        if($request->password!=''){
        $emp->password=Hash::make($request->password);
        } 
        $emp->employee_id=is_null($request->employee_id)?$emp->employee_id:$request->employee_id;
		$emp->role_id=is_null($request->role_id)?$emp->role_id:$request->role_id;
        $emp->joing_date=is_null($request->joing_date)?$emp->joing_date:Carbon::createFromFormat('d/m/Y', $request->joing_date)->format('Y-m-d')
        ;
        $emp->phone_no=$request->phone_no;
        $emp->company_id=is_null($request->company_id)?$emp->company_id:$request->company_id;
        $emp->department_id=is_null($request->department_id)?$emp->department_id:$request->department_id;
        $emp->designation_id=is_null($request->designation_id)?$emp->designation_id:$request->designation_id;
		$emp->employee_documents=is_null($fileName)?$emp->employee_documents:$fileName;
        $emp->location_id=$request->location_id;
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
        $roles=Role::get();
        return view('employees',compact('dep','des','emps','modules','emp_permissions','permission_modules',
        'search_employee_id','search_name','search_designation','roles'));
    }

   public function getOrganizationalChart()
    {
        $users = Employee::whereNotIn('role_id', [4,5])->get(['id', 'man_id', 'first_name', 'last_name', 'role_id']);
        $employees = [];
        $admin = Employee::where('role_id', 1)->first();
      
        foreach ($users as $user) {
            $data = [
                'id' => $user->id,
                'name' => $user->first_name .' '.$user->last_name,
                'isCollapsed' => true
            ];

            if($user->role_id == 1) {
                $data['pid'] = 0;
            } else {
                if(!empty($user->man_id)) {
                    $data['pid'] = $user->man_id;
                    
                } else {
                    $data['pid'] = $admin->id;
                    
                }
            }

            $employees[] = $data;
             
        }
        $employees = json_encode($employees);
        return view('organizational-chart',compact('employees'));

    }
    public function import_employees(Request $request)
    {
        if($request->hasFile('file'))
        {
           $extension = File::extension($request->file->getClientOriginalName());
           if ($extension == "xlsx" || $extension == "xls" ) {
           // try{
                Excel::import(new EmployeeMain,request()->file('file'));
                // }
                // catch(\Exception $e){
                //     return back()->withErrors($e->getMessage());
                // }
                return back();
           }else {
             return back()->withErrors('Please upload a valid xls/xlsx file..!!');

           }
        }
     
    }
}
