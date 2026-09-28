@inject('general', 'App\Http\Controllers\Backend\Niwe\MainController')
@extends('layouts.masters.backend')
@section('content')
    @php $attchmentBaseUrl ='niwe/preview-docs/Annexure/'; @endphp
@section('title', 'Applications list')
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <!-- <a href="{{ URL::to('mnre/create-mnre-user') }}" class="btn btn-info">
                    <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus-circle fa-w-20"></i></span> ADD
                    USER
                </a> -->
            </div>
            <div class="col-md-12">
                @include('layouts.partials.backend._flash')
                <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%">SNo.</th>
                            <th>Application No</th>
                            <!-- <th>Type</th> -->
                            <th>Name</th>
                            <th>Status</th>

                            <th width="20%">Inspection Status</th>
                            <th>Submitted Date</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <!--$user -> MainController->mnreUsers->compact se liya h  -->
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $application['application_no'] }}</td>
                                <!-- <td>
                                    {{ $general->getApplicationType($application->application_type) }}
                                </td> -->
                                <td>{{ $application->manufacturer_name }}</td>
                                <td> @if ($application->status == 1)
                                        Activate
                                        @else
                                        InActivate
                                        @endif
                                        </td>
                                        
                                <td>
                                    @if (!empty($application->inspectionData))
                                        @foreach ($application->inspectionData as $incData)
                                       
                                            <strong class="text-success">
                                    
                                                @if ($application->status == 5)
                                                    Inspection Completed
                                                @else
                                                   Inspection Completed
                                                @endif

                                            </strong>
                                            @if ($application->status != 5)
                                                <a title="Add reason for holding" style="cursor: pointer" 
                                                    onclick="openDelayModal(@php echo $application->id . ',' . $application->user_id @endphp)">
                                                    <!-- <i class="bi bi-plus-circle-fill ps-3"></i> -->
                                                </a>
                                            @endif
                                            @if ($application->holdingData > 0)
                                                |
                                                <a title="View holding reason" style="cursor: pointer"
                                                    onclick="openReasonModal(@php echo $application->id . ',' . $application->user_id @endphp)"><i
                                                        class="bi bi-eye-fill" style="font-size: 16px;"></i></a>
                                            @endif
                                            <br>
                                            Date : {{ $general->getDateFormat($incData['inspection_date']) }} <br>
                                            Remark : {{ $incData['remark'] }}
                                            @if ($incData['change_request'] == 1 && $incData['status'] == 0)
                                                <hr>
                                                User Request for New Date<br>
                                                New Proposed Date : <strong
                                                    class="text-danger">{{ $general->getDateFormat($incData['proposed_date']) }}</strong><br>
                                                Remark : {{ $incData['request_remark'] }}
                                                @if ($incData['change_request'] == 1 && $incData['status'] == 0)
                                                    <br>
                                                    <a href="javascript:;" onclick="acceptRequest({{ $incData['id'] }})"
                                                        class="text-success">Accept <i
                                                            class="fa-solid fa-thumbs-up"></i></a>
                                                    &nbsp;&nbsp;&nbsp;

                                                    <a href="javascript:;" class="text-danger"
                                                        onclick="rejectRequest({{ $incData['id'] }})">Reject <i
                                                            class="fa-solid fa-thumbs-down pt-1"></i></a>
                                                @endif
                                            @endif
                                        @endforeach
                                    @else
                                        Pending
                                        <a title="Add reason for holding" style="cursor: pointer"
                                            onclick="openDelayModal(@php echo $application->id . ',' . $application->user_id @endphp)">
                                            <!-- <i class="bi bi-plus-circle-fill ps-3"></i> -->
                                        </a>
                                        @if ($application->holdingData > 0)
                                            |
                                            <a title="View holding reason" style="cursor: pointer" 
                                                onclick="openReasonModal(@php echo $application->id . ',' . $application->user_id @endphp)"><i
                                                    class="bi bi-eye-fill" style="font-size: 16px;"></i></a>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $general->getDateFormat($application->updated_at) }}</td>
                                {{-- <td>
                                @if ($application->status != 5)
                                <a href="{{url('niwe/view-application/'.$general->encodeid($application->id))}}" class="">View</a> | 
                                <a href="{{url('niwe/track-detail/'.$general->encodeid($application->id))}}" class="">Track</a>
                                @else
                                <a target="_blank"
                                        href="{{URL::to($attchmentBaseUrl.$application->inspection_report)}}"
                                        class="document text-primary">View Inspect Report</a>
                                @endif
                            </td> --}}
                                <td width="8%">
                                    @if ($application->final_submission != '0')
                                        <a href="{{ url('niwe/view-application/' . $general->encodeid($application->id)) }}"
                                            alt="View Application">View</a>
                                        |
                                        <a href="{{ url('niwe/download-pdf-application/' . $general->encodeid($application->id)) }}"
                                            title="Download Application">Download</a>
                                        |
                                        <a href="{{ url('niwe/track-detail/' . $general->encodeid($application->id)) }}"
                                            alt="Track Application">Track</a>
                                        <br>
                                        @if ($application->status == '5')
                                            <a target="_blank"
                                                href="{{ URL::to($attchmentBaseUrl . $application->inspection_report) }}"
                                                class="document text-primary">View Inspect Report</a>
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

