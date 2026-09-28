@extends('layouts.masters.backend')
@section('content')
@section('title', 'Consumer Interest Form')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <form id="consumerInterestForm" action="{{URL::to('/'.Auth::getDefaultDriver().'/consumer-interest-form')}}" method="POST">
                @csrf
                <div class="box-header with-border text-right">
                    @if (Auth::getDefaultDriver() === 'state-implementing-agency' && empty($consumer['installerId']) && !empty($consumer['is_approved']))
                    <a href="javascript:void(0)" onclick="consumerInstallerAssociation(this, '{{URL::to(Auth::getDefaultDriver().'/consumer/'.base64_encode($consumer['id']).'/installer-association')}}')" class="btn btn-xs btn-danger">Associate Installer</a>
                    @endif
                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/consumer-list')}}" class="btn btn-info btn-xs">Back</a>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['name'] ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required" name="name" value="{{$consumer['name'] ?? ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">{{ __('Contact Number') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['phone'] ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required number" maxlength="10" minlength="10" name="phone" value="{{$consumer['phone'] ?? ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">{{ __('Email') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['email'] ?? ''}}</p>
                                @else
                                    <input type="email" {{$editable ?? ''}} class="form-control required" name="email" value="{{$consumer['email'] ?? ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="aadhar_no">{{ __('Aadhar Card Number') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{'XXXXXXXX'.substr(base64_decode($consumer['aadhar_no']), 8) ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required number" maxlength="12" minlength="12" name="aadhar_no" value="{{base64_decode($consumer['aadhar_no'] ?? '')}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">Category</label>
                                @if (($editable ?? '') == 'disabled')
                                    @if (($consumer['category'] ?? '') == 'gen')
                                        <p>General</p>
                                    @elseif(($consumer['category'] ?? '') == 'sc')
                                        <p>SC</p>
                                    @elseif(($consumer['category'] ?? '') == 'st')
                                        <p>ST</p>
                                    @else
                                        <p>Not defined</p>
                                    @endif
                                @else
                                    <select class="form-control required" name="category" {{$editable ?? ''}}>
                                        <option selected disabled>Select Category</option>
                                        @foreach(Config::get('constants.categories') as $category)
                                        <option value="{{$category['code']}}" @if(($consumer['category'] ?? '') == $category['code']) selected @endif>{{$category['name']}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label class="headLebels">Address Details</label>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="house_no">{{ __('House No.') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['house_no'] ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required" name="house_no" value="{{$consumer['house_no'] ?? ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="village">{{ __('Village') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['village'] ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required" name="village" value="{{$consumer['village'] ?? ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="post">{{ __('Post office') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['post'] ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required" name="post" value="{{$consumer['post'] ?? ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="block">{{ __('Block') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['block'] ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required" name="block" value="{{$consumer['block'] ?? ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="panchayat">{{ __('Panchayat') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['panchayat'] ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required" name="panchayat" value="{{$consumer['panchayat'] ?? ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ward_no">{{ __('Ward No.') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['ward_no'] ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required" name="ward_no" value="{{$consumer['ward_no'] ?? ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sub_district_id">{{ __('Sub District') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['sub_district'] ?? ''}}</p>
                                @else
                                    <select class="form-control select2 required" id="sub_district_id" name="sub_district_id" onchange="setDistrictAndState(this)">
                                        <option value="" selected disabled>Select Sub-District</option>
                                        @foreach ($sub_districts as $subDistrict)
                                            <option value="{{$subDistrict->code}}" data-district="{{$subDistrict->district_code}}" data-state="{{$subDistrict->state_code}}">{{$subDistrict->name}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="district_id">{{ __('District') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['district'] ?? ''}}</p>
                                @else
                                    <select class="form-control select2 required" id="district_id" name="district_id" onchange="getStateByDiscrict(this, 'state_id')">
                                        <option value="" selected disabled>Select District</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="state_id">{{ __('State') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['state'] ?? ''}}</p>
                                @else
                                    <select class="form-control select2 required" id="state_id" name="state_id">
                                        <option value="" selected disabled>Select State</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label class="headLebels">Other Details</label>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="toilet_linked">{{ __('Do you require toilet linked biogas plants?') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    @if(($consumer['toilet_linked'] ?? '') == 1)
                                        <p>Yes</p>
                                    @else
                                        <p>No</p>
                                    @endif
                                @else
                                    <select class="form-control required" id="toilet_linked" name="toilet_linked">
                                        <option selected disabled>Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="existing_biogas_plant">{{ __('Do you already have a biogas plant installed?') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    @if(($consumer['existing_biogas_plant'] ?? '') == 1)
                                        <p>Yes</p>
                                    @else
                                        <p>No</p>
                                    @endif
                                @else
                                    <select class="form-control required" id="existing_biogas_plant" name="existing_biogas_plant">
                                        <option selected disabled>Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div id="subsidyDiv" class="col-md-4" style="display: @if(($consumer['existing_biogas_plant'] ?? '') != 1) none @endif">
                            <div class="form-group">
                                <label for="subsidy_availed">{{ __('Have you availed any subsidy against the biogas plant?') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    @if(($consumer['subsidy_availed'] ?? '') == 1)
                                        <p>Yes</p>
                                    @else
                                        <p>No</p>
                                    @endif
                                @else
                                    <select class="form-control required" id="subsidy_availed" name="subsidy_availed">
                                        <option selected disabled>Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">{{ __('Number of cattle available ') }} <span class="error">*</span></label>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @if (($editable ?? '') == 'disabled')
                                    <p>Buffaloes (big) : {{$consumer['number_of_cattle']['buffaloes']['big'] ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required" name="cattles[buffaloes][big]" placeholder="Buffaloes (Big)" onkeypress="return isNumber(event)" value="{{$consumer['number_of_cattle']['buffaloes']['big'] ?? ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @if (($editable ?? '') == 'disabled')
                                    <p>Buffaloes (small) : {{$consumer['number_of_cattle']['buffaloes']['small'] ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required" name="cattles[buffaloes][small]" placeholder="Buffaloes (Small)" onkeypress="return isNumber(event)" value="{{$consumer['number_of_cattle']['buffaloes']['small'] ?? ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @if (($editable ?? '') == 'disabled')
                                    <p>Cows (big) : {{$consumer['number_of_cattle']['cows']['big'] ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required" name="cattles[cows][big]" placeholder="Cows (Big)" onkeypress="return isNumber(event)" value="{{$consumer['number_of_cattle']['cows']['big'] ?? ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @if (($editable ?? '') == 'disabled')
                                    <p>Cows (small) : {{$consumer['number_of_cattle']['cows']['small'] ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required" name="cattles[cows][small]" placeholder="Cows (Small)" onkeypress="return isNumber(event)" value="{{$consumer['number_of_cattle']['cows']['small'] ?? ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">{{ __('Comment') }}</label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['comment'] ?? ''}}</p>
                                @else
                                    <textarea class="form-control" {{$editable ?? ''}} name="comment" cols="30" rows="4" placeholder="Write here...">{{$consumer['comment'] ?? ''}}</textarea>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" {{$editable ?? ''}} class="mt-1 btn btn-primary @isset($editable) hidden @endisset" value="Submit">
                                @if (Auth::getDefaultDriver() === 'state-implementing-agency')
                                    @if(is_null($consumer['is_approved']))
                                    <hr>
                                    <button type="button" data-approve="approve" class="btn btn-primary btn-sm" onclick="changeConsumerApproval(this, '{{URL::to('/'.Auth::getDefaultDriver().'/consumer-request/'.base64_encode($consumer['id']).'/approval?approve=1')}}')">Approve</button>
                                    <button type="button" data-approve="reject" class="btn btn-danger btn-sm" onclick="changeConsumerApproval(this, '{{URL::to('/'.Auth::getDefaultDriver().'/consumer-request/'.base64_encode($consumer['id']).'/approval?approve=0')}}')">Reject</button>
                                    @elseif(!empty($consumer['installer_id']) && !empty($consumer['is_approved']))
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="priority">Set/Edit Priority</label>
                                            <select class="form-control" name="priority" id="priority" onchange="setOrEditPriority(this)" data-system="{{$consumer['installationId']}}">
                                                <option value="" selected disabled>Select Priority</option>
                                                <option value="high" @if($consumer['priority'] == 'high') selected @endif>High</option>
                                                <option value="medium" @if($consumer['priority'] == 'medium') selected @endif>Medium</option>
                                                <option value="low" @if($consumer['priority'] == 'low') selected @endif>Low</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('modals.consumerInstallerAssociation')
@endsection
@push('backend-js')
<script src="{{asset('public/js/consumer.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('#consumerInterestForm, #consumerInstallerForm').validate();
        $("#village_id").change();
        $('#existing_biogas_plant').change(function(){
            if($(this).val() == '1') $('#subsidyDiv').show();
            else $('#subsidyDiv').hide();
        });
    });

    function setDistrictAndState(element){
        let subDistrict = $(element).val();
        let district = $(element).find(':selected').data('district');
        let state = $(element).find(':selected').data('state');
        setDistrictBySubDistrict(subDistrict, 'district_id', district);
        setStateByDistrict(district, 'state_id', state);
    }

    function setOrEditPriority(element){
        let value = $(element).val();
        let systemId = $(element).data('system');
        ajaxcall('GET', {}, baseUrl + '/ajax/setOrEditPriority/'+ systemId + '/' + value).then((resp) => {
            if(resp === 'SUCCESS'){
                window.location = '{{URL::to("/".Auth::getDefaultDriver()."/consumer-list")}}'
            }
        })
    }
</script>
@endpush
