<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Author
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
        if ($request->user()===null){
            return response("in Sufficient permissions",401);
        }
        $actions=$request->route()->getAction();
        $roles4=isset($actions['king'])?$actions['king']:null;

        if ($request->user()->hasAnyRole8($roles4)||!$roles4){
            return $next($request);
        }
        return response("NO way you must go out NOW!!",401);
    }
}
