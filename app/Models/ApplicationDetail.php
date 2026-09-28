<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use DB,Auth;

class ApplicationDetail extends Model
{
    //
    
    protected $table="application_details";
    public static function getUserApplications($user_id){
        return self::select('application_details.application_no','application_details.application_type','application_details.manufacturer_name',
        'application_details.id','application_details.final_submission','application_details.status','application_details.inspection_report',
                    'manufacturer_users.name', 'manufacturer_users.email','manufacturer_users.phone','application_details.register_office_address',
                    'application_details.register_office_phone','application_details.register_office_email','application_details.updated_at',
                    'application_details.forward_status')
                    ->join('manufacturer_users', 'manufacturer_users.id', 'application_details.user_id')
                    ->where('manufacturer_users.id', $user_id);
                    // ->get();
    }

    public static function getUserApplicationsByType($user_id,$type){
        return self::select('application_details.application_no','application_details.application_type','application_details.previous_id','application_details.manufacturer_name',
        'application_details.id','application_details.final_submission',
                    'manufacturer_users.name', 'manufacturer_users.email','manufacturer_users.phone','application_details.register_office_address',
                    'application_details.register_office_phone','application_details.register_office_email','application_details.updated_at',
                    'application_details.forward_status')
                    ->join('manufacturer_users', 'manufacturer_users.id', 'application_details.user_id')
                    ->where('manufacturer_users.id', $user_id)
                    ->where('application_details.application_type', $type)
                    ->get();
    }
    
