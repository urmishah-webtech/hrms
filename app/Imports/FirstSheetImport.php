<?php

namespace App\Imports;

use App\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Designation;
use App\Department;
use App\Role;
use App\Location;
use Carbon\Carbon;
use App\ProfilePersonalInformations;
use Illuminate\Support\Facades\Hash;
class FirstSheetImport implements ToModel,WithHeadingRow,WithValidation
{  /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function rules(): array
    {
        return [
         //   'first_name' => 'required',
         //   'last_name' => 'required',
         //   'user_name' => 'required',
         //   'password' => 'required',
         //   'email' => 'required|unique:employees',
           // 'employee_code' => 'required',
       //     'joining_date' => 'required',
        //    'phone_no' => 'required',
       //     'department' => 'required',
       //     'designation' => 'required',
        //    'role' => 'required',
         //   'gender'=>'required',
         //   'manager'=>'required',

        //    'passport'=>'required',
           // 'passport_expiry_date'=>'required',
          //  'tel'=>'required',
          //  'nationality'=>'required',
          //  'religion'=>'required',
          //  'marital_status'=>'required',
           // 'employment_of_spouse'=>'required',

        ];
    }
    public function model(array $row)
    {
        // echo "<pre>";
        // print_r($row);
        $searchValues = preg_split('/\s+/',$row['department'], -1, PREG_SPLIT_NO_EMPTY); 
        $row['department'] = Department::where(function ($q) use ($searchValues) {
            foreach ($searchValues as $value) {
              $q->where("name", "like",'%'.$value.'%');
            }
        })->orderByRaw('name like ? desc', $row['department'])
          ->orderByRaw('instr(name,?) asc', $row['department'])
          ->orderBy('name')->first();
        // $row['department'] = Department::where("name", "like",'%'.$row['department'].'%')
        // ->orderByRaw('name like ? desc', $row['department'])
        // ->orderByRaw('instr(name,?) asc', $row['department'])
        // ->orderBy('name')->first();
        $searchValues = preg_split('/\s+/',$row['manager'], -1, PREG_SPLIT_NO_EMPTY); 
        $row['manager']  = Employee::where(function ($q) use ($searchValues) {
            foreach ($searchValues as $value) {
              $q->where("first_name", "like",'%'.$value.'%');
            }
        })->orderByRaw('first_name like ? desc', $row['manager'])
          ->orderByRaw('instr(first_name,?) asc', $row['manager'])
          ->orderBy('first_name')->first();
          //Employee::where("first_name", "LIKE", "%{$row['manager']}%")->first();

        if($row['department']){
            $searchValues = preg_split('/\s+/',$row['designation'], -1, PREG_SPLIT_NO_EMPTY); 
            $row['designation'] = Designation::where(function ($q) use ($searchValues) {
                foreach ($searchValues as $value) {
                  $q->where("name", "like",'%'.$value.'%');
                }
            })->orderByRaw('name like ? desc', $row['designation'])
              ->orderByRaw('instr(name,?) asc', $row['designation'])
              ->where("department_id",$row['department']->id)
              ->orderBy('name')->first();
        }
        else{
            $row['designation'] =   $searchValues = preg_split('/\s+/',$row['designation'], -1, PREG_SPLIT_NO_EMPTY); 
            $row['designation'] = Designation::where(function ($q) use ($searchValues) {
                foreach ($searchValues as $value) {
                  $q->where("name", "like",'%'.$value.'%');
                }
            })->orderByRaw('name like ? desc', $row['designation'])
              ->orderByRaw('instr(name,?) asc', $row['designation'])
              ->orderBy('name')->first();
        }
        $row['location'] =   $searchValues = preg_split('/\s+/',$row['location'], -1, PREG_SPLIT_NO_EMPTY); 
        $row['location'] = Location::where(function ($q) use ($searchValues) {
            foreach ($searchValues as $value) {
              $q->where("name", "like",'%'.$value.'%');
            }
        })->orderByRaw('name like ? desc', $row['designation'])
          ->orderByRaw('instr(name,?) asc', $row['designation'])
          ->orderBy('name')->first();

       // $row['location'] = Location::where("name", "like", "%".$row['location']."%")->first();
    
         
        $searchValues = preg_split('/\s+/',$row['role'], -1, PREG_SPLIT_NO_EMPTY);  
        $row['role'] = Role::where(function ($q) use ($searchValues) {
            foreach ($searchValues as $value) {
              $q->where("name", "like",'%'.$value.'%');
            }
        })->orderByRaw('name like ? desc', $row['role'])
          ->orderByRaw('instr(name,?) asc', $row['role'])
          ->orderBy('name')->first();
        // Role::where("name", "like", "%".$row['role']."%")->first();
        $dummy_email='test_'.rand(1000000,10000).'@gmail.com';

        if($row['email']=='' || !(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",$row['email']))){
            $row['email'] = $dummy_email;
        }
        if(Employee::where('email',$row['email'])->first()){
            $row['email'] = $dummy_email;
        }

        if($row['department']){
            $row['department']=$row['department']->id;
        }else{
            $row['department']=null;
        }

        if($row['manager']){
            $row['manager']=$row['manager']->id;
        }else{
            $row['manager']=null;
        }

        if($row['designation']){
            $row['designation']=$row['designation']->id;
        }else{
            $row['designation']=null;
        }

        if($row['role']){
            $row['role']=$row['role']->id;
        }else{
            $row['role']=null;
        }

        if(preg_match('/'.$row['gender'].'/','male'))
        {
            $gender=0;
        }
        else if(preg_match('/'.$row['gender'].'/','female'))
        {
            $gender=1;
        }
        else if(preg_match('/'.$row['gender'].'/','others'))
        {
            $gender=2;
        }
        else{
            $gender=0;
        }

        if($row['location']){
            $row['location']=$row['location']->id;
        }else{
            $row['location']=null;
        }

        $employee=Employee::create([
            'first_name'     => $row['first_name'],
            'last_name'    => $row['last_name'], 
            'user_name' => 'user'.rand(1000000,1000),
            'email' => $row['email'],
            'password'=>Hash::make('1234'),
            'employee_id'=> 'emp_'.rand(1000000,100),
            'joing_date'=>is_null($row['joining_date'])?NULL:$this->transformDate($row['joining_date']),
            'phone_no'=>$row['phone_no'],
            'department_id'=>$row['department'],
            'designation_id'=>$row['designation'],
            'role_id'=>$row['role'],
            'perfomance_status'=>0,
            'gender'=>$gender,
            'man_id'=>$row['manager'],
            'location_id'=>$row['location']
        ]);
        $pi= new ProfilePersonalInformations();
        $pi->passport_no=$row['passport'];
        $pi->passport_expiry_date=is_null($row['passport_expiry_date'])?NULL:$this->transformDate($row['passport_expiry_date']);
      //  $pi->tel=$row['tel'];
        $pi->nationality=$row['nationality'];
        $pi->religion=$row['religion'];
        $pi->marital_status=$row['marital_status'];
        $pi->employment_of_spouse=$row['employment_of_spouse'];
        $pi->emp_id=$employee->id;
        $pi->save();
		// exit;
       return $employee;
		
    }
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return NULL;
        }
    }
}