<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public $timestamps = false;
	protected $fillable = ['title', 'content','date', 'status', 'message_id'];

    public function files()
    {
        return $this->morphMany('App\File', 'filetest');
    }
    public function messages()
    {
        return $this->belongsTo('App\Message');
    }
}
