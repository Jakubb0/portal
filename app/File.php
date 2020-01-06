<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	public $timestamps = false;
    protected $fillable = ['name', 'path'];

    public function posts()
    {
    	return $this->belongsToMany('App\Post');
    }
}
