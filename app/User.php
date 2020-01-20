<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'surname', 'login', 'password', 'email', 'role', 'number'];
    public $timestamps = false;


    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
