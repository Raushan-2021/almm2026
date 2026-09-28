<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class AwAnnexure3 extends Model
{
    //
    protected $table="awannexure3";

    protected $fillable = [
    'application_id',
    'user_id',
    'wind_turbine_part',
    'wind_turbine_model',
    'mfg_facility_no',
    'nacelle_address', // or 'location_details' depending on DB column
];

    static function getAnnexureThreeData($application_id,$user_id){
        //return self::
        return self::select('annexure3.*','master_module.module_type')
                    ->join('master_module', 'master_module.id', 'annexure3.module_type')
                    ->where('annexure3.application_id', $application_id)
                    ->where('annexure3.user_id', $user_id)
                    ->get();
    }
    public static function getAnnexureData($application_id, $user_id, $sub_annexure)
    {
        return self::where('application_id', $application_id)
            ->where('user_id', $user_id)
            ->where('sub_annexure', $sub_annexure)
            ->get();
    }


    // static function getAnnexureData($application_id,$user_id,$sub_annexure){
        // dd($application_id);
        // dd($user_id);
        // dd($sub_annexure);
        //return self::
        // $i=0;$annexureData=array();
        // $moduledata = Module::getModuleData($application_id,$user_id);
        // foreach($moduledata as $data){
        //     $annexureData[] = $data;
        //     $annexureData[$i]['annexure']= self::where('module_type',$data->id)->where('user_id',$data->user_id)->where('application_id',$data->application_id)->where('sub_annexure',$sub_annexure)->get();
        //     $annexureData[$i]['applicable_model_covered'] = json_decode($data->applicable_model_covered);
        //     $annexureData[$i]['applicable_model'] = json_decode($data->applicable_model);
        //     $i++;
        // }
        // dd( $annexureData);
        // return $annexureData;
        //dd($annexureData);
    // }
    // dd($annexureData);
    static function getAnnexureDataByID($application_id,$user_id,$module_id,$subAnnexureType){
        //return self::
        $i=0;$annexureData=array();
        $moduledata = Module::getSingleModuleDataById($application_id,$module_id);
        
        if($moduledata!=null){
            $moduledata->annexure= self::select('*')->where('module_type',$moduledata->id)->where('sub_annexure',$subAnnexureType)
                ->where('application_id',$application_id)->where('user_id',$user_id)->get()->toArray();
            $moduledata->applicable_model_covered = json_decode($moduledata->applicable_model_covered);
            $moduledata->applicable_model = json_decode($moduledata->applicable_model);
            $moduledata->subAnnexureType = $subAnnexureType;
            
        }
        return $moduledata;
        
    }

    static function getAllAnnexureData($application_id,$user_id){
        //return self::
        return self::select('annexure3.*')
                    ->where('annexure3.application_id', $application_id)
                    ->where('annexure3.user_id', $user_id)
                    ->get();
    }
    static function getSubModuleDataById($application_id,$user_id,$id){
        //return self::
        return self::select('annexure3.*')
        ->where('annexure3.id', $id)
        ->where('annexure3.application_id', $application_id)
        ->where('annexure3.user_id', $user_id)
                    ->first();
    }


}