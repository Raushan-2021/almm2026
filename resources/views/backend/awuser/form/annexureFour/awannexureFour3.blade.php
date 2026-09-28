@inject('general', 'App\Http\Controllers\Backend\mfft\AwAnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Manufacturing Facility Details')
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
    <a class="nav-link " href="{{ URL::to('mfft/module-master/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Solar PV Modules<br> 4.0</div>
    </a>
</li> -->

<!-- <li class="nav-item">
   <a class="nav-link " href="{{ URL::to('mfft/annexure-one/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Mechanical Data<br>4.1 - 4.2</div>
    </a>
</li> -->

<!-- <li class="nav-item">
    <a class="nav-link" href="{{ URL::to('mfft/annexure-one-b/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Electrical Data <br>4.3</div>
    </a>
</li> -->

<!-- <li class="nav-item">
    <a class="nav-link" href="{{ URL::to('mfft/annexure-one-c/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Solar Cell & BoM<br>4.4- 4.5</div>
    </a>
</li> -->

<li class="nav-item">
        <a class="nav-link" href="{{ URL::to('mfft/annexure-four/' . $general->encodeid($application_id)) }}" style="    background: #009948!important; color: #ffffff !important;">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> 2. Collaboration </div>
    </a><img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}" >
    </li>

    <li class="nav-item">
	<a class="nav-link" href="{{ URL::to('mfft/annexure-four-two/' . $general->encodeid($application_id)) }}" style="    background: #009948!important; color: #ffffff !important;">
		<p class="arrow-down">
			<p class="arrow-down-inner"></p>
		</p>
		<div> 3. Type Certificate Details </div>
	</a><img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}" >
    </li>

    <li class="nav-item">
    <a class="nav-link active" href="{{ URL::to('mfft/annexure-four-three/'  .$general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
      <div>4. Manufacturing Facility</div>
    </a><img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}" >
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
    
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="comn_drop_shdow">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box-body">

                        
                        <form action="{{ URL::to('/mfft/annexure-four-three')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <?php //print_r($annexuredata); ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>
                                            <div class="row" >
                                                <!-- 4.0  (a - c) Manufacturing Facility -->
                                                <span id="detail_type_701"
                                                    style="display:@if($edit_id==701))  @else none @endif">
                                                    <!-- style="display:@if(($annexuredata->subAnnexureType ?? '')==11))  @else none @endif"> -->
                                                    <!-- Dynamic Table -->    
                                             
@php
    $defaultParts = ['Nacelle', 'Hub', 'Tower', 'Blade', 'Gearbox', 'Generator', 'Special Bearings'];
@endphp

<table class="table table-bordered text-center" id="windTurbineTable">
    <thead>
        <tr>
            <th>Wind Turbine Parts</th>
            <th>Wind Turbine Model</th>
            <th>Number of Manufacturing Facility</th>
            <th>Location Details</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>


   @if(count($annexuremultipledata)==0)
        @foreach ($defaultParts as $index => $part)
     
        <tr>
            <!-- <input type="hidden" name="id[]" value="{{ $annexuremultipledata[$index]->id ?? '' }}"> -->
            <td>
                <select name="wind_turbine_part[]" class="form-control">
                    <option value="{{ $part }}" selected>{{ $part }}</option>
                </select>
            </td>
            <td>
                <input type="text" name="wind_turbine_model[]" class="form-control" value="{{ $annexuremultipledata[$index]->wind_turbine_model ?? '' }}" required>
            </td>
            <td>
                <input type="number" name="mfg_facility_no[]" class="form-control" value="{{ $annexuremultipledata[$index]->mfg_facility_no ?? '' }}" min="0" required>
            </td>
            <td>
                <input type="text" name="location_details[]" class="form-control" value="{{ $annexuremultipledata[$index]->nacelle_address ?? '' }}" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
            </td>
        </tr>
        @endforeach
        @else

@foreach($annexuremultipledata as $annexuremultipledata1)
 <tr>
       
            <td>
                <input type="text" name="wind_turbine_part[]" class="form-control" value="{{ $annexuremultipledata1->wind_turbine_part ?? '' }}"  placeholder="Enter part name" required="">
            </td>
            <td>
                <input type="text" name="wind_turbine_model[]" class="form-control" value="{{ $annexuremultipledata1->wind_turbine_model ?? '' }}" required>
            </td>
            <td>
                <input type="number" name="mfg_facility_no[]" class="form-control" value="{{ $annexuremultipledata1->mfg_facility_no ?? '' }}" min="0" required>
            </td>
            <td>
                <input type="text" name="location_details[]" class="form-control" value="{{ $annexuremultipledata1->nacelle_address ?? '' }}" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger" onclick="removeRow1({{$annexuremultipledata1->id}})">Remove</button>
            </td>
        </tr>
  @endforeach

