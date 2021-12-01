<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use Validator;
class SettingController extends Controller
{
    public function settings(){
        $settings=Setting::first();
        return view('settings',compact('settings'));
    }
    public function setting_update(Request $request){
        $validator = Validator::make($request->all(), [
            'company_name' => 'required'
        ]);
        if($validator->fails()){
            return back()->with('error', 'Error in updating settings');
        }
        $setting=Setting::first();
        if(!empty($setting)){
            $setting->company_name=$request->company_name;
            $setting->save();
        }else{
            $setting = new Setting();
            $setting->save();
        }
        return back();
    }
}
