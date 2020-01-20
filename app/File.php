<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	public $timestamps = false;
    protected $fillable = ['name', 'path', 'filetest_id', 'filetest_type'];

    public function filetest()
    {
		return $this->morphTo();
    }
}
