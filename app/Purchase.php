<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = ['id'];

    public function purchased_items()
    {
    	return $this->hasMany('App\PurchasedItem');
    }
}
