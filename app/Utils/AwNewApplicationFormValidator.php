<?php

namespace App\Utils;

use App\Traits\General;
use Validator;

class AwNewApplicationFormValidator
{
    use General;
    public function __construct(){}

    public function validateNewApplicationStepOne($request, $required = NULL)
    {
        
        $saarcList=array(1,18,25,99,130,149,162,200);
        if(!in_array($request->country,$saarcList)){
            $gst_document="";
            $gst_number="";
        }

        $validation = Validator::make($request->all(), [
            'manufacturer_name'         =>  'required|string|regex:/^[a-zA-Z ]*$/|max:90',
            'register_office_address'   =>  'required|string|regex:/([- ,\/0-9a-zA-Z]+)/',
            'register_office_phone'     =>  'required|numeric|digits:10',             
            'com_address'               =>  'required|string|regex:/([- ,\/0-9a-zA-Z]+)/',
            'com_phone'                 =>  'required|numeric|digits:10',

            'rotor_diameter'            =>  'required',
            'hub_height'                =>  'required',
            'tower_type'                =>  'required',
            'is_applied'                =>  'required',
            'turbine_model'             =>  'required',
            'person_contact_no'         =>  'required|numeric|digits:10',
            'person_email'              =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'authorize_name'            =>  'required|string|regex:/^[a-zA-Z ]*$/|max:90',
            'authorize_designation'     =>  'required|string|max:90',
            'authorize_letter'          =>  'required_if:step1,0|mimes:pdf|max:2000',
            'certificate_incorporation' =>  'required_if:step1,0|mimes:pdf|max:2000',
        ],
        [
            'phone.required' => 'Please enter mobile number',
            'phone.numeric' => 'The mobile number be a number.',
            'phone.digits:10' => 'The mobile number must be 10 digits.',
            'manufacturer_brand_logo.required_if' => 'The manufacturer brand logo field is required ',
            'authorize_letter.required_if' => 'Authorized letter required ',
            'certificate_incorporation.required_if' => 'Certificate of incorporation letter required ',
            'com_address.required' => 'Communication Address is required.',
            'com_phone.required' => 'Communication Phone is required.',
            'com_phone.digits:10' => 'The mobile number must be 10 digits.',
            'authorize_letter.max' =>'Authorize letter should not be greater than 1MB',
            'gst_document.required_if' => 'GST Document is required ',
            'gst_number.required_if' => 'GST Number is required ',
           
        ]

       ); 
       if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }
    
    public function validateNewApplicationStepTwo($request, $required = NULL)
    {   $validation = Validator::make($request->all(), [
            'manufacturing_capacity'    =>  'required',
           
        ]
       
        );
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }
    
    public function validateAnnexureOneOfOne($request, $required = NULL)
    {   
        $validation = Validator::make($request->all(), [
             'module_dimensions'          =>  'required|numeric',
             'module_length'              =>  'required|numeric', 
             'module_breadth'             =>  'required|numeric',
             'module_weight'              =>  'required|numeric',

        ],
        [
            'no_of_cells.*'=>'Please enter No of Cells & Cell Type',
            'cell_type.*'  =>'Please Select Full Cells / Half Cells',
        
        ]
        );
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }

    public function validateAnnexureOneOfTwo($request, $required = NULL)
    {   
        $validation = Validator::make($request->all(), [
            'pmax_watt.*'               =>  'required',
            'vmp.*'                     =>  'required',
            'imp.*'                     =>  'required',
            'voc.*'                     =>  'required',
            'isc.*'                     =>  'required',
            'model_efficiency.*'        =>  'required',
            'fill_factor.*'             =>  'required|max:150',
            'module_one_data_sheet.*'   =>  'required',

        ],
        [
            'pmax_watt.*'               =>'Please enter Pmax(Wp)',
            'vmp.*'                     =>'Please enter Vmp (V)',
            'imp.*'                     =>'Please enter Imp (A)',
            'voc.*'                     =>'Please enter Voc (V)',
            'isc.*'                     =>'Please enter Isc (A)',
            'model_efficiency.*'        =>'Please enter Module Efficiency (%)',
            'fill_factor.*.required'    =>'Please enter Fill Factor',
            'fill_factor.*.max'         =>'Max 150 characters allowed',
        ]
        );
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }

