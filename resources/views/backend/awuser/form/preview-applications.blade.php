@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@php $docBaseUrl ='users/preview-docs/Annexure/';
$attchmentBaseUrl ='users/preview-docs/Attachment/';
$bomBaseUrl ='users/preview-docs/BOM/';
$logoBaseUrl ='users/preview-docs/Logo/';
@endphp

    <table class="table table-bordered" border="1">
        <tr>
            <th colspan="2">
            <img src="{{ URL::asset('images/logo_black.png') }}"  style="height: 50px; margin-bottom: 15px;">
            </th>
        </tr>
        <tr>
            <th colspan="2">Details of Solar Photovoltaic (PV) Module Manufacturer : {{$annexureData['applicationDetail']['application_no']}}
            </th>
        </tr>
        <tr>
            <th width="20%" class="table-primary">Type of Application</th>
            <td>{{$general->getApplicationType($annexureData['applicationDetail']['application_type'])}}
            </td>
        </tr>
        <tr>
            <td width="30%" class="table-primary"> <strong>Name of Manufacturer</strong>
            </td>
            <td>
                <div class="row">
                    <div class="col-md-6">
                        {{$annexureData['applicationDetail']['manufacturer_name']}}<br>


                    </div>
                    <div class="col-md-2">Certificate of incorporation :
                    </div>
                    <div class="col-md-4">
                        @if($annexureData['applicationDetail']['attc_incorporation_cerificate']!='')
                        <a target="_blank"
                            href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['attc_incorporation_cerificate'])}}"
                            class="document text-primary">View Certificate of incorporation</a>
                        @endif

                    </div>

                </div>


            </td>
        </tr>
        <tr>
            <td width="30%" class="table-primary"> <strong>Manufacturer Brand Name & Logo</strong>
            </td>
            <th>
                <div class="row">
                    <div class="col-md-6">
                        {{$annexureData['applicationDetail']['manufacturer_brand_name']}} <br>


                    </div>
                    <div class="col-md-2">Logo :
                    </div>
                    <div class="col-md-4">
                        <a href="{{URL::to($logoBaseUrl.$annexureData['applicationDetail']['manufacturer_brand_logo'])}}"
                            target="_blank" class=" text-danger">
                            <i class="bi bi-image text-danger"></i> View Logo</a>



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
                    <div class="col-md-12">
                        <label for="">{{$annexureData['applicationDetail']['is_sez']}}</label>
                        @if($annexureData['applicationDetail']['is_sez']=='No')
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                GST Number : {{$annexureData['applicationDetail']['gst_number'] ?? '--'}}


                            </div>
                            <div class="col-md-2">GST Document :
                            </div>
                            <div class="col-md-4">
                                <a target="_blank"
                                    href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['gst_document'])}}"
                                    class="document text-primary">View GST Document</a>

                            </div>

                        </div>

                        @endif
                    </div>

            </td>

        </tr>
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
                    <div class="col-md-6">
                        <label for="">Name:</label>
                        {{$annexureData['applicationDetail']['authorize_name']}}
                    </div>

                    <div class="col-md-6">
                        <label for="">Designation:</label>
                        {{$annexureData['applicationDetail']['authorize_designation']}}
                    </div>
                    <div class="col-md-6">
                        <label for="">Signatory Document:</label>
                        @if(($annexureData['applicationDetail']['signatory_document'] ?? '')!=null)
                        <a target="_blank"
                            href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['signatory_document'])}}"
                            class="document text-primary">View</a>@else No @endif
                    </div>

                </div>
            </td>

        </tr>
        <!-- <tr>
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
            <td width="30%" class="table-primary"> <strong>Applied Manufacturing Capacity (in
                    MW/year)</strong>
                <!-- <br><br>
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

                    </i> </small> -->
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

    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th class="bg-primary text-light p-2" colspan="6">Module's</th>
            </tr>
            <tr class="table-primary">
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

    <table class="table table-bordered table-responsive">
        <thead>
            <tr class="bg-primary text-light p-2">
                <th colspan="8">Details of Solar PV Modules</th>
            </tr>
            <tr class="table-primary">
                <th>3.1 </th>
                <th scope="col" colspan="7" class="text-left">Solar PV Model Details</th>
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
            <tr class="">
                <th rowspan="">{{ $loop->iteration }}</th>
                <td>{{$data->module_name}}</td>
                <td>{{$data->main_model}}</td>
                <td class="text-center">{{$data->pmax_model}} Wp</td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model_covered as
                        $applicable_model_covered)
                        <tr>
                            <td>
                                {{ $applicable_model_covered }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model as $applicable_model)
                        <tr>
                            <td>
                                {{ $applicable_model }} Wp</td>
                        </tr>
                        @endforeach
                    </table>
                </td>



                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $ann_data)
                        <tr>
                            <td>
                                {{ $ann_data->no_of_cells }}</td>
                        </tr>
                        @endforeach

                    </table>
                </td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $ann_data2)
                        <tr>
                            <td>
                                {{ $ann_data2->system_voltage }}</td>
                        </tr>
                        @endforeach

                    </table>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th>3.2</th>
                <th scope="col" colspan="11" class="text-left">Module Electric Data at STC
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th rowspan="2">Sr.No</th>
                <th rowspan="2">Type Of Modules</th>
                <th rowspan="2">Main Model</th>

                <th rowspan="2" width="10%">Pmax (Wp) of Main Model</th>
                <th colspan="8" class="text-center">Electrical Data at STC</th>

            </tr>
            <tr>
                <th width="10%">Applicable models covered under +- 5% of
                    Mean Wattege</th>
                <th width="10%">Pmax (Wp) of Applicable Models Model</th>
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
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model_covered as
                        $applicable_model_covered)
                        <tr>
                            <td>
                                {{ $applicable_model_covered }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model as
                        $applicable_model)
                        <tr>
                            <td>
                                {{ $applicable_model }} Wp</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
               
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $vmp)
                        <tr>
                            <td>
                                {{ $vmp->vmp }}</td>
                        </tr>
                        @endforeach

                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $imp)
                        <tr>
                            <td>
                                {{ $imp->imp }}</td>
                        </tr>
                        @endforeach

                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $voc)
                        <tr>
                            <td>
                                {{ $voc->voc }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $isc)
                        <tr>
                            <td>
                                {{ $isc->isc }}</td>
                        </tr>
                        @endforeach

                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $model_efficiency)
                        <tr>
                            <td>
                                {{ $model_efficiency->model_efficiency }}</td>
                        </tr>
                        @endforeach

                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $fill_factor)
                        <tr>
                            <td>
                                {{ $fill_factor->fill_factor }}</td>
                        </tr>
                        @endforeach

                    </table>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <th scope="col" colspan="14" class="text-left">
                Module Data Sheet :
                @if($annexureData['applicationDetail']['module_data_sheet']!='')
                <a target="_blank"
                    href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['module_data_sheet'])}}"
                    class="document text-primary">View Module Data Sheet</a>
                @endif
            </th>
        </tfoot>
    </table>
