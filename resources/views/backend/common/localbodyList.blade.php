@extends('layouts.masters.backend')
@section('content')
@section('button')
    @if (Auth::getDefaultDriver() === 'mnre')
        <a href="{{URL::to('/mnre/create-localbody')}}" class="btn btn-info pull-right">
            <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus-circle fa-w-20"></i></span>   ADD LOCAL BODY
        </a>
    @endif
@endsection
@section('title', 'Local bodies')
<div class="box box-primary">
    <div class="box-body">
        @if (Auth::getDefaultDriver() === 'mnre')
            <form action="{{url(Auth::getDefaultDriver().'/localbody-list')}}" method="post">@csrf
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
        @endif
            <div class="row mt-25">
                <div class="col-md-12">
                    <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Localbody ID</th>
                                <th>Localbody Name</th>
                                <th>State</th>
                                <th>Contact Person</th>
                                <th>Contact No.</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($localbodyUsers as $localbody)
                                <tr>
                                    <td>{{$localbody->localbody_id}}</td>
                                    <td>{{$localbody->name}}</td>
                                    <td>{{$localbody->state}}</td>
                                    <td>{{$localbody->contact_person}}</td>
                                    <td>{{$localbody->phone}}</td>
                                    <td>{{$localbody->email}}</td>
                                    <td>
                                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/localbody-detail/'.base64_encode($localbody->id))}}" class="btn btn-xs btn-primary">View</a>
                                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/localbody/'.base64_encode($localbody->id).'/edit')}}" class="btn btn-xs btn-primary-hallow">Edit</a>
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
