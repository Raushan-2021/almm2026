@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Calibration Details of Sun Simulator')
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
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <span class="invalid-feedback all_valid_class" style="display:block">
                                {{ $error }} </span>
                            @endforeach
                            @endif
                            <form action="{{ URL::to('/users/annexure-four-three')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Make and Model<small class="text-danger"> * </small></label>
                                                    <input type="text" name="make_and_model"
                                                        placeholder="Enter Make and Model" id="make_and_model"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->make_and_model ?? '' }}">

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Machine Serial No.<small class="text-danger"> * </small></label>
                                                    <input type="text" name="machine_serial_no"
                                                        placeholder="Enter Machine Serial No." id="machine_serial_no"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->machine_serial_no ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Calibration Done by <i
                                                            class="text-primary">(Lab/Agency/Company Name with
                                                            Address)<small class="text-danger"> * </small></i></label>
                                                    <input type="text" name="calibration_done_by"
                                                        placeholder="Lab/Agency/Company Name with Address"
                                                        id="calibration_done_by" class="form-control"
                                                        value="{{ $annexuredata->calibration_done_by ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12"><br></div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Last Calibration Date<small class="text-danger"> * </small></label>
                                                    <input type="date" name="last_calibration_date"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="last_calibration_date" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->last_calibration_date ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="calibration_valid_upto">Calibration Valid Upto<small class="text-danger"> * </small></label>
                                                    <input type="date" name="calibration_valid_upto"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="calibration_valid_upto" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->calibration_valid_upto ?? '' }}" 
                                                        max="{{ date('Y-m-d') }}" 
                                                        onchange="checkIfFutureDate(this)">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Calibration Certificate <i class="text-primary">(Only
                                                            PDF of Max 2MB allowed)<small class="text-danger"> * </small></i></label>
                                                    <input type="file" name="calibration_certificate"
                                                        id="calibration_certificate" class="form-control pdf_file_2mb">
                                                </div>

                                            </div>

                        </div>
                        </th>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="submit" class="btn btn-success" id="submit">
                                    <i class='bi bi-arrow-bar-up'></i> @if(isset($annexuredata->id) && $annexuredata->id
                                    !='')Update @else Save @endif</button>
                                <input type="hidden" name="edit_id" id="edit_id"
                                    value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                <input type="hidden" name="application_id" id="application_id"
                                    value="{{$general->encodeid($application_id)}}">
                                <a href="{{URL::to('users/annexure-four-three/'.$general->encodeid($application_id))}}"
                                    class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>

                            </td>
                        </tr>
                        </table>


                        </form>
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr class="bg-warning">
                                    <th>5.3</th>
                                    <th scope="col" colspan="13" class="text-left">Calibration Details of Sun Simulator
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th width="6%">Equipment/Module</th>
                                    <th width="5%">S.No</th>
                                    <th width="10%">Make and Model</th>
                                    <th width="10%">Machine Serial No.</th>
                                    <th>Calibration Done by (Lab/Agency/Company Name with Address)</th>
                                    <th width="10%">Last Calibration Date</th>
                                    <th width="10%">Calibration Valid Upto</th>
                                    <th>Certificate</th>
                                    <th width="10%"></th>

                                </tr>
                                @php $check=0; @endphp
                                @foreach($appData as $data)
                                @php $check=1; @endphp
                                <tr>
                                    <td>Sun Simulator</td>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->make_and_model}}</td>
                                    <td>{{$data->machine_serial_no}}</td>
                                    <td>{{$data->calibration_done_by}}</td>
                                    <td>{{date('d-m-Y', strtotime($data->last_calibration_date))}}</td>
                                    <td>{{date('d-m-Y', strtotime($data->calibration_valid_upto))}}</td>
                                    <td><a target="_blank"
                                            href="{{URL::to($docBaseUrl.$data->calibration_certificate)}}"
                                            class="document">View</a></small></a></td>
                                    <td><a
                                            href="{{URL::to('users/annexure-four-three/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                            <i class="bi bi-pencil-square"></i></a>
                                        <a href="{{URL::to('users/delete-annexure/4/'.$general->encodeid($data->id))}}"
                                            onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                            class="text-danger">Delete <i class="bi bi-trash-fill"></i></a>
                                    </td>

                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="{{URL::to('users/annexure-four-two/'.$general->encodeid($application_id))}}"
                                    class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                    Back </a>
                                @if($check>0)

                                <a href="{{URL::to('users/annexure-four-four/'.$general->encodeid($application_id))}}"
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

@endsection