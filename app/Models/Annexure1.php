<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Module;
use App\Models\ApplicationFee;
use App\Models\ApplicationDetail;
use DB;

class Annexure1 extends Model
{
    //

    protected $table="annexure1";

    static function getAnnexureData_bk($application_id,$user_id,$sub_annexure){
        //return self::
        return self::select('annexure1.*','master_module.module_type')
                    ->join('master_module', 'master_module.id', 'annexure1.module_type')
                    ->where('annexure1.application_id', $application_id)
                    ->where('annexure1.user_id', $user_id)
                    ->where('annexure1.sub_annexure', $sub_annexure)
                    ->get();
    }
    static function getAnnexureData($application_id,$user_id,$sub_annexure,$electricalType=NULL){
        //return self::
        //dd($application_id.'----User:'.$user_id);
        // DB::enableQueryLog();
        $previous_id = Module::getPreviousID($application_id);
        $i=0;$annexureData=array();
        $moduledata = Module::getModuleData($application_id,$user_id);
         dd($moduledata);
        foreach($moduledata as $data){
            $annexureData[] = $data;
             dd($data);
            if($electricalType){//For Electrical STC/NOCT Data Only
                
                $annexureData[$i]['annexure']= self::where('module_type',$data->id)->where('sub_annexure',$sub_annexure)
                ->where('user_id',$user_id)->where('electrical_data_type',$electricalType)
                ->where(function($q) use ($application_id,$previous_id) {
                    $q->where('application_id', $application_id)
                      ->orWhere('application_id', $previous_id);
                })->get();
                
            }else{
                // dd($data->id);
                $annexureData[$i]['annexure']= self::where('module_type',$data->id)->where('sub_annexure',$sub_annexure)
                ->where('user_id',$user_id)
                ->where(function($q) use ($application_id,$previous_id) {
                    $q->where('application_id', $application_id)
                      ->orWhere('application_id', $previous_id);
                })
                ->get();
               
            }   
            $annexureData[$i]['applicable_model_covered'] = json_decode($data->applicable_model_covered);
            $annexureData[$i]['applicable_model'] = json_decode($data->applicable_model);
            $i++;
        }
        // dd($annexureData);
        //dd(DB::getQueryLog());
        return $annexureData;
        
    }
    static function getAnnexureDataByID($application_id,$user_id,$module_id,$subAnnexureType,$type=NULL){
        //return self::
        $i=0;$annexureData=array();
        $moduledata = Module::getSingleModuleDataById($application_id,$module_id);
        // dd($moduledata);
        if($moduledata!=null){
            if($type==NULL){
                $moduledata->annexure= self::select('*')->where('module_type',$moduledata->id)
                ->where('application_id',$application_id)->where('sub_annexure',$subAnnexureType)->where('user_id',$user_id)->get()->toArray();
            }else{
                $moduledata->annexure= self::select('*')->where('module_type',$moduledata->id)->where('electrical_data_type',$type)
                ->where('application_id',$application_id)->where('sub_annexure',$subAnnexureType)->where('user_id',$user_id)->get()->toArray();
            }
            // dd($moduledata);
            $moduledata->applicable_model_covered = json_decode($moduledata->applicable_model_covered);
            $moduledata->applicable_model = json_decode($moduledata->applicable_model);
            $moduledata->electrical_data_type = $type;
            $moduledata->subAnnexureType = $subAnnexureType;
        }
        // dd($moduledata);
        return $moduledata;
    }
    static function getAnnexureMultipleData($application_id,$user_id,$sub_annexure){
        //return self::
        return self::select('annexure1.*','master_module.module_type')
                    ->join('master_module', 'master_module.id', 'annexure1.module_type')
                    ->where('annexure1.application_id', $application_id)
                    ->where('annexure1.user_id', $user_id)
                    ->whereIn('annexure1.sub_annexure', $sub_annexure)
                    ->get();
    }
    static function getApplicationFee($application_id,$user_id){
        //return self::
        
        $i=0;$feeDetails=array();$gst=0;
        $moduleCapacity=ApplicationDetail::select('manufacturing_capacity','is_sez')->where('id',$application_id)->first();
        if($moduleCapacity->manufacturing_capacity <=50){
            $fees=ApplicationFee::select('fees')->where('status',1)->where('capacity','<=',50)->first();
        }else{
            $fees=ApplicationFee::select('fees')->where('status',1)->where('capacity','>',50)->first();
        }
        
        $moduledata = Module::getModuleDataById($application_id);
        //Afghanistan, Bangladesh, Bhutan, India, Maldives, Nepal, Pakistan and Sri-Lanka
        $saarcList=array(1,18,25,99,130,149,162,200);
        $isSaarc=1; //1 = Yes
        foreach($moduledata as $data){//$i++;
            $appfess=0;
            // dd($data);
            if($moduleCapacity->is_sez!='Yes'){
                $gst=18;
            }
            if(!in_array($data->country,$saarcList)){$isSaarc=0;}
            if($i==0){
                $appfess = ($fees->fees * $moduleCapacity->manufacturing_capacity);
                
            }else{
                $extramodelCost=$fees->fees * $moduleCapacity->manufacturing_capacity;
                $appfess=($extramodelCost*0.01);
            }
            $feeDetails[] = $data;
            $feeDetails[$i]['applicable_model_covered'] = json_decode($data->applicable_model_covered);
            $feeDetails[$i]['applicable_model'] = json_decode($data->applicable_model);
            $feeDetails[$i]['fees'] = $fees->fees;
            $feeDetails[$i]['gst'] = $gst;
            $feeDetails[$i]['isSaarc'] = $isSaarc;
            $feeDetails[$i]['applicationfees'] = $appfess;
            $feeDetails[$i]['annexure']= self::where('module_type',$data->id)->where('sub_annexure',1)
                ->where('user_id',$user_id)->where('application_id',$application_id)->get();
            $feeDetails[$i]['inspectionfees'] = ApplicationFee::calculateInspectionFee($moduleCapacity->manufacturing_capacity,$isSaarc);
            $i++;
        }
        return $feeDetails;
    }
    static function getAllAnnexureData($application_id,$user_id){
        //return self::
        return self::select('annexure1.*')
                    ->where('annexure1.application_id', $application_id)
                    ->where('annexure1.user_id', $user_id)
                    ->get();
    }

    static function getSubModuleDataById($application_id,$user_id,$id){
        //return self::
        return self::select('annexure1.*')
        ->where('annexure1.id', $id)
        ->where('annexure1.application_id', $application_id)
        ->where('annexure1.user_id', $user_id)
                    ->first();
    }

        static function getSubModuleDataNewById($application_id,$user_id,$id){
        //return self::
        return self::select('annexure1.*')
        ->where('annexure1.module_type', $id)
        ->where('annexure1.application_id', $application_id)
        ->where('annexure1.user_id', $user_id)
                    ->first();
    }

}