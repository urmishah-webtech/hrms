<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TerminationType extends Model
{
    protected $fillable = [
        'type', 'status'
    ];
	protected $primaryKey = 'id';
}
