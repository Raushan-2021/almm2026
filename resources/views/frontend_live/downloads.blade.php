@extends('layouts.masters.home')
@section('content')
<div class="container">
    <div class="box box-primary frontPagesBox">
        <div class="box-body">
        <div class="panel-group" id="accordion">
            <div class="panel panel-primary">
                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                    <h4 class="panel-title">
                        <a>State Implementing Agencies</a>
                    </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="mb-10"><a href="{{url('public/downloadables/state_implementing_agency_registration_form.docx')}}"><i class="fa fa-download" aria-hidden="true"></i>  Implementing Agency Registration Form</a></div>
                        <div class="mb-10"><a href="{{url('public/downloadables/implementing_agency_demand_form.docx')}}"><i class="fa fa-download" aria-hidden="true"></i>  Implementing Agency Demand Request Form</a></div>
                        <div class="mb-10"><a href="{{url('public/downloadables/Implementing_agency_sanction_application_requestForm.docx')}}"><i class="fa fa-download" aria-hidden="true"></i>  Implementing Agency Sanction Request Form</a></div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                    <h4 class="panel-title">
                        <a> Local Bodies</a>
                    </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="mb-10"><a href="{{url('public/downloadables/localbody_registration_form.docx')}}"><i class="fa fa-download" aria-hidden="true"></i>  Local Body Registration Form</a></div>
                        <div class="mb-10"><a href="{{url('public/downloadables/demand_assesment_form.docx')}}"><i class="fa fa-download" aria-hidden="true"></i>  Local Body Demand Request Form</a></div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                    <h4 class="panel-title">
                        <a>Installers</a>
                    </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="mb-10"><a href="{{url('public/downloadables/Installer_registration_request_form.docx')}}"><i class="fa fa-download" aria-hidden="true"></i>  Installer Registration Form</a></div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                    <h4 class="panel-title">
                        <a>Inspectors</a>
                    </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="mb-10"><a href="{{url('public/downloadables/inspector_registration_request_form.docx')}}"><i class="fa fa-download" aria-hidden="true"></i>  Inspector Registration Form</a></div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection