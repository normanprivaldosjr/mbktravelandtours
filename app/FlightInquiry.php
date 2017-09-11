<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightInquiry extends Model
{
    protected $guarded = ['id'];

    public function location()
    {
        return $this->hasOne('App\Location');
    }
}
