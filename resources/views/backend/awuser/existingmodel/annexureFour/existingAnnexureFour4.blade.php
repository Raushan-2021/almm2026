@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Annexure 4')
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

                        <div class="box-header with-border">
                            <a class="btn btn-success btn-sm" href="javascript:;"
                                onclick="$('#show_data').toggle('slow')"><i class="fa fa-plus"></i> Add</a>

                        </div>

                        <div class="box-body">

                            <form action="{{ URL::to('/users/existing-annexure-four-four')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Module Type</label>
                                                    <select name="module_type" id="module_type">
                                                        <option value="">Select</option>
                                                        <option value="1" @if(isset($annexuredata->module_type) &&
                                                            $annexuredata->module_type==1) selected @endif>Golden Module
                                                        </option>
                                                        <option value="2" @if(isset($annexuredata->module_type) &&
                                                            $annexuredata->module_type==2) selected @endif>Silver Module
                                                        </option>
                                                    </select>

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Machine Serial No.</label>
                                                    <input type="text" name="machine_serial_no"
                                                        placeholder="Enter Machine Serial No.y" id="machine_serial_no"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->machine_serial_no ?? '' }}">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Calibration Done by <i
                                                            class="text-primary">(Lab/Agency/Company Name with
                                                            Address)</i></label>
                                                    <input type="text" name="calibration_done_by" placeholder="Lab/Agency/Company Name with
                                                            Address" id="calibration_done_by" class="form-control"
                                                        value="{{ $annexuredata->calibration_done_by ?? '' }}">
                                                </div>
                                                <div class="col-md-12"><br></div>
                                                <div class="col-md-4">
                                                    <label for="">Last Calibration Date</label>
                                                    <input type="date" name="last_calibration_date"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="last_calibration_date" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->last_calibration_date ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Calibration Valid Upto</label>
                                                    <input type="date" name="calibration_valid_upto"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="calibration_valid_upto" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->calibration_valid_upto ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Calibration Report <i class="text-primary">(Only PDF
                                                            of Max 1MB allowed)</i></label>
                                                    <input type="file" name="calibration_certificate"
                                                        id="calibration_certificate" class="form-control">
                                                </div>
                                                <div style="clear:both;"></div>
                                                <hr>
                                                <div class="col-md-12">
                                                    <h3>Module Type and Power Rating
                                                        <hr>
                                                    </h3>
                                                </div><br>
                                                <div class="col-md-6">
                                                    <label for="">Technology</label>
                                                    <input type="text" name="technology_used"
                                                        placeholder="Technology Used" id="technology_used"
                                                        class="form-control" maxlength="200"
                                                        value="{{ $annexuredata->technology_used ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">No. of full Cell</label>
                                                    <input type="number" name="no_full_cell"
                                                        placeholder="No. of Full Cell" id="no_full_cell"
                                                        class="form-control"
                                                        value="{{ $annexuredata->no_full_cell ?? '0' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">No. of Half Cell</label>
                                                    <input type="number" name="no_half_cell"
                                                        placeholder="No. of Half Cell" id="no_half_cell"
                                                        class="form-control"
                                                        value="{{ $annexuredata->no_half_cell ?? '0' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Capacity (Wp)</label>
                                                    <input type="number" step="any" min="0" name="capacity"
                                                        placeholder="Enter" id="capacity" class="form-control"
                                                        value="{{ $annexuredata->capacity ?? '0' }}">
                                                </div>


                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="submit" name="submit" class="btn btn-success" id="submit">
                                                <i class='fa fa-check'></i> @if(isset($annexuredata->id) &&
                                                $annexuredata->id !='')Update @else Save @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <a href="{{URL::to('users/existing-annexure-four-four/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="fa fa-times"></i> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>5.4</th>
                                        <th scope="col" colspan="13" class="text-left">Calibration Details of Reference
                                            Modules
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th width="10%">Module Type</th>
                                        <th width="5%">S.No</th>
                                        <th width="20%">Module Type and Power Rating</th>
                                        <th width="10%">Machine Serial No.</th>
                                        <th>Calibration Done by (Lab/Agency/Company Name with Address)</th>
                                        <th width="10%">Last Calibration Date</th>
                                        <th width="10%">Calibration Valid Upto</th>
                                        <th>Calibration Report</th>
                                        <th width="10%"></th>

                                    </tr>
                                    @php $i=$j=$check=0; @endphp
                                    @foreach($appData as $data)
                                    @php $check=1; @endphp
                                    @if($data->module_type==1) @php $i++; @endphp
                                    <tr>
                                        @if($i==1)
                                        <td rowspan="{{$count['gold']}}">@if($data->module_type==1)Golden Module @else
                                            Silver
                                            Module
                                            @endif</td>@endif
                                        <td>{{$i}}</td>
                                        <td>
                                            <table class="" width="80%">
                                                <tr>
                                                    <th>Technology :</th>
                                                    <td>{{$data->technology_used}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Full Cell :</th>
                                                    <td>{{$data->no_full_cell}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Half Cell :</th>
                                                    <td>{{$data->no_half_cell}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Capacity :</th>
                                                    <td>{{$data->capacity}} Wp</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>{{$data->machine_serial_no}}</td>
                                        <td>{{$data->calibration_done_by}}</td>
                                        <td>{{$data->last_calibration_date}}</td>
                                        <td>{{$data->calibration_valid_upto}}</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$data->calibration_certificate)}}"
                                                class="document">View</a></small></a></td>
                                        <td><a
                                                href="{{URL::to('users/existing-annexure-four-four/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/4/'.$general->encodeid($data->id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>

                                    </tr>
                                    @endif

                                    @if($data->module_type==2) @php $j++; @endphp
                                    <tr>
                                        @if($j==1)
                                        <td rowspan="{{$count['silver']}}">@if($data->module_type==1)Golden Module @else
                                            Silver
                                            Module
                                            @endif</td>@endif
                                        <td>{{$j}}</td>
                                        <td>
                                            <table class="" width="80%">
                                                <tr>
                                                    <th>Technology :</th>
                                                    <td>{{$data->technology_used}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Full Cell :</th>
                                                    <td>{{$data->no_full_cell}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Half Cell :</th>
                                                    <td>{{$data->no_half_cell}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Capacity :</th>
                                                    <td>{{$data->capacity}} Wp</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>{{$data->machine_serial_no}}</td>
                                        <td>{{$data->calibration_done_by}}</td>
                                        <td>{{$data->last_calibration_date}}</td>
                                        <td>{{$data->calibration_valid_upto}}</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$data->calibration_certificate)}}"
                                                class="document">View</a></small></a></td>
                                        <td><a
                                                href="{{URL::to('users/existing-annexure-four-four/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/4/'.$general->encodeid($data->id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>

                                    </tr>
                                    @endif
                                    @endforeach

                                </tbody>
                                <tr>
                                    <th colspan="13">
                                        @if($check>0)

                                        <a href="{{URL::to('users/existing-annexure-four-five/'.$general->encodeid($application_id))}}"
                                            class="btn btn-warning" style="float:right">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        @endif
                                        <a href="{{URL::to('users/existing-annexure-four-three/'.$general->encodeid($application_id))}}"
                                            class="btn btn-danger" style="float:right"><i class="fa fa-arrow-left"></i>
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