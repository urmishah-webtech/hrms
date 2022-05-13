<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 
use Exception;
use Mail;
use App\Mail\SendCodeMail; 
 

class Employee extends Authenticatable
{
     use   Notifiable;
  
    protected $fillable = [
        'first_name','last_name', 'email', 'role_id', 'gender','user_name','password','employee_id','joing_date',
        'phone_no','department_id','designation_id','perfomance_status','gender','man_id','location_id'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function designation()
    {
        return $this->belongsTo('App\Designation');
    }
    public function department()
    {
        return $this->belongsTo('App\Department');
    }
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
    public function getcompany()
    {
        return $this->belongsTo('App\Setting', 'company_id', 'id');
    }
	public function generateCode()
    {
        $code = rand(1000, 9999);
  
        UserCode::updateOrCreate(
            [ 'user_id' => auth()->user()->id ],
            [ 'code' => $code ]
        );
    
        try {
  
            $details = [
                'title' => 'Authentication Code',
                'code' => $code
            ];
             
            Mail::to(auth()->user()->email)->send(new \App\Mail\SendCodeMail($details));
    
        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }
}
