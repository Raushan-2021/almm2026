<?php

namespace App\Utils;

use App\Traits\General;
use Validator;

class NewApplicationFormValidator
{
    use General;
    public function __construct(){}

    public function validateNewApplicationStepOne($request, $required = NULL)
    {
        //|regex:/(^[-0-9A-Za-z., \/ ]+$)/
        //_! "#$%&\'()*+,.:\/;=?@^-
        $saarcList=array(1,18,25,99,130,149,162,200);
        // $gst_document="required_if:is_sez,No|mimes:pdf|max:1000";
        // $gst_number="required_if:is_sez,No";
        if(!in_array($request->country,$saarcList)){
            $gst_document="";
            $gst_number="";
        }

        // dd($gst_document.'-----'.$gst_number);
        $validation = Validator::make($request->all(), [
            'application_type'                   =>  'required',
            'manufacturer_name'         =>  'required|string|regex:/^[a-zA-Z ]*$/|max:90',
            // 'manufacturer_brand_name'   =>  'required|string|regex:/^[a-zA-Z ]*$/|max:90',
            'register_office_address'   =>  'required|string|regex:/([- ,\/0-9a-zA-Z]+)/',
            'register_office_phone'     =>  'required|numeric|digits:10',
            'register_office_email'     =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            // 'manufacturer_brand_logo'   =>  'required_if:step1,0|mimes:jpg,png,jpeg|max:1000',                
            'com_address'               =>  'required|string|regex:/([- ,\/0-9a-zA-Z]+)/',
            'com_phone'                 =>  'required|numeric|digits:10',
            'com_email'                 =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'plant_address'             =>  'required|string|regex:/([- ,\/0-9a-zA-Z]+)/',
            'plant_phone'               =>  'required|numeric|digits:10',
            'plant_email'               =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'plant_latitude'            =>  'required',
            'plant_longitude'           =>  'required',
            // 'address_type'              =>  'required',
            'gps_latitude'              =>  'required|in:north,south',
            'gps_longitude'             =>  'required|in:east,west',
            'country'                   =>  'required',
            'reg_country'               =>  'required',
            'com_country'               =>  'required',
            // 'is_sez'                    =>  'required_if:country,99',
            // 'contact_person_name'       =>  'required|string|regex:/^[a-zA-Z ]*$/|max:90',
            // 'person_designation'        =>  'required|string|regex:/^[a-zA-Z ]*$/|max:90',
            'person_contact_no'         =>  'required|numeric|digits:10',
            'person_email'              =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'authorize_name'            =>  'required|string|regex:/^[a-zA-Z ]*$/|max:90',
            'authorize_designation'     =>  'required|string|max:90',
            'authorize_letter'          =>  'required_if:step1,0|mimes:pdf|max:2000',

            // 'gst_document'              =>  $gst_document,
            // 'gst_number'                =>  $gst_number,
            
            // 'manufacturing_capacity'    =>  'required',
            'certificate_incorporation' =>  'required_if:step1,0|mimes:pdf|max:1000',
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
            'com_email.required' => 'Communication Email is required.',
            'plant_address.required' => 'Manufacturing Plant Address is required.',
            'plant_phone.required' => 'Contact Number is required.',
            'plant_phone.digits:10' => 'The mobile number must be 10 digits.',
            'plant_email.required' => 'Email address is required.',
            'authorize_letter.max' =>'Authorize letter should not be greater than 1MB',
            'reg_country.required'  =>  'Country field is required',
            'com_country.required'     =>  'Country field is required',
            // 'is_sez.required_if'       =>  'This field is required',
            'gst_document.required_if' => 'GST Document is required ',
            'gst_number.required_if' => 'GST Number is required ',
            'plant_latitude.regex' => 'Wrong latitude format. Latitude should be in the format XX.XXXXXX',
            'plant_longitude.regex' => 'Wrong longitude format. Longitude should be in the format XX.XXXXXX',
        ]

       ); 
       if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }
    
