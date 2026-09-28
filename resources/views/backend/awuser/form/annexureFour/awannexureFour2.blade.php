@inject('general', 'App\Http\Controllers\Backend\mfft\AwAnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Type Certification Details')
@section('content')
@php $docBaseUrl ='mfft/preview-docs/Annexure/';
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
    img.turbine_orange {
        height: 70px;
        position: absolute;
        top: 8px;
        right: 0;
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
            background-color: #f7941d !important;
            background: #fff;
            box-shadow: 1px 1px 0 1px #fff, 0 0px 0 1px #ddd, -1px 1px 0 0px #ddd inset;
            padding-bottom: 30px;
                
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

        /* .tab_desgn ul li a.active .arrow-down {
            display: block !important;
        } */

        /* .tab_desgn ul li a.active .arrow-down-inner {
            display: block !important;
        } */

        .tab_desgn .tab-content {
            border: 1px solid #dedede;
            border-top: none;

        }

        .tab_desgn ul li a.active div {
            color:rgb(255, 255, 255);
        }
</style>

<div class="container-fluid tab_desgn ">
<!-- Nav pills -->
<ul class="nav nav-pills nav-justified" role="tablist">

<!-- <li class="nav-item">
    <a class="nav-link " href="{{ URL::to('users/module-master/'  .$general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div>Solar PV Modules <br> 3.0</div>
    </a>
    </li> -->

    <!-- <li class="nav-item">

    <a class="nav-link " href="{{ URL::to('users/annexure-one/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> Module <br> 3.1-3.3</div>
    </a>
    </li> -->

    <!-- <li class="nav-item">

        <a class="nav-link " href="{{ URL::to('users/annexure-one-b/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> Module <br>3.4-3.5</div>
</a>

    </li> -->
    <!-- <li class="nav-item">

        <a class="nav-link" href="{{ URL::to('users/annexure-one-c/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> Module <br>3.6-3.10</div>
</a>

        </li> -->
    <!-- <li class="nav-item">

        <a class="nav-link" href="{{ URL::to('users/annexure-three/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> 4.Bis Registration</div>
</a>

    </li> -->
    <li class="nav-item">

        <a class="nav-link" href="{{ URL::to('mfft/annexure-four/' . $general->encodeid($application_id)) }}" style="    background: #009948!important; color: #ffffff !important;">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> 2 .Collaboration </div>
    
</a>
<img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}" >
    </li>
    <li class="nav-item">
	
	<a class="nav-link active" href="{{ URL::to('mfft/annexure-four-two/' . $general->encodeid($application_id)) }}">
		<p class="arrow-down">
			<p class="arrow-down-inner"></p>
		</p>
		<div> 3. Type Certificate Details </div>
	</a>
