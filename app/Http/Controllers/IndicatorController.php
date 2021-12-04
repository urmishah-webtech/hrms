<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Indicator;
use App\Designation;
class IndicatorController extends Controller
{
    public function indicators(){
        $indicators=Indicator::get();
        $designations=Designation::get();
        return view('performance-indicator',compact('indicators','designations'));
    }
}
