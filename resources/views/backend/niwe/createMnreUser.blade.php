@extends('layouts.masters.backend')
@section('content')
@section('title', 'MNRE User')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{url('mnre/create-mnre-user')}}" id="userForm" method="POST">@csrf
            <div class="row">
                <div class="col-md-4">
                    <label>Name <span class="error">*</span></label>
                    <input type="text" class="form-control required" name="name" value="{{@$user['name']}}">
                </div>
                <div class="col-md-4">
                    <label>Email <span class="error">*</span></label>
                    <input type="text" class="form-control required email" name="email" value="{{@$user['email']}}">
                </div>
                <div class="col-md-4">
                    <label>Password @if(!@$user['id'])<span class="error">*</span> @endif</label>
                    <input type="password" class="form-control @if(!@$user['id']) required @endif" name="password" value="" @if(@$user['id']) placeholder="Enter new password to change password" @endif>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="id" value="{{@$user['id']}}">
                    <button type="submit" class="btn btn-sm btn-primary pull-right ml-5">Submit</button>
                    <a href="{{url('mnre/mnre-user-list')}}" class="btn btn-sm btn-info pull-right">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('backend-js')
<script>
    $(function () { $('#userForm').validate(); });
</script>
@endpush
