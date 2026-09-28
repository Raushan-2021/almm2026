@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Annexure 3 :: BIS Certification and Module Test Reports Details')
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

                            <form action="{{ URL::to('/users/existing-annexure-three')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                    <tr>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="20%">Type of Model</th>
                                                    <td class="text-primary">{{$annexuredata->module_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="15%">Main Model</th>
                                                    <td class="text-primary">{{$annexuredata->main_model ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pmax (Wp) of Main Model</th>
                                                    <td colspan="3" class="text-primary">
                                                        {{$annexuredata->pmax_model ?? ''}} Wp</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-primary">
                                                        @if(($annexuredata->subAnnexureType ?? '')==1)BIS Certification
                                                        Details @else Module Test Reports Details @endif
                                                    </td>
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
                                                            <th>BIS Certificate No.</th>
                                                            <th>BIS Certificate issue date</th>
                                                            <th>BIS Certificate Valid Upto</th>

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
                                                                    <input type="text" name="bis_certificate_no[]"
                                                                        placeholder="BIS Certificate No."
                                                                        id="bis_certificate_no" class="form-control"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure'][$loop->iteration-1]['bis_certificate_no'] ?? '' }}">
                                                                    <i
                                                                        name="bis_certificate_no.{{$loop->iteration-1}}"></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="date" name="bis_certificate_issue[]"
                                                                        placeholder="BIS Certificate issue date"
                                                                        id="bis_certificate_issue" class="form-control"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure'][$loop->iteration-1]['bis_certificate_issue'] ?? '' }}">
                                                                    <i
                                                                        name="bis_certificate_issue.{{$loop->iteration-1}}"></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="date" name="bis_certificate_valid[]"
                                                                        placeholder="BIS Certificate issue date"
                                                                        id="bis_certificate_valid" class="form-control"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure'][$loop->iteration-1]['bis_certificate_valid'] ?? '' }}">
                                                                    <i
                                                                        name="bis_certificate_valid.{{$loop->iteration-1}}"></i>
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
                                                                            certificate in one PDF</i></label>
                                                                    <input type="file" name="bis_certificate"
                                                                        id="bis_certificate" class="form-control">

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
                                                            <th>Testing Standards</th>
                                                            <th>Test Report No.</th>
                                                            <th>Testing Laboratory</th>
                                                            <th>Testing Laboratory Address<br> <i
                                                                    class="text-primary">(Max. 300 Charactcters)</i>
                                                            </th>
                                                            <th>Valid NABL Certificate No. of Test Laboratory at the
                                                                time of testing</th>

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
                                                                    id="test_standard_module" class="form-control"
                                                                    maxlength="100"
                                                                    value="{{ $annexuredata['annexure'][$loop->iteration-1]['test_standard_module'] ?? '' }}">
                                                                <i
                                                                    name="test_standard_module.{{$loop->iteration-1}}"></i>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="test_report_no[]"
                                                                        placeholder="Test Report No."
                                                                        id="test_report_no" class="form-control"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure'][$loop->iteration-1]['test_report_no'] ?? '' }}">
                                                                    <i name="test_report_no.{{$loop->iteration-1}}"></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="testing_laboratory[]"
                                                                        placeholder="Testing Laboratory"
                                                                        id="testing_laboratory" class="form-control"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata['annexure'][$loop->iteration-1]['testing_laboratory'] ?? '' }}">
                                                                    <i
                                                                        name="testing_laboratory.{{$loop->iteration-1}}"></i>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <textarea name="testing_laboratory_address[]" id=""
                                                                        cols="30"
                                                                        rows="3">{{ $annexuredata['annexure'][$loop->iteration-1]['testing_laboratory_address'] ?? '' }}</textarea>
                                                                    <i
                                                                        name="testing_laboratory_address.{{$loop->iteration-1}}"></i>

                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <input type="text"
                                                                        name="valid_nabl_certificate_no[]"
                                                                        placeholder="Enter NABL Certificate No."
                                                                        id="valid_nabl_certificate_no"
                                                                        class="form-control"
                                                                        value="{{ $annexuredata['annexure'][$loop->iteration-1]['valid_nabl_certificate_no'] ?? '' }}">
                                                                    <i
                                                                        name="valid_nabl_certificate_no.{{$loop->iteration-1}}"></i>
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
                                                                        id="nabl_certificate" class="form-control">
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
                                                <i class='fa fa-check'></i> @if(isset($annexuredata->id) &&
                                                $annexuredata->id !='')Update @else Save @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                            <input type="hidden" name="subAnnexureType" id="subAnnexureType"
                                                value="@if(isset($annexuredata->subAnnexureType)){{$annexuredata->subAnnexureType}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <a href="{{URL::to('users/existing-annexure-three/' .$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="fa fa-times"></i> Cancel </a>

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
                                        <th>Type of Modules</th>
                                        <th>Main Model</th>
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
                                    <tr class="@if($sub_annex_1->filter ==1) table-success @endif">
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
                                                        {{ $bis_certificate_issue->bis_certificate_issue }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($sub_annex_1->annexure as $bis_certificate_valid)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $bis_certificate_valid->bis_certificate_valid }}</td>
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


                                        <td> @if($sub_annex_1->filter==2)<a
                                                href="{{URL::to('users/existing-annexure-three/' .$general->encodeid($sub_annex_1->application_id).'/'.$general->encodeid($sub_annex_1->id).'/1')}}">Edit
                                                <i class="fa fa-edit"></i></a>@endif
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
                                    @php $i = 1;$check=0; @endphp
                                    @foreach($appData['nabl'] as $sub_annex_2)
                                    <tr class="@if($sub_annex_2->filter ==1) table-success @endif">
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
                                        <td> @if($sub_annex_2->filter==2) <a
                                                href="{{URL::to('users/existing-annexure-three/'.$general->encodeid($sub_annex_2->application_id).'/'.$general->encodeid($sub_annex_2->id).'/2')}}">Edit
                                                <i class="fa fa-edit"></i></a>@endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <table class="table text-center">
                                <tr>
                                    <th colspan="13">
                                        @if($check>0)
                                        <a href="{{URL::to('users/existing-annexure-four/'.$general->encodeid($application_id))}}"
                                            class="btn btn-warning" style="float:right;">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        @endif
                                        <a href="{{URL::to('users/existing-annexure-two/'.$general->encodeid($application_id))}}"
                                            class="btn btn-danger" style="float:right;"><i class="fa fa-arrow-left"></i>
                                            Back </a>

                                    </th>
                                </tr>
                            </table>



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

    @endsection
    @push('backend-js')
    <script>
    function getDataValue(data) {
        var dt = $(data).find(':selected').attr('data-id');
        $('#model_code').val(dt);
    }

    function showDetailType(type) {
        $('#detail_type_2').hide();
        $('#detail_type_1').hide();
        if (type == 1) {
            $('#detail_type_1').show();
        } else {
            $('#detail_type_2').show();
        }

    }

    function showParameters(val) {
        $('.module_type').hide();
        $(".record" + val).remove();
        $('#module_type' + val).show();
    }
    </script>
    @endpush