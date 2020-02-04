<?php

namespace App\Http\Middleware;

use Closure;
use App\Group;
use Illuminate\Support\Facades\Auth;

class MyGroup
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
        if(Group::where('id', $request->id)->exists())
        {
            $owner = Group::find($request->id)->owner;
            if(Auth::user()->role>2 || $owner == Auth::id())
                return $next($request);
        }
        else
        {
            return redirect()->back();
        }
    }
}
