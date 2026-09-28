@inject('general', 'App\Http\Controllers\Backend\mnre\MainController')
@extends('layouts.masters.backend')
@section('content')
@php $attchmentBaseUrl ='mnre/preview-docs/Annexure/'; @endphp
@section('title', isset($title) ? $title : 'Scheduled Inspections List')
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <!-- <a href="{{URL::to('mnre/create-mnre-user')}}" class="btn btn-info">
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
                            <th>Type</th>
                            <th>Name</th>
                            <!-- <th>Status</th> -->
                            
                            <th width="20%">Inspection Status</th>
                            <th>Submitted Date</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                        <!--$user -> MainController->mnreUsers->compact se liya h  -->
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$application['application_no']}}</td>
                            <td>
                                {{$general->getApplicationType($application->application_type)}}
                            </td>
                            <td>{{$application->manufacturer_name}}</td>
                            <!-- <td> @if($application->status==1) Activate @else InActivate @endif</td> -->
                            

                            <td>@if(!empty($application->inspectionData))

                                @foreach($application->inspectionData as $incData)
                                <strong class="text-success">@if($application->status==5)Inspection Completed @else Inspection Scheduled @endif </strong><br>
                                Date : {{ $general->getDateFormat($incData['inspection_date'])}} <br>
                                Remark : {{$incData['remark']}}
                                @if($incData['change_request'] == 1 && $incData['status']==0)
                                <hr>
                                User Request for New Date<br>
                                New Proposed Date : <strong
                                    class="text-danger">{{ $general->getDateFormat($incData['proposed_date'])}}</strong><br>
                                Remark : {{$incData['request_remark']}}
                                @if($incData['change_request']==1 && $incData['status']==0 )
                                <br>
                                {{-- <a href="{{url('mnre/view-application/'.$general->encodeid($application->id))}}" class="text-success">Accept <i class="fa-solid fa-thumbs-up"></i></a>
                                &nbsp;&nbsp;&nbsp;

                                <a href="javascript:;" class="text-danger"
                                    onclick="rejectRequest({{$incData['id']}})">Reject <i
                                        class="fa-solid fa-thumbs-down pt-1"></i></a> --}}
                                @endif
                                @endif
                                @endforeach
                                @else
                                Pending
                                @endif
                            </td>
                            <td>{{ $general->getDateFormat($application->updated_at) }}</td>
                            <td>
                                
                               
                                <a href="{{url('mnre/view-application/'.$general->encodeid($application->id))}}"
                                    class="">View</a> | <a href="{{url('mnre/track-detail/'.base64_encode($application->id))}}"
                                    class="">Track</a>
                                    @if($application->status==5) |
                                    <a target="_blank"
                                        href="{{URL::to($attchmentBaseUrl.$application->inspection_report)}}"
                                        class="document text-primary">View Inspect Report</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script type="text/javascript">
function rejectRequest(id) {

    //e.preventDefault();
    if (confirm("Are you sure you want to reject request?")) {
        $.ajax({
            url: "{{url('mnre/reject-inspection-request')}}",
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
                        window.location.href = '/mnre/applications-list';
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
@endsection