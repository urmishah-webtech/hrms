<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    public function designation()
    {
        return $this->belongsTo('App\Designation');
    }
     
}
