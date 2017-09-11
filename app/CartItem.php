<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tour_package()
    {
    	return $this->hasOne('App\TourPackage');
    }

    public function package_type()
    {
    	return $this->hasOne('App\PackageType');
    }
}
