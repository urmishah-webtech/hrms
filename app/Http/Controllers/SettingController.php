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
            $setting->contact_person=$request->contact_person;
            $setting->address=$request->address;
            $setting->country=$request->country;
            $setting->city=$request->city;
            $setting->state=$request->state;
            $setting->postal_code=$request->postal_code;
            $setting->email=$request->email;
            $setting->phone_no=$request->phone_no;
            $setting->mobile_no=$request->mobile_no;
            $setting->fax=$request->fax;
            $setting->website_url=$request->website_url;
            $setting->save();
        }else{
            $setting = new Setting();
            $setting->company_name=$request->company_name;
            $setting->contact_person=$request->contact_person;
            $setting->address=$request->address;
            $setting->country=$request->country;
            $setting->city=$request->city;
            $setting->state=$request->state;
            $setting->postal_code=$request->postal_code;
            $setting->email=$request->email;
            $setting->phone_no=$request->phone_no;
            $setting->mobile_no=$request->mobile_no;
            $setting->fax=$request->fax;
            $setting->website_url=$request->website_url;
            $setting->save();
        }
        return back();
    }
}
