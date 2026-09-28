@extends('layouts.masters.backend')
@section('content')
@section('title', 'MNRE Users')
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <a href="{{URL::to('mnre/create-mnre-user')}}" class="btn btn-info">
                    <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus-circle fa-w-20"></i></span> ADD
                    USER
                </a>
            </div>
            <div class="col-md-12">
                <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="10%">SNo.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <!--$user -> MainController->mnreUsers->compact se liya h  -->
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a href="{{url('mnre/edit-mnre-user/'.base64_encode($user->id))}}"
                                    class="btn btn-xs btn-primary-hallow">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection