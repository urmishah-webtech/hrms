<?php

namespace App\Http\Controllers;

use App\CompentencyInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use App\ThemeSetting;
use App\PerformanceSetting;
use Validator;
use Redirect;
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
    public function theme_settings()
    {
        $settings=ThemeSetting::first();
        return view('theme-settings',compact('settings'));
    }
    public function performance_settings(){
        $settings=PerformanceSetting::first();
        $compInfo=CompentencyInfo::get();
        return view('performance-setting',compact('settings','compInfo'));
    }
    public function theme_setting_update(Request $request){
        $validator = Validator::make($request->all(), [
            'website_name' => 'required',
            'light_logo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=500,max_height=500',
            'favicon'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=300,max_height=300',

        ]);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }
        $setting=ThemeSetting::first();
        if(!empty($setting)){
            $setting->website_name=$request->website_name;

            $light_logo = $request->file('light_logo');
            if($light_logo!=''){
            $time = microtime('.') * 10000; 
            $light_logo_filename = $time.'.'.strtolower( $light_logo->getClientOriginalExtension() );
            $destination = 'setting_images';
            $light_logo->move($destination, $light_logo_filename);
            }
            else{
                $light_logo_filename=$setting->light_logo;
            }
            
            $fevicon = $request->file('favicon');
            if($fevicon!=''){
            $time = microtime('.') * 10000; 
            $fevicon_filename = $time.'.'.strtolower( $fevicon->getClientOriginalExtension() );
            $destination = 'setting_images';
            $fevicon->move($destination, $fevicon_filename);
            }
            else{
                $fevicon_filename=$setting->favicon;
            }
            $setting->favicon=$fevicon_filename;
            $setting->light_logo=$light_logo_filename;
            $setting->save();
        }else{
            $setting = new ThemeSetting();
            $setting->website_name=$request->website_name;
            
            $light_logo = $request->file('light_logo');
            if($light_logo!=''){
            $time = microtime('.') * 10000; 
            $light_logo_filename = $time.'.'.strtolower( $light_logo->getClientOriginalExtension() );
            $destination = 'setting_images';
            $light_logo->move($destination, $light_logo_filename);
            }
            else{
                $light_logo_filename=$setting->light_logo;
            }

            $fevicon = $request->file('favicon');
            if($fevicon!=''){
          
            $time = microtime('.') * 10000; 
            $fevicon_filename = $time.'.'.strtolower( $fevicon->getClientOriginalExtension() );
            $destination = 'setting_images';
            $fevicon->move($destination, $fevicon_filename);
            }
            else{
                $fevicon_filename=$setting->favicon;
            }
            $setting->favicon=$fevicon_filename;
            $setting->light_logo=$light_logo_filename;
            $setting->save();
        }
        return back();
    }
}
