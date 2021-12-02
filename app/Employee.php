<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Model
{
    use HasRoles, Notifiable;
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password'
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
