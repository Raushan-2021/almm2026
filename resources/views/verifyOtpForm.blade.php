@extends('frontend.includes.master')
@section('title')
ALMM | Ministry of New and Renewable Energy
@endsection()
@section('content')

<section class="signup_sectn">
    <div class="container pt-5 pb-5">
        <div class="row pt-5 pb-5 animatedParent">
            <div class="col-md-4 col-sm-3"></div>
            <div class="col-md-4 col-sm-6  signup_blk animated fadeInDownShort go">
                <div class="heading">Verify OTP</div>
                <div class="row signupforms">
                    @include('layouts.partials.backend._flash')
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <form method="POST" action="{{URL::to('verify-otp')}}" id="fileAjax">
                        @csrf

                        <div class="col-md-12 col-sm-12 login_error_cls mb-2">
                            <label for="email">Enter Email OTP <span class="text-danger">*</span></label>
                            <input type="password" id="email" class="form-control required" minlength="0" maxlength="6"
                                placeholder="Enter Email OTP" name="email" autocomplete="off" autofocus="">
                            @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                        <!-- @if(session('user_type')!= 'MNRE')
                        <label for="email">Enter Phone OTP <span class="text-danger">*</span></label>
                        <div class="col-md-12 col-sm-12 login_error_cls mb-2">
                            <input type="password" id="phone" class="form-control required" minlength="0" maxlength="6"
                                placeholder="Enter Phone OTP" name="phone" autocomplete="off" autofocus="">
                            @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                        @endif -->

                        <div class="col-md-12 d-grid text-center">
                            <button type="submit" class="btn btn-primary">
                                Verify OTP
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-3"></div>
        </div>
    </div>

</section>


@endsection