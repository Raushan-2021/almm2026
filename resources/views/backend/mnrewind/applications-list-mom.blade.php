@inject('general', 'App\Http\Controllers\Backend\Mfft\AwAnnexureController')

@extends('layouts.masters.backend')
@section('content')
@php $attchmentBaseUrl ='storage/app/public/approvals/';
use App\Models\RlmmForwardDetail;
 @endphp
@section('title', isset($title) ? $title : 'MoM Applications list')
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
                            <th width="5%">S.No.</th>
                            <th>Application No</th>
                            <th>Name</th>
                            <th>Message</th>
                            <th>NIWE Approved File</th>
                            {{-- <th width="20%">Action</th> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($applications as $key => $application)
                            @php
                                $latest = \App\Models\RlmmMomAppvdMnre::where('application_id', $application->id)
                                    ->orderBy('id', 'desc')
                                    ->first();
                            @endphp

                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $application->application_no }}</td>
                                <td>{{ $application->manufacturer_name }}</td>
                                <td>{{ $application->niwe_msg ?? '-' }}</td>

                                <td>
                                    @if (!empty($latest?->niwe_file))
                                        <a target="_blank"
                                        href="{{ URL::to($attchmentBaseUrl . $latest->niwe_file) }}"
                                        class="text-primary">
                                            <i class="fa fa-download" aria-hidden="true" title="Download MoM Document"></i>
                                            Download Document
                                        </a>
                                    @else
                                        <span class="text-muted">No File</span>
                                    @endif
                                </td>

                                {{-- Optional Action Column --}}
                                {{-- 
                                <td class="text-center">
                                    <!-- Add action buttons here if needed -->
                                </td>
                                --}}
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
