<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelReservationInquiry extends Model
{
	protected $guarded = ['id'];

    public function hotel_location()
    {
        return $this->hasOne('App\HotelLocation');
    }
}