    public static function getAttachmentName($file_name,$application_id){
        return self::select($file_name)->where('id',$application_id)->first();
    }
    public static function getApplicationDataWithFee($application_id){
        return self::select('application_details.id as app_id','application_details.manufacturing_capacity','application_payment_details.*')
                        ->leftjoin('application_payment_details','application_details.id','application_payment_details.application_id')
                        ->where('application_details.id',$application_id)->first();
    }
    public static function getApplicationDataWithInspectionFee($application_id)
    {
        return self::select(
                'application_details.id as app_id',
                'application_details.manufacturing_capacity',
                'application_payment_details.pymt_mode_insp', 
                'application_payment_details.insp_transaction_no',
                'application_payment_details.insp_amt_paid',
                'application_payment_details.insp_transaction_date',
                'application_payment_details.insp_bank_name',
                'application_payment_details.insp_transaction_receipt'
            )
            ->leftJoin(
                'application_payment_details',
                'application_details.id',
                '=',
                'application_payment_details.application_id'
            )
            ->where('application_details.id', $application_id)
            ->first();
    }


    

    
    public static function getAnnexureByApplicationID($application_id,$user_id=NULL){
        
        $dataAry=array();
        
        //$dataAry['applicationDetail'] = ApplicationDetail::where('id', $application_id)->first()->toArray();
        $dataAry['applicationDetail'] = ApplicationDetail::select('application_details.*','country.name as country','c2.name as com_country','c3.name as reg_country')
        ->leftJoin('country','application_details.country','=','country.countrycd')
        ->leftJoin('country as c2','application_details.com_country','=','c2.countrycd')
        ->leftJoin('country as c3','application_details.reg_country','=','c3.countrycd')
        ->where('id', $application_id)->first()->toArray();
        
        $user_id=$dataAry['applicationDetail']['user_id'];
        // dd($application_id);
        // dd($dataAry);

        $dataAry['moduleData'] = MainMasterModule::getModuleDataById($application_id);
        // dd($dataAry);
        $dataAry['applied_pvmodels'] = Module::where('application_id', $application_id)->where('user_id', $user_id)->get();
                // dd($dataAry);

        $dataAry['annexure1'] = Annexure1::getAllAnnexureData($application_id,$user_id); 

        //Parameters : Application ID,User ID, Sub Annexure Type, Electrical Data Type (1=STC,2=NOCT) annexure1_1
    //    $dataAry['appDataSTC'] = Annexure1::getAnnexureData($application_id,$user_id,2,1); 
        // $dataAry['appDataNOCT'] = Annexure1::getAnnexureData($application_id,$user_id,2,2); 
        
        //Parameters : Application ID,User ID, Sub Annexure Type, 
        //$appData['appDataSTCType']=1;//STC Data
        //$appData['appDataNOCTtype']=2;//NOCT Data
        // $dataAry['Annexure1Sub3'] = Annexure1::getAnnexureData($application_id,$user_id,3); //Module Operational Ratings
        // $dataAry['Annexure1Sub4'] = Annexure1::getAnnexureData($application_id,$user_id,4);
        // $dataAry['Annexure1Sub5'] = Annexure1::getAnnexureData($application_id,$user_id,5);
        // $dataAry['Annexure1Sub6'] = Annexure1::getAnnexureData($application_id,$user_id,6);
        // $dataAry['Annexure1Sub7'] = Annexure1::getAnnexureData($application_id,$user_id,7);

        
        // $dataAry['annexure2'] = Annexure2::getAnnexureData($application_id,$user_id); 


        //1:Sub Annexure 1, 2:Sub Annexure 2 ---- Annexure 3
        // $dataAry['bis'] = Annexure3::getAnnexureData($application_id,$user_id,1); 
        // $dataAry['nabl'] = Annexure3::getAnnexureData($application_id,$user_id,2);
        // $dataAry['lab'] = Annexure3::getAnnexureData($application_id,$user_id,3);
        // $dataAry['accred'] = Annexure3::getAnnexureData($application_id,$user_id,8);
        // $dataAry['accred_attach'] = Annexure3::getAnnexureData($application_id,$user_id,9);
        // $dataAry['estd'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,51); 
        // $dataAry['name_cmpny'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,5200);
        // $dataAry['ind_terr'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,53);
        // $dataAry['ownership'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,54);


        // $dataAry['type_cert'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,11); 
        // $dataAry['iecselect'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,12); 
        // $dataAry['certificate_body'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,13); 
        // $dataAry['certifying'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,14);  
        // $dataAry['accred_body'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,15);  
        // $dataAry['accred_attach_item'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,16);

        // $dataAry['manufacture_facility_details'] = Annexure3::getAnnexureData($application_id,Auth::user()->id, 701); 
        // $dataAry['iso_certificate_list'] = Annexure3::getAnnexureData($application_id,Auth::user()->id, 702); 
        // $dataAry['iso_certificate_contact'] = Annexure3::getAnnexureData($application_id,Auth::user()->id, 703); 
        // $dataAry['accreditation_cert'] = Annexure3::getAnnexureData($application_id,Auth::user()->id, 704); 
        // $dataAry['mf_pv_capacity'] = Annexure3::getAnnexureData($application_id,Auth::user()->id, 705);
        // $dataAry['raw_materials_attach'] = Annexure3::getAnnexureData($application_id,Auth::user()->id, 706);
        // dd( $dataAry);
        // $dataAry['psb_attach'] = Annexure3::getAnnexureData($application_id,Auth::user()->id, 707);
        
        // $dataAry['estd'] = Annexure4::where('application_id',$application_id)->where('user_id',$user_id)->first();
        //5.1-Manufacturing facility Details
        // $dataAry['annexure4'] = Annexure4::where('application_id',$application_id)->where('user_id',$user_id)->first();
        //5.2-List of Major Machines/Equipments
        // $dataAry['annexure4_2'] = Annexure4::getAnnexureFourData($application_id,$user_id,2);
        //5.3 Calibration Details of Sun Simulator
        // $dataAry['annexure4_3'] = Annexure4::getAnnexureFourData($application_id,$user_id,3);
        
        //5.4 Calibration Details of Reference Modules
        // $dataAry['annexure4_4']= Annexure4::where('application_id',$application_id)->where('user_id',$user_id)->where('sub_annexure',4)->orderby('module_type','ASC')->get();
        // $dataAry['gold']=Annexure4::where('module_type',1)->where('application_id',$application_id)->where('user_id',$user_id)->where('sub_annexure',4)->count();
        // $dataAry['silver']=Annexure4::where('module_type',2)->where('application_id',$application_id)->where('user_id',$user_id)->where('sub_annexure',4)->count();

        // $dataAry['annexure4_5'] = Annexure4::getAnnexureFourData($application_id,$user_id,5);

        // -----------------------------Annexure 5 -------------------------------------
        // $financialYear=array();
        // $annexureFiveData = Annexure5::where('application_id',$application_id)->where('user_id',$user_id)->orderBy("id")->get();
        // $financialYearData = Annexure5::select('financial_year')->where('application_id',$application_id)->where('user_id',$user_id)
        // ->groupby('financial_year')->orderBy("financial_year",'DESC')->get()->toArray();
        // $i=$j=$k=$l=0;
        // if($financialYearData!=null){
                // $financialYear['current']=$financialYearData[0]['financial_year'] ?? '';
                // $financialYear['last']=$financialYearData[1]['financial_year'] ?? '';
                // $financialYear['lastTolast']=$financialYearData[2]['financial_year'] ?? '';
        // }
        // foreach($annexureFiveData as $data){$i++;
        //     if($data->type==1){ //Module Sale Data
        //         $appData['datatype1'][$i]=$data;
        //     }elseif($data->type==2){ //Raw material
        //         $appData['datatype2'][$i]=$data;
        //     }
            
        //     elseif($data->type==3){
                
        //         //$appData['datatype3'][$i]=$data;
        //         if($data->financial_year ==$financialYear['current']){
        //             $j++;
        //             $appData['datatype3']['current'][$j]=$data->toArray();
        //         }
        //         if($data->financial_year ==$financialYear['last']){
        //             $k++;
        //             $appData['datatype3']['last'][$k]=$data->toArray();
        //         }
        //         if($data->financial_year ==$financialYear['lastTolast']){
        //             $l++;
        //             $appData['datatype3']['lastTolast'][$l]=$data->toArray();
        //         }
                    
        //     }
        // }
        // $dataAry['annexure5']=$appData;
        // $dataAry['financialYear']=$financialYear;
       // -----------------------------Annexure 5 End --------------------------------

        // $dataAry['annexure6'] = Annexure6::where('application_id',$application_id)->where('user_id',$user_id)->get();
        // $dataAry['paymentdetails'] = ApplicationPaymentDetails::where('application_id', $application_id)->first();
        // $dataAry['paymentdetails'] = ApplicationPaymentDetails::where('application_id', $application_id)->first();
        // dd($dataAry);

        return $dataAry;

    }

    public static function getSchemduledInspectionListNise(){
        return self::select('application_details.application_no','application_details.application_type','application_details.manufacturer_name',
                    'application_details.id','application_details.final_submission','application_details.status','application_details.inspection_report',
                    'application_details.register_office_address',
                    'application_details.register_office_phone','application_details.register_office_email','application_details.updated_at',
                    'application_details.forward_status')
                    ->join('inspection_history', 'inspection_history.application_id', 'application_details.id')
                    ->distinct('inspection_history.application_id')
                    ->where('application_details.forward_status', 'nise')
                    ->orderBy('application_details.id','DESC');
                    // where('forward_status','nise')
                    // ->get();
    }
    
}