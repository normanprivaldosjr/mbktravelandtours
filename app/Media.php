<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
	protected $table = "medias";
    protected $guarded = ['id'];

    public function posts()
    {
        return $this->belongsTo('App\Post', 'id');
    }
}
