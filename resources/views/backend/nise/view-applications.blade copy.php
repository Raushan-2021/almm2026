@inject('general', 'App\Http\Controllers\Backend\Nise\MainController')
@extends('layouts.masters.backend')
@section('content')
@section('title', 'Applications Detail : '.$annexureData['applicationDetail']['application_no'])
@php $docBaseUrl ='nise/preview-docs/Annexure/';
$attchmentBaseUrl ='nise/preview-docs/Attachment/';
$logoBaseUrl ='users/preview-docs/Logo/';
$bomBaseUrl ='users/preview-docs/BOM/';
@endphp
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif
            <div class="col-md-12">
                <a href="{{url('/nise/applications-list')}}" class="btn btn-warning" style="float:right">Back</a>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th colspan="2">Details of Solar Photovoltaic (PV) Module Manufacturer
                        </th>
                    </tr>
                    <tr>
                        <th width="30%" class="table-primary">Type of Application</th>
                        <td>
                            {{$general->getApplicationType($annexureData['applicationDetail']['application_type'])}}

                        </td>
                    </tr>
                    <tr>
                        <td width="30%" class="table-primary"> <strong>Name of Manufacturer</strong>
                        </td>
                        <td>
                            {{$annexureData['applicationDetail']['manufacturer_name']}}
                        </td>
                    </tr>
                    <tr>
                        <td width="30%" class="table-primary"> <strong>Manufacturer Brand Name & Logo</strong>
                        </td>
                        <th>
                            <div class="row">
                                <div class="col-md-4">
                                    {{$annexureData['applicationDetail']['manufacturer_brand_name']}}

                                </div>
                                <!-- <div class="col-md-6">
                                                <div class="col-md-3">
                                                    <label for="">Upload Logo</label>

                                                </div>
                                                   </div> -->
                                <div class="col-md-8">
                                    <img src="{{ asset('storage/systems/Logo/'.$annexureData['applicationDetail']['manufacturer_brand_logo'])}}"
                                        style="width:70px">
                                </div>

                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td width="30%" class="table-primary"> <strong>Registered Office Address of the
                                Manufacturer
                            </strong> <br>

                        </td>
                        <th>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    Phone: <span
                                        class="text-primary">{{$annexureData['applicationDetail']['register_office_phone']}}</span>
                                </div>

                                <div class="col-md-6">
                                    Email: <span
                                        class="text-primary">{{$annexureData['applicationDetail']['register_office_email']}}
                                    </span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    Address: <span
                                        class="text-primary">{{$annexureData['applicationDetail']['register_office_address']}}</span>
                                </div>
                                <div class="col-md-6">
                                    Country: <span
                                        class="text-primary">{{$annexureData['applicationDetail']['country']}}</span>
                                </div>
                            </div>
                        </th>
                    </tr>

                    <tr>
                        <td width="30%" class="table-primary"> <strong>Communication Address of the
                                Manufacturer</strong> <br>

                        </td>
                        <th>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="phone">Phone:</label>
                                    {{$annexureData['applicationDetail']['com_phone']}}
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email:</label>
                                    {{$annexureData['applicationDetail']['com_email']}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    Address: <span
                                        class="text-primary">{{$annexureData['applicationDetail']['com_address']}}</span>
                                </div>
                                <div class="col-md-6">
                                    Country: <span
                                        class="text-primary">{{$annexureData['applicationDetail']['com_country']}}</span>
                                </div>
                            </div>



                        </th>
                    </tr>
                    <tr>
                        <td width="30%" class="table-primary"> <strong>Location/Address of Manufacturing Plant including
                                Latitude/Longitude for the current application</strong> <br>
                        </td>
                        <th>
                            {{$annexureData['applicationDetail']['plant_address']}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone">Phone:</label>
                                    {{$annexureData['applicationDetail']['plant_phone']}}
                                </div>
                                <div class="col-md-6"><label for="email">Email:</label>
                                    {{$annexureData['applicationDetail']['plant_email']}}
                                </div>
                                <div class="col-md-6">
                                    <label for="">Latitude:</label>
                                    {{$annexureData['applicationDetail']['plant_latitude']}}
                                </div>
                                <div class="col-md-6">
                                    <label for="Longitude">Longitude:</label>
                                    {{$annexureData['applicationDetail']['plant_longitude']}}
                                </div>
                            </div>

                        </th>
                    </tr>
                    <tr>
                        <td width="30%" class="table-primary"> <strong>Whether the Manufacturing Plant is
                                Located in SEZ (Only if Indian
                                Company)
                            </strong>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">{{$annexureData['applicationDetail']['is_sez']}}</label>
                                    @if($annexureData['applicationDetail']['is_sez']=='No')
                                    <a target="_blank"
                                        href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['gst_document'])}}"
                                        class="document text-primary">View</a>
                                    @endif
                                </div>

                        </td>

                    </tr>
                    <!-- <tr>
                        <td width="30%" class="table-primary"> <strong>Details of all Manufacturing Plant
                                under same Brand/Company name
                            </strong> 
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">No. of Manufacturing plant in India:</label>
                                    {{$annexureData['applicationDetail']['existing_plant_india']}}
                                </div>
                                <div class="col-md-6">
                                    <label for="">No. of Manufacturing plant out of India:</label>
                                    {{$annexureData['applicationDetail']['existing_plant_outindia']}}
                                </div>
                            </div>
                            <label for="">Provide details as per annexure 6 </label>
                        </td>

                    </tr> -->
                    <tr>
                        <td width="30%" class="table-primary"> <strong>Contact Person
                            </strong> <br>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Name:</label>
                                    {{$annexureData['applicationDetail']['contact_person_name']}}
                                </div>
                                <div class="col-md-6">
                                    <label for="">Designation:</label>
                                    {{$annexureData['applicationDetail']['person_designation']}}
                                </div>

                                <div class="col-md-6">
                                    <label for="">Phone No:</label>
                                    {{$annexureData['applicationDetail']['person_contact_no']}}
                                </div>

                                <div class="col-md-6">
                                    <label for="">E-mail:</label>
                                    {{$annexureData['applicationDetail']['person_email']}}
                                </div>

                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td width="30%" class="table-primary"> <strong>Authorized signatory details</strong> <br></td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Name:</label>
                                    {{$annexureData['applicationDetail']['authorize_name']}}
                                </div>

                                <div class="col-md-4">
                                    <label for="">Designation:</label>
                                    {{$annexureData['applicationDetail']['authorize_designation']}}
                                </div>
                                <div class="col-md-4">
                                    <label for="">Signatory Socument:</label>
                                    @if(($annexureData['applicationDetail']['signatory_document'] ?? '')!=null)
                                    <a target="_blank"
                                        href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['signatory_document'])}}"
                                        class="document text-primary">View</a>@else No @endif
                                </div>

                            </div>
                        </td>

                    </tr>
                    <!-- <tr class="hidden">
                        <td width="30%" class="table-primary"> <strong>No. of Main PV Model Applied</strong>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for=""><strong>Total No. of Main PV Models
                                            Applied: </strong></label>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Technology</th>
                                            <th>No. of Main PV Models Applied</th>
                                            <th>Highest Pmax (in Wp)</th>

                                        </tr>
                                        @foreach ($annexureData['applied_pvmodels'] as $key => $pvmodels)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$pvmodels->technology}}</td>
                                            <td>{{$pvmodels->no_pv_models}}</td>
                                            <td>{{$pvmodels->pmax}}</td>

                                        </tr>
                                        @endforeach

                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr> -->
                    <tr>
                        <td width="30%" class="table-primary"> <strong>Total PV Manufacturing Capacity (in
                                MW/year)</strong>
                            <br><br>
                            <i>Formula for calculating PV model Manufacturing Capacity:</i><br>
                            <br>
                            <small> <i>
                                    <u><span
                                            style="margin-top: 0px; position: absolute; margin-left: -6px;font-size: 18px;">(</span>No.
                                        of Cells Processed in an Hour</u><br>
                                    <span style="margin-left: 15px;">No.of cells in highest Wp PV
                                        model</span> <br>
                                    x Wattage of Highest Wp PV Model x
                                    24 x 350 x 0.9)

                                </i> </small>
                        </td>
                        <th>

                            <div class="row">
                                <div class="col-md-12">
                                    {{$annexureData['applicationDetail']['manufacturing_capacity']}} MW
                                </div>
                            </div>
                        </th>
                    </tr>
                </table>

                <!-- Annexure 1 Start-->
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingModule">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseModule" aria-expanded="true" aria-controls="collapseModule">
                                <h4>Module's</h4>
                            </button>
                        </h2>
                        <div id="collapseModule" class="accordion-collapse collapse show"
                            aria-labelledby="headingModule" data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-dark">
                                            <th width="5%">S.No</th>
                                            <th width="10%">Type of Modules</th>
                                            <th width="10%">Main Model</th>
                                            <th width="10%">Pmax (Wp) of Main Model</th>
                                            <th width="10%">Applicable models covered under +- 5%, Pmax of Main Model
                                            </th>
                                            <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($annexureData['moduleData'] as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->main_model}}</td>
                                            <td>{{$data->pmax_model}} Wp</td>
                                            <td>
                                                @foreach(json_decode($data->applicable_model_covered) as $amc)
                                                {{$amc}}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach(json_decode($data->applicable_model) as $am)
                                                {{$am}} Wp<br>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Module 1 End-->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h4>Annexure 1</h4>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                <table class="table table-bordered text-center table-responsive">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.1 </th>
                                            <th scope="col" colspan="8" class="text-left">Solar PV Model Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <th scope="row">Sr.No</th>
                                            <th>Type Of Modules</th>
                                            <th>Main Model</th>
                                            <th>Pmax (Wp) of Main Model</th>
                                            <th width="15%">Applicable models covered under +- 5%, Pmax of Main Model
                                            </th>
                                            <th width="15%">Pmax (Wp) of Applicable Models Model</th>
                                            <th width="15%">No of Cells & Cell Type (Full/Half/Third)</th>
                                            <th>System Voltage (VDC)</th>
                                        </tr>
                                        @foreach($annexureData['annexure1'] as $data)
                                        <tr class="table-warning">
                                            <th rowspan="">{{ $loop->iteration }}</th>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->main_model}}</td>
                                            <td class="text-center">{{$data->pmax_model}} Wp</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model_covered as
                                                    $applicable_model_covered)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model_covered }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model as $applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model }} Wp</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach($data->annexure as $ann_data)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $ann_data->no_of_cells }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach($data->annexure as $ann_data2)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $ann_data2->system_voltage }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.2</th>
                                            <th scope="col" colspan="13" class="text-left">Module Electric Data at STC
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Sr.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Main Model</th>
                                            <th rowspan="2" width="10%">Pmax (Wp) of Main Model</th>
                                            <th colspan="10" class="text-center">Electrical Data at STC</th>
                                        </tr>
                                        <tr>
                                            <th width="10%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                            <th>Pmax (Wp)</th>
                                            <th>Vmp (V)</th>
                                            <th>Imp (A)</th>
                                            <th>Voc (V)</th>
                                            <th>Isc (A)</th>
                                            <th>Module Efficiency (%)</th>
                                            <th width="15%">Fill Factor</th>
                                        </tr>
                                        @php $i=0; @endphp
                                        @foreach($annexureData['appDataSTC'] as $data)
                                        @php $i++; @endphp
                                        <tr class="text-center">
                                            <td>{{$i}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->main_model}}</td>
                                            <td class="text-center">{{$data->pmax_model}} Wp</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model_covered as
                                                    $applicable_model_covered)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model_covered }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model as
                                                    $applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model }} Wp</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $pmax_watt)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $pmax_watt->pmax_watt }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $vmp)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $vmp->vmp }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $imp)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $imp->imp }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $voc)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $voc->voc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $isc)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $isc->isc }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $model_efficiency)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $model_efficiency->model_efficiency }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $fill_factor)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $fill_factor->fill_factor }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="table table-bordered text-center hide hidden">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.3</th>
                                            <th scope="col" colspan="13" class="text-left">Module Electric Data at NOCT
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Sr.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Main Model</th>

                                            <th rowspan="2" width="10%">Pmax (Wp) of Main Model</th>
                                            <th colspan="10" class="text-center">Electrical Data at NOCT</th>

                                        </tr>
                                        <tr>
                                            <th width="10%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                            <th>Pmax (Wp)</th>
                                            <th>Vmp (V)</th>
                                            <th>Imp (A)</th>
                                            <th>Voc (V)</th>
                                            <th>Isc (A)</th>
                                            <th>Module Efficiency (%)</th>
                                            <th width="15%">Fill Factor</th>
                                        </tr>
                                        @php $j=0; @endphp
                                        @foreach($annexureData['appDataNOCT'] as $data)
                                        @php $j++; @endphp
                                        <tr class="text-center">
                                            <td>{{$j}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->main_model}}</td>
                                            <td class="text-center">{{$data->pmax_model}} Wp</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model_covered as
                                                    $applicable_model_covered)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model_covered }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model as
                                                    $applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model }} Wp</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $pmax_watt)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $pmax_watt->pmax_watt }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $vmp)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $vmp->vmp }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $imp)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $imp->imp }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $voc)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $voc->voc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $isc)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $isc->isc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $model_efficiency)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $model_efficiency->model_efficiency }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $fill_factor)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $fill_factor->fill_factor }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.4</th>
                                            <th scope="col" colspan="14" class="text-left">Module Operational Ratings
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Main Model</th>
                                            <th rowspan="2">Pmax (Wp) of Main Model</th>
                                            <th rowspan="2" width="10%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th rowspan="2" width="10%">Pmax (Wp) of Applicable Models Model</th>
                                            <th colspan="5" class="text-center">Operational Ratings</th>
                                        </tr>
                                        <tr>
                                            <!-- <th>Operational Temperature (ᴼC)</th> -->
                                            <th>Maximum System Voltage (V)</th>
                                            <th>Maximum Fuse Rating</th>
                                            <th>By-pass Diode Rating</th>
                                            <th>Fire Rating</th>
                                            <th>Warranty Details</th>
                                        </tr>
                                        @php $a=0; @endphp
                                        @foreach($annexureData['Annexure1Sub3'] as $data)
                                        @php $a++; @endphp
                                        <tr class="text-center">
                                            <td>{{$a}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->main_model}}</td>
                                            <td class="text-center">{{$data->pmax_model}} Wp</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model_covered as
                                                    $applicable_model_covered)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model_covered }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model as
                                                    $applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model }} Wp</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <!-- <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $operation_temp)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $operation_temp->operation_temp }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td> -->
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $max_voltage)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $max_voltage->max_voltage }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $max_fuse_rating)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $max_fuse_rating->max_fuse_rating }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $diode_rating)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $diode_rating->diode_rating }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $fire_rating)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $fire_rating->fire_rating }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $warrenty_details)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $warrenty_details->warrenty_details }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.5</th>
                                            <th scope="col" colspan="13" class="text-left">Module Temperature
                                                Characteristics</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Main Model</th>
                                            <th rowspan="2">Pmax (Wp) of Main Model</th>
                                            <th rowspan="2" width="15%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th rowspan="2" width="15%">Pmax (Wp) of Applicable Models Model</th>
                                            <th colspan="3" class="text-center">Module Temperature Characteristics</th>

                                        </tr>
                                        <tr>

                                            <th>Temperature Co-efficient of Pmax</th>
                                            <th>Temperature Coefficient of Voc</th>
                                            <th>Temperature Coefficient of Isc)</th>
                                        </tr>
                                        @php $b=0; @endphp
                                        @foreach($annexureData['Annexure1Sub4'] as $data)
                                        @php $b++; @endphp
                                        <tr>
                                            <td>{{$b}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->main_model}}</td>
                                            <td class="text-center">{{$data->pmax_model}} Wp</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model_covered as
                                                    $applicable_model_covered)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model_covered }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model as $applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model }} Wp</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $pmax_watt)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $pmax_watt->pmax_watt }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $voc)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $voc->voc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $isc)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $isc->isc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table><br>
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.6</th>
                                            <th scope="col" colspan="13" class="text-left">Module Dimensions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Main Model</th>
                                            <th rowspan="2">Pmax (Wp) of Main Model</th>
                                            <th rowspan="2" width="15%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th rowspan="2" width="15%">Pmax (Wp) of Applicable Models Model</th>
                                            <th colspan="4" class="text-center">Module Dimensions</th>
                                        </tr>
                                        <tr>
                                            <th>Length of Module (in mm)</th>
                                            <th>Breadth of Module (in mm)</th>
                                            <th>Area of Module (LxB) (in m2)</th>
                                            <th>Weight (in kg)</th>
                                        </tr>
                                        @php $c=0; @endphp
                                        @foreach($annexureData['Annexure1Sub5'] as $data)
                                        @php $c++; @endphp
                                        <tr>
                                            <td>{{$c}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->main_model}}</td>
                                            <td class="text-center">{{$data->pmax_model}} Wp</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model_covered as
                                                    $applicable_model_covered)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model_covered }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model as $applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model }} Wp</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $module_length)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $module_length->module_length }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $module_breadth)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $module_breadth->module_breadth }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $module_area)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $module_area->module_area }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $module_weight)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $module_weight->module_weight }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table><br>
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.7</th>
                                            <th scope="col" colspan="13" class="text-left">Solar Cell Specifications
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Main Model</th>
                                            <th rowspan="2">Pmax (Wp) of Main Model</th>
                                            <th rowspan="2" width="15%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th rowspan="2" width="15%">Pmax (Wp) of Applicable Models Model</th>
                                            <th colspan="4" class="text-center">Module Dimensions</th>
                                        </tr>
                                        <tr>
                                            <th>Base Material Doping Type(n-type/p-type)</th>
                                            <th>Efficiency of solar cells</th>
                                            <th>Wattage of full solar cells</th>
                                            <th>Full Cell Size (Dimension in mm)</th>
                                            <th>Cell Type used in module (Full/Half/Third)</th>
                                            <th>No of Cells in a Module</th>
                                            <th>Number of bus bars per cell</th>
                                        </tr>
                                        @php $d=0; @endphp
                                        @foreach($annexureData['Annexure1Sub6'] as $data)
                                        @php $d++; @endphp
                                        <tr>
                                            <td>{{$d}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->main_model}}</td>
                                            <td class="text-center">{{$data->pmax_model}} Wp</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model_covered as
                                                    $applicable_model_covered)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model_covered }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model as $applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model }} Wp</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $cell_technology)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $cell_technology->cell_technology }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $cell_efficiency)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $cell_efficiency->cell_efficiency }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $cell_wattage)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $cell_wattage->cell_wattage }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $cell_dimension)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $cell_dimension->cell_dimension }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $cell_type)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $cell_type->cell_type }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $cell_total_no)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $cell_total_no->cell_total_no }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $cell_total_bus)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $cell_total_bus->cell_total_bus }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Annexure 1 End-->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h4>Annexure 2</h4>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <!-- Annexure 2 Start-->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Type of Modules</th>
                                            <th>Main Model</th>
                                            <th width="10%">Pmax (Wp) of Main Model</th>
                                            <th width="10%">Applicable models covered under ± 5% of Mean Wattage</th>
                                            <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                            <th width="10%">BOM File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $j=0; @endphp
                                        @foreach($annexureData['annexure2'] as $data)
                                        @php $j++; @endphp
                                        <tr>
                                            <td>{{$j}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->main_model}}</td>
                                            <td class="text-center">{{$data->pmax_model}} Wp</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model_covered as
                                                    $applicable_model_covered)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model_covered }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model as $applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model }} Wp</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach ($data->annexure as $bom_attachment)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            <a target="_blank"
                                                                href="{{URL::to($bomBaseUrl.$bom_attachment->bom_attachment)}}"
                                                                class="document">View</a></small></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Annexure 2 End-->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <h4>Annexure 3</h4>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <!-- Annexure 3 Start-->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th colspan="9" class=" text-left">4.1 BIS Certification Details</th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Type of Modules</th>
                                            <th>Main Model</th>
                                            <th width="10%">Pmax (Wp) of Main Model</th>
                                            <th width="10%">Applicable models covered under ± 5% of Mean Wattage</th>
                                            <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                            <th>BIS Certificate Issue</th>
                                            <th>BIS Certificate Valid</th>
                                            <th>BIS Certificate No.</th>
                                            <th>Certificate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $j = 1 @endphp
                                        @foreach($annexureData['bis'] as $sub_annex_1)
                                        <tr>
                                            <td>{{$j++}}</td>
                                            <td>{{$sub_annex_1->module_name}}</td>
                                            <td>{{$sub_annex_1->main_model}}</td>
                                            <td class="text-center">{{$sub_annex_1->pmax_model}} Wp</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($sub_annex_1->applicable_model_covered as
                                                    $applicable_model_covered)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model_covered }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($sub_annex_1->applicable_model as $applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model }} Wp</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    @foreach($sub_annex_1->annexure as $bis_certificate_issue)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $bis_certificate_issue->bis_certificate_issue }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($sub_annex_1->annexure as $bis_certificate_valid)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $bis_certificate_valid->bis_certificate_valid }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($sub_annex_1->annexure as $bis_certificate_no)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $bis_certificate_no->bis_certificate_no }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @php $bis_certificate=''; @endphp
                                                    @foreach($sub_annex_1->annexure as $doc_certificate)

                                                    @php $bis_certificate=$doc_certificate->doc_certificate; @endphp
                                                    @endforeach
                                                </table>
                                                @if($bis_certificate!='')
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$bis_certificate)}}"
                                                        class="document text-primary"><i
                                                            class="bi bi-file-pdf fa-2x text-danger"></i></a></small>@endif

                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <br>
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th colspan="9" class=" text-left">4.2 Module Test Reports Details</th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Type of Modules</th>
                                            <th>Main Model</th>
                                            <th width="10%">Pmax (Wp) of Main Model</th>
                                            <th width="10%">Applicable models covered under ± 5% of Mean Wattage</th>
                                            <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                            <th>Testing Standards</th>
                                            <th>Test Report No.</th>
                                            <th>Testing Laboratory</th>
                                            <th>Testing Laboratory Address</th>
                                            <th>Valid NABL Certificate No. of Test Laboratory at the time of testing
                                            </th>
                                            <th>Certificate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1 @endphp
                                        @foreach($annexureData['nabl'] as $sub_annex_2)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$sub_annex_2->module_name}}</td>
                                            <td>{{$sub_annex_2->main_model}}</td>
                                            <td class="text-center">{{$sub_annex_2->pmax_model}} Wp</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($sub_annex_2->applicable_model_covered as
                                                    $applicable_model_covered)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model_covered }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($sub_annex_2->applicable_model as $applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model }} Wp</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($sub_annex_2->annexure as $test_standard_module)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $test_standard_module->test_standard_module }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($sub_annex_2->annexure as $test_report_no)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $test_report_no->test_report_no }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($sub_annex_2->annexure as $testing_laboratory)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $testing_laboratory->testing_laboratory }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($sub_annex_2->annexure as $testing_laboratory_address)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $testing_laboratory_address->testing_laboratory_address }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($sub_annex_2->annexure as $valid_nabl_certificate_no)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $valid_nabl_certificate_no->valid_nabl_certificate_no }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                @php $nabl_certificate=''; @endphp
                                                @foreach($sub_annex_2->annexure as $doc_certificate)

                                                @php $nabl_certificate=$doc_certificate->doc_certificate; @endphp
                                                @endforeach

                                                @if($nabl_certificate!='')
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$nabl_certificate)}}"
                                                        class="document text-primary"><i
                                                            class="bi bi-file-pdf fa-2x text-danger"></i></a></small>
                                                @endif
                                            </td>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                                <!-- Annexure 3 End-->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <h4>Annexure 4</h4>
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <!-- Annexure 4 Start-->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th colspan="7">Manufacturing Plant under same Brand/Company</th>
                                        </tr>
                                        <tr>
                                            <th>S.No</th>
                                            <th width="20%">Name of Company</th>
                                            <th>Country</th>
                                            <th width="25%">Address</th>
                                            <th>Whether Enlisted in ALMM </th>
                                            <th>No. of PV Models Enlisted in ALMM</th>
                                            <th>Enlisted/Rated PV Modules Manufacturing Capacity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($annexureData['annexure6'] as $data)
                                        @php
                                        $result =
                                        \App\Models\Country::select('name')->where('countrycd',$data->country)->first();
                                        @endphp
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->name_of_company}}</td>
                                            <td>
                                                @if($result)
                                                {{$result['name']}}
                                                @else
                                                @endif
                                            </td>
                                            <td>{{$data->address}}</td>
                                            <td>{{$data->whether_enlisted}}</td>
                                            <td>{{$data->noofpv_models}}</td>
                                            <td>{{$data->manufacturing_capacity}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="table table-bordered">
                                    <tr class="table-dark">
                                        <th colspan="3" class=" text-left">5.1 Manufacturing facility Details</th>
                                    </tr>
                                    <tr>
                                        <th width="5%">S.No</th>
                                        <th width="65%">Particulars</th>
                                        <th>Details</th>
                                    </tr>
                                    <tr>
                                        <th>1</th>
                                        <th>Manufacturing Plant Floor Area (in m2)</th>
                                        <td>{{$annexureData['annexure4']->plant_floor_area}} m<sup>2</sup></td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <th>Manufacturing Plant operational since</th>
                                        <td>{{$annexureData['annexure4']->plant_operational_date}}</td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <th>No. of Manufacturing Lines</th>
                                        <td>{{$annexureData['annexure4']->no_manufaturing_line}}</td>
                                    </tr>
                                    <tr>
                                        <th>4</th>
                                        <th>No. of Working Days in a year</th>
                                        <td>{{$annexureData['annexure4']->no_working_day}} Days</td>
                                    </tr>
                                    <tr>
                                        <th>5</th>
                                        <th>Total PV model Manufacturing Capacity </th>
                                        <td>{{$annexureData['annexure4']->manufacturing_capacity}}</td>
                                    </tr>
                                    <tr>
                                        <th>6</th>
                                        <th>Electricity Load Connected to manufacturing plant (in kW)</th>
                                        <td>{{$annexureData['annexure4']->electricity_load}} kW</td>
                                    </tr>
                                    <tr>
                                        <th>7</th>
                                        <th>Average Electricity Consumption per day (in kWh)</th>
                                        <td>{{$annexureData['annexure4']->electricity_consumption}} kWh</td>
                                    </tr>
                                    <tr>
                                        <th>8</th>
                                        <th>Details of Power Backup Available with capacity</th>
                                        <td>{{$annexureData['annexure4']->power_backup_details}}</td>
                                    </tr>
                                </table>
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th scope="col" colspan="13" class="text-left">5.2 List of Major
                                                Machines/Equipments
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <th width="6%"></th>
                                            <th width="5%">Line</th>
                                            <th width="10%">Compatible Technology (Cell Type/Max Cell Size/No. of Bus
                                                Bar)</th>
                                            <th>Commissioning Date</th>
                                            <th width="10%">Rated Manufacturing Capacity (24*7 *365 days working)</th>
                                            <th width="10%">List of Major Machines/Equipments</th>
                                            <th width="10%">Type</th>
                                            <th class="text-center">No. of Units</th>
                                            <th>Make</th>
                                            <th>Model</th>
                                            <th>Specification/Rating</th>
                                            <th>Country of Origin </th>

                                        </tr>
                                        @foreach($annexureData['annexure4_2'] as $data)
                                        <tr>
                                            <td width="10%"
                                                rowspan="{{ count(json_decode($data->major_equipments))+1}}">
                                            </td>
                                            <td rowspan="{{ count(json_decode($data->major_equipments))+1}}">
                                                @if($data->line==1)
                                                Line 1
                                                @else
                                                Line 2
                                                @endif</td>
                                            <td rowspan="{{ count(json_decode($data->major_equipments))+1}}">
                                                {{$data->compatible_technology}}</td>
                                            <td rowspan="{{ count(json_decode($data->major_equipments))+1}}">
                                                {{$data->commissioning_date}}</td>
                                            <td rowspan="{{ count(json_decode($data->major_equipments))+1}}">
                                                {{$data->rated_mfg_capacity}}</td>

                                        </tr>
                                        @foreach(json_decode($data->major_equipments) as $major_equipments)
                                        <tr class="bg-gray">
                                            <td>{{json_decode($data->major_equipments)[$loop->iteration-1]}}</td>
                                            <td>{{json_decode($data->equipments_type)[$loop->iteration-1]}}</td>
                                            <td>{{json_decode($data->no_of_units)[$loop->iteration-1]}}</td>
                                            <td>{{json_decode($data->make)[$loop->iteration-1]}}</td>
                                            <td>{{json_decode($data->model)[$loop->iteration-1]}}</td>
                                            <td>{{json_decode($data->rating)[$loop->iteration-1]}}</td>
                                            <td>{{json_decode($data->country_of_origin)[$loop->iteration-1]}}</td>

                                        </tr>
                                        @endforeach

                                        @endforeach

                                    </tbody>

                                </table>
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th colspan="14" class="text-left">5.3 Calibration Details of Sun Simulator
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <th width="6%">Equipment/Module</th>
                                            <th width="5%">S.No</th>
                                            <th width="10%">Make and Model</th>
                                            <th width="10%">Machine Serial No.</th>
                                            <th>Calibration Done by (Lab/Agency/Company Name with Address)</th>
                                            <th width="10%">Last Calibration Date</th>
                                            <th width="10%">Calibration Valid Upto</th>
                                            <th>Certificate</th>

                                        </tr>

                                        @foreach($annexureData['annexure4_3'] as $data4)
                                        <tr>
                                            <td>Sun Simulator</td>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data4->make_and_model}}</td>
                                            <td>{{$data4->machine_serial_no}}</td>
                                            <td>{{$data4->calibration_done_by}}</td>
                                            <td>{{$data4->last_calibration_date}}</td>
                                            <td>{{$data4->calibration_valid_upto}}</td>
                                            <td><a target="_blank"
                                                    href="{{URL::to($docBaseUrl.$data4->calibration_certificate)}}"
                                                    lass="document">View</a></td>


                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>5.4</th>
                                            <th scope="col" colspan="13" class="text-left">Calibration Details of
                                                Reference
                                                Modules
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <th width="10%">Module Type</th>
                                            <th width="5%">S.No</th>
                                            <!-- <th width="20%">Module Type and Power Rating</th> -->
                                            <th width="10%">Machine Serial No.</th>
                                            <th>Calibration Done by (Lab/Agency/Company Name with Address)</th>
                                            <th width="10%">Last Calibration Date</th>
                                            <th width="10%">Calibration Valid Upto</th>
                                            <th>Calibration Report</th>

                                        </tr>
                                        @php $i=$j=0; @endphp
                                        @foreach($annexureData['annexure4_4'] as $data)
                                        @if($data->module_type==1) @php $i++; @endphp
                                        <tr>
                                            @if($i==1)
                                            <td rowspan="{{$annexureData['gold']}}">@if($data->module_type==1)Golden
                                                Module @else
                                                Silver
                                                Module
                                                @endif</td>@endif
                                            <td>{{$i}}</td>
                                            <!-- <td>
                                                <table class="" width="80%">
                                                    <tr>
                                                        <th>Technology :</th>
                                                        <td>{{$data->technology_used}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Full Cell :</th>
                                                        <td>{{$data->no_full_cell}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Half Cell :</th>
                                                        <td>{{$data->no_half_cell}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Capacity :</th>
                                                        <td>{{$data->capacity}} Wp</td>
                                                    </tr>
                                                </table>
                                            </td> -->
                                            <td>{{$data->machine_serial_no}}</td>
                                            <td>{{$data->calibration_done_by}}</td>
                                            <td>{{$data->last_calibration_date}}</td>
                                            <td>{{$data->calibration_valid_upto}}</td>
                                            <td><a target="_blank"
                                                    href="{{URL::to($docBaseUrl.$data->calibration_certificate)}}"
                                                    class="document">View</a></small></a></td>


                                        </tr>
                                        @endif

                                        @if($data->module_type==2) @php $j++; @endphp
                                        <tr>
                                            @if($j==1)
                                            <td rowspan="{{$annexureData['silver']}}">@if($data->module_type==1)Golden
                                                Module @else
                                                Silver
                                                Module
                                                @endif</td>@endif
                                            <td>{{$j}}</td>
                                            <!-- <td>
                                                <table class="" width="80%">
                                                    <tr>
                                                        <th>Technology :</th>
                                                        <td>{{$data->technology_used}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Full Cell :</th>
                                                        <td>{{$data->no_full_cell}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Half Cell :</th>
                                                        <td>{{$data->no_half_cell}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Capacity :</th>
                                                        <td>{{$data->capacity}} Wp</td>
                                                    </tr>
                                                </table>
                                            </td> -->
                                            <td>{{$data->machine_serial_no}}</td>
                                            <td>{{$data->calibration_done_by}}</td>
                                            <td>{{$data->last_calibration_date}}</td>
                                            <td>{{$data->calibration_valid_upto}}</td>
                                            <td><a target="_blank"
                                                    href="{{URL::to($docBaseUrl.$data->calibration_certificate)}}"
                                                    class="document">View</a></small></a></td>


                                        </tr>
                                        @endif
                                        @endforeach

                                    </tbody>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>5.5</th>
                                            <th scope="col" colspan="13" class="text-left">ISO Certification Details for
                                                the
                                                Manufacturing Plant
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <th width="5%">S.No</th>
                                            <th width="20%">ISO Certificate</th>
                                            <th width="30%">Issuing Agency with Address</th>
                                            <th width="10%">Issuing Date</th>
                                            <th width="10%">Certificate Valid Upto</th>
                                            <th>Certificate Document</th>

                                        </tr>
                                        @foreach($annexureData['annexure4_5'] as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->iso_certificate}}</td>
                                            <td>{{$data->issuing_agency}}</td>
                                            <td>{{$data->issuing_date}}</td>
                                            <td>{{$data->certificate_validate}}</td>
                                            <td>@if(!empty($data->iso_certificate_doc))
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$data->iso_certificate_doc)}}"
                                                        class="document">View
                                                        Certificate</a></small>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <!-- Annexure 4 End-->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                <h4>Annexure 5</h4>
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @if(!empty($annexureData['annexure5']))
                                <h3 class="bg-primary text-light p-3">PV Module Production Data in MW for last 3
                                    financial year</h3>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Financial Year {{$annexureData['financialYear']['current']?? ''}}</th>
                                            <th>Financial Year {{$annexureData['financialYear']['last'] ?? ''}}</th>
                                            <th>Financial Year {{$annexureData['financialYear']['lastTolast'] ?? ''}}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=0;@endphp
                                        @foreach($annexureData['annexure5']['datatype3']['current'] as $data)

                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data['month']}}</td>


                                            <td><span class="productiondspan{{$data['id']}}"
                                                    id="productiondspan{{$data['id']}}">{{$data['module_production_data']}}</span>
                                                <input type="number" data-id="{{$data['id']}}"
                                                    id="module_production_data{{$data['id']}}"
                                                    value="{{$data['module_production_data']}}"
                                                    class="productiondtext{{$data['id']}} hidden"
                                                    onblur="updateData(this)">
                                            </td>
                                            <td><span class="productiondspan{{$data['id']}}"
                                                    id="productiondspan{{$annexureData['annexure5']['datatype3']['last'][$loop->iteration]['id']}}">{{$annexureData['annexure5']['datatype3']['last'][$loop->iteration]['module_production_data']}}</span>
                                                <input type="number"
                                                    data-id="{{$annexureData['annexure5']['datatype3']['last'][$loop->iteration]['id']}}"
                                                    id="module_production_data{{$annexureData['annexure5']['datatype3']['last'][$loop->iteration]['id']}}"
                                                    value="{{$annexureData['annexure5']['datatype3']['last'][$loop->iteration]['module_production_data']}}"
                                                    class="productiondtext{{$data['id']}} hidden"
                                                    onblur="updateData(this)">
                                            </td>
                                            <td><span class="productiondspan{{$data['id']}}"
                                                    id="productiondspan{{$annexureData['annexure5']['datatype3']['lastTolast'][$loop->iteration]['id']}}">{{$annexureData['annexure5']['datatype3']['lastTolast'][$loop->iteration]['module_production_data']}}</span>
                                                <input type="number"
                                                    data-id="{{$annexureData['annexure5']['datatype3']['lastTolast'][$loop->iteration]['id']}}"
                                                    id="module_production_data{{$annexureData['annexure5']['datatype3']['lastTolast'][$loop->iteration]['id']}}"
                                                    value="{{$annexureData['annexure5']['datatype3']['lastTolast'][$loop->iteration]['module_production_data']}}"
                                                    class="productiondtext{{$data['id']}} hidden"
                                                    onblur="updateData(this)">
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                @endif
                                @if(!empty($annexureData['annexure5']['datatype2']))
                                <h3 class="bg-primary text-light p-3">Raw Material Purchase Data for last 3 financial
                                    year</h3>
                                <table class="table table-bordered">
                                    <!-- Code : 2 -->
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="bg-green">
                                                <h4>Financial Year {{$annexureData['financialYear']['current']?? ''}}
                                                </h4>
                                            </th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Raw Material Purchase for Module Amount (Rs)</th>
                                            <th>Other Raw Material Purchase Amount (Rs)</th>
                                            <th>Total Purchase Amount (Rs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count1=$raw_purchase_module=$other_raw_purchase=0; @endphp
                                        @foreach($annexureData['annexure5']['datatype2'] as $data)
                                        @if(($annexureData['financialYear']['current'] ?? '')==$data->financial_year)
                                        @php
                                        $count1+=1;$raw_purchase_module+=$data->raw_purchase_module;$other_raw_purchase+=$data->other_raw_purchase;
                                        @endphp
                                        <tr>
                                            <td>{{$count1}}</td>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->raw_purchase_module}}</td>
                                            <td>{{$data->other_raw_purchase}}</td>
                                            <td>{{$data->raw_purchase_module + $data->other_raw_purchase}}
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        <tr class="bg-gray">
                                            <th>Total :</th>
                                            <th>--</th>
                                            <th>{{$raw_purchase_module}}</th>
                                            <th>{{$other_raw_purchase}}</th>
                                            <th>{{$raw_purchase_module+$other_raw_purchase}}</th>

                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <!-- Code : 2 -->
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="bg-green">
                                                <h4>Financial Year {{$annexureData['financialYear']['last'] ?? ''}}
                                                </h4>
                                            </th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Raw Material Purchase for Module Amount (Rs)</th>
                                            <th>Other Raw Material Purchase Amount (Rs)</th>
                                            <th>Total Purchase Amount (Rs)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count2=$raw_purchase_module2=$other_raw_purchase2=0;; @endphp
                                        @foreach($annexureData['annexure5']['datatype2'] as $data)
                                        @if($data->financial_year==$annexureData['financialYear']['last'])
                                        @php
                                        $count2+=1;$raw_purchase_module2+=$data->raw_purchase_module;$other_raw_purchase2+=$data->other_raw_purchase;
                                        @endphp
                                        <tr>
                                            <td>{{$count2}}</td>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->raw_purchase_module}}</td>
                                            <td>{{$data->other_raw_purchase}}</td>
                                            <td>{{$data->raw_purchase_module + $data->other_raw_purchase}}
                                            </td>

                                        </tr>
                                        @endif
                                        @endforeach
                                        <tr class="bg-gray">
                                            <th>Total :</th>
                                            <th>--</th>
                                            <th>{{$raw_purchase_module2}}</th>
                                            <th>{{$other_raw_purchase2}}</th>
                                            <th>{{$raw_purchase_module2+$other_raw_purchase2}}</th>

                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <!-- Code : 2 -->
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="bg-green">
                                                <h4>Financial Year
                                                    {{$annexureData['financialYear']['lastTolast'] ?? ''}}
                                                </h4>
                                            </th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Raw Material Purchase for Module Amount (Rs)</th>
                                            <th>Other Raw Material Purchase Amount (Rs)</th>
                                            <th>Total Purchase Amount (Rs)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count3=$raw_purchase_module3=$other_raw_purchase3=0; @endphp
                                        @foreach($annexureData['annexure5']['datatype2'] as $data)
                                        @if($data->financial_year==$annexureData['financialYear']['lastTolast'])
                                        @php
                                        $count3+=1;$raw_purchase_module3+=$data->raw_purchase_module;$other_raw_purchase3+=$data->other_raw_purchase;
                                        @endphp
                                        <tr>
                                            <td>{{$count3}}</td>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->raw_purchase_module}}</td>
                                            <td>{{$data->other_raw_purchase}}</td>
                                            <td>{{$data->raw_purchase_module + $data->other_raw_purchase}}
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        <tr class="bg-gray">
                                            <th>Total :</th>
                                            <th>--</th>
                                            <th>{{$raw_purchase_module3}}</th>
                                            <th>{{$other_raw_purchase3}}</th>
                                            <th>{{$raw_purchase_module3+$other_raw_purchase3}}</th>

                                        </tr>
                                    </tbody>
                                </table>
                                @endif
                                @if(!empty($annexureData['annexure5']))
                                <h3 class="bg-primary text-light p-3">PV Module Sales Data for last 3 financial year
                                </h3>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="7" class="bg-green">
                                                <h4>Financial Year {{$annexureData['financialYear']['current'] ?? ''}}
                                                </h4>
                                            </th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Total Module Sales (in MW)</th>
                                            <th>Module Sales Amount (in Rs)</th>
                                            <th>EPC and Other Sales Amount (in Rs)</th>
                                            <th>Total Sales Amount (Rs)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $countModuleSale1=0;$total_module_sale=$total_module_sale_amount=$epc_other_amount=0;
                                        @endphp
                                        @foreach($annexureData['annexure5']['datatype1'] as $data)
                                        @if(($annexureData['financialYear']['current'] ?? '')==$data->financial_year)
                                        @php $countModuleSale1+=1;
                                        $total_module_sale+=$data->module_sale;
                                        $total_module_sale_amount+=$data->module_sale_amount;
                                        $epc_other_amount+=$data->epc_other_amount;
                                        @endphp
                                        <tr>
                                            <td>{{$countModuleSale1}}</td>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->module_sale}}</td>
                                            <td>{{$data->module_sale_amount}}</td>
                                            <td>{{$data->epc_other_amount}}</td>
                                            <td>{{$data->module_sale_amount+$data->epc_other_amount}}</td>

                                        </tr>
                                        @endif
                                        @endforeach
                                        <tr class="bg-gray">
                                            <th>Total :</th>
                                            <th>--</th>
                                            <th>{{$total_module_sale}}</th>
                                            <th>{{$total_module_sale_amount}}</th>
                                            <th>{{$epc_other_amount}}</th>
                                            <th>{{$total_module_sale_amount+$epc_other_amount}}</th>

                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered">

                                    <thead>
                                        <tr>
                                            <th colspan="7" class="bg-green">
                                                <h4>Financial Year {{$annexureData['financialYear']['last'] ?? ''}}
                                                </h4>
                                            </th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Total Module Sales (in MW)</th>
                                            <th>Module Sales Amount (in Rs)</th>
                                            <th>EPC and Other Sales Amount (in Rs)</th>
                                            <th>Total Sales Amount (Rs)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $countModuleSale2=0;$total_module_sale2=$total_module_sale_amount2=$epc_other_amount2=0;
                                        @endphp
                                        @foreach($annexureData['annexure5']['datatype1'] as $data)
                                        @if(($annexureData['financialYear']['last'] ?? '')==$data->financial_year)
                                        @php $countModuleSale2+=1;
                                        $total_module_sale2+=$data->module_sale;
                                        $total_module_sale_amount2+=$data->module_sale_amount;
                                        $epc_other_amount2+=$data->epc_other_amount;
                                        @endphp
                                        <tr>
                                            <td>{{$countModuleSale2}}</td>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->module_sale}}</td>
                                            <td>{{$data->module_sale_amount}}</td>
                                            <td>{{$data->epc_other_amount}}</td>
                                            <td>{{$data->module_sale_amount+$data->epc_other_amount}}</td>

                                        </tr>
                                        @endif
                                        @endforeach
                                        <tr class="bg-gray">
                                            <th>Total :</th>
                                            <th>--</th>
                                            <th>{{$total_module_sale2}}</th>
                                            <th>{{$total_module_sale_amount2}}</th>
                                            <th>{{$epc_other_amount2}}</th>
                                            <th>{{$total_module_sale_amount2+$epc_other_amount2}}</th>

                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered">

                                    <thead>
                                        <tr>
                                            <th colspan="7" class="bg-green">
                                                <h4>Financial Year
                                                    {{$annexureData['financialYear']['lastTolast'] ?? ''}}
                                                </h4>
                                            </th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Total Module Sales (in MW)</th>
                                            <th>Module Sales Amount (in Rs)</th>
                                            <th>EPC and Other Sales Amount (in Rs)</th>
                                            <th>Total Sales Amount (Rs)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $countModuleSale3=0;$total_module_sale3=$total_module_sale_amount3=$epc_other_amount3=0;
                                        @endphp
                                        @foreach($annexureData['annexure5']['datatype1'] as $data)
                                        @if(($annexureData['financialYear']['lastTolast'] ?? '')==$data->financial_year)
                                        @php $countModuleSale3+=1;
                                        $total_module_sale3+=$data->module_sale;
                                        $total_module_sale_amount3+=$data->module_sale_amount;
                                        $epc_other_amount3+=$data->epc_other_amount;
                                        @endphp
                                        <tr>
                                            <td>{{$countModuleSale3}}</td>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->module_sale}}</td>
                                            <td>{{$data->module_sale_amount}}</td>
                                            <td>{{$data->epc_other_amount}}</td>
                                            <td>{{$data->module_sale_amount+$data->epc_other_amount}}</td>

                                        </tr>
                                        @endif
                                        @endforeach
                                        <tr class="bg-gray">
                                            <th>Total :</th>
                                            <th>--</th>
                                            <th>{{$total_module_sale3}}</th>
                                            <th>{{$total_module_sale_amount3}}</th>
                                            <th>{{$epc_other_amount3}}</th>
                                            <th>{{$total_module_sale_amount2+$epc_other_amount3}}</th>

                                        </tr>
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                <h4>Affidavit</h4>
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            @if(isset($annexureData['applicationDetail']) &&
                                            $annexureData['applicationDetail']['annexure7']!=null)
                                            <a href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['annexure7'])}}"
                                                style="margin-top: -8px;display: block;" target="_blank">View
                                                uploaded Annexure
                                            </a>
                                            @endif
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingEight">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                <h4>Indemnity</h4>
                            </button>
                        </h2>
                        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            @if(isset($annexureData['applicationDetail']) &&
                                            $annexureData['applicationDetail']['annexure8']!=null)
                                            <a href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['annexure8'])}}"
                                                style="margin-top: -8px;display: block;" target="_blank">View
                                                uploaded Annexure
                                            </a>
                                            @endif
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingEight">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                <h4>Attachment's</h4>
                            </button>
                        </h2>
                        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <table class="table table-bordered">
                                    <tr class="table-dark">
                                        <th width="5%">S.No</th>
                                        <th>Attachment Title</th>
                                        <th width="20%">Upload Certificate <span class="text-danger">*</span>
                                            (<i>Only PDF of 10 MB Max</i>)
                                        </th>
                                    </tr>
                                    <tr>
                                        <th> 1</th>
                                        <td>Copy of Certificate of Incorporation of the applying entity issued by
                                            Registrar
                                            of Companies, Ministry of Corporate Affairs, Government of India.</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['attc_incorporation_cerificate'])}}"
                                                class="document">Attachment No. 1</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 2</th>
                                        <td>Details of Payment of Application and Inspection Fee</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['attc_application_inspection_payment'])}}"
                                                class="document">Attachment No. 2</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 3</th>
                                        <td>Datasheets of the modules applied for enlistment in ALMM</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['attc_enlisted_module_datalist'])}}"
                                                class="document">Attachment No. 3</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 4</th>
                                        <td>Datasheets of the solar cells used in the modules</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['attc_solar_cell_datalist'])}}"
                                                class="document">Attachment No. 4</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 5</th>
                                        <td>Details of Balance of Materials as sought in Application Form</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['attc_bom_details'])}}"
                                                class="document">Attachment No. 5</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 6</th>
                                        <td>Copy of Certificate for BIS Registration/ Certification</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['attc_bis_certificate'])}}"
                                                class="document">Attachment No. 6</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 7</th>
                                        <td>Copy of the Accreditation Certificate of the Lab which has given test
                                            certificates required for BIS Registration/ Certification</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['attc_accreditation_certificate'])}}"
                                                class="document">Attachment No. 7</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 8</th>
                                        <td>Calibration Report of Sun Simulator</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['attc_calibration_report_sun_simulator'])}}"
                                                class="document">Attachment No. 8</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 9</th>
                                        <td>Copy of valid ISO Certificate for quality management system. Copy of
                                            Accreditation certificate of ISO certifying body</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['attc_iso_certificate'])}}"
                                                class="document">Attachment No. 9</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 10</th>
                                        <td>Balance Sheet for last three years or the period of existence of such units,
                                            whichever is less</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['attc_balance_sheet_last_years'])}}"
                                                class="document">Attachment No. 10</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 11</th>
                                        <td>Trademark Registration Certificate</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['attc_trademark_certificate'])}}"
                                                class="document">Attachment No. 11</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 12</th>
                                        <td>Construction Data Form(CDF) from BIS lab Report</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['attc_bis_lab_report'])}}"
                                                class="document">Attachment No. 12</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th> 13</th>
                                        <td>BIS lab Report</td>
                                        <td><a target="_blank"
                                                href="{{URL::to($docBaseUrl.$annexureData['applicationDetail']['attc_lab_report'])}}"
                                                class="document">Attachment No. 13</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><br>


                <hr>
                <blockquote>
                    @if($annexureData['applicationDetail']['forward_status']=='nise')
                    <tr>
                        <td colspan="7">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">Forward to MNRE</button>
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#exampleModal">Request for
                                Document</button>
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#scheduleInspection">Schedule
                                Inspection Date</button>
                            <a href="{{URL::to('/'.Auth::getDefaultDriver().'/applications-list')}}"
                                class="btn btn-danger">Back</a>
                        </td>
                    </tr>
                    @endif
                </blockquote>
            </div>

        </div>
    </div>
