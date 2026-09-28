@extends('layouts.masters.backend')
@section('title', 'Maintenance Records')
@section('content')
<div class="box-primary box">
    <div class="box-body">
        <div class="row">
            @if (Auth::getDefaultDriver() === "state-implementing-agency")
            <div class="col-md-12 mb-15">
                <button type="button" data-toggle="modal" data-target="#requestMaintenanceModal" class="btn btn-info pull-right">Add Maintenance Request</button>
            </div>
            @endif
            <div class="col-md-12">
                @include('layouts.partials.backend._flash')
                <ul id="installations-tabs" class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#pending"><b>Pending Maintenance</b></a></li>
                    <li class=""><a data-toggle="tab" href="#completed"><b>Completed Maintenance</b></a></li>
                </ul>
                <div class="tab-content">
                    <div id="pending" class="tab-pane fade in active pt-15">
                        <table id="pendingMaintenanceTable" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Maintenance Request ID</th>
                                    <th>System ID</th>
                                    <th>Installer ID</th>
                                    <th>Maintenance Type</th>
                                    <th>Scheduled Maintenance Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($maintenanceRecords as $record)
                                    @if ($record->status == "0")
                                        <tr>
                                            <td>{{$record->request_code}}</td>
                                            <td>{{$record->bpmr_no}}</td>
                                            <td>{{$record->installer_id}}</td>
                                            <td>{{$record->maintenance_type == "PR" ? "Preventive" : "Curative"}}</td>
                                            <td>@if(!empty($record->scheduled_date)) {{date("d M Y",strtotime($record->scheduled_date))}} @endif</td>
                                            <td>
                                                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/maintenance-record/'.base64_encode($record->maintenance_id))}}" class="label label-primary">Open</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="completed" class="tab-pane fade pt-15">
                        <table id="completedMaintenanceTable" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Maintenance Request ID</th>
                                    <th>System ID</th>
                                    <th>Installer ID</th>
                                    <th>Maintenance Type</th>
                                    <th>Date of completion</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($maintenanceRecords as $record)
                                    @if ($record->status == "1")
                                        <tr>
                                            <td>{{$record->request_code}}</td>
                                            <td>{{$record->bpmr_no}}</td>
                                            <td>{{$record->installer_id}}</td>
                                            <td>{{$record->maintenance_type == "PR" ? "Preventive" : "Curative"}}</td>
                                            <td>@if(!empty($record->maintenance_date)) {{date("d M Y",strtotime($record->maintenance_date))}} @endif</td>
                                            <td>
                                                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/maintenance-record/'.base64_encode($record->maintenance_id))}}" class="btn btn-xs btn-primary">Open</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.requestMaintenance')
@endsection
@push('backend-js')
    <script>
        $(function(){
            $(".datepicker").datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                orientation: "bottom",
                startDate: new Date()
            });

            $("#requestMaintenanceForm").validate();
        });
    </script>
@endpush