<br><br><br><br><br>
    <table class="table table-bordered hide hidden">
        <thead>
            <tr class="table-primary">
                <th>3.3</th>
                <th scope="col" colspan="12" class="text-left">Module Electric Data at NOCT
                </th>
            </tr>
            <tr>
                <th rowspan="2">Sr.No</th>
                <th rowspan="2">Type Of Modules</th>
                <th rowspan="2">Main Model</th>

                <th rowspan="2" width="10%">Pmax (Wp) of Main Model</th>
                <th colspan="9" class="text-center">Electrical Data at NOCT</th>

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
        </thead>
        <tbody>
            
            @php $j=0; @endphp
            @foreach($annexureData['appDataNOCT'] as $data)
            @php $j++; @endphp
            <tr class="text-center">
                <td>{{$j}}</td>
                <td>{{$data->module_name}}</td>
                <td>{{$data->main_model}}</td>
                <td class="text-center">{{$data->pmax_model}} Wp</td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model_covered as
                        $applicable_model_covered)
                        <tr>
                            <td>
                                {{ $applicable_model_covered }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model as
                        $applicable_model)
                        <tr>
                            <td>
                                {{ $applicable_model }} Wp</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $pmax_watt)
                        <tr>
                            <td>
                                {{ $pmax_watt->pmax_watt }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>

                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $vmp)
                        <tr>
                            <td>
                                {{ $vmp->vmp }}</td>
                        </tr>
                        @endforeach

                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $imp)
                        <tr>
                            <td>
                                {{ $imp->imp }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $voc)
                        <tr>
                            <td>
                                {{ $voc->voc }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $isc)
                        <tr>
                            <td>
                                {{ $isc->isc }}</td>
                        </tr>
                        @endforeach

                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $model_efficiency)
                        <tr>
                            <td>
                                {{ $model_efficiency->model_efficiency }}</td>
                        </tr>
                        @endforeach

                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $fill_factor)
                        <tr>
                            <td>
                                {{ $fill_factor->fill_factor }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
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
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model_covered as
                        $applicable_model_covered)
                        <tr>
                            <td>
                                {{ $applicable_model_covered }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model as
                        $applicable_model)
                        <tr>
                            <td>
                                {{ $applicable_model }} Wp</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <!-- <td>
                    <table width="100%">
                        @foreach($data->annexure as $operation_temp)
                        <tr>
                            <td style="">
                                {{ $operation_temp->operation_temp }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td> -->
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $max_voltage)
                        <tr>
                            <td style="">
                                {{ $max_voltage->max_voltage }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>

                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $max_fuse_rating)
                        <tr>
                            <td style="">
                                {{ $max_fuse_rating->max_fuse_rating }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $diode_rating)
                        <tr>
                            <td style="">
                                {{ $diode_rating->diode_rating }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $fire_rating)
                        <tr>
                            <td style="">
                                {{ $fire_rating->fire_rating }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $warrenty_details)
                        <tr>
                            <td style="">
                                {{ $warrenty_details->warrenty_details }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>


            </tr>
            @endforeach

        </tbody>
    </table>
    <br> <br> <br> <br> <br> <br>
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th>3.5</th>
                <th scope="col" colspan="13" class="text-left">Module Temperature
                    Characteristics</th>
            </tr>
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
                <th>Temperature Coefficient of Isc</th>
            </tr>
        </thead>
        <tbody>
           
            @php $b=0; @endphp
            @foreach($annexureData['Annexure1Sub4'] as $data)
            @php $b++; @endphp
            <tr>
                <td>{{$b}}</td>
                <td>{{$data->module_name}}</td>
                <td>{{$data->main_model}}</td>
                <td class="text-center">{{$data->pmax_model}} Wp</td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model_covered as
                        $applicable_model_covered)
                        <tr>
                            <td>
                                {{ $applicable_model_covered }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model as $applicable_model)
                        <tr>
                            <td>
                                {{ $applicable_model }} Wp</td>
                        </tr>
                        @endforeach
                    </table>
                </td>

                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $pmax_watt)
                        <tr>
                            <td >
                                {{ $pmax_watt->pmax_watt }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $voc)
                        <tr>
                            <td style="">
                                {{ $voc->voc }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $isc)
                        <tr>
                            <td style="">
                                {{ $isc->isc }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table><br>
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
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
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model_covered as
                        $applicable_model_covered)
                        <tr>
                            <td>
                                {{ $applicable_model_covered }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model as $applicable_model)
                        <tr>
                            <td>
                                {{ $applicable_model }} Wp</td>
                        </tr>
                        @endforeach
                    </table>
                </td>


                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $module_length)
                        <tr>
                            <td style="">
                                {{ $module_length->module_length }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $module_breadth)
                        <tr>
                            <td style="">
                                {{ $module_breadth->module_breadth }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $module_area)
                        <tr>
                            <td style="">
                                {{ $module_area->module_area }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $module_weight)
                        <tr>
                            <td style="">
                                {{ $module_weight->module_weight }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table><br><br><br><br><br><br><br><br><br><br><br><br>
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th>3.7</th>
                <th scope="col" colspan="13" class="text-left">Solar Cell Specifications
                </th>
            </tr>
            <tr>
                <th rowspan="2">S.No</th>
                <th rowspan="2">Type Of Modules</th>
                <th rowspan="2">Main Model</th>
                <th rowspan="2">Pmax (Wp) of Main Model</th>
                <th rowspan="2" width="15%">Applicable models covered under +- 5% of
                    Mean Wattege</th>
                <th rowspan="2" width="15%">Pmax (Wp) of Applicable Models Model</th>
                <th colspan="7" class="text-center">Module Dimensions</th>

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
        </thead>
        <tbody>
            
            @php $d=0; @endphp
            @foreach($annexureData['Annexure1Sub6'] as $data)
            @php $d++; @endphp
            <tr>
                <td>{{$d}}</td>
                <td>{{$data->module_name}}</td>
                <td>{{$data->main_model}}</td>
                <td class="text-center">{{$data->pmax_model}} Wp</td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model_covered as
                        $applicable_model_covered)
                        <tr>
                            <td>
                                {{ $applicable_model_covered }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model as $applicable_model)
                        <tr>
                            <td>
                                {{ $applicable_model }} Wp</td>
                        </tr>
                        @endforeach
                    </table>
                </td>


                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $cell_technology)
                        <tr>
                            <td style="">
                                {{ $cell_technology->cell_technology }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $cell_efficiency)
                        <tr>
                            <td style="">
                                {{ $cell_efficiency->cell_efficiency }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $cell_wattage)
                        <tr>
                            <td style="">
                                {{ $cell_wattage->cell_wattage }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $cell_dimension)
                        <tr>
                            <td style="">
                                {{ $cell_dimension->cell_dimension }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $cell_type)
                        <tr>
                            <td style="">
                                {{ $cell_type->cell_type }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $cell_total_no)
                        <tr>
                            <td style="">
                                {{ $cell_total_no->cell_total_no }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($data->annexure as $cell_total_bus)
                        <tr>
                            <td style="">
                                {{ $cell_total_bus->cell_total_bus }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>

            </tr>
            @endforeach

        </tbody>
        <tfoot>
            <th scope="col" colspan="14" class="text-left">
                Cell Data Sheet :
                @if($annexureData['applicationDetail']['cell_data_sheet']!='')
                <a target="_blank"
                    href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['cell_data_sheet'])}}"
                    class="document text-primary">View Cell Data Sheet</a>
                @endif
            </th>
        </tfoot>
    </table>
    <table class="table table-bordered">
        <thead>
            <tr class="bg-primary text-light p-2">
                <th colspan="6">Bill of Material Details</th>
                
            </tr>
            <tr class="table-primary">
                <th>S.No</th>
                <th>Type of Modules</th>
                <th>Main Model</th>
                <th width="10%">Pmax (Wp) of Main Model</th>
                <th width="10%">Applicable models covered under ± 5% of Mean Wattage</th>
                <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                <!-- <th width="10%">BOM File</th> -->

            </tr>
        </thead>
        <tbody>
            @php $j=0; $bomFile=''; @endphp
            @foreach($annexureData['annexure2'] as $data)
            @php $j++; $bomFile=$data->bom_attachment; @endphp
            <tr>
                <td>{{$j}}</td>
                <td>{{$data->module_name}}</td>
                <td>{{$data->main_model}}</td>
                <td class="text-center">{{$data->pmax_model}} Wp</td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model_covered as
                        $applicable_model_covered)
                        <tr>
                            <td>
                                {{ $applicable_model_covered }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->applicable_model as $applicable_model)
                        <tr>
                            <td>
                                {{ $applicable_model }} Wp</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td style="display:none">
                    <table width="100%" class="table-noborder">
                        @foreach ($data->annexure as $bom_attachment)
                        @php $bomFile=$bom_attachment->bom_attachment; @endphp
                        <tr>
                            <td>
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
        <tfoot>
            <td scope="col" colspan="7" class="text-left">
                BOM File :
                @if($bomFile!='')
                <a target="_blank" href="{{URL::to($bomBaseUrl.$bomFile)}}"
                    class="document text-primary">View BOM File</a>
                @endif
            </td>
        </tfoot>

    </table>

    <table class="table table-bordered">
        <thead>
            <tr class="bg-primary text-light p-2">
                <th colspan="12" class=" text-left">BIS Certification and Module Test Reports Details</th>
            </tr>
            <tr>
                <th colspan="12" class=" text-left">4.1 BIS Certification Details</th>
            </tr>
            <tr class="table-primary">
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
                    <table width="100%" class="table-noborder">
                        @foreach ($sub_annex_1->applicable_model_covered as
                        $applicable_model_covered)
                        <tr>
                            <td>
                                {{ $applicable_model_covered }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($sub_annex_1->applicable_model as $applicable_model)
                        <tr>
                            <td>
                                {{ $applicable_model }} Wp</td>
                        </tr>
                        @endforeach
                    </table>
                </td>

                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($sub_annex_1->annexure as $bis_certificate_issue)
                        <tr>
                            <td style="">
                                {{ $bis_certificate_issue->bis_certificate_issue }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($sub_annex_1->annexure as $bis_certificate_valid)
                        <tr>
                            <td style="">
                                {{ $bis_certificate_valid->bis_certificate_valid }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($sub_annex_1->annexure as $bis_certificate_no)
                        <tr>
                            <td style="">
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
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="9" class=" text-left">4.2 Module Test Reports Details</th>
            </tr>
            <tr class="table-primary">
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
                    <table width="100%" class="table-noborder">
                        @foreach ($sub_annex_2->applicable_model_covered as
                        $applicable_model_covered)
                        <tr>
                            <td>
                                {{ $applicable_model_covered }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td class="text-center">
                    <table width="100%" class="table-noborder">
                        @foreach ($sub_annex_2->applicable_model as $applicable_model)
                        <tr>
                            <td>
                                {{ $applicable_model }} Wp</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($sub_annex_2->annexure as $test_standard_module)
                        <tr>
                            <td style="">
                                {{ $test_standard_module->test_standard_module }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($sub_annex_2->annexure as $test_report_no)
                        <tr>
                            <td style="">
                                {{ $test_report_no->test_report_no }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($sub_annex_2->annexure as $testing_laboratory)
                        <tr>
                            <td style="">
                                {{ $testing_laboratory->testing_laboratory }}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($sub_annex_2->annexure as $testing_laboratory_address)
                        <tr>
                            <td style="">
                                {{ $testing_laboratory_address->testing_laboratory_address }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>
                    <table width="100%" class="table-noborder">
                        @foreach($sub_annex_2->annexure as $valid_nabl_certificate_no)
                        <tr>
                            <td style="">
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
    <table class="table table-bordered">
        <thead>
            <tr class="bg-primary text-light p-2">
                <th colspan="7">Manufacturing facility Details</th>
            </tr>
            <tr class="table-primary">
                <th colspan="7">Manufacturing Plant under same Brand/Company</th>
            </tr>
            <tr>
                <th>S.No</th>
                <th width="20%">Name of Company</th>
                <th>Country</th>
                <th width="25%">Address</th>
                <th>Whether Enlisted in ALMM </th>
                <th>No. of PV Models Enlisted in ALMM</th>
                <th>Enlisted/Rated PV Modules Manufacturing Capacity (in mm)</th>

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
        <tr class="table-primary">
            <th colspan="3"class=" text-left">5.1 Manufacturing facility Details</th>
        </tr>
        <tr>
            <th  style="width:5% !important" >S.No</th>
            <th  style="width:65% !important" >Particulars</th>
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
            <th>Total PV model Manufacturing Capacity (in mm) </th>
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
            <th>Details of Power Backup Available with capacity (in mm)</th>
            <td>{{$annexureData['annexure4']->power_backup_details}}</td>
        </tr>

    </table>
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
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
                    Bar)
                </th>
                <th>Commissioning Date</th>
                <th width="10%">Rated Manufacturing Capacity (in mm) (24*7 *365 days working)</th>
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
                <td width="10%" rowspan="{{ count(json_decode($data->major_equipments))+1}}">

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
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
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
            <tr class="table-primary">
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
            <tr class="table-primary">
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

   
    <table class="table table-bordered">
        <tr>
            <th class="bg-primary text-light p-2">
            Module Production, Sale and Purchase Data
            </th>
        </tr>
        <tr>
            <th>Balance Sheet :

                @if($annexureData['applicationDetail']['attc_balance_sheet_last_years']!='')
                <a target="_blank"
                    href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['attc_balance_sheet_last_years'])}}"
                    class="document text-primary">View Balance Sheet</a>
                @endif
            </th>
        </tr>
    </table>
    @if(!empty($annexureData['annexure5']))
 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="5" class="bg-success text-light p-2 heading_bold">
                PV Module Production Data in MW for last 3
        financial year
                </th>
            </tr>
            <tr class="table-primary">
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
                    
                </td>
                <td><span class="productiondspan{{$data['id']}}"
                        id="productiondspan{{$annexureData['annexure5']['datatype3']['last'][$loop->iteration]['id']}}">{{$annexureData['annexure5']['datatype3']['last'][$loop->iteration]['module_production_data']}}</span>
                    
                </td>
                <td><span class="productiondspan{{$data['id']}}"
                        id="productiondspan{{$annexureData['annexure5']['datatype3']['lastTolast'][$loop->iteration]['id']}}">{{$annexureData['annexure5']['datatype3']['lastTolast'][$loop->iteration]['module_production_data']}}</span>
                    
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    @endif
    @if(!empty($annexureData['annexure5']['datatype2']))
    <table class="table table-bordered">
        <!-- Code : 2 -->
        <thead>
            <tr>
                <th colspan="6" class="bg-success text-light p-2 heading_bold"> Raw Material Purchase Data for last 3 financial year
                </th>
            </tr>
            <tr>
                <th colspan="6" class="bg-green">
                    <h4>Financial Year {{$annexureData['financialYear']['current']?? ''}}
                    </h4>
                </th>
            </tr>
            <tr class="table-primary">
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
            <tr class="table-primary">
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
            <tr class="table-primary">
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
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="7"  class="bg-success text-light p-2 heading_bold">
                PV Module Sales Data for last 3 financial year
                </th>
            </tr>
            <tr>
                <th colspan="7" class="bg-green">
                    <h4>Financial Year {{$annexureData['financialYear']['current'] ?? ''}}
                    </h4>
                </th>
            </tr>
            <tr class="table-primary">
                <th>S.No</th>
                <th>Month</th>
                <th>Module Export Sales (in MW)</th>
                <th>Module Domestic Sales (in MW)</th>
                <th>Module Sales Amount (in Rs)</th>
                <th>EPC and Other Sales Amount (in Rs)</th>
                <th>Total Sales Amount (Rs)</th>

            </tr>
        </thead>
        <tbody>
            @php
            $countModuleSale1=0;
            $total_module_sale=$total_module_sale_domestic=$total_module_sale_amount=$epc_other_amount=0;
            @endphp
            @foreach($annexureData['annexure5']['datatype1'] as $data)
            @if(($annexureData['financialYear']['current'] ?? '')==$data->financial_year)
            @php $countModuleSale1+=1;
            $total_module_sale+=$data->module_sale;
            $total_module_sale_amount+=$data->module_sale_amount;
            $epc_other_amount+=$data->epc_other_amount;
            $total_module_sale_domestic+=$data->module_sale_domestic;
            @endphp
            <tr>
                <td>{{$countModuleSale1}}</td>
                <td>{{$data->month}}</td>
                <td>{{$data->module_sale}}</td>
                <td>{{$data->module_sale_domestic}}</td>
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
                <th>{{$total_module_sale_domestic}}</th>
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
            <tr class="table-primary">
                <th>S.No</th>
                <th>Month</th>
                <th>Module Export Sales (in MW)</th>
                <th>Module Domestic Sales (in MW)</th>
                <th>Module Sales Amount (in Rs)</th>
                <th>EPC and Other Sales Amount (in Rs)</th>
                <th>Total Sales Amount (Rs)</th>

            </tr>
        </thead>
        <tbody>
            @php
            $countModuleSale2=0;$total_module_sale2=$total_module_sale_domestic2=$total_module_sale_amount2=$epc_other_amount2=0;
            @endphp
            @foreach($annexureData['annexure5']['datatype1'] as $data)
            @if(($annexureData['financialYear']['last'] ?? '')==$data->financial_year)
            @php $countModuleSale2+=1;
            $total_module_sale2+=$data->module_sale;
            $total_module_sale_amount2+=$data->module_sale_amount;
            $epc_other_amount2+=$data->epc_other_amount;
            $total_module_sale_domestic2+=$data->module_sale_domestic;
            @endphp
            <tr>
                <td>{{$countModuleSale2}}</td>
                <td>{{$data->month}}</td>
                <td>{{$data->module_sale}}</td>
                <td>{{$data->module_sale_domestic}}</td>
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
                <th>{{$total_module_sale_domestic2}}</th>
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
            <tr class="table-primary">
                <th>S.No</th>
                <th>Month</th>
                <th>Module Export Sales (in MW)</th>
                <th>Module Domestic Sales (in MW)</th>
                <th>Module Sales Amount (in Rs)</th>
                <th>EPC and Other Sales Amount (in Rs)</th>
                <th>Total Sales Amount (Rs)</th>

            </tr>
        </thead>
        <tbody>
            @php
            $countModuleSale3=0;$total_module_sale3=$total_module_sale_domestic3=$total_module_sale_amount3=$epc_other_amount3=0;
            @endphp
            @foreach($annexureData['annexure5']['datatype1'] as $data)
            @if(($annexureData['financialYear']['lastTolast'] ?? '')==$data->financial_year)
            @php $countModuleSale3+=1;
            $total_module_sale3+=$data->module_sale;
            $total_module_sale_amount3+=$data->module_sale_amount;
            $epc_other_amount3+=$data->epc_other_amount;
            $total_module_sale_domestic3+=$data->module_sale_domestic;
            @endphp
            <tr>
                <td>{{$countModuleSale3}}</td>
                <td>{{$data->month}}</td>
                <td>{{$data->module_sale}}</td>
                <td>{{$data->module_sale_domestic}}</td>
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
                <th>{{$total_module_sale_domestic3}}</th>
                <th>{{$total_module_sale_amount3}}</th>
                <th>{{$epc_other_amount3}}</th>
                <th>{{$total_module_sale_amount2+$epc_other_amount3}}</th>

            </tr>
        </tbody>
    </table>
    @endif

    <table class="table table-bordered">
        <tr>
            <th   class="bg-primary text-light p-2">
            Company Affidavit
            </th>
        </tr>
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
    <table class="table table-bordered">
        <tr>
            <th class="bg-primary text-light p-2">
            Deed Of Indemnity
            </th>
        </tr>
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
    <table class="table table-bordered">
        <tr class="bg-primary text-light p-2">
            <th colspan="2">
            Payment Details
            </th>
        </tr>
        <tr class="table-primary">
            <th width="25%">Payment Mode:</th>
            <td>{{$annexureData['paymentdetails']->payment_mode}}</td>
        </tr>
        <tr>
            <th>Transaction Number: </th>
            <td>{{$annexureData['paymentdetails']->transaction_number}}</td>
        </tr>
        <tr>
            <th>Transaction Date:</th>
            <td>{{$annexureData['paymentdetails']->transaction_date}}</td>
        </tr>
        <tr>
            <th>Name of Bank:</th>
            <td>{{$annexureData['paymentdetails']->bank_name}}</td>
        </tr>
        <tr>
            <th>Amount Paid:</th>
            <td>INR {{$annexureData['paymentdetails']->application_amount_paid}}</td>
        </tr>
        <tr>
            <th>Chalan/Receipt:</th>
            <td><a target="_blank"
                    href="{{URL::to($attchmentBaseUrl.$annexureData['paymentdetails']->transaction_receipt)}}"
                    class="document text-primary">View Receipt</a></td>
        </tr>
    </table>
    

                <!-- second table -->
      