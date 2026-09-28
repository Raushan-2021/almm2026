@extends('frontend.includes.master')
@section('title')
Ministry of New And Renewable Energy | Register
@endsection()
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section class="signup_sectn">
    <div class="container pt-5 pb-5 animatedParent">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 signup_blk animated fadeInDownShort go">
                <!-- <div class="heading">Sign Up Here</div> -->
                <div class="heading text-center">
                    <div style="width: 100%;"><img src="{{ URL::asset('frontend/images/RLMM_logo.png') }}" alt="Logo" class="logo"></div>
                </div>
                <form method="POST" action="{{ url('register-user-rlmm') }}" id="formRegister">
                    @csrf
                    <div class="row signupforms">
                        <div class="col-xl-12 text-center pb-3 pt-3"><h3>Sign Up Here</h3></div>
                        <div class="col-md-6 col-sm-12 error_cls">
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                placeholder="{{__('messages.register.fullname')}}" maxlength="64" autocomplete="off">
                            @error('name') <span class="text-danger valid_class" role="alert"
                                style="padding-top: 3px; padding-left: 10px;">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 col-sm-12 error_cls">
                            <input type="email"
                                class="form-control form-control-lg @error('email') form-control-lg is-invalid @enderror"
                                name="email" id="email" value="{{ old('email') }}" placeholder="Email*" maxlength="64" autocomplete="off">

                            @error('email') <span class="invalid-feedback valid_class" role="alert"> {{ $message }}
                            </span> @enderror
                        </div>

                        <div class="col-md-6 col-sm-12 error_cls">
                            <a href="javascript:;"
                                style="float: right !important;position: absolute !important;left: 46% !important;margin-top: 13px !important;"
                                id="toggelPan" class="fa fa-eye pan-eye"></a>
                            <input type="password" name="pan" id="pan"
                                class="form-control form-control-lg @error('pan') is-invalid @enderror"
                                value="{{ old('pan') }}" placeholder="PAN*" maxlength="10" autocomplete="off">
                            @error('pan') <span class="invalid-feedback valid_class"> {{ $message }} </span> @enderror
                        </div>

                        <div class="col-md-6 col-sm-12 error_cls">
                            <input type="text" name="gst" id="gst"
                                class="form-control form-control-lg @error('gst') is-invalid @enderror"
                                value="{{ old('gst') }}" placeholder="GST*" autocomplete="off" maxlength="15">
                            @error('gst') <span class="invalid-feedback valid_class"> {{ $message }} </span> @enderror
                        </div>

                        <div class="col-md-12 error_cls">
                            <input type="number" name="phone" id="phone"
                                class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}" placeholder="Mobile*" autocomplete="off" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,10);">
                            @error('phone') <span class="invalid-feedback valid_class"> {{ $message }} </span> @enderror
                        </div>
                        <div class="col-md-12 error_cls_txtbox">
                            <textarea name="address" id="address"
                                class="form-control form-control-lg  @error('address') is-invalid @enderror" cols="30"
                                rows="3" placeholder="Registered address*"
                                autocomplete="off">{{ old('address') }}</textarea>
                            @error('address') <div class="text-danger" style="padding-top: 3px;padding-left: 10px;">
                                {{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 col-sm-12 error_cls">
                            <select name="country_id" id="country_id"
                                class="form-control form-control-lg  @error('country_id') is-invalid @enderror">
                                <option value="">Select Country*</option>
                                @foreach($countries as $country)
                                <option value="{{$country->countrycd}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                            @error('country_id') <span class="invalid-feedback valid_class" role="alert"> {{ $message }}
                            </span> @enderror
                        </div>
                        <div class="col-md-6 col-sm-12 error_cls state">
                            <select name="state_id" id="state_id" class="form-control form-control-lg">
                                <option value="">Select State</option>
                                @foreach($state as $state)
                                <option value="{{$state->code}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                            @error('district_id') <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                        <div class="col-md-6 col-sm-12 error_cls district">
                            <select name="district_id" id="district_id" class="form-control form-control-lg">
                                <option value="">Select District</option>
                            </select>
                            @error('district_id') <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                        <div class="col-md-6 col-sm-12 error_cls">
                            <input type="number" name="pincode" id="pincode"
                                class="form-control form-control-lg @error('pincode') is-invalid @enderror pincode"
                                value="{{ old('pincode') }}" maxlength="6" placeholder="Pincode*" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);">
                            @error('pincode') <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="clearfix"></div>
                        @if(!env('DEV_ENVIRONMENT'))
                        <div class="col-md-6 col-sm-12 error_cls">
                            <div class="captcha login-captcha col-sm-12">
                                <input type="text" id="captcha-input" class="form-control required" name="captcha"
                                    placeholder="Captcha" maxlength="6"autocomplete="off">
                                @error('captcha') <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                                @enderror
                                <?php echo captcha_img('flat'); ?>
                                <i id="refresh-captcha" class="fa fa-refresh pull-right captcha-refresh"
                                    aria-hidden="true"></i>
                            </div>
                        </div>
                        @else
                        <span class="req fs12">Application is in DEV MODE, captcha disabled</span>
                        @endif
                        <div class="clearfix"></div>

                        <div class="col-md-12 d-grid text-center mt-7">
                            <button type="submit" class="btn btn-success btn-lg btn-block mt-5">REGISTER</button><br>
                            <span><a href="{{ route('login')}}" style="text-decoration: none;"><strong
                                        class="text-success">I already have a membership</strong></a></span>
                            <!-- <span><a class="text-secondary" href="{{route('reset.password')}}">Forgot
                                    Password?</a></span> -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

</section>

@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/form_custom.js')}}"></script>
<script type="text/javascript" src="{{asset('js/common.js')}}"></script>
<script type="text/javascript" src="{{asset('js/crypto-js.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/aes.min.js')}}"></script>
<script>
$(function() {
    $('.state').hide();
    $('.district').hide();
    $("#country_id").change(function() {
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

    $('#formRegister').validate();
    $('#refresh-captcha').click(function() {
        let captcha_array = $('.captcha > img').attr('src').split('?');
        let new_captcha = captcha_array[0] + '?' + makeid(8);
        $('.captcha > img').attr('src', new_captcha);
    });

})

// $(document).ready(function() {
//     $('#toggelPan').click(function(e) {
//         ('#toggelPan').attr('')
//     });
// });

$(document).on('click', '#toggelPan', function() {
    // $(this).toggleClass("fa fa-eye");
    var input = $("#pan");
    input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
});
</script>

<script>
$(function() {
    //$('#formLogin').validate();
    $('#refresh-captcha').click(function() {
        let captcha_array = $('.captcha > img').attr('src').split('?');
        let new_captcha = captcha_array[0] + '?' + makeid(8);
        $('.captcha > img').attr('src', new_captcha);
    });
})
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#state_id').on('change', function(e) {
        // $('.district').hide();
        var state_id = $(this).val();
        $.ajax({
            url: "{{ url('get_distictbystate') }}",
            type: "POST",
            data: {
                state_id: state_id
            },
            success: function(data) {
                if (data != '') {
                    $('.district').slideDown();
                    $('#district_id').empty();
                    $("#district_id").append('<option value="">---District---</option>');
                    $.each(data, function(key, value) {
                        $("#district_id").append('<option value="' + value.code +
                            '">' + value.name + '</option>');
                    });

                }
            }
        })
    });
});

