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
                    <div class="heading">Feedback</div>
                    @include('layouts.partials.backend._flash')
                    <form method="POST" action="{{ url('submit-feedback') }}" id="formRegister">
                        @csrf
                        <div class="row signupforms">
                            <div class="col-md-6 col-sm-12 error_cls">
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    placeholder="Full Name*" maxlength="64" autocomplete="off">
                                @error('name')
                                    <span class="text-danger valid_class" role="alert"
                                        style="padding-top: 3px; padding-left: 10px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 col-sm-12 error_cls">
                                <input type="email" id="email"
                                    class="form-control form-control-lg @error('email') form-control-lg is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="Email address*" maxlength="64"
                                    autocomplete="off">
                                @error('email')
                                    <span class="text-danger valid_class" role="alert"
                                        style="padding-top: 3px; padding-left: 10px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 error_cls">
                                <input type="text" name="phone" id="phone"
                                    class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}" placeholder="Mobile Number*" maxlength="10" autocomplete="off">
                                @error('phone')
                                    <span class="text-danger valid_class" role="alert"
                                        style="padding-top: 3px; padding-left: 10px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 error_cls">
                                <select name="type"
                                    class="form-control form-control-lg @error('type') is-invalid @enderror"
                                    value="{{ old('type') }}">
                                    <option value="">Please Select Feedback/Query*</option>
                                    <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Feedback</option>
                                    <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Query</option>
                                </select>
                                @error('type')
                                    <span class="text-danger valid_class" role="alert"
                                        style="padding-top: 3px; padding-left: 10px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 error_cls1">
                                <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" rows="10"
                                    placeholder="Write Something...*" maxlength="255" oninput="this.value=this.value.replace(/</g,'').replace(/>/g,'')">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-danger valid_class" role="alert"
                                        style="padding-top: 3px; padding-left: 10px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="clearfix"></div>
                            {{-- @if (!env('DEV_ENVIRONMENT'))
                                <div class="col-md-6 col-sm-12 error_cls">
                                    <div class="captcha login-captcha col-sm-12">
                                        <input type="text" id="captcha-input" class="form-control required"
                                            name="captcha" placeholder="Captcha" maxlength="6" autocomplete="off">
                                        @error('captcha')
                                            <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                                        @enderror
                                        <?php echo captcha_img('flat'); ?>
                                        <i id="refresh-captcha" class="fa fa-refresh pull-right captcha-refresh"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                            @else
                                <span class="req fs12">Application is in DEV MODE, captcha disabled</span>
                            @endif --}}
                            <div class="clearfix"></div>

                            <div class="col-md-12 d-grid text-center mt-7">
                                <button type="submit" class="btn btn-success btn-lg btn-block mt-5">Submit</button><br>

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
