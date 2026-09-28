<?php



namespace App\Http\Middleware;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Auth as FacadeAuth;
use Illuminate\Support\Facades\Auth;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];
 protected function tokensMatch($request)
{
   
  $token = $request->input('_token');
    if($token)
    {
    if (!hash_equals(session()->token(), $token)) {
        // Token mismatch, throw an exception
       return redirect('/login')->withErrors([
                    'session' => '⚠️ Invalid or expired session token. Please log in again.'
                ]);
    }
}
    return true;
}
    
    protected function addCookieToResponse($request, $response)
    {
        $response->headers->setCookie(
            new Cookie(
                'XSRF-TOKEN',
                $request->session()->token(),
                time() + 60 * 120,
                'almm',
                null,
                true, // Set this to true for secure.
                true // Set this to true for httponly.
            )
        );
        return $response;
    }
}

