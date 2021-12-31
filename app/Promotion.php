<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employeeid', 'id');
    }
    public function desfrom()
    {
        return $this->belongsTo('App\Designation', 'promotionform', 'id');
    }
    public function desto()
    {
        return $this->belongsTo('App\Designation', 'promotionto', 'id');
    }
    public function getdepartment()
    {
        return $this->belongsTo('App\Department', 'department', 'id');
    }
}
