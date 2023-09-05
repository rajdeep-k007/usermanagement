<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if(Auth::check()){

            // admin role ==1
            // user role ==0
            dd($request->all());
            session()->put('user', $request->all());
            if(Auth::user()->role == '1'){
                // session()->get('user');
                return $next($request);
            }
            else{
                // session()->get('user');
                return redirect('/resendemail')->with('message','Access denied as you are not an ADMIN!');
            }
        }
        else {
            return redirect('/login')->with('message','Login to access the site info!');
        }

    }
}