    public function validateAnnexureOneOfThree($request, $sub_annexure_type)
    {   
        if($sub_annexure_type==6){
            $validation = Validator::make($request->all(), [
                    'cell_technology'     =>  'required',
                    'cell_min_efficiency'    =>  'required',
                    'cell_max_efficiency'       =>  'required',
                    'cell_min_wattage'        =>  'required',
                    'cell_max_wattage'   =>  'required',
                    'cell_demension_one'       =>  'required',
                    'cell_demension_two'        =>  'required',
                    'cell_total_bus'   =>  'required',
                ],
                [
                    'cell_technology'     =>'This field is required ',
                    'cell_min_efficiency'    =>'This field is required ',
                    'cell_max_efficiency'       =>'This field is required ',
                    'cell_min_wattage'        =>'This field is required ',
                    'cell_max_wattage'   =>'This field is required ',
                    'cell_demension_one'       =>'This field is required ',
                    'cell_demension_two'        =>'This field is required ',
                    'cell_total_bus'   =>'This field is required ',
                ]
            );
            }else if($sub_annexure_type==7){
            $validation = Validator::make($request->all(), [
                    'front_cover'   =>  'required',
                    'back_cover'     =>  'required',
                    'frame'   =>  'required',
					'adhesive'   =>  'required',
					'encapsulate'   =>  'required',
					'junction_box'   =>  'required',
					
                ],
                [
                    'front_cover'   =>'This field is required ',
                    'back_cover'     =>'This field is required ',
                    'frame'   =>'This field is required ',
					'adhesive'   =>'This field is required ',
					'encapsulate'   =>'This field is required ',
					'junction_box'   =>'This field is required ',
					
                ]
            );
        }
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }

    public function validateAnnexureTwo($request, $required = NULL)
    {   
        $validation = Validator::make($request->all(), [
            'bom_attachment' =>  'required|max:10240|mimes:pdf',
            ],
            [
                'bom_attachment.required' => 'Please upload Bill of Material for Main Model',
                'bom_attachment.mimes' => 'Only pdf are allowed',
                'bom_attachment.max' => 'Sorry! Maximum allowed size for an pdf is 10 MB',
            ]
        );
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }
    
    public function validateAnnexureThree($request, $subAnnexureType)
    {   
        if($subAnnexureType==1){
            $validation = Validator::make($request->all(), [
                    'bis_certificate_no.*'     =>  'required',
                    'bis_certificate_issue.*'  =>  'required',
                    'bis_certificate_valid.*'  =>  'required',
                    'bis_certificate'           =>  'required|max:2048|mimes:pdf',
    
                ],
                [
                    'bis_certificate.required' => 'Please upload Certificate',
                    'bis_certificate.mimes' => 'Only pdf are allowed',
                    'bis_certificate.max' => 'Sorry! Maximum allowed size for an pdf is 1MB',
                    'bis_certificate_no.*.required' => 'This field is required',
                    'bis_certificate_issue.*.required' => 'This field is required',
                    'bis_certificate_valid.*.required' => 'This field is required',
                ]
            );
        }else if($subAnnexureType==2){
            $validation = Validator::make($request->all(), [
                    'orgn_contact_name.*'           =>  'required',  
                    'orgn_contact_address.*'        =>  'required',  
                    'orgn_contact_phone.*'          =>  'required|numeric|digits:10',  
                    'orgn_contact_email.*'          =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                ],
                [
                    'orgn_contact_name.*'           =>'This field is required ',  
                    'orgn_contact_address.*'        =>'This field is required ', 
                    'orgn_contact_phone.*'          =>'This field is required ', 
                    'orgn_contact_email.*'          =>'This field is required ',
                ]
            );
           }else if($subAnnexureType==3){
               $validation = Validator::make($request->all(), [
                'lab_contact_name.*'         =>  'required',
                'lab_contact_address.*'      =>  'required',
                'lab_contact_phone.*'        =>  'required|numeric|digits:10',
                'lab_contact_email.*'        =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            ],
            [
                'lab_contact_name.*'             =>'This field is required ',
                'lab_contact_address.*'          =>'This field is required ',
                'lab_contact_phone.*'            =>'This field is required ',
                'lab_contact_email.*'            =>'This field is required ',
                ]
            );
        }else if($subAnnexureType==8){
            $validation = Validator::make($request->all(), [
             'accred_contact_name.*'        =>  'required',
             'accred_contact_address.*'      =>  'required',
             'accred_contact_phone.*'        =>  'required|numeric|digits:10',
             'accred_contact_email.*'        =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
         ],
         [
             'accred_contact_name.*'             =>'This field is required ',
             'accred_contact_address.*'          =>'This field is required ',
             'accred_contact_phone.*'            =>'This field is required ',
             'accred_contact_email.*'            =>'This field is required ',
             ]
         );
        }else if($subAnnexureType==9){
            $validation = Validator::make($request->all(), [
                'accred_valid_upto.*'     =>  'required',
                // 'accred_certificate_no.*'  =>  'required',
                'accred_certificate'           =>  'required|max:1024|mimes:pdf',

            ],
            [
                'accred_certificate.required' => 'Please upload Certificate',
                'accred_certificate.mimes' => 'Only pdf are allowed',
                'accred_certificate.max' => 'Sorry! Maximum allowed size for an pdf is 1MB',
                // 'accred_certificate_no.*.required' => 'This field is required',
                'accred_valid_upto.*.required' => 'This field is required',
            ]
         );

        }
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }
    
