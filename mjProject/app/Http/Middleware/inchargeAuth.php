<?php

namespace App\Http\Middleware;

use App\Models\incharge;
use Closure;
use Illuminate\Http\Request;

class inchargeAuth
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
        if($request->session()->get('inchargeID') && incharge::where('id',$request->session()->get('inchargeID'))->exists()){
            return $next($request);
        }
        return redirect()->route('incharge-login');
    }
}
