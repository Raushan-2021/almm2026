@extends('frontend.includes.master')
@section('title')
ALMM | Ministry of New and Renewable Energy
@endsection()
@section('styles')
@endsection()
@section('content')
<section class="signup_sectn">
    <div class="container pt-5 pb-5">
        <div class="row pt-5 pb-5 animatedParent">
            <div class="col-md-4 col-sm-3"></div>
            <div class="col-md-4 col-sm-6  signup_blk animated fadeInDownShort go">
                
                <div class="row signupforms">
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                    @endif
                    <form method="POST" action="{{URL::to('reset-user-password')}}">
                        @csrf
                        <div class="col-xl-12 text-center pb-2 pt-2"><h3>Forgot Password</h3></div>
                        <div class="col-md-12 col-sm-12 login_error_cls">
                            <label for="email">User Type <span class="text-danger">*</span></label>
                            <select name="user_type" class="form-control form-control-lgrequired" required
                                id="user_type" onChange="hide_phone()">
                                <option selected="" disabled="">Select User Type</option>
                                <option value="MNRE">MNRE</option>
                                <option value="MANUFACTURER">MANUFACTURER</option>
                                <option value="NISE">NISE</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12 login_error_cls">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" id="email" class="form-control form-control-lg required" required
                                placeholder="Login email" name="email" autocomplete="off" autofocus="" maxlength="64">
                        </div>
                        <div class="col-md-12 col-sm-12 login_error_cls" id="phone_div" style="display:none">
                            <label for="email">Phone <span class="text-danger">*</span></label>
                            <input type="text" id="phone" class="form-control form-control-lg required"
                                placeholder="Phone" name="phone" autocomplete="off" autofocus="" maxlength="10">
                        </div>
                        @if(!env('DEV_ENVIRONMENT'))
                        <div class="col-md-12 col-sm-12 login_error_cls">
                            <label for="email">Enter Captcha Value <span class="text-danger">*</span></label>
                            <div class="captcha login-captcha col-md-12">
                                <input type="text" id="captcha-input" maxlength="6"
                                    class="form-control required col-md-6   @error('captcha') is-invalid @enderror"
                                    name="captcha" placeholder="Captcha">
                                <?php echo captcha_img('flat'); ?>
                                <i id="refresh-captcha" class="fa fa-refresh pull-right captcha-refresh"
                                    aria-hidden="true"></i>
                                <div class="clearfix"></div>
                                @error('captcha') <div class="text-danger"> {{ $message }} </div> @enderror
                            </div>
                        </div>
                        @else
                        <span class="req fs12 mt-3">Application is in DEV MODE, captcha disabled</span>
                        @endif
                        <div class="col-md-12 d-grid text-center"><br><br>
                            <button type="submit" class="btn btn-success btn-lg btn-block mb-3">CHANGE
                                PASSWORD</button><br>
                            <p><span><a href="{{url('login')}}" style="text-decoration: none;"><strong
                                            class="text-success">Login</strong></a></span> | <span><a
                                        href="{{url('register-user')}}" style="text-decoration: none;"><strong
                                            class="text-success">sign in</strong></a></span></p>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-3"></div>
        </div>
    </div>

</section>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script>
function hide_phone() {
    $('#phone_div').show();
    var utype = $("#user_type option:selected").text();
    if (utype == 'MNRE') {
        $('#phone_div').hide();
    }
}
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