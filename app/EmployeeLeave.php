<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
    public function leave_type()
    {
        return $this->belongsTo('App\LeaveType');
    }
}
