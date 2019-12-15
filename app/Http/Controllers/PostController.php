<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function posts()
    {
    	$user  = Auth::user();
    	$p = array(); 

    	for($i = 0; $i<count($user->groups); $i++)
    	{
    		for($j = 0; $j<count($user->groups[$i]->posts); $j++)
    		{
    			$p[]=$user->groups[$i]->posts[$j];
    		}
    	}

    	$p = collect($p)->sortBy('date')->reverse()->forPage($_GET['page'], 5);

    	return view('mainpage')->with('posts', $p);
    }
}
