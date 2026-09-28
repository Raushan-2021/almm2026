@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'BIS Registration / Certification Details')
@section('content')
@php $docBaseUrl ='users/preview-docs/Annexure/';
$attcBaseUrl ='users/preview-docs/Attachment/';
@endphp
<?php
use App\Models\Module;
?>
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
    <a class="nav-link " href="{{ URL::to('users/annexure-four-three/'  .$general->encodeid($application_id)) }}">
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
    <a class="nav-link active" href="{{ URL::to('users/annexure-three/' . $general->encodeid($application_id)) }}">
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

<!-- Tab panes -->

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

                            <form action="{{ URL::to('/users/annexure-three')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($type ?? '')==1)  @else none @endif">
                                    <tr>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                               
                                                    <td colspan="4" class="bg-primary text-light">
                                                        @if(($type ?? '')==1)
                                                        4.0 BIS Registration / Certification Details
                                                         <!-- @elseif(($annexuredata->subAnnexureType ?? '')==2)  -->
                
                                                         @endif
                                                    </td>
                                                </tr>
                                                <!-- <tr>
                                                    <th width="20%">Module Technology</th>
                                                    <td class="text-primary">{{$annexuredata->module_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="15%">Mean Wattage and application Range of Wattage</th>
                                                    <td class="text-primary">{{$annexuredata->applicable_model_covered ?? ''}}</td>
                                                </tr> -->
                                              
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <span id="detail_type_1"
                                                    style="display:@if(($type ?? '')==1))  @else none @endif">
                                                     <!-- 4.0 BIS Registration -->
                                                    <table class="table text-center">
                                                        <tr>
                                                            <th>BIS Registration No.<small class="text-danger"> * </small></th>
                                                            <th>Date of Inclusion in BIS<small class="text-danger"> * </small></th>
                                                            <th>Date till which BIS Registration is Valid<small class="text-danger"> * </small></th>
                                                            <th>Upload BIS Registration Certificate<small class="text-danger"> * </small></th>

                                                        </tr>
                                                        @if(!Empty($annexuredata))
                                                       
                                                        <tr>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="number" name="bis_certificate_no"
                                                                        placeholder="BIS Certificate No."
                                                                        id="bis_certificate_no_"
                                                                        class="form-control"
                                                                        maxlength="70"
                                                                        value="{{  $annexuredata['bis_certificate_no'] ?? '' }}" >
                                                                    <i name="bis_certificate_no."></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                    <div class="col-md-12">
                                                                        <input type="date" name="bis_certificate_issue"
                                                                            placeholder="BIS Certificate issue date"
                                                                            id="bis_certificate_issue_"
                                                                            class="form-control data- bcd_bis_certificate_issue"
                                                                            maxlength="70"
                                                                            value="{{ $annexuredata['bis_certificate_issue'] ?? '' }}"
                                                                            max="{{ date('Y-m-d') }}"> <!-- Limit to today or past dates -->
                                                                        <i name="bis_certificate_issue."></i>
                                                                    </div>
                                                            </td>
                                                            <td>
                                                                    <div class="col-md-12">
                                                                        <input type="date" name="bis_certificate_valid"
                                                                            placeholder="BIS Certificate Valid date"
                                                                            id="bis_certificate_valid_"
                                                                            class="form-control data- bcd_bis_certificate_valid"
                                                                            maxlength="70"
                                                                            value="{{ $annexuredata['bis_certificate_valid'] ?? '' }}"
                                                                            max="{{ date('Y-m-d') }}"> <!-- Limit to today or past dates -->
                                                                        <i name="bis_certificate_valid."></i>
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
                                                value="1">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <a href="{{URL::to('users/annexure-three/' .$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>
                                        </td>
                                    </tr>
                                </table>

                            </form>
                            <!-- 4.0 BIS Registration view-->
                            <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">5.0 BIS Registration / Certification Details</th>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th>Model Names of Solar Modules</th>
                                        <th>Model Wattage</th>
                                        <!-- <th width="10%">Pmax (Wp) of Main Model</th>
                                        <th width="10%">Applicable models covered under ± 5% of Mean Wattage</th>
                                        <th width="10%">Pmax (Wp) of Applicable Models Model</th> -->
                                        <th> BIS Registration No.</th>
                                        <th> Date of Inclusion in BIS</th>
                                        <th> Date till which BIS Registration is Valid</th>
                                        <th> Upload BIS Registration Certificate</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @php $i = 1 @endphp
                                    @foreach($appData as $data)
                                    
                                    <?php                                    
                                        $rows=Module::where('id',$data->module_type)->first();
                                        ?>
                                         @php $i++;$check=0; @endphp
                                         <tr class="text-center">
                                            <td>{{$i}}</td>
                                            <td>{{ $rows->sub_model_name }}</td>
                                            <td class="">{{ $rows->sub_model_wattage }}</td>
                                            <td>R-{{ $data->bis_certificate_no }}</td>
                                            <td>{{ $data->bis_certificate_issue }}</td>
                                            <td>{{ $data->bis_certificate_valid }}</td>
                                            <td>
                                                @php $nabl_certificate=''; @endphp
                                                @php $nabl_certificate=$data->doc_certificate; @endphp
                                                @if($nabl_certificate!='')
                                                <small><a target="_blank" href="{{URL::to($docBaseUrl.$nabl_certificate)}}"
                                                class="document text-primary"><i class="bi bi-file-pdf fa-2x text-danger"></i></a></small>
                                                @endif
                                            </td>
                                            <td> 
                                              <a href="{{URL::to('users/annexure-three/' .$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/1')}}">Edit
                                              <i class="bi bi-pencil-square"></i></a>
                                            </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <br>

                                    <form action="{{ URL::to('/users/annexure-one-d-attachment')}}" method="POST"
                                        enctype="multipart/form-data" id="formFileAjax1">
                                        @csrf
                                        @method('POST')
                                        <hr>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Upload Electric Data sheet <span class="text-danger">*</span> <br> <small
                                                        class="text-primary">(Max.
                                                        2MB and PDF Format
                                                        Only)</small>
                                                </td>
                                                <td> <input type="file" name="bis_test_report" id="bis_test_report"
                                                        class="from-control pdf_file_2mb"
                                                        style="width: 26%;margin-right: 10px;" />
                                                        <!-- onchange="showUploadButton()" -->
                                                    <input type="submit" name="submit" value="upload"
                                                        class="btn btn-success btn-sm" />
                                                        <!-- style="display: none;" -->
                                                    @if($bis_test_report->bis_test_report!='')
                                                    <span>
                                                        <strong><a target="_blank"
                                                                href="{{URL::to($attcBaseUrl.$bis_test_report->bis_test_report)}}"
                                                                class="document1 text-danger"
                                                                style="float:right; font-size:12px !important">View
                                                                Electric Data sheet </a></strong>
                                                    </span>
                                                    @endif <br>
                                                    @error('bis_test_report') <span class="text-danger">
                                                        {{ $message }} </span> @enderror
                                                    <input type="hidden" name="application_id" id="application_id"
                                                        value="{{$general->encodeid($application_id)}}">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                           
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-one-c/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    
                                    <a href="{{URL::to('users/application-fees/'.$general->encodeid($application_id))}}"
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

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
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