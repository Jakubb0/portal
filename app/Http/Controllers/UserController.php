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
            'email' => 'unique:users|required|email',
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
            'role' => 0,
            'notify' => $request->check=='on'?true:false,
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
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

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
        $users = User::all();
        return view('users.users')->with('users', $users);
    }

    public function profile()
    {
        $user = User::find(Auth::id());
        $groups = $user->groups;
        $ogroups = Group::where('owner', Auth::id())->get();
        return view('users.profile', ['user'=>$user, 'groups'=>$groups, 'ogroups'=> $ogroups]);
    }

    public function editprofile()
    {
        $user = Auth::user();
        return view('users.editprofile')->with('user', $user);
    }

    public function profilesave(Request $request)
    {
        $request->validate([
            'login' => 'bail|required|unique:users,login,' . Auth::id(),
            'password' => 'min:8|required',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'name' => 'required',
            'surname' => 'required',
            'album' => 'nullable|unique:users,album,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->login = $request->login;
        $user->password = Hash::make($request->password);
        $user->notify = $request->check=='on'?true:false;
        if($user->role==1)
            $user->album = $request->album;
        $user->save();

        return redirect()->route('profile');
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
        if(isset($user->groups[0]))
            $user->groups()->detach();
        $user->delete();

        return redirect()->back();
    }

    public function activateusers()
    {
        $users = User::where('role', 0)->get();
        return view('users.activateusers')->with('users', $users);
    }

    public function activate($r, $id)
    {
        $user = User::find($id);
        $user->role = $r;
        $user->save();

        return redirect()->back();
    }
}
