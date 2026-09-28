<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public static function getStateByDistrict($district_code)
	{
		return self::select('states.code','states.name')
                    ->join('districts', 'districts.state_code', 'states.code')
                    ->where('districts.code', $district_code)
                    ->get();
    }
}
