@extends('layouts.masters.backend')
@section('content')
@section('title', 'Installer')
@php $editable = empty($editable) ? '' : $editable; @endphp
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <form action="{{URL::to('/'.Auth::getDefaultDriver().'/create-installer')}}" id="createInstallerForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-header with-border">
                    @if (Auth::guard('mnre')->check())
                    <button id="UploadExcelModalButton" data-toggle="modal" data-target="#uploadExcelModal" data-user="installer" class="btn-shadow btn btn-info btn-xs">
                        <i class="fa fa-upload fa-w-20"></i>
                        UPLOAD CSV
                    </button>
                    <a href="{{URL('public/downloadables/installer.csv')}}" class="btn-shadow btn btn-danger btn-xs">
                        <i class="fa fa-file-download fa-w-20"></i>
                        DOWNLOAD SAMPLE CSV
                    </a>
                    @endif
                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/installer-list')}}" class="btn-xs btn btn-info pull-right">Back</a>
                </div>
                <div class="clearfix"></div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="program_id">{{ __('Name of the Program') }} <span class="error">*</span></label>
                                <select class="form-control required" name="program_id" {{$editable ?? ''}}>
                                    <option value="" selected disabled>Select Program</option>
                                    @foreach ($programs as $program)
                                        <option value="{{$program->id}}" @if($program->id == ($installer['program_id'] ?? '')) selected @endif>{{$program->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">{{ __('Name of the Installer') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required" name="name" value="{{$installer['name'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">{{ __('Category of the Installer') }} <span class="error">*</span></label>
                                <select class="form-control required" name="category" {{$editable ?? ''}}>
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach(Config::get('constants.categories') as $category)
                                    <option value="{{$category['code']}}" @if(($installer['category'] ?? '') == $category['code']) selected @endif>{{$category['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __('Address') }} <span class="error">*</span></label>
                        <input type="text" {{$editable ?? ''}} class="form-control required" name="address" value="{{$installer['address'] ?? ''}}">
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user_id">{{ __('State') }} <span class="error">*</span></label>
                                <select class="form-control select2 required" id="state_id" name="state_id" onchange="fetchCities(this, 'district_id')" {{$editable ?? ''}}>
                                    <option value="" selected disabled>Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->code}}" @if($state->code == ($installer['state_id'] ?? '')) selected @endif>{{$state->name}}</option>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pincode">{{ __('Pincode') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required" maxlength="6" minlength="6" name="pincode" value="{{$installer['pincode'] ?? ''}}">
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
                                <input type="text" {{$editable ?? ''}} class="form-control required" name="contact_person" value="{{$installer['contact_person'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">{{ __('Phone Number') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required number" maxlength="10" minlength="10" name="phone" value="{{$installer['phone'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">{{ __('Email') }} <span class="error">*</span></label>
                                <input type="email" {{$editable ?? ''}} class="form-control required" name="email" value="{{$installer['email'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="aadhar_no">{{ __('Aadhar Card Number') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required" maxlength="12" minlength="12" name="aadhar_no" value="{{base64_decode($installer['aadhar_no'] ?? '')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bdtc_biogas_training_certificate_no">{{ __('BDTC biogas training certificate no.') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required" name="bdtc_biogas_training_certificate_no" value="{{$installer['bdtc_biogas_training_certificate_no'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bdtc_biogas_training_certificate">{{ __('Upload BDTC biogas training certificate') }} <span class="error">*</span></label>
                                @if(empty($installer['bdtc_biogas_training_certificate']))
                                <input type="file" {{$editable ?? ''}} class="form-control @if(!isset($installer['id'])) required @endisset" name="bdtc_biogas_training_certificate">
                                @else
                                <div class="ptb-10">
                                    <a class="" href="{{URL::to('public/images/installers/'.$installer['installer_id'].'/certificate/'.$installer['bdtc_biogas_training_certificate'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="picture">{{ __('Photograph of installer (TKW/Biogas Mitra/RET)') }} <span class="error">*</span></label>
                                @if(empty($installer['picture']))
                                <input type="file" {{$editable ?? ''}} class="form-control @if(!isset($installer['id'])) required @endisset" name="picture">
                                @else
                                <div class="ptb-10">
                                    <a class="" href="{{URL::to('public/images/installers/'.$installer['installer_id'].'/picture/'.$installer['picture'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="website">{{ __('Website of installer') }} </label>
                                <input type="text" {{$editable ?? ''}} class="form-control" name="website" value="{{$installer['website'] ?? ''}}" placeholder="www.example.com">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_info">{{ __('Short description') }}</label>
                        <textarea class="form-control" {{$editable ?? ''}} name="short_info" cols="30" rows="4" placeholder="Write here...">{{$installer['short_info'] ?? ''}}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="company_reg_no">{{ __('Company registration number') }} </label>
                                <input type="text" {{$editable ?? ''}} class="form-control" name="company_reg_no" value="{{$installer['company_reg_no'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="installation_experiance">{{ __('Years of experience in installation of biogas plants') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control number required" name="installation_experiance" value="{{$installer['installation_experiance'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="installed_plants">{{ __('Total biogas plants installed in the previous financial year') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control number required" name="installed_plants" value="{{$installer['installed_plants'] ?? ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header with-border">
                    <h3 class="box-title">Bank Details</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bank_name">{{ __('Bank Name') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required" name="bank_name" value="{{$installer['bank_name'] ?? ''}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="branch_address">{{ __('Branch Address') }} <span class="error">*</span></label>
                        <textarea class="form-control required" {{$editable ?? ''}} name="branch_address" rows="3">{{$installer['branch_address'] ?? ''}}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="account_no">{{ __('Account Number') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required number" minlength="8" name="account_no" value="{{$installer['account_no'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="account_type">{{ __('Type of Bank Account') }} <span class="error">*</span></label>
                                <select class="form-control required" name="account_type" {{$editable ?? ''}}>
                                    <option value="" selected disabled>Select Type of Bank Account</option>
                                    @foreach (Config::get('constants.bank_account_types') as $accountType)
                                    <option value="{{$accountType['code']}}" @if(($installer['account_type'] ?? '') == $accountType['code']) selected @endif>{{$accountType['name']}}</option>    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ifsc_code">{{ __('IFSC Code of Bank') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required" name="ifsc_code" value="{{$installer['ifsc_code'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="branch_code">{{ __('Branch Code') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required number" name="branch_code" value="{{$installer['branch_code'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="micr_code">{{ __('MICR Code') }} <span class="error">*</span></label>
                                <input type="text" {{$editable ?? ''}} class="form-control required number" name="micr_code" value="{{$installer['micr_code'] ?? ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                @isset($installer['id'])
                    <input type="hidden" name="id" value="{{$installer['id'] ?? ''}}">
                @endisset
                @if($editable != 'disabled')
                <div class="box-footer">
                    <input type="submit" class="btn btn-sm btn-primary pull-right" value="Submit">
                </div>
                @else
                @if (Auth::getDefaultDriver() === 'state-implementing-agency')
                    @isset ($editable)
                    @if($installer['associated'] === NULL)
                        <div class="box-footer">
                            <button {{$installer['associated'] == null ? '' : 'disabled'}} type="button" onclick="associateUser('{{URL::to('/'.Auth::getDefaultDriver().'/installer-association/'.base64_encode($installer['id']))}}', 'installer')" class="btn btn-warning">{{$installer['associated'] == null ? 'Associate' : 'Associated'}}</button>
                        </div>
                    @endif
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
        $('#createInstallerForm').validate();
        // Upload Excel proccess
        $("#uploadExcelForm").on('submit', function (e) {
            e.preventDefault();
            var user = $("#UploadExcelModalButton").data('user');
            var url = '{{URL::to("/mnre/upload-excel")}}'
            uploadExcel(this, url, user);
        });

        @if(isset($installer['id']))
        setDistrict('{{$installer["state_id"]}}', 'district_id', '{{$installer["district_id"]}}');
        @endif
    });
    function setState (element) {
        let district = $(element).val();
        let state = $(element).find(':selected').data('state');
        let stateSelectBox = 'state_id';
        ajaxcall('GET', {}, baseUrl + '/ajax/fetchStateByDiscrict/' + district).then((resp) => {
            setDropdownHtml(resp, stateSelectBox);
            $('#' + stateSelectBox).val(state);
            $('#' + stateSelectBox).attr('readonly', true);
        });
    }
</script>
@endpush

