<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Holiday;

class HolidayController extends Controller
{

	protected $rules = [
		'name' => ['required'],
		'date' => ['required']
	];
    public function save(Request $request)
    {
    	$validated = $request->validate($this->rules);
    	$validated['year'] = explode('-', $request->date)[0];
    	Holiday::create($validated);
    	return redirect()->to(route('holidays'));
    }
    public function list()
    {
    	$holidays = Holiday::orderBy('date', 'DESC')->get()->groupBy('year')->toArray();
    	return view('holidays')->with(['holidays'=>$holidays]);
    }
    public function edit($id)
    {
    	dd($id);
    }
}
