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
            'album' => 'nullable|unique:users',
        ]);


        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'album' => $request->album,
            'role' => 1,
        ]);
        if(isset($request->group))
        {
            $group = Group::find($request->group);
            $group->users()->attach($user->id);
        }


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

    public function users()
    {
        $users = User::paginate(10);
        return view('users.users')->with('users', $users);
    }

    public function profile()
    {
        $user = User::find(Auth::id());
        $groups = $user->groups;
        $ogroups = Group::where('owner', Auth::id())->get();
        return view('users.profile', ['user'=>$user, 'groups'=>$groups, 'ogroups'=> $ogroups]);
    }

    public function changerole($id, Request $request)
    {
        $user = User::find($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->groups()->detach();
        $user->messages()->to_id = "#deleted";
        $user->delete();

        return redirect()->back();
    }
}
