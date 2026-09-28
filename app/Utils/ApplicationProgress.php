<?php

namespace App\Utils;

use App\Traits\General;
use App\Models\Annexure1;
use App\Models\Annexure2;
use App\Models\Annexure3;
use App\Models\Annexure4;
use App\Models\Annexure5;
use App\Models\Annexure6;
use App\Models\Module;
use App\Models\ApplicationDetail;
use App\Models\ApplicationPaymentDetails;
//use App\Models\Consumer;
use URL;


use Auth;

class ApplicationProgress
{
    use General;
    public function __construct(){}

    public function getApplicationAnnexureProgress($application_id)
    {
        $annexure1Url=$annexure2Url=$annexure3Url=$annexure4Url=$annexure5Url=$annexure7Url=$annexure8Url='javascript:;';
        //--------------Annexure 1--------------------
        $annexure1 = Annexure1::where('application_id', $application_id)->where('sub_annexure',1)->count();
        $annexure1_2 = Annexure1::where('application_id', $application_id)->where('sub_annexure',2)->count();
        $annexure1_3 = Annexure1::where('application_id', $application_id)->where('sub_annexure',3)->count();
        $annexure1_4 = Annexure1::where('application_id', $application_id)->where('sub_annexure',4)->count();
        $annexure1_5 = Annexure1::where('application_id', $application_id)->where('sub_annexure',5)->count();
        $annexure1_6 = Annexure1::where('application_id', $application_id)->where('sub_annexure',6)->count();

        //--------------Annexure 2--------------------
        $annexure2 = Annexure2::where('application_id', $application_id)->count();

        //--------------Annexure 3--------------------
        $annexure3 = Annexure3::where('application_id', $application_id)->where('sub_annexure',1)->count();
        $annexure3_2 = Annexure3::where('application_id', $application_id)->where('sub_annexure',2)->count();

        //--------------Annexure 4--------------------
        $annexure4 = Annexure4::where('application_id', $application_id)->where('sub_annexure',1)->count();
        $annexure4_2 = Annexure4::where('application_id', $application_id)->where('sub_annexure',2)->count();
        $annexure4_3 = Annexure4::where('application_id', $application_id)->where('sub_annexure',3)->count();
        $annexure4_4 = Annexure4::where('application_id', $application_id)->where('sub_annexure',4)->count();
        $annexure4_5 = Annexure4::where('application_id', $application_id)->where('sub_annexure',5)->count();
        $annexure6 = Annexure6::where('application_id', $application_id)->count();



        $annexure5 = Annexure5::where('application_id', $application_id)->count();
        $annexure7 = ApplicationDetail::select('annexure7')->where('id', $application_id)->first();
        $annexure8 = ApplicationDetail::select('annexure8')->where('id', $application_id)->first();
        $progress =0;$a1=$a2=$a3=$a4=$a5=$a6=$a7=$a8='false';
        //echo $annexure1;die;
        //Annexure 1
        if($annexure1>0){$progress+=2;$a1='true';
            $annexure1Url=URL::to('/users/annexure-one/'.$this->encodeid($application_id));}
        if($annexure1_2>0){$progress+=3;$a1='true';}
        if($annexure1_3>0){$progress+=3;$a1='true';}
        if($annexure1_4>0){$progress+=2;$a1='true';}
        if($annexure1_5>0){$progress+=3;$a1='true';}
        if($annexure1_6>0){$progress+=2;$a1='true';}


        if($annexure2>0){$progress+=7;$a2='true';
            $annexure2Url=URL::to('/users/annexure-two/'.$this->encodeid($application_id));}

        if($annexure3>0){$progress+=4;$a3='false';
            $annexure3Url=URL::to('/users/annexure-three/'.$this->encodeid($application_id));}
        if($annexure3_2>0){$progress+=8;$a3='true';}

        if($annexure6>0){$progress+=1;$a4='false';}
        if($annexure4>0){$progress+=1;$a4='false';
            $annexure4Url=URL::to('/users/annexure-four/'.$this->encodeid($application_id));}
        if($annexure4_2>0){$progress+=3;$a4='false';}
        if($annexure4_3>0){$progress+=3;$a4='false';}
        if($annexure4_4>0){$progress+=3;$a4='false';}
        if($annexure4_5>0){$progress+=4;$a4='true';}
        

        if($annexure5>0){$progress+=18;$a5='true';
            $annexure5Url=URL::to('/users/annexure-five/'.$this->encodeid($application_id));}
        
        if($annexure7->annexure7!=null){$progress+=20;$a7='true';
            $annexure7Url=URL::to('/users/annexure-seven/'.$this->encodeid($application_id));}
        if($annexure8->annexure8!=null){$progress+=20;$a8='true';
            $annexure8Url=URL::to('/users/annexure-eight/'.$this->encodeid($application_id));}
        $response = [
            'application_id'  =>  $application_id,
            'annexure1' => $a1,
            'annexure2' => $a2,
            'annexure3' => $a3,
            'annexure4' => $a4,
            'annexure5' => $a5,
            'annexure6' => $a6,
            'annexure7' => $a7,
            'annexure8' => $a8,
            'annexure1Url' => $annexure1Url,
            'annexure2Url' => $annexure2Url,
            'annexure3Url' => $annexure3Url,
            'annexure4Url' => $annexure4Url,
            'annexure5Url' => $annexure5Url,
            'annexure7Url' => $annexure7Url,
            'annexure8Url' => $annexure8Url,
            'progress'  => $progress
        ];
        return $response;
    }
    public function getApplicationProgress($application_id)
    {
        $step1Url=$step2Url=$attachmentUrl=$feedetailUrl=$annexureUrl='javascript:;';
        $step1 = ApplicationDetail::select('step1')->where('id', $application_id)->first();
        $step2 = Module::select('id')->where('application_id', $application_id)->first();
        
        $annexure = Annexure1::select('id')->where('application_id', $application_id)->where('sub_annexure',1)->count();
        $attachment = ApplicationDetail::select('attachment_uploaded')->where('id', $application_id)->first();
        $feedetail = ApplicationPaymentDetails::select('id')->where('application_id', $application_id)->first();
        $progress = 0;$a1=$a2=$a3=$a4=$a5=$a6=$a7=$a8='false';
        if($step1!=null){$progress+=18;$a1='true';
            $step1Url=URL::to('/users/new-application/'.$this->encodeid($application_id));}
        if(!empty($step2) && $step2->id!=null){ $progress+=18;$a2='true';$step2Url=URL::to('/users/module-master/'.$this->encodeid($application_id));}
        if(!empty($attachment) && $attachment->attachment_uploaded>0){$progress+=20;$a3='true';$attachmentUrl=URL::to('/users/annexure-attachment/'.$this->encodeid($application_id));}
        if(!empty($feedetail) && $feedetail->id>0){$progress+=18;$a4='true';$feedetailUrl=URL::to('/users/application-fees/'.$this->encodeid($application_id));}
        if(!empty($annexure) && $annexure>0){$progress+=50;$a8='true';$annexureUrl=URL::to('/users/annexure-one/'.$this->encodeid($application_id));}
        $response = [
            'application_id'=>$application_id,
            'step1' => $a1,
            'step2' => $a2,
            'attachment' => $a3,
            'feedetail' => $a4,
            'progress'  => $progress,

            'annexure' => $a8,
            'attachmentUrl' =>  $attachmentUrl,
            'step1Url'  =>  $step1Url,
            'step2Url'  =>  $step2Url,
            'annexureUrl'   =>  $annexureUrl,
            'feedetailUrl' => $feedetailUrl,
            
        ];
        return $response;
    }
    
}