<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Module;
use DB;

class Annexure2 extends Model
{
    //
    protected $table="annexure2";
    static function getAnnexureTwoData($application_id,$user_id){
        //return self::
        return self::select('annexure2.*','master_module.module_type')
                    ->join('master_module', 'master_module.id', 'annexure2.module_type')
                    ->where('annexure2.application_id', $application_id)
                    ->where('annexure2.user_id', $user_id)
                    ->get();
    }
    static function getAnnexureData($application_id,$user_id){
        $i=0;$annexureData=array();
        $moduledata = Module::getModuleData($application_id,$user_id);
        // dd($moduledata);
        foreach($moduledata as $data){
            //$data->id ==> Primary key of Module master and module type in Annexure 2
            
            $annexureData[] = $data;
            $annexureData[$i]['annexure']= Annexure2::where('module_type',$data->id)->where('user_id',$data->user_id)->where('application_id',$data->application_id)->get();
            
            $annexureData[$i]['applicable_model_covered'] = json_decode($data->applicable_model_covered);
            $annexureData[$i]['applicable_model'] = json_decode($data->applicable_model);
            $i++;
        }
        // dd($annexureData);
        return $annexureData;
        
    }
    static function getAnnexureDataByID($application_id,$user_id,$module_id){
        //return self::
        $i=0;$annexureData=array();
        $moduledata = Module::getSingleModuleDataById($application_id,$module_id);
        
        if($moduledata!=null){
            $moduledata->annexure= self::select('*')->where('module_type',$moduledata->id)
                ->where('application_id',$application_id)->where('user_id',$user_id)->get()->toArray();
            $moduledata->applicable_model_covered = json_decode($moduledata->applicable_model_covered);
            $moduledata->applicable_model = json_decode($moduledata->applicable_model);
            
        }
        return $moduledata;
        
        
    }
    static function getCountryData($data){
        $data = json_decode($data);
        $machine = Country::select('name')->whereIn('countrycd',$data)->get()->toArray();
        $array=array();
        foreach($machine as $mh){
            $array[] = $mh['name'];
        }
        return json_encode($array);
    }
}