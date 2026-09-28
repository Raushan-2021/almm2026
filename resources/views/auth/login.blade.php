@extends('frontend.includes.master')
@section('title')
Ministry of New And Renewable Energy | Login
@endsection()
@section('content')
<style>
.heading {
  display: flex;
  align-items: center;
  font-size: 24px;
  font-weight: bold;
}

.logo {
  width: 250px;
  height: auto; 
  margin-right: 10px;
}
.signup_blk .heading {
    background: #e9e9e9;}
    .signup_sectn {min-height: 780px;}
</style>
<section class="signup_sectn">
    <div class="container pt-5  pb-5">
        <div class="row pt-5 pb-5 animatedParent">
            <div class="col-md-4 col-sm-3">

            </div>

            <!-- @if ($errors->any())
    <div class="alert alert-danger mb-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->
            <div class="col-md-4 col-sm-6  signup_blk animated fadeInDownShort go">
                <!-- <div class="heading">Login Here</div> -->
                <div class="heading text-center">
                    <div style="width: 100%;"><img src="{{ URL::asset('frontend/images/ALMM_logo.png') }}" alt="Logo" class="logo">
                </div>    
                </div>
                <div class="row signupforms">
                     <div class="col-xl-12 text-center" ><h3>Login Here</h3></div>
                    @include('layouts.partials.backend._flash')

                    <form id="formLogin" action="{{ route('login') }}" method="POST" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="col-md-12 col-sm-12 login_error_cls">
                            <label for="email">Email ID<span class="text-danger">*</span></label>
                            <input type="email" id="email"
                                class="form-control  form-control-lg required @error('email') is-invalid @enderror"
                                placeholder="Email ID" name="email" minlength="8" maxlength="64" autocomplete="off" autofocus>
                            @error('email') <span class="text-danger mb-3"> {{ $message }} </span> @enderror
                        </div>
                        <div class="col-md-12 col-sm-12 login_error_cls mt-3">
                            <label for="email">Password <span class="text-danger">*</span></label>
                            <input type="password" id="password" onblur="createToken()"
                                class="form-control form-control-lg required @error('password') is-invalid @enderror"
                                placeholder="Password" name="password" minlength="8" maxlength="64" autocomplete="off" onselectstart="return false"
                                onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false"
                                onDrop="return false">

                            @error('password') <div class="text-danger mb-3"> {{ $message }} </div> @enderror
                        </div>

                        <div class="col-md-12 col-sm-12 login_error_cls mt-3">
                            <label for="email">User Type <span class="text-danger">*</span></label>
                            <select name="user_type"
                                class="form-control form-control-lg required mb-15  @error('user_type') is-invalid @enderror"
                                id="user_type">
                                <option value="">User Type</option>
                                <option value="MNRE">MNRE</option>
                                <option value="NISE">NISE</option>
                                <option value="MANUFACTURER">MANUFACTURER</option>
                            </select>
                            @error('user_type') <div class="text-danger mb-3"> {{ $message }} </div> @enderror
                        </div>


                        
                        @if(!env('DEV_ENVIRONMENT'))
                        <div class="col-md-12 col-sm-12 login_error_cls">
                            <label for="email">Enter Captcha Value <span class="text-danger">*</span></label>
                            <div class="captcha login-captcha col-md-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <input type="text" id="captcha-input"
                                            class="form-control required col-md-6   @error('captcha') is-invalid @enderror"
                                            name="captcha" min="1" max="6" placeholder="Captcha">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <?php echo captcha_img('flat'); ?>
                                        <i id="refresh-captcha" class="fa fa-refresh pull-right captcha-refresh"
                                            aria-hidden="true"></i>
                                        <div class="clearfix"></div>
                                        @error('captcha') <div class="text-danger"> {{ $message }} </div> @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        @else
                        <span class="req fs12 mt-3">Application is in DEV MODE, captcha disabled</span>
                        @endif
                        <!-- <div class="clearfix"></div>
                        <div>
                            @if(count($errors))
                            <div class="alert alert-danger alert-validations text-center">
                                @foreach ($errors->all() as $error)
                                <span class="fs12">{{ $error }}</span><br>
                                @endforeach
                            </div>
                            @endif
                        </div> -->

                        <img src="image url" class="hidden" id="loadingImg" alt="">

                        <div class="col-md-12 d-grid text-center mt-2">


                            <button type="submit" id="loginBtn"
                                class="btn btn-success btn-lg btn-block mb-3">LOGIN</button><br>
                            <span><a href="{{url('register-user')}}" style="text-decoration: none;"><strong
                                        class="text-success">REGISTER</strong></a></span>
                            <span id='forgetPasswordLink'><a href="{{route('reset.password')}}" class="text-secondary" href="">Forgot
                                    Password?</a></span>
                            <span id="tk"></span>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-3"></div>
        </div>
    </div>

</section>
@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/form_custom.js')}}"></script>
<script type="text/javascript" src="{{asset('js/common.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/jquery.md5.js')}}"></script>
<script type="text/javascript" src="{{asset('js/crypto-js.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/aes.min.js')}}"></script>
@if ($errors->any())
<script>
    document.getElementById('email').value = '';
    document.getElementById('password').value = '';
    document.getElementById('captcha-input').value = '';
</script>
@endif
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
<script>
// $(function() {
//     //$('#formLogin').validate();
//     $('#refresh-captcha').click(function() {
//         let captcha_array = $('.captcha > img').attr('src').split('?');
//         let new_captcha = captcha_array[0] + '?' + makeid(8);
//         $('.captcha > img').attr('src', new_captcha);
//     });
// })
$('#refresh-captcha').click(function() {
    let img = $('.captcha img');  // correct selector

    let captcha_array = img.attr('src').split('?');
    let new_captcha = captcha_array[0] + '?' + makeid(8);

    img.attr('src', new_captcha);
});

function createToken() {
    if ($('#email').val() != '') {

        $('#loadingImg').removeClass('hidden');

        var token = makeid(20);
        $.ajax({
            type: "POST",
            url: "ajax/generate-token/" + token,
            data: {
                token: token,
            },
            processData: false,
            contentType: false,
            success: function(response) {
                $('#tk').html(token);
                $('#loadingImg').addClass('hidden');
            },
        });
    }



}

document.querySelector('#formLogin').addEventListener('submit', (e) => {
    e.preventDefault();

    var id = document.getElementById("email");
    var pwd = document.getElementById("password");
    var token = document.getElementById("tk").innerText;

    pwd.value = pwd.value + '-' + token;
    //alert(pwd.value);
    var key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
    var iv = CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");


    var encId = CryptoJS.AES.encrypt(id.value, key, {
        iv,
        padding: CryptoJS.pad.ZeroPadding,
    });
    var encPwd = CryptoJS.AES.encrypt(pwd.value, key, {
        iv,
        padding: CryptoJS.pad.ZeroPadding,
    });
    id.value = encId.toString();
    pwd.value = encPwd.toString();
    var loginForm = document.getElementById("formLogin");
    loginForm.submit();

});


$("#forgetPasswordLink").css("display", "block");
    
    $('#user_type').change(function() {

        if ($('#user_type').val() == 'MANUFACTURER') 
        {
        $("#forgetPasswordLink").css("display", "block");
        }else {  $("#forgetPasswordLink").css("display", "block"); }
    });


</script>
@if ($errors->any())
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Clear only email and password
    document.getElementById('email').value = "";
    document.getElementById('password').value = "";
});
</script>
@endif

@endsection
@section('styles')
<style>
label.error {
    bottom: initial;
    right: 0px;
    top: 35px;
}
</style>
@endsection