<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{

	protected $guarded = ['id'];

	public function package_types()
	{
		return $this->hasMany('App\PackageType');
	}

    public function cart_items()
    {
    	return $this->belongsToMany('App\CartItem');
    }
}
