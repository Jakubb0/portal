<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'institute', 'year', 'type', 'owner'];


    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
