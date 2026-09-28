@extends('layouts.masters.backend')
@section('content')
@section('title', 'Inspector')
@php $editable = empty($editable) ? '' : $editable; @endphp
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <form action="{{URL::to('/'.Auth::getDefaultDriver().'/create-inspector')}}" id="createInspectorForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-header with-border">
                    @if (Auth::guard('mnre')->check())
                    <button id="UploadExcelModalButton" data-toggle="modal" data-target="#uploadExcelModal" data-user="inspector" class="btn-shadow btn btn-info btn-xs">
                        <i class="fa fa-upload fa-w-20"></i>
                        UPLOAD CSV
                    </button>
                    <a href="{{URL('public/downloadables/inspector.csv')}}" class="btn-shadow btn btn-danger btn-xs">
                        <i class="fa fa-file-download fa-w-20"></i>
                        DOWNLOAD SAMPLE CSV
                    </a>
                    @endif
                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/inspector-list')}}" class="btn-xs btn btn-info pull-right">Back</a>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="program_id">{{ __('Name of the Program') }} <span class="error">*</span></label>
                                <select class="form-control required" name="program_id" {{$editable ?? ''}}>
                                    <option value="" selected disabled>Select Program</option>
                                    @foreach ($programs as $program)
                                        <option value="{{$program->id}}" @if($program->id == ($inspector['program_id'] ?? '')) selected @endif>{{$program->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">{{ __('Name of the Inspector') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required" name="name" value="{{$inspector['name'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">{{ __('Contact Number') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required number" maxlength="10" minlength="10" name="phone" value="{{$inspector['phone'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">{{ __('Email') }} <span class="error">*</span></label>
                                <input type="email" {{$editable ?? ''}} class="form-control required" name="email" value="{{$inspector['email'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dob">{{ __('Date of Birth') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required dob" name="dob" value="@if(!empty($inspector['dob'])) {{date('d-m-Y', strtotime($inspector['dob']))}} @endif">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_id">{{ __('State') }} <span class="error">*</span></label>
                                <select class="form-control select2 required" name="state_id" {{$editable ?? ''}}>
                                    <option value="" selected disabled>Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->code}}" @if($state->code == ($inspector['state_id'] ?? '')) selected @endif>{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="designation">{{ __('Designation') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required" name="designation" value="{{$inspector['designation'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="biogas_training_attended">{{ __('Name of biogas training attended') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required" name="biogas_training_attended" value="{{$inspector['biogas_training_attended'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="picture">{{ __('Photograph of inspector') }} <span class="error">*</span></label>
                                @if(empty($inspector['picture']))
                                <input type="file" {{$editable ?? ''}} class="form-control @if(!isset($inspector['id'])) required @endisset" name="picture">
                                @else
                                <div class="ptb-10">
                                    <a class="" href="{{URL::to('public/images/inspectors/'.$inspector['inspector_id'].'/picture/'.$inspector['picture'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comment">{{ __('Comment') }}</label>
                        <textarea class="form-control" {{$editable ?? ''}} name="comment" cols="30" rows="4">{{$inspector['comment'] ?? ''}}</textarea>
                    </div>
                </div>
                @isset($inspector['id'])
                    <input type="hidden" name="id" value="{{$inspector['id'] ?? ''}}">
                @endisset
                @if($editable != 'disabled')
                <div class="box-footer">
                    <input type="submit" class="btn btn-primary btn-sm pull-right" value="Submit">
                </div>
                @else
                @if (Auth::getDefaultDriver() === 'state-implementing-agency')
                    @isset ($editable)
                    <div class="box-footer">
                        <button {{$inspector['associated'] == null ? '' : 'disabled'}} type="button" onclick="associateUser('{{URL::to('/'.Auth::getDefaultDriver().'/inspector-association/'.base64_encode($inspector['id']))}}', 'inspector')" class="btn btn-warning">{{$inspector['associated'] == null ? 'Associate' : 'Associated'}}</button>
                    </div>
                    @endisset
                @endif
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
@push('backend-js')
<script>
    $(function(){
        $('#createInspectorForm').validate();
        $(".dob").datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            orientation: "bottom",
            endDate: new Date()
        });
        // Upload Excel proccess
        $("#uploadExcelForm").on('submit', function (e) {
            e.preventDefault();
            var user = $("#UploadExcelModalButton").data('user');
            var url = '{{URL::to("/mnre/upload-excel")}}'
            uploadExcel(this, url, user);
        });
    });
</script>
@endpush


