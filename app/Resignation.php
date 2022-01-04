<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resignation extends Model
{
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employeeid', 'id');
    }
    public function decisionmaker()
    {
        return $this->belongsTo('App\Employee', 'decisionby', 'id');
    }
    public function getdepartment()
    {
        return $this->belongsTo('App\Department', 'department', 'id');
    }
}
