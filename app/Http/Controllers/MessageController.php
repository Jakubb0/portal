<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\File;
use App\Reply;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;



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
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'to_id' => 'required',
            'files.*' => 'mimes:rar,zip,7z,doc,docx,ppt,pptx,odt,txt,jpeg,bmp,png,gif,svg,pdf',
        ]);   

        $message = Message::create([
            'title' => htmlspecialchars($request->title),
            'content' => htmlspecialchars($request->content),
            'to_id' => $request->cookie('user'),
            'from_id' => Auth::id(),
            'date' => date(now()),
            'status' => false,
        ]);

        $mailto = User::find($request->cookie('user'));
        if($mailto->notify == true)
        {
            Mail::to($mailto->email)->send(new NotifyMail(Auth::user()));
        }
        
        $messagex = Message::find($message->id);

        if($request->file('files'))
        {
            foreach($request->file('files') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'\\files\\', $name);  
-                

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

    public function read($type, $id)
    {
        if($type == 1)
        {
            $message=Message::find($id);
            if($message->status==false && $message->to_id == Auth::id())
            {
                $message->status = true;
                $message->save();  
            }
        }
        else
        {
            $reply=Reply::where('id',$id)->first();
            if($reply->status==false && $reply->to_id == Auth::id())
            {
                $reply->status = true;
                $reply->save();  
            }
        }
    }

    public function reply($type, $id)
    {
        if($type==1)
        {
            $message=Message::find($id);
            $user=User::find($message->from_id);
        }
        else
        {
            $message=Reply::find($id);
            $user=User::find(Reply::find($id)->from_id);
        }
        return view('message.reply', ['message'=>$message, 'user'=>$user, 'type'=>$type]);
    }

    public function postreply($type, $id, Request $request)
    {
        if($type==1)
        {
            $to = Message::find($id)->from_id;
            $fk = $id;
        }
        else
        {
            $to = Reply::find($id)->from_id;
            $fk = Reply::find($id)->messages->id;
        }
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'files.*' => 'mimes:rar,zip,7z,doc,docx,ppt,pptx,odt,txt,jpeg,bmp,png,gif,svg,pdf',
        ]);   

        $reply = Reply::create([
            'title' => htmlspecialchars($request->title),
            'content' => htmlspecialchars($request->content),
            'date' => date(now()),
            'message_id' => $fk,
            'status' => false,
            'from_id' => Auth::id(),
            'to_id' => $to,
        ]);

        $mailto = User::find($to);
        if($mailto->notify == true)
        {
            Mail::to($mailto->email)->send(new NotifyMail(Auth::id()));
        }
        
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

    public function delete($id)
    {
        if(Message::where('id', $id)->exists() && Message::where('to_id', Auth::id()))
        {
            $message = Message::find($id);
            $message->files()->delete();
            $message->delete();
        }
        return redirect()->route('messages');

    }
}
