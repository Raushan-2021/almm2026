@extends('layouts.masters.backend')
@section('content')
@section('title', 'Edit Profile')
@php $logoBaseUrl ='users/preview-docs/Logo/';@endphp
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{URL::to('/users/edit-profile')}}" method="POST" enctype="multipart/form-data"
                    id="formProfile">
                    @csrf
                    <div class="row">
                        <!-- <div class="col-md-2 text-center">
                            <img src="{{ url('/systems/Logo/'.$user->picture)}}" style="width:80%" alt=""><br>
                            <hr>
                            <div class="form-group text-left">
                                <label for="name">{{ __('Change Profile Picture') }} <span
                                        class="error">*</span></label>
                                <input type="file" class="form-control required" name="picture" />
                            </div>
                        </div> -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }} <span class="error">*</span></label>
                                        <input type="email" class="form-control required" name="email"
                                            value="{{$user->email}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }} <span class="error">*</span></label>
                                        <input type="text" class="form-control required" name="name"
                                            value="{{$user->name}}">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">{{ __('Phone/Mobile') }} <span class="error">*</span></label>
                                        <input type="text" class="form-control required" name="phone"
                                            value="{{$user->phone}}">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">{{ __('Gst') }} <span class="error">*</span></label>
                                        <input type="text" class="form-control required" name="gst"
                                            value="{{$user->gst}}">
                                        @error('gst')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">{{ __('PAN') }} <span class="error">*</span></label>
                                        <input type="text" class="form-control required" name="pan" id="pan"
                                            value="{{ substr_replace($user->pan, str_repeat('*', strlen($user->pan)-5), 1, -4) }}">
                                        @error('pan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">{{ __('Address') }} <span class="error">*</span></label>
                                        <textarea name="address" id="address" cols="30" class="form-control required"
                                            rows="5">{{$user->address}}</textarea>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user_id">{{ __('Country') }} <span class="error">*</span></label>
                                        <select name="country_id" id="country_id"
                                            class="form-control form-control-lg  @error('country_id') is-invalid @enderror">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->countrycd}}" @if($country->countrycd ===
                                                $user->country_id)
                                                selected
                                                @endif>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 state"
                                    style="display: @if($user->country_id==99) @else none @endif">
                                    <div class="form-group">
                                        <label for="user_id">{{ __('State') }} <span class="error">*</span></label>
                                        <select class="form-control1 select21 required" name="state_id" id="state_id"
                                            onchange="getDistrictByState(this.value)">
                                            @foreach ($states as $state)
                                            <option value="{{$state->code}}" @if($state->code === $user->state_id)
                                                selected
                                                @endif>{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('state_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 district"
                                    style="display: @if($user->country_id==99) @else none @endif">
                                    <div class="form-group">
                                        <label for="user_id">{{ __('District') }} <span class="error">*</span></label>
                                        <select name="district_id" id="district_id"
                                            class="form-control form-control-lg">
                                            <option value="">Select District</option>
                                        </select>
                                        @error('district_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user_id">{{ __('Pin/Sip Code') }} <span
                                                class="error">*</span></label>
                                        <input type="number" maxlength="6" minlength="6" class="form-control required"
                                            name="pin_code" value="{{$user->pin_code}}">
                                        @error('pin_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <p>If you want to change your password <a
                                    href="{{URL::to('/'.Auth::getDefaultDriver().'/change-password')}}">Click Here</a>
                            </p>
                            <input type="submit" class="mt-1 btn btn-primary" value="Submit">
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function getDistrictByState(state_id, distId = '') {
    $.ajax({

        url: "{{ url('get_distictbystate') }}",
        type: "POST",
        data: {
            state_id: state_id
        },
        success: function(data) {
            if (data != '') {
                var flg = '';
                $('.district').slideDown();
                $('#district_id').empty();
                $("#district_id").append('<option value="">---District---</option>');

                $.each(data, function(key, value) {
                    if (value.code == distId) {
                        flg = 'selected';
                    }
                    $("#district_id").append('<option value="' + value.code +
                        '" flg>' + value.name + '</option>');
                });

            }
        }
    });
}
</script>


@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('js/crypto-js.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/aes.min.js')}}"></script>

<script>
$(function() {

    $("#country_id").change(function() {
        $('.state').hide();
        $('.district').hide();
        $('#pincode').attr("placeholder", "Pincode");
        if ($('#country_id :selected').val() == 99) {
            $('.state').show();
            $('.district').show();
        } else {
            $('.state').hide();
            $('.district').hide();
            $('#pincode').attr("placeholder", "Sipcode");
        }
    });

    // $('#formLogin').validate();
    // $('#refresh-captcha').click(function() {
    //     let captcha_array = $('.captcha > img').attr('src').split('?');
    //     let new_captcha = captcha_array[0] + '?' + makeid(8);
    //     $('.captcha > img').attr('src', new_captcha);
    // });

})
</script>
<script>
$(document).ready(function() {





});
document.querySelector('#formProfile').addEventListener('submit', (e) => {
    e.preventDefault();
    var panVal = $('#pan').val();
    var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;

    if (regpan.test(panVal)) {
        // valid pan card number
    } else {
        alert('Invalid pan card number');
        return false;
        // invalid pan card number
    }

    var pan = document.getElementById("pan");

    var key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
    var iv = CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");


    var encId = CryptoJS.AES.encrypt(pan.value, key, {
        iv,
        padding: CryptoJS.pad.ZeroPadding,
    });

    pan.value = encId.toString();
    var formProfile = document.getElementById("formProfile");
    formProfile.submit();
});
</script>

@endpush