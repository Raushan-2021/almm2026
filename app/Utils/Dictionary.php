<?php

namespace App\Utils;

use App\Traits\General;

class Dictionary
{
    use General;
    public function __construct(){}

    public function transformArrayToDictionary($array)
    {
        $response = [];
        
        foreach($array as $element){
            $obj = array_values($element);
            $response[$obj[0]] = $obj[1];
        }
        return $response;
    }
}