    public function validateNewApplicationStepTwo($request, $required = NULL)
    {   $validation = Validator::make($request->all(), [
            'manufacturing_capacity'    =>  'required',
            //'technology.*'              =>  'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
            //'no_pv_models.*'            =>  'required|integer',
            //'pmax.*'                    =>  'required',

        ]
        // [
        //     'technology.*'=>'Please enter Technology Details',
        //     'technology.regex.*'=>'Invalid Format',
        //     'no_pv_models.*'=>'Please enter No. of Main PV Models Applied',
        //     'pmax.*'=>'Please enter Highest Pmax (in Wp)'
        // ]
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
            // 'system_voltage.*'=>'Please enter System Voltage (VDC)',
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
                    // 'cell_total_no'        =>  'required',
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
                    // 'cell_total_no'        =>'This field is required ',
                    'cell_min_efficiency'    =>'This field is required ',
                    'cell_max_efficiency'       =>'This field is required ',
                    'cell_min_wattage'        =>'This field is required ',
                    'cell_max_wattage'   =>'This field is required ',
                    'cell_demension_one'       =>'This field is required ',
                    'cell_demension_two'        =>'This field is required ',
                    'cell_total_bus'   =>'This field is required ',
                ]
            );
            
        // }else if($sub_annexure_type==5){
        //     $validation = Validator::make($request->all(), [
        //             'module_length.*'   =>  'required',
        //             'module_breadth.*'  =>  'required',
        //             'module_area.*'     =>  'required',
        //             'module_weight.*'   =>  'required',
    
        //         ],
        //         [
        //             'module_length.*'   =>'This field is required ',
        //             'module_breadth.*'  =>'This field is required ',
        //             'module_area.*'     =>'This field is required ',
        //             'module_weight.*'   =>'This field is required ',
        //         ]
        //     );
        // }else if($sub_annexure_type==6){
        //     $validation = Validator::make($request->all(), [
        //             'cell_technology.*'  =>  'required',
        //             'cell_efficiency.*'  =>  'required',
        //             'cell_wattage.*'     =>  'required',
        //             'cell_dimension.*'   =>  'required',
        //             'cell_type.*'        =>  'required',
        //             'cell_total_no.*'    =>  'required',
        //             'cell_total_bus.*'   =>  'required',
    
