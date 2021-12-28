<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use Validator;
use Redirect;
use App\Module;
use App\ModuleHasPermission;
use App\RoleHasModule;
use App\Permission;
use DB;
class RoleController extends Controller
{

    public function roles_permissions()
    {
        $roles=Role::get();
        $modules=Module::get();
        $permissions=Permission::get();
        $module_has_permissions=ModuleHasPermission::get()->toArray();
        return view('roles-permissions',compact('roles','modules','permissions','module_has_permissions'));
    }
    public function getCheckedValues(){
        $checkedData=ModuleHasPermission::get()->toArray();
        return response()->json(['checkedData'=>$checkedData]);
    }
    public function add_role(Request $request){
        $validator = Validator::make($request->all(), [
            'role_name' => 'required'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $role=new Role();
        $role->name=$request->role_name;
        $role->guard_name=$request->role_name;
        $role->save();
        return back();
    }
    public function edit_role(Request $request){
        $validator = Validator::make($request->all(), [
            'role_name' => 'required'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $role=Role::where('id',$request->id)->first();
        $role->name=$request->role_name;
        $role->guard_name=$request->role_name;
        $role->save();
        return back();
    }
    public function delete_role(Request $request){
        Role::where('id',$request->id)->delete();
        return \json_encode("1");
    }
    public function changeModuleAccess(Request $request){
      
      
       
            $module=RoleHasModule::where('role_id',$request->role_id)->where('module_id',$request->id)->first();
            if($module){
                $module->module_id=$request->id;
                $module->role_id=$request->role_id;
                $module->access_status=$request->status;
                $module->save();
            }
            else{
                $module = new RoleHasModule();
                $module->module_id=$request->id;
                $module->role_id=$request->role_id;
                $module->access_status=$request->status;
                $module->save();
            }
           
       
        return json_encode("1");
    }
    public function GetModuleAccess(Request $request){
        $module_per=ModuleHasPermission::where('role_id',$request->id)->get()->toArray();
        return response()->json(['module_per'=>$module_per]);
    }
    public function GetRoleModuleAccess(Request $request){
        $module_access=RoleHasModule::where('role_id',$request->id)->get()->toArray();
        return response()->json(['module_access'=>$module_access]);
    }
    public function updateModulePermission(Request $request){
        $module_has_permissions=DB::table('module_has_permissions')->where('role_id',$request->role_id)->delete();
        $expl=array();
        if(isset($request->permission_modules)){
            foreach($request->permission_modules as $val){
                $exp=\explode('_',$val);
                array_push($expl,$exp);
            }
            foreach($expl as $value){
                $ModuleHasPermission= new ModuleHasPermission();
                $ModuleHasPermission->module_id=$value[0];
                $ModuleHasPermission->permission_id=$value[1];
                $ModuleHasPermission->role_id=$request->role_id;
                $ModuleHasPermission->save();
            }
        }
        return back();
    }
}
