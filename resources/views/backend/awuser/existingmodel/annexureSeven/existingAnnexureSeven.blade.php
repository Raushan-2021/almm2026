@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Company Affidavit')
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

                            <form action="{{ URL::to('/users/existing-annexure-seven')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data" style="">
                                    @if($appData->id!=null)
                                    <input type="hidden" name="id" value="{{$appData->id}}">
                                    @endif
                                    <tr>
                                        <th>
                                            <div class="row offset-md-3">
                                                <div class="col-md-6">
                                                    <label for="">Company Affidavit <small class="text-primary">(File
                                                            should be in PDF Format and
                                                            Max. 10 MB)</small></label>
                                                    <input type="file" name="annexure7" class="form-control">
                                                    @if(isset($appData) && $appData->annexure7!=null)
                                                    <i style="display: inline-block;float: right;"><a
                                                            href="{{URL::to($docBaseUrl.$appData->annexure7)}}"
                                                            style="margin-top: -8px;display: block;"
                                                            target="_blank">View
                                                            uploaded Annexure</a></i>
                                                    @endif
                                                    @error('annexure7') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror


                                                </div>
                                                <div style="clear:both"></div>
                                                <div class="col-md-6 col-md-offset-3"><br>
                                                    <button type="submit" name="submit" class="btn btn-success"
                                                        id="submit">
                                                        <i class='fa fa-check'></i>@if(isset($appData->id) &&
                                                        $appData->annexure7!=null)Update @else Upload @endif</button>

                                                    <br>
                                                    <small style="color:blue"><i>Please download the annexure form 7
                                                            and
                                                            upload duly signed
                                                            copy (<a
                                                                href="{{URL::asset('public/downloadables/Annexure7.pdf')}}"
                                                                download class="text-danger">Click
                                                                Here to Download Annexure 7 Form</a>)</i></small>

                                                    <input type="hidden" name="edit_id" id="edit_id"
                                                        value="@if(isset($appData->id)){{$general->encodeid($appData->id)}}@endif">
                                                    <input type="hidden" name="application_id" id="application_id"
                                                        value="{{$general->encodeid($application_id)}}">



                                                </div>

                                            </div>
                                        </th>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="13">
                                        @if($appData->annexure7!=null)

                                        <a href="{{URL::to('users/existing-annexure-eight/'.$general->encodeid($application_id))}}"
                                            class="btn btn-warning" style="float:right">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        @endif
                                        <a href="{{URL::to('users/existing-annexure-five/'.$general->encodeid($application_id))}}"
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