    // Rlmm 2. Collaboration / Design Ownership Details validation by Raushan
    public function validateAnnexureFourOfThree($request, $subAnnexureType, $type)
    {   

        if($subAnnexureType==50){
            $validation = Validator::make($request->all(), [
                    'module_name'     =>  'required',

                ],
                [
                    'module_name.*.required' => 'This field is required',
                ]
            );
        }else if($subAnnexureType==51){
        $validation = Validator::make($request->all(), [
                'whether_enlisted'     =>  'required',

            ],
            [
                'whether_enlisted.required' => 'Please upload Certificate',
            ]);
        }else if($subAnnexureType == 5200){
            $validation = Validator::make($request->all(), [
                    'name_of_company'       =>  'required',  
                    'coll_address'          =>  'required',  
                    'collab_phone'          =>  'required|numeric|digits:10',  
                    'collab_email'          =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            ],
            [
                'name_of_company.*'         =>  'This field is required ',
                'coll_address.*'            =>  'This field is required ',
                'collab_phone.*'            =>  'This field is required ',
                'collab_email.*'            =>  'This field is required ',
                ]);

            }else if($subAnnexureType==53){
                $validation = Validator::make($request->all(), [
                 'ind_territory'        =>  'required',
             ],
             [
                 'ind_territory.*'             =>'This field is required ',
                 ]
             );
            }else if($subAnnexureType==54){
                $validation = Validator::make($request->all(), [
                 'ownership_right'        =>  'required',
             ],
             [
                 'ownership_right.*'             =>'This field is required ',
                 ]
             );
            }
           if($validation->fails())
               return array('status'=>'error','message'=>$validation->errors());
           return array('status'=>'success','message'=>'');
    }