</div>

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('nise/forwardto') }}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{$annexureData['applicationDetail']['id']}}">
                    <div class="form-group">
                        <label for="forward_status" class="col-form-label">Forward Status:</label>
                        <select name="forward_status" id="forward_status">
                            <option value="mnre">Notification for MNRE</option>
                            <option value="user">Notification for USER</option>
                            <option value="reject">REJECT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea name="description" class="form-control" id="message-text" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<div class="modal" id="scheduleInspection">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Schedule Inspection Date</h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form action="{{ url('nise/scheduleInspection')}}" method="POST" autocomplete="off" id="formId">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="application_id" value="{{$annexureData['applicationDetail']['id']}}">
                    <input type="hidden" name="user_id" value="{{$annexureData['applicationDetail']['user_id']}}">



                    <div class="form-group">
                        <label for="forward_status" class="col-form-label">Schedule Inspection Date:</label>
                        <input type="date" name="inspection_date" class="form-control" id="inspection_date">
                        <span id="errorMsgScheduleDate" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea name="description" class="form-control" id="message-text"></textarea>
                        <span id="errorMsgRemark" class="text-danger"></span>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                    <button type="button" onclick="checkPoint()" class="btn btn-primary">Schedule</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>
            </form>

        </div>
    </div>
</div>
<script>
function checkPoint() {
    $('#errorMsgScheduleDate').html('');
    $('#errorMsgRemark').html('');
    // var proposedDate = Date.parse(Date.now)
    var scheduleDate = Date.parse($("#inspection_date").val())

    if ($("#inspection_date").val() == '') {
        $('#errorMsgScheduleDate').html('Please select schedule date');
        return false;
    }
    if ($("#message-text").val() == '') {
        $('#errorMsgRemark').html('Please enter remark');
        return false;
    }
    // if (proposedDate > scheduleDate) {
    //     alert('Schedule date should be greater than Proposed date');
    //     return false;
    // }
    if (scheduleDate < Date.now()) {
        alert('Schedule date should be future date');
        return false;
    }
    $("#formId").submit();
}
</script>

@endsection