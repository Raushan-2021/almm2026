@extends('layouts.masters.backend')
@section('content')
@section('title', 'ALMM WIND MNRE User')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{url('mnre_wind_users/create-mnre-user')}}" id="userForm" method="POST">@csrf
            <div class="row">
                <div class="col-md-4">
                    <label>Name <span class="error">*</span></label>
                    <input type="text" class="form-control required" name="name" value="{{old('name')}}">
                     @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label>Email <span class="error">*</span></label>
                    <input type="text" class="form-control required email" name="email" value="{{old('email')}}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @if(!@$user['id'])
                <div class="col-md-4">
						<label>Password <span class="error">*</span></label>
						<input type="password" class="form-control @if(!@$user['id']) required @endif" name="password" value="{{old('password')}}" @if(@$user['id']) required placeholder="Enter new password to change password"  @endif>
                     @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="id" value="{{@$user['id']}}">
                    @if(@$user['id'])
                        <button type="submit" class="btn btn-sm btn-primary pull-right ml-5">Update</button>
                    @else
                        <button type="submit" class="btn btn-sm btn-primary pull-right ml-5">Submit</button>
                    @endif
                    <a href="{{url('mnre_wind_users/mnre-user-list')}}" class="btn btn-sm btn-info pull-right">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('backend-js')
<script>
    //$(function () { $('#userForm').validate(); });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script>
document.getElementById('userForm').addEventListener('submit', function(e) {
    const key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
    const iv = CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");

    const passwordField = document.querySelector('input[name="password"]');
    const encrypted = CryptoJS.AES.encrypt(
        passwordField.value,
        key,
        { iv: iv, mode: CryptoJS.mode.CBC, padding: CryptoJS.pad.ZeroPadding }
    );

    passwordField.value = encrypted.toString(); // Replace plain password with encrypted text
});
</script>

@endpush
