<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;

class AjaxController extends Controller
{
    public function search(Request $request)
    {
		$user=User::where('name', 'LIKE', '%' . $request->search . '%')->orWhere('album', 'LIKE', '%' . $request->search . '%')->orWhere('surname', 'LIKE', '%'. $request->search . '%')->get();
		return view('partial.search')->with('users', $user);
    }

    public function groups($id)
    {
    	$group = Group::where('id', $id)->first();
    	$users = $group->users;
    	return view('partial.test')->with('users', $users);
    }

}
