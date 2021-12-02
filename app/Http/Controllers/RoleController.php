<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use Validator;
use Redirect;
use App\Module;
use App\ModuleHasPermission;
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
        $modules=Module::where('id',$request->id)->first();
        $modules->status=$request->status;
        $modules->save();
        return json_encode("1");
    }
    public function updateModulePermission(Request $request){
        $module_has_permissions=DB::table('module_has_permissions')->delete();
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
                $ModuleHasPermission->save();
            }
        }
        return back();
    }
}
