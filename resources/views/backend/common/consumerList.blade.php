@extends('layouts.masters.backend')
@section('content')
@section('title', 'Consumer Interests')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url(Auth::getDefaultDriver().'/consumer-list')}}" method="post">@csrf
                    <div class="row">
                        @if (Auth::getDefaultDriver() === 'mnre')
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
                            <label>Status</label>
                            <select class="form-control select2" name="filter[status]">
                                <option selected>All</option>
                                <option value="approved" @if(@$filters['status'] == "approved") selected @endif>Approved</option>
                                <option value="rejected" @if(@$filters['status'] == "rejected") selected @endif>Rejected</option>
                                <option value="pending" @if(@$filters['status'] == "pending") selected @endif>Pending</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Priority</label>
                            <select class="form-control select2" name="filter[priority]">
                                <option selected>All</option>
                                <option value="high" @if(@$filters['priority'] == "high") selected @endif>High</option>
                                <option value="medium" @if(@$filters['priority'] == "medium") selected @endif>Medium</option>
                                <option value="low" @if(@$filters['priority'] == "low") selected @endif>Low</option>
                            </select>
                        </div>
                        <div class="col-md-3 pull-right">
                            <button class="btn btn-sm btn-info pull-right mt-25" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="mt-25">
                    <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Consumer ID</th>
                                <th>Consumer name</th>
                                <th>Email</th>
                                <th>State</th>
                                <th>Contact No.</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consumers as $consumer)
                                <tr>
                                    <td>{{$consumer->consumer_id}}</td>
                                    <td>{{$consumer->name}}</td>
                                    <td>{{$consumer->email}}</td>
                                    <td>{{$consumer->state}}</td>
                                    <td>{{$consumer->phone}}</td>
                                    <td class="{{$consumer->priority}}">{{$consumer->priority ? ucfirst($consumer->priority) : 'Not assigned'}}</td>
                                    <td>
                                        @if($consumer->is_approved == '1')
                                            <span>Approved</span>
                                        @elseif($consumer->is_approved == '0')
                                            <span>Rejected</span>
                                        @else
                                            <span>Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="{{URL::to(Auth::getDefaultDriver().'/consumer-detail/'.base64_encode($consumer->id))}}">View</a>
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

