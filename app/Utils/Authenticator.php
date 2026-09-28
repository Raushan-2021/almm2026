<?php

namespace App\Utils;

use App\Traits\General;
use App\Models\ApiToken;
use App\Models\Inspector;
use App\Models\Installer;

class Authenticator
{
    use General;
    private $sessionTime;
    public function __construct(){
        $this->sessionTime = date("Y-m-d H:i:s", strtotime("+12 hours"));
    }

    public function generateAuthToken($userId, $userType)
    {
        $head = md5($this->generateRandomString(10));
        $body = md5($this->generateRandomString(10));
        $tail = md5($this->generateRandomString(10));
        $expiry = $this->sessionTime;
        $token = $head.'.'.$body.'.'.$tail;
        ApiToken::create(['user_id' => $userId, 'user_type' => $userType, 'token' => $token, 'expiry' => $expiry]);
        return $token;
    }

    public function authenticateAuthToken($token)
    {
        $record = ApiToken::where([['token', $token],['expiry', '>=', date('Y-m-d H:i:s')]])->first();

        if(!$record)
            return ['status' => false, 'user' => []];

        ApiToken::where('token', $token)->update(['expiry' => $this->sessionTime]);
        $user = [];
        
        switch($record->user_type){
            case 'INSP':
                $user = Inspector::where('id', $record->user_id)->first()->toArray();        
            break;
            case 'INST':
                $user = Installer::where('id', $record->user_id)->first()->toArray();
            break;
        }
        $user['user_type'] = $record->user_type;
        return ['status' => true, 'user' => $user];
    }

    public function logoutSession($token)
    {
        if(ApiToken::where('token', $token)->delete())
            return TRUE;
        else
            return FALSE;
    }
}