    // Rlmm validation Type certificate by Raushan 
    public function validateAnnexureFourOfFour($request, $subAnnexureType)
    {   
        if($subAnnexureType==11){
            $validation = Validator::make($request->all(), [
                    // 'cert_ attach_no.*'       =>  'required',
                    'wind_turbine_capacity'      =>  'required|numeric|min:225',
                    'type_certificate_issue'     =>  'required',
                    'cert_attach_no'             =>  'required|numeric',
                    'type_certificate_valid'     =>  'required',
                    'new_certificate'            =>  'required|max:2048|mimes:pdf',

                ],
                [
                    'wind_turbine_capacity.*'   => 'Rated Capacity of the wind turbine must be at least 225 kW.',
                    // 'cert_attach_no.required'          => 'This field is required',
                    'type_certificate_issue.required'  => 'This field is required',
                    'cert_attach_no.required'          => 'Type Certificate Number must be Numeric & required',
                    'type_certificate_valid.required'  => 'This field is required',
                    'new_certificate.required'         => 'Please upload Certificate',
                ]
            );
        }else if($subAnnexureType==12){
            $validation = Validator::make($request->all(), [
                    'type_certificate_scheme'       => 'required|in:is_iec,iecre,iec',  
                    'type_certificate_pro'          =>  'required',  
                    'compliance_attach'               =>  'required',  
            ],
            [
                'type_certificate_scheme.*'             =>'This field is required ',
                'type_certificate_pro.*'                =>'This field is required ',
                'compliance_attach.*'                     =>'Please upload compliance attach ',
                ]);

            }else if($subAnnexureType==13){
                $validation = Validator::make($request->all(), [
                //  'nise_certificate_body'        =>  'required',
                //  'certification_body'        =>  'required',
                'nise_certificate_body' => 'required|in:niwe,dnv,dewi_occ,tuv_sud,tuv_nord,tuv_rheinland,wind_guard,anyother',
                'anyother_field' => 'required_if:certification_body,anyother|max:255',

             ],
             [
                //  'nise_certificate_body.*'             =>'This field is required ',

                 ]
             );
            }else if($subAnnexureType==14){
                $validation = Validator::make($request->all(), [
                 'certify_body_name'         =>  'required',
                 'accred_body_valid_upto'      =>  'required',
                 'accred_body_attach'        =>  'required',
                 
             ],
             [
                 'certify_body_name.*'             =>'This field is required ',
                 'accred_body_valid_upto.*'        =>'This field is required ',
                 'accred_body_attach.*'            =>'This field is required ',
                 
                 ]
             );
            }else if($subAnnexureType==15){
                $validation = Validator::make($request->all(), [
            
                 'certify_body_phone'        =>  'required|numeric|digits:10',
                 'certify_body_email'        =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
             ],
             [
                 
                 'certify_body_phone.*'             =>'This field is required ',
                 'certify_body_email.*'             =>'This field is required ',
                 ]
             );

            }
           if($validation->fails())
               return array('status'=>'error','message'=>$validation->errors());
           return array('status'=>'success','message'=>'');
    }

    // Not used 
    public function validateAnnexureFourOfFive($request, $subAnnexureType)
    {   
        if($subAnnexureType==701){
            $validation = Validator::make($request->all(), [
                  //  'location_assembly.*'     =>  'required|numeric',
                        // 'wind_turbine_model'     =>  'required',
                        // 'mfg_facility_no'     =>  'required',
                        // 'nacelle_address'     =>  'required',
                       
                        // 'wind_turbine_model.*' => 'required|string|max:100',
                        // 'wind_turbine_part.*' => 'required|string',
                        // 'mfg_facility_no.*' => 'required|integer|min:0',
                        // 'location_details.*' => 'required|string|max:255',
                        
                    ],
                    [
               //         'location_assembly.required' => 'Please upload Certificate',
                        // 'calibration_certificate.required' => 'Please upload Certificate',
                ]);
                }else if($subAnnexureType==702){
           //     if($request->iso_certificate[0]=="yes"){
                $validation = Validator::make($request->all(), [
                    
                'iso_certificate'        =>  'required',
                'issuing_agency'         =>  'required',
                'issuing_date'           =>  'required',
                'certificate_validate'     =>  'required',
                'iso_certificate_doc'      =>  'required',
                
            
                ],
                [
                 'iso_certificate'          =>'This field is required ',
                'issuing_agency'            =>'This field is required ',
                'issuing_date'              =>'This field is required ',
                'certificate_validate'        =>'This field is required ',
                'iso_certificate_doc'         =>'Please Upload Certificate ',
                ]);
      /*      }else{
                $validation = Validator::make($request->all(), [
                
                ]);
            }  */

            }else if($subAnnexureType==703){
                $validation = Validator::make($request->all(), [
                'iso_name_body'         =>  'required',
                'accred_date'           =>  'required',
                'iso_phone_body'        =>  'required|numeric|digits:10',
                'iso_email_body'        =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'accred_cert_doc'       =>  'required',
                ],
                [
                'iso_name_body.*'        =>'This field is required ',
                'accred_date.*'          =>'This field is required ',
                'iso_phone_body.*'       =>'This field is required ',
                'iso_email_body.*'       =>'This field is required ',
                'accred_cert_doc.*'      =>'Please Upload Certificate ',
                ]);
            }
            
        
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }
    // Not used 
    public function validateAnnexureFive($request, $required = NULL)
    {   
        $validation = Validator::make($request->all(), [
            'month'       =>  'required',
            'financial_year'   =>  'required',
            'module_production_data'        =>  'required',
            'module_sale'          =>  'required',
            'module_sale_amount'  =>  'required',
            'epc_other_amount'   =>  'required',
            'total_sales'   =>  'required',
            'raw_purchase_module'   =>  'required',
            'other_raw_purchase'   =>  'required',
            'total_purchase'   =>  'required',

        ]);
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }
    // Not used 
    // public function validateAnnexureSix($request, $required = NULL)
    // {   //|regex:/(^[-0-9A-Za-z.,\/ ]+$)/
    //     $validation = Validator::make($request->all(), [
    //         'name_of_company'       =>  'required|string|max:70',
    //         'country'               =>  'required',
    //         'address'               =>  'required|string|max:300',
    //         'whether_enlisted'      =>  'required',
    //         'noofpv_models'         =>  'required',
    //         'manufacturing_capacity'=>  'required',

