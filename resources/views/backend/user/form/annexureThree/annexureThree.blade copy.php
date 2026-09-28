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
                                                        @if(($annexuredata->subAnnexureType ?? '')==1)4.1 BIS
                                                        Certification
                                                        Details @else 4.2 Module Test Reports Details @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="20%">Module Technology</th>
                                                    <td class="text-primary">{{$annexuredata->module_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="15%">Representative Main Model</th>
                                                    <td class="text-primary">{{$annexuredata->main_model ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pmax (Wp) of Main Model</th>
                                                    <td colspan="3" class="text-primary">
                                                        {{$annexuredata->pmax_model ?? ''}} Wp</td>
                                                </tr>

                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <span id="detail_type_1"
                                                    style="display:@if(($annexuredata->subAnnexureType ?? '')==1))  @else none @endif">
                                                    <table class="table text-center">
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th width="15%">Applicable models covered under ± 5% of Mean
                                                                Wattage</th>
                                                            <th width="15%">Pmax (Wp) of Applicable Models Model</th>
                                                            <th>BIS Certificate No.<small class="text-danger"> * </small></th>
                                                            <th>BIS Certificate issue date<small class="text-danger"> * </small></th>
                                                            <th>BIS Certificate Valid Upto<small class="text-danger"> * </small></th>

                                                        </tr>
                                                        @if(!Empty($annexuredata))
                                                        @foreach($annexuredata->applicable_model_covered as $value)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$annexuredata->applicable_model_covered[$loop->iteration-1] ?? ''}}
                                                            </td>
                                                            <td>{{$annexuredata->applicable_model[$loop->iteration-1] ?? ''}}
                                                                Wp</td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="number" name="bis_certificate_no[]"
                                                                        placeholder="BIS Certificate No."
                                                                        id="bis_certificate_no_{{$loop->iteration}}"
                                                                        class="form-control data-{{$loop->iteration}} bcd_bis_certificate_no"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure'][$loop->iteration-1]['bis_certificate_no'] ?? '' }}"
                                                                        @if($loop->iteration>1) readonly @endif>
                                                                    <i
                                                                        name="bis_certificate_no.{{$loop->iteration-1}}"></i>
                                                                </div>
                                                            </td>
                                                            <td>
    <div class="col-md-12">
        <input type="date" name="bis_certificate_issue[]"
            placeholder="BIS Certificate issue date"
            id="bis_certificate_issue_{{$loop->iteration}}"
            class="form-control data-{{$loop->iteration}} bcd_bis_certificate_issue"
            maxlength="70"
            value="{{ $annexuredata['annexure'][$loop->iteration-1]['bis_certificate_issue'] ?? '' }}"
            @if($loop->iteration>1) readonly @endif
            onchange="validateDates({{$loop->iteration}})">
        <i name="bis_certificate_issue.{{$loop->iteration-1}}"></i>
    </div>
</td>
<td class="text-left">
    <div class="col-md-12">
        <input type="date" name="bis_certificate_valid[]"
            placeholder="BIS Certificate issue date"
            id="bis_certificate_valid_{{$loop->iteration}}"
            class="form-control data-{{$loop->iteration}} bcd_bis_certificate_valid"
            maxlength="70"
            value="{{ $annexuredata['annexure'][$loop->iteration-1]['bis_certificate_valid'] ?? '' }}"
            @if($loop->iteration>1) readonly @endif
            onchange="validateDates({{$loop->iteration}})">
        <i name="bis_certificate_valid.{{$loop->iteration-1}}"></i>
        @if($loop->iteration>1)
        <input type="checkbox"
            name="same{{$loop->iteration-1}}"
            id="sameBCD{{$loop->iteration}}"
            onchange="copydataBCD({{$loop->iteration}})"
            style="font-size:12px;"> <span
            class="text-primary same_as_above">Autofill as
            filled
            above</span>
        @endif
    </div>
</td>
                                                        </tr>
                                                        @endforeach
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
                                                    <table class="table text-center">
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th width="15%">Applicable models covered under ± 5% of Mean
                                                                Wattage</th>
                                                            <th width="15%">Pmax (Wp) of Applicable Models Model</th>
                                                            <th>Testing Standards<small class="text-danger"> * </small></th>
                                                            <th>Test Report No.<small class="text-danger"> * </small></th>
                                                            <th>Testing Laboratory<small class="text-danger"> * </small></th>
                                                            <th>Testing Laboratory Address<small class="text-danger"> * </small><br> <i
                                                                    class="text-primary">(Max. 300 Charactcters)</i>
                                                            </th>
                                                            <th>Valid NABL Certificate No. of Test Laboratory at the
                                                                time of testing<small class="text-danger"> * </small></th>

                                                        </tr>
                                                        @if(!Empty($annexuredata))
                                                        @foreach($annexuredata->applicable_model_covered as $value)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$annexuredata->applicable_model_covered[$loop->iteration-1] ?? ''}}
                                                            </td>
                                                            <td>{{$annexuredata->applicable_model[$loop->iteration-1] ?? ''}}
                                                                Wp</td>
                                                            <td><input type="text" name="test_standard_module[]"
                                                                    placeholder="Testing Standards"
                                                                    id="test_standard_module_{{$loop->iteration}}"
                                                                    class="form-control data-{{$loop->iteration}} mtr_test_standard_module"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata['annexure'][$loop->iteration-1]['test_standard_module'] ?? '' }}"
                                                                    @if($loop->iteration>1) readonly @endif>
                                                                <i
                                                                    name="test_standard_module.{{$loop->iteration-1}}"></i>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="test_report_no[]"
                                                                        placeholder="Test Report No."
                                                                        id="test_report_no_{{$loop->iteration}}"
                                                                        class="form-control data-{{$loop->iteration}} mtr_test_report_no"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure'][$loop->iteration-1]['test_report_no'] ?? '' }}"
                                                                        @if($loop->iteration>1) readonly @endif>
                                                                    <i name="test_report_no.{{$loop->iteration-1}}"></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="testing_laboratory[]"
                                                                        placeholder="Testing Laboratory"
                                                                        id="testing_laboratory_{{$loop->iteration}}"
                                                                        class="form-control data-{{$loop->iteration}} mtr_testing_laboratory"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure'][$loop->iteration-1]['testing_laboratory'] ?? '' }}"
                                                                        @if($loop->iteration>1) readonly @endif>
                                                                    <i
                                                                        name="testing_laboratory.{{$loop->iteration-1}}"></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <textarea name="testing_laboratory_address[]"
                                                                        id="testing_laboratory_address_{{$loop->iteration}}"
                                                                        cols="30"
                                                                        class=" data-{{$loop->iteration}} mtr_testing_laboratory_address"
                                                                        rows="3"
                                                                        @if($loop->iteration>1) readonly @endif>{{ $annexuredata['annexure'][$loop->iteration-1]['testing_laboratory_address'] ?? '' }}</textarea>
                                                                    <i
                                                                        name="testing_laboratory_address.{{$loop->iteration-1}}"></i>

                                                                </div>
                                                            </td>
                                                            <td class="text-left">
                                                                <div class="col-md-12">
                                                                    <input type="text"
                                                                        name="valid_nabl_certificate_no[]"
                                                                        placeholder="Enter NABL Certificate No."
                                                                        id="valid_nabl_certificate_no_{{$loop->iteration}}"
                                                                        class="form-control data-{{$loop->iteration}} mtr_valid_nabl_certificate_no"
                                                                        value="{{ $annexuredata['annexure'][$loop->iteration-1]['valid_nabl_certificate_no'] ?? '' }}"
                                                                        @if($loop->iteration>1) readonly @endif>
                                                                    <i
                                                                        name="valid_nabl_certificate_no.{{$loop->iteration-1}}"></i>
                                                                    @if($loop->iteration>1)
                                                                    <input type="checkbox"
                                                                        name="same{{$loop->iteration-1}}"
                                                                        id="sameMTR{{$loop->iteration}}"
                                                                        onchange="copydataMTR({{$loop->iteration}})"
                                                                        style="font-size:12px;"> <span
                                                                        class="text-primary same_as_above">Autofill as
                                                                        filled
                                                                        above</span>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        @endforeach
                                                        @endif
                                                        <tr>

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
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">4.1 BIS Certification Details</th>
                                    </tr>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Module Technology</th>
                                        <th>Representative Main Model</th>
                                        <th width="10%">Pmax (Wp) of Main Model</th>
                                        <th width="10%">Applicable models covered under ± 5% of Mean Wattage</th>
                                        <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                        <th>BIS Certificate Issue</th>
                                        <th>BIS Certificate Valid</th>
                                        <th>BIS Certificate No.</th>
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
                                        <td>{{$sub_annex_1->main_model}}</td>
                                        <td class="text-center">{{$sub_annex_1->pmax_model}} Wp</td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($sub_annex_1->applicable_model_covered as
                                                $applicable_model_covered)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model_covered }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($sub_annex_1->applicable_model as $applicable_model)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model }} Wp</td>
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
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">4.2 Module Test Reports Details</th>
                                    </tr>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Main Model</th>
                                        <th width="10%">Pmax (Wp) of Main Model</th>
                                        <th width="10%">Applicable models covered under ± 5% of Mean Wattage</th>
                                        <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                        <th>Testing Standards</th>
                                        <th>Test Report No.</th>
                                        <th>Testing Laboratory</th>
                                        <th>Testing Laboratory Address</th>
                                        <th>Valid NABL Certificate No. of Test Laboratory at the time of testing</th>
                                        <th>Certificate</th>
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
                                        <td>{{$sub_annex_2->main_model}}</td>
                                        <td class="text-center">{{$sub_annex_2->pmax_model}} Wp</td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($sub_annex_2->applicable_model_covered as
                                                $applicable_model_covered)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model_covered }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($sub_annex_2->applicable_model as $applicable_model)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model }} Wp</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_2->annexure as $test_standard_module)
                                                @php $check=1; @endphp
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $test_standard_module->test_standard_module }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_2->annexure as $test_report_no)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $test_report_no->test_report_no }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_2->annexure as $testing_laboratory)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $testing_laboratory->testing_laboratory }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_2->annexure as $testing_laboratory_address)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $testing_laboratory_address->testing_laboratory_address }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_2->annexure as $valid_nabl_certificate_no)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $valid_nabl_certificate_no->valid_nabl_certificate_no }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            @php $nabl_certificate=''; @endphp
                                            @foreach($sub_annex_2->annexure as $doc_certificate)

                                            @php $nabl_certificate=$doc_certificate->doc_certificate; @endphp
                                            @endforeach

                                            @if($nabl_certificate!='')
                                            <small><a target="_blank" href="{{URL::to($docBaseUrl.$nabl_certificate)}}"
                                                    class="document text-primary"><i
                                                        class="bi bi-file-pdf fa-2x text-danger"></i></a></small> @endif
                                        </td>
                                        </td>
                                        <td> <a
                                                href="{{URL::to('users/annexure-three/'.$general->encodeid($sub_annex_2->application_id).'/'.$general->encodeid($sub_annex_2->id).'/2')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table> <br>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-two/'.$general->encodeid($application_id))}}"
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