        //         ],
        //         [
        //             'cell_technology.*'  =>'This field is required ',
        //             'cell_efficiency.*'  =>'This field is required ',
        //             'cell_wattage.*'     =>'This field is required ',
        //             'cell_dimension.*'   =>'This field is required ',
        //             'cell_type.*'        =>'This field is required ',
        //             'cell_total_no.*'    =>'This field is required ',
        //             'cell_total_bus.*'   =>'This field is required ',
        //         ]
        //     );
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
                    // 'bis_certificate_no.*'     =>  'required',
                    'bis_certificate_no' => ['required', 'digits:8'],
                    'bis_certificate_issue.*'  =>  'required',
                    'bis_certificate_valid.*'  =>  'required',
                    'bis_certificate'           =>  'required|max:2048|mimes:pdf',
    
                ],
                [
                    'bis_certificate.required' => 'Please upload Certificate',
                    'bis_certificate.mimes' => 'Only pdf are allowed',
                    'bis_certificate.max' => 'Sorry! Maximum allowed size for an pdf is 2MB',
                    // 'bis_certificate_no.*.required' => 'This field is required',
                    'bis_certificate_no.required' => 'The BIS certificate number is required.',
                    'bis_certificate_no.digits' => 'The BIS certificate number must be exactly 8 digits.',
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
    
    public function validateAnnexureFourOfThree($request, $subAnnexureType)
    {   
        if($subAnnexureType==51){
            $validation = Validator::make($request->all(), [
                    'whether_enlisted.*'     =>  'required',

                ],
                [
                    'whether_enlisted.required' => 'Please upload Certificate',
                ]
            );
        }else if($subAnnexureType==5200){
            $validation = Validator::make($request->all(), [
                    'name_of_company.*'       =>  'required',  
                    'coll_address.*'          =>  'required',  
                    'collab_phone.*'          =>  'required|numeric|digits:10',  
                    'collab_email.*'          =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            ],
            [
                'name_of_company.*'         =>'This field is required ',
                'coll_address.*'            =>'This field is required ',
                'collab_phone.*'            =>'This field is required ',
                'collab_email.*'            =>'This field is required ',
                ]);

            }else if($subAnnexureType==53){
                $validation = Validator::make($request->all(), [
                 'ind_territory.*'        =>  'required',
             ],
             [
                 'ind_territory.*'             =>'This field is required ',
                 ]
             );
            }else if($subAnnexureType==54){
                $validation = Validator::make($request->all(), [
                 'ownership_right.*'        =>  'required',
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


    public function validateAnnexureFourOfFour($request, $subAnnexureType)
    {   
        if($subAnnexureType==11){
            $validation = Validator::make($request->all(), [
                    // 'cert_ attach_no.*'             =>  'required',
                    'type_certificate_issue.*'     =>  'required',
                    'type_certificate_valid.*'     =>  'required',
                    'new_certificate'            =>  'required|max:2048|mimes:pdf',

                ],
                [
                    // 'cert_attach_no.required' => 'Please upload Certificate',
                    'type_certificate_issue.required' => 'Please upload Certificate',
                    'type_certificate_valid.required' => 'Please upload Certificate',
                    'new_certificate.required' => 'Please upload Certificate',
                ]
            );
        }else if($subAnnexureType==12){
            $validation = Validator::make($request->all(), [
                    'type_certificate_scheme.*'       =>  'required',  
                    'type_certificate_pro.*'          =>  'required',  
                    'compliance_attach'          =>  'required',  
            ],
            [
                'type_certificate_scheme.*'             =>'This field is required ',
                'type_certificate_pro.*'          =>'This field is required ',
                'compliance_attach'            =>'This field is required ',
                ]);

            }else if($subAnnexureType==13){
                $validation = Validator::make($request->all(), [
                 'certification_body.*'        =>  'required',
                 'certification_body.*'        =>  'required',
             ],
             [
                 'certification_body.*'             =>'This field is required ',

                 ]
             );
            }else if($subAnnexureType==14){
                $validation = Validator::make($request->all(), [
                 'certify_body_name.*'         =>  'required',
                 'certify_body_address.*'      =>  'required',
                 'certify_body_phone.*'        =>  'required|numeric|digits:10',
                 'certify_body_email.*'        =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
             ],
             [
                 'certify_body_name.*'             =>'This field is required ',
                 'certify_body_address.*'             =>'This field is required ',
                 'certify_body_phone.*'             =>'This field is required ',
                 'certify_body_email.*'             =>'This field is required ',
                 ]
             );
            }else if($subAnnexureType==15){
                $validation = Validator::make($request->all(), [
                 'accred_body_name.*'         =>  'required',
                 'accred_body_address.*'      =>  'required',
                 'accred_body_phone.*'        =>  'required|numeric|digits:10',
                 'accred_body_email.*'        =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
             ],
             [
                 'accred_body_name.*'             =>'This field is required ',
                 'accred_body_address.*'             =>'This field is required ',
                 'accred_body_phone.*'             =>'This field is required ',
                 'accred_body_email.*'             =>'This field is required ',
                 ]
             );

            }else if($subAnnexureType==16){
                $validation = Validator::make($request->all(), [
                 'accred_body_valid_upto.*'        =>  'required',
                //  'accred_body_cert_no.*'        =>  'required',
                 'accred_body_attach'        =>  'required',
        
             ],
             [
                 'accred_body_valid_upto.*'             =>'This field is required ',
                //  'accred_body_cert_no.*'             =>'This field is required ',
                 'accred_body_attach'             =>'This field is required ',
               
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
                  //  'location_assembly.*'     =>  'required',
                        'installed_manufacturing_capacity'     =>  'required|numeric',
                        'production_date'     =>  'required',
                        'calibration_certificate'     =>  'required',
                    ],
                    [
               //         'location_assembly.required' => 'Please upload Certificate',
                        'calibration_certificate.required' => 'Please upload Certificate',
                ]);
                }else if($subAnnexureType==702){
           //     if($request->iso_certificate[0]=="yes"){
                $validation = Validator::make($request->all(), [
                    
                // 'iso_certificate.*'        =>  'required',
        //        'issuing_agency.*'            =>  'required',
          //      'certificate_validate.*'      =>  'required',
                'iso_certificate_doc'         =>  'required',
            
                ],
                [
                // 'iso_certificate.*'        =>'This field is required ',
        //        'issuing_agency.*'            =>'This field is required ',
       //         'certificate_validate.*'      =>'This field is required ',
                'iso_certificate_doc'         =>'This field is required ',
                ]);
      /*      }else{
                $validation = Validator::make($request->all(), [
                
                ]);
            }  */

            }else if($subAnnexureType==703){
                $validation = Validator::make($request->all(), [
                'iso_name_body.*'       =>  'required',
                'iso_address_body.*'        =>  'required',
                'iso_phone_body.*'          =>  'required|numeric|digits:10',
                'iso_email_body.*'        =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                ],
                [
                'iso_name_body.*'           =>'This field is required ',
                'iso_address_body.*'            =>'This field is required ',
                'iso_phone_body.*'              =>'This field is required ',
                'iso_email_body.*'      =>'This field is required ',
                ]);
            }else if($subAnnexureType==704){
                $validation = Validator::make($request->all(), [
                'accred_date.*'       =>  'required',
                // 'accred_no.*'        =>  'required',
                'accred_cert_doc'          =>  'required',
               
                ],
                [
                'accred_date.*'           =>'This field is required ',
                // 'accred_no.*'            =>'This field is required ',
                'accred_cert_doc'             =>'This field is required ',
                
                ]);
            }else if($subAnnexureType==705){
                $validation = Validator::make($request->all(), [
                'mfp_capacity.*'       =>  'required',
                'mfp_attach_doc'        =>  'required',
                ],
                [
                'mfp_capacity.*'           =>'This field is required ',
                'mfp_attach_doc'            =>'This field is required ',
                ]);
            }else if($subAnnexureType==706){
                $validation = Validator::make($request->all(), [
                'raw_mtrl_docs'       =>  'required',
                'details_sales_docs'        =>  'required',
                ],
                [
                'raw_mtrl_docs'           =>'This field is required ',
                'details_sales_docs'            =>'This field is required ',
                ]);
            }else if($subAnnexureType==707){
                $validation = Validator::make($request->all(), [
                'profit_loss_docs'          =>  'required',
                'statement_assests_docs'    =>  'required',
                'balance_sheet_docs'        =>  'required',
                ],
                [
                'profit_loss_docs'           =>'This field is required ',
                'statement_assests_docs'     =>'This field is required ',
                'balance_sheet_docs'         =>'This field is required ',
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
    public function validateAnnexureSix($request, $required = NULL)
    {   //|regex:/(^[-0-9A-Za-z.,\/ ]+$)/
        $validation = Validator::make($request->all(), [
            'name_of_company'       =>  'required|string|max:70',
            'country'               =>  'required',
            'address'               =>  'required|string|max:300',
            'whether_enlisted'      =>  'required',
            'noofpv_models'         =>  'required',
            'manufacturing_capacity'=>  'required',

        ]);
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }
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

    public function validateApplicationPayment($request){
        $validation = Validator::make($request->all(), [
            'transaction_number'    =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:50',
            'transaction_date'      =>  'required|date',
            'amt_paid'             =>  'required',
            'bank_name'             =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:300',
            'transaction_receipt'   =>  'required|file|mimes:pdf|max:1024',
        ]);
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }

    public function validateInspectionPayment($request){
        $validation = Validator::make($request->all(), [
            'insp_transaction_no'    =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:50',
            'insp_transaction_date'      =>  'required|date',
            'insp_bank_name'             =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:300',
            'insp_transaction_receipt'   =>  'required|file|mimes:pdf|max:1024',
            'insp_amt_paid'              =>  'required',
        ]);
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }

    public function validateFinalSubmission($request){
        $validation = Validator::make($request->all(), [
            'signatory_document'       => 'required|file|mimes:pdf|max:10192',
            'indemnity_document'       => 'required|file|mimes:pdf|max:10192',
            'declaration'              => 'required',
            'affidavit'                => 'required',
            'indemnity'                => 'required'
        ],
        [
            'attc_iso_certificate.mimes' => "Please upload PDF file only",
            'attc_iso_certificate.max' => "Maximum file size to upload is 10MB (10192 KB).",
            'declaration.required'  =>  'Please check declaration'
        ]);
        if($validation->fails())
            return array('status'=>'error','message'=>$validation->errors());
        return array('status'=>'success','message'=>'');
    }

    
    public function validateInspectionReportForm($request){
        $validation = Validator::make($request->all(), [
            'inspection_report'    =>  'required|max:10240|mimes:pdf',

        ],
        [
            'inspection_report.required'=>'Please select file.',
            'inspection_report.max'=>'Maximun allowed file is 10MB',
            'inspection_report.mimes'=>'Only PDF file allowed',
        ]
        );
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