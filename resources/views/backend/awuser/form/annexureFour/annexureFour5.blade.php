@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'ISO Certification Details')
@section('content')
@php $docBaseUrl ='users/preview-docs/Certificate/';
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

                            <form action="{{ URL::to('/users/annexure-four-five')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">ISO Certificate Title<small class="text-danger"> * </small></label>
                                                    <input type="text" name="iso_certificate"
                                                        placeholder="Enter ISO Certificate Title" id="iso_certificate"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->iso_certificate ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">ISO Certificate <small> <i>( PDF format
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
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="">Issuing Agency with Address<small class="text-danger"> * </small></label>
                                                    <textarea name="issuing_agency" id="issuing_agency" cols="30"
                                                        rows="5"
                                                        class="form-control">{{ $annexuredata->issuing_agency ?? '' }}</textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="issuing_date">Issuing Date<small class="text-danger"> * </small></label>
                                                    <input type="date" name="issuing_date" id="issuing_date"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->issuing_date ?? '' }}"
                                                        max="{{ date('Y-m-d') }}" >
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="certificate_validate">Certificate Valid Upto<small class="text-danger"> * </small></label>
                                                    <input type="date" name="certificate_validate" id="certificate_validate"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->certificate_validate ?? '' }}"
                                                        min="{{ date('Y-m-d') }}" >
                                                 </div>
 

                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="submit" name="submit" class="btn btn-success" id="submit">
                                                <i class='bi bi-arrow-bar-up'></i> @if(isset($annexuredata->id) &&
                                                $annexuredata->id !='')Update @else Save @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <a href="{{URL::to('users/annexure-four-five/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>5.5</th>
                                        <th scope="col" colspan="13" class="text-left">ISO Certification Details for the
                                            Manufacturing Plant
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th width="5%">S.No</th>
                                        <th width="20%">ISO Certificate</th>
                                        <th width="30%">Issuing Agency with Address</th>
                                        <th width="10%">Issuing Date</th>
                                        <th width="10%">Certificate Valid Upto</th>
                                        <th>Certificate Document</th>
                                        <th width="10%"></th>

                                    </tr>
                                    @php $check=0; @endphp
                                    @foreach($appData as $data)
                                    @php $check=1; @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->iso_certificate}}</td>
                                        <td>{{$data->issuing_agency}}</td>
                                        <td>{{date("d-m-Y", strtotime($data->issuing_date))}}</td>
                                        <td>{{date("d-m-Y", strtotime($data->certificate_validate))}}</td>
                                        <td>@if(!empty($data->iso_certificate_doc))
                                            <small><a target="_blank"
                                                    href="{{URL::to($docBaseUrl.$data->iso_certificate_doc)}}"
                                                    class="document">View
                                                    Certificate</a></small>
                                            @endif
                                        </td>
                                        <td><a
                                                href="{{URL::to('users/annexure-four-five/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/4/'.$general->encodeid($data->id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="bi bi-trash-fill"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tr>
                                    <th colspan="13">


                                    </th>
                                </tr>
                            </table>
                            <br>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    @if($check>0)
                                    <a href="{{URL::to('users/annexure-four-four/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    <a href="{{URL::to('users/annexure-five/'.$general->encodeid($application_id))}}"
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