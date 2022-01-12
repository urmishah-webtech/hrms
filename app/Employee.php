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
        'name', 'email', 'role_id', 'gender',
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
    public function getcompany()
    {
        return $this->belongsTo('App\Setting', 'company_id', 'id');
    }
}
