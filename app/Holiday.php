<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = [
        'name', 'date', 'year'
    ];
	protected $primaryKey = 'id';




}
