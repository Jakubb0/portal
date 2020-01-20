<?php

namespace App\Http\Controllers;
use App\Group;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class GroupController extends Controller
{
    public function groups()
    {
        $user = Auth::user();
        if($user->role<3)
            $groups = $user->groups;
        else
            $groups = Group::all();
     
        return view('group.all')->with('groups', $groups);
    }

    public function new(Request $request)
    {
            
        $group = Group::create([
            'name' => $request->name,
            'institute' => $request->institute,
            'year' => $request->year,
            'type' => $request->type,
            'owner' => Auth::id(),
        ]);

        $group->users()->attach(Auth::id());

        return redirect()->intended('/group');
    }

    public function addto(Request $request, $id, $uid)
    {
        
        $cookiename = 'group' . $id;

        $cookie = $request->cookie($cookiename);

        if($cookie == null)
        {
            Cookie::queue('group' . $id, $uid, 15);   
        }
        else
        {
            $cookie = explode(';', $cookie);

            for ($i=0; $i<count($cookie); $i++) 
            {
                if(!in_array($uid, $cookie))
                {
                    array_push($cookie, $uid); 
                    $cookie = implode(';', $cookie);
                    Cookie::queue('group' . $id, $request->cookie($cookiename).';'. $uid, 15);
                    $cookie = explode(';', $cookie);
                }
            }
        }
    } 

    public function add(Request $request, $id)
    {
        $cookiename = 'group' . $id;
        $cookie = $request->cookie($cookiename);
        $cookie = explode(';', $cookie);
        $test = array();

        if($cookie[0]!='')
        {
            for ($i=0; $i<count($cookie); $i++) 
            {
                $user = User::find($cookie[$i]);
                array_push($test, $user); 
            }
        }

        return view('group.add', ['users' => $test, 'id' => $id])->with('users', $test);
    }

    public function postadd(Request $request, $id)
    {
        $cookiename = 'group' .$id;
        $group = Group::find($id);
        Cookie::queue(Cookie::forget($cookiename));
        
        foreach($request->users as $user)
        {
            $group->users()->attach($user);
        }

        return redirect()->route('groups');
    }
}