<div class="modal fade" id="enterDelayReason" tabindex="-1" aria-labelledby="enterDelayReasonLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <form action="{{ url('niwe/submit-holding-reason') }}" method="POST" autocomplete="off">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="enterDelayReasonLabel"><b>Reason for holding</b></h1>
                </div>
                <div class="modal-body">
                    <textarea name="dealay_reason" id="dealay_reason" rows="10" class="form-control fs-6"
                        placeholder="Write your reason here..." required="required"></textarea>
                    <input type="hidden" name="application_id" id="application_id">
                    <input type="hidden" name="user_id" id="user_id">
                    <input type="hidden" name="current_url" value="{{ url()->full() }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="viewReason" tabindex="-1" aria-labelledby="viewReasonLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="viewReasonLabel"><b>Holding Reasons</b></h1>
            </div>
            <div class="modal-body" id="reason_list">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script type="text/javascript">
    function openDelayModal(app_id, user_id) {
        $("#application_id").val(app_id);
        $("#user_id").val(user_id);
        $("#dealay_reason").val("");
        $("#enterDelayReason").modal("show");
    }

    function openReasonModal(app_id, user_id) {
        $.ajax({
            url: "{{ url('niwe/holding-reason') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                app_id: app_id,
                user_id: user_id
            },
            success: function(response) {
                $("#reason_list").empty();
                response.data.length > 0 ? (
                    response.data.forEach((obj) => {
                        $("#reason_list").append(
                            `<p>${obj.reason} <b class="float-end">- ${obj.created_at}</b></p> <hr>`
                        );
                    })
                ) : $("#reason_list").append(`<p class="text-center">No data to display.</p> <hr>`);
                $("#viewReason").modal("show");
            },
            error: function(response) {
                alert(response.responseJSON.message);
            }
        });
    }
</script>
<script type="text/javascript">
    function rejectRequest(id) {
        //e.preventDefault();
        if (confirm("Are you sure you want to reject request?")) {
            $.ajax({
                url: "{{ url('niwe/reject-inspection-request') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                },
                success: function(response) {
                    //console.log(response);
                    $('#err' + id).html('');
                    if (response) {
                        $('#msg' + id).html(response.success);
                        alert(response.success);
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                        //$('#success-message').text(response.success);  
                    }
                },
                error: function(response) {
                    alert(response.error);
                    //$('#name-error').text(response.responseJSON.errors.name);
                }
            });
        }
    };

    
    function acceptRequest(id) {
            if (confirm("Are you sure you want to accept request?")) {
            $.ajax({
                url: "{{ url('niwe/accept-inspection-request') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                },
                success: function(response) {
                    //console.log(response);
                    $('#err' + id).html('');
                    if (response) {
                        $('#msg' + id).html(response.success);
                        alert(response.success);
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                        //$('#success-message').text(response.success);  
                    }
                },
                error: function(response) {
                    alert(response.error);
                    //$('#name-error').text(response.responseJSON.errors.name);
                }
            });
        }
    };



</script>

<script>
    $('#completeInspectionForm').on('submit', function (e) {
        e.preventDefault(); // prevent normal form submission

        var formData = new FormData(this);

        $.ajax({
            url: '{{ url("complete-inspection") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    location.reload(); // or window.location.href = decodeURIComponent(response.url);
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert('Something went wrong: ' + xhr.responseText);
            }
        });
    });

</script>


@endsection
