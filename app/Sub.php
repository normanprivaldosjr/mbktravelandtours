<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
	protected $table = "sub";
	
    protected $guarded = ['id'];
}
