@inject('general', 'App\Http\Controllers\Backend\Mfft\AwAnnexureController')

@extends('layouts.masters.backend')
@section('content')
@php $attchmentBaseUrl ='storage/documents/systems/Attachment/';
use App\Models\RlmmForwardDetail;
 @endphp
@section('title', isset($title) ? $title : 'Applications list')
{{-- <div class="my-3">
    <a href="{{URL::to('mnre_wind_users/reports')}}" style="color: blue; text-decoration: underline">
        Click here to view reports
    </a>
</div> --}}
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
                            <th width="10%">SNo.</th>
                            <th>Application No</th>
                            <!-- <th>Type</th> -->
                            <th>Name</th>

                            <th>Submitted Date</th>
                            <th>Inspection Status</th>
                            <th>Forward Status</th>
                            <th width="15%">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $key => $application)
                            <!--$user -> MainController->mnreUsers->compact se liya h  -->
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $application->application_no }}</td>
                                <!-- <td>{{ $general->getApplicationType($application->application_type) }} </td> -->
                                <td>{{ $application->manufacturer_name }}</td>

                                <td>{{ date('d, M Y', strtotime($application->updated_at)) }}</td>
                                <td>
                                    @if (!empty($application->inspectionData))
                                        <strong class="text-success">
                                            @if ($application->status == 5)
                                                Inspection Completed
                                            @else
                                                Inspection Scheduled
                                            @endif
                                        </strong>
                                    @else
                                        Pending
                                    @endif
                                    @if ($application->holdingData > 0)
                                        |
                                        <a title="View holding reason" style="cursor: pointer"
                                            onclick="openReasonModal(@php echo $application->id . ',' . $application->user_id @endphp)"><i
                                                class="bi bi-eye-fill" style="font-size: 16px;"></i></a>
                                    @endif
                                </td>
                                <td>
                                    @if ($application->forward_status == 'mnre')
                                        Forwarded to MNRE 

                                        <?php
                                        $latest = RlmmForwardDetail::where('application_id', $application->id)
                                                ->orderBy('id', 'desc')
                                                ->first();
                                        if(!empty($latest->dpr_document))
                                        {?>
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$latest->dpr_document)}}"
                                                class="document text-primary"><i class="fa fa-download" aria-hidden="true" title="Download DPR Documents"></i>
                                         </a>
                                                <?php
                                        }
                                        ?>
                                    @elseif($application->forward_status == 'return_mnre')
                                        Returned
                                    @elseif($application->forward_status == 'niwe')
                                        Forwarded to NIWE
                                    @endif
                                </td>
                                <td>

                                    <a href="{{ url('mnre_wind_users/view-application/' . $general->encodeid($application->id)) }}"
                                        class="">View</a> | <a
                                        href="{{ url('mnre_wind_users/track-detail/' . base64_encode($application->id)) }}"
                                        class="">Track</a> |
                                        <a href="{{url('mnre_wind_users/download-pdf-application/'.$general->encodeid($application->id))}}"
                                        class="">Download</a>
                                    @if ($application->status == 5)
                                        |
                                        <a target="_blank"
                                            href="{{ URL::to($attchmentBaseUrl . $application->inspection_report) }}"
                                            class="document text-primary">View Inspect Report</a>
                                        
                                    @endif

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="pull-right">{{ $applications->links('pagination::bootstrap-4') }}</div> --}}
            </div>
        </div>
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
<script>
    function openReasonModal(app_id, user_id) {
        $.ajax({
            url: "{{ url('mnre_wind_users/holding-reason') }}",
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
@endsection
