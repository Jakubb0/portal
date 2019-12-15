<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function groups()
    {
    	return $this->belongsToMany('App\Group');
    }
}
