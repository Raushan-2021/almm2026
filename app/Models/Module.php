<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Module extends Model
{
    //
    protected $table="master_module";

    public static function getModuleDataById($application_id){
        $p_id = static::getPreviousID($application_id);
        //  dd($application_id);
        return self::select('master_module.*','modules_type_list.module_name','application_details.country')
        ->join('modules_type_list','modules_type_list.id','master_module.module_type')
        ->join('application_details','application_details.id','master_module.application_id')
        ->where('master_module.user_id',Auth::user()->id)
        ->where('master_module.application_id',$application_id)
        //->orwhere('master_module.application_id',$p_id)
        ->orderBy('modules_type_list.module_name')
        ->get();
    }
/*
    public static function getModuleDataById1($application_id){
        $p_id = static::getPreviousID($application_id);
        //  dd($application_id);
        return self::select('master_module.*','modules_type_list.module_name','application_details.country')
        ->join('modules_type_list','modules_type_list.id','master_module.module_type')
        ->join('application_details','application_details.id','master_module.application_id')
        ->where('master_module.user_id',Auth::user()->id)
        ->where('master_module.application_id',$application_id)
        //->orwhere('master_module.application_id',$p_id)
        ->orderBy('modules_type_list.module_name')
        ->get();
    }*/

    public static function getModuleData($application_id,$user_id){
        $p_id = static::getPreviousID($application_id);
        return self::select('master_module.*','modules_type_list.module_name','application_details.country')
        ->join('modules_type_list','modules_type_list.id','master_module.module_type')
        ->join('application_details','application_details.id','master_module.application_id')
        //->where('master_module.user_id',$user_id)
        ->where('master_module.application_id',$application_id)
        ->orwhere('master_module.application_id',$p_id)
        // ->orderBy('modules_type_list.module_name')
        ->orderby('master_module.id','asc')->get();
    }

    public static function getSingleModuleDataById($application_id,$module_id){
        return self::select('master_module.*','modules_type_list.module_name')
        ->join('modules_type_list','modules_type_list.id','master_module.module_type')
        ->where('master_module.user_id',Auth::user()->id)
        ->where('master_module.application_id',$application_id)
        ->where('master_module.id',$module_id)
        ->orderBy('modules_type_list.module_name')
        ->first();
    }

    public static function getExistingModuleDataById($application_id){
        $previous_id = ApplicationDetail::select('previous_id')->where('id',$application_id)->first();
        return self::select('master_module.*','modules_type_list.module_name')
        ->join('modules_type_list','modules_type_list.id','master_module.module_type')
        ->where('master_module.user_id',Auth::user()->id)
        ->where('master_module.application_id',$application_id)
        ->orwhere('master_module.application_id',$previous_id->previous_id)
        //->orderBy('modules_type_list.module_name')
        ->orderBy('master_module.created_at','ASC')
        ->get();
        //$previous_id->previous_id
    }
    
    public static function getPreviousID($application_id){
        // dd($application_id);
        $previous_id = ApplicationDetail::select('previous_id')->where('id',$application_id)->first();
        return $previous_id->previous_id;
    }
    
    public static function getSubModuleCount($application_id){
        $submodules = Module::select('applicable_model_covered')->where('application_id',$application_id)->get();
        $count=0;
        foreach($submodules as $smodule){
            $moduleData=json_decode($smodule->applicable_model_covered);
            $count+=count($moduleData);
        }
        return $count;
    }
    
}