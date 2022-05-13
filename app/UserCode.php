<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCode extends Model
{
     
  
    public $table = "user_codes";
  
    protected $fillable = [
        'user_id',
        'code',
    ];
}
