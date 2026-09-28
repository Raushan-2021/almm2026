@extends('frontend.includes.master')
@section('title')
Ministry of New And Renewable Energy | Login
@endsection()
@section('content')
<section class="signup_sectn">
    <div class="container pt-5 pb-5">
        <div class="row pt-5 pb-5 animatedParent">
            <div class="col-md-4 col-sm-3"></div>
            <div class="col-md-4 col-sm-6  signup_blk animated fadeInDownShort go">
                <div class="heading">Change Password</div>
                <div class="row signupforms">
                    @include('layouts.partials.backend._flash')
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <form id="formLogin" action="{{ route('change.password') }}" method="POST" autocomplete="off">
                        {{ csrf_field() }}

                        <div class="col-md-12 col-sm-12 login_error_cls mb-2">
                            <label for="email">New Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control form-control-lg"
                                placeholder="Enter New Password">
                        </div>
                        <div class="col-md-12 col-sm-12 login_error_cls mb-2">
                            <label for="email">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" name="confirm-password" class="form-control form-control-lg"
                                placeholder="Enter Confirm Password">
                        </div>


                        <div class="col-md-12 d-grid text-center">


                            <button type="submit" class="btn btn-success btn-lg btn-block mb-3">CHANGE
                                PASSWORD</button><br>
                            <p><span><a href="" style="text-decoration: none;"><strong
                                            class="text-success">Login</strong></a></span> | <span><a href=""
                                        style="text-decoration: none;"><strong class="text-success">sign
                                            in</strong></a></span></p>


                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-3"></div>
        </div>
    </div>

</section>

@endsection