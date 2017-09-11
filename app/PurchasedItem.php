<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedItem extends Model
{
    protected $guarded = ['id'];

    public function purchase()
    {
    	return $this->belongsTo('App\Purchase');
    }
}
