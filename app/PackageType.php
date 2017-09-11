<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageType extends Model
{
    protected $guarded = ['id'];

    public function tour_package()
    {
    	return $this->belongsTo('App\TourPackage');
    }

    public function cart_items()
    {
    	return $this->belongsToMany('App\CartItem');
    }
}
