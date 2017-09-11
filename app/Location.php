<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = ['id'];

    public function flight_inquiry()
    {
        return $this->belongsTo('App\FlightInquiry');
    }
}
