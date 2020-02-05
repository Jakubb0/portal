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
        $request->validate([
            'gname' => 'required',
            'institute' => 'required',
            'year' => 'required',
            'type' => 'required',
        ]);    

        $group = Group::create([
            'name' => $request->gname,
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
        $g=Group::find($id);

        if($cookie == null&&User::where('id', $uid)->exists())
        {
            if(!$g->users()->get()->contains($uid))
                Cookie::queue('group' . $id, $uid, 15);   
        }
        else
        {
            $cookie = explode(';', $cookie);

            for ($i=0; $i<count($cookie); $i++) 
            {
                if(!in_array($uid, $cookie)&&User::where('id', $uid)->exists())
                {
                    array_push($cookie, $uid); 
                    $cookie = implode(';', $cookie);
                    if(!$g->users()->get()->contains($uid))
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
        $request->validate(['users'=>'required']);  
        $cookiename = 'group' .$id;
        $group = Group::find($id);
        Cookie::queue(Cookie::forget($cookiename));


        foreach($request->users as $user)
        {
            if(User::where('id', $user)->exists())
                $group->users()->attach($user);
        }

        return redirect()->route('groups');
    }

    public function clearusers($id)
    {
        $cookiename = 'group' .$id;
        Cookie::queue(Cookie::forget($cookiename));
    }

    public function deletefrom($gid, $uid)
    {
        $group = Group::find($gid);
        $group->users()->detach($uid);
        return redirect()->back();
    }

    public function deletegroup($id)
    {
        if(Group::where('id', $id)->exists()&&Auth::user()->role>2||Group::where('owner', Auth::id()))
        {
            $group = Group::find($id);
            if(isset($group->users[0]))
                $group->users()->detach();

            $group->delete();
        }

        return redirect()->route('groups');
    }
}
