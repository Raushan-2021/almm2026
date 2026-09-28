@extends('layouts.masters.backend')
@section('content')
@section('title', 'Edit Profile')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="box-body">
                <form id="editProfileForm" action="{{URL::to('/mnre/edit-profile')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_code">{{ __('User Code') }} <span class="error">*</span></label>
                                <input type="text" class="form-control" name="user_code" value="{{$user->user_code}}" disabled>
                                @error('user_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">{{ __('Email') }} <span class="error">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" disabled>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Name') }} <span class="error">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{$user->name}}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <p>If you want to change your password <a href="{{URL::to('/'.Auth::getDefaultDriver().'/change-password')}}">Click Here</a></p>
                    <input type="submit" class="mt-1 btn btn-primary" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('backend-js')
<script>
    $(function(){
        $('#editProfileForm').validate();
    });
</script>
@endpush


