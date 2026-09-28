<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\Responder;
use App\Utils\Authenticator;
use App\Models\Inspector;
use App\Models\Installer;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Traits\General;
use Hash;

class AuthController extends Controller
{
    use General;
    private $responder, $forgotPassword;
    public function __construct(){
        $this->responder = new Responder();
        $this->authenticator = new Authenticator();
        $this->forgotPassword = new ForgotPasswordController();
    }
    public function login(Request $request)
    {
        $userType = $request->is('*/installer/*') ? true : false;
        try{
            $attempter; $attempterType;
            if($userType){
                $attempter = Installer::where('email', $request->email)->first();
                if(!$attempter) 
                    return $this->responder->makeResult(false, 1002, []);

                $attempterType = 'INST';
                $imageUrl = !empty($attempter->picture) ? url('public/images/installers/'.$attempter->installer_id.'/picture/'.$attempter->picture) : NULL;
            }
            else {
                $attempter = Inspector::where('email', $request->email)->first();
                if(!$attempter) 
                    return $this->responder->makeResult(false, 1002, []);

                $attempterType = 'INSP';
                $imageUrl = !empty($attempter->picture) ? url('public/images/inspectors/'.$attempter->inspector_id.'/picture/'.$attempter->picture) : NULL;
            }
            
            if(!Hash::check($request->password, $attempter->password))
                    return $this->responder->makeResult(false, 1003, []);
            
            $token = $this->authenticator->generateAuthToken($attempter->id, $attempterType);
            $response = [
                'auth_token' => $token,
                'user' => [
                    'id' => $attempter->id,
                    'type' => $attempterType,
                    'name' => $attempter->name,
                    'email' => $attempter->email,
                    'phone' => $attempter->phone,
                    'image' => $imageUrl
                ]
            ];
            return $this->responder->makeResult(true, 1000, $response);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }
    }
    public function forgotPassword(Request $request)
    {
        try{
            $existingUser = Installer::where('email', $request->email)->first();
            if($existingUser){
                $request['user_type'] = 'INSTALLER';
            }
            else {
                $existingUser = Inspector::where('email', $request->email)->first();
                if($existingUser) 
                    $request['user_type'] = 'INSPECTOR';
            }
            
            if(!$existingUser) return $this->responder->makeResult(true, 1002, []);

            $this->forgotPassword->sendResetLinkEmail($request);
            return $this->responder->makeResult(true, 1005, []);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }
    }
    public function logout(Request $request)
    {
        try{
            if($this->authenticator->logoutSession($request->header('AuthorizationToken')))
                return $this->responder->makeResult(true, 1025, []);
            else
                return $this->responder->makeResult(true, 1026, []);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }
    }

}
