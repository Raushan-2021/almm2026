@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'PV Model addition at the existing manufacturing facility')
@section('content')
<div class="row">

    <div class="col-md-12">

        <div class="box box-primary">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">
                        <div class="box-header with-border">
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#applyForExisting"
                                class="btn btn-success btn-lg"><i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                Click here to Apply for Addition of New Model in Existing Application</a>
                        </div>
                        <div class="box-body">



                            <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr class="bg-warning">
                                        <th width="5%">S.No</th>
                                        <th width="10%">Application No</th>
                                        <th width="12%">Ref. Application No</th>
                                        <th width="13%">Application Type</th>

                                        <th width="10%">Manufacturer Name</th>
                                        <th width="15%">Address</th>
                                        <th width="10%">Submitted on</th>
                                        <th width="15%">Inspection Status</th>
                                        <th width="10%">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $application)

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>@if($application->application_no =='')--- @else
                                            {{$application->application_no}} @endif </td>
                                        <td>
                                            <a class="text-primary"
                                                href="{{url('users/view-application/'.$application->previousApplicationId)}}"
                                                target="_blank">{{$application->previousApplicationNo}}</a>
                                        </td>
                                        <td>{{$general->getApplicationType($application->application_type)}}</td>
                                        <td>{{$application->manufacturer_name}}</td>
                                        <td>{{$application->register_office_address}}</td>

                                        <td>{{ $application->updated_at}}</td>
                                        <td>@if(!empty($application->inspectionData))

                                            @foreach($application->inspectionData as $incData)
                                            <strong class="text-success">Inspection Scheduled</strong><br>
                                            Date : {{ date("d-M-Y",strtotime($incData['inspection_date']))}} <br>
                                            Remark : {{$incData['remark']}}
                                            @if($incData['change_request'] == 1)
                                            <hr>
                                            Requested for New Date<br>
                                            New Proposed Date : <strong
                                                class="text-danger">{{ date("d-M-Y",strtotime($incData['proposed_date']))}}</strong><br>
                                            Remark : {{$incData['request_remark']}}
                                            @endif
                                            @if($incData['change_request'] == 0)
                                            <br><a href="javascript:;" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{$incData['id']}}"
                                                class="text-primary">Request for
                                                Change</a>
                                            <div class="modal fade" id="exampleModal{{$incData['id']}}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Request for
                                                                Re-Schedule
                                                                Inscpection Date</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="text-success"
                                                                id="msg{{$incData['id']}}"></span>
                                                            <span class="text-danger" id="err{{$incData['id']}}"></span>
                                                            <table class="table">
                                                                <tr>
                                                                    <th>Last Inspection Date</th>
                                                                    <td class="text-danger">
                                                                        {{ date("d-M-Y",strtotime($incData['inspection_date']))}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>New Proposed Date</th>
                                                                    <td><input type="date" class="form-control"
                                                                            name="proposed_date"
                                                                            id="proposed_date{{$incData['id']}}"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Mention Reason</th>
                                                                    <td><textarea name="request_remark"
                                                                            id="request_remark{{$incData['id']}}"
                                                                            cols="30" rows="3"></textarea></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary "
                                                                onclick="requestSave({{$incData['id']}})">Submit</button>
                                                            <input type="hidden" name=""
                                                                value="{{$incData['inspection_date']}}"
                                                                id="last_inspection_date{{$incData['id']}}">
                                                            <input type="hidden" name="" value="{{$application->id}}"
                                                                id="application{{$incData['id']}}">
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Close</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            @else
                                            Pending
                                            @endif
                                        </td>
                                        <td> @if($application->forward_status=='mnre') Not Forwarded
                                            @elseif($application->forward_status=='reject') Rejected
                                            @elseif($application->forward_status=='nise') Forwarded to NISE @endif</td>

                                        <td>@if($application->final_submission == '0')
                                            <a
                                                href="{{ url('users/existing-application/'.$general->encodeid($application->id)) }}"><i
                                                    class="fa fa-edit"></i></a>
                                            @else
                                            <a
                                                href="{{url('users/view-application/'.$general->encodeid($application->id))}}">View</a>
                                            |
                                            <a
                                                href="{{url('users/track-detail/'.$general->encodeid($application->id))}}">Track</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->

                    <div class="modal fade" id="applyForExisting" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">Request for Addition of New Model in
                                        Existing Application</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{URL::to('/users/select-existing-application')}}" method="POST"
                                        enctype="multipart/form-data" id="formAjax">
                                        @csrf
                                        @method('POST')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="">Select Application</label>
                                                <select name="application" id="application" class="form-control1"
                                                    onchange="getApplicationDetails(this)">
                                                    <option value="">~~~~~Select~~~~~</option>
                                                    @foreach($application_details as $data)
                                                    <option value="{{$general->encodeid($data->id)}}">
                                                        {{$data->application_no}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <div class="col-md-12"><br>

                                                    <table class="table table-bordered" id="apptable"
                                                        style="display:none">
                                                        <tr>
                                                            <th width="35%">Application No</th>
                                                            <td class="text-primary" id="app_no">ALMM/7980/3478</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Manufacturer</th>
                                                            <td class="text-primary" id="manufacturer_name">Coal</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Plant Capacity</th>
                                                            <td class="text-primary" id="app_capacity">23</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Authorize Person Name</th>
                                                            <td class="text-primary" id="authorize_name">Ankush</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Authorize Person Designation</th>
                                                            <td class="text-primary" id="authorize_designation">Coal
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Plant Details </th>
                                                            <td class="text-primary" id="plant_details">Coal</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="submit" class="btn btn-primary hide">Proceed</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
    </div>

    @endsection
    @push('backend-js')
    <script>
    function getApplicationDetails(data) {
        $('#apptable').hide();
        $('#loading-bg-ajax').removeClass('hide');
        $('#submit').addClass('hide');
        var appId = $(data).val();
        if (appId) {
            ajaxcall("GET", {}, baseUrl + "/ajax/fetch-Application-By-Id/" + appId).then((resp) => {
                $('#apptable').show();
                $('#submit').removeClass('hide');
                $('#app_no').html(resp.application_no);
                $('#manufacturer_name').html(resp.manufacturer_name);
                $('#app_capacity').html(resp.manufacturing_capacity);
                $('#authorize_name').html(resp.authorize_name);
                $('#authorize_designation').html(resp.authorize_designation);
                $('#app_no').html(resp.application_no);
                $('#plant_details').html(resp.plant_address + '<br>Latitute :' + resp.plant_latitude +
                    '<br>Longitute :' + resp.plant_longitude);
            });
        }

        $('#loading-bg-ajax').addClass('hide');
    }
    </script>
    @endpush