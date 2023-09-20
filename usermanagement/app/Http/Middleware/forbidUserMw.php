<?php

namespace App\Http\Middleware;

use App\Models\blockedItem;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class forbidUserMw
{

    protected $auth;
    public $restrictedEmail = [];
     public $restrictedLocation = [];
     public $restrictedDomain = [];
     public $restrictedIp = [];

    public function __construct(Guard $auth){
        $this->auth = $auth;

        // $this->restrictedEmail = blockedItem::where('type', 'email')->get()->toArray();
        $this->restrictedEmail = blockedItem::where('type', 'email')->pluck('value')->toArray();
        $this->restrictedLocation = blockedItem::where('type', 'location')->pluck('value')->toArray();
        $this->restrictedDomain = blockedItem::where('type', 'domain')->pluck('value')->toArray();
        // $this->restrictedIp = blockedItem::where('type', 'ip')->pluck('value')->toArray();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


    public function handle(Request $request, Closure $next)
    {
        $userEmail = $request->input('email');

        // To check blocked ip
        if(in_array($request->ip(),$this->restrictedIp)){
            return response()->view('block');
        }


        // To check blocked email
        if(in_array($userEmail,$this->restrictedIp)){
            return response()->view('block');
        }


        // To check blocked domain
        foreach ($this->restrictedDomain as $value) {
            // Check if the user's email contains the "@test.com" domain
            if(str_contains($userEmail, $value)) {
                return response()->view('block');
            }
        }


        // To check blocked location

        $user = Auth::user();
        if($user->city!='' || $user->city!=null || $user->city!='null'){
            if(in_array($user->city,$this->restrictedLocation)){

                return response()->view('block');
            }
        }

        return $next($request);

    }
}
