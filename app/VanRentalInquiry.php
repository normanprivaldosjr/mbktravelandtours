<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VanRentalInquiry extends Model
{
    protected $guarded = ['id'];

    public function van()
    {
        return $this->hasOne('App\Van');
    }
}
