<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeThirdVerbalWarning extends Model
{
    public function employee()
    {
		return $this->belongsTo('App\Employee','emp_id','id');
    }
}
