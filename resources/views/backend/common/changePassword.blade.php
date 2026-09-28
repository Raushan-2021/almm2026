@extends('layouts.masters.backend')
@section('title', 'Change Password')
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{$submitUrl}}" id="changePasswordForm" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="current_password">{{ __('Current Password') }}</label>
                        <input type="password" class="form-control" id="current_password" name="current_password"
                            autocomplete="off">
                        @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password">{{ __('New Password') }}</label>
                        <input type="password" data-placement="bottom" data-toggle="popover" data-trigger="focus"
                            data-html="true" data-content='<div id="errors"></div>'
                            class="form-control required passwordStrength" onblur="createToken()" onfocusout="validate_password(this.value)" minlength="6"
                            id="new_password" name="new_password" autocomplete="off">
                        @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">{{ __('Confirm Password') }}</label>
                        <input type="password" class="form-control" id="new_password_confirmation"
                            name="new_password_confirmation" autocomplete="off">
                        @error('new_password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" class="mt-1 btn btn-primary" value="Submit">
                    <span id="tk" class="hidden"></span>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('backend-js')
<script type="text/javascript">
$(function() {

    $('#changePasswordForm').validate();

    $("#new_password_confirmation").rules('add', {
        equalTo: "#new_password",
        messages: {
            equalTo: "Not matched with password."
        }
    });
});
</script>
@endpush