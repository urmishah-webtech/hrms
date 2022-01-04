<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Termination extends Model
{
	protected $table="termination";
    protected $fillable = [
        'employee_id', 'type', 'termination_date', 'reason', 'notice_date', 'terminated_by', 'resignation_id'
    ];
	protected $primaryKey = 'id';

	public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
