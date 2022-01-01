<?php

namespace App\Http\Controllers;
use App\PerformanceSetting;
use App\CompentencyInfo;
use Illuminate\Http\Request;
use DB;
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
    public function get_c_scale2(Request $request){
        $pset=PerformanceSetting::first();
        if($request->type=='scale_2'){
            $rate_data=json_decode($pset->competency_scale2_rating);
        }
        if($request->type=='scale_3'){
            $rate_data=json_decode($pset->competency_scale3_rating);
        }
        return response()->json(['rate_data'=>$rate_data]);
    }
    public function get_s_scale2(Request $request){
        $pset=PerformanceSetting::first();
        if($request->type=='scale_2'){
            $rate_data=json_decode($pset->smart_scale2_rating);
        }
        if($request->type=='scale_3'){
            $rate_data=json_decode($pset->smart_scale3_rating);
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
    public function save_c_scale2(Request $request){
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
                $settings->competency_scale2_rating=json_encode($final_array);
                $settings->save();
            }
            if($request->scale_type=='scale_3'){
                $settings->competency_scale3_rating=json_encode($final_array);
                $settings->save();
            }
        }
        else{
            $settings = new PerformanceSetting();
            if($request->scale_type=='scale_2'){
                $settings->competency_scale2_rating=json_encode($final_array);
                $settings->save();
            }
            if($request->scale_type=='scale_3'){
                $settings->competency_scale3_rating=json_encode($final_array);
                $settings->save();
            }
          
        }
       
        
    }
    public function save_s_scale2(Request $request){
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
                $settings->smart_scale2_rating=json_encode($final_array);
                $settings->save();
            }
            if($request->scale_type=='scale_3'){
                $settings->smart_scale3_rating=json_encode($final_array);
                $settings->save();
            }
        }
        else{
            $settings = new PerformanceSetting();
            if($request->scale_type=='scale_2'){
                $settings->smart_scale2_rating=json_encode($final_array);
                $settings->save();
            }
            if($request->scale_type=='scale_3'){
                $settings->smart_scale3_rating=json_encode($final_array);
                $settings->save();
            }
          
        }     
    }
    public function save_compentency_info(Request $request){
      $i=0;
      $final_arr=array();
      if(isset($request->competency) && isset($request->definition))
      foreach($request->competency as $val){
        $pd= new CompentencyInfo();
        $pd->name=$val;
        $pd->defination=$request->definition[$i];
        $pd->save();
        $final_arr[$i]['name']=$val;
        $final_arr[$i]['defination']=$request->definition[$i];
        $final_arr[$i]['id']=$pd->id;

        $i++;
      }
      return  response()->json(["compentencyInfo"=>$final_arr]);
    }
    public function delete_compentency_info(Request $request){
        $delData=CompentencyInfo::where('id',$request->id)->delete();
      return  response()->json(["status"=>$delData]);
    }
    public function edit_compentency_info(Request $request){
        $data=CompentencyInfo::where('id',$request->id)->first();
        $data->defination=$request->defination;
        $data->save();
        return  response()->json(["status"=>$data]);
    }
    public function changeStatus($type){
        $settings=PerformanceSetting::first();
        if($settings){
            if($type==1){
                $settings->okr_active=1;
                $settings->save();
            }
            else if($type==2){
                $settings->compentency_active=1;
                $settings->save();
            }
            else{
                $settings->smart_goals_active=1;
                $settings->save();
            }
        }
        else{
            $settings=new PerformanceSetting();
            if($type==1){
                $settings->okr_active=1;
                $settings->save();
            }
            else if($type==2){
                $settings->compentency_active=1;
                $settings->save();
            }
            else{
                $settings->smart_goals_active=1;
                $settings->save();
            }
        }
        return back();
    }
}
