@extends('layouts.masters.backend')
@section('content')
@section('button')
    @if (Auth::getDefaultDriver() === 'mnre')
        <a href="{{URL::to(Auth::getDefaultDriver().'/create-installer')}}" class="btn btn-info pull-right">
            <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus-circle fa-w-20"></i></span>   ADD INSTALLER
        </a>
    @endif
@endsection
@section('title', 'Installers')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{url(Auth::getDefaultDriver().'/installer-list')}}" method="post">@csrf
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
                <div class="col-md-3">
                    <label>Status</label>
                    <select class="form-control select2" name="filter[status]">
                        <option selected value="ALL">All</option>
                        <option value="PEND" @if(@$filters['status'] === 'PEND') selected @endif>Pending</option>
                        <option value="ASSO" @if(@$filters['status'] === 'ASSO') selected @endif>Associated</option>
                    </select>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <button class="btn btn-sm btn-info pull-right mt-25" type="submit">Filter</button>
                </div>
            </div>
        </form>
        <div class="row mt-25">
            <div class="col-md-12">
                <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Installer ID</th>
                            <th>Installer Name</th>
                            <th>State</th>
                            <th>Contact No.</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($installers as $installer)
                            <tr>
                                <td>{{$installer->installer_id}}</td>
                                <td>{{$installer->name}}</td>
                                <td>{{$installer->state}}</td>
                                <td>{{$installer->phone}}</td>
                                <td>{{$installer->email}}</td>
                                <td>
                                    @if(Auth::getDefaultDriver() == 'mnre' || Auth::getDefaultDriver() == 'localbody')
                                        @if($installer->associated === NULL) Pending @else Associated @endif
                                    @else
                                        @if($installer->associated) Associated
                                        @elseif($installer->associated === 0) Blacklisted
                                        @else Pending @endif
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-xs" href="{{URL::to('/'.Auth::getDefaultDriver().'/installer-detail/'.base64_encode($installer->id))}}">View</a>
                                    @if (Auth::getDefaultDriver() === 'mnre')
                                        <a class="btn btn-primary-hallow btn-xs" href="{{URL::to('/'.Auth::getDefaultDriver().'/installer/'.base64_encode($installer->id).'/edit')}}">Edit</a>
                                    @endif
                                    @if (Auth::getDefaultDriver() === 'state-implementing-agency')
                                        @if($installer->associated !== NULL)
                                            @if ($installer->associated === 1)
                                                <a class="label label-danger" href="javascript:void(0)" data-text="blacklist this installer" onclick="blackListUser(this, '{{URL::to(Auth::getDefaultDriver().'/installer-blacklist/'.base64_encode($installer->id).'?blacklist=0')}}')">Blacklist</a>
                                            @elseif ($installer->associated === 0)
                                                <a class="label label-primary" href="javascript:void(0)" data-text="remove this installer from blacklist" onclick="blackListUser(this, '{{URL::to(Auth::getDefaultDriver().'/installer-blacklist/'.base64_encode($installer->id).'?blacklist=1')}}')">Reactivate</a>
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
        $(document).ready(function(){
            $('.select2').select2({
                placeholder: 'Associate installers'
            });
        });
    </script>
@endpush

