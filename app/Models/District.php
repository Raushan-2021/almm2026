<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public static function getDistictBySubDistrict($sub_district_code)
	{
		return self::select('districts.code','districts.name')
                    ->join('sub_districts', 'sub_districts.district_code', 'districts.code')
                    ->where('sub_districts.code', $sub_district_code)
                    ->get();
    }

    public static function getDistictByState($state_code)
	{
		return self::select('code','name')->where('state_code', $state_code)->orderby('name')->get();
	}
}
