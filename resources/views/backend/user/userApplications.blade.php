@inject('general', 'App\Http\Controllers\Backend\Users\MainController')
@extends('layouts.masters.backend')
@section('title', 'User Applications')
@php $attchmentBaseUrl ='users/preview-docs/Annexure/'; @endphp
@section('content')
<!-- Small boxes (Stat box) -->
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <!-- <button class="btn btn-sm btn-info pull-right mt-25" type="submit">Filter</button> -->
                <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                    <thead>
                    <tr class="bg-primary text-white">
                            <th width="5%">S.No</th>
                            <th width="10%">Application No</th>
                            <th width="10%">Application Type</th>

                            <th width="10%">Manufacturer Name</th>
                            <th width="15%">Address</th>

                            <th width="10%">Inspection Status</th>
                            <th width="10%">Status</th>
                            <th width="10%">Submitted on</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                        @php $url='new-application';
                        if($application->application_type=='2'){
                        $url='existing-application';
                        }
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>@if($application->application_no =='')--- @else {{$application->application_no}} @endif
                            </td>
                            <td>{{$general->getApplicationType($application->application_type)}}</td>
                            <td>{{$application->manufacturer_name}}</td>
                            <td>{{$application->register_office_address}}</td>


                            <td>@if(!empty($application->inspectionData))

                                @foreach($application->inspectionData as $incData)

                                <strong class="text-success">@if($application->status==5)Inspection Completed @else Inspection Scheduled @endif</strong> <i class="fa fa-eye"
                                    onclick="$('#scheduleSpan{{$application->id}}').toggle('slow')"
                                    style=" cursor:pointer; "></i>
                                <br>

                                <span id="scheduleSpan{{$application->id}}" style=" display:none;">
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
                                        data-bs-target="#exampleModal{{$incData['id']}}" class="text-primary">Request
                                        for
                                        Change</a>
                                    <div class="modal fade" id="exampleModal{{$incData['id']}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Request for
                                                        Re-Schedule
                                                        Inspection Date</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <span class="text-success" id="msg{{$incData['id']}}"></span>
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
                                                                    id="request_remark{{$incData['id']}}" cols="30"
                                                                    rows="3"></textarea></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary "
                                                        onclick="requestSave({{$incData['id']}})">Submit</button>
                                                    <input type="hidden" name="" value="{{$incData['inspection_date']}}"
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

                                    <!-- Checking for Schedule change Request from NISE  -->
                                    @if($incData['change_request'] == 1 && $incData['status'] == 0)
                                    <br>Request : <span class="text-danger">Pending</span>
                                    @endif
                                    @if($incData['change_request'] == 1 && $incData['status'] == 2)
                                    <br>Request : <span class="text-danger">Rejected</span>
                                    @endif
                                    @if($incData['change_request'] == 1 && $incData['status'] == 1)
                                    <br>Request : <span class="text-danger">Approved</span>
                                    @endif
                                </span>

                                @endforeach
                                @else
                                --
                                @endif

                            </td>
                            <td> 
                                @if($application->forward_status=='mnre' && $application->final_submission==1)
                                    Forwarded to MNRE
                                    @elseif($application->forward_status=='return_mnre') Returned To MNRE
                                    @elseif($application->forward_status=='return_nise') Returned To NISE
                                    @elseif($application->forward_status=='nise') Forwarded to NISE
                                    @else
                                    --
                                    @endif
                            </td>
                            <td>@if($application->final_submission == 1)
                                <span class="text-success">{{ $application->updated_at}}</span>

                                @else
                                <span class="text-danger">Save as draft</span>

                                @endif

                            </td>
                            <td width="8%" >   
                            @if($application->final_submission == '0')
                                <a href="{{ url('users/'.$url.'/'.$general->encodeid($application->id)) }}"
                                title="Edit Application" alt="Edit Application"><i class="bi bi-pencil-square"></i></a>
                                @else
                                <a href="{{url('users/view-application/'.$general->encodeid($application->id))}}"
                                  title="View Application"  alt="View Application"><i class="bi bi-eye-fill text-success"></i></a>
                                |
                                <a href="{{url('users/download-pdf-application/'.$general->encodeid($application->id))}}"
                                    title="Download Application"><i class="bi bi-file-pdf"></i></a>
                                |
                                <a href="{{url('users/track-detail/'.$general->encodeid($application->id))}}"
                                    title="Track Application" alt="Track Application"><i class="bi bi-chevron-bar-contract"></i></a>
                                <br>
                                    @if($application->status == '5')
                                    <a target="_blank"
                                        href="{{URL::to($attchmentBaseUrl.$application->inspection_report)}}"
                                        class="document text-primary">View Inspect Report</a>

                                    @endif
                                    |
                                    <a href="{{ url('users/delete-application/'.$general->encodeid($application->id)) }}"
                                        class="text-danger" 
                                        title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this application?');">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                 
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
<!-- /.row -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script type="text/javascript">
function requestSave(id) {

    //e.preventDefault();

    let proposed_date = $('#proposed_date' + id).val();
    let request_remark = $('#request_remark' + id).val();
    let application_id = $('#application' + id).val();


    if (proposed_date == '') {
        $('#err' + id).html('Please select schedule date');
        return false;
    }
    if (request_remark == '') {
        $('#err' + id).html('Please enter remark');
        return false;
    }

    if (Date.parse(proposed_date) < Date.parse($("#last_inspection_date" + id).val())) {
        alert('Schedule date should be greater than last inspection date');
        return false;
    }
    $.ajax({
        url: "{{url('users/changeScheduleDate')}}",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            id: id,
            proposed_date: proposed_date,
            request_remark: request_remark,
            application_id: application_id
        },
        success: function(response) {
            //console.log(response);
            $('#err' + id).html('');
            if (response) {
                $('#msg' + id).html(response.success);
                //alert(response.success);
                setTimeout(() => {
                    window.location.href = "{{ URL::to('users/user-applications') }}";
                }, 1500);
                //$('#success-message').text(response.success);  
            }
        },
        error: function(response) {
            alert(response.error);
            //$('#name-error').text(response.responseJSON.errors.name);
        }
    });
};
</script>
@endsection