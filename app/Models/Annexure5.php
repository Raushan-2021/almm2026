<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB,Auth;

class Annexure5 extends Model
{
    protected $table = 'annexure5';

    public static function getFinancialData($application_id,$month,$year)
    {
       //dd($application_id.'---'.$month.'---'.$year);
        $result = self::select('module_production_data')->where('application_id',$application_id)->where('user_id',Auth::user()->id)->where('month',$month)->where('financial_year',$year)->first();
        //dd($result);
        if($result){
        return $result['module_production_data'];
        }else{
            return '--';
        }
    }

    public static function getFinancialDataadmin($application_id,$user_id,$month,$year)
    {
        $result = self::select('module_production_data')->where('application_id',$application_id)->where('user_id',$user_id)->where('month',$month)->where('financial_year',$year)->first();
        if($result){
        return $result['module_production_data'];
        }else{
            return '--';
        }
    }
}