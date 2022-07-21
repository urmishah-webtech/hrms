<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee_all_verbal_warnings extends Model
{
    protected $table = "employee_all_verbal_warnings";
    protected $guarded =[];

    public function employee_name()
    {
      return $this->hasMany(Employee::class, 'id', 'emp_id');
    }
}
