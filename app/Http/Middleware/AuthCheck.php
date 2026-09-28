<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use App\Utils\Responder;
use App\Utils\Authenticator;

class AuthCheck
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

        $authenticator = new Authenticator();
        $responder = new Responder();
        $headers = getallheaders();
        
        $token = $headers['AuthorizationToken'];
        
        $result = $authenticator->authenticateAuthToken($token);
        if(!$result['status']){
            return $responder->makeResult(false, 4001, []);
        }
        $user = $result['user'];
        $request->request->add(['user' => $user]);
        return $next($request);
    }
}