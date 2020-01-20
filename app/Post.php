<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'content', 'user_id', 'date', 'public'];

    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }    

    public function files()
    {
        //return $this->belongsToMany('App\File');
        return $this->morphMany('App\File', 'filetest');
    }
}
