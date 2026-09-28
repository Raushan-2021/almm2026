@extends('layouts.masters.backend')
@section('content')
@section('button')
    <a href="{{URL::to('/mnre/create-state-implementing-agency')}}" class="btn btn-info pull-right">
        <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus-circle fa-w-20"></i></span>   ADD STATE IMPLEMENTING AGENCY
    </a>
@endsection
@section('title', 'State Implementing Agencies')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{url(Auth::getDefaultDriver().'/state-implementing-agency-list')}}" method="post">@csrf
            <div class="row">
                <div class="col-md-3">
                    <label>State</label>
                    <select class="form-control select2" name="filter[state]">
                        <option selected value="All">All</option>
                        @foreach($states as $state)
                        <option value="{{$state['code']}}" @if($state['code'] == @$filters['state']) selected @endif>{{$state['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <button class="btn btn-sm btn-info pull-right mt-25">Filter</button>
                </div>
            </div>
        </form>
            <div class="row mt-25">
                <div class="col-md-12">
                    <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Agency ID</th>
                                <th>Agency Name</th>
                                <th>State</th>
                                <th>Contact Person</th>
                                <th>Contact No.</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stateImplementingAgencyUsers as $user)
                            <tr>
                                <td>{{$user->state_implementing_agency_id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->state}}</td>
                                <td>{{$user->contact_person}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/state-implementing-agency-detail/'.base64_encode($user->id))}}" class="btn btn-primary btn-xs">View</a>
                                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/state-implementing-agency/'.base64_encode($user->id).'/edit')}}" class="btn btn-primary-hallow btn-xs">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
