<?php

namespace App\Http\Controllers;

use App\User;
use App\File;
use App\Group;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FileController extends Controller
{
	public function filelist()
	{
		$files = array();
		if(Auth::check())
		{
			$groups=Auth::user()->groups->all();
			$g = array();

			foreach($groups as $group)
			{
				array_push($g, $group->id);
			}

			$posts = Post::with('files')->whereHas('groups.users', function($q) use($g){
			    $q->whereIn('group_user.user_id', $g);
			})->get();


			foreach ($posts as $p) 
			{
				foreach ($p->files as $f) 
				{
					if(!in_array($f, $files))
						array_push($files, $f);
				}
			}

			$publicpost = Post::where('public', true)->get();
			foreach($publicpost as $ppost)
			{
				foreach ($ppost->files as $file) 
				{
					if(!in_array($file, $files))
						array_push($files, $file);
				}
			}
		}
		else
		{
			$publicpost = Post::where('public', true)->get();
			foreach($publicpost as $ppost)
			{
				foreach ($ppost->files as $file) 
				{
					if(!in_array($file, $files))
						array_push($files, $file);
				}
			}

		}

		return view('files.all')->with('files', $files);
	}
}

