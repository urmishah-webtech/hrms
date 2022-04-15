<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Location;
use App\Employee;
use Validator;
class LocationController extends Controller
{
    public function add_location(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if($validator->fails()){
            return back()->with('error', 'Error in creating location');
        }
        $dept=new Location();
        $dept->name=$request->name;
        $dept->save();
        return back();
    }
    public function locations()
    {
        $depts= Location::get();
        return view('locations',compact('depts'));
    }
    public function edit_location(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if($validator->fails()){
            return back()->with('error', 'Error in updating location');
        }
        $dept= Location::find($request->id);
        if($dept){
            $dept->name=$request->name;
            $dept->save();
        }
        else{
            return back();
        }
        return back();
    }
    public function delete_location(Request $request){
       if(Employee::where('location_id',$request->id)->exists())
        {
            return response()->json(['error'=>'3']);
        }
        else{
            $dept= Location::where('id',$request->id)->delete();

            if($dept==1){
                echo json_encode("1");
            }
            else{
                echo json_encode("0");
            }
        }
    }
}
