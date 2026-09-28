<?php

namespace App\Utils;

use App\Traits\General;
use Validator;

class FormValidator
{
    use General;
    public function __construct(){}

    public function validateInstallationForm($request, $required = NULL)
    {
        if($required) $required = 'required|';
        else $required = '';

        $validationArray = [
            'pictures.agreement_copy' => $required.'file|mimes:pdf,jpg,jpeg,png',
            'pictures.installer_pic' => $required.'file|mimes:jpg,jpeg,png',
            'pictures.owner_pic' => $required.'file|mimes:jpg,jpeg,png',
            'pictures.site_before_installation_pic' => $required.'file|mimes:jpg,jpeg,png',
            'pictures.under_const_bio_plant' => $required.'file|mimes:jpg,jpeg,png',
            'pictures.bio_plant_with_beneficiary' => $required.'file|mimes:jpg,jpeg,png',
            'pictures.stove_pic' => $required.'file|mimes:jpg,jpeg,png',
            'pictures.h_s_training_statement_pic' => $required.'file|mimes:pdf,jpg,jpeg,png',
            'pictures.linked_toilet_photo' => 'file|mimes:jpg,jpeg,png'
        ];
        $validation = Validator::make($request->all(), $validationArray);
        if($validation->fails())
            return FALSE;

        return TRUE;
    }
    public function validateInspectionForm($request)
    {
        $validationArray = [
            'pic_of_plant_with_family_member' => 'file|mimes:jpg,jpeg,png',
            'pic_of_stove_with_flame' => 'file|mimes:jpg,jpeg,png'
        ];

        $validation = Validator::make($request->all(), $validationArray);
        if($validation->fails())
            return FALSE;

        return TRUE;
    }
    public function applicationDetailsValidations($request, $steps){
        $validations = [
            'manufacturer_name' => 'required',
            'manufacturer_certificate' => 'required|file|mimes:pdf|max:20000',
            'manufacturer_brand_name' => 'required',
            'manufacturer_brand_logo' => 'required|file|mimes:jpg,jpeg,png',
            'register_office_address' => 'required|max:1000',
            'register_office_phone' => 'required',
            'register_office_email' => 'required',
            'com_address' => 'required',
            'com_phone' => 'required',
            'com_email' => 'required',
        ];
        switch ($steps) {
            case 1:
                $validations;
                break;
            
            default:
                # code...
                break;
        }
        $validation = Validator::make($request->all(), $validations);
        if($validation->fails())
            return FALSE;

        return TRUE;
    }
    public function installationDetailValidations($request, $steps)
    {
        $validations = [
            'capacity' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'agreement_date' => 'required',
            'construction_start_date' => 'required',
            'completion_date' => 'required',
            'biogas_model' => 'required',
            'onm_routines_schedule' => 'required',
            'agreement_copy' => 'file|mimes:pdf,jpg,jpeg,png'
        ];

        $stepTwoValidations = [
            'owner_pic' => 'image',
            'installer_pic' => 'image',
            'under_const_bio_plant_pic' => 'image',
            'site_before_installation_pic' => 'image',
            'h_s_training_statement_pic' => 'file|mimes:pdf,jpg,jpeg,png',
            'bio_plant_with_beneficiary_pic' => 'image',
            'stove_pic' => 'image',
            'toilet_status' => 'required',
            'linked_toilet_photo' => 'image'
        ];

        $stepThreeValidations = [
            'bank_name' => 'required',
            'branch_address' => 'required',
            'account_no' => 'required',
            'account_type' => 'required',
            'ifsc_code' => 'required',
            'branch_code' => 'required',
            'micr_code' => 'required',
            'bank_passbook' => 'image'
        ];

        switch($steps){
            case 2:
                $validations = array_merge($validations, $stepTwoValidations);
            break;
            case 3:
                $validations = array_merge($validations, $stepTwoValidations, $stepThreeValidations);
            break;
        }

        $validation = Validator::make($request->all(), $validations);
        if($validation->fails())
            return FALSE;

        return TRUE;
    }
}
