<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use App\Utils\Responder;
use App\Utils\Authenticator;
use Auth,Session;
use App\Models\SessionToken;

class ValidateSessionToken
{
    public function handle($request, Closure $next)
    {
        // $token = SessionToken::where('user_id', Auth::user()->email)->orderBy('updated_at', 'DESC')->first()->token;
        // if (Session::get('loginToken') != $token) {
        //     return redirect('/multiple-user-access');
        // }
        return $next($request);
    }
}