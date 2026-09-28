@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'BIS Certification and Module Test Reports Details')
@section('content')
@php $docBaseUrl ='users/preview-docs/Annexure/';
@endphp
<div class="row">
    @include('backend.user.form._stepper')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box-body">

                            <form action="{{ URL::to('/users/annexure-three')}}" method="POST"
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
                                                        @if(($annexuredata->subAnnexureType ?? '')==1)
                                                        4.0 BIS Registration / Certification Details
                                                         @elseif(($annexuredata->subAnnexureType ?? '')==2) 
                                                         4.6 BIS Organisation Details 
                                                         @elseif(($annexuredata->subAnnexureType ?? '')==3)
                                                          4.7 Lab Contact Details 
                                                         @elseif(($annexuredata->subAnnexureType ?? '')==4)
                                                         4.8 Lab Contact Details 
                                                         @elseif(($annexuredata->subAnnexureType ?? '')==9)
                                                         4.9 Accreditation
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
                                                <!-- <tr>
                                                    <th>Pmax (Wp) of Main Model</th>
                                                    <td colspan="3" class="text-primary">
                                                        {{$annexuredata->pmax_model ?? ''}} Wp</td>
                                                </tr> -->

                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <span id="detail_type_1"
                                                    style="display:@if(($annexuredata->subAnnexureType ?? '')==1))  @else none @endif">
                                                     <!-- 4.0 BIS Registration -->
                                                    <table class="table text-center">
                                                        <tr>
                                                            <!-- <th>S.No</th> -->
                                                            <!-- <th width="15%">Applicable models covered under ± 5% of Mean
                                                                Wattage</th> -->
                                                            <!-- <th width="15%">Pmax (Wp) of Applicable Models Model</th> -->
                                                            <th>BIS Registration / Certificate No<small class="text-danger"> * </small></th>
                                                            <th>BIS Certificate issue date<small class="text-danger"> * </small></th>
                                                            <th>BIS Certificate Valid Upto<small class="text-danger"> * </small></th>

                                                        </tr>
                                                        @if(!Empty($annexuredata))
                                                       
                                                        <tr>
                                                            <!-- <td></td> -->
                                                            <!-- <td>{{$annexuredata->applicable_model_covered ?? ''}}
                                                            </td> -->
                                                            <!-- <td>{{$annexuredata->applicable_model ?? ''}}
                                                                Wp</td> -->
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="number" name="bis_certificate_no[]"
                                                                        placeholder="BIS Certificate No."
                                                                        id="bis_certificate_no_"
                                                                        class="form-control data- bcd_bis_certificate_no"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure']['bis_certificate_no'] ?? '' }}" >
                                                                    <i name="bis_certificate_no."></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                    <div class="col-md-12">
                                                                        <input type="date" name="bis_certificate_issue[]"
                                                                            placeholder="BIS Certificate issue date"
                                                                            id="bis_certificate_issue_"
                                                                            class="form-control data- bcd_bis_certificate_issue"
                                                                            maxlength="70"
                                                                            value="{{ $annexuredata['annexure']['bis_certificate_issue'] ?? '' }}"
                                                                            
                                                                            onchange="validateDates()">
                                                                        <i name="bis_certificate_issue."></i>
                                                                    </div>
                                                                </td>
                                                                <td class="text-left">
                                                                    <div class="col-md-12">
                                                                        <input type="date" name="bis_certificate_valid[]"
                                                                            placeholder="BIS Certificate issue date"
                                                                            id="bis_certificate_valid_"
                                                                            class="form-control data- bcd_bis_certificate_valid"
                                                                            maxlength="70"
                                                                            value="{{ $annexuredata['annexure']['bis_certificate_valid'] ?? '' }}"
                                                                            
                                                                            onchange="validateDates()">
                                                                        <i name="bis_certificate_valid."></i>
                                                                        
                                                                        <!-- <input type="checkbox"
                                                                            name="same"
                                                                            id="sameBCD"
                                                                            onchange="copydataBCD()"
                                                                            style="font-size:12px;"> <span
                                                                            class="text-primary same_as_above">Autofill as
                                                                            filled
                                                                            above</span> -->
                                                                        
                                                                    </div>
                                                                </td>
                                                        </tr>
                                                        
                                                        @endif
                                                        <tr>
                                                            <td colspan="6" class="text-left">
                                                                <div class="col-md-12">
                                                                    <label for="">BIS Certificate <span
                                                                            class="text-danger">*</span> <i
                                                                            class="text-danger">Note: Please upload all
                                                                            certificate in one PDF (Max. size allowed
                                                                            2MB)</i></label>
                                                                    <input type="file" name="bis_certificate"
                                                                        id="bis_certificate"
                                                                        class="form-control pdf_file_2mb">

                                                                    @if(($annexuredata->doc_certificate ?? '')!=null)
                                                                    <input type="hidden" name="old_bis_certificate"
                                                                        id="">
                                                                    <small><a target="_blank"
                                                                            href="{{URL::to($docBaseUrl.$annexuredata->doc_certificate)}}"
                                                                            class="document">View
                                                                            Certificate</a></small>@endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </span>

                                                <span id="detail_type_2"
                                                    style="display:@if(($annexuredata->subAnnexureType ?? '')==2)  @else none @endif">
                                                    <!-- 4.6 BIS Organisation Details -->
                                                    <table class="table text-center">
                                                        <tr>
                                                            <!-- <th>S.No</th> -->
                                                            <!-- <th width="15%">Applicable models covered under ± 5% of Mean
                                                                Wattage</th> -->
                                                            <!-- <th width="15%">Pmax (Wp) of Applicable Models Model</th> -->
                                                            <th>Name<small class="text-danger"> * </small></th>
                                                            <th>Address<small class="text-danger"> * </small></th>
                                                            <th>Phone<small class="text-danger"> * </small></th>
                                                            <th>Email<small class="text-danger"> * </small><br> 
                                                            <!-- <i class="text-primary">(Max. 300 Charactcters)</i> -->
                                                            </th>
                                                            <!-- <th>Valid NABL Certificate No. of Test Laboratory at the
                                                                time of testing<small class="text-danger"> * </small></th> -->

                                                        </tr>
                                                        @if(!Empty($annexuredata))
                                                        
                                                        <tr>
                                                            <!-- <td></td> -->
                                                            <!-- <td>{{$annexuredata->applicable_model_covered ?? ''}}
                                                            </td>
                                                            <td>{{$annexuredata->applicable_model ?? ''}}
                                                                Wp</td> -->
                                                            <td><input type="text" name="orgn_contact_name[]"
                                                                    placeholder="Name"
                                                                    id="orgn_contact_name_"
                                                                    class="form-control data- mtr_orgn_contact_name"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata['annexure']['orgn_contact_name'] ?? '' }}">
                                                                    
                                                                <i name="orgn_contact_name."></i>
                                                            </td>
                                                            <td><input type="text" name="orgn_contact_address[]"
                                                                    placeholder="Address"
                                                                    id="orgn_contact_address_"
                                                                    class="form-control data- mtr_orgn_contact_address"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata['annexure']['orgn_contact_address'] ?? '' }}">
                                                                    
                                                                <i name="orgn_contact_address."></i>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="orgn_contact_phone[]"
                                                                        placeholder="Phone"
                                                                        id="orgn_contact_phone_"
                                                                        class="form-control data- mtr_orgn_contact_phone"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure']['orgn_contact_phone'] ?? '' }}"
                                                                        >
                                                                    <i name="orgn_contact_phone."></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="orgn_contact_email[]"
                                                                        placeholder="Email"
                                                                        id="orgn_contact_email_"
                                                                        class="form-control data- mtr_orgn_contact_email"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure']['orgn_contact_email'] ?? '' }}" >
                                                                    <i name="orgn_contact_email."></i>
                                                                </div>
                                                            </td>
                                                           
                                                                    <!-- <input type="checkbox"
                                                                        name="same"
                                                                        id="sameMTR"
                                                                        onchange="copydataMTR()"
                                                                        style="font-size:12px;"> <span
                                                                        class="text-primary same_as_above">Autofill as
                                                                        filled
                                                                        above</span> -->
                                                                 
                                                                </div>
                                                            </td>
                                                        </tr>

                                                       
                                                        @endif
                                                        <!-- <tr>

                                                            <td colspan="8" class="text-left">
                                                                <div class="col-md-12">
                                                                    <label for="">NABL Certificate <span
                                                                            class="text-danger">*</span> <i
                                                                            class="text-danger">Note: Please upload all
                                                                            certificate in one PDF</i></label>
                                                                    <input type="file" name="nabl_certificate"
                                                                        id="nabl_certificate"
                                                                        class="form-control pdf_file">
                                                                    @if(($annexuredata->nabl_certificate ?? '')!=null)
                                                                    <input type="hidden" name="old_nabl_certificate"
                                                                        id="">
                                                                    <small><a target="_blank"
                                                                            href="{{URL::to($docBaseUrl.$annexuredata->doc_certificate)}}"
                                                                            class="document">View
                                                                            Certificate</a></small>@endif
                                                                </div>
                                                            </td>
                                                        </tr> -->
                                                    </table>
                                                </span>


                                                <span id="detail_type_3"
                                                    style="display:@if(($annexuredata->subAnnexureType ?? '')==3)  @else none @endif">
                                                    <!-- 4.7 Lab Contact Details -->
                                                    <table class="table text-center">
                                                        <tr>
                                                        
                                                            <th>Name<small class="text-danger"> * </small></th>
                                                            <th>Address<small class="text-danger"> * </small></th>
                                                            <th>Phone<small class="text-danger"> * </small></th>
                                                            <th>Email<small class="text-danger"> * </small><br> 
                                                            </th>

                                                        </tr>
                                                        @if(!Empty($annexuredata))
                                                        
                                                        <tr>
                                                            <td><input type="text" name="lab_contact_name[]"
                                                                    placeholder="Name"
                                                                    id="lab_contact_name_"
                                                                    class="form-control data- mtr_lab_contact_name"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata['annexure']['lab_contact_name'] ?? '' }}">
                                                                    
                                                                <i name="lab_contact_name."></i>
                                                            </td>
                                                            <td><input type="text" name="lab_contact_address[]"
                                                                    placeholder="Address"
                                                                    id="lab_contact_address_"
                                                                    class="form-control data- mtr_lab_contact_address"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata['annexure']['lab_contact_address'] ?? '' }}">
                                                                    
                                                                <i name="lab_contact_address."></i>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="lab_contact_phone[]"
                                                                        placeholder="Phone"
                                                                        id="lab_contact_phone_"
                                                                        class="form-control data- mtr_ lab_contact_phone"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure']['lab_contact_phone'] ?? '' }}"
                                                                        >
                                                                    <i name="lab_contact_phone."></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="lab_contact_email[]"
                                                                        placeholder="Email"
                                                                        id="lab_contact_email_"
                                                                        class="form-control data- mtr_lab_contact_email"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure']['lab_contact_email'] ?? '' }}" >
                                                                    <i name="lab_contact_email."></i>
                                                                </div>
                                                            </td>
                                                           
                                                                </div>
                                                            </td>
                                                        </tr>

                                                       
                                                        @endif
                                                        
                                                    </table>
                                                </span>

                                                <span id="detail_type_4"
                                                    style="display:@if(($annexuredata->subAnnexureType ?? '')==4)  @else none @endif">
                                                    <!-- 4.8 Accreditation Body Details -->
                                                    <table class="table text-center">
                                                        <tr>
                                                        
                                                            <th>Name<small class="text-danger"> * </small></th>
                                                            <th>Address<small class="text-danger"> * </small></th>
                                                            <th>Phone<small class="text-danger"> * </small></th>
                                                            <th>Email<small class="text-danger"> * </small><br> 
                                                            </th>

                                                        </tr>
                                                        @if(!Empty($annexuredata))
                                                        
                                                        <tr>
                                                            <td><input type="text" name="accred_contact_name[]"
                                                                    placeholder="Name"
                                                                    id="accred_contact_name_"
                                                                    class="form-control data- mtr_accred_contact_name"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata['annexure']['accred_contact_name'] ?? '' }}">
                                                                    
                                                                <i name="accred_contact_name."></i>
                                                            </td>
                                                            <td><input type="text" name="accred_contact_address[]"
                                                                    placeholder="Address"
                                                                    id="accred_contact_address_"
                                                                    class="form-control data- mtr_accred_contact_address"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata['annexure']['accred_contact_address'] ?? '' }}">
                                                                    
                                                                <i name="accred_contact_address."></i>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="accred_contact_phone[]"
                                                                        placeholder="Phone"
                                                                        id="accred_contact_phone_"
                                                                        class="form-control data- mtr_ accred_contact_phone"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure']['accred_contact_phone'] ?? '' }}"
                                                                        >
                                                                    <i name="accred_contact_phone."></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="accred_contact_email[]"
                                                                        placeholder="Email"
                                                                        id="accred_contact_email_"
                                                                        class="form-control data- mtr_accred_contact_email"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure']['accred_contact_email'] ?? '' }}" >
                                                                    <i name="accred_contact_email."></i>
                                                                </div>
                                                            </td>
                                                           
                                                                </div>
                                                            </td>
                                                        </tr>

                                                       
                                                        @endif
                                                        
                                                    </table>
                                                </span>

                                                <span id="detail_type_9"
                                                    style="display:@if(($annexuredata->subAnnexureType ?? '')==9))  @else none @endif">
                                                     <!-- 4.9 Accreditation Attachment -->
                                                    <table class="table text-center">
                                                        <tr>
                                                           <th>Accreditation Valid upto<small class="text-danger"> * </small></th>

                                                            <th>Attachment Certificate No<small class="text-danger"> * </small></th>
                                                           
                                                            
                                                        </tr>
                                                        @if(!Empty($annexuredata))
                                                       
                                                        <tr>
                                                             <td class="text-left">
                                                                    <div class="col-md-12">
                                                                        <input type="date" name="accred_valid_upto[]"
                                                                            placeholder="Accreditation date"
                                                                            id="accred_valid_upto_"
                                                                            class="form-control data- bcd_accred_valid_upto"
                                                                            maxlength="70"
                                                                            value="{{ $annexuredata['annexure']['accred_valid_upto'] ?? '' }}"
                                                                
                                                                            onchange="validateDates()">
                                                                        <i name="accred_valid_upto."></i>
                                                                    </div>
                                                                </td>
                                                            
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="number" name="accred_certificate_no[]"
                                                                        placeholder="Accreditation Certificate No."
                                                                        id="accred_certificate_no_"
                                                                        class="form-control data- bcd_accred_certificate_no"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure']['accred_certificate_no'] ?? '' }}" >
                                                                    <i name="accred_certificate_no."></i>
                                                                </div>
                                                            </td>
                                                                
                                                        </tr>
                                                        
                                                        @endif
                                                        <tr>
                                                            <td colspan="6" class="text-left">
                                                                <div class="col-md-12">
                                                                    <label for="">Attach Accreditation Certificate <span
                                                                            class="text-danger">*</span> <i
                                                                            class="text-danger">Note: Please upload all
                                                                            certificate in one PDF (Max. size allowed
                                                                            2MB)</i></label>
                                                                    <input type="file" name="accred_certificate"
                                                                        id="accred_certificate"
                                                                        class="form-control pdf_file_2mb">

                                                                    @if(($annexuredata->accred_certificate_no ?? '')!=null)
                                                                    <input type="hidden" name="old_accred_certificate"
                                                                        id="">
                                                                    <small><a target="_blank"
                                                                            href="{{URL::to($docBaseUrl.$annexuredata->doc_accred_certificate)}}"
                                                                            class="document">View
                                                                            Certificate</a></small>@endif
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
                                            <a href="{{URL::to('users/annexure-three/' .$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <!-- 4.0 BIS Registration view-->
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">4.0 BIS Registration / Certification Details</th>
                                    </tr>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>4.1 Module Technology</th>
                                        <th>4.2 Mean Wattage and application Range of Wattage</th>
                                        <!-- <th width="10%">Pmax (Wp) of Main Model</th>
                                        <th width="10%">Applicable models covered under ± 5% of Mean Wattage</th>
                                        <th width="10%">Pmax (Wp) of Applicable Models Model</th> -->
                                        <th>4.3 BIS Registration / Certificate No.</th>
                                        <th>4.4 BIS Certificate Issue</th>
                                        <th>4.5 BIS Certificate Valid</th>
                                        <th>Certificate</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $j = 1 @endphp
                                    
                                    @foreach($appData['bis'] as $sub_annex_1)
                                    <tr>
                                        
                                        <td>{{$j++}}</td>
                                        <td>{{$sub_annex_1->module_name}}</td>
                                        <td>{{$sub_annex_1->applicable_model_covered}}</td>
                                        <!-- <td class="text-center">{{$sub_annex_1->pmax_model}} Wp</td>
                                        <td class="text-center">
                                           
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            
                                            </table>
                                        </td> -->
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_1->annexure as $bis_certificate_no)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $bis_certificate_no->bis_certificate_no }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>

                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_1->annexure as $bis_certificate_issue)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ date("d-m-Y",strtotime($bis_certificate_issue->bis_certificate_issue)) }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_1->annexure as $bis_certificate_valid)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ date("d-m-Y",strtotime($bis_certificate_valid->bis_certificate_valid)) }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                       
                                        <td>
                                            <table width="100%">
                                                @php $bis_certificate=''; @endphp
                                                @foreach($sub_annex_1->annexure as $doc_certificate)

                                                @php $bis_certificate=$doc_certificate->doc_certificate; @endphp
                                                @endforeach
                                            </table>
                                            @if($bis_certificate!='')
                                            <small><a target="_blank" href="{{URL::to($docBaseUrl.$bis_certificate)}}"
                                                    class="document text-primary"><i
                                                        class="bi bi-file-pdf fa-2x text-danger"></i></a></small>@endif

                                        </td>


                                        <td> <a
                                                href="{{URL::to('users/annexure-three/' .$general->encodeid($sub_annex_1->application_id).'/'.$general->encodeid($sub_annex_1->id).'/1')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <br>
                            <!-- 4.6 BIS Organisation Details view -->
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">4.6 BIS Organisation Details</th>
                                    </tr>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Mean Wattage and application Range of Wattage</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <!-- <th>Valid NABL Certificate No. of Test Laboratory at the time of testing</th> -->
                                        <!-- <th>Certificate</th> -->
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($appData['nabl'] as $sub_annex_2)
                                    @php $check=0; @endphp
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$sub_annex_2->module_name}}</td>
                                        <td>{{$sub_annex_2->applicable_model_covered}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_2->annexure as $orgn_contact_name)
                                                @php $check=1; @endphp
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $orgn_contact_name->orgn_contact_name }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_2->annexure as $orgn_contact_address)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $orgn_contact_address->orgn_contact_address }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_2->annexure as $orgn_contact_phone)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $orgn_contact_phone->orgn_contact_phone }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_2->annexure as $orgn_contact_email)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $orgn_contact_email->orgn_contact_email }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <!-- <td>
                                            <table width="100%">
                                                @foreach($sub_annex_2->annexure as $valid_nabl_certificate_no)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $valid_nabl_certificate_no->valid_nabl_certificate_no }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td> -->
                                        <!-- <td>
                                            @php $nabl_certificate=''; @endphp
                                            @foreach($sub_annex_2->annexure as $doc_certificate)

                                            @php $nabl_certificate=$doc_certificate->doc_certificate; @endphp
                                            @endforeach

                                            @if($nabl_certificate!='')
                                            <small><a target="_blank" href="{{URL::to($docBaseUrl.$nabl_certificate)}}"
                                                    class="document text-primary"><i
                                                        class="bi bi-file-pdf fa-2x text-danger"></i></a></small> @endif
                                        </td> -->
                                        </td>
                                        <td> <a
                                                href="{{URL::to('users/annexure-three/'.$general->encodeid($sub_annex_2->application_id).'/'.$general->encodeid($sub_annex_2->id).'/2')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table> <br>
                            <!-- 4.7 Lab Contact Details view -->
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">4.7 Lab Contact Details</th>
                                    </tr>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Mean Wattage and application Range of Wattage</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <!-- <th>Valid NABL Certificate No. of Test Laboratory at the time of testing</th> -->
                                        <!-- <th>Certificate</th> -->
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($appData['lab'] as $sub_annex_3)
                                    @php $check=0; @endphp
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$sub_annex_3->module_name}}</td>
                                        <td>{{$sub_annex_3->applicable_model_covered}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_3->annexure as $lab_contact_name)
                                                @php $check=1; @endphp
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $lab_contact_name->lab_contact_name }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_3->annexure as $lab_contact_address)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $lab_contact_address->lab_contact_address }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_3->annexure as $lab_contact_phone)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $lab_contact_phone->lab_contact_phone }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_3->annexure as $lab_contact_email)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $lab_contact_email->lab_contact_email }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    
                                        </td>
                                        <td> <a
                                                href="{{URL::to('users/annexure-three/'.$general->encodeid($sub_annex_3->application_id).'/'.$general->encodeid($sub_annex_3->id).'/3')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table> <br>
                            <!-- 4.8 Accreditation Body Details view-->
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">4.8 Accreditation Body Details</th>
                                    </tr>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Mean Wattage and application Range of Wattage</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <!-- <th>Valid NABL Certificate No. of Test Laboratory at the time of testing</th> -->
                                        <!-- <th>Certificate</th> -->
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($appData['accred'] as $sub_annex_4)
                                    @php $check=0; @endphp
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$sub_annex_4->module_name}}</td>
                                        <td>{{$sub_annex_4->applicable_model_covered}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_4->annexure as $accred_contact_name)
                                                @php $check=1; @endphp
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_contact_name->accred_contact_name }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_4->annexure as $accred_contact_address)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_contact_address->accred_contact_address }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_4->annexure as $accred_contact_phone)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_contact_phone->accred_contact_phone }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_4->annexure as $accred_contact_email)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_contact_email->accred_contact_email }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <!-- <td>
                                            <table width="100%">
                                                @foreach($sub_annex_2->annexure as $valid_nabl_certificate_no)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $valid_nabl_certificate_no->valid_nabl_certificate_no }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td> -->
                                        <!-- <td>
                                            @php $nabl_certificate=''; @endphp
                                            @foreach($sub_annex_2->annexure as $doc_certificate)

                                            @php $nabl_certificate=$doc_certificate->doc_certificate; @endphp
                                            @endforeach

                                            @if($nabl_certificate!='')
                                            <small><a target="_blank" href="{{URL::to($docBaseUrl.$nabl_certificate)}}"
                                                    class="document text-primary"><i
                                                        class="bi bi-file-pdf fa-2x text-danger"></i></a></small> @endif
                                        </td> -->
                                        </td>
                                        <td> <a
                                                href="{{URL::to('users/annexure-three/'.$general->encodeid($sub_annex_4->application_id).'/'.$general->encodeid($sub_annex_4->id).'/4')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table> <br>
                             <!-- 4.9 Accreditation Body Details view -->
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th colspan="10" class=" text-left">4.9 Accreditation</th>
                                    </tr>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Module Technology</th>
                                        <th>Mean Wattage and application Range of Wattage</th>
                                        <th>Accreditation Valid upto </th>
                                        <th>Attach Accreditation Certificate</th>
                                        <th>Attachment No.</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $k = 1 @endphp
                                    @foreach($appData['accred_attach'] as $sub_annex_attach)
                                    <tr>
                                        <td>{{$k++}}</td>
                                        <td>{{$sub_annex_attach->module_name}}</td>
                                        <td>{{$sub_annex_attach->applicable_model_covered}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_attach->annexure as $accred_valid_upto)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_valid_upto->accred_valid_upto }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
			
		
                                            <table width="100%">
                                                @php $accred_certificate=''; @endphp
                                                @foreach($sub_annex_attach->annexure as $doc_accred_certificate)

                                                @php $accred_certificate=$doc_accred_certificate->doc_accred_certificate; @endphp
                                                @endforeach
                                            </table>
                                            @if($accred_certificate!='')
                                            <small><a target="_blank" href="{{URL::to($docBaseUrl.$accred_certificate)}}"
                                                    class="document text-primary"><i
                                                        class="bi bi-file-pdf fa-2x text-danger"></i></a></small>@endif
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_attach->annexure as $accred_certificate_no)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $accred_certificate_no->accred_certificate_no }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>

                                        <td> <a
                                                href="{{URL::to('users/annexure-three/' .$general->encodeid($sub_annex_attach->application_id).'/'.$general->encodeid($sub_annex_attach->id).'/9')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table><br>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-one-c/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    @if($check>0)
                                    <a href="{{URL::to('users/annexure-four/'.$general->encodeid($application_id))}}"
                                        class="btn btn-warning">Next <i class="bi bi-arrow-bar-right"></i></a>
                                    @endif
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

    @endpush