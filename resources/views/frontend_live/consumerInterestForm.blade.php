@extends('layouts.masters.home')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="frontPagesBox">
                <div class="box box-primary">
                    <form id="consumerInterestForm" action="{{URL::to('consumer-interest-form')}}" method="POST">
                        @csrf
                        <div class="box-header with-border">
                            <h2 class="box-title">Consumer Interest Form</h2>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }} <span class="error">*</span></label>
                                        <input type="text" class="form-control required" name="name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone">{{ __('Contact Number') }} <span class="error">*</span></label>
                                        <input type="text" class="form-control required number" maxlength="10" minlength="10" name="phone">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }} <span class="error">*</span></label>
                                        <input type="email" class="form-control required" name="email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="aadhar_no">{{ __('Aadhar Card Number') }} <span class="error">*</span></label>
                                        <input type="text" class="form-control required number" maxlength="12" minlength="12" name="aadhar_no">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category">Category <span class="error">*</span></label>
                                        <select class="form-control required" name="category">
                                            <option selected disabled>Select Category</option>
                                            @foreach(Config::get('constants.categories') as $category)
                                            <option value="{{$category['code']}}">{{$category['name']}}</option>
                                            @endforeach
                                        </select>
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
                                        <input type="text" class="form-control required" name="house_no">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="village">{{ __('Village') }} <span class="error">*</span></label>
                                        <input type="text" class="form-control required" name="village">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="post">{{ __('Post office') }} <span class="error">*</span></label>
                                        <input type="text" class="form-control required" name="post">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="block">{{ __('Block') }} <span class="error">*</span></label>
                                        <input type="text" class="form-control required" name="block">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="panchayat">{{ __('Panchayat') }} <span class="error">*</span></label>
                                        <input type="text" class="form-control required" name="panchayat">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ward_no">{{ __('Ward No.') }} <span class="error">*</span></label>
                                        <input type="text" class="form-control required" name="ward_no">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sub_district_id">{{ __('Sub District') }} <span class="error">*</span></label>
                                        <select class="form-control select2 required" id="sub_district_id" name="sub_district_id" onchange="setDistrictAndState(this)">
                                            <option value="" selected disabled>Select Sub-District</option>
                                            @foreach ($sub_districts as $subDistrict)
                                                <option value="{{$subDistrict->code}}" data-district="{{$subDistrict->district_code}}" data-state="{{$subDistrict->state_code}}">{{$subDistrict->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="district_id">{{ __('District') }} <span class="error">*</span></label>
                                        <select class="form-control select2 required" id="district_id" name="district_id">
                                            <option value="" selected disabled>Select District</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state_id">{{ __('State') }} <span class="error">*</span></label>
                                        <select class="form-control select2 required" id="state_id" name="state_id">
                                            <option value="" selected disabled>Select State</option>
                                        </select>
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
                                        <select class="form-control required" id="toilet_linked" name="toilet_linked">
                                            <option selected disabled>Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="existing_biogas_plant">{{ __('Do you already have a biogas plant installed?') }} <span class="error">*</span></label>
                                        <select class="form-control required" id="existing_biogas_plant" name="existing_biogas_plant">
                                            <option selected disabled>Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" id="dvSubsidy" style="display: none;">
                                    <div class="form-group">
                                        <label for="subsidy_availed">{{ __('Have you availed any subsidy against the biogas plant?') }} <span class="error">*</span></label>
                                        <select class="form-control required" id="subsidy_availed" name="subsidy_availed">
                                            <option selected disabled>Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">{{ __('Number of cattle available ') }} <span class="error">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control required" name="cattles[buffaloes][big]" placeholder="Buffaloes (Big)" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control required" name="cattles[buffaloes][small]" placeholder="Buffaloes (Small)" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control required" name="cattles[cows][big]" placeholder="Cows (Big)" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control required" name="cattles[cows][small]" placeholder="Cows (Small)" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="comment">{{ __('Comment') }}</label>
                                        <textarea class="form-control" name="comment" cols="30" rows="4" placeholder="Write here...">{{old('comment')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" class="mt-1 btn btn-primary" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('public/js/consumer.js')}}"></script>
<script>
    $(function(){
        $('#consumerInterestForm').validate();
        $('#existing_biogas_plant').change(function(){
            if($(this).val() == '1')
                $('#dvSubsidy').show();
            else
                $('#dvSubsidy').hide();
        })
    });
    function setDistrictAndState(element){
        let subDistrict = $(element).val();
        let district = $(element).find(':selected').data('district');
        let state = $(element).find(':selected').data('state');
        setDistrictBySubDistrict(subDistrict, 'district_id', district);
        setStateByDistrict(district, 'state_id', state);
    }
</script>
@endsection
