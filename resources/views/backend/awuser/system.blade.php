@extends('layouts.masters.backend')
@section('content')
@section('title', $installation->bpmr_no ?? 'System')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="clearfix"></div>
        <ul id="installations-tabs" class="nav nav-tabs">
            <li onclick="reloadJs()"><a data-toggle="tab" href="#system"><b>Installation (Stage 1)</b></a></li>
            <li class="active"><a data-toggle="tab" href="#inspection"><b>Inspection (Stage 2)</b></a></li>
            @if (count($logs ?? 0) > 0)
                <li class=""><a data-toggle="tab" href="#logs"><b>Logs</b></a></li>
            @endif
        </ul>
        <div class="tab-content">
            <div id="system" class="tab-pane fade in">
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
                            @include('backend.common.system-sections.bank')
                        </div>
                        <div id="documents" class="tab-pane fade">
                            @include('backend.inspector.elements.systemdocuments')
                            <input type="hidden" name="systemId" id="systemId" value="{{$installation->id}}">
                        </div>
                    </div>
                </div>
            </div>
            <div id="inspection" class="tab-pane fade in active">
                <div class="box box-primary">
                    <form action="{{URL::to('/'.Auth::getDefaultDriver().'/update-inspection/'.base64_encode($installation->inspectionId))}}" method="POST" id="systemInspectorForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="systemId" id="systemId" value="{{$installation->id}}">
                        <input type="hidden" name="consumerId" id="consumerId" value="{{$installation->consumerId}}">
                        @include('backend.inspector.elements.inspectionform')
                    </form>
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
            startDate: new Date()
        });
        $('#systemInspectorForm').validate();
        validator = $('#inspectionForm').validate();
        @if(isset($installation['id']))
            setDistrictBySubDistrict('{{$installation["sub_district_id"]}}', 'district_id', '{{$installation["district_id"]}}');
            setStateByDistrict('{{$installation["district_id"]}}', 'state_id', '{{$installation["state_id"]}}');
        @endif
    })
    
    let reloadJs = () => {
        window.setTimeout(function() { $('.select2').select2(); }, 200);
    }
</script>
@endpush


