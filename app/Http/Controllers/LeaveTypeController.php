<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveType;

class LeaveTypeController extends Controller
{
    public function index(Request $request){
        $lt=LeaveType::first();
        return view('leave-settings',compact('lt'));
    }
    public function save_leave_settings(Request $request){
        $lt=LeaveType::first();
        if($lt){
            $lt->annual_days=is_null($request->annual_days)?$lt->annual_days:$request->annual_days;
            $lt->annual_carry_fwd=is_null($request->annual_carry_fwd)?$lt->annual_carry_fwd:$request->annual_carry_fwd;
            $lt->annual_max=is_null($request->annual_max)?$lt->annual_max:$request->annual_max;

            if($request->annual_active_status=='on'){
                $lt->annual_active_status=1;
            }
            else{
                $lt->annual_active_status=0;
            }

            //lop
            $lt->lop_days=is_null($request->lop_days)?$lt->lop_days:$request->lop_days;
            $lt->lop_carry_fwd=is_null($request->lop_carry_fwd)?$lt->lop_carry_fwd:$request->lop_carry_fwd;
            $lt->lop_max=is_null($request->lop_max)?$lt->lop_max:$request->lop_max;

            if($request->lop_active_status=='on'){
                $lt->lop_active_status=1;
            }
            else{
                $lt->lop_active_status=0;
            }

            //sick
            $lt->sick_days=is_null($request->sick_days)?$lt->sick_days:$request->sick_days;
            if($request->sick_active_status=='on'){
                $lt->sick_active_status=1;
            }
            else{
                $lt->sick_active_status=0;
            }

            $lt->maternity_days=is_null($request->maternity_days)?$lt->maternity_days:$request->maternity_days;
            if($request->maternity_active_status=='on'){
                $lt->maternity_active_status=1;
            }
            else{
                $lt->maternity_active_status=0;
            }

            $lt->paternity_days=is_null($request->paternity_days)?$lt->paternity_days:$request->paternity_days;
            if($request->paternity_active_status=='on'){
                $lt->paternity_active_status=1;
            }
            else{
                $lt->paternity_active_status=0;
            }

            //hospitalisation
            $lt->hospitalisation_days=is_null($request->hospitalisation_days)?$lt->hospitalisation_days:$request->hospitalisation_days;
            if($request->hospitalisation_active_status=='on'){
                $lt->hospitalisation_active_status=1;
            }
            else{
                $lt->hospitalisation_active_status=0;
            }

            

            $lt->save();
        }
        else{
            $lt=new LeaveType();
            $lt->annual_days=$request->annual_days;
            $lt->annual_carry_fwd=$request->annual_carry_fwd;
            $lt->annual_max=$request->annual_max;
            if($request->annual_active_status=='on'){
                $lt->annual_active_status=1;
            }
            else{
                $lt->annual_active_status=0;
            }

            $lt->lop_days=$request->lop_days;
            $lt->lop_carry_fwd=$request->lop_carry_fwd;
            $lt->lop_max=$request->lop_max;
            if($request->lop_active_status=='on'){
                $lt->lop_active_status=1;
            }
            else{
                $lt->lop_active_status=0;
            }


            //sick
            $lt->sick_days=$request->sick_days;
            if($request->sick_active_status=='on'){
                $lt->sick_active_status=1;
            }
            else{
                $lt->sick_active_status=0;
            }

            //hospitalisation
            $lt->hospitalisation_days=$request->hospitalisation_days;
            if($request->hospitalisation_active_status=='on'){
                $lt->hospitalisation_active_status=1;
            }
            else{
                $lt->hospitalisation_active_status=0;
            }
            
            $lt->maternity_days=$request->maternity_days;
            if($request->maternity_active_status=='on'){
                $lt->maternity_active_status=1;
            }
            else{
                $lt->maternity_active_status=0;
            }

            $lt->paternity_days=$request->paternity_days;
            if($request->paternity_active_status=='on'){
                $lt->paternity_active_status=1;
            }
            else{
                $lt->paternity_active_status=0;
            }


            $lt->save();
        }
        return back();  
    }
}
