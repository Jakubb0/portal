<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Group;

class UserController extends Controller
{
    public function register(Request $request)
    {
        
        $request->validate([
            'login' => 'bail|unique:users|required',
            'password' => 'min:8|required',
            'email' => 'unique:users|required',
            'name' => 'required',
            'surname' => 'required',
            'album' => 'required|unique:users',
        ]);

        $group = Group::find($request->group);


        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'album' => $request->album,
            'role' => 1,
        ]);

        $group->users()->attach($user->id);


    	return $this->login($request);
    }

    public function login(Request $request)
    {
    	$credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) 
        {

            return redirect()->intended('/main');
        }	
       	else
       	{
       		return redirect()->back();
       	}
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect()->home();
    }

    public function home()
    {
        $groups=Group::where('type', 1)->get();
        if(!Auth::check())
            return view('welcome')->with('groups', $groups);
        else
            return redirect()->route('main');

    }
}
