<?php

namespace App\Utils;

use Log, File, Config;

class Responder
{
    private $messages;

    public function __construct(){}

    public function makeResult($status, $code, $data)
    {
        return response()->json([
                            'status' => $status, 
                            'code' => $code, 
                            'message' => Config::get('constants.apiMessage.'.$code), 
                            'data' => !empty($data) ? $data : new \stdClass()
                        ]);
    }
}