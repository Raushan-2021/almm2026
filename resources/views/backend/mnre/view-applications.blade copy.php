@extends('layouts.masters.backend')
@section('content')
@section('title', 'Applications Detail')
@php $docBaseUrl ='mnre/preview-docs/Annexure/';
$attchmentBaseUrl ='mnre/preview-docs/Attachment/';
@endphp
<div class="box box-primary">
    <div class="box-body">
        <div class="row">

            <div class="col-md-12">
                <a href="{{url('/mnre/applications-list')}}" class="btn btn-warning" style="float:right">Back</a>
                <table class="table table-bordered">
                    <tr>
                        <th colspan="2">Details of Solar Photovoltaic (PV) Module Manufacturer
                        </th>
                    </tr>
                    <tr>
                        <th width="30%">Type of Application</th>
                        <th>
                            @if($applicationDetail['application_type']==1)
                            <i>New Application</i>
                            @elseif($applicationDetail['application_type']==2)
                            PV Model Addition at
                            the existing manufacturing facility>
                            @elseif($applicationDetail['application_type']==3)
                            Application for new
                            manufacturing facility
                            @elseif($applicationDetail['application_type']==4)
                            Renewal
                            @elseif($applicationDetail['application_type']==5)
                            Co-ALMM
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Name of Manufacturer</strong> <br>
                            <small> <i>(Attach a copy of certificate of Incorporation issued by Registrar of
                                    Companies and Mark it as attachment 1)</i> </small>
                        </td>
                        <th>
                            <div class="row">
                                <div class="col-md-6">
                                    {{$applicationDetail['manufacturer_name']}}
                                </div>
                                <!-- <div class="col-md-6">
                                                <div class="col-md-3">
                                                    <label for="">Upload Logo</label>

                                                </div>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="file" id="formFile">
                                                    <input type="file" name="" id="" class="form-control">
                                                </div>
                                            </div> -->


                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Manufacturer Brand Name & Logo</strong> <br>
                            <small> <i>(In case of Co-ALMM, don’t fill this)</i> </small>
                        </td>
                        <th>
                            <div class="row">
                                <div class="col-md-4">
                                    {{$applicationDetail['manufacturer_brand_name']}}

                                </div>
                                <!-- <div class="col-md-6">
                                                <div class="col-md-3">
                                                    <label for="">Upload Logo</label>

                                                </div>
                                                   </div> -->
                                <div class="col-md-8">
                                    <img src="{{url('storage/systems/Logo/'.$applicationDetail['manufacturer_brand_logo'])}}"
                                        width="100">
                                </div>

                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Registered Office Address of the
                                Manufacturer
                            </strong> <br>

                        </td>
                        <th>
                            <label for="">Address:</label>
                            {{$applicationDetail['register_office_address']}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone">Phone:</label>
                                    {{$applicationDetail['register_office_phone']}}
                                </div>

                                <div class="col-md-6">
                                    <label for="email">Email:</label>
                                    {{$applicationDetail['register_office_email']}}
                                </div>
                            </div>

                        </th>
                    </tr>

                    <tr>
                        <td width="30%"> <strong>Communication Address of the
                                Manufacturer</strong> <br>

                        </td>
                        <th>
                            <label for="">Address:</label>
                            {{$applicationDetail['com_address']}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone">Phone:</label>
                                    {{$applicationDetail['com_phone']}}
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email:</label>
                                    {{$applicationDetail['com_email']}}
                                </div>
                            </div>



                        </th>
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Location/Address of Manufacturing Plant including
                                Latitude/Longitude for the current application</strong> <br>
                        </td>
                        <th>
                            {{$applicationDetail['plant_address']}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone">Phone:</label>
                                    {{$applicationDetail['plant_phone']}}
                                </div>
                                <div class="col-md-6"><label for="email">Email:</label>
                                    {{$applicationDetail['plant_email']}}
                                </div>
                                <div class="col-md-6">
                                    <label for="">Latitude:</label>
                                    {{$applicationDetail['plant_latitude']}}
                                </div>
                                <div class="col-md-6">
                                    <label for="Longitude">Longitude:</label>
                                    {{$applicationDetail['plant_longitude']}}
                                </div>
                            </div>

                        </th>
                    </tr>

                    <tr>
                        <td width="30%"> <strong>Details of all Manufacturing Plant
                                under same Brand/Company name
                            </strong> <br>
                            <small> <i>(In case of Co-ALMM, don’t fill this)</i> </small>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">No. of Manufacturing plant in India:</label>
                                    {{$applicationDetail['existing_plant_india']}}
                                </div>
                                <div class="col-md-6">
                                    <label for="">No. of Manufacturing plant out of India:</label>
                                    {{$applicationDetail['existing_plant_outindia']}}
                                </div>
                            </div>
                            <label for="">Provide details as per annexure 6 </label>
                        </td>

                    </tr>
                    <tr>
                        <td width="30%"> <strong>Contact Person
                            </strong> <br>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Name:</label>
                                    {{$applicationDetail['contact_person_name']}}
                                </div>
                                <div class="col-md-6">
                                    <label for="">Designation:</label>
                                    {{$applicationDetail['person_designation']}}
                                </div>

                                <div class="col-md-6">
                                    <label for="">Phone No:</label>
                                    {{$applicationDetail['person_contact_no']}}
                                </div>

                                <div class="col-md-6">
                                    <label for="">E-mail:</label>
                                    {{$applicationDetail['person_email']}}
                                </div>

                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td width="30%"> <strong>Authorized signatory details</strong> <br></td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Name:</label>
                                    {{$applicationDetail['authorize_name']}}
                                </div>

                                <div class="col-md-6">
                                    <label for="">Designation:</label>
                                    {{$applicationDetail['authorize_designation']}}
                                </div>

                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td width="30%"> <strong>No. of Main PV Model Applied</strong> <br>

                            <small> <i>
                                    <label for="phone">Note:</label>
                                    (Attach a copy of certificate of Incorporation issued by Registrar of
                                    Companies and Mark it as attachment 1)</i> </small>
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
                                        @foreach ($applied_pvmodels as $key => $pvmodels)
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
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Total PV Manufacturing Capacity (in MW/year)</strong>
                            <br><br>
                            <i>Formula for calculating PV model Manufacturing Capacity:</i><br>
                            <br>
                            <small> <i>
                                    <u><span
                                            style="margin-top: 0px; position: absolute; margin-left: -9px;font-size: 18px;">(</span>No.
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
                                    {{$applicationDetail['manufacturing_capacity']}}
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Whether Already Enlisted in ALMM</strong> <br></td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    @if($applicationDetail['enlisted_almm']=='1')
                                    <label for="">Yes</label>
                                    @else
                                    <label for="">No</label>
                                    @endif
                                </div>
                                @if($applicationDetail['enlisted_almm']=='1')
                                <div class="col-md-6">
                                    <label for="">No. of Main PV Model Enlisted:</label>
                                    {{$applicationDetail['no_enlisted_pvmodel']}}
                                </div>
                                @endif

                                <div class="col-md-6">
                                    <label for="">Total PV Module Manufacturing Capacity (MW/year):</label>
                                    {{$applicationDetail['total_pv_capacity']}}
                                </div>
                                <div class="col-md-12">
                                    <label for="">ALMM Enlistment Validity: </label>
                                </div>
                                <div class="col-md-6">
                                    <label for="">From:</label>
                                    {{$applicationDetail['validity_from']}}
                                </div>

                                <div class="col-md-6">
                                    <label for="">to:</label>
                                    {{$applicationDetail['validity_to']}}
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Details of Payment of Fee</strong>
                            <br><br><br><br><br>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Application Fees:</label>
                                    {{$applicationDetail['application_fees']}}
                                </div>
                                <div class="col-md-6">
                                    <label for="">Inspection Fees:</label>
                                    {{$applicationDetail['inspection_fees']}}
                                </div>

                                <div class="col-md-6">
                                    <label for="">Total Amount Paid:</label>
                                    {{$applicationDetail['total_amount']}}
                                </div>


                                <div class="col-md-6">
                                    <label for="">Payment Date:</label>
                                    {{$applicationDetail['payment_date']}}
                                </div>
                                <div style="clear:both"></div>
                                <div class="col-md-6">
                                    <label for="">UTR/reference No:</label>
                                    {{$applicationDetail['utn_no']}}
                                </div>
                                <div class="col-md-6">

                                    <label for="">Mode of Payment:</label>
                                    {{$applicationDetail['payment_mode']}}

                                </div>
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td> <strong>Proposed Inspection Date</strong></td>
                        <td class="text-primary">
                            @if($applicationDetail['inspection_date']!=NULL)
                            {{ date('d-M-Y', strtotime($applicationDetail['inspection_date'])) }}
                            @else
                            Not Mentioned
                            @endif
                        </td>
                    </tr>

                </table>

                <!-- Annexure 1 Start-->
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h4>Annexure 1</h4>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                
                                <!--3.1--->
                                <table class="table table-bordered">

                                    <tbody class="annexure1_div">
                                        <tr class="bg-warning">
                                            <th width="6%">3.1</th>
                                            <th colspan="7">Solar PV Model Details

                                            </th>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sr.No</th>
                                            <th>Type Of Modules</th>
                                            <th>Main Model</th>
                                            <th>Pmax (Wp) of Main Model</th>
                                            <th width="15%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th width="15%">Pmax (Wp) of Applicable Models Model</th>
                                            <th width="15%">No of Cells &amp; Cell Type (Full/Half/Third)</th>
                                            <th>System Voltage (VDC)</th>

                                        </tr>

                                        @foreach($annexure1 as $data)
                                        <tr>
                                            <th rowspan="">{{ $loop->iteration }}</th>
                                            <td>{{$data->module_type}}</td>
                                            <td>{{$data->model_code}}</td>
                                            <td>{{$data->pmax_model}}</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach (json_decode($data->pmax_applicable_model) as
                                                    $pmax_applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $pmax_applicable_model }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach (json_decode($data->pmax_applicable_model) as
                                                    $pmax_applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $pmax_applicable_model }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach (json_decode($data->no_of_cells) as
                                                    $no_of_cells)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $no_of_cells }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach (json_decode($data->system_voltage) as
                                                    $system_voltage)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $system_voltage }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>

                                <!--3.2--->

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>3.2</th>
                                            <th scope="col" colspan="12">Electrical Data (STC) of Solar PV Modules</th>
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
                                            <th>Pmax (Wp) of Applicable Models Model</th>
                                            <th>Pmax (Wp)</th>
                                            <th>Vmp (V)</th>
                                            <th>Imp (A)</th>
                                            <th>Voc (V)</th>
                                            <th>Isc (A)</th>
                                            <th>Module Efficiency (%)</th>
                                            <th>Fill Factor</th>
                                        </tr>
                                        @foreach($annexure1_sub2 as $annexure1_sub2_data)
                                        @if($annexure1_sub2_data->electrical_data_type ==1)
                                        <tr class="text-center">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$annexure1_sub2_data->module_type}}</td>
                                            <td>{{$annexure1_sub2_data->model_code}}</td>
                                            <td>{{$annexure1_sub2_data->pmax_model}}</td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub2_data->applicable_mean_wattage)
                                                    as
                                                    $applicable_mean_wattage)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $applicable_mean_wattage }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub2_data->pmax_applicable_model)
                                                    as
                                                    $pmax_applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $pmax_applicable_model }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub2_data->pmax_watt) as
                                                    $pmax_watt)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $pmax_watt }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub2_data->vmp) as
                                                    $vmp)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $vmp }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub2_data->imp) as
                                                    $imp)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $imp }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub2_data->voc) as
                                                    $voc)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $voc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub2_data->isc) as
                                                    $isc)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $isc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub2_data->model_efficiency) as
                                                    $model_efficiency)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $model_efficiency }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub2_data->fill_factor) as
                                                    $fill_factor)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $fill_factor }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>


                                        </tr>
                                        @endif
                                        @endforeach

                                    </tbody>
                                </table>
                                <!--3.2.1--->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>3.2.1</th>
                                            <th scope="col" colspan="13">Electrical Data (NOCT) of Solar PV Modules</th>
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
                                            <th>Pmax (Wp) of Applicable Models Model</th>
                                            <th>Pmax (Wp)</th>
                                            <th>Vmp (V)</th>
                                            <th>Imp (A)</th>
                                            <th>Voc (V)</th>
                                            <th>Isc (A)</th>
                                            <th>Module Efficiency (%)</th>
                                            <th>Fill Factor</th>
                                        </tr>
                                        @php $j=0; @endphp
                                        @foreach($annexure1_sub2 as $data)
                                        @if($data->electrical_data_type ==2)
                                        @php $j++; @endphp
                                        <tr class="text-center">
                                            <td>{{$j}}</td>
                                            <td>{{$data->module_type}}</td>
                                            <td>{{$data->model_code}}</td>
                                            <td>{{$data->pmax_model}}</td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->applicable_mean_wattage) as
                                                    $applicable_mean_wattage)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $applicable_mean_wattage }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->pmax_applicable_model) as
                                                    $pmax_applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $pmax_applicable_model }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->pmax_watt) as
                                                    $pmax_watt)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $pmax_watt }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->vmp) as
                                                    $vmp)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $vmp }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->imp) as
                                                    $imp)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $imp }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->voc) as
                                                    $voc)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $voc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->isc) as
                                                    $isc)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $isc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->model_efficiency) as
                                                    $model_efficiency)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $model_efficiency }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->fill_factor) as
                                                    $fill_factor)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $fill_factor }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                        </tr>
                                        @endif
                                        @endforeach

                                    </tbody>
                                    
                                </table>
                                <!--3.3--->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>3.3</th>
                                            <th scope="col" colspan="16">Module Operational Ratings</th>
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
                                            <th colspan="7" class="text-center">Operational Ratings</th>

                                        </tr>
                                        <tr>

                                            <th>Operational Temperature (ᴼC)</th>
                                            <th>Maximum System Voltage (V)</th>
                                            <th>Maximum Fuse Rating</th>
                                            <th>By-pass Diode Rating</th>
                                            <th>Fire Rating</th>
                                            <th>Warranty Details</th>
                                        </tr>
                                        @foreach($annexure1_sub3 as $annexure1_sub3_data)

                                        <tr class="text-center">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$annexure1_sub3_data->module_type}}</td>
                                            <td>{{$annexure1_sub3_data->model_code}}</td>
                                            <td>{{$annexure1_sub3_data->pmax_model}}</td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub3_data->pmax_applicable_model)
                                                    as
                                                    $pmax_applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $pmax_applicable_model }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub3_data->applicable_mean_wattage)
                                                    as
                                                    $applicable_mean_wattage)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $applicable_mean_wattage }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub3_data->operation_temp) as
                                                    $operation_temp)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $operation_temp }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub3_data->max_voltage) as
                                                    $max_voltage)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $max_voltage }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub3_data->max_fuse_rating) as
                                                    $max_fuse_rating)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $max_fuse_rating }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub3_data->diode_rating) as
                                                    $diode_rating)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $diode_rating }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub3_data->fire_rating) as
                                                    $fire_rating)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $fire_rating }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($annexure1_sub3_data->fire_rating) as
                                                    $fire_rating)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $fire_rating }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>


                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>

                                <!--3.4-->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>3.4</th>
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
                                    @foreach($annexure1_sub4 as $data_4)
                                    @if($data_4->sub_annexure ==4)
                                    @php $b++; @endphp
                                    <tr>
                                        <td>{{$b}}</td>
                                        <td>{{$data_4->module_type}}</td>
                                        <td>{{$data_4->model_code}}</td>
                                        <td>{{$data_4->pmax_model}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_4->applicable_mean_wattage) as
                                                $applicable_mean_wattage)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $applicable_mean_wattage }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_4->pmax_applicable_model) as
                                                $pmax_applicable_model)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $pmax_applicable_model }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>


                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_4->pmax_watt) as
                                                $pmax_watt)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $pmax_watt }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_4->voc) as
                                                $voc)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $voc }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_4->isc) as
                                                $isc)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $isc }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>

                                    </tr>
                                    @endif
                                    @endforeach

                                </tbody>
                            </table>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>3.5</th>
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
                                    @foreach($annexure1_sub5 as $data_5)
                                    @if($data_5->sub_annexure ==5)
                                    @php $c++; @endphp
                                    <tr>
                                        <td>{{$c}}</td>
                                        <td>{{$data_5->module_type}}</td>
                                        <td>{{$data_5->model_code}}</td>
                                        <td>{{$data_5->pmax_model}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_5->applicable_mean_wattage) as
                                                $applicable_mean_wattage)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $applicable_mean_wattage }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_5->pmax_applicable_model) as
                                                $pmax_applicable_model)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $pmax_applicable_model }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>


                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_5->module_length) as
                                                $module_length)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $module_length }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_5->module_breadth) as
                                                $module_breadth)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $module_breadth }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_5->module_area) as
                                                $module_area)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $module_area }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_5->module_weight) as
                                                $module_weight)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $module_weight }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>

                                    </tr>
                                    @endif
                                    @endforeach

                                </tbody>
                            </table>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>3.6</th>
                                        <th scope="col" colspan="13" class="text-left">Solar Cell Specifications</th>
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

                                        <th>Technology type of solar cells</th>
                                        <th>Efficiency of solar cells</th>
                                        <th>Wattage of full solar cells</th>
                                        <th>Full Cell Size (Dimension in mm)</th>
                                        <th>Cell Type used in module (Full/Half/Third)</th>
                                        <th>No of Cells in a Module</th>
                                        <th>Number of bus bars per cell</th>
                                    </tr>
                                    @php $d=0; @endphp
                                    @foreach($annexure1_sub6 as $data_6)
                                    @if($data_6->sub_annexure ==6)
                                    @php $d++; @endphp
                                    <tr>
                                        <td>{{$d}}</td>
                                        <td>{{$data_6->module_type}}</td>
                                        <td>{{$data_6->model_code}}</td>
                                        <td>{{$data_6->pmax_model}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_6->applicable_mean_wattage) as
                                                $applicable_mean_wattage)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $applicable_mean_wattage }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_6->pmax_applicable_model) as
                                                $pmax_applicable_model)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $pmax_applicable_model }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>


                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_6->cell_technology) as
                                                $cell_technology)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_technology }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_6->cell_efficiency) as
                                                $cell_efficiency)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_efficiency }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_6->cell_wattage) as
                                                $cell_wattage)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_wattage }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_6->cell_dimension) as
                                                $cell_dimension)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_dimension }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_6->cell_type) as
                                                $cell_type)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_type }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_6->cell_total_no) as
                                                $cell_total_no)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_total_no }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data_6->cell_total_bus) as
                                                $cell_total_bus)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_total_bus }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>

                                    </tr>
                                    @endif
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
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <!-- Annexure 2 Start-->
                                <table class="table table-bordered text-center">

                                    <thead>
                                        <tr class="bg-warning">
                                            <th>S.No</th>
                                            <th>Type of Modules</th>
                                            <th>Main Model</th>
                                            <th width="8%">Pmax (Wp) of Main Model</th>
                                            <th width="8%">Applicable models covered under ± 5% of Mean Wattage</th>
                                            <th>Bill of Material</th>
                                            <th>Make</th>
                                            <th>Model</th>
                                            <th>Specification</th>
                                            <th>Country of Origin</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($annexure2_aryData as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->module_type}}</td>
                                            <td>{{$data->model_code}}</td>
                                            <td>{{$data->pmax_model}}</td>
                                            <td>{{$data->applicable_mean_wattage}}</td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->bill_material_id) as
                                                    $bill_material_id)
                                                    <tr style="border-bottom:1px solid #ccc">
                                                        <td>{{$bill_material_id}}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->make_details) as
                                                    $make_details)
                                                    <tr style="border-bottom:1px solid #ccc">
                                                        <td>{{$make_details}}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->model_details) as
                                                    $model_details)
                                                    <tr style="border-bottom:1px solid #ccc">
                                                        <td>{{$model_details}}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->specifications) as
                                                    $specifications)
                                                    <tr style="border-bottom:1px solid #ccc">
                                                        <td>{{$specifications}}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->country_origin) as
                                                    $country_origin)
                                                    <tr style="border-bottom:1px solid #ccc">
                                                        <td>{{$country_origin}}</td>
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
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <!-- Annexure 3 Start-->
                                <table class="table table-bordered text-center">

                                    <thead>
                                        <tr>
                                            <th colspan="9" class=" text-left">4.1 BIS Certification Details</th>
                                        </tr>
                                        <tr class="bg-warning">
                                            <th>S.No</th>
                                            <th>Type of Modules</th>
                                            <th>Main Model</th>
                                            <th width="8%">Pmax (Wp) of Main Model</th>
                                            <th width="8%">Applicable models covered under ± 5% of Mean Wattage</th>
                                            <th>BIS Certificate No.</th>
                                            <th>BIS Certificate Issue</th>
                                            <th>BIS Certificate Valid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $j = 1 @endphp
                                        @foreach($annexure3 as $sub_annex_1)
                                        @if($sub_annex_1->sub_annexure ==1)
                                        <tr>
                                            <td>{{$j++}}</td>
                                            <td>{{$sub_annex_1->module_type}}</td>
                                            <td>{{$sub_annex_1->model_code}}</td>
                                            <td>{{$sub_annex_1->pmax_model}}</td>
                                            <td>{{$sub_annex_1->applicable_mean_wattage}}</td>
                                            <td>{{$sub_annex_1->bis_certificate_no}}</td>
                                            <td>{{$sub_annex_1->bis_certificate_issue}}</td>
                                            <td>{{$sub_annex_1->bis_certificate_valid}}</td>

                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>

                                </table>
                                <br>
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th colspan="9" class=" text-left">4.2 Module Test Reports Details</th>
                                        </tr>
                                        <tr class="bg-warning">
                                            <th>S.No</th>
                                            <th>Type of Modules</th>
                                            <th>Main Model</th>
                                            <th width="8%">Pmax (Wp) of Main Model</th>
                                            <th width="8%">Applicable models covered under ± 5% of Mean Wattage</th>
                                            <th>Testing Standards</th>
                                            <th>Test Report No.</th>
                                            <th>Testing Laboratory</th>
                                            <th>Testing Laboratory Address</th>
                                            <th>Valid NABL Certificate No. of Test Laboratory at the time of testing
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1 @endphp
                                        @foreach($annexure3 as $sub_annex_2)

                                        @if($sub_annex_2->sub_annexure ==2)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$sub_annex_2->module_type}}</td>
                                            <td>{{$sub_annex_2->model_code}}</td>
                                            <td>{{$sub_annex_2->pmax_model}}</td>
                                            <td>{{$sub_annex_2->applicable_mean_wattage}}</td>
                                            <td>{{$sub_annex_2->test_standard_module}}</td>
                                            <td>{{$sub_annex_2->test_report_no}}</td>
                                            <td>{{$sub_annex_2->testing_laboratory}}</td>
                                            <td>{{$sub_annex_2->testing_laboratory_address}}</td>
                                            <td>{{$sub_annex_2->valid_nabl_certificate_no}}</td>

                                        </tr>
                                        @endif
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
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <!-- Annexure 4 Start-->

                                <table class="table table-bordered text-center">

                                    <thead>
                                        <tr class="bg-warning">
                                            <th>5.2</th>
                                            <th scope="col" colspan="13" class="text-left">List of Major
                                                Machines/Equipments
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width="5%">Line</th>
                                            <th width="10%">Compatible Technology (Cell Type/Max Cell Size/No. of Bus
                                                Bar)
                                            </th>
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
                                        @foreach($annexure4 as $data)
                                        <tr>
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

                                <hr>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>5.3</th>
                                            <th scope="col" colspan="13" class="text-left">List of Major
                                                Machines/Equipments
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width="6%">Equipment/Module</th>
                                            <th width="5%">S.No</th>
                                            <th width="10%">Make and Model</th>
                                            <th width="10%">Machine Serial No.</th>
                                            <th>Calibration Done by (Lab/Agency/Company Name with Address)</th>
                                            <th width="10%">Last Calibration Date</th>
                                            <th width="10%">Calibration Valid Upto</th>


                                        </tr>
                                        @foreach($annexure4_sub3 as $data)
                                        <tr>
                                            <td>Sun Simulator</td>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->make_and_model}}</td>
                                            <td>{{$data->machine_serial_no}}</td>
                                            <td>{{$data->calibration_done_by}}</td>
                                            <td>{{$data->last_calibration_date}}</td>
                                            <td>{{$data->calibration_valid_upto}}</td>


                                        </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                                <hr>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>5.4</th>
                                            <th scope="col" colspan="13" class="text-left">Calibration Details of
                                                Reference
                                                Modules
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width="10%">Module Type</th>
                                            <th width="5%">S.No</th>
                                            <th width="20%">Module Type and Power Rating</th>
                                            <th width="10%">Machine Serial No.</th>
                                            <th>Calibration Done by (Lab/Agency/Company Name with Address)</th>
                                            <th width="10%">Last Calibration Date</th>
                                            <th width="10%">Calibration Valid Upto</th>


                                        </tr>
                                        @php $i=$j=0; @endphp
                                        @foreach($annexure4_sub4 as $data)
                                        @if($data->module_type==1) @php $i++; @endphp
                                        <tr>
                                            @if($i==1)
                                            <td rowspan="2">@if($data->module_type==1)Golden Module @else Silver
                                                Module
                                                @endif</td>@endif
                                            <td>{{$i}}</td>
                                            <td>
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
                                            </td>
                                            <td>{{$data->machine_serial_no}}</td>
                                            <td>{{$data->calibration_done_by}}</td>
                                            <td>{{$data->last_calibration_date}}</td>
                                            <td>{{$data->calibration_valid_upto}}</td>


                                        </tr>
                                        @endif

                                        @if($data->module_type==2) @php $j++; @endphp
                                        <tr>
                                            @if($j==1)
                                            <td rowspan="2">@if($data->module_type==1)Golden Module @else Silver
                                                Module
                                                @endif</td>@endif
                                            <td>{{$j}}</td>
                                            <td>
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
                                            </td>
                                            <td>{{$data->machine_serial_no}}</td>
                                            <td>{{$data->calibration_done_by}}</td>
                                            <td>{{$data->last_calibration_date}}</td>
                                            <td>{{$data->calibration_valid_upto}}</td>


                                        </tr>
                                        @endif
                                        @endforeach

                                    </tbody>

                                </table>

                                <hr>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>5.5</th>
                                            <th scope="col" colspan="13" class="text-left">ISO Certification Details for
                                                the
                                                Manufacturing Plant
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width="5%">S.No</th>
                                            <th width="20%">ISO Certificate</th>
                                            <th width="30%">Issuing Agency with Address</th>
                                            <th width="10%">Issuing Date</th>
                                            <th width="10%">Certificate Valid Upto</th>



                                        </tr>
                                        @foreach($annexure4_sub5 as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->iso_certificate}}</td>
                                            <td>{{$data->issuing_agency}}</td>
                                            <td>{{$data->issuing_date}}</td>
                                            <td>{{$data->certificate_validate}}</td>


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
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <table class="table table-bordered">
                                    <tr>
                                        <th colspan="4">PV Module Production Data in MW for last 3 financial year

                                        </th>
                                    </tr>
                                    @php
                                    $startYear = date("Y")+1;
                                    $prevYear = date("Y");
                                    $current_financial_year = $prevYear."-".$startYear;

                                    $startYear1 = date("Y");
                                    $prevYear1 = date("Y")-1;
                                    $last_financial_year = $prevYear1."-".$startYear1;

                                    $startYear2 = date("Y")-1;
                                    $prevYear2 = date("Y")-2;
                                    $lasttolast_financial_year = $prevYear2."-".$startYear2;
                                    @endphp
                                    Current Financial Year ({{$prevYear}} - {{$startYear}})
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Current Financial Year {{$current_financial_year}}</th>
                                            <th>Last Financial Year {{$last_financial_year}}</th>
                                            <th>Last to Last Financial Year {{$lasttolast_financial_year}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $months = array(1 => 'April', 2 => 'May', 3 => 'June', 4 => 'July', 5 =>
                                        'August', 6 =>
                                        'September', 7 => 'October', 8 => 'November', 9 => 'December', 10 => 'January',
                                        11 =>
                                        'February', 12 => 'March');
                                        @endphp
                                        @foreach($months as $num => $name)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$name}}</td>
                                            <td>{{\App\Models\Annexure5::getFinancialDataadmin($applicationDetail['id'],$applicationDetail['user_id'],$name,$current_financial_year)}}
                                            </td>
                                            <td>{{\App\Models\Annexure5::getFinancialDataadmin($applicationDetail['id'],$applicationDetail['user_id'],$name,$last_financial_year)}}
                                            </td>
                                            <td>{{\App\Models\Annexure5::getFinancialDataadmin($applicationDetail['id'],$applicationDetail['user_id'],$name,$lasttolast_financial_year)}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <br><br>
                                <h4>PV Module Sales Data for last 3 financial year</h4>
                                <table class="table table-bordered">

                                    @php
                                    $startYear = date("Y")+1;
                                    $prevYear = date("Y");
                                    $current_financial_year = $prevYear."-".$startYear;
                                    @endphp
                                    Current Financial Year ({{$prevYear}} - {{$startYear}})
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Total Module Sales (in MW)</th>
                                            <th>Module Sales Amount (in Rs)</th>
                                            <th>EPC and Other Sales Amount (in Rs)</th>
                                            <th>Total Sales Amount (Rs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($annexure5_appData as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->module_sale}}</td>
                                            <td>{{$data->module_sale_amount}}</td>
                                            <td>{{$data->epc_other_amount}}</td>
                                            <td>{{$data->total_sales}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <br><br>
                                <table class="table table-bordered">
                                    @php
                                    $startYear = date("Y");
                                    $prevYear = date("Y")-1;
                                    $last_financial_year = $prevYear."-".$startYear;
                                    @endphp
                                    Last Financial Year ({{$prevYear}} - {{$startYear}})
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Total Module Sales (in MW)</th>
                                            <th>Module Sales Amount (in Rs)</th>
                                            <th>EPC and Other Sales Amount (in Rs)</th>
                                            <th>Total Sales Amount (Rs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($annexure5_lfyappData as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->module_sale}}</td>
                                            <td>{{$data->module_sale_amount}}</td>
                                            <td>{{$data->epc_other_amount}}</td>
                                            <td>{{$data->total_sales}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <br><br>
                                <table class="table table-bordered">
                                    @php
                                    $startYear = date("Y")-1;
                                    $prevYear = date("Y")-2;
                                    $lasttolast_financial_year = $prevYear."-".$startYear;
                                    @endphp
                                    Last To Last Financial Year ({{$prevYear}} - {{$startYear}})
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Total Module Sales (in MW)</th>
                                            <th>Module Sales Amount (in Rs)</th>
                                            <th>EPC and Other Sales Amount (in Rs)</th>
                                            <th>Total Sales Amount (Rs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($annexure5_ltlfyappData as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->module_sale}}</td>
                                            <td>{{$data->module_sale_amount}}</td>
                                            <td>{{$data->epc_other_amount}}</td>
                                            <td>{{$data->total_sales}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                                <br>
                                <h4>Raw Material Purchase Data for last 3 financial year</h4>

                                <table class="table table-bordered">

                                    @php
                                    $startYear = date("Y")+1;
                                    $prevYear = date("Y");
                                    $current_financial_year = $prevYear."-".$startYear;
                                    @endphp
                                    Current Financial Year ({{$prevYear}} - {{$startYear}})
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Raw Material Purchase for Module Amount (Rs)</th>
                                            <th>Other Raw Material Purchase Amount (Rs)</th>
                                            <th>Total Purchase Amount (Rs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($annexure5_appData as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->raw_purchase_module}}</td>
                                            <td>{{$data->other_raw_purchase}}</td>
                                            <td>{{$data->total_purchase}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br><br>
                                <table class="table table-bordered">

                                    @php
                                    $startYear = date("Y");
                                    $prevYear = date("Y")-1;
                                    $last_financial_year = $prevYear."-".$startYear;
                                    @endphp
                                    Last Financial Year ({{$prevYear}} - {{$startYear}})
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Raw Material Purchase for Module Amount (Rs)</th>
                                            <th>Other Raw Material Purchase Amount (Rs)</th>
                                            <th>Total Purchase Amount (Rs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($annexure5_lfyappData as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->raw_purchase_module}}</td>
                                            <td>{{$data->other_raw_purchase}}</td>
                                            <td>{{$data->total_purchase}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                                <br><br>
                                <table class="table table-bordered">

                                    @php
                                    $startYear = date("Y")-1;
                                    $prevYear = date("Y")-2;
                                    $lasttolast_financial_year = $prevYear."-".$startYear;
                                    @endphp
                                    Last To Last Financial Year ({{$prevYear}} - {{$startYear}})
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>S.No</th>
                                            <th>Month</th>
                                            <th>Raw Material Purchase for Module Amount (Rs)</th>
                                            <th>Other Raw Material Purchase Amount (Rs)</th>
                                            <th>Total Purchase Amount (Rs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($annexure5_ltlfyappData as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->raw_purchase_module}}</td>
                                            <td>{{$data->other_raw_purchase}}</td>
                                            <td>{{$data->total_purchase}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                <h4>Annexure 6</h4>
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <table class="table table-bordered">

                                    <tr>
                                        <th colspan="7">Details of all Manufacturing Plant under same Brand/Company
                                            name
                                        </th>
                                    </tr>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Name of Company</th>
                                        <th>Country</th>
                                        <th>Address</th>
                                        <th>Whether Enlisted in ALMM </th>
                                        <th>No. of PV Models Enlisted in ALMM</th>
                                        <th>Enlisted/Rated PV Modules Manufacturing Capacity</th>
                                    </tr>

                                    <tbody>


                                        @foreach($annexure6 as $annexure6_data)

                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$annexure6_data->name_of_company}}</td>
                                            <td>{{$annexure6_data->country}}</td>
                                            <td>{{$annexure6_data->address}}</td>
                                            <td>{{$annexure6_data->whether_enlisted}}</td>
                                            <td>{{$annexure6_data->noofpv_models}}</td>
                                            <td>{{$annexure6_data->manufacturing_capacity}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                <h4>Annexure 7</h4>
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            @if(isset($applicationDetail) && $applicationDetail['annexure7']!=null)
                                            <a href="{{URL::to($docBaseUrl.$applicationDetail['annexure7'])}}"
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
                                <h4>Annexure 8</h4>
                            </button>
                        </h2>
                        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            @if(isset($applicationDetail) && $applicationDetail['annexure8']!=null)
                                            <a href="{{URL::to($docBaseUrl.$applicationDetail['annexure8'])}}"
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
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="5%">S.No</th>
                                        <th>Attachment Title</th>
                                        <th width="20%">Attachment</th>
                                    </tr>
                                    <tr>
                                        <th> 1</th>
                                        <td>Copy of Certificate of Incorporation of the applying entity issued by
                                            Registrar
                                            of Companies, Ministry of Corporate Affairs, Government of India.</td>

                                        <td>
                                            @if(($applicationDetail['attc_incorporation_cerificate'] ?? '')!=null)
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$applicationDetail['attc_incorporation_cerificate'])}}"
                                                class="document">Attachment No. 1</a>@else No @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 2</th>
                                        <td>Details of Payment of Application and Inspection Fee</td>
                                        <td>
                                            @if(($applicationDetail['attc_application_inspection_payment'] ?? '')!=null)
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$applicationDetail['attc_application_inspection_payment'])}}"
                                                class="document">Attachment No. 1</a>@else No @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 3</th>
                                        <td>Datasheets of the modules applied for enlistment in ALMM</td>
                                        <td>
                                            @if(($applicationDetail['attc_enlisted_module_datalist'] ?? '')!=null)
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$applicationDetail['attc_enlisted_module_datalist'])}}"
                                                class="document">Attachment No. 1</a>@else No @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 4</th>
                                        <td>Datasheets of the solar cells used in the modules</td>
                                        <td>
                                            @if(($applicationDetail['attc_solar_cell_datalist'] ?? '')!=null)
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$applicationDetail['attc_solar_cell_datalist'])}}"
                                                class="document">Attachment No. 1</a>@else No @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 5</th>
                                        <td>Details of Balance of Materials as sought in Application Form</td>
                                        <td>
                                            @if(($applicationDetail['attc_bom_details'] ?? '')!=null)
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$applicationDetail['attc_bom_details'])}}"
                                                class="document">Attachment No. 1</a>@else No @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 6</th>
                                        <td>Copy of Certificate for BIS Registration/ Certification</td>
                                        <td>
                                            @if(($applicationDetail['attc_bis_certificate'] ?? '')!=null)
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$applicationDetail['attc_bis_certificate'])}}"
                                                class="document">Attachment No. 1</a>@else No @endif
                                        </td>

                                    </tr>
                                    <tr>
                                        <th> 7</th>
                                        <td>Copy of the Accreditation Certificate of the Lab which has given test
                                            certificates required for BIS Registration/ Certification</td>
                                        <td>
                                            @if(($applicationDetail['attc_accreditation_certificate'] ?? '')!=null)
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$applicationDetail['attc_accreditation_certificate'])}}"
                                                class="document">Attachment No. 1</a>@else No @endif
                                        </td>

                                    </tr>
                                    <tr>
                                        <th> 8</th>
                                        <td>Calibration Report of Sun Simulator</td>
                                        <td>
                                            @if(($applicationDetail['attc_calibration_report_sun_simulator'] ??
                                            '')!=null)
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$applicationDetail['attc_calibration_report_sun_simulator'])}}"
                                                class="document">Attachment No. 1</a>@else No @endif
                                        </td>

                                    </tr>
                                    <!-- <tr>
                                        <th>9</th>
                                        <td>Calibration Report of Reference Modules</td>
                                        <td>
                                            @if(($applicationDetail['attc_calibration_report_module'] ?? '')!=null)
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$applicationDetail['attc_calibration_report_module'])}}"
                                                class="document">Attachment No. 1</a>@else No @endif
                                        </td>

                                    </tr> -->
                                    <tr>
                                        <th> 9</th>
                                        <td>Copy of valid ISO Certificate for quality management system. Copy of
                                            Accreditation certificate of ISO certifying body</td>
                                        <td>
                                            @if(($applicationDetail['attc_iso_certificate'] ?? '')!=null)
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$applicationDetail['attc_iso_certificate'])}}"
                                                class="document">Attachment No. 1</a>@else No @endif
                                        </td>

                                    </tr>
                                    <tr>
                                        <th> 10</th>
                                        <td>Balance Sheet for last three years or the period of existence of such units,
                                            whichever is less</td>
                                        <td>
                                            @if(($applicationDetail['attc_balance_sheet_last_years'] ?? '')!=null)
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$applicationDetail['attc_balance_sheet_last_years'])}}"
                                                class="document">Attachment No. 1</a>@else No @endif
                                        </td>

                                    </tr>
                                    <tr>
                                        <th> 11</th>
                                        <td>Trademark Registration Certificate</td>
                                        <td><a href="">@if(($applicationDetail['attc_trademark_certificate'] ?? '')!=null)
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$applicationDetail['attc_trademark_certificate'])}}"
                                                        class="document">Attachment No. 11</a></small>@endif</a></td>
                                    </tr>
                                    <tr>
                                        <th> 12</th>
                                        <td>Construction Data Form(CDF) from BIS lab Report</td>
                                        
                                        <td><a href="">@if(($applicationDetail['attc_bis_lab_report'] ?? '')!=null)
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$applicationDetail['attc_bis_lab_report'])}}"
                                                        class="document">Attachment No. 12</a></small>@endif</a></td>
                                    </tr>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <blockquote>
                    @if($applicationDetail['forward_status']=='mnre')
                    <tr>
                        <td colspan="1"></td>
                        <td colspan="5" align="center">
                            <button type="button" class="btn btn-primary btn-sm btn-block" data-bs-toggle="modal"
                                data-bs-target="#myModal">Forward to NISE <i class="fa fa-sign-out"
                                    aria-hidden="true"></i></button>
                        </td>
                        <td colspan="1"></td>
                    </tr>
                    @endif
                </blockquote>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Forward</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form action="{{ url('mnre/forwardto') }}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{$applicationDetail['id']}}">
                    <div class="form-group">
                        <label for="forward_status" class="col-form-label">Forward Status:</label>
                        <select name="forward_status" id="forward_status">
                            <option value="nise">NISE</option>
                            <option value="reject">REJECT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea name="description" class="form-control" id="message-text" required></textarea>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Forward</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
