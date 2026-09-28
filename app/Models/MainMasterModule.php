<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainMasterModule extends Model
{
    //
    protected $table="main_master_module";

    public static function getModuleDataById($application_id){
    //    $p_id = static::getPreviousID($application_id);
        //  dd($application_id);
        return self::select('main_master_module.*','modules_type_list.module_name','application_details.country')
        ->join('modules_type_list','modules_type_list.id','main_master_module.module_type')
        ->join('application_details','application_details.id','main_master_module.application_id')
        ->where('main_master_module.application_id',$application_id)
        //->orwhere('master_module.application_id',$p_id)
        ->orderBy('modules_type_list.module_name')
        ->get();
    }

    
}
