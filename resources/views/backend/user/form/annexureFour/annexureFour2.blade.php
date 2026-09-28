@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Type Certification Details (if exempted from BIS Registration / Certification)')
@section('content')
@php $docBaseUrl ='users/preview-docs/Annexure/';
@endphp

<style>
     .comn_drop_shdow{border: 1px solid #dedede;
    background: #ffffff;
    border-radius: 0px 0px 8px 8px;
    box-shadow: 0 0 5px #dedede;}
    .table_max_height{max-height:350px; overflow:auto}
 
        .tab_desgn ul li {
            background: #f1f1f1;
            /* border-right: 1px solid #d1d1d1; */

            height: 80px;
            position: relative;
        }

        .tab_desgn ul li:last-child {
            border-right: none;
            ;
        }

        .tab_desgn ul li a {
            /* position: relative; */
            background-color: #0d6efd00 !important;
            color: #777777 !important;
            font-weight: 600;
            text-transform: uppercase;
            padding: 0;
            margin: 0;
            border-radius: 0 !important;

            text-align: center;
            padding: 15px 0;
            background-color: #eee;
            box-shadow: 0 0 0 1px #ddd;
            top: 15px;
            transition: top .2s;
            height: 100%;border-top: 1px solid #49be80!important;
        }

        .tab_desgn ul li a div {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding-top: 20px;
        }

        .tab_desgn ul li a.active {
            /* position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            
            color: #2754db !important;
            font-weight: 600;
            text-transform: uppercase;
            border: 1px solid #dedede;
             */
            border-radius: 0;
            border-bottom: 0;
            background-color: #ffffff !important;
            background: #fff;
            box-shadow: 1px 1px 0 1px #fff, 0 0px 0 1px #ddd, -1px 1px 0 0px #ddd inset;
            padding-bottom: 30px;
            border-top: 1px solid #49be80;
        }

        .arrow-down {
            display: none;
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 22px solid #49be80;
            position: absolute;
            top: -1px;
            left: calc(50% - 20px);
        }

        .arrow-down-inner {
            display: none;
            width: 0;
            height: 0;
            border-left: 18px solid transparent;
            border-right: 18px solid transparent;
            border-top: 12px solid #fff;
            position: absolute;
            top: -1px;
            left: 38.4%;
        }

        .tab_desgn ul li a.active .arrow-down {
            display: block !important;
        }

        .tab_desgn ul li a.active .arrow-down-inner {
            display: block !important;
        }

        .tab_desgn .tab-content {
            border: 1px solid #dedede;
            border-top: none;

        }

        .tab_desgn ul li a.active div {
            color: #4d72c7;
        }
    </style>

<div class="container-fluid tab_desgn ">
<!-- Nav pills -->
<ul class="nav nav-pills nav-justified" role="tablist">

<li class="nav-item">
    <a class="nav-link " href="{{ URL::to('users/module-master/'  .$general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div>Solar PV Modules <br> 3.0</div>
    </a>
    </li>

    <li class="nav-item">

    <a class="nav-link " href="{{ URL::to('users/annexure-one/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> Module <br> 3.1-3.3</div>
</a>

    </li>

    <li class="nav-item">

        <a class="nav-link " href="{{ URL::to('users/annexure-one-b/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> Module <br>3.4-3.5</div>
</a>

    </li>
    <li class="nav-item">

        <a class="nav-link" href="{{ URL::to('users/annexure-one-c/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> Module <br>3.6-3.10</div>
</a>

        </li>
    <li class="nav-item">

        <a class="nav-link" href="{{ URL::to('users/annexure-three/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> 4.Bis Registration</div>
</a>

    </li>
    <li class="nav-item">

        <a class="nav-link" href="{{ URL::to('users/annexure-four/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> 5.Collaboration </div>
</a>

    </li>
    <li class="nav-item">
	
	<a class="nav-link active" href="{{ URL::to('users/annexure-four-two/' . $general->encodeid($application_id)) }}">
		<p class="arrow-down">
			<p class="arrow-down-inner"></p>
		</p>
		<div> 6.Type Certificate Details </div>
	</a>

    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-four-three/' . $general->encodeid($application_id)) }}">
		<p class="arrow-down">
			<p class="arrow-down-inner"></p>
		</p>
		<div>7.Manufacturing Facility</div>
	</a>
    </li>
	
    <li class="nav-item">

        <a class="nav-link"  href="{{ URL::to('users/application-fees/' . $general->encodeid($application_id)) }}">
            <p class="arrow-down">
                <p class="arrow-down-inner"></p>
            </p>
            <div>8-9. Fee</div>
        </a>
    </li>
   
    <li class="nav-item">
        <a class="nav-link"  href="{{ URL::to('users/application-submission/' .$general->encodeid($application_id)) }}">
            <p class="arrow-down">
                <p class="arrow-down-inner"></p>
            </p>
            <div>10.Affidavit & Indemnity</div>
        </a>
    </li>
</ul>
</div>

<div class="row" style="padding:0 10px">
    @include('backend.user.form._stepper')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="comn_drop_shdow">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box-body">

                            <form action="{{ URL::to('/users/annexure-four-two')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                    <tr>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td colspan="4" class="bg-primary text-light">
                                                        @if(($annexuredata->subAnnexureType ?? '')==11)
                                                        6.0 Type Certification Details
                                                         @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="20%">Module Technology</th>
                                                    <td class="text-primary">{{$annexuredata->module_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="15%">Mean Wattage and application Range of Wattage</th>
                                                    <td class="text-primary">{{$annexuredata->applicable_model_covered ?? ''}}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <span id="detail_type_11"
                                                    style="display:@if(($annexuredata->subAnnexureType ?? '')==11))  @else none @endif">
                                                     <!-- 6.0 - 6.5 Input part BIS Registration -->
                                                <table class="table text-center">
                                                        <tr>
                                                            <th>Type Certificate No<small class="text-danger"> * </small></th>
                                                            <th>Type Certificate issue date<small class="text-danger"> * </small></th>
                                                            <th>Type Certificate Valid Upto<small class="text-danger"> * </small></th>
                                                        </tr>

                                                        @if(!Empty($annexuredata) && $annexuredata->subAnnexureType==11)
                                                       
                                                        <tr>
                                                            <td>
                                                                <div class="col-md-12"><?php //echo $annexuredata->cert_attach_no; ?>
                                                                <?php 
                                                                   
                                                                    ?>
                                                                    <input type="number" name="cert_attach_no[]"
                                                                        id="cert_attach_no_" placeholder="Enter Certificate No."
                                                                        value="{{ $annexuredata->annexure[0]['cert_attach_no'] ?? '' }}" >
                                                                        <!-- value="{{ isset($annexuredata->annexure[0]['cert_attach_no']) ? $annexuredata->annexure[0]['cert_attach_no'] : '' }}" -->
                                                                </div>
                                                            </td>
                                                            <td>
                                                                    <div class="col-md-12">
                                                                        <input type="date" name="type_certificate_issue[]"
                                                                            placeholder="Type Certificate issue date"
                                                                            id="type_certificate_issue_"
                                                                            class="form-control data- bcd_type_certificate_issue"
                                                                            maxlength="70"  max="{{ date('Y-m-d') }}"
                                                                            value="{{ $annexuredata->annexure[0]['type_certificate_issue'] ?? '' }}"
                                                                            
                                                                            onchange="validateDates()">
                                                                        <i name="type_certificate_issue."></i>
                                                                    </div>
                                                            </td>
                                                            <td class="text-left">
                                                                    <div class="col-md-12">
                                                                        <input type="date" name="type_certificate_valid[]"
                                                                            placeholder="Type Certificate issue date"
                                                                            id="type_certificate_valid_"
                                                                            class="form-control data- bcd_type_certificate_valid"
                                                                            maxlength="70" min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                                                            value="{{ $annexuredata->annexure[0]['type_certificate_valid'] ?? '' }}">
                                                                        <i name="type_certificate_valid."></i>
                                                                        
                                                                    </div>
                                                                </td>
                                                        </tr>
                                                        @endif   

                                                        <tr>   
                                                            <td colspan="6" class="text-left">
                                                                <div class="col-md-6">
                                                                    <label for="">Type Certificate <span class="text-danger">*</span> <i class="text-danger">Note: Please upload all certificates in one PDF (Max. size allowed 2MB)</i></label>
                                                                    <input type="file" name="new_certificate" id="new_certificate" class="form-control pdf_file_2mb">

                                                                    @if(($annexuredata->new_certificate ?? '') != null)
                                                                    <input type="hidden" name="old_new_certificate" id="">
                                                                    <small><a target="_blank" href="{{URL::to($docBaseUrl.$annexuredata->new_certificate)}}" class="document">View Certificate</a></small>@endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                     
                                                </table>
                                                </span>
                                            </div>
                                    
                                            <div class="row">
                                                <span id="detail_type_12"
                                                    style="display:@if(($annexuredata->subAnnexureType ?? '')==12))  @else none @endif">
                                                    
                                                     <!-- 6.6 Type Certificate -->
                                                    <table class="table text-center">
                                                        <!-- <tr>
                                                            <th>Type Certificate & Documents</th>
                                                        </tr> -->
                                                        @if(!Empty($annexuredata)  && $annexuredata->subAnnexureType==12)
                                                       <tr>
                                                            <td>
                                                                <div class="col-md-6">
                                                                <label for="type_certificate_scheme"><strong>Type Certificate Scheme </strong><span class="text-danger">*</span> </label>
                                                                    <select name="type_certificate_scheme[]" id="type_certificate_scheme_" class="form-control">
                                                                        <option value="">Select Certificate Scheme</option>
                                                                        <option value="iec" @if(isset($annexuredata->type_certificate_scheme)
                                                                        &&
                                                                        $annexuredata->type_certificate_scheme=="iec")selected @endif>IEC</option>
                                        
                                                                        <option value="other" @if(isset($annexuredata->type_certificate_scheme)
                                                                        &&
                                                                        $annexuredata->type_certificate_scheme=="other")selected @endif>Any Other</option>
                                                                    </select>
                                                                    <div id="other-field-container" class="hidden">
                                                                        <label for="other-field">Please specify:</label>
                                                                        <input type="text" id="other-field" name="other-field" class="form-control">
                                                                    </div>
       
                                                                </div>
                                                            </td>  
                                                          
                                                            
                                                            <td>
                                                                <div class="col-md-6">
                                                                <label for="type_certificate_pro"><strong>Type Certificate </strong><span class="text-danger">*</span></label>
                                                                <select name="type_certificate_pro[]" id="type_certificate_pro_" class="form-control">
                                                                    <option value="">Select Type Certificate</option>
                                                                    <option value="type"  
                                                                        @if(isset($annexuredata->type_certificate_pro) && $annexuredata->type_certificate_pro == "type") selected @endif>
                                                                        Type
                                                                    </option>
                                                                    <option value="provisional" 
                                                                        @if(isset($annexuredata->type_certificate_pro) && $annexuredata->type_certificate_pro == "provisional") selected @endif>
                                                                        Provisional
                                                                    </option>
                                                                </select>
                                                               
                                                                </div>
                                                            </td> 
                                                             
                                                        @endif   
                                                    
                                                        <tr>
                                                        <td colspan="6" class="text-left">
                                                            <div class="col-md-6">
                                                                <label for="">Documents(Conformity of Statement/ Statement of Compliance, Final Evaluation Report and Certified Power/ I-V Curve) <span class="text-danger">*</span><br> <i class="text-danger">Note: Please upload all certificates in one PDF (Max. size allowed 2MB)</i></label>
                                                                <input type="file" name="compliance_attach" id="compliance_attach" class="form-control pdf_file_2mb">

                                                                @if(($annexuredata->compliance_attach ?? '') != null)
                                                                <input type="hidden" name="old_compliance_attach" id="">
                                                                <small><a target="_blank" href="{{URL::to($docBaseUrl.$annexuredata->compliance_attach)}}" class="document">View Documents</a></small>@endif
                                                            </div>
                                                         </td>
                                                        </tr>

                                                    </table>
                                                </span>
                                            </div>
                                        
                                            <div class="row">
                                                <span id="detail_type_13"
                                                    style="display:@if(($annexuredata->subAnnexureType ?? '')==13))  @else none @endif">
                                                     <!-- 6.9 Name of Cartification Body -->
                                                     <table class="table text-center">
                                                        @if(!empty($annexuredata) && $annexuredata->subAnnexureType == 13)
                                                        <tr>
                                                            <td>
                                                                <div class="col-md-6">
                                                                    <label for="certification_body"><strong>Name of Certification Body</strong> <span class="text-danger">*</span></label>
                                                                    <select name="certification_body" id="certification_body" class="form-control" onchange="toggleAnyOtherField()" required>
                                                                        <option value="">Select Certification Body</option>
                                                                        <option value="nise" @if(isset($annexuredata->nise_certificate_body) && $annexuredata->nise_certificate_body == "nise") selected @endif>NISE</option>
                                                                        <option value="ul" @if(isset($annexuredata->nise_certificate_body) && $annexuredata->nise_certificate_body == "ul") selected @endif>UL</option>
                                                                        <option value="tuv" @if(isset($annexuredata->tuv_certificate_body) && $annexuredata->tuv_certificate_body == "tuv") selected @endif>TUV</option>
                                                                        <option value="anyother" @if(isset($annexuredata->nise_certificate_body) && $annexuredata->nise_certificate_body == "anyother") selected @endif>Any Other</option>
                                                                    </select>

                                                                    <div id="anyother_field-container" class="@if(isset($annexuredata->nise_certificate_body) && $annexuredata->nise_certificate_body == 'anyother') @else hidden @endif">
                                                                        <label for="anyother_field">Please specify:</label>
                                                                        <input type="text" id="anyother_field" name="anyother_field" class="form-control" value="{{ old('anyother_field', $annexuredata->anyother_field ?? '') }}">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    </table>
                                                </span>
                                            </div>
                                        
                                            <div class="row">
                                                <span id="detail_type_14"
                                                    style="display:@if(($annexuredata->subAnnexureType ?? '')==14))  @else none @endif">
                                                     <!-- 6.10 Certifying Body Details -->
                                                     <table class="table text-center">
                                                        <tr>
                                                            <th colspan="4" style="text-align: center;">Certifying Body Details</th>
                                                        </tr>

                                                        @if(!Empty($annexuredata)  && $annexuredata->subAnnexureType==14)
                                                        <tr>
                                                        <tr>
                                                        
                                                            <th>Name<small class="text-danger"> * </small></th>
                                                            <th>Address<small class="text-danger"> * </small></th>
                                                            <th>Phone<small class="text-danger"> * </small></th>
                                                            <th>Email<small class="text-danger"> * </small><br> 
                                                            </th>
 
                                                        </tr>
                                                       
                                                        <tr>
                                                            <td><input type="text" name="certify_body_name[]"
                                                                    placeholder="Name"
                                                                    id="certify_body_name_"
                                                                    class="form-control data- mtr_certify_body_name"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata->annexure[0]['certify_body_name'] ?? '' }}">
                                                                    
                                                                <i name="certify_body_name."></i>
                                                            </td>
                                                            <td><input type="text" name="certify_body_address[]"
                                                                    placeholder="Address"
                                                                    id="certify_body_address_"
                                                                    class="form-control data- mtr_certify_body_address"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata->annexure[0]['certify_body_address'] ?? '' }}">
                                                                    
                                                                <i name="certify_body_address."></i>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="certify_body_phone[]"
                                                                        placeholder="Phone"
                                                                        id="certify_body_phone_"
                                                                        class="form-control data- mtr_ certify_body_phone"
                                                                        maxlength="10"
                                                                        value="{{ $annexuredata->annexure[0]['certify_body_phone'] ?? '' }}"
                                                                        >
                                                                    <i name="certify_body_phone."></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="certify_body_email[]"
                                                                        placeholder="Email"
                                                                        id="certify_body_email_"
                                                                        class="form-control data- mtr_certify_body_email"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata->annexure[0]['certify_body_email'] ?? '' }}" >
                                                                    <i name="certify_body_email."></i>
                                                                </div>
                                                            </td>
                                                           
                                                                </div>
                                                            </td>
                                                        </tr>

                                                       
                                                        @endif
                                                        
                                                    </table>
                                                </span>
                                               </div>
                                             
                                              <div class="row">
                                                <span id="detail_type_15"
                                                    style="display:@if(($annexuredata->subAnnexureType ?? '')==15))  @else none @endif">
                                                     <!-- 6.11 Accreditation Body Details -->
                                                     <table class="table text-center">
                                                        <tr>
                                                            <th colspan="4" style="text-align: center;">6.11 Accreditation Body Details</th>
                                                        </tr>
                                                        @if(!Empty($annexuredata)  && $annexuredata->subAnnexureType==15)
                                                        <tr>
                                                        <tr>
                                                        
                                                            <th>Name<small class="text-danger"> * </small></th>
                                                            <th>Address<small class="text-danger"> * </small></th>
                                                            <th>Phone<small class="text-danger"> * </small></th>
                                                            <th>Email<small class="text-danger"> * </small><br> 
                                                            </th>
 
                                                        </tr>
                                                       
                                                        <tr>
                                                            <td><input type="text" name="accred_body_name[]"
                                                                    placeholder="Name"
                                                                    id="accred_body_name_"
                                                                    class="form-control data- mtr_accred_body_name"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata->annexure[0]['accred_body_name'] ?? '' }}">
                                                                    
                                                                <i name="accred_body_name."></i>
                                                            </td>
                                                            <td><input type="text" name="accred_body_address[]"
                                                                    placeholder="Address"
                                                                    id="accred_body_address_"
                                                                    class="form-control data- mtr_accred_body_address"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata->annexure[0]['accred_body_address'] ?? '' }}">
                                                                    
                                                                <i name="accred_body_address."></i>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="accred_body_phone[]"
                                                                        placeholder="Phone"
                                                                        id="accred_body_phone_"
                                                                        class="form-control data- mtr_ accred_body_phone"
                                                                        maxlength="10"
                                                                        value="{{ $annexuredata->annexure[0]['accred_body_phone'] ?? '' }}"
                                                                        >
                                                                    <i name="accred_body_phone."></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="accred_body_email[]"
                                                                        placeholder="Email"
                                                                        id="accred_body_email_"
                                                                        class="form-control data- mtr_accred_body_email"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata->annexure[0]['accred_body_email'] ?? '' }}" >
                                                                    <i name="accred_body_email."></i>
                                                                </div>
                                                            </td>
                                                           
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        @endif

                                                    </table>
                                                </span>
                                            </div>
                                             
                                            <div class="row">
                                                <span id="detail_type_16"
                                                    style="display:@if(($annexuredata->subAnnexureType ?? '')==16))  @else none @endif">
                                                     <!-- 6.12 Accreditation Attachment Details -->
                                                     <table class="table text-center">
                                                        <tr>
                                                           <th style="text-align: left;">Accreditation Valid upto<small class="text-danger"> * </small></th>

                                                            <!-- <th>Attachment Certificate No<small class="text-danger"> * </small></th> -->
                                                           
                                                        </tr>
                                                        @if(!Empty($annexuredata) && $annexuredata->subAnnexureType==16)
                                                        
                                                        <tr>
                                                        <td class="text-left">
                                                            <div class="col-md-6">
                                                                <input type="date" name="accred_body_valid_upto[]" 
                                                                    placeholder="Accreditation date"
                                                                    id="accred_body_valid_upto_"
                                                                    class="form-control data- bcd_accred_body_valid_upto"
                                                                    maxlength="70"
                                                                    value="{{ $annexuredata->annexure[0]['accred_body_valid_upto'] ?? '' }}"
                                                                    min="{{ date('Y-m-d') }}" 
                                                                    onchange="validateDates()">
                                                                <i name="accred_body_valid_upto."></i>
                                                            </div>
                                                        </td>

                                                            
                                                            <!-- <td>
                                                                <div class="col-md-12">
                                                                    <input type="number" name="accred_body_cert_no[]"
                                                                        placeholder="Accreditation Certificate No."
                                                                        id="accred_body_cert_no_"
                                                                        class="form-control data- bcd_accred_body_cert_no"
                                                                        maxlength="70"
                                                                        value="{{  $annexuredata->annexure[0]['accred_body_cert_no'] ?? '' }}" >
                                                                    <i name="accred_body_cert_no."></i>
                                                                </div>
                                                            </td>    -->
                                                        </tr>
                                                        
                                                        @endif
                                                        <tr>
                                                        <td colspan="6" class="text-left">
                                                            <div class="col-md-6">
                                                                <label for="accred_body_attach">
                                                                    Attach Accreditation Certificate <span class="text-danger">*</span>
                                                                    <i class="text-danger">Note: Please upload all certificates in one PDF (Max. size allowed 2MB)</i>
                                                                </label>
                                                                <input type="file" name="accred_body_attach" id="accred_body_attach" class="form-control pdf_file_2mb">

                                                                @if(isset($annexuredata->doc_accred_body_attach) && $annexuredata->doc_accred_body_attach)
                                                                    <input type="hidden" name="old_accred_body_attach" value="{{ $annexuredata->doc_accred_body_attach }}">
                                                                    <small>
                                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->doc_accred_body_attach) }}" class="document">
                                                                            View Certificate
                                                                        </a>
                                                                    </small>
                                                                @endif
                                                            </div>
                                                        </td>

                                                        </tr>
                                                    </table>
                                                </span>
                                               </div>
                                    </td>
                                </tr>

                                    <tr>
                                        <td>
                                            <button type="submit" name="submit" class="btn btn-success" id="submit">
                                                <i class='bi bi-arrow-bar-up'></i> @if(isset($annexuredata->id) &&
                                                $annexuredata->id !='')Update @else Save @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                            <input type="hidden" name="subAnnexureType" id="subAnnexureType"
                                                value="@if(isset($annexuredata->subAnnexureType)){{$annexuredata->subAnnexureType}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <a href="{{URL::to('users/annexure-four-two/' .$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>
                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <!-- 6.0 BIS Registration view-->
                            <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">6.0 Type Certification Details</th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>6.1 Module Technology</th>
                                        <th>6.2 Mean Wattage and application Range of Wattage</th>
                                       
                                        <th>6.3 Type Certificate No.</th>
                                        <th>6.4 Certificate Issue</th>
                                        <th>6.5 Certificate Valid</th>
                                        <th>Certificate</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1 @endphp
                                    @foreach($appData['type_cert'] as $type_annex)
                                <?php
                               // echo "<pre>";
                               // print_r($type_annex->annexure); die;?>
                                   
                                    <tr>
                                        
                                        <td>{{$i++}}</td>
                                        <td>{{$type_annex->module_name}} - <?php echo $type_annex->other; ?></td>
                                        <td>{{$type_annex->applicable_model_covered}}</td>
                                       
                                        <td>
                                            <table width="100%">
                                                @foreach($type_annex->annexure as $cert_attach_no)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cert_attach_no->cert_attach_no }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            
                                            @if(isset($type_annex->annexure) && ($type_annex->annexure))
                                            <table width="100%">
                                                
                                                @foreach($type_annex->annexure as $type_certificate_issue)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ date("d-m-Y",strtotime($type_certificate_issue->type_certificate_issue)) }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                            @endif
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($type_annex->annexure as $type_certificate_valid)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ date("d-m-Y",strtotime($type_certificate_valid->type_certificate_valid)) }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
       
                                        <td>
                                            @php $new_certificate = $type_annex->annexure->pluck('new_certificate')->first(); @endphp
                                            @if($new_certificate)
                                                <small>
                                                    <a target="_blank" href="{{ URL::to($docBaseUrl . $new_certificate) }}" class="document text-primary">
                                                        <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                    </a>
                                                </small>
                                            @endif
                                        </td>

                                        <td> <a href="{{URL::to('users/annexure-four-two/' .$general->encodeid($type_annex->application_id).'/'.$general->encodeid($type_annex->id).'/11')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <br>
                            <!-- 6.6 - 6.8 BIS Organisation Details view -->
                           
                            <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">6.6 - 6.8 Type Certification Scheme & Documents</th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>6.1 Module Technology</th>
                                        <th>6.2 Mean Wattage and application Range of Wattage</th>
                                        <th>6.6 Type Certification Scheme</th>
                                        <th>6.7 Type Certification </th>
                                        <th>6.8 Upload Documents  </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $j = 1 @endphp
                                    @foreach($appData['iecselect'] as $isec_iec)
                                   
                                <?php
                               //echo "<pre>";
                               //print_r($isec_iec->annexure); die;?>
                                   
                                    <tr>
                                        
                                        <td>{{$j++}}</td>
                                        <td>{{$isec_iec->module_name}} - <?php echo $isec_iec->other; ?></td>
                                        <td>{{$isec_iec->applicable_model_covered}}</td>
                                        <td>
                                        <table width="100%">
                                            @foreach($isec_iec->annexure as $isec_data)
                                            <tr>
                                                <td style="border-bottom:1px solid #ccc;">
                                                    @if($isec_data->type_certificate_scheme == 'other')
                                                        {{ $isec_data->other_field }}
                                                    @else
                                                        {{ $isec_data->type_certificate_scheme }}
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        <td>
                                        <table width="100%">
                                            @foreach($isec_iec->annexure as $type_certificate_pro)
                                            <tr>
                                                <td style="border-bottom:1px solid #ccc;">
                                                    {{ $type_certificate_pro->type_certificate_pro ?? 'N/A' }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        </td>

                                        <td>
                                            <table width="100%">
                                                @php $compliance_attach = ''; @endphp
                                                @foreach($isec_iec->annexure as $compliance_certificate)
                                                    @php $compliance_attach = $compliance_certificate->compliance_attach; @endphp
                                                @endforeach
                                            </table>
                                            @if($compliance_attach != '')
                                            <small><a target="_blank" href="{{URL::to($docBaseUrl.$compliance_attach)}}" class="document text-primary"><i class="bi bi-file-pdf fa-2x text-danger"></i></a></small>@endif
                                        </td>
                                       
                                        <td> <a href="{{URL::to('users/annexure-four-two/' .$general->encodeid($isec_iec->application_id).'/'.$general->encodeid($isec_iec->id).'/12')}}">
                                            Edit <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <br>

                            <!-- 6.9 - Cartification Body  -->
                            <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="9" class="text-left">6.9 Name of Certification Body</th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>6.1 Module Technology</th>
                                        <th>6.2 Mean Wattage and Application Range of Wattage</th>
                                        <th>6.9 Name of Certification Body</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $k = 1 @endphp
                                    @foreach($appData['certificate_body'] as $name_certificate_body)
                              
                                
                                    <tr>
                                        <td>{{$k++}}</td>
                                        <td>{{$name_certificate_body->module_name}} - <?php echo $isec_iec->other; ?></td>
                                        <td>{{$name_certificate_body->applicable_model_covered}}</td>
                                        <td>
                                            <table width="100%">
                                                @if(isset($name_certificate_body) && isset($name_certificate_body->annexure))
                                                <?php //echo "<pre>"; print_r($name_certificate_body); ?>
                                                    @foreach($name_certificate_body->annexure as $item)
                                                   
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                      
                                                            @if( $item->nise_certificate_body=='anyother')
                                                            {{ $item->anyother_field }}
                                                            @else
                                                            {{$item->nise_certificate_body}}
                                                            @endif
                                                           
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="2" style="text-align: center;">No certificate data available.</td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </td>
                                       
                                        <td>
                                            <a href="{{URL::to('users/annexure-four-two/' . $general->encodeid($name_certificate_body->application_id) . '/' . $general->encodeid($name_certificate_body->id) . '/13')}}">
                                                Edit <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>

                            <!-- 6.10 Certifying Body Details view -->
                            <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">6.10 Certifying Body Details</th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Mean Wattage and application Range of Wattage</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $l = 1; @endphp
                                    @foreach($appData['certifying'] as $certifying_item)
                                    @php $check=0; @endphp
                                    <tr>
                                        <td>{{$l++}}</td>
                                        <td>{{$certifying_item->module_name}} - <?php echo $certifying_item->other; ?></td>
                                        <td>{{$certifying_item->applicable_model_covered}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach($certifying_item->annexure as $certify_body_name)
                                                @php $check=1; @endphp
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $certify_body_name->certify_body_name }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($certifying_item->annexure as $certify_body_address)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $certify_body_address->certify_body_address }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($certifying_item->annexure as $certify_body_phone)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $certify_body_phone->certify_body_phone }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($certifying_item->annexure as $certify_body_email)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $certify_body_email->certify_body_email }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    
                                        </td>
                                        <td> <a href="{{URL::to('users/annexure-four-two/'.$general->encodeid($certifying_item->application_id).'/'.$general->encodeid($certifying_item->id).'/14')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table> <br>

                            <!-- 6.11 Accreditation Body Details view -->
                            <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">6.11 Accreditation Body Details</th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Mean Wattage and application Range of Wattage</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $m = 1; @endphp
                                    @foreach($appData['accred_body'] as $accred_item)
                                    @php $check=0; @endphp
                                    <tr>
                                        <td>{{$m++}}</td>
                                        <td>{{$accred_item->module_name}} - <?php echo $accred_item->other; ?> </td>
                                        <td>{{$accred_item->applicable_model_covered}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach($accred_item->annexure as $accred_body_name)
                                                @php $check=1; @endphp
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_body_name->accred_body_name }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($accred_item->annexure as $accred_body_address)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_body_address->accred_body_address }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($accred_item->annexure as $accred_body_phone)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_body_phone->accred_body_phone }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($accred_item->annexure as $accred_body_email)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_body_email->accred_body_email }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    
                                        </td>
                                        <td> <a href="{{URL::to('users/annexure-four-two/'.$general->encodeid($accred_item->application_id).'/'.$general->encodeid($accred_item->id).'/15')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table> <br>
                           
                             <!-- 6.12 Accreditation Body Details view -->
                             <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="10" class=" text-left">6.12 Accreditation</th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>Module Technology</th>
                                        <th>Mean Wattage and application Range of Wattage</th>
                                        <th>Accreditation Valid upto </th>
                                        <th>Attach Accreditation Certificate</th>
                                        <!-- <th>Attachment No.</th> -->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $n = 1 @endphp
                                    @foreach($appData['accred_attach_item'] as $accred_item)
                                    <tr>
                                        <td>{{$n++}}</td>
                                        <td>{{$accred_item->module_name}} - <?php echo $accred_item->other; ?></td>
                                        <td>{{$accred_item->applicable_model_covered}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach($accred_item->annexure as $accred_body_valid_upto)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_body_valid_upto->accred_body_valid_upto }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                          
                                        <td>
                                            <table width="100%">
                                                @php $accred_body_attach = ''; @endphp
                                                @foreach($accred_item->annexure as $doc_accred_body_attach)
                                                    @php $accred_body_attach = $doc_accred_body_attach->accred_body_attach; @endphp
                                                @endforeach
                                            </table>
                                            @if($accred_body_attach != '')
                                                <small>
                                                    <a target="_blank" href="{{ URL::to($docBaseUrl . $accred_body_attach) }}" class="document text-primary">
                                                        <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                    </a>
                                                </small>
                                                @else
                                                <small>No certificate available.</small>
                                            @endif
                                        </td>

                                        <!-- <td>
                                            <table width="100%">
                                                @foreach($accred_item->annexure as $accred_body_cert_no)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_body_cert_no->accred_body_cert_no }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td> -->

                                        <td> <a
                                                href="{{URL::to('users/annexure-four-two/' .$general->encodeid($accred_item->application_id).'/'.$general->encodeid($accred_item->id).'/16')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table><br>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-four/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    
                                    <a href="{{URL::to('users/annexure-four-three/'.$general->encodeid($application_id))}}"
                                        class="btn btn-warning">Next <i class="bi bi-arrow-bar-right"></i></a>
                                  
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.card -->
                </div>

                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <style>
    .max-char {
        position: absolute;

        right: 35px;
        margin-top: -24px;
    }
    </style>
    <script>
        function toggleAnyOtherField() {
            var select = document.getElementById("certification_body");
            var anyOtherFieldContainer = document.getElementById("anyother_field-container");
            
            if (select.value === "anyother") {
                anyOtherFieldContainer.classList.remove("hidden");
            } else {
                anyOtherFieldContainer.classList.add("hidden");
            }
        }

        // Initial check on page load
        document.addEventListener("DOMContentLoaded", function() {
            toggleAnyOtherField();
        });
     </script>
     <style>
        .hidden {
            display: none;
        }
    </style>
    <!-- <script>
    function copydataBCD(id) {

        $('.data-' + id).val('');
        var chk = $('#sameBCD' + id).is(":checked");
        if (chk) {
            $('#bis_certificate_no_' + id).val($('#bis_certificate_no_' + (id - 1)).val());
            $('#bis_certificate_issue_' + id).val($('#bis_certificate_issue_' + (id - 1)).val());
            $('#bis_certificate_valid_' + id).val($('#bis_certificate_valid_' + (id - 1)).val());
        }
    }

    function copydataMTR(id) {

        $('.data-' + id).val('');
        var chk = $('#sameMTR' + id).is(":checked");
        if (chk) {
            $('#test_standard_module_' + id).val($('#test_standard_module_' + (id - 1)).val());
            $('#test_report_no_' + id).val($('#test_report_no_' + (id - 1)).val());
            $('#testing_laboratory_' + id).val($('#testing_laboratory_' + (id - 1)).val());
            $('#testing_laboratory_address_' + id).val($('#testing_laboratory_address_' + (id - 1)).val());
            $('#valid_nabl_certificate_no_' + id).val($('#valid_nabl_certificate_no_' + (id - 1)).val());
        }
    }
    </script> -->

    @endsection
    @push('backend-js')
    <script>
    $(document).ready(function() {
        // 4.1 BIS Certification Details
        $('.bcd_bis_certificate_no').blur(function(e) {
            $('.bcd_bis_certificate_no').val($(this).val());
        });
        $('.bcd_bis_certificate_issue').blur(function(e) {
            $('.bcd_bis_certificate_issue').val($(this).val());
        });
        $('.bcd_bis_certificate_valid').blur(function(e) {
            $('.bcd_bis_certificate_valid').val($(this).val());
        });


        // 4.2 Module Test Reports Details
        $('.mtr_test_standard_module').blur(function(e) {
            $('.mtr_test_standard_module').val($(this).val());
        });
        $('.mtr_test_report_no').blur(function(e) {
            $('.mtr_test_report_no').val($(this).val());
        });
        $('.mtr_testing_laboratory').blur(function(e) {
            $('.mtr_testing_laboratory').val($(this).val());
        });
        $('.mtr_testing_laboratory_address').blur(function(e) {
            $('.mtr_testing_laboratory_address').val($(this).val());
        });
        $('.mtr_valid_nabl_certificate_no').blur(function(e) {
            $('.mtr_valid_nabl_certificate_no').val($(this).val());
        });


    });
    </script>
    
    <script>
    function validateDates(iteration) {
        var issueDate = document.getElementById('bis_certificate_issue_' + iteration).value;
        var validDate = document.getElementById('bis_certificate_valid_' + iteration).value;

        if (issueDate && validDate && issueDate > validDate) {
            alert('BIS Certificate issue date cannot be greater than BIS Certificate Valid date');
            document.getElementById('bis_certificate_issue_' + iteration).value = '';
        }
    }
</script>

<!-- 6.6 - 6.8 Type Certification Scheme & Documents -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('type_certificate_scheme_');
        const otherFieldContainer = document.getElementById('other-field-container');

        select.addEventListener('change', function() {
            if (this.value === 'other') {
                otherFieldContainer.classList.remove('hidden');
            } else {
                otherFieldContainer.classList.add('hidden');
            }
        });

        // Trigger change event on page load if the selected value is 'other'
        if (select.value === 'other') {
            otherFieldContainer.classList.remove('hidden');
        }
    });
</script>

<style>
.hidden {
    display: none;
}
</style>

<style>
.hidden {
    display: none;
}
</style>
    @endpush