<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Closure, Route;

class SecurityHeaders
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
        
        if(in_array(request()->segment(2), ['preview-docs', 'download-docs'])){
            return $next($request);
        }
        else
        {
            if (Auth::check()) {
            $userAgent = $request->header('User-Agent');
            $ip = $request->ip();
            $fingerprint = hash('sha256', $userAgent . $ip);

         
            if (!Session::has('fingerprint')) {
                Session::put('fingerprint', $fingerprint);
            }

           
            if (Session::get('fingerprint') !== $fingerprint) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login')->withErrors([
                    'session' => '⚠️ Security alert: Possible session hijacking detected. Please log in again.'
                ]);
            }
        }
            $response = $next($request);
            $response->header('X-Frame-Options', 'SAMEORIGIN');
            $response->header('Access-Control-Allow-Origin','DENY');
            $response->header('Server', 'NA');
            $response->header('X-XSS-Protection', '1; mode=block');
            $response->header('X-Content-Type-Options', 'nosniff');
            $response->header('X-Powered-By','PHP');
            $response->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate');
            $response->header('Strict-Transport-Security', 'max-age=60000; includeSubDomains');
            
            return $response;
        }
        
    }

}