<?php

namespace App\Http\Controllers;
use App\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function groups()
    {
    	$user = Auth::user();
    	$groups = $user->groups;

    	return view('group.all')->with('groups', $groups);
    }

    public function new(Request $request)
    {
    		
    	$group = Group::create([
    		'name' => $request->name,
    		'institute' => $request->institute,
    		'year' => $request->year,
    		'type' => $request->type,
    	]);

    	return redirect()->intended('/group');
    }
}
