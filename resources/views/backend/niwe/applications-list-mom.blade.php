@inject('general', 'App\Http\Controllers\Backend\Niwe\MainController')

@extends('layouts.masters.backend')
@section('content')
@php $attchmentBaseUrl ='storage/app/public/approvals/';
use App\Models\RlmmMomAppvdMnre;
 @endphp
@section('title', isset($title) ? $title : 'Approved Committee MoM')
{{-- <div class="my-3">
    <a href="{{URL::to('mnre_wind_users/reports')}}" style="color: blue; text-decoration: underline">
        Click here to view reports
    </a>
</div> --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <!-- <h4>Approved Committee MoMs</h4> -->
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
            <th>Mnre Approval File</th>
            <th>Correction Documents</th>
            <th width="20%">Action</th>
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
                <td>{{ $application->approval_message }}</td>

                <td>
                    @if (!empty($latest?->approval_file))
                        <a target="_blank"
                           href="{{ URL::to($attchmentBaseUrl . $latest->approval_file) }}"
                           class="document text-primary">
                            <i class="fa fa-download" aria-hidden="true" title="Download MoM Documents"></i>
                            Download MoM Documents
                        </a>
                    @else
                        <span class="text-muted">No File</span>
                    @endif
                </td>

                <td>
                    @if (!empty($latest?->user_uploaded_doc))
                        <a target="_blank"
                           href="{{ URL::to($attchmentBaseUrl . $latest->user_uploaded_doc) }}"
                           class="document text-primary">
                            <i class="fa fa-download" aria-hidden="true" title="Download MoM Documents"></i>
                            Download MoM Documents
                        </a>
                    @else
                        <span class="text-muted">No File</span>
                    @endif
                </td>

                <td class="text-center">
                    <!-- Final Documents for MNRE -->
                    <?php 
                        $isexist = RlmmMomAppvdMnre::where('application_id',$application->id)->first();
                       // print_r($isexist); die();
                    ?>

                    @if(empty($isexist->niwe_file)  )
                        <button type="button"
                            class="btn btn-success btn-sm mb-1 w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#approvedniwe"
                            data-momid="{{ $latest->id ?? '' }}"
                            onclick="$('#modalMomId').val({{ $latest->id ?? 'null' }})">
                            Final Documents For MNRE
                        </button>    @if (empty($isexist->user_uploaded_doc))
                        <button type="button"
                            class="btn btn-warning btn-sm w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#requestAdditionalDocs"
                            data-momid="{{ $latest->id ?? '' }}"
                            onclick="$('#modalMomId').val({{ $latest->id ?? 'null' }})">
                        Request For Additional Documents
                    </button>@endif
                    @endif

                    <!-- Request for Additional Documents -->
                  
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

<!-- Niwe sent back Documents for mnre  -->
<div class="modal fade" id="approvedniwe" tabindex="-1" aria-labelledby="approvedLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="approveForm" action="{{ url('niwe/approvemom') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <?php //print_r ($application); die; ?>
        <input type="hidden" name="mom_id" id="modalMomId" value="{{@$appData['id']}}">
        <div class="modal-header">
          <h5 class="modal-title" id="approvedLabel">Approval Application</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <label for="niwe_msg" class="form-label">Approval message:</label>
          <textarea class="form-control" id="niwe_msg" name="niwe_msg" rows="3" ></textarea>

          <label for="niwe_file" class="form-label mt-3">Upload Approval Document:</label>
          <input type="file" class="form-control" id="niwe_file" name="niwe_file" accept=".pdf,application/pdf">

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Approved</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Request for Additional Documents Modal user-->
<div class="modal fade" id="requestAdditionalDocs" tabindex="-1" aria-labelledby="requestDocsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="requestDocsForm" action="{{ url('niwe/request-additional-docs') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="mom_id" id="modalMomId" value="{{ @$appData['id'] }}">

        <div class="modal-header">
          <h5 class="modal-title" id="requestDocsLabel">Request for Additional Documents</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <label for="niwe_msg_request" class="form-label">Message to Applicant:</label>
          <textarea class="form-control" id="niwe_msg_request" name="niwe_msg_request" rows="3" ></textarea>

          <label for="niwe_file_request" class="form-label mt-3">Attach Reference Document (optional):</label>
          <input type="file" class="form-control" id="niwe_file_request" name="niwe_file_request" accept=".pdf,application/pdf">
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Send Request</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const allModals = ['#approvedniwe', '#requestAdditionalDocs'];

  allModals.forEach(modalId => {
    const modalElement = document.querySelector(modalId);
    modalElement.addEventListener('show.bs.modal', event => {
      const button = event.relatedTarget;
      const momId = button.getAttribute('data-momid');
      modalElement.querySelector('#modalMomId').value = momId;
    });
  });
</script>


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