@endif

    </tbody>
</table>
<div class="d-flex justify-content-end mb-2">
    <button type="button" class="btn btn-success" onclick="addRow()">+ Add Row</button>
</div>
<script>
    function addRow() {
        const tableBody = document.getElementById("windTurbineTable").getElementsByTagName('tbody')[0];

        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <input type="hidden" name="id[]" value="">

            <td>
                <input type="text" name="wind_turbine_part[]" class="form-control" placeholder="Enter part name" required>
            </td>
            <td>
                <input type="text" name="wind_turbine_model[]" class="form-control" required>
            </td>
            <td>
                <input type="number" name="mfg_facility_no[]" class="form-control" min="0" required>
            </td>
            <td>
                <input type="text" name="location_details[]" class="form-control" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
            </td>
        `;

        tableBody.appendChild(newRow);
    }

    function removeRow(button) {
        const row = button.closest('tr');
        row.remove();
    }
    
</script>

                                                </span>
                                             </div>

                                            <!-- ISO Certificate -->
                                            <div class="row">
                                                <!-- 4. (d - g) ISO Certification Body view-->
                                                <span id="detail_type_702"
                                                    style="display:@if(($edit_id ?? '')==702))  @else none @endif">
                                                    <!-- ISO Certificate -->
                                                    <table class="table text-center">
                                                        <tr>
                                                            <th>d). ISO Certificate Name of Applicant<small class="text-danger"> * </small></th>
                                                            <th>e). Name of the ISO Certification Body<small class="text-danger"> * </small></th>
                                                            <th>f). ISO Certificate as per standard<small class="text-danger"> * </small></th>
                                                            <th>g). Validity of the ISO certificate<small class="text-danger"> * </small></th>
                                                            <th>g). Certificate Document<small class="text-danger"> * </small></th>
                                                        </tr>
                                                        @if(!Empty($edit_id) && $edit_id==702)
                                                        <tr>
                                                        
                                                                <td class="col-md-2"> 
                                                                       <label for="">ISO Certificate Name of Applicant<small class="text-danger"> * </small></label> 
                                                                       <input type="text" name="iso_certificate"
                                                                        placeholder="Enter ISO Certificate Name of Applicant" id="iso_certificate"
                                                                        class="form-control" maxlength="70"
                                                                        value="{{ $annexuredata->iso_certificate ?? '' }}">
                                                                </td> 
                                                    
                                                                <td class="col-md-2">
                                                                    <label for="">Name of the ISO Certificate Body<small class="text-danger"> * </small></label>
                                                                    <input type="text" name="issuing_agency" id="issuing_agency"
                                                                    placeholder="Name of the ISO Certification Body"
                                                                        class="form-control" value="{{ $annexuredata->issuing_agency ?? '' }}">
                                                                </td>
                                                            
                                                                <td class="col-md-2">
                                                                      <label for="issuing_date">ISO Certificate as per standard<small class="text-danger"> * </small></label>
                                                                      <input type="date" name="issuing_date" id="issuing_date" placeholder="ISO Certificate as per standard"
                                                                        class="form-control" maxlength="70"
                                                                        value="{{ $annexuredata->issuing_date ?? '' }}"
                                                                        max="{{ date('Y-m-d') }}" >
                                                                </td>
                                                        
                                                                <td class="col-md-2">
                                                                    <label for="certificate_validate">Certificate Valid Upto<small class="text-danger"> * </small></label>
                                                                    <input type="date" name="certificate_validate" id="certificate_validate"
                                                                        class="form-control" maxlength="70"
                                                                        value="{{ $annexuredata->certificate_validate ?? '' }}"
                                                                        min="{{ date('Y-m-d') }}">
                                                                </td>
                                                                <td class="col-md-3">
                                                                    <label for="">Upload ISO Certificate
                                                                        <small>
                                                                            <i>( PDF format Only and Max. 2MB allowed)
                                                                                <small class="text-danger"> * </small>
                                                                            </i>
                                                                        </small>
                                                                    </label>
                                                                    <input type="file" name="iso_certificate_doc" id="iso_certificate_doc" class="form-control pdf_file_2mb">

                                                                    @if(!empty($annexuredata->iso_certificate_doc))
                                                                        <input type="hidden" name="old_iso_certificate_doc" value="{{ $annexuredata->iso_certificate_doc }}">
                                                                        @php
                                                                            // Generate the preview URL
                                                                            $docUrl = url('mfft/preview-docs/' . $annexuredata->iso_certificate_doc);
                                                                        @endphp
                                                                        <small>
                                                                            <a target="_blank" href="{{ $docUrl }}">
                                                                                <i class="bi bi-file-pdf fa-2x text-danger"></i> View Certificate
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </td>
                                                        </tr>
                                                        @endif
                                                    
                                                    </table>
                                                </span>
                                            </div>
                                        
                                            <!-- 4 (h - k) Accreditation -->
                                            <div class="row">
                                                <span id="detail_type_703"
                                                  <?php //print_r($annexuredata); ?>
                                                    style="display:@if(($edit_id)==703))  @else none @endif">
                                                    <?php //print_r($annexuredata); ?>
                                                     <!-- 7.8 ISO Certificate Contact Details-->
                                                    <table class="table text-center" >
                                                        <tr>
                                                            <th>Name of the Accreditation Body<small class="text-danger"> * </small></th>
                                                            <th>Accreditation valid upto <small class="text-danger"> * </small></th>
                                                            <th>Accreditation Certificate<small class="text-danger"> * </small></th>
                                                            <th>Contact Person of Certification Body for authentication of ISO Certificate<small class="text-danger"> * </small>
                                                            <th>Contact details including E-mail of Contact Person for authentication of ISO Certificate<small class="text-danger"> * </small></th><br> 
                                                        </tr>

                                                        @if(!Empty($edit_id) && $edit_id==703)
                                                       
                                                        <tr>
                                                            <td class="col-md-2"><input type="text" name="iso_name_body"
                                                                    placeholder="Accreditation Body Name"
                                                                    id="iso_name_body"
                                                                    class="form-control iso_name_body"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata->iso_name_body ?? '' }}">
                                                            </td>
                                                            <td class="col-md-2">
                                                                    <!-- <label for="accred_date">Issuing Date<small class="text-danger"> * </small></label> -->
                                                                    <input type="date" name="accred_date" id="accred_date" placeholder="Valid upto"
                                                                        class="form-control" maxlength="70"
                                                                        value="{{ $annexuredata->accred_date ?? '' }}"
                                                                        min="{{ date('Y-m-d') }}" >
                                                            </td>
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
                                                            <!-- <td><input type="text" name="iso_address_body[]"
                                                                    placeholder="Accreditation Body Address"
                                                                    id="iso_address_body_"
                                                                    class="form-control iso_address_body"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata->annexure[0]['iso_address_body'] ?? '' }}">
                                                                    
                                                            </td> -->
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="iso_phone_body"
                                                                        placeholder="Contact Person Phone"
                                                                        id="iso_phone_body"
                                                                        class="form-control iso_phone_body"
                                                                        maxlength="10"
                                                                        value="{{ $annexuredata->iso_phone_body ?? '' }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="iso_email_body"
                                                                        placeholder="Contact Person Email"
                                                                        id="iso_email_body_"
                                                                        class="form-control iso_email_body"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata->iso_email_body ?? '' }}" >
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
                                                <i class='bi bi-arrow-bar-up'></i> @if(isset($application_id) &&
                                                $application_id !='')Update @else Save @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($application_id)){{$general->encodeid($application_id)}}@endif">
                                            <input type="hidden" name="subAnnexureType" id="subAnnexureType"
                                                value="@if(isset($edit_id)){{$edit_id}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <a href="{{URL::to('mfft/annexure-four-three/' .$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </form>
                            
                           <!-- 4. start Manufacturing Facility Details -->
                           <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                            <th colspan="9" class="text-left align-middle">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>4. Manufacturing Facility Details</span>
                                                    
                                                    @if ($annexuremultipledata->isEmpty())
                                                        <a href="{{ URL::to('mfft/annexure-four-three/' . $general->encodeid($application_id) . '/701') }}"
                                                        class="btn btn-sm btn-success">
                                                            Add New <i class="bi bi-plus-circle"></i>
                                                        </a>
                                                    @endif

                                                </div>
                                            </th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>a). Wind Turbine Part</th>
                                        <th>b). Number of Manufacturing Facility</th>
                                        <th>c). Location Details</th>
                                        <th>d). Wind Turbine Model</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($annexuremultipledata as $index => $row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $row->wind_turbine_part }}</td>
                                        <td>{{ $row->mfg_facility_no }}</td>
                                        <td>{{ $row->nacelle_address }}</td>
                                        <td>{{ $row->wind_turbine_model }}</td>
                                        <td>
                                        <a href="{{ url('mfft/annexure-four-three/' . $general->encodeid($application_id) . '/701') }}"
                                            class="btn btn-sm btn-primary" title="Edit">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <!-- <form action="{{ url('mfft/delete-annexure/11/' . $general->encodeid($application_id)) }}"
                                            method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bi bi-trash-fill"></i> Delete
                                            </button>
                                        </form> -->
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>


                            <!-- 4. (d - g) ISO Certification Body view-->
                            <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th>4. (d - g)</th>
                                        <th colspan="13" class="text-left">ISO Certification Details for the
                                            Manufacturing Plant
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-primary text-white" >
                                        <th width="5%">S.No</th>
                                        <th width="20%">d). ISO Certificate number for the  Nacelle & Hub assembly /manufacturing facility issued in the name of applicant</th>
                                        <th width="20%">e). Name of the ISO Certification Body</th>
                                        <th width="20%">f). ISO Certificate as per standard</th>
                                        <th width="20%">g). Validity of the ISO certificate</th>
                                        <!-- <th>g). Certificate Document</th> -->
                                        <th width="15%">Action</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>{{$annexuredata->iso_certificate}}</td>
                                        <td>{{$annexuredata->issuing_agency}}</td>
                                        <td>{{date("d-m-Y", strtotime($annexuredata->issuing_date))}}</td>
                                        <td style="position:relative">{{date("d-m-Y", strtotime($annexuredata->certificate_validate))}} <span style="position: absolute;
                                                    right: 0;
                                                    top: 0px;"> 
                                                    @if(!empty($annexuredata->iso_certificate_doc))
                                                    <small>
                                                    @php
                                                    $docUrl = url('storage/documents/' . $annexuredata->iso_certificate_doc);
                                                     @endphp
                                                <a target="_blank" href="{{ $docUrl }}">
                                                    <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                </a>
                                              </small>
                                            @else
                                                <small>No certificate </small>
                                            @endif</span>
                                        </td>
                                      
                                        <td><a
                                                href="{{URL::to('mfft/annexure-four-three/' .$general->encodeid($application_id).'/702')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                            <a href="{{URL::to('mfft/delete-annexure/4/'.$general->encodeid($application_id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="bi bi-trash-fill"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    
                            </table>
                            <br>
                            
                            <!-- 4 (h - k) Accreditation -->
                            <table class="table table-bordered mt-4">
                                <thead>
                                    <tr >
                                        <th>4. (h - k) </th>
                                        <th scope="col" colspan="13" class="text-left">The Accreditation Body</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-primary text-white">
                                        <th width="5%">S.No</th>
                                        <th width="10%">Name of the Accreditation Body</th>
                                        <th width="10%">Accreditation Valid upto</th>
                                        <th width="10%">Attach Accreditation Certificate </th>
                                        <th width="10%">Contact Person of Certification Body for authentication of ISO Certificate</th>
                                        <th width="10%">Contact details including E-mail of Contact Person for authentication of ISO Certificate</th>
                                        <th width="5%"></th>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td>{{$annexuredata->iso_name_body}}</td>
                                        <td>{{date("d-m-Y", strtotime($annexuredata->accred_date))}}</td>
                                        <td><table width="100%">
                                                <?php if(isset($annexuredata->accred_cert_doc) && $annexuredata->accred_cert_doc){ ?>
                                                    <small>
                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->accred_cert_doc) }}" class="document text-primary">
                                                            <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                        </a>
                                                    </small>
                                                <?php } ?>
                                            </table>
                                        </td>
                                        <td>{{$annexuredata->iso_phone_body}}</td>
                                        <td>{{$annexuredata->iso_email_body}}</td>
                                        <td><a href="{{URL::to('mfft/annexure-four-three/' .$general->encodeid($application_id).'/703')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                            <a href="{{URL::to('mfft/delete-annexure/13/'.$general->encodeid($application_id))}}"
                                            onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                            class="text-danger">Delete <i class="bi bi-trash-fill"></i></a></td>
                                    </tr>

                                </tbody>
                            </table>
                            <br>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('mfft/annexure-four-two/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    
                                    <a href="{{URL::to('mfft/application-affdt-indt/'.$general->encodeid($application_id))}}"
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