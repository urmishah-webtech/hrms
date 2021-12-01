<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Model
{
    use HasRoles;
    public function designation()
    {
        return $this->belongsTo('App\Designation');
    }
    public function department()
    {
        return $this->belongsTo('App\Department');
    }
}
