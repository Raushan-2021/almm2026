<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationFee extends Model
{
    protected $table="application_fees";
    static function calculateInspectionFee($capacity,$isSaarc){
        $inspectionFee=0;
        // dd($isSaarc);
        if($isSaarc ==1){ //For SAARC Country
            if($capacity>0 && $capacity<=100){
                $inspectionFee = 150000; //1.5 lakhs
            }else if($capacity>100 && $capacity <=500){
                $inspectionFee = 500000; //5 lakhs
            }else{
                $inspectionFee = 1500000; //15 lakhs
            }
        }else{
            $inspectionFee = 3000000; //30 lakhs
        }
        return $inspectionFee;
    }
}