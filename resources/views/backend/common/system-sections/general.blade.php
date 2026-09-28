<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="bpmr_no">{{ __('System ID (Biogas Permanent Master Register No.)') }} <span class="error">*</span></label>
                <input type="text" disabled class="form-control required" name="bpmr_no" value="{{$installation->bpmr_no ?? 'Not Generated'}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="consumerId">{{ __('Owner ID') }} <span class="error">*</span></label>
                <input type="text" {{$editable ?? ''}} class="form-control required" name="consumerId" disabled value="{{$installation->consumerId ?? ''}}">
                <input type="hidden" name="consumerId" value="{{$installation->consumerId ?? ''}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="consumer">{{ __('Name of the Beneficiary') }} <span class="error">*</span></label>
                <input type="text" {{$editable ?? ''}} class="form-control required" name="consumer" disabled value="{{$installation->consumer ?? ''}}">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="consumer">{{ __('Category of the Beneficiary') }} <span class="error">*</span></label>
                <input type="text" {{$editable ?? ''}} class="form-control required" name="consumer" disabled value="{{$categories[$installation->consumerCategory]}}">
            </div>
        </div>
    </div>
</div>

<div class="box-header with-border">
    <h3 class="box-title">Address Details (as per Aadhar card)</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="house_no">{{ __('House No.') }} <span class="error">*</span></label>
                <input type="text" disabled class="form-control required" name="house_no" value="{{$installation->house_no ?? ''}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="village">{{ __('Village') }} <span class="error">*</span></label>
                <input type="text" disabled class="form-control required" name="village" value="{{$installation->village ?? ''}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="post">{{ __('Post office') }} <span class="error">*</span></label>
                <input type="text" disabled class="form-control required" name="post" value="{{$installation->post ?? ''}}">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="block">{{ __('Block') }} <span class="error">*</span></label>
                <input type="text" disabled class="form-control required" name="block" value="{{$installation->block ?? ''}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="panchayat">{{ __('Panchayat') }} <span class="error">*</span></label>
                <input type="text" disabled class="form-control required" name="panchayat" value="{{$installation->panchayat ?? ''}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="ward_no">{{ __('Ward No.') }} <span class="error">*</span></label>
                <input type="text" disabled class="form-control required" name="ward_no" value="{{$installation->ward_no ?? ''}}">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sub_district_id">{{ __('Sub District') }} <span class="error">*</span></label>
                <select class="form-control select2 required" id="sub_district_id" name="sub_district_id" disabled>
                    <option value="" selected disabled>Select Sub-District</option>
                    @foreach ($sub_districts as $subDistrict)
                        <option value="{{$subDistrict->code}}" @if($subDistrict->code == ($installation->sub_district_id)) selected @endif>{{$subDistrict->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="district_id">{{ __('District') }} <span class="error">*</span></label>
                <select class="form-control select2 required" id="district_id" name="district_id" disabled>
                    <option value="" selected disabled>Select District</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="state_id">{{ __('State') }} <span class="error">*</span></label>
                <select class="form-control select2 required" id="state_id" name="state_id" disabled>
                    <option value="" selected disabled>Select State</option>
                </select>
                <input type="hidden" name="state_id" value="{{$installation->state_id}}">
            </div>
        </div>
    </div>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="latitude">{{ __('Geo Tag (latitude)') }} <span class="error">*</span></label>
                <input type="text" {{$editable ?? ''}} class="form-control required number" name="latitude" value="{{$installation->latitude ?? ''}}">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="longitude">{{ __('Geo Tag (longitude)') }} <span class="error">*</span></label>
                <input type="text" {{$editable ?? ''}} class="form-control required number" name="longitude" value="{{$installation->longitude ?? ''}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="agreement_date">{{ __('Agreement Date') }} <span class="error">*</span></label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" {{$editable ?? ''}} class="form-control datepicker required" name="agreement_date" value="@if(!empty($installation->agreement_date)) {{date('d-m-Y', strtotime($installation->agreement_date))}} @endif" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="construction_start_date">{{ __('Construction Start Date') }} <span class="error">*</span></label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" {{$editable ?? ''}} class="form-control construction-start-date required" name="construction_start_date" value="@if(!empty($installation->construction_start_date)) {{date('d-m-Y', strtotime($installation->construction_start_date))}} @endif" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="completion_date">{{ __('Completion Date') }} <span class="error">*</span></label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" {{$editable ?? ''}} class="form-control completion-date required" name="completion_date" value="@if(!empty($installation->completion_date)) {{date('d-m-Y', strtotime($installation->completion_date))}} @endif" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="implementing_agency">{{ __('State Implementing Agency Id') }} <span class="error">*</span></label>
                <input type="text" {{$editable ?? ''}} class="form-control required" name="implementing_agency" disabled value="{{$installation->stateImplementingAgencyCode ?? ''}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="implementing_localbody">{{ __('Implementing Local Body Id') }} <span class="error">*</span></label>
                <input type="text" {{$editable ?? ''}} class="form-control required" name="implementing_localbody"disabled value="{{$installation->localbody ?? ''}}">
            </div>
        </div>
    </div>
</div>
<div class="box-header with-border">
    <h3 class="box-title">Technical Details</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="biogas_model">{{ __('Type of Model') }} <span class="error">*</span></label>
                <select class="form-control required" name="biogas_model" {{$editable ?? ''}}>
                    <option selected disabled>Select type of model</option>
                    @foreach($biogasModels as $model)
                    <option value="{{$model['id']}}" @if(($installation->biogas_model ?? '') == $model['id']) selected @endif>{{$model['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="capacity">{{ __('Capacity (in cubic meter)') }} <span class="error">*</span></label>
                <select class="form-control required" name="capacity" {{$editable ?? ''}}>
                    <option selected disabled>Select Capacity</option>
                    @foreach($installationCapacities as $capacity)
                    <option value="{{$capacity['id']}}" @if(($installation->capacity ?? '') == $capacity['id']) selected @endif>{{$capacity['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="toilet_status">{{ __('Is the plant toilet linked?') }} <span class="error">*</span></label>
                <select class="form-control required" name="toilet_status" id="toilet_status" {{$editable ?? ''}}>
                    <option value="" selected disabled>Select Status</option>
                    <option value="1" @if(($installation->toilet_status ?? '') == '1') selected @endif>Yes</option>
                    <option value="0" @if(($installation->toilet_status ?? '') == '0') selected @endif>No</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="box-header with-border">
    <h3 class="box-title">O & M Routine</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="o_m_routines">{{ __('Preventive scheduled maintenance Date') }} <span class="error">*</span></label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" {{$editable ?? ''}} class="form-control om-routines required" name="onm_routines_schedule" value="@if(!empty($installation->onm_routines_schedule)) {{date("d-m-Y", strtotime($installation->onm_routines_schedule))}} @endif" autocomplete="off">
                </div>
            </div>
        </div>
    </div>
</div>