document.querySelector('#formRegister').addEventListener('submit', (e) => {
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
    var gst = document.getElementById("gst");

    // Encryption key & IV
    var key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
    var iv = CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");
    var encId = CryptoJS.AES.encrypt(pan.value, key, {
        iv,
        padding: CryptoJS.pad.ZeroPadding,
    });
    pan.value = encId.toString();

    var gst = document.querySelector('input[name="gst"]');
    if (gst && gst.value.trim() !== "") {

        var encGst = CryptoJS.AES.encrypt(gst.value, key, {
            iv,
            padding: CryptoJS.pad.ZeroPadding,
        });

        gst.value = encGst.toString();
    }
    
    var formRegister = document.getElementById("formRegister");
    formRegister.submit();
});


</script>
<script>
$(document).ready(function() {

  $(document).on('focusout', 'input, textarea, select', function() {
      const fldname = $(this).attr('id');  
      if (fldname) {
        validate_script(fldname);
      }
  });

});

function validate_script(fldname) {
    const field = document.getElementById(fldname);
    if (!field) return;

    if (field.type === 'file') return;

    let value = field.value;

    // Alphanumeric + space + hyphen + colon + @ + dot allow
    const cleanedValue = value.replace(/[^a-zA-Z0-9\- :@.]/g, '');

    if (value !== cleanedValue) {
        alert('Only alphanumeric characters, spaces, hyphens, colons, @, and . are allowed!');
        field.value = cleanedValue;
    }
}
</script>
@endsection
@section('styles')
<style>
label.error {
    bottom: initial;
    right: 0px;
    top: 35px;
}

.valid_class {
    margin-top: -16px;
    display: block;
    text-align: center;
    color: red;
}
</style>
@endsection