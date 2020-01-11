<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Message;
use Illuminate\Support\Facades\Auth;


class AjaxController extends Controller
{
    public function search(Request $request)
    {
		$user=User::where('name', 'LIKE', '%' . $request->search . '%')->orWhere('album', 'LIKE', '%' . $request->search . '%')->orWhere('surname', 'LIKE', '%'. $request->search . '%')->get();
		return view('partial.search')->with('users', $user);
    }

    public function searchuser(Request $request)
    {
        $user=User::where('name', 'LIKE', '%' . $request->search . '%')->orWhere('album', 'LIKE', '%' . $request->search . '%')->orWhere('surname', 'LIKE', '%'. $request->search . '%')->get();
        return view('partial.searchuser')->with('users', $user);
    }

    public function groups($id)
    {
    	$group = Group::where('id', $id)->first();
        $owner = $group->owner;
    	$users = $group->users;
    	return view('partial.test', ['users' => $users, 'owner' => $owner]);
    }

    public function messages($id)
    {
        if($id==1)
            $messages = Message::where('to_id', Auth::id())->get();
        else
            $messages = Message::where('from_id', Auth::id())->get();


        return view('partial.messages', ['messages'=>$messages, 'id'=>$id]);
    }

}
