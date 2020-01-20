<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\File;

class PostController extends Controller
{
    public function posts()
    {
        if(Auth::check())
        {    
            $groups = Auth::user()->groups;
            $groupsid = array();
            
            foreach ($groups as $group) 
            {
                array_push($groupsid, $group->id);
            }
        
            $posts = Post::with('groups')->whereHas('groups.users', function($q) use($groupsid){
                $q->whereIn('group_user.group_id', $groupsid);
            })->orWhere('public', true)->get()->sortByDesc('date');
        }
        else
            $posts = Post::where('public', true)->get()->sortByDesc('date');
        /*
    	$p = array(); 
        if(Auth::check())
        {
        	$user  = Auth::user();

        	for($i = 0; $i<count($user->groups); $i++)
        	{
        		for($j = 0; $j<count($user->groups[$i]->posts); $j++)
        		{
        			$p[]=$user->groups[$i]->posts[$j];
        		}
        	}
        }
        
        $x=Post::where('public', true)->get();
        
        if(!empty($x))
        {
            foreach ($x as $public) 
                array_push($p, $public);
        } 


    	$p = collect($p)->sortBy('date')->reverse();
        */
        $view = Auth::check()?'mainpage':'guest'; 
    	
    	return view($view)->with('posts', $posts);
    }

    public function add(Request $request)
    {

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'date' => date(now()),
            'public'=>0,
        ]);

        $postx = Post::find($post->id);
        if($request->public=="true")
        {
            $postx->public = true;
            $postx->save();
        }
        else
        {
            foreach($request->recievers as $target)
            {
                $postx->groups()->attach($target);
            }
        }

        



        if($request->file('files'))
        {
            foreach($request->file('files') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'\\files\\', $name);  
                
                $filex = new File;
                $filex->name = $name;
                $filex->path =  public_path().'\\files\\' . $name;
                $filex->filetest_id =  $post->id;
                $filex->filetest_type = get_class($postx);

                $filex->save();
            }
        }

        return redirect()->route('main');
    }

}
