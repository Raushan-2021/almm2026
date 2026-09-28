<?php

namespace App\Models;
use App\Models\MachineList;
use App\Models\Country;

use Illuminate\Database\Eloquent\Model;

class Annexure4 extends Model
{
    //
    protected $table="annexure4";
    static function getAnnexureFourData($application_id,$user_id,$sub_annexure){
        //return self::
        return self::select('annexure4.*')
                    ->where('annexure4.application_id', $application_id)
                    ->where('annexure4.user_id', $user_id)
                    ->where('annexure4.sub_annexure', $sub_annexure)
                    ->get();
    }
    static function getMajoEquipmentData($equip_ids){
        $data = json_decode($equip_ids);
        $machine = MachineList::select('title')->whereIn('id',$data)->get()->toArray();
        $array=array();
        foreach($machine as $mh){
            $array[] = $mh['title'];
        }
        return json_encode($array);
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
    static function getEquipmentType($mtype){
        $data = json_decode($mtype);
        $array=array();
        foreach($data as $mh){
            $temp = 'Not Availabl';
            if($mh==1){
                $temp='Manual';
            }elseif($mh==2){
                $temp='Semi-Automatic';
            }elseif($mh==3){
                $temp='Automatic';
            }
            $array[] = $temp;
        }
        return json_encode($array);
    }
}
