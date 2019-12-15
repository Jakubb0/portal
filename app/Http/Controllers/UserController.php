<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

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
        ]);


    	$user = new User();
    	$user->name = $request->name;
    	$user->surname = $request->surname;
    	$user->login = $request->login;
    	$user->password = Hash::make($request->password);
    	$user->email = $request->email;
    	$user->role = 1;
    	$user->album = null;

    	$user->save();

    	return $this->login($request);
    }

    public function login(Request $request)
    {
    	$credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {

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
}
