<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'content', 'from_id', 'to_id', 'date', 'status'];

    public function files()
    {
        return $this->morphMany('App\File', 'filetest');
    }
    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
