@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'DEED OF INDEMNITY')
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

                            <form action="{{ URL::to('/users/annexure-eight')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data" style="">
                                    @if($appData->id!=null)
                                    <input type="hidden" name="id" value="{{$appData->id}}">
                                    @endif
                                    <tr>
                                        <th>
                                            <label for="">Upload DEED OF INDEMNITY <small class="text-primary">(File
                                                    should be in PDF Format and
                                                    Max. 10 MB)<small class="text-danger"> * </small></small></label>
                                            <input type="file" name="annexure8" id="annexure8"
                                                class="form-control pdf_file_10mb">
                                            @if(isset($appData) && $appData->annexure8!=null)
                                            <i style="display: inline-block;float: right;"><a
                                                    href="{{URL::to($docBaseUrl.$appData->annexure8)}}"
                                                    class="text-danger" style="margin-top: -8px;display: block;"
                                                    target="_blank">View
                                                    uploaded Annexure</a></i>
                                            @endif
                                            @error('annexure8') <span class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                            <button type="submit" name="submit" class="btn btn-success" id="submit">
                                                <i class='bi bi-arrow-bar-up'></i> @if(isset($appData->id) &&
                                                $appData->annexure8!=null)Update @else Upload @endif</button>

                                        </th>
                                        <th class="text-center"><small style="color:blue"><i>Please download the
                                                    annexure form 8
                                                    and
                                                    upload duly signed
                                                    copy <br> <a
                                                        href="{{URL::asset('public/downloadables/Annexure8.pdf')}}"
                                                        download class="text-danger">Click
                                                        Here to Download Annexure 8 Form</a></i></small>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($appData->id)){{$general->encodeid($appData->id)}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                        </th>
                                    </tr>
                                </table>


                            </form>
                            <br>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-seven/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    @if($appData->annexure8!=null)

                                    <a href="{{URL::to('users/application-fees/'.$general->encodeid($application_id))}}"
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