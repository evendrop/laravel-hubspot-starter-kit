<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\TeamUser;

class UserTeam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(!empty(auth()->user())){

            // make sure a session id is set and that the session id belongs to the user

            if(!session()->has('alias') || !TeamUser::whereUserId(auth()->user()->id)->whereTeamId(session('alias'))->exists()){
                session()->put('alias', TeamUser::whereUserId(auth()->user()->id)->wherePrimary(1)->first()->id);
            }

        }

        return $next($request);
    }
}
