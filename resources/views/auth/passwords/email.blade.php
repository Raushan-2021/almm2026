@extends('layouts.masters.home')

@section('content')
<div class="login-box text-center container-fluid">
    <h2>Reset Password</h2>
    <div id="loginform" class="mt-30 row">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group has-feedback col-sm-12 pr-0 pl-0">
                <span class="fa fa-user form-control-feedback"></span>
                <input type="email" id="email" class="form-control required" placeholder="Login email" name="email"
                    autocomplete="off" autofocus>
            </div>

            <div class="form-group has-feedback col-sm-12 pr-0 pl-0">
                <select name="user_type" class="form-control required" id="user_type">
                    <option selected disabled>Select User Type</option>
                    <option value="MNRE">MNRE</option>
                    <option value="STATEIMPLEMENTINGAGENCY">STATE IMPLEMENTING AGENCY</option>
                    <option value="LOCALBODY">LOCAL BODY</option>
                    <option value="INSTALLER">INSTALLER</option>
                    <option value="INSPECTOR">INSPECTOR</option>
                </select>
            </div>
            <div class="clearfix"></div>
            <div>
                @if(count($errors))
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
            </div>

            <button type="submit" class="btn btn-primary">
                {{ __('Send Password Reset Link') }}
            </button>
        </form>
    </div>
</div>
@endsection