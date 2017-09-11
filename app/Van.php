<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Van extends Model
{
    protected $guarded = ['id'];

    public function van_rental_inquiry()
    {
        return $this->belongsTo('App\VanRentalInquiry');
    }
}
