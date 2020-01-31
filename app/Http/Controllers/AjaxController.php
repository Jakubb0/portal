<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Message;
use App\Post;
use App\Reply;
use Illuminate\Support\Facades\Auth;


class AjaxController extends Controller
{
    public function search(Request $request, $id)
    {   
        
        $user = User::where(function ($query) use($request) {
               $query->where('name', 'LIKE', '%' . $request->search . '%')->orWhere('album', 'LIKE', '%' . $request->search . '%')->orWhere('surname', 'LIKE', '%'. $request->search . '%');
           })->whereDoesntHave('groups', function($q) use($request, $id){
                $q->where('group_user.group_id',$id);
        })->get();
        

        
        //$user = DB::select(DB::raw("select * from `users` where (`name` LIKE '%$request->search%' or `album` LIKE '%$request->search%' or `surname` LIKE '%$request->search%') and not exists (select * from `groups` inner join `group_user` on `groups`.`id` = `group_user`.`group_id` where `users`.`id` = `group_user`.`user_id` and `group_user`.`group_id` = $id)"));


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
        return view('partial.test', ['users' => $users, 'owner' => $owner, 'gid'=>$id]);
    }

    public function messages($id)
    {
        if($id==1)
        {
            $messages = Message::where('to_id', Auth::id())->get();
            $replies = Reply::where('to_id', Auth::id())->get()->each(function($reply) use($messages)
                {
                    $messages->push($reply);
                });
        }
        elseif($id==2)
        {
            $messages = Message::where('from_id', Auth::id())->get();
            $replies = Reply::where('from_id', Auth::id())->get()->each(function($reply) use($messages)
                {
                    $messages->push($reply);
                });
        }
        elseif($id==3)
        {
            $messages = Message::where('to_id', Auth::id())->where('status', 0)->get();
            $replies = Reply::where('to_id', Auth::id())->where('status', 0)->get()->each(function($reply) use($messages)
                {
                    $messages->push($reply);
                });
        }    
            

        return view('partial.messages', ['messages'=>$messages->sortByDesc('date'), 'id'=>$id]);
    }

    public function userinfo($id)
    {
        $user = User::find($id);
        $groups = $user->groups;
        return view('partial.userinfo', ['user'=> $user, 'groups'=>$groups]);
    }

    public function users($id, Request $request)
    {

        if($id==1|$id==2|$id==3)
        {
            $users = User::where(function($q) use($request){
                $q->where('name', 'LIKE' ,'%' . $request->search . '%')->orWhere('surname', 'LIKE' ,'%' . $request->search . '%')->orWhere('album', 'LIKE' ,'%' . $request->search . '%');
            })->where('role', $id)->get();

            if($request->search==null)
                $users = User::where('role', $id)->get();

            return view('partial.users')->with('users', $users);
        }
        elseif($id==4)
        {
            $users = User::where('name', 'LIKE' ,'%' . $request->search . '%')->orWhere('surname', 'LIKE' ,'%' . $request->search . '%')->orWhere('album', 'LIKE' ,'%' . $request->search . '%')->get();

            if($request->search==null)
                $users = User::all();

            return view('partial.users')->with('users', $users);
        }
        else
            return redirect()->back();
    }

    public function posts($id, Request $request)
    {
        $datefrom = $request->datefrom;
        $dateto = $request->dateto;
        if($id=="all")
        {
            $groups = Auth::user()->groups;
            $groupsid = array();
            
            foreach ($groups as $group) 
            {
                array_push($groupsid, $group->id);
            }

            if(!is_null($datefrom)&&!is_null($dateto))
            {
                $posts = Post::with('groups')->whereHas('groups.users', function($q) use($groupsid,$datefrom,$dateto){
                    $q->whereIn('group_user.group_id', $groupsid)->whereBetween('posts.date', [$datefrom . ' 00:00:00', $dateto.' 23:59:59']);
                })->orWhere('public', true)->whereBetween('date', [$datefrom . ' 00:00:00', $dateto.' 23:59:59'])->get()->sortByDesc('date');
            }
            elseif(is_null($datefrom)&&!is_null($dateto))
            {
                $posts = Post::with('groups')->whereHas('groups.users', function($q) use($groupsid,$datefrom,$dateto){
                    $q->whereIn('group_user.group_id', $groupsid)->where('date','<=', $dateto.' 23:59:59');
                })->orWhere('public', true)->where('date','<=', $dateto.' 23:59:59')->get()->sortByDesc('date');   
            }
            elseif(!is_null($datefrom)&&is_null($dateto))
            {
                $posts = Post::with('groups')->whereHas('groups.users', function($q) use($groupsid,$datefrom,$dateto){
                    $q->whereIn('group_user.group_id', $groupsid)->where('date','>=', $datefrom.' 00:00:00');
                })->orWhere('public', true)->where('date','>=', $datefrom.' 00:00:00')->get()->sortByDesc('date');     
            }
            else
            {
                $posts = Post::with('groups')->whereHas('groups.users', function($q) use($groupsid){
                        $q->whereIn('group_user.group_id', $groupsid);
                    })->orWhere('public', true)->get()->sortByDesc('date');
            }
        }
        else
        {
            if(!is_null($datefrom)&&!is_null($dateto))
            {
                $posts = Post::with('groups')->whereHas('groups.users', function($q) use($id, $dateto, $datefrom){
                    $q->where('group_user.group_id', $id)->whereBetween('date', [$datefrom . ' 00:00:00', $dateto.' 23:59:59']);
                })->whereBetween('date', [$datefrom . ' 00:00:00', $dateto.' 23:59:59'])->get()->sortByDesc('date');
            }
            elseif(is_null($datefrom)&&!is_null($dateto))
            {
                $posts = Post::with('groups')->whereHas('groups.users', function($q) use($id, $dateto){
                    $q->where('group_user.group_id', $id)->where('date','<=', $dateto.' 23:59:59');
                })->orWhere('public', true)->where('date','<=', $dateto.' 23:59:59')->get()->sortByDesc('date');   
            }
            elseif(!is_null($datefrom)&&is_null($dateto))
            {
                $posts = Post::with('groups')->whereHas('groups.users', function($q) use($id,$datefrom){
                    $q->where('group_user.group_id', $id)->where('date','>=', $datefrom.' 00:00:00');
                })->orWhere('public', true)->where('date','>=', $datefrom.' 00:00:00')->get()->sortByDesc('date');     
            }
            else
            {
                $posts = Post::with('groups')->whereHas('groups.users', function($q) use($id){
                    $q->where('group_user.group_id', $id);
                })->get()->sortByDesc('date');   
            }
        }
        return view('partial.posts')->with('posts', $posts);
    }


}
