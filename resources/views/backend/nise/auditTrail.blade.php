@extends('layouts.masters.backend')
@section('content')
@section('title', 'List of transactions of AlMM Portal')
<div class="box box-primary">
    <div class="box-body">
        <div class="row">

            <div class="col-md-12">
                <form action="{{url(Auth::getDefaultDriver().'/audit-trail')}}" method="post">@csrf
                    <div class="col-md-4">
                        <label>From</label>
                        <input type="date" id="date" class="form-control" placeholder="" name="fromDate">
                        <span class="text-danger">{{ $errors->first('fromDate') }}</span>
                    </div>
                    <div class="col-md-4">
                        <label>To</label>
                        <input type="date" id="date" class="form-control " placeholder="" name="toDate">
                        <span class="text-danger">{{ $errors->first('toDate') }}</span>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-sm btn-info pull-right mt-25" type="submit">Filter</button>
                    </div>
                </form>
                <!-- <button class="btn btn-sm btn-info pull-right mt-25" type="submit">Filter</button> -->
                <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Action Type</th>
                            <th>Module Name</th>
                            <th>Description</th>
                            <th>Device</th>
                            <th>Ip Address</th>
                            <th>Entry Date</th>


                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($auditTrailData as $key => $value)
                        <!--$auditTrailData-> MainController->auditTrail->compact se liya h  -->
                        <tr>
                            <td>@if($value->user_id ==0)Guest @else Site User @endif</td>
                            <td>@if($value->action_type=='1')
                                View
                                @elseif($value->action_type=='2')
                                Insert
                                @elseif($value->action_type=='3')
                                Update
                                @elseif($value->action_type=='4')
                                Delete
                                @elseif($value->action_type=='5')
                                List
                                @else
                                Download
                                @endif
                            </td>
                            <td>{{$value->module_name}}</td>
                            <td>{{$value->description}}</td>
                            <td>{{$value->device}}</td>
                            <td>{{$value->ip_address}}</td>
                            <td>{{$value->entry_date}}</td>
                        </tr>
                        @endforeach
                    </tbody>



                </table>
            </div>
        </div>
    </div>
</div>
@endsection