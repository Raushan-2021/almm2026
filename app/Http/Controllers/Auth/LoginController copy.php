<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use App\Models\SessionToken;
use App\Models\User;
use App\Models\RlmmUser;
use App\Models\RlmmNiwe;
use App\Models\RlmmMnre;
use Carbon\Carbon;
use App\Traits\General;
use Illuminate\Support\Facades\Artisan;
use Session;

class LoginController extends Controller
{
    use General;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';
    protected $usertype = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:mnre')->except('logout');
        $this->middleware('guest:users')->except('logout');
        $this->middleware('guest:nise')->except('logout');
    }



    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        if(!empty($_POST['rlmm_type']) && $_POST['rlmm_type']==1)
        {
            switch ($request->user_type) {
                case 'MNREWIND':
                    $this->redirectTo = '/mnre_wind_users';
                    $this->usertype='MNREWIND';
                    break;
                // case 'MANUFACTURER':
                //     $this->redirectTo = '/users';
                //     $this->usertype='RMFT';
                //     break;
                case 'NIWE':
                    $this->redirectTo = '/niwe';
                    $this->usertype = 'NIWE';
                    $guard = 'NIWE';  // Case-sensitive; matches what you defined in config/auth.php
                    break;
                case 'MFFT':
                    $this->redirectTo = '/mfft';
                    $this->usertype='MFFT';
                    break;

                default:
                    $this->redirectTo = '/login';
                    break;
            }
            // echo $request->user_type;die;
            $this->validator($request);

            //check if the user has too many login attempts.
           /* if ($this->hasTooManyLoginAttempts($request)){
                //Fire the lockout event.
                $this->fireLockoutEvent($request);
                //redirect the user back after lockout.
                return $this->sendLockoutResponse($request);
            }*/
            
            $request->session()->regenerateToken() ;
            $key = hex2bin("0123456789abcdef0123456789abcdef");
            $iv =  hex2bin("abcdef9876543210abcdef9876543210");
    
            $decryptedId = openssl_decrypt($request->email, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $decryptedId = trim($decryptedId);
            $decryptedPwd = openssl_decrypt($request->password, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $decryptedPwd = trim($decryptedPwd);
            $email=$decryptedId;
            $password=explode('-',$decryptedPwd);
            $sessionToken=Session::get('token');
            $request->merge([
                'email' => $decryptedId,
                'password' => $password[0],
            ]);

 $maxAttempts = 3;
                    $lockoutTime = 2; // in minutes
                    
                    // Get the user's email or username from the request
                    $userIdentifier = $this->getUserIdentifier($request);
                    
                    // Create a unique key for the rate limiter using the user's email or username
                    $key = $this->throttleKey($userIdentifier);
                    
                    // Check if the user has too many login attempts
                    if ($this->hasTooManyLoginAttempts($key, $maxAttempts)) {
                        $seconds = $this->limiter()->availableIn($key);
                        $minutes = ceil($seconds / 60);
                        $message = "Too many login attempts. Please try again in $minutes minutes.";
                    
                        return $this->sendFailedLoginResponse($request, $message);
                    }
            //dd($password);die;
            if($password[1]!=$sessionToken){
                return redirect()->back()->with("error","Invalid Request !");
            } 
            if( $request->user_type == 'MFFT')
            {
                 $user = RlmmUser::where('email', $decryptedId)->first();
            }
            if( $request->user_type == 'NIWE')
            {
                // echo "hello"; die();
                 $user = RlmmNiwe::where('email', $decryptedId)->first();
                //  print_r($user);die;
            }
            if( $request->user_type == 'MNREWIND')
            {
                 $user = RlmmMnre::where('email', $decryptedId)->first();
            }

            // if($user){
            //     $day = $user->updated_at;
            //     $date = Carbon::createFromFormat('Y-m-d H:i:s',$day);
            //     $now = Carbon::now();
            //     $diffInDays = $now->diffInDays($day);
            //     if($diffInDays >= 90){
            //         $user->is_password_change = 0;
            //         $user->save();
            //     }
            // }
           /* if (Auth::guard('MFFT')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
                echo "gjhgh"; die;
            }*/
    
            // dd($request);
         if (Auth::guard('MFFT')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
              $this->clearLoginAttempts($key);

        $user = Auth::guard('MFFT')->user(); // Get the authenticated user

        // 🔐 Delete all existing sessions for this user except the current one
        if (config('session.driver') === 'database') {
            DB::table('sessions')
                ->where('user_id', $user->id)
                ->where('id', '!=', Session::getId())
                ->delete();
        }

        // ✅ Optional: Clear caches
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        // ✅ Audit log
        $auditData = array(
            'action_type' => 'Login',
            'description' => 'User Login Successfully',
            'user_type' => $this->usertype
        );
        $this->auditTrail($auditData);

        // ✅ Generate and save session token
        $tokenVal = Str::random(40);
        $token = new SessionToken;
        $token->user_id = $user->id; // Use actual logged-in user ID
        $token->token = $tokenVal;
        $token->save();
        // Auth::guard('NIWE')->logout();
        // Auth::guard('MNREWIND')->logout();
        //     Session::put('loginToken', $tokenVal);

        // ✅ Redirect after login
        return redirect($this->redirectTo);
    }


         $maxAttempts = 3;
                    $lockoutTime = 2; // in minutes
                    
                    // Get the user's email or username from the request
                    $userIdentifier = $this->getUserIdentifier($request);
                    
                    // Create a unique key for the rate limiter using the user's email or username
                    $key = $this->throttleKey($userIdentifier);
                    
                    // Check if the user has too many login attempts
                    if ($this->hasTooManyLoginAttempts($key, $maxAttempts)) {
                        $seconds = $this->limiter()->availableIn($key);
                        $minutes = ceil($seconds / 60);
                        $message = "Too many login attempts. Please try again in $minutes minutes.";
                    
                        return $this->sendFailedLoginResponse($request, $message);
                    }


            // echo $this->redirectTo;die;
    if (Auth::guard('NIWE')->attempt($request->only('email', 'password'), $request->filled('remember'))) {

    // Get the currently authenticated user
    $user = Auth::guard('NIWE')->user();

    // ✅ Clear all previous sessions of this user (requires database session driver)
    if (config('session.driver') === 'database') {
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', Session::getId()) // Keep the current session
            ->delete();
    }

    // ✅ (Optional) Clear caches — not generally recommended per login in production
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
 
    // ✅ Regenerate session ID to prevent session fixation
    $request->session()->regenerate();

    // ✅ Log audit trail
    $auditData = [
        'action_type' => 'Login',
        'description' => 'User Login Successfully',
        'user_type' => $this->usertype
    ];
    $this->auditTrail($auditData);

    // ✅ Create a new session token for the user
    $tokenVal = Str::random(40);
    $token = new SessionToken;
    $token->user_id = $user->id; // Replace $decryptedId with actual user ID
    $token->token = $tokenVal;
    $token->save();
// Auth::guard('MFFT')->logout();
// Auth::guard('MNREWIND')->logout();
    // ✅ Store token in session
    // Session::put('loginToken', $tokenVal);

    // ✅ Redirect user after successful login
    return redirect($this->redirectTo);
}



             if (Auth::guard('MNREWIND')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
               // echo "gjhgh";die;
            //    Auth::guard('MFFT')->logout();
            //    Auth::guard('NIWE')->logout();
                $auditData = array('action_type'=>'Login','description'=>'User Login Succesfuly', 'user_type'=>$this->usertype);
                
                $this->auditTrail($auditData);
                $tokenVal=Str::random(40);
                $token = new SessionToken;
                $token->user_id = $decryptedId;
                $token->token = $tokenVal;
                // $token->updated_at = $this->getCurrentDate();
                $token->save();
                Session::put('loginToken', $tokenVal);
                 //Authentication passed...
                 //echo "manoj";
                //  echo $this->redirectTo;die;
                return redirect($this->redirectTo);
            }
    
            //keep track of login attempts from the user.
          //  echo "hello";die;
       //   print_r($request->email);die;
               $this->incrementLoginAttempts($key, $maxAttempts);
            //Authentication failed...
            //return redirect($this->redirectTo)->with('error','Login failed. Please enter valid details');
            $auditData = array('action_type'=>'Login','description'=>'Login failed. Please enter valid details', 'user_type'=>$this->usertype);
            $this->auditTrail($auditData);
            return redirect()->back()->with("error","Login failed. Please enter valid details");
            return $this->sendFailedLoginResponse($request);
        }
            // print_r($_POST);die; 
       
        else{
        // print_r($_POST);die;
        switch ($request->user_type) {
            case 'MNRE':
                $this->redirectTo = '/mnre';
                $this->usertype='MNRE';
                break;
            case 'MANUFACTURER':
                $this->redirectTo = '/users';
                $this->usertype='MFT';
                break;
            case 'NISE':
                $this->redirectTo = '/nise';
                $this->usertype='NISE';
                break;
            default:
                $this->redirectTo = '/login';
                break;
        }
        
        $this->validator($request);

        //check if the user has too many login attempts.
       /* if ($this->hasTooManyLoginAttempts($request)){
            //Fire the lockout event.
            $this->fireLockoutEvent($request);
            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }*/
        
        $request->session()->regenerateToken() ;
        $key = hex2bin("0123456789abcdef0123456789abcdef");
        $iv =  hex2bin("abcdef9876543210abcdef9876543210");

        $decryptedId = openssl_decrypt($request->email, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decryptedId = trim($decryptedId);
        $decryptedPwd = openssl_decrypt($request->password, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decryptedPwd = trim($decryptedPwd);
        $email=$decryptedId;
        $password=explode('-',$decryptedPwd);
        $sessionToken=Session::get('token');
        $request->merge([
            'email' => $decryptedId,
            'password' => $password[0],
        ]);


 $maxAttempts = 3;
                    $lockoutTime = 2; // in minutes
                    
                    // Get the user's email or username from the request
                    $userIdentifier = $this->getUserIdentifier($request);
                    
                    // Create a unique key for the rate limiter using the user's email or username
                    $key = $this->throttleKey($userIdentifier);
                    
                    // Check if the user has too many login attempts
                    if ($this->hasTooManyLoginAttempts($key, $maxAttempts)) {
                        $seconds = $this->limiter()->availableIn($key);
                        $minutes = ceil($seconds / 60);
                        $message = "Too many login attempts. Please try again in $minutes minutes.";
                    
                        return $this->sendFailedLoginResponse($request, $message);
                    }


        //dd($password);die;
        if($password[1]!=$sessionToken){
            return redirect()->back()->with("error","Invalid Request !");
        } 
        
        $user = User::where('email', $decryptedId)->first();
        if($user){
            $day = $user->updated_at;
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$day);
            $now = Carbon::now();
            $diffInDays = $now->diffInDays($day);
            if($diffInDays >= 90){
                $user->is_password_change = 0;
                $user->save();
            }
        }

        //dd($request);
        if($this->guard($request)->attempt($request->only('email','password'), $request->filled('remember'))){
            $auditData = array('action_type'=>'Login','description'=>'User Login Succesfuly', 'user_type'=>$this->usertype);
            
            $this->auditTrail($auditData);
            $tokenVal=Str::random(40);
            $token = new SessionToken;
            $token->user_id = $decryptedId;
            $token->token = $tokenVal;
            // $token->updated_at = $this->getCurrentDate();
            $token->save();
            Session::put('loginToken', $tokenVal);
             //Authentication passed...
            return redirect($this->redirectTo);
        }

        //keep track of login attempts from the user.
       // $this->incrementLoginAttempts($request);
        //Authentication failed...
        //return redirect($this->redirectTo)->with('error','Login failed. Please enter valid details');
        //echo "sdfsf";die;
          $this->incrementLoginAttempts($key, $maxAttempts);
        $auditData = array('action_type'=>'Login','description'=>'Login failed. Please enter valid details', 'user_type'=>$this->usertype);
        $this->auditTrail($auditData);
        return redirect()->back()->with("error","Login failed. Please enter valid details");
        return $this->sendFailedLoginResponse($request);
    }
    }
    /**
     * Validate the form data.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    private function validator(Request $request)
    {
        //validation rules.//email|exists:mnre_users|
        switch ($request->user_type) {
            case 'MNRE':
                $rules = [
                    'email'    => 'required|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;
           
            case 'MANUFACTURER':
                $rules = [
                    'email'    => 'required|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;

            case 'NISE':
                $rules = [
                    'email'    => 'required|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                    'user_type' => 'required',
                ];
                break;
            
            default:
                $rules = [
                    'email'    => 'required|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                    'user_type' => 'required',
                ];
                break;
        }

        //if(env('DEV_ENVIRONMENT'))
            $rules['captcha'] = 'required|captcha';
               $rules['password'] = 'required';
               $rules['email'] = 'required';

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
             'password.exists' => 'These credentials do not match our records.',
            'captcha.captcha' => 'Invalid captcha'
        ];

        //validate the request.
        $request->validate($rules, $messages);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard($request)
    {
        switch ($request->user_type) {
            case 'MNRE':
                return Auth::guard('mnre');
                break;

            case 'NISE':
                return Auth::guard('nise');
                break;
        
            case 'MANUFACTURER':
                return Auth::guard('users');
                break;
            default:
                return Auth::guard();
                break;
        }
    }

    /**
     * Logout the admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function logout(Request $request)
    // {
    //     if(Auth::guard('mnre')->check()){
    //         $auditData = array('action_type'=>'Logout','description'=>'MNRE user logout successfuly', 'user_type'=>'MNRE','userid'=>$request->usid);
    //         $this->auditTrail($auditData);
    //         Auth::guard('mnre')->logout();
    //     }elseif(Auth::guard('users')->check()){
    //         $auditData = array('action_type'=>'Logout','description'=>'Manufacturer logout successfuly', 'user_type'=>'MFT','userid'=>$request->usid);
    //         $this->auditTrail($auditData);
    //         Session::forget('application_id');
    //         Auth::guard('users')->logout();
    //     }elseif(Auth::guard('nise')->check()){
    //         $auditData = array('action_type'=>'Logout','description'=>'NISE user logout successfuly', 'user_type'=>'NISE','userid'=>$request->usid);
    //         $this->auditTrail($auditData);
    //         Auth::guard('nise')->logout();
    //     }else{
            
    //         $auditData = array('action_type'=>'Logout','description'=>'User logout successfuly', 'user_type'=>'Other','userid'=>$request->usid);
    //         $this->auditTrail($auditData);
    //         Auth::guard()->logout();
    //     }
    //     $request->session()->regenerateToken() ;
        
    //     return redirect()->route('login')->with('status','User has been logged out!');
    // }

    public function logout(Request $request)
{
    if(Auth::guard('mnre')->check()){
        $auditData = [
            'action_type' => 'Logout',
            'description' => 'MNRE user logout successfuly',
            'user_type' => 'MNRE',
            'userid' => $request->usid
        ];
        $this->auditTrail($auditData);
        Auth::guard('mnre')->logout();

    } elseif(Auth::guard('users')->check()){
        $auditData = [
            'action_type' => 'Logout',
            'description' => 'Manufacturer logout successfuly',
            'user_type' => 'MFT',
            'userid' => $request->usid
        ];
        $this->auditTrail($auditData);
        Session::forget('application_id');
        Auth::guard('users')->logout();

    } elseif(Auth::guard('nise')->check()){
        $auditData = [
            'action_type' => 'Logout',
            'description' => 'NISE user logout successfuly',
            'user_type' => 'NISE',
            'userid' => $request->usid
        ];
        $this->auditTrail($auditData);
        Auth::guard('nise')->logout();

    } elseif(Auth::guard('NIWE')->check()){
        $auditData = [
            'action_type' => 'Logout',
            'description' => 'NIWE user logout successfuly',
            'user_type' => 'NIWE',
            'userid' => $request->usid
        ];
        $this->auditTrail($auditData);
        Auth::guard('NIWE')->logout();
        return redirect()->route('rmllogin')->with('status', 'NIWE has been logged out!');

    } elseif(Auth::guard('MFFT')->check()){
        $auditData = [
            'action_type' => 'Logout',
            'description' => 'MFFT user logout successfuly',
            'user_type' => 'MFFT',
            'userid' => $request->usid
        ];
        $this->auditTrail($auditData);
        Auth::guard('MFFT')->logout();
        return redirect()->route('rmllogin')->with('status', 'User has been logged out!');

    } elseif(Auth::guard('MNREWIND')->check()){
        $auditData = [
            'action_type' => 'Logout',
            'description' => 'MNREWIND user logout successfuly',
            'user_type' => 'MNREWIND',
            'userid' => $request->usid
        ];
        $this->auditTrail($auditData);
        Auth::guard('MNREWIND')->logout();
        return redirect()->route('rmllogin')->with('status', 'MNRE has been logged out!');

    } else {
        $auditData = [
            'action_type' => 'Logout',
            'description' => 'User logout successfuly',
            'user_type' => 'Other',
            'userid' => $request->usid
        ];
        $this->auditTrail($auditData);
        Auth::guard()->logout();
    }

    $request->session()->invalidate();  // Invalidate the session
    $request->session()->regenerateToken();

    return redirect()->route('login')->with('status', 'User has been logged out!');
}






  
protected function sendFailedLoginResponse(Request $request, $message = null)
{
    // Customize the response to include the message
    return back()->withErrors([
        'email' => $message ?? 'These credentials do not match our records.',
    ])->withInput($request->only('email', 'remember'));
}

protected function hasTooManyLoginAttempts($key, $maxAttempts)
{
    // Check if there are too many login attempts
    return $this->limiter()->tooManyAttempts($key, $maxAttempts);
}

protected function incrementLoginAttempts($key, $maxAttempts)
{
  //  echo $key;die;
    // Increment login attempts for the key
    $this->limiter()->hit($key, $this->lockoutDuration());
}

protected function clearLoginAttempts($key)
{
    // Clear login attempts for the key
    $this->limiter()->clear($key);
}

protected function throttleKey($userIdentifier)
{
    // Provide a unique key for throttling based on the user's identifier
    return $userIdentifier;
}

protected function getUserIdentifier(Request $request)
{
    // Extract the user's email or username from the request
    return $request->input('email'); // or 'username', depending on your authentication setup
}

protected function limiter()
{
    // Use Laravel's RateLimiter
    return app('Illuminate\Cache\RateLimiter');
}

protected function lockoutDuration()
{
    // Define the lockout duration (2 minutes)
    return 2 * 60; // 2 minutes in seconds
}




}