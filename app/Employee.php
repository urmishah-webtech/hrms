<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasRoles, Notifiable;
  
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
}
