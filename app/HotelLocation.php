<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelLocation extends Model
{
	protected $guarded = ['id'];

    public function hotel_reservation_inquiry()
    {
        return $this->belongsTo('App\HotelReservationInquiry');
    }
}
