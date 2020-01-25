<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public $timestamps = false;
	protected $fillable = ['title', 'content','date', 'status', 'message_id', 'from_id', 'to_id'];

    public function files()
    {
        return $this->morphMany('App\File', 'filetest');
    }
    public function messages()
    {
        return $this->belongsTo('App\Message', 'message_id');
    }
}
