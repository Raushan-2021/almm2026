@extends('layouts.masters.backend')
@section('title', 'Operation maintenance')
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="box-body">
                @if (Auth::getDefaultDriver() === 'mnre' || Auth::getDefaultDriver() === 'installer')
                <form action="{{url(Auth::getDefaultDriver().'/system-maintenance')}}" method="post" class="mb-25">@csrf
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
                <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>System ID</th>
                            <th>Installer ID</th>
                            <th>Consumer Name</th>
                            <th>State</th>
                            <th>Pending Request</th>
                            <th>Completed Request</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maintenanceSystems as $system)
                            <tr>
                                <td>{{$system->bpmr_no}}</td>
                                <td>{{$system->installer_id}}</td>
                                <td>{{$system->consumer_name}}</td>
                                <td>{{$system->state_name}}</td>
                                <td>{{$system->pending}}</td>
                                <td>{{$system->complete}}</td>
                                <td>
                                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/maintenance-records/'.base64_encode($system->id))}}" class="btn btn-xs btn-primary">Maintenance Records</a>
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
