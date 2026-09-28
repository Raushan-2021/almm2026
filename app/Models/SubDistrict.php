<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    public static function getSubDistictByVillage($village_code)
	{
        return self::select('sub_districts.code','sub_districts.name')
                    ->join('villages', 'villages.sub_district_code', 'sub_districts.code')
                    ->where('villages.code', $village_code)
                    ->get();
    }

    public static function getSubDistictByDistrict($district_code)
	{
		return self::select('code','name')->where('district_code', $district_code)->orderby('name')->get();
	}
}