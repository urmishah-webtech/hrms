<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePersonalInformations extends Model
{
    protected $fillable = ['passport_no','passport_expiry_date','tel','nationality','religion','marital_status','employment_of_spouse','emp_id'];
}
