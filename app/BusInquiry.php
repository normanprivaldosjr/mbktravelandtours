<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusInquiry extends Model
{
    protected $guarded = ['id'];

    public function bus_travel_location()
    {
        return $this->hasOne('App\BusTravelLocation');
    }
}
