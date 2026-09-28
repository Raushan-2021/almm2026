@extends('layouts.masters.home')
@section('content')
<div class="login-box text-center container-fluid">
    <h2>Reset Password</h2>
    <div id="loginform" class="mt-30 row">
        <form method="POST" id="resetPasswordForm" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="user_type" value="{{ request()->type }}">

            <div class="form-group has-feedback col-sm-12 pr-0 pl-0">
                <span class="fa fa-user form-control-feedback"></span>
                <input id="email" type="email" class="form-control required" name="email"
                    value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            </div>

            <div class="form-group has-feedback col-sm-12 pr-0 pl-0">
                <span class="fa fa-lock form-control-feedback"></span>
                <input type="password" data-placement="bottom" data-toggle="popover" data-trigger="focus"
                    data-html="true" data-content='<div id="errors"></div>'
                    class="form-control required passwordStrength" id="password" name="password"
                    placeholder="New password" autocomplete="off">
            </div>

            <div class="form-group has-feedback col-sm-12 pr-0 pl-0">
                <span class="fa fa-lock form-control-feedback"></span>
                <input id="password-confirm" type="password" class="form-control required" name="password_confirmation"
                    required autocomplete="off" placeholder="Confirm password">
            </div>
            @if(count($errors))
            <div class="clearfix"></div>
            <div class="alert alert-danger alert-validations text-left">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <button type="submit" class="btn btn-primary">
                {{ __('Reset Password') }}
            </button>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$(function() {
    $('#resetPasswordForm').validate();
    $("#password-confirm").rules('add', {
        equalTo: "#password",
        messages: {
            equalTo: "Not matched with password."
        }
    });
});
</script>
@endsection