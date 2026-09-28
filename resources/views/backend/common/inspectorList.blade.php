@extends('layouts.masters.backend')
@section('content')
@section('button')
    @if (Auth::getDefaultDriver() === 'mnre')
        <a href="{{URL::to('mnre/create-inspector')}}" class="btn btn-info pull-right">
            <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus-circle fa-w-20"></i></span>   ADD INSPECTOR
        </a>
    @endif
@endsection
@section('title', 'Inspectors')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{url(Auth::getDefaultDriver().'/inspector-list')}}" method="post">@csrf
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
                        <option selected value="All">All</option>
                        <option value="PEND" @if(@$filters['status'] === 'PEND') selected @endif>Pending</option>
                        <option value="ASSO" @if(@$filters['status'] === 'ASSO') selected @endif>Associated</option>
                    </select>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3 pull-right">
                    <button class="btn btn-sm btn-info pull-right mt-25">Filter</button>
                </div>
            </div>
        </form>
        <div class="row mt-25">
            <div class="col-md-12">
                <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Inspector ID</th>
                            <th>Inspector Name</th>
                            <th>State</th>
                            <th>Contact No.</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inspectors as $inspector)
                        <tr>
                            <td>{{$inspector->inspector_id}}</td>
                            <td>{{$inspector->name}}</td>
                            <td>{{$inspector->state}}</td>
                            <td>{{$inspector->phone}}</td>
                            <td>{{$inspector->email}}</td>
                            <td>
                                @if($inspector->associated !== null && $inspector->blacklist === 0)
                                    <span>Associated</span>
                                @elseif($inspector->blacklist === 1)
                                    <span>Blacklisted</span>
                                @else
                                    <span>Pending</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{URL::to('/'.Auth::getDefaultDriver().'/inspector-detail/'.base64_encode($inspector->id))}}">View</a>
                                @if (Auth::getDefaultDriver() === 'mnre')
                                    <a class="btn btn-xs btn-primary-hallow" href="{{URL::to('/'.Auth::getDefaultDriver().'/inspector/'.base64_encode($inspector->id).'/edit')}}">Edit</a>
                                @endif
                                @if (Auth::getDefaultDriver() === 'state-implementing-agency')
                                    @if($inspector->associated !== null)
                                        @if ($inspector->blacklist === 0)
                                            <a class="label label-danger" href="javascript:;" data-text="blacklist this inspector" onclick="blackListUser(this, '{{URL::to('/'.Auth::getDefaultDriver().'/inspector-blacklist/'.base64_encode($inspector->id).'?blacklist=1')}}')">Blacklist</a>
                                        @else
                                            <a class="label label-primary" href="javascript:;" data-text="remove from blacklist this inspector" onclick="blackListUser(this, '{{URL::to('/'.Auth::getDefaultDriver().'/inspector-blacklist/'.base64_encode($inspector->id).'?blacklist=0')}}')">Reactivate</a>
                                        @endif
                                    @endif
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
@endsection
@push('backend-js')
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Associate inspectors'
        });
    });
</script>
@endpush