<img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}" >
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ URL::to('mfft/annexure-four-three/' . $general->encodeid($application_id)) }}">
		<p class="arrow-down">
			<p class="arrow-down-inner"></p>
		</p>
		<div>4. Manufacturing Facility</div>
	</a>
    </li>
	
    <li class="nav-item">

        <a class="nav-link"  href="{{ URL::to('mfft/application-affdt-indt/' . $general->encodeid($application_id)) }}">
            <p class="arrow-down">
                <p class="arrow-down-inner"></p>
            </p>
            <div>5. Affidavit & Indemnity</div>
        </a>
    </li>
   
    <li class="nav-item">
        <a class="nav-link"  href="{{ URL::to('mfft/application-submission/' .$general->encodeid($application_id)) }}">
            <p class="arrow-down">
                <p class="arrow-down-inner"></p>
            </p>
            <div>6. Additional Information</div>
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

                            <form action="{{ URL::to('/mfft/annexure-four-two')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered">
                                    <!-- <tr>
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
                                    </tr> -->
                                    
                                    <tr>
                                        <td>
                                            <div class="row">
                                            <span id="detail_type_11"
                                                
                                                    style="display:@if(($type ?? '')==11))  @else none @endif">
                                                     <!-- 6.0 - 6.5 Input part BIS Registration -->
                                                <table class="table text-center">
                                                        <tr>
                                                            <th>Rated Capacity of the wind turbine (225 KW and above)</th>
                                                            <th>Type Certificate No<small class="text-danger"> * </small></th>
                                                            <th>Type Certificate issue date<small class="text-danger"> * </small></th>
                                                            <th>Type Certificate Valid Upto<small class="text-danger"> * </small></th>
                                                        </tr>
                                                        @if(!Empty($type) && $type==11)
                                                       
                                                        <tr>
                                                            <td>
                                                                <div class="col-md-12"><?php //echo $annexuredata->cert_attach_no; ?>
                                                                <?php 
                                                                   
                                                                    ?>
                                                                    <input type="number" name="wind_turbine_capacity"
                                                                        id="wind_turbine_capacity" placeholder="Rated Capacity of the wind turbine"
                                                                        value="{{ $annexuredata->wind_turbine_capacity ?? '' }}" >
                                                                        <!-- value="{{ isset($annexuredata->annexure[0]['cert_attach_no']) ? $annexuredata->annexure[0]['cert_attach_no'] : '' }}" -->
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12"><?php //echo $annexuredata->cert_attach_no; ?>
                                                                <?php 
                                                                    ?>
                                                                    <input type="number" name="cert_attach_no"
                                                                        id="cert_attach_no" placeholder="Enter Certificate No."
                                                                        value="{{ $annexuredata->cert_attach_no ?? '' }}" >
                                                                        <!-- value="{{ isset($annexuredata->annexure[0]['cert_attach_no']) ? $annexuredata->annexure[0]['cert_attach_no'] : '' }}" -->
                                                                </div>
                                                            </td>
                                                            <td>
                                                                    <div class="col-md-12">
                                                                        <input type="date" name="type_certificate_issue"
                                                                            placeholder="Type Certificate issue date"
                                                                            id="type_certificate_issue"
                                                                            class="form-control data- bcd_type_certificate_issue"
                                                                            maxlength="70"  max="{{ date('Y-m-d') }}"
                                                                            value="{{ $annexuredata->type_certificate_issue ?? '' }}"
                                                                            
                                                                            onchange="validateDates()">
                                                                        <i name="type_certificate_issue."></i>
                                                                    </div>
                                                            </td>
                                                            <td class="text-left">
                                                                    <div class="col-md-12">
                                                                        <input type="date" name="type_certificate_valid"
                                                                            placeholder="Type Certificate issue date"
                                                                            id="type_certificate_valid"
                                                                            class="form-control data- bcd_type_certificate_valid"
                                                                            maxlength="70" min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                                                            value="{{ $annexuredata->type_certificate_valid ?? '' }}">
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
                                                    style="display:@if(($type ?? '')==12))  @else none @endif">
                                                    
                                                     <!-- 6.6 Type Certificate -->
                                                    <table class="table text-center">
                                                        <!-- <tr>
                                                            <th>Type Certificate & Documents</th>
                                                        </tr> -->
                                                        @if(!Empty($type) && $type==12)
                                                       <tr>
                                                            <td>
                                                                <div class="col-md-6">
                                                                    <label for="type_certificate_scheme"><strong>Type Certificate Scheme </strong><span class="text-danger">*</span> </label>
                                                                    <select name="type_certificate_scheme" id="type_certificate_scheme" class="form-control">
                                                                        <option value="">Select Certificate Scheme</option>
                                                                        <option value="is_iec" @if(isset($annexuredata->type_certificate_scheme) && $annexuredata->type_certificate_scheme=="is_iec") selected @endif>IS/IEC</option>
                                                                        <option value="iecre" @if(isset($annexuredata->type_certificate_scheme) && $annexuredata->type_certificate_scheme=="iecre") selected @endif>IECRE</option>
                                                                        <option value="iec" @if(isset($annexuredata->type_certificate_scheme) && $annexuredata->type_certificate_scheme=="iec") selected @endif>IEC</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-6">
                                                                <label for="type_certificate_pro"><strong>Type Certificate </strong><span class="text-danger">*</span></label>
                                                                <select name="type_certificate_pro" id="type_certificate_pro" class="form-control">
                                                                    <option value="">Select Type Certificate</option>
                                                                    <option value="type"  
                                                                        @if(isset($annexuredata->type_certificate_pro) && $annexuredata->type_certificate_pro == "type") selected @endif>
                                                                         Type Certificate
                                                                    </option>
                                                                    <option value="provisional" 
                                                                        @if(isset($annexuredata->type_certificate_pro) && $annexuredata->type_certificate_pro == "provisional") selected @endif>
                                                                        Provisional Type Certificate
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
                                                    style="display:@if(($type ?? '')==13))  @else none @endif">
                                                     <!-- 6.9 Name of Cartification Body -->
                                                    <table class="table text-center">
                                                        @if(!empty($type) && $type == 13)
                                                        <tr>
                                                            <td>
                                                                <div class="col-md-6">
                                                                    <label for="nise_certificate_body"><strong>Name of Certification Body</strong> <span class="text-danger">*</span></label>
                                                                    <select name="nise_certificate_body" id="nise_certificate_body" class="form-control" onchange="toggleAnyOtherField()" required>
                                                                        <option value="">Select Certification Body</option>
                                                                        <option value="niwe" @if(isset($annexuredata->nise_certificate_body) && $annexuredata->nise_certificate_body == "niwe") selected @endif>NIWE</option>
                                                                        <option value="dnv" @if(isset($annexuredata->nise_certificate_body) && $annexuredata->nise_certificate_body == "dnv") selected @endif>DNV</option>
                                                                        <option value="dewi_occ" @if(isset($annexuredata->nise_certificate_body) && $annexuredata->nise_certificate_body == "dewi_occ") selected @endif>DEWI-OCC</option>
                                                                        <option value="tuv_sud" @if(isset($annexuredata->nise_certificate_body) && $annexuredata->nise_certificate_body == "tuv_sud") selected @endif>TUV SUD</option>
                                                                        <option value="tuv_nord" @if(isset($annexuredata->nise_certificate_body) && $annexuredata->nise_certificate_body == "tuv_nord") selected @endif>TUV NORD</option>
                                                                        <option value="tuv_rheinland" @if(isset($annexuredata->nise_certificate_body) && $annexuredata->nise_certificate_body == "tuv_rheinland") selected @endif>TUV RHEINLAND</option>
                                                                        <option value="wind_guard" @if(isset($annexuredata->nise_certificate_body) && $annexuredata->nise_certificate_body == "wind_guard") selected @endif>WIND GUARD</option>
                                                                        <option value="anyother" @if(isset($annexuredata->nise_certificate_body) && $annexuredata->nise_certificate_body == "anyother") selected @endif>Any Other</option>
                                                                    </select>

                                                                    <div id="anyother_field-container" class="@if(isset($annexuredata->nise_certificate_body) && $annexuredata->nise_certificate_body == 'anyother') @else hidden @endif mt-2">
                                                                        <label for="anyother_field">Please specify:</label>
                                                                        <input type="text" id="anyother_field" name="anyother_field" class="form-control"
                                                                            value="{{ old('anyother_field', $annexuredata->anyother_field ?? '') }}">
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
                                                    style="display:@if(($type ?? '')==14))  @else none @endif">
                                                     <!-- 6.12 Accreditation Attachment Details -->
                                                     <table class="table text-center">
                                                        <tr>
                                                           <th>Name of the Accreditation Body<small class="text-danger"> * </small></th>
                                                           <th>Accreditation Valid upto<small class="text-danger"> * </small></th>
                                                           <th>Attachment Certificate <small class="text-danger"> * </small></th>
                                                        </tr>
                                                        @if(!Empty($type) && $type==14)
                                                        
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="certify_body_name"
                                                                    placeholder="Name"
                                                                    id="certify_body_name"
                                                                    class="form-control data- mtr_certify_body_name"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata->certify_body_name ?? '' }}">
                                                            </td> 
                                                            <td>
                                                                <input type="date" name="accred_body_valid_upto" 
                                                                    placeholder="Accreditation date"
                                                                    id="accred_body_valid_upto_"
                                                                    class="form-control data- bcd_accred_body_valid_upto"
                                                                    maxlength="70"
                                                                    value="{{ $annexuredata->annexure[0]['accred_body_valid_upto'] ?? '' }}"
                                                                    min="{{ date('Y-m-d') }}" 
                                                                    onchange="validateDates()"> 
                                                            </td>
                                                            <td style="width:33%;">
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
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    </table>
                                                </span>
                                            </div>

                                            <div class="row">
                                                <span id="detail_type_15"
                                                    style="display:@if(($type ?? '')==15))  @else none @endif">
                                                     <!-- 6.10 Certifying Body Details -->
                                                     <table class="table text-center">
                                                        <tr>
                                                            <th colspan="4" style="text-align: center;">Contact Person of Certification Body</th>
                                                        </tr>
                                                        @if(!Empty($type)  && $type==15)
                                                        <tr>
                                                        <tr>
                                                            <th>Contact Person of Certification Body for authentication of Type Certificate and other related documents<small class="text-danger"> * </small></th>
                                                            <th>Contact details including E-mail of Contact Person for authentication of Type Certificate and other related documents<small class="text-danger"> * </small><br> 
                                                            </th>
 
                                                        </tr>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="certify_body_phone"
                                                                        placeholder="Phone"
                                                                        id="certify_body_phone"
                                                                        class="form-control data- mtr_ certify_body_phone"
                                                                        maxlength="10"
                                                                        value="{{ $annexuredata->certify_body_phone ?? '' }}"
                                                                        >
                                                                    <i name="certify_body_phone."></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="certify_body_email"
                                                                        placeholder="Email"
                                                                        id="certify_body_email"
                                                                        class="form-control data- mtr_certify_body_email"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata->certify_body_email ?? '' }}" >
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
                                        </td>
                                </tr>
                                @if(isset($edit_id) && !Empty($edit_id))
                                    <tr>
                                        <td>
                                            <button type="submit" name="submit" class="btn btn-success" id="submit">
                                                <i class='bi bi-arrow-bar-up'></i> @if(isset($annexuredata->id) &&
                                                $annexuredata->id !='')Update @else Save @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                            <input type="hidden" name="subAnnexureType" id="subAnnexureType"
                                                value="{{$type}}">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <a href="{{URL::to('mfft/annexure-four-two/' .$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>
                                        </td>
                                    </tr>
                            
                                    @endif
                                </table>
                            </form>

                            <!-- 3.a) - e) Type Certification Details view-->
                            <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">3.(a - e) Type Certification Details</th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>a). Rated Capacity of the wind turbine (225 KW and above)</th>
                                        <th>b). Model</th>
                                        <th>c). Type Certificate No.</th>
                                        <th>d). Certificate Issue</th>
                                        <th>e). Certificate Valid</th>
                                        <!-- <th>c). Certificate</th> -->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                    // echo "<pre>";
                                    // print_r($type_annex->annexure); die;?>
                                        
                                    <tr>
                                        <td>1</td>
                                        <td>{{$annexuredata->wind_turbine_capacity}} </td>
                                        <td>{{ $main_model }} </td>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc; position: relative">
                                                    {{ $annexuredata->cert_attach_no }} @if(!empty($annexuredata->new_certificate))
                                                <span style="position: absolute;
                                                    right: 0;
                                                    top: -10px;">
                                                    <small>
                                                    <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->new_certificate) }}" class="document text-primary">
                                                        <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                    </a>
                                                </small>
                                            @else
                                                <small>No certificate available.</small>
                                            @endif
                                                </span>
                                                    </td>
                                                </tr>
                                            </table>
                                            
                                        </td>
                                        
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                    {{ date("d-m-Y",strtotime($annexuredata->type_certificate_issue)) }}
                                                        </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                    {{ date("d-m-Y",strtotime($annexuredata->type_certificate_valid)) }}
                                                       </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <!-- <td>
                                            @if(!empty($annexuredata->new_certificate))
                                                <small>
                                                    <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->new_certificate) }}" class="document text-primary">
                                                        <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                    </a>
                                                </small>
                                            @else
                                                <small>No certificate available.</small>
                                            @endif
                                        </td> -->

                                        <td> <a href="{{URL::to('mfft/annexure-four-two/' .$general->encodeid($application_id).'/'.$general->encodeid($application_id).'/11')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <!-- 3.f) - h) Type Certification Scheme view -->
                           
                            <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">3.(f - h) Type Certification Scheme & Documents</th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>f) Type Certification Scheme</th>
                                        <th>g) Type Certification </th>
                                        <th>h) Upload Documents  </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                        <table width="100%">
                                            <tr>
                                                <td style="border-bottom:1px solid #ccc;">
                                                    @php
                                                        $certificateSchemes = [
                                                            'is_iec' => 'IS/IEC',
                                                            'iecre' => 'IECRE',
                                                            'iec' => 'IEC',
                                                        ];
                                                    @endphp

                                                    {{ $certificateSchemes[$annexuredata->type_certificate_scheme] ?? 'N/A' }}
                                                </td>
                                            </tr>
                                        </table>

                                        <td>
                                        <table width="100%">
                                            <tr>
                                                <td style="border-bottom:1px solid #ccc;">
                                                    {{ $annexuredata->type_certificate_pro ?? 'N/A' }}
                                                </td>
                                            </tr>
                                        </table>
                                        </td>

                                        <td>
                                            <table width="100%">
                                                @if(!empty($annexuredata->compliance_attach))
                                                    <small>
                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->compliance_attach) }}" class="document text-primary">
                                                            <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                        </a>
                                                    </small>
                                                @else
                                                    <small>No certificate available.</small>
                                                @endif
                                            </table>
                                        </td>
                                       
                                        <td> <a href="{{URL::to('mfft/annexure-four-two/' .$general->encodeid($application_id).'/'.$general->encodeid($application_id).'/12')}}">
                                            Edit <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                    
                                </tbody>

                            </table>
                            <br>

                            <!-- i - Cartification Body  -->
                            <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="9" class="text-left">3. i) Name of Certification Body</th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>Name of Certification Body</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            @php
                                                $certificationBodies = [
                                                    'niwe' => 'NIWE',
                                                    'dnv' => 'DNV',
                                                    'dewi_occ' => 'DEWI-OCC',
                                                    'tuv_sud' => 'TUV SUD',
                                                    'tuv_nord' => 'TUV NORD',
                                                    'tuv_rheinland' => 'TUV RHEINLAND',
                                                    'wind_guard' => 'WIND GUARD',
                                                ];
                                            @endphp

                                            <table width="100%">
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        @if($annexuredata->nise_certificate_body === 'anyother')
                                                            {{ $annexuredata->anyother_field ?? 'Other' }}
                                                        @else
                                                            {{ $certificationBodies[$annexuredata->nise_certificate_body] ?? 'N/A' }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>

                                            <!-- <table width="100%">
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            @if( $annexuredata->nise_certificate_body=='anyother')
                                                            {{ $annexuredata->anyother_field }}
                                                            @else
                                                            {{$annexuredata->nise_certificate_body}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                            </table> -->
                                        </td>
                                       
                                        <td>
                                            <a href="{{URL::to('mfft/annexure-four-two/' . $general->encodeid($application_id) . '/' . $general->encodeid($application_id) . '/13')}}">
                                                Edit <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <br>

                             <!-- 3.1 (a - b). For Certification Bodies view -->
                             <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">3.1 For Certification Bodies</th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>a.Name of the Accreditation Body</th>
                                        <th>b.Accreditation Valid upto </th>
                                        <th>b.Attach Accreditation Certificate</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td> {{ $annexuredata->certify_body_name }} </td>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $annexuredata->accred_body_valid_upto }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            @if(!empty($annexuredata->accred_body_attach))
                                            
                                                <small>
                                                    <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->accred_body_attach) }}" class="document text-primary">
                                                        <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                    </a>
                                                </small>
                                            @else
                                                <small>No certificate available.</small>
                                            @endif
                                        </td>

                                        </td>
                                        <td> <a href="{{URL::to('mfft/annexure-four-two/'.$general->encodeid($application_id).'/'.$general->encodeid($application_id).'/14')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> <br>

                            <!-- 3.1 c). Contact Person of Certification Body for authentication view -->
                            <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">3.1 (c - d) Contact Person of Certification Body for authentication </th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>c). Contact Person of Certification Body for authentication of Type Certificate and other related documents</th>
                                        <th>d). Contact details including E-mail of Contact Person for authentication of Type Certificate and other related documents</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $annexuredata->certify_body_phone }}</td>
                                        <td>{{ $annexuredata->certify_body_email }}</td>
                                
                                        </td>
                                        <td> <a href="{{URL::to('mfft/annexure-four-two/'.$general->encodeid($application_id).'/'.$general->encodeid($application_id).'/15')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> <br>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('mfft/annexure-four/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    
                                    <a href="{{URL::to('mfft/annexure-four-three/'.$general->encodeid($application_id))}}"
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