    //     ]);
    //     if($validation->fails())
    //         return array('status'=>'error','message'=>$validation->errors());
    //     return array('status'=>'success','message'=>'');
    // }
    // Not used 
    public function validateAnnexureSeven($request, $required = NULL)
    {   
        $validation = Validator::make($request->all(), [
            'annexure7'       =>  'required|file|mimes:pdf|max:10192',
        ],
        [
            'annexure7.required' => "You must use the 'Choose file' button to select which file you wish to upload",
            'annexure7.max' => "Maximum file size to upload is 10MB (10192 KB)."
        ]);
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }
    // Not used 
    public function validateAnnexureEight($request, $required = NULL)
    {   
        $validation = Validator::make($request->all(), [
            'annexure8'       =>  'required|file|mimes:pdf|max:10192',
        ],
        [
            'annexure8.required' => "You must use the 'Choose file' button to select which file you wish to upload",
            'annexure8.max' => "Maximum file size to upload is 10MB (10192 KB)."
        ]);
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }


    //    AffdavitIndemnity Rlmm by Raushan 
    public function validateApplicationAffdavitIndemnity($request){
        $validation = Validator::make($request->all(), [
            'signatory_document'       => 'required|file|mimes:pdf|max:10192',
            'indemnity_document'       => 'required|file|mimes:pdf|max:10192',
            // 'declaration'              => 'required',
            'affidavit'                => 'required',
            'indemnity'                => 'required'
        ],
           [
            
            'declaration.required'  =>  'Please check declaration'
        ]);
        
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }

    public function validateApplicationFinalSubmission($request){
        $validation = Validator::make($request->all(), [
           
            'declaration'          => 'required',
            
        ],
        [
            // 'attc_iso_certificate.mimes' => "Please upload PDF file only",
            // 'attc_iso_certificate.max' => "Maximum file size to upload is 10MB (10192 KB).",
            'declaration.required'  =>  'Please check declaration'
        ]);
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }
    
    public function validateForcedChangePassword($request){
        $validation = Validator::make($request->all(), [
            'newpassword'    =>  'required',
            'confirmpassword'    =>  'required',

        ],
        [
            'newpassword.required'=>'New Password Field is Required.',
            'confirmpassword.required'=>'Confirm Password Field is Required.',
            
        ]
        );
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }
    public function validatePanGstDocumentForm($request){
        $validation = Validator::make($request->all(), [
            'pan_document'    =>  'required|max:2024|mimes:pdf',
            'gst_document'    =>  'required|max:2024|mimes:pdf',

        ],
        [
            'pan_document.required'=>'Please select file.',
            'pan_document.max'=>'Max. file size allowed 2MB.',
            'pan_document.mimes'=>'Please select pdf file only.',
            'gst_document.required'=>'Please select file.',
            'gst_document.max'=>'Max. file size allowed 2MB.',
            'gst_document.mimes'=>'Please select pdf file only.',
            
        ]
        );
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }

    // 
    
}