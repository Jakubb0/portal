<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\File;
use App\Reply;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;



class MessageController extends Controller
{
    public function messages()
    {
        
        return view('message.all');
    }


    public function create(Request $request)
    {
        if($request->cookie('user')!=null)
        {
            $user = User::find($request->cookie('user'));
            return view('message.create')->with('user', $user);
        }
        else
            return view('message.create');


    }

    public function add($id)
    {
        Cookie::queue('user', $id, 10);
    }

    public function postadd(Request $request)
    {
        $message = Message::create([
            'title' => $request->title,
            'content' => $request->content,
            'to_id' => $request->cookie('user'),
            'from_id' => Auth::id(),
            'date' => date(now()),
            'status' => false,
        ]);

        $messagex = Message::find($message->id);

        if($request->file('files'))
        {
            foreach($request->file('files') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'\\files\\', $name);  
                

                $filex = new File;
                $filex->name = $name;
                $filex->path =  public_path().'\\files\\' . $name;
                $filex->filetest_id =  $message->id;
                $filex->filetest_type = get_class($messagex);
                
                $filex->save();
            }
        }

        Cookie::queue(Cookie::forget('user'));
        return redirect()->route('messages');
    }

    public function read($id)
    {
        $message=Message::find($id);
        if($message->status==false && $message->to_id==Auth::id())
        {
            $message->status = true;
            $message->save();
        }
    }

    public function reply($id)
    {
        $message=Message::find($id);
        $user=User::find($message->from_id);
        return view('message.reply', ['message'=>$message, 'user'=>$user]);
    }

    public function postreply($id, Request $request)
    {
        $reply = Reply::create([
            'title' => $request->title,
            'content' => $request->content,
            'date' => date(now()),
            'message_id' => $id,
            'status' => false,
        ]);

        $replyx = Reply::find($reply->id);

        if($request->file('files'))
        {
            foreach($request->file('files') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'\\files\\', $name);  
                

                $filex = new File;
                $filex->name = $name;
                $filex->path =  public_path().'\\files\\' . $name;
                $filex->filetest_id =  $replyx->id;
                $filex->filetest_type = get_class($replyx);
                
                $filex->save();
            }
        }

        return redirect()->route('messages');
    }
}
