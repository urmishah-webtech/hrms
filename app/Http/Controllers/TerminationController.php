<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TerminationType;
use App\Termination;
use App\Resignation;
use App\Employee;
use Auth;
use App\Notification;
use App\Events\TerminationAdded;
use Carbon\Carbon;




class TerminationController extends Controller
{

	/*Termination Type Login*/

	protected $rules = [
		'type' => ['required'],
		'status'=> []
	];

	public function listTypes()
	{
		$types = TerminationType::all();
    	return view('termination-type')->with(['types'=>$types]);
	}
    public function saveType(Request $request)
    {
    	$validated = $request->validate($this->rules);
    	TerminationType::create($validated);
    	return redirect()->to(route('termination-type'));
    }
    public function updateType(Request $request)
    {
    	$validated = $request->validate($this->rules);
    	$type = TerminationType::where('id', $request->id)->update($validated);
    	if($type) {
    		return redirect()->back()->with('message', 'Data Updated.');
    	}
    	return redirect()->back()->with('alert', 'Try Again!.');
    	
    }
    public function changeTypeStatus($id = 0 ,$status = '')
    {
    	if($id <= 0 || empty($status)) {
    		return redirect()->back()->with('alert', 'Try Again!.');
    	}
    	TerminationType::where('id', $id)->update(['status' => $status]);
    	return redirect()->back()->with('message', 'Status Changed.');
    }
    public function deleteType($id)
    {
    	
    	$deleted = TerminationType::where('id', $id)->delete();

    	if($deleted) {
    		return redirect()->back()->with('message', 'Data Deleted.'); 
    	}
    	return redirect()->back()->with('message', 'Try Again!');
    }

    /*Termination logic*/

    protected $terminationRules = [
		'employee_id' => ['required'],
		'type' => ['required'],
		'termination_date' => ['required'],
		'reason' => ['required'],
		'notice_date' => ['required'],
		'resignation_id' => [''],
	];
        
    public function list()
	{   

        $resignation = null;   
        if(!empty(session()->get('resignation_id'))) {

            $resignation =Resignation::find(session()->get('resignation_id'));
            session()->forget('resignation_id');
        }

       $user = auth()->user();
        if (!empty($user)) {
            $role = $user->role_id;
            if ($role == 1 || $role==5) {
                $terminations = Termination::with(['employee' => function($q) {
                    return $q->with('department');
                }])->get();

            } else if($role == 2) {
         
                 $terminations = Termination::with(['employee' => function($q) {
                    return $q->with('department');

                }])->where(function ($query) use ($user) {
                    $query->where('employee_id', $user->id)
                        ->orWhereHas('employee', function($q) use ($user){
                            return $q->where('man_id', $user->id);
                        });
                })->get();


            } else {
                $terminations = Termination::with(['employee' => function($q) {
                    return $q->with('department');
                }])->where('employee_id', $user->id)->get();
            }
        } 
      
		$types = TerminationType::where('status', 'Active')->get()->pluck(['type']);
		$employees = Employee::where('id', '!=', Auth::user()->id)->get();
    	return view('termination')->with(['terminations'=>$terminations, 'types' => $types, 'employees' => $employees, 'resignation' => $resignation, 'user' => $user]);
	}
    public function save(Request $request)
    {
    	$validated = $request->validate($this->terminationRules);
    	$validated['terminated_by'] = Auth::id();

        $validated['termination_date'] = Carbon::createFromFormat('d/m/Y', $validated['termination_date'])->format('Y-m-d');
        $validated['notice_date'] = Carbon::createFromFormat('d/m/Y', $validated['notice_date'])->format('Y-m-d');
    	Termination::create($validated);

        $employee = Employee::find($validated['employee_id']);

        if($employee->role_id == 3 && !empty($employee->man_id)) {
            $message1 = 'Your employee '.$employee->first_name.' '.$employee->last_name.' will terminate on  '.$validated['termination_date'];
            Notification::create(['employeeid' => $employee->man_id, 'message' => $message1]);
            event(new TerminationAdded($message1, $employee->man_id));
        }

        $message = 'You will terminate on  '.$validated['termination_date'];
        Notification::create(['employeeid' => $validated['employee_id'], 'message' => $message]);
        event(new TerminationAdded($message, $validated['employee_id']));

    	return redirect()->to(route('termination'));
    }
    public function update(Request $request)
    {
    	$validated = $request->validate($this->terminationRules);
        $validated['termination_date'] = Carbon::createFromFormat('d/m/Y', $validated['termination_date'])->format('Y-m-d');
        $validated['notice_date'] = Carbon::createFromFormat('d/m/Y', $validated['notice_date'])->format('Y-m-d');
    	$type = Termination::where('id', $request->id)->update($validated);
    	if($type) {

            $employee = Employee::find($validated['employee_id']);

            if($employee->role_id == 3 && !empty($employee->man_id)) {
                $message1 = 'Your employee '.$employee->first_name.' '.$employee->last_name.' \'s termination is updated ';
                Notification::create(['employeeid' => $employee->man_id, 'message' => $message1]);
                event(new TerminationAdded($message1, $employee->man_id));
            }

            $message = 'Your termination is updated !';
            Notification::create(['employeeid' => $validated['employee_id'], 'message' => $message]);
            event(new TerminationAdded($message, $validated['employee_id']));

    		return redirect()->back()->with('message', 'Data Updated.');
    	}
    	return redirect()->back()->with('alert', 'Try Again!.');
    	
    }
    public function delete($id)
    {

        $employee_id = Termination::find($id)->employee_id;
    	
    	$deleted = Termination::where('id', $id)->delete();

    	if($deleted) {

            $employee = Employee::find($employee_id);

            if($employee->role_id == 3 && !empty($employee->man_id)) {
                $message1 = 'Your employee '.$employee->first_name.' '.$employee->last_name.' \'s termination is Canceled ';
                Notification::create(['employeeid' => $employee->man_id, 'message' => $message1]);
                event(new TerminationAdded($message1, $employee->man_id));
            }

            $message = 'Your termination is Canceled !';
            Notification::create(['employeeid' => $employee_id, 'message' => $message]);
            event(new TerminationAdded($message, $employee_id));

    		return redirect()->back()->with('message', 'Data Deleted.'); 
    	}
    	return redirect()->back()->with('message', 'Try Again!');
    }
    public function openCreateForm($resignation_id)
    {

        session()->put('form', 'create');
        session()->put('resignation_id', $resignation_id);

        return redirect()->to(route('termination'));
    }
}
