<?php

namespace App\Http\Controllers;
use App\PerformanceSetting;

use Illuminate\Http\Request;

class PerformanceSettingController extends Controller
{
    public function save_okr(Request $request){
        $settings=PerformanceSetting::first();
        if($settings){
            $settings->okr_description=$request->okr_description;
            $settings->save();
        }
        else{
            $settings = new PerformanceSetting();
            $settings->okr_description=$request->okr_description;
            $settings->save();
        }
        return response()->json(['okr_description'=>$settings->okr_description]);
    }
    public function save_competency(Request $request){
        $settings=PerformanceSetting::first();
        if($settings){
            $settings->competency_based=$request->competencies_desc;
            $settings->save();
        }
        else{
            $settings = new PerformanceSetting();
            $settings->competency_based=$request->competencies_desc;
            $settings->save();
        }
        return response()->json(['competencies_desc'=>$settings->competency_based]);
    }
    public function save_smart_config(Request $request){
        $settings=PerformanceSetting::first();
        if($settings){
            $settings->smart_goals_configuration=$request->smart_desc;
            $settings->save();
        }
        else{
            $settings = new PerformanceSetting();
            $settings->smart_goals_configuration=$request->smart_desc;
            $settings->save();
        }
        return response()->json(['smart_desc'=>$settings->smart_desc]);
    }
    public function get_scale2(Request $request){
        $pset=PerformanceSetting::first();
        if($request->type=='scale_2'){
            $rate_data=json_decode($pset->okr_scale2_rating);
        }
        if($request->type=='scale_3'){
            $rate_data=json_decode($pset->okr_scale3_rating);
        }
        if($request->type=='scale_1'){
            $rate_data=json_decode($pset->okr_scale1_rating);
            
        }
        return response()->json(['rate_data'=>$rate_data]);
    }
    public function save_scale2(Request $request){
        $settings=PerformanceSetting::first();
        $rate_arr=array();
        $final_array=array();
        array_push($rate_arr,$request->rating_no);
        $rate_count=count($rate_arr);
        if(!empty($rate_arr)){
            $i=0;
            foreach($request->rating_no as $key => $val){
            $final_array[$val]['short_word']=$request->rating_value_ten[$i];
            $final_array[$val]['defination']=$request->definition_ten[$i];
            $i++;
           }
        }
        if($settings){
            if($request->scale_type=='scale_2'){
                $settings->okr_scale2_rating=json_encode($final_array);
                $settings->save();
            }
            if($request->scale_type=='scale_1'){
                $settings->okr_scale1_rating=json_encode($final_array);
                $settings->save();
            }
            if($request->scale_type=='scale_3'){
                $settings->okr_scale3_rating=json_encode($final_array);
                $settings->save();
            }
        }
        else{
            $settings = new PerformanceSetting();
            if($request->scale_type=='scale_2'){
                $settings->okr_scale2_rating=json_encode($final_array);
                $settings->save();
            }
            if($request->scale_type=='scale_3'){
                $settings->okr_scale3_rating=json_encode($final_array);
                $settings->save();
            }
            if($request->scale_type=='scale_1'){
                $settings->okr_scale1_rating=json_encode($final_array);
                $settings->save();
            }
        }
       
        
    }
}
