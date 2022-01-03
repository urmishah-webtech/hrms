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
    public function update(Request $request)
    {

    	$validated = $request->validate($this->rules);
    	$validated['year'] = explode('-', $request->date)[0];
    	$holiday = Holiday::where('id', $request->id)->update($validated);
    	if($holiday) {
    		return redirect()->back()->with('message', 'Data Updated.');
    	}
    	return redirect()->back()->with('alert', 'Try Again!.');
    	
    }
    public function delete($id)
    {
    	
    	$deleted = Holiday::where('id', $id)->delete();

    	if($deleted) {
    		return redirect()->back()->with('message', 'Data Deleted.'); 
    	}
    	return redirect()->back()->with('message', 'Try Again!');
    }
}
