@extends('layouts.masters.backend')
@section('content')
@section('title', 'Systems')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url(Auth::getDefaultDriver().'/systems')}}" method="post">@csrf
                    <div class="row">
                        @if (Auth::getDefaultDriver() === 'mnre' || Auth::getDefaultDriver() == 'installer')
                        <div class="col-md-3">
                            <label>State</label>
                            <select class="form-control select2" name="filter[state]">
                                <option selected value="All">All</option>
                                @foreach($states as $state)
                                <option value="{{$state['code']}}" @if($state['code'] == @$filters['state']) selected @endif>{{$state['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="col-md-3">
                            <label>Priority</label>
                            <select class="form-control select2" name="filter[priority]">
                                <option selected>All</option>
                                <option value="low" @if(@$filters['priority'] == "low") selected @endif>Low</option>
                                <option value="medium" @if(@$filters['priority'] == "medium") selected @endif>Medium</option>
                                <option value="high" @if(@$filters['priority'] == "high") selected @endif>High</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Status</label>
                            <select class="form-control select2" name="filter[status]">
                                <option selected value="0">All</option>
                                <option value="1" @if(@$filters['status'] == 1) selected @endif>Consumer Interest Approved</option>
                                <option value="2" @if(@$filters['status'] == 2) selected @endif>Installer Assigned</option>
                                <option value="3" @if(@$filters['status'] == 3) selected @endif>Installation Ongoing</option>
                                <option value="4" @if(@$filters['status'] == 4) selected @endif>Installation Done</option>
                                <option value="5" @if(@$filters['status'] == 5) selected @endif>Installation Accepted</option>
                                <option value="6" @if(@$filters['status'] == 6) selected @endif>Agency Feedback</option>
                                <option value="7" @if(@$filters['status'] == 7) selected @endif>Inspection Pending</option>
                                <option value="8" @if(@$filters['status'] == 8) selected @endif>Inspection Complete</option>
                                <option value="9" @if(@$filters['status'] == 9) selected @endif>Inspector Feedback</option>
                                <option value="10" @if(@$filters['status'] == 10) selected @endif>System Approved</option>
                                <option value="11" @if(@$filters['status'] == 11) selected @endif>Inspector Feedback</option>
                            </select>
                        </div>
                        <div class="col-md-3 pull-right">
                            <button class="btn btn-sm btn-info pull-right mt-25" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
                <div class="mt-25">
                    <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>System ID</th>
                                <th>Consumer ID</th>
                                <th>Consumer name</th>
                                <th>Installer ID</th>
                                <th>State</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($installations as $installation)
                                <tr>
                                    <td>{{$installation->bpmr_no ?? 'Not Generated'}}</td>
                                    <td>{{$installation->consumer_id}}</td>
                                    <td>{{$installation->consumer_name}}</td>
                                    <td>{{$installation->installer_id}}</td>
                                    <td>{{$installation->state_name}}</td>
                                    <td @if($installation->priority) class="{{$installation->priority}}" @endif>@if($installation->priority) {{$priorities[$installation->priority]}} @else Not assigned @endif</td>
                                    <td>{{$installation->status}}</td>
                                    <td>
                                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/add-edit-system/'.base64_encode($installation->id))}}" class="btn btn-xs btn-success">Open System</a>
                                        @if(Auth::getDefaultDriver() == 'state-implementing-agency' && $installation->installation_status == 5 && empty($installation->inspector_id))
                                        <button type="button" class="btn btn-info btn-xs" onclick="allotInspector(this, '{{URL::to('/'.Auth::getDefaultDriver().'/system-allot-inspector/'.base64_encode($installation->id))}}')">Allot Inspector</button>
                                        @endif
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

@include('modals.systemInspectorAssociation')
@endsection
