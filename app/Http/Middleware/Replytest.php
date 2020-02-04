<?php

namespace App\Http\Middleware;

use Closure;
use App\Reply;
use App\Message;
use Illuminate\Support\Facades\Auth;


class Replytest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->type==1)
        {
            if(Message::where('id', $request->id)->exists())
            {
                if(Message::find($request->id)->to_id==Auth::id())
                    return $next($request);
            }
            else
                return redirect()->back();
        }
        elseif($request->type==2)
        {
            if(Reply::where('id', $request->id)->exists())
            {
                if(Reply::find($request->id)->to_id==Auth::id())
                    return $next($request);
            }
            else
                return redirect()->back();
        }
        else
            return redirect()->back();
    }
}
