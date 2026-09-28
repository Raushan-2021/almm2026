@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'New Application')
@section('content')
<div class="row">
    @include('backend.user.form._stepper_application')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box-header with-border">
                            Final Submission
                        </div>
                        <div class="box-body">
                            <form action="{{URL::to('/users/existing-application-submission')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data" style="">
                                    <tr>
                                        <th>
                                            <div class="row offset-md-3">
                                                <div class="col-md-12">
                                                    <p style="color:blue"><i>Please download the Application
                                                            and
                                                            upload duly signed
                                                            copy (<a
                                                                href="{{ URL::to('/users/download-application/'.$general->encodeid($application_id))}}"
                                                                class="text-danger">Click
                                                                Here to Download Application</a>)</i></p>
                                                </div>
                                                <div style="clear:both"></div>
                                                <div class="col-md-12">
                                                    <label for="">Upload Application <small class="text-primary">(File
                                                            should be in PDF Format and
                                                            Max. 10 MB)</small></label>
                                                    <input type="file" name="signatory_document" class="form-control">
                                                    @error('signatory_document') <span class="valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                                <div style="clear:both"></div>
                                                <div class="col-md-12"><br>
                                                    <input type="checkbox" name="declaration" id="declaration"
                                                        value="1">
                                                    <i>I authorize that entered information in proposal are correct and
                                                        verified(

                                                        <a href="javascript:;" class="text-primary"
                                                            data-bs-toggle="modal" data-bs-target="#termcondition">Terms
                                                            and
                                                            Conditions</a>)
                                                        @error('declaration') <span class="valid_class">
                                                            {{ $message }} </span> @enderror
                                                </div>
                                                <div class="col-md-12"><br>
                                                    <button type="submit" name="submit" class="btn btn-success"
                                                        id="submit" style="display:none">
                                                        <i class='fa fa-check'></i> Final Submission</button>
                                                    <input type="button" name="submit" value="Final Submission"
                                                        class="btn btn-success" id="confirmButton">
                                                    <a href="{{URL::to('users/application-fees/'.$general->encodeid($application_id))}}"
                                                        class="btn btn-primary" style="float:right"><i
                                                            class="fa fa-arrow-left"></i>
                                                        Back </a>
                                                    <br>

                                                    <input type="hidden" name="edit_id" id="edit_id"
                                                        value="{{$general->encodeid($application_id)}}">
                                                    <input type="hidden" name="application_id" id="application_id"
                                                        value="{{$general->encodeid($application_id)}}">
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </table>
                            </form>
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
    .valid_class {
        color: #e73434;
        font-weight: 100;
        font-family: arial;
        font-size: 11px;
        display: block;
    }
    </style>
    @endsection
    @push('backend-js')
    <script>
    $('#confirmButton').on("click", function() {
        if (confirm(
                "After Final submission changes not allowed.Are you sure you want to perform this action?")) {
            $("#submit").click();
        } else {
            return false;
        }
    });
    </script>
    @endpush