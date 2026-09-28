@extends('layouts.masters.backend')
@section('content')
@section('title', 'State Implementing Agency')
@php $editable = empty($editable) ? '' : $editable; @endphp
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <form action="{{URL::to('mnre/create-state-implementing-agency')}}" id="createStateIMplementingAgencyForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-header with-border">
                    <button id="UploadExcelModalButton" data-toggle="modal" data-target="#uploadExcelModal" data-user="state-implementing-agency" class="btn-shadow btn btn-info btn-xs">
                        <i class="fa fa-upload fa-w-20"></i>
                        UPLOAD CSV
                    </button>
                    <a href="{{URL('public/downloadables/state-implementing-agency.csv')}}" class="btn-shadow btn btn-danger btn-xs">
                        <i class="fa fa-file-download fa-w-20"></i>
                        DOWNLOAD SAMPLE CSV
                    </a>
                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/state-implementing-agency-list')}}" class="btn-shadow btn btn-info btn-xs pull-right">Back</a>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="program_id">{{ __('Name of the Program') }} <span class="error">*</span></label>
                                <select class="form-control required" name="program_id" {{$editable ?? ''}}>
                                    <option value="" selected disabled>Select Program</option>
                                    @foreach ($programs as $program)
                                        <option value="{{$program->id}}" @if($program->id == ($stateImplementingAgencyUser['program_id'] ?? '')) selected @endif>{{$program->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">{{ __('Name of the Agency') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required" name="name" value="{{$stateImplementingAgencyUser['name'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nodal">{{ __('Are you a Nodal Agency ?') }} <span class="error">*</span></label>
                                <select class="form-control required" name="nodal" {{$editable ?? ''}}>
                                    <option value="" selected disabled>Select Nodal</option>
                                    <option value="1" @if('1' == ($stateImplementingAgencyUser['nodal'] ?? '')) selected @endif>Yes</option>
                                    <option value="0" @if('0' == ($stateImplementingAgencyUser['nodal'] ?? '')) selected @endif>No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __('Address') }} <span class="error">*</span></label>
                        <textarea {{$editable ?? ''}} row="3" class="form-control required" name="address">{{$stateImplementingAgencyUser['address'] ?? ''}}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user_id">{{ __('State') }} <span class="error">*</span></label>
                                <select class="form-control select2 required" id="state_id" name="state_id" onchange="fetchCities(this, 'district_id')" {{$editable ?? ''}}>
                                    <option value="" selected disabled>Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->code}}" @if($state->code == ($stateImplementingAgencyUser['state_id'] ?? '')) selected @endif>{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user_id">{{ __('District') }} <span class="error">*</span></label>
                                <select class="form-control select2 required" id="district_id" name="district_id" {{$editable ?? ''}}>
                                    <option value="" selected disabled>Select District</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pincode">{{ __('Pincode') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required" maxlength="6" minlength="6" name="pincode" value="{{$stateImplementingAgencyUser['pincode'] ?? ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header with-border">
                    <h3 class="box-title">Contact Details</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_person">{{ __('Name of Contact Person') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required" name="contact_person" value="{{$stateImplementingAgencyUser['contact_person'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">{{ __('Contact Number') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required number" maxlength="10" minlength="10" name="phone" value="{{$stateImplementingAgencyUser['phone'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">{{ __('Email') }} <span class="error">*</span></label>
                                <input type="email" {{$editable ?? ''}} class="form-control required" name="email" value="{{$stateImplementingAgencyUser['email'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="website">{{ __('Agency Website') }}</label>
                                <input type="text" {{$editable ?? ''}} class="form-control" name="website" value="{{$stateImplementingAgencyUser['website'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="logo">{{ __('Logo of the Agency') }}</label>
                                <input type="file" {{$editable ?? ''}} class="form-control" name="logo">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_info">{{ __('Short description') }}</label>
                        <textarea class="form-control" {{$editable ?? ''}} name="short_info" cols="30" rows="4" placeholder="Write here...">{{$stateImplementingAgencyUser['short_info'] ?? ''}}</textarea>
                    </div>
                </div>
                @isset($stateImplementingAgencyUser['id'])
                    <input type="hidden" name="id" value="{{$stateImplementingAgencyUser['id'] ?? ''}}">
                @endisset
                @if($editable != 'disabled')
                <div class="box-footer">
                    <input type="submit" class="btn btn-primary btn-sm pull-right" value="Submit">
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
@push('backend-js')
<script>
    $(function () {
        $('#createStateIMplementingAgencyForm').validate();
        // Upload Excel proccess
        $("#uploadExcelForm").on('submit', function (e) {
            e.preventDefault();
            var user = $("#UploadExcelModalButton").data('user');
            var url = '{{URL::to("/mnre/upload-excel")}}'
            uploadExcel(this, url, user);
        });

        @if(isset($stateImplementingAgencyUser['id']))
            setDistrict('{{$stateImplementingAgencyUser["state_id"]}}', 'district_id', '{{$stateImplementingAgencyUser["district_id"]}}');
        @endif
    });
</script>
@endpush
