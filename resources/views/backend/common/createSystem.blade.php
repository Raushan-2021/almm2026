@extends('layouts.masters.backend')
@section('content')
@section('title', $installation->bpmr_no ?? 'System')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="clearfix"></div>
        <ul id="installations-tabs" class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#system"><b>Installation (Stage 1)</b></a></li>
            <li class=""><a data-toggle="tab" href="#inspection"><b>Inspection (Stage 2)</b></a></li>
            @if (count($logs ?? 0) > 0)
                <li class=""><a data-toggle="tab" href="#logs"><b>Logs</b></a></li>
            @endif
        </ul>
        <div class="tab-content">
            <div id="system" class="tab-pane fade in active">
                <div class="box box-primary p-10">
                    <ul id="installations-tabs" class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#general"><b>System Details</b></a></li>
                        <li class=""><a data-toggle="tab" href="#bank"><b>Bank Details</b></a></li>
                        <li class=""><a data-toggle="tab" href="#documents"><b>Documents</b></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="general" class="tab-pane fade in active">
                            @include('backend.common.system-sections.general')
                        </div>
                        <div id="bank" class="tab-pane fade">
                            <div class="box-body">
                                @include('backend.common.system-sections.bank')
                            </div>
                        </div>
                        <div id="documents" class="tab-pane fade">
                            <form id="feebackForm" action="{{url('state-implementing-agency/modification-feedback')}}" method="POST"> @csrf
                                <div class="box-body">
                                    @include('backend.common.system-sections.documents')
                                </div>
                                <input type="hidden" name="systemId" id="systemId" value="{{$installation->id}}">
                                @if (Auth::getDefaultDriver() === 'state-implementing-agency' && $installation['installation_status'] == 4)
                                    <div class="box-footer">
                                        <textarea name="modification" class="form-control required" cols="30" rows="5" placeholder="Write comment..." name="comments"></textarea>
                                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/system/'.base64_encode($installation->id).'/AC')}}" class="btn btn-success">Accept</a>
                                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/system/'.base64_encode($installation->id).'/RJ')}}" class="btn btn-danger">Reject</a>
                                        <button type="submit" class="btn btn-primary">Send Modification Feedback</button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="inspection" class="tab-pane fade in ">
                <div class="box box-primary">
                    @include('backend.common.system-sections.inspectionform')
                </div>
            </div>
            <div id="logs" class="tab-pane fade">
                <div class="box box-primary">
                    <div class="box-body">
                        @include('backend.common.system-sections.logs')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/installation.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(".om-routines").datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            orientation: "bottom",
            startDate: "now"
        });
        validator = $('#installationForm').validate();
        $('#installationRejectionForm').validate();
        $('#installationModificationForm').validate();
        $('#feebackForm').validate();
        validator = $('#inspectionForm').validate();
        @if(isset($installation['id']))
            setDistrictBySubDistrict('{{$installation["sub_district_id"]}}', 'district_id', '{{$installation["district_id"]}}');
            setStateByDistrict('{{$installation["district_id"]}}', 'state_id', '{{$installation["state_id"]}}');
        @endif
    })
</script>
@endpush


