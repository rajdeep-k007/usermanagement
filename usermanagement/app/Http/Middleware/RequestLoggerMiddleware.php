<?php

namespace App\Http\Middleware;

use App\Models\activitylog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RequestLoggerMiddleware
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
        // $log = [
        //     'URI' => $request->getUri(),
        //     'METHOD' => $request->getMethod(),
        //     'REQUEST_BODY' => $request->all(),
        //     'RESPONSE' => $next($request)->getContent()
        // ];

        // activitylog::info(json_encode($log));

        return $next($request);
    }

    public function terminate(Request $request, Response $response)
    {
        // $input = $request->all();
        // $logEntry = new activitylog();

        $logEntry = [
                'user' => Auth::user()->name,
                'user_agent' => Auth::user()->role=='1'?'Admin':'Superadmin',
                'user_ip' => \Request::ip(),
                'method' => $request->getMethod(),
                'route' => $request->getUri(),
            ];

        if(str_contains($request->getUri(),'/userslist')){
            $logEntry['description'] = "User list viewed !";
        }
        else if(str_contains($request->getUri(),'/permissionslist')){
            $logEntry['description'] = "Permission list viewed !";
        }
        else if(str_contains($request->getUri(),'/activitylist')){
            $logEntry['description'] = "Activity list viewed !";
        }
        else if(str_contains($request->getUri(),'/blockedItemslist')){
            $logEntry['description'] = "Blocked Items list viewed !";
        }
        else{
            $logEntry['description'] = "Private Activity!";
        }


        activitylog::create($logEntry);

        // dd($request);


        // $logEntry = [
        //         'URI' => $request->getUri(),
        //         'METHOD' => $request->getMethod(),
        //         'REQUEST_BODY' => $request->all(),
        //         'RESPONSE' => $response->getContent()
        //     ];
        // $new = activitylog::info(json_encode($logEntry));

        // dd($new);

        // $new->save();
    }

}
