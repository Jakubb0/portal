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
        $view = Auth::check()?'mainpage':'guest'; 
    	
    	return view($view)->with('posts', $p);
    }

    public function add(Request $request)
    {

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'date' => date(now()),
        ]);


        $postx = Post::find($post->id);
 
        if($request->public==true)
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
                

                $filex = File::create([
                    'name' => $name,
                    'path' => public_path().'\\files\\' . $name,
                ]);

                $postx->files()->attach($filex->id);
            }
        }

        return redirect()->route('main');
    }
}
