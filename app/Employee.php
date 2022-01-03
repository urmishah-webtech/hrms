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
        'name', 'email', 'role_type',
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
}
