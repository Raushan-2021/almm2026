@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Manufacturing Facility Details (Physical and Financial)')
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
    <a class="nav-link active" href="{{ URL::to('users/annexure-four-three/'  .$general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
      <div>Manufacturing Facility<br>3.0 - 3.7</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link " href="{{ URL::to('users/module-master/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Solar PV Modules<br> 4.0</div>
    </a>
</li>

<li class="nav-item">
   <a class="nav-link " href="{{ URL::to('users/annexure-one/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Mechanical Data<br>4.1 - 4.2</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-one-b/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Electrical Data <br>4.3</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-one-c/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Solar Cell & BoM<br>4.4- 4.5</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-three/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>BIS Registration<br>5.0 </div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link"  href="{{ URL::to('users/application-fees/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Application Fee<br>6.0</div>
    </a>
</li>
    
<li class="nav-item">
    <a class="nav-link"  href="{{ URL::to('users/application-submission/' .$general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Affidavit & Indemnity<br>7.0</div>
    </a>
</li>

</ul>
</div>

<div class="row" style="padding:0 10px">
    
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="comn_drop_shdow">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box-body">

                        
                        <form action="{{ URL::to('/users/annexure-four-three')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <?php //print_r($annexuredata); ?>
                                <table class="table table-bordered" 
                                    style="display:@if($annexuredata!=null) @else none @endif">
                                    
                                     <tr>
                                      <td>
                                        <table class="table table-bordered">
                                          <tr>
                                            <td colspan="4" class="bg-primary text-light">
                                                @if($edit_id==701)
                                                    3.0 Manufacturing Facility Details (Physical and Financial)
                                                @endif
                                            </td>
                                            </tr>
                                            <!--    <tr>
                                                    <th width="20%">Module Technology</th>
                                                    <td class="text-primary">{{ $annexuredata->module_name ?? '' }}</td>
                                                </tr> -->
                                        </table>
                                        </td>
                                    </tr>
                                    <?php //print_r($annexuredata); ?>

                                    <tr>
                                        <td>
                                            <div class="row" >
                                                <span id="detail_type_701"
                                                    style="display:@if($edit_id==701))  @else none @endif">
                                                    <!-- style="display:@if(($annexuredata->subAnnexureType ?? '')==11))  @else none @endif"> -->
                                                     <!-- 3.4	Purchase of Raw Materials & Details of sales in last three years -->
                                                    <table class="table text-center" >
                                                        <tr>
                                                            <th>Currently installed Manufacturing Capacity of Solar PV Modules (in MW / Year)<small class="text-danger"> * </small></th>
                                                            <th>Date of Commencement of commercial production by the solar PV module manufacturing unit<small class="text-danger"> * </small></th>
                                                            <th>Upload list of Major Equipment related to Manufacturing and Testing in the specified format as available in the Solar PV module manufacturing unit<small class="text-danger"> * </small></th>
                                                            <th>Sample Format</th>

                                                        </tr>
                                                        <?php  //print_r( $annexuredata)?>
                                                        @if(!Empty($edit_id) && $edit_id==701)
                                                        
                                                       <?php //print_r( $annexuredata->sub_annexure)?>
                                                        <tr>
                                                        <td>
                                                              <!-- <label for="location_assembly">
                                                                Location details (Included in Certificates)  <span class="text-danger">*</span>
                                                                </label> -->
                                                                <input type="text" name="installed_manufacturing_capacity"
                                                                        id="installed_manufacturing_capacity_"
                                                                        class="form-control  installed_manufacturing_capacity"
                                                                        maxlength="100"
                                                                        value="{{ $annexuredata->installed_manufacturing_capacity ?? '' }}">
                                                                </td>
                                                                <td>
                                                              <!-- <label for="location_assembly">
                                                                Location details (Included in Certificates)  <span class="text-danger">*</span>
                                                                </label> -->
                                                                <input type="date" name="production_date"
                                                                        id="production_date_"
                                                                        class="form-control  production_date"
                                                                        maxlength="100"
                                                                        value="{{ $annexuredata->production_date ?? '' }}"
                                                                        min="{{ date('Y-m-d') }}"
                                                                        >
                                                                </td>
                                                            <td>
                                                                <!-- <label for="calibration_certificate">
                                                                Manufacturing Facility <span class="text-danger">*</span> --> 
                                                                <!-- </label> -->
                                                                <input type="file" name="calibration_certificate" id="calibration_certificate" class="form-control pdf_file_2mb">
                                                                @if(isset($annexuredata->calibration_certificate) && $annexuredata->calibration_certificate)
                                                                    <input type="hidden" name="old_calibration_certificate" value="{{ $annexuredata->calibration_certificate ?? '' }}">
                                                                    <small>
                                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->calibration_certificate) }}" class="document">
                                                                            View Certificate
                                                                        </a>
                                                                    </small>
                                                                    
                                                                @endif
                                                                <i class="text-danger">Note: Please upload all list of Equipments in one PDF (Max. size allowed 2MB)</i>
                                                            </td>        
                                                            <?php $docBaseUrl='users/preview-docs/Attachment/'; ?>
                                                            <td class="col-md-1" style="border: 1px solid #dedede; padding-top: 25px;">
                                                                        <p style="border: 1px solid #dedede; background: #198754; border-radius: 5px; padding: 5px;">
                                                                        <strong style="">
                                                                            <a target="_blank" href="{{URL::to($docBaseUrl.'List_of_Major_Machines.pdf')}}" class="document" style="color: #ffffff;">
                                                                        Download Sample Format
                                                                    </a></strong>
                                                                </p>                        
                                                            </td>
                                                            </tr>
                                                        @endif
                                                       
                                                    </table>
                                                </span>
                                             </div>
                                        
                                            <div class="row">
                                                <span id="detail_type_702"
                                                
                                                    style="display:@if(($edit_id ?? '')==702))  @else none @endif">
                                                    <!-- 7.4 - 7.7 ISO Certificate -->
                                                    <table class="table text-center">
                                                        <tr>
                                                            <th>7.4 Upload Production, Sales and Export Data for last three years or the period od existence of the manufacturing unit, whichever is less<small class="text-danger"> * </small></th>
                                                        </tr>

                                                        @if(!Empty($edit_id) && $edit_id==702)
                                                    
                                                        <tr>


                                                            <td class="col-md-3">
                                                                <label for="">Upload Production, Sales and Export Data for last three years or the period od existence of the manufacturing unit, whichever is less<small><i>(PDF format Only and Max. 2MB allowed)<small class="text-danger"> * </small></i></small></label>
                                                                <input type="file" name="iso_certificate_doc" id="iso_certificate_doc" class="form-control pdf_file_2mb">
                                                                @if(!empty($annexuredata->iso_certificate_doc))
                                                                <input type="hidden" name="old_iso_certificate_doc" value="{{$annexuredata->iso_certificate}}">
                                                                <small><a target="_blank" href="{{URL::to($docBaseUrl.$annexuredata->iso_certificate)}}" class="document">View Certificate</a></small>
                                                                @endif
                                                            </td>

                                                                <!-- <td class="col-md-2"> -->
                                                                    <!-- <label for="">ISO Certificate Title<small class="text-danger"> * </small></label> -->
                                                                    <!-- <input type="text" name="iso_certificate[]"
                                                                        placeholder="Enter ISO Certificate Assembly" id="iso_certificate_"
                                                                        class="form-control" maxlength="70"
                                                                        value="{{ $annexuredata->iso_certificate ?? '' }}">
                                                                </td> -->
                                                    
                                                                <!-- <td class="col-md-2"> -->
                                                                    <!-- <label for="">Name of the ISO Certificate Body<small class="text-danger"> * </small></label> -->
                                                                    <!-- <input type="text" name="issuing_agency[]" id="issuing_agency_"
                                                                    placeholder="Name of the ISO Certificate Body"
                                                                        class="form-control" value="{{ $annexuredata->issuing_agency ?? '' }}">
                                                                </td> -->
                                                            
                                                                <!-- <td class="col-md-2"> -->
                                                                      <!-- <label for="issuing_date">Issuing Date<small class="text-danger"> * </small></label> -->
                                                                    <!-- <input type="date" name="issuing_date[]" id="issuing_date_"
                                                                        class="form-control" maxlength="70"
                                                                        value="{{ $annexuredata->issuing_date ?? '' }}"
                                                                        max="{{ date('Y-m-d') }}" >
                                                                </td> -->
                                                        
                                                                <!-- <td class="col-md-2"> -->
                                                                    <!-- <label for="certificate_validate">Certificate Valid Upto<small class="text-danger"> * </small></label> -->
                                                                    <!-- <input type="date" name="certificate_validate[]" id="certificate_validate_"
                                                                        class="form-control" maxlength="70"
                                                                        value="{{ $annexuredata->certificate_validate ?? '' }}"
                                                                        min="{{ date('Y-m-d') }}" >
                                                                </td> -->
                                                                <!-- <td class="col-md-3">
                                                                    <label for="">ISO Certificate<small> <i>( PDF format
                                                                                Only and Max. 2MB allowed)<small class="text-danger"> * </small></i></small></label>
                                                                    <input type="file" name="iso_certificate_doc"
                                                                        id="iso_certificate_doc" class="form-control pdf_file_2mb">
                                                                    @if(!empty($annexuredata->iso_certificate_doc))
                                                                    <input type="hidden" name="old_iso_certificate_doc"
                                                                        value="{{$annexuredata->iso_certificate_doc}}" id="">
                                                                    <small><a target="_blank"
                                                                            href="{{URL::to($docBaseUrl.$annexuredata->iso_certificate_doc)}}"
                                                                            class="document">View
                                                                            Certificate</a></small>
                                                                    @endif
                                                                </td> -->
                                                        </tr>
                                                        @endif
                                                    
                                                    </table>
                                                </span>
                                            </div>
                                        
                                            <div class="row">
                                                <span id="detail_type_703"
                                                <?php //print_r($annexuredata); ?>
                                                    style="display:@if(($edit_id)==703))  @else none @endif">
                                                    <?php //print_r($annexuredata); ?>
                                                     <!-- 7.8 ISO Certificate Contact Details-->
                                                    <table class="table text-center" >
                                                        <tr>
                                                            <th>Accreditation Body Name<small class="text-danger"> * </small></th>
                                                            <th>Accreditation Body Address<small class="text-danger"> * </small></th>
                                                            <th>Accreditation Body Phone<small class="text-danger"> * </small></th>
                                                            <th>Accreditation Body Email<small class="text-danger"> * </small><br> 
                                                            <th>Sample Format</th>
                                                        </tr>

                                                        @if(!Empty($edit_id) && $edit_id==703)
                                                       
                                                        <tr>
                                                            <td><input type="text" name="iso_name_body[]"
                                                                    placeholder="Accreditation Body Name"
                                                                    id="iso_name_body_"
                                                                    class="form-control iso_name_body"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata->annexure[0]['iso_name_body'] ?? '' }}">
                                                            </td>
                                                            <td><input type="text" name="iso_address_body[]"
                                                                    placeholder="Accreditation Body Address"
                                                                    id="iso_address_body_"
                                                                    class="form-control iso_address_body"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata->annexure[0]['iso_address_body'] ?? '' }}">
                                                                    
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="iso_phone_body[]"
                                                                        placeholder="Accreditation Body Phone"
                                                                        id="iso_phone_body_"
                                                                        class="form-control iso_phone_body"
                                                                        maxlength="10"
                                                                        value="{{ $annexuredata->annexure[0]['iso_phone_body'] ?? '' }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="iso_email_body[]"
                                                                        placeholder="Accreditation Body Email"
                                                                        id="iso_email_body_"
                                                                        class="form-control iso_email_body"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata->annexure[0]['iso_email_body'] ?? '' }}" >
                                                                </div>
                                                            </td>
                                                            <td>                          
                                                                <small>
                                                                    <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->calibration_certificate) }}" class="document">
                                                                        Download Format
                                                                    </a>
                                                                </small>                        
                                                            </td> 
                                                        </tr>
                                                        @endif
                                                    </table>
                                                </span>
                                             </div>
                                        
                                            <div class="row">
                                                <span id="detail_type_704"
                                                    style="display:@if(($edit_id)==704))  @else none @endif">
                                                    <!-- 7.9 - 7.10 Accreditation-->
                                                    <table class="table text-center" >
                                                        <tr>
                                                            <th>Accreditation Valid upto<small class="text-danger"> * </small></th>
                                                            <th>Sample Format</th>
                                                            <!-- <th>Accreditation Attachment Number<small class="text-danger"> * </small></th> -->
                                                            <th>Accreditation Certificate<small class="text-danger"> * </small></th> 
                                                            <th>Sample Format</th>
                                                        </tr>

                                                        @if(!Empty($edit_id) && $edit_id==704)
                                                    
                                                        <tr>
                                                                <td class="col-md-3">
                                                                    <!-- <label for="accred_date">Issuing Date<small class="text-danger"> * </small></label> -->
                                                                    <input type="date" name="accred_date[]" id="accred_date_" placeholder="Valid upto"
                                                                        class="form-control" maxlength="70"
                                                                        value="{{ $annexuredata->accred_date ?? '' }}"
                                                                        min="{{ date('Y-m-d') }}" >
                                                                </td>
                                                                 <td>                          
                                                                    <small>
                                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->calibration_certificate) }}" class="document">
                                                                            Download Format
                                                                        </a>
                                                                    </small>                        
                                                                </td>
                                                            <!-- <td class="col-md-3">
                                                                <input type="text" name="accred_no[]"
                                                                    placeholder="Attachment Number"
                                                                    id="accred_no_"
                                                                    class="form-control accred_no"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata->annexure[0]['accred_no'] ?? '' }}">
                                                            </td> -->
                                                            <td class="col-md-3">
                                                                    <!-- <label for="">Accreditation Certificate<small></label> -->
                                                                    <input type="file" name="accred_cert_doc"
                                                                        id="accred_cert_doc" class="form-control pdf_file_2mb">
                                                                    @if(!empty($annexuredata->accred_cert_doc))
                                                                    <input type="hidden" name="old_accred_cert_doc"
                                                                        value="{{$annexuredata->accred_cert_doc}}" id="">
                                                                    <small><a target="_blank"
                                                                            href="{{URL::to($docBaseUrl.$annexuredata->accred_cert_doc)}}"
                                                                            class="document">View
                                                                            Certificate</a></small>
                                                                    @endif
                                                                    <i class="text-danger">( PDF format Only and Max. 2MB allowed)<small class="text-danger">*</small></i>
                                                                </td>
                                                                <td>                          
                                                                    <small>
                                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->calibration_certificate) }}" class="document">
                                                                            Download Format
                                                                        </a>
                                                                    </small>                        
                                                                </td>
                                                        </tr>
                                                        @endif
                                                    </table>
                                                </span>
                                            </div>
                                        
                                            <div class="row">
                                                <span id="detail_type_705"
                                                    style="display:@if(($edit_id)==705))  @else none @endif">
                                                     <!-- 7.10 - 7.11 Manufacturing Capacity of PV Modeles-->
                                                    <table class="table text-center" >
                                                        <tr>
                                                            <th>Currently Installed Manufacturing Capacity of PV Modules (MW)<small class="text-danger"> * </small></th>
                                                            <th>Currently Installed Manufacturing Capacity of PV Modules & Production Attachment <small class="text-danger"> * </small></th>
                                                            <th>Sample Format</th> 
                                                        </tr>
                                                        @if(!Empty($edit_id) && $edit_id==705)
                                                        <tr>
                                                                <td class="col-md-3">
                                                                    <input type="number" name="mfp_capacity[]" id="mfp_capacity_" placeholder="Manufacturing Capacity of PV Modeles (mw)"
                                                                        class="form-control" maxlength="70"
                                                                        value="{{ $annexuredata->mfp_capacity ?? '' }}"
                                                                        max="{{ date('Y-m-d') }}"  min="0">
                                                                </td>
                                                                <td class="col-md-3">
                                                                    <!-- <label for="">Manufacturing Capacity Attachment <small> </label> -->
                                                                    <input type="file" name="mfp_attach_doc"
                                                                        id="mfp_attach_doc" class="form-control pdf_file_2mb">
                                                                    @if(!empty($annexuredata->mfp_attach_doc))
                                                                    <input type="hidden" name="old_mfp_attach_doc"
                                                                        value="{{$annexuredata->mfp_attach_doc}}" id="">
                                                                    <small><a target="_blank"
                                                                            href="{{URL::to($docBaseUrl.$annexuredata->mfp_attach_doc)}}"
                                                                            class="document">View
                                                                            Certificate</a></small>   
                                                                    @endif
                                                                    <i class="text-danger">Last Three years (PDF format Only and Max. 2MB allowed)<small class="text-danger"> * </small></i></small>
                                                                </td>
                                                                <td>                          
                                                                    <small>
                                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->calibration_certificate) }}" class="document">
                                                                            Download Format
                                                                        </a>
                                                                    </small>                        
                                                                </td>
                                                        </tr>
                                                        @endif
                                                    </table>
                                                </span>
                                             </div>
                                        
                                            <div class="row">
                                                <span id="detail_type_706"
                                                    style="display:@if(($edit_id)==706))  @else none @endif">
                                                    <!-- 7.12 - 7.13 Purchase of raw materials in last three years-->
                                                    <table class="table text-center" >
                                                        <!-- <tr>
                                                            <th>Purchase of Raw Materials Attachment<small class="text-danger"> * </small></th>
                                                            <th>Details of sales in last three years<small class="text-danger"> * </small></th>
                                                        </tr> -->
                                                        @if(!Empty($edit_id) && $edit_id==706)
                                                        <tr>
                                                                <td class="col-md-5">
                                                                    <label for=""><strong>Purchase of Raw Materials Attachment </strong></label>
                                                                    <input type="file" name="raw_mtrl_docs"
                                                                        id="raw_mtrl_docs" class="form-control pdf_file_2mb">
                                                                    @if(!empty($annexuredata->raw_mtrl_docs))
                                                                    <input type="hidden" name="old_raw_mtrl_docs"
                                                                        value="{{$annexuredata->raw_mtrl_docs}}" id="">
                                                                    <small><a target="_blank"
                                                                            href="{{URL::to($docBaseUrl.$annexuredata->raw_mtrl_docs)}}"
                                                                            class="document">View
                                                                            Certificate</a></small>
                                                                    @endif
                                                                    <small> <i class="text-danger">( PDF format
                                                                                Only and Max. 2MB allowed)<small class="text-danger"> * </small></i></small>
                                                                </td>
                                                                <?php $docBaseUrl='users/preview-docs/Attachment/'; ?>
                                                                <td class="col-md-1" style="border: 1px solid #dedede; padding-top: 25px;">
                                                                            <p style="border: 1px solid #dedede; background: #198754; border-radius: 5px; padding: 5px;">
                                                                            <strong style="">
                                                                                <a target="_blank" href="{{URL::to($docBaseUrl.'Purchase_Data.pdf')}}" class="document" style="color: #ffffff;">
                                                                            Download Sample Format
                                                                        </a></strong>
                                                                    </p>                        
                                                                </td> 
                                                                <td class="col-md-5">
                                                                    <label for=""><strong>Details of Production, sales, and export data in last three years</strong> </label>
                                                                    <input type="file" name="details_sales_docs"
                                                                        id="details_sales_docs" class="form-control pdf_file_2mb">
                                                                    @if(!empty($annexuredata->details_sales_docs))
                                                                    <input type="hidden" name="old_details_sales_docs"
                                                                        value="{{$annexuredata->details_sales_docs}}" id="">
                                                                    <small><a target="_blank"
                                                                            href="{{URL::to($docBaseUrl.$annexuredata->details_sales_docs)}}"
                                                                            class="document">View
                                                                            Certificate</a></small>
                                                                    @endif
                                                                    <small> <i class="text-danger">( PDF format
                                                                                Only and Max. 2MB allowed)<small class="text-danger"> * </small></i></small>
                                                                </td>
                                                                <?php $docBaseUrl='users/preview-docs/Attachment/'; ?>
                                                                <td class="col-md-1" style="border: 1px solid #dedede; padding-top: 25px;">
                                                                            <p style="border: 1px solid #dedede; background: #198754; border-radius: 5px; padding: 5px;">
                                                                            <strong style="">
                                                                                <a target="_blank" href="{{URL::to($docBaseUrl.'Sales_data.pdf')}}" class="document" style="color: #ffffff;">
                                                                            Download Sample Format
                                                                        </a></strong>
                                                                    </p>                        
                                                                </td>
                                                        </tr>
                                                        @endif
                                                    </table>
                                                </span>
                                            </div>
                                        
                                            <div class="row">
                                                <span id="detail_type_707"
                                                    style="display:@if(($edit_id)==707))  @else none @endif">
                                                     <!-- 7.14 - 7.16	Profit & Loss, Statement of assets & Balance Sheet in last three years -->
                                                    <table class="table text-center" >
                                                        <tr>
                                                            <th>Profit & Loss account for last three years<small class="text-danger"> * </small></th>
                                                            <th>Sample Format</th>
                                                            <th>Statement of Assets & liabilities for last three years<small class="text-danger"> * </small></th>
                                                            <th>Sample Format</th>
                                                            <th>Balance Sheet for last three years<small class="text-danger"> * </small></th>
                                                            <th>Sample Format</th>
                                                        </tr>
                                                        @if(!Empty($edit_id) && $edit_id==707)
                                                        <tr>
                                                                <td class="col-md-3">
                                                                    <!-- <label for="">Profit & Loss account Attachment </label> -->
                                                                    <input type="file" name="profit_loss_docs"
                                                                        id="profit_loss_docs" class="form-control pdf_file_2mb">
                                                                    @if(!empty($annexuredata->profit_loss_docs))
                                                                    <input type="hidden" name="old_profit_loss_docs"
                                                                        value="{{$annexuredata->profit_loss_docs}}" id="">
                                                                    <small><a target="_blank"
                                                                            href="{{URL::to($docBaseUrl.$annexuredata->profit_loss_docs)}}"
                                                                            class="document">View
                                                                            Certificate</a></small>
                                                                    @endif
                                                                    <small> <i class="text-danger">( PDF format
                                                                                Only and Max. 2MB allowed)<small class="text-danger"> * </small></i></small>
                                                                </td>
                                                                <?php $docBaseUrl='users/preview-docs/Attachment/'; ?>
                                                                <td class="col-md-1" style="border: 1px solid #dedede; padding-top: 25px;">
                                                                            <p style="border: 1px solid #dedede; background: #198754; border-radius: 5px; padding: 5px;">
                                                                            <strong style="">
                                                                                <a target="_blank" href="{{URL::to($docBaseUrl.'Production_Data.pdf')}}" class="document" style="color: #ffffff;">
                                                                                    Download Sample Format 
                                                                                </a>
                                                                            </strong>
                                                                    </p>                        
                                                                </td>
                                                                <td class="col-md-3">
                                                                    <!-- <label for="">Statement of Assets Attachment </label> -->
                                                                    <input type="file" name="statement_assests_docs"
                                                                        id="statement_assests_docs" class="form-control pdf_file_2mb">
                                                                    @if(!empty($annexuredata->statement_assests_docs))
                                                                    <input type="hidden" name="old_statement_assests_docs"
                                                                        value="{{$annexuredata->statement_assests_docs}}" id="">
                                                                    <small><a target="_blank"
                                                                            href="{{URL::to($docBaseUrl.$annexuredata->statement_assests_docs)}}"
                                                                            class="document">View
                                                                            Certificate</a></small>
                                                                    @endif
                                                                    <small><i class="text-danger">( PDF format
                                                                                Only and Max. 2MB allowed)<small class="text-danger"> * </small></i></small>
                                                                </td>
                                                                <?php $docBaseUrl='users/preview-docs/Attachment/'; ?>
                                                                <td class="col-md-1" style="border: 1px solid #dedede; padding-top: 25px;">
                                                                            <p style="border: 1px solid #dedede; background: #198754; border-radius: 5px; padding: 5px;">
                                                                            <strong style="">
                                                                                <a target="_blank" href="{{URL::to($docBaseUrl.'Production_Data.pdf')}}" class="document" style="color: #ffffff;">
                                                                            Download Sample Format
                                                                        </a></strong>
                                                                    </p>                        
                                                                </td>
                                                                <td class="col-md-3">
                                                                    <!-- <label for="">Balance Sheet Attachment </label> -->
                                                                    <input type="file" name="balance_sheet_docs"
                                                                        id="balance_sheet_docs" class="form-control pdf_file_2mb">
                                                                    @if(!empty($annexuredata->balance_sheet_docs))
                                                                    <input type="hidden" name="old_balance_sheet_docs"
                                                                        value="{{$annexuredata->balance_sheet_docs}}" id="">
                                                                    <small><a target="_blank"
                                                                            href="{{URL::to($docBaseUrl.$annexuredata->balance_sheet_docs)}}"
                                                                            class="document">View
                                                                            Certificate</a></small>
                                                                    @endif
                                                                    <small> <i class="text-danger">( PDF format
                                                                                Only and Max. 2MB allowed)<small class="text-danger"> * </small></i></small>
                                                                </td>
                                                                <?php $docBaseUrl='users/preview-docs/Attachment/'; ?>
                                                                <td class="col-md-1" style="border: 1px solid #dedede; padding-top: 25px;">
                                                                            <p style="border: 1px solid #dedede; background: #198754; border-radius: 5px; padding: 5px;">
                                                                            <strong style="">
                                                                                <a target="_blank" href="{{URL::to($docBaseUrl.'Production_Data.pdf')}}" class="document" style="color: #ffffff;">
                                                                            Download Sample Format
                                                                        </a></strong>
                                                                    </p>                        
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
                                                <i class='bi bi-arrow-bar-up'></i> @if(isset($application_id) &&
                                                $application_id !='')Update @else Save @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($application_id)){{$general->encodeid($application_id)}}@endif">
                                            <input type="hidden" name="subAnnexureType" id="subAnnexureType"
                                                value="@if(isset($edit_id)){{$edit_id}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <a href="{{URL::to('users/annexure-four-three/' .$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </form>
                            
                            <!-- 7.0 - 7.3 BIS Registration view-->
                           
                             <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="9" class="text-left">3.0 Manufacturing Facility Details (Physical and Financial)</th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>3.1 Currently installed Manufacturing Capacity of Solar PV Modules (in MW / Year)</th>
                                        <th>3.2 Date of Commencement of commercial production by the solar PV module manufacturing unit </th>
                                        <th>3.3 Upload list of Major Equipment related to Manufacturing and Testing in the specified format as available in the Solar PV module manufacturing unit</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                        <td>1.</td>
                                        <td>{{ $annexuredata->installed_manufacturing_capacity ?? '' }}</td>
                                        <td>{{date('d-m-Y', strtotime($annexuredata->production_date ?? ''))}} </td>
                                        <td>        <?php if(isset($annexuredata->calibration_certificate) && $annexuredata->calibration_certificate){ ?>
                                                                    <small>
                                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->calibration_certificate) }}" class="document">
                                                                            View Certificate
                                                                        </a>
                                                                    </small>
                                                                    <?php } ?>
                                                          </td>
                                        <td><a href="{{URL::to('users/annexure-four-three/' .$general->encodeid($application_id).'/701')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/11/'.$general->encodeid($application_id))}}"
                                            onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                            class="text-danger">Delete <i class="bi bi-trash-fill"></i></a></td>
                                    </tr>
                              <!--      @php $i = 1;  @endphp  -->
                                    <?php //echo '<pre>'; print_r($appData);?>
                             <!--      @foreach($appData['manufacture_facility_details'] as $list_data) -->
                                    <?php //echo '<pre>'; print_r($list_data);?>
                               
                                <!--    @endforeach -->
                                </tbody>

                            </table>
                            <br>

                            <!-- 7.3 - 7.7 BIS Registration view-->
                       
                         
                             <!-- 7.8 BIS Registration view-->
                        <!--    <table class="table table-bordered mt-4">
                                <thead>
                                    <tr >
                                        <th>7.8 </th>
                                        <th scope="col" colspan="13" class="text-left">Accreditation Body Issuing ISO Certification Contact Details
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-primary text-white">
                                        <th width="5%">S.No</th>
                                        <th width="20%">Accreditation Body Name</th>
                                        <th width="30%">Accreditation Body Address</th>
                                        <th width="15%">Accreditation Body Phone </th>
                                        <th width="15%">Accreditation Body Email</th>
                                        <th width="20%"></th>
                                    </tr>
                                    @php $m = 1 @endphp
                                    @foreach($appData['iso_certificate_contact'] as $iso_cnt_list)
                                    <tr>
                                        <td>{{$m++}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach($iso_cnt_list->annexure as $iso_name_body)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $iso_name_body->iso_name_body }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($iso_cnt_list->annexure as $iso_address_body)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $iso_address_body->iso_address_body }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        <td>
                                            <table width="100%">
                                                @foreach($iso_cnt_list->annexure as $iso_phone_body)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $iso_phone_body->iso_phone_body }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                            
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($iso_cnt_list->annexure as $iso_email_body)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $iso_email_body->iso_email_body }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                          
                                        </td>
                                
                                        <td>
                                            <a href="{{URL::to('users/annexure-four-three/'.$general->encodeid($iso_cnt_list->application_id).'/'.$general->encodeid($iso_cnt_list->id).'/703')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/4/'.$general->encodeid($iso_cnt_list->id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="bi bi-trash-fill"></i></a>  
                                        </td>
                                    </tr>
                                    @endforeach
                                </th>
                                    </tr>
                                </tbody>
                            </table> -->
                            <br>

                            <!-- 7.9 - 7.10 Accreditation -->
                       <!--     <table class="table table-bordered mt-4">
                                <thead>
                                    <tr >
                                        <th>7.9 </th>
                                        <th scope="col" colspan="13" class="text-left">Accreditation
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-primary text-white">
                                        <th width="5%">S.No</th>
                                        <th width="25%">Accreditation Valid upto </th>
                                        <!-- <th width="25%">Accreditation Attachment Number </th> -->
                                  <!--      <th width="25%">Accreditation Certificate </th>
                                        <th width="20%"></th>
                                    </tr>
                                    @php $n = 1 @endphp
                                    @foreach($appData['accreditation_cert'] as $data)
                                    <tr>
                                        <td>{{$n++}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $accred_date)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_date->accred_date }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <!-- <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $accred_no)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_no->accred_no }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td> -->
                                   <!--     <td>
                                            <table width="100%" >
                                                @php $accred_cert_doc = ''; @endphp
                                                @foreach($data->annexure as $accred_cert_doc)
                                                    @php $accred_cert_doc = $accred_cert_doc->accred_cert_doc; @endphp
                                                    <?php //print_r($accred_cert_doc);?>
                                                @endforeach
                                            </table>
                                                @if($accred_cert_doc != '')
                                                    <small><a target="_blank"
                                                            href="{{URL::to($docBaseUrl . $accred_cert_doc)}}"
                                                            class="document">View
                                                            Certificate</a></small>
                                                    @endif
                                        </td>
                                        <td>
                                            <a href="{{URL::to('users/annexure-four-three/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/704')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/4/'.$general->encodeid($data->id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="bi bi-trash-fill"></i></a>  
                                        </td>
                                    </tr>
                                    @endforeach
                                </th>
                                    </tr>
                                </tbody>
                            </table> 
                            <br> -->

                            <!-- 7.10 - 7.11 Manufacturing Capacity of PV Modeles -->
                       <!--     <table class="table table-bordered mt-4">
                                <thead>
                                    <tr >
                                        <th>7.10 - 7.11 </th>
                                        <th scope="col" colspan="13" class="text-left">Manufacturing Capacity of PV Modeles
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-primary text-white">
                                        <th width="5%">S.No</th>
                                        <th width="20%">7.10 Currently Installed Manufacturing Capacity of PV Modules (MW)   </th>
                                        <th width="20%">7.11 Currently Installed Manufacturing Capacity of PV Modules & Production Attachment  </th>
                                        <th width="20%"></th>
                                    </tr>
                                    @php $p = 1 @endphp
                                    @foreach($appData['mf_pv_capacity'] as $mfp_data)
                                    <tr>
                                        <td>{{$p++}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach($mfp_data->annexure as $mfp_capacity)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $mfp_capacity->mfp_capacity }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%" >
                                                @php $mfp_attach_doc = ''; @endphp
                                                @foreach($mfp_data->annexure as $mfp_attach_doc)
                                                    @php $mfp_attach_doc = $mfp_attach_doc->mfp_attach_doc; @endphp
                                                    <?php //print_r($accred_cert_doc);?>
                                                @endforeach
                                            </table>
                                                @if($mfp_attach_doc != '')
                                                    <small><a target="_blank"
                                                            href="{{URL::to($docBaseUrl . $mfp_attach_doc)}}"
                                                            class="document">View
                                                            Certificate</a></small>
                                                    @endif
                                        </td>
                                        <td>
                                            <a href="{{URL::to('users/annexure-four-three/'.$general->encodeid($mfp_data->application_id).'/'.$general->encodeid($mfp_data->id).'/705')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/4/'.$general->encodeid($mfp_data->id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="bi bi-trash-fill"></i></a>  
                                        </td>
                                    </tr>
                                    @endforeach
                                </th>
                                    </tr>
                                </tbody>
                            </table>
                            <br> -->

                            <!-- 7.12 - 7.13 Purchase of raw materials in last three years  -->
                            <table class="table table-bordered mt-4">
                                <thead>
                                    <tr >
                                        <th>3.4</th>
                                        <th scope="col" colspan="13" class="text-left">Purchase of Raw Materials & Details of sales in last three years
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-primary text-white">
                                        <th width="5%">S.No</th>
                                        <th width="20%">Purchase of Raw Materials Attachment </th>
                                        <th width="20%">Details of Production, sales, and export data in last three years </th>
                                        <th width="20%"></th>
                                    </tr>


                                    <tr>
                                        <td>1.</td>
               
                                        <td>        <?php if(isset($annexuredata->details_sales_docs) && $annexuredata->details_sales_docs){ ?>
                                                                    <small>
                                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->details_sales_docs) }}" class="document">
                                                                            View Certificate
                                                                        </a>
                                                                    </small>
                                                                    <?php } ?>
                                                          </td>
                                                          <td>        <?php if(isset($annexuredata->raw_mtrl_docs) && $annexuredata->raw_mtrl_docs){ ?>
                                                                    <small>
                                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->raw_mtrl_docs) }}" class="document">
                                                                            View Certificate
                                                                        </a>
                                                                    </small>
                                                                    <?php } ?>
                                                          </td>
                                        <td><a href="{{URL::to('users/annexure-four-three/' .$general->encodeid($application_id).'/706')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/12/'.$general->encodeid($application_id))}}"
                                            onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                            class="text-danger">Delete <i class="bi bi-trash-fill"></i></a></td>
                                    </tr>

                                </tbody>
                            </table>
                            <br>

                            <!-- 7.14 - 7.16 Profit & Loss, Statement of assets & Balance Sheet in last three years  -->
                            <table class="table table-bordered mt-4">
                                <thead>
                                    <tr >
                                        <th>3.5 - 3.7 </th>
                                        <th scope="col" colspan="13" class="text-left">Profit & Loss, Statement of assets & Balance Sheet in last three years
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-primary text-white">
                                        <th width="5%">S.No</th>
                                        <th width="20%">3.5 Profit & Loss account for last three years </th>
                                        <th width="20%">3.6 Statement of assets & liabilities for last three years</th>
                                        <th width="20%">3.7 Balance Sheet for last three years </th>
                                        <th width="20%"></th>
                                    </tr>

                                    <tr>
                                        <td>1.</td>
               
                                        <td>        <?php if(isset($annexuredata->profit_loss_docs) && $annexuredata->profit_loss_docs){ ?>
                                                                    <small>
                                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->profit_loss_docs) }}" class="document">
                                                                            View Certificate
                                                                        </a>
                                                                    </small>
                                                                    <?php } ?>
                                                          </td>
                                                          <td>        <?php if(isset($annexuredata->statement_assests_docs) && $annexuredata->statement_assests_docs){ ?>
                                                                    <small>
                                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->statement_assests_docs) }}" class="document">
                                                                            View Certificate
                                                                        </a>
                                                                    </small>
                                                                    <?php } ?>
                                                          </td>
                                                          <td>        <?php if(isset($annexuredata->balance_sheet_docs) && $annexuredata->balance_sheet_docs){ ?>
                                                                    <small>
                                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->balance_sheet_docs) }}" class="document">
                                                                            View Certificate
                                                                        </a>
                                                                    </small>
                                                                    <?php } ?>
                                                          </td>
                                        <td><a href="{{URL::to('users/annexure-four-three/' .$general->encodeid($application_id).'/707')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/13/'.$general->encodeid($application_id))}}"
                                            onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                            class="text-danger">Delete <i class="bi bi-trash-fill"></i></a></td>
                                    </tr>

                                </tbody>
                            </table>
                            <br>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/new-application/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    
                                    <a href="{{URL::to('users/module-master/'.$general->encodeid($application_id))}}"
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
        document.getElementById('type_certificate_scheme_').addEventListener('change', function() {
            var otherFieldContainer = document.getElementById('other-field-container');
            if (this.value === 'other') {
                otherFieldContainer.classList.remove('hidden');
            } else {
                otherFieldContainer.classList.add('hidden');
            }
        });
    </script>
  
  <script>
        function toggleAnyOtherField() {
            const selectElement = document.getElementById('tuv_certificate_body_');
            const anyotherFieldContainer = document.getElementById('anyother_field-container');
            
            if (selectElement.value === 'anyother') {
                anyotherFieldContainer.classList.remove('hidden');
            } else {
                anyotherFieldContainer.classList.add('hidden');
            }
        }
        
        // Initial check in case of pre-filled data
        document.addEventListener('DOMContentLoaded', () => {
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
<script>
    $(document).ready(function() {
        $('#show_data').hide(); // Initially hide the second form

        $('#editButton').click(function() {
            $('#show_data').toggle('slow'); // Toggle visibility on button click
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Check the initial state on page load
        toggleISOFields();

        // Trigger the function when the dropdown changes
        $('#iso_certificate_').change(function() {
            toggleISOFields();
        });

        function toggleISOFields() {
            var isoSelected = $('#iso_certificate_').val();
            if (isoSelected === 'yes') {
                $('.iso-details').show();
            } else {
                $('.iso-details').hide();
            }
        }
    });
</script>
    @endpush