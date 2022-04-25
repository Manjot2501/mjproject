<?php

namespace App\Http\Middleware;

use App\Models\webUser;
use Closure;
use Illuminate\Http\Request;

class userAuth
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
        if($request->session()->get('userID') && webUser::where('id',$request->session()->get('userID'))->exists()){
            return $next($request);
        }
        return redirect()->route('user-login');
    }
}
