<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssistantManager extends Model
{
    use HasFactory;
    protected $table = "employee_all_verbal_warnings";
    protected $guarded =[];
}
