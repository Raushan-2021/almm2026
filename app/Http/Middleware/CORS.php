<?php

namespace App\Http\Middleware;

use Closure;

class CORS
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
        
        if(in_array(request()->segment(3), ['get-document','get-public-image'])){
            return $next($request);
        }
        // ALLOW OPTIONS METHOD
        // $headers = [
        //     'Access-Control-Allow-Origin' => 'DENY',
        //     'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS',
        //     'Access-Control-Allow-Headers'=> 'Content-Type, AuthorizationToken'
        // ];
        // if($request->getMethod() == "OPTIONS") {
        //     return Response::make('OK', 200, $headers);
        // }

        $response = $next($request)
        ->header('Access-Control-Allow-Origin', 'DENY')
        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, AuthorizationToken');
        // foreach($headers as $key => $value)
        //     $response->header($key, $value);
            
            
        return $response;
    }
}