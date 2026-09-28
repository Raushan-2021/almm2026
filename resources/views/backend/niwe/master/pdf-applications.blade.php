@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@php $docBaseUrl ='nise/preview-docs/Annexure/';
$attchmentBaseUrl ='nise/preview-docs/Attachment/';
$bomBaseUrl ='nise/preview-docs/BOM/';
$logoBaseUrl ='nise/preview-docs/Logo/';
@endphp

<style>
.heading {
    text-align: left;
    font-size: 13px;
    background-color: lightblue;
}

table,
th,
td {
    border: 1px solid #ccc;
    text-align: left;
    border-collapse: collapse;
    padding: 4px;
    width: 100%;
    font-size: 11px;
}

table table td{
    border: 0px !important;
}
th {
    font-weight: bold;
}

.bg-success {
    background-color: #198754 !important;
}

.bg-primary {
    background-color: #015296 !important;
}

.text-light {
    color: #f8f9fa !important;
}

.bg-info {
    background-color: #0dcaf0 !important;
}

.bg-warning {
    background-color: #ffc107 !important;
}
.table-noborder{
    border: 0px !important;
}
.p-2{
    padding:5px !important;
}
</style>
<table class="table table-bordered">
                    <tr>
                        <th colspan="2">Details of Solar Photovoltaic (PV) Module Manufacturer and Model
                        </th>
                    </tr>
                    <tr>
                        <th width="30%" class="table-primary">Type of Application</th>
                        <td>{{$general->getApplicationType($annexureData['applicationDetail']['application_type'])}}
                        </td>
                    </tr>
                    <tr>
                        <td width="30%" class="table-primary"> <strong>1.1 Name of Company</strong>
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
                    <!-- <tr>
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
                    </tr> -->
                    <tr>
                        <td width="30%" class="table-primary"> <strong>1.2 Registered Office Address of the Company
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
                        <td width="30%" class="table-primary"> <strong>1.3 Communication Address of the Company </strong> <br>

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
                        <td width="30%" class="table-primary"> <strong>1.4 Address of Manufacturing Plant Company </strong> <br>
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
                                <div class="col-md-6">
                                    <label for="gps_latitude">GPS Coordinates North:</label>
                                    {{$annexureData['applicationDetail']['gps_latitude']}}
                                </div>
                                <div class="col-md-6">
                                    <label for="gps_longitude">GPS Coordinates East:</label>
                                    {{$annexureData['applicationDetail']['gps_longitude']}}
                                </div>
                                <div class="col-md-6">
                                    Country: <span
                                        class="text-primary">{{$annexureData['applicationDetail']['country']}}</span>
                                </div>
                            </div>
                        </th>
                    </tr>

                    <!-- <tr>
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
                    </tr> -->

                    <tr>
                        <td width="30%" class="table-primary"> <strong>1.5 Address to be mentioned in list, if enlisted </strong> <br>
                        </td>
                        <th>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone">if enlisted : </label>
                                    {{$annexureData['applicationDetail']['address_type']}}
                                </div>
                            </div>
                        </th>
                    </tr>
                    
                    <tr>
                        <td width="30%" class="table-primary"> <strong>1.6 Whether applying for more than one Models of PV Modules</strong> <br>
                        </td>
                        <th>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone">Whether applying for more than one Models of PV Modules : </label>
                                    {{$annexureData['applicationDetail']['is_applied']}}
                                </div>
                            </div>
                        </th>
                    </tr>
                   
                    <tr>
                        <td width="30%" class="table-primary"> <strong>2.0 Authorized signatory details</strong> <br></td>
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
                                    @if($annexureData['applicationDetail']['signatory_document']!='')
                                    <a target="_blank"
                                        href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['signatory_document'])}}"
                                        class="document text-primary">View</a>@else No @endif
                                </div>
                               
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td width="30%" class="table-primary"> <strong>
                            </strong> <br>
                        </td>
                        <td>
                            <div class="row">
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
                    <!-- <tr>
                        <td width="30%" class="table-primary"> <strong>Applied Manufacturing Capacity (in
                                MW/year)</strong> -->
                            <!-- <br><br>
                            <i>Formula for calculating PV model Manufacturing Capacity:</i><br>
                            <br>
                            <small> 
                                <i>
                                    <u><span style="margin-top: 0px; position: absolute; margin-left: -9px;font-size: 18px;">(</span>No.
                                        of Cells Processed in an Hour</u><br>
                                    <span style="margin-left: 15px;">No.of cells in highest Wp PV
                                        model</span> <br>
                                    x Wattage of Highest Wp PV Model x
                                    24 x 350 x 0.9)
                                </i> </small> -->
                        <!-- </td>
                        <th>

                            <div class="row">
                                <div class="col-md-12">
                                    {{$annexureData['applicationDetail']['manufacturing_capacity']}} MW
                                </div>
                            </div>
                        </th>
                    </tr> -->
                </table>

                <!-- Module's Start-->
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingModule">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOneModule" aria-expanded="true"
                                aria-controls="collapseOneModule">
                                <h4>Module's</h4>
                            </button>
                        </h2>
                        <div id="collapseOneModule" class="accordion-collapse collapse show"
                            aria-labelledby="headingModule" data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-dark">
                                            <th width="5%">S.No</th>
                                            <th width="10%">Module Technology</th>
                                            <th width="10%">Mean Wattage and application Range of Wattage for the Module Model</th>
                                            <!-- <th width="10%">Pmax (Wp) of Main Model</th>
                                            <th width="10%">Applicable models covered under +- 5%, Pmax of Main Model
                                            </th>
                                            <th width="10%">Pmax (Wp) of Applicable Models Model</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($annexureData['moduleData'] as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                            <!-- <td>{{$data->pmax_model}} Wp</td>
                                            <td>-->
                                                
                                            <!-- </td>
                                            <td> -->
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
    
                            </div>
                        </div>
                    </div>
                    <!-- Module's end-->

                <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h4>Details of Solar PV Modules</h4>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                <!-- 3.1 Solar PV Module Model Applied for -->
                                <table class="table table-bordered text-center table-responsive">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.1 </th>
                                            <th scope="col" colspan="8" class="text-left">Solar PV Module Model Applied for</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <th scope="row">Sr.No</th>
                                            <th>Type Of Modules</th>
                                            <th>Mean Wattage and application Range of Wattage for the Model Module</th>
                                            <th>No of Cells</th>
                                            <th width="15%">Full Cells /Half Cells </th>
                                            <!-- <th width="15%">Pmax (Wp) of Applicable Models Model</th>
                                            <th width="15%">No of Cells & Cell Type (Full/Half/Third)</th>
                                            <th>System Voltage (VDC)</th> -->
                                        </tr>
                                        @foreach($annexureData['annexure1'] as $data)
                                        <tr>
                                            <th rowspan="">{{ $loop->iteration }}</th>
                                            <td>{{$data->module_name}}</td>
                                          
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach($data->annexure as $no_of_cells)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $no_of_cells->no_of_cells }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                               
                                            <!-- <td class="text-center">
                                                <table width="100%">
                                                  
                                                </table>
                                            </td> -->
                                            <!-- <td class="text-center">
                                                <table width="100%">
                                                   
                                                </table>
                                            </td> -->

                                            <!-- <td class="text-center">
                                                <table width="100%">
                                                    @foreach($data->annexure as $ann_data)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $ann_data->no_of_cells }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td> -->
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach($data->annexure as $cell_type)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $cell_type->cell_type }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table><br>

                                <!-- 3.2	Type Of Modules -->
                                <table class="table table-bordered text-center table-responsive">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.2 </th>
                                            <th scope="col" colspan="8" class="text-left">Type Of Modules</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <th scope="row">Sr.No</th>
                                            <th>Modules</th>
                                        </tr>
                                        @foreach($annexureData['annexure1'] as $data)
                                        <tr>
                                            <th rowspan="">{{ $loop->iteration }}</th>
                                            <td>{{$data->module_name}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table><br>

                                <!-- 3.3	Warranty Details -->
                                <table class="table table-bordered text-center table-responsive">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.3 </th>
                                            <th scope="col" colspan="8" class="text-left">Warranty Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <!-- <th scope="row">Sr.No</th> -->
                                            <!-- <th>Warranty Details</th> -->
                                        </tr>
                                        <tfoot>
                                        <th scope="col" colspan="14" class="text-left">
                                        Warranty Details :
                                            @if($annexureData['applicationDetail']['module_one_data_sheet']!='')
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['module_one_data_sheet'])}}"
                                                class="document text-primary">View Warranty Details</a>
                                            @endif
                                        </th>
                                       </tfoot>
                                    </tbody>
                                </table><br>

                                <!-- 3.4	Electrical Data at STC -->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.4</th>
                                            <th scope="col" colspan="13" class="text-left">Electrical Data at STC
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Sr.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                            <th colspan="10" class="text-center">Electrical Data at STC</th>
                                        </tr>
                                        <tr>
                                            <th width="10%">Pmax (Wp)</th>
                                            <th>Power output Tolerance-Pmax(W)</th>
                                            <th>Vmp (V)</th>
                                            <th>Imp (A)</th>
                                            <th>Voc (V)</th>
                                            <th>Isc (A)</th>
                                            <th>Module Efficiency (%)</th>
                                            <!-- <th width="15%">Fill Factor</th> -->
                                        </tr>
                                        @php $i=0; @endphp
                                        @foreach($annexureData['appDataSTC'] as $data)

                                        @php $i++; @endphp
                                        <tr class="text-center">
                                            <td>{{$i}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                            <td class="text-center">
                                               <table width="100%">
                                               @foreach($data->annexure as $pmax)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $pmax->pmax }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>  
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach($data->annexure as $power_output)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $power_output->power_output }}</td>
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
                                            <!-- <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $fill_factor)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $fill_factor->fill_factor }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td> -->
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
                                </table><br>

                                <!-- 3.5	Electric Data at NOCT -->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.5</th>
                                            <th scope="col" colspan="13" class="text-left">Electric Data at NOCT
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Sr.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                            <th rowspan="2" width="10%">Pmax (Wp) </th>
                                            <th colspan="10" class="text-center">Electrical Data at NOCT</th>
                                        </tr>
                                        <tr>
                                            <th width="10%">Power output Tolerance-Pmax (W)</th>
                                            <th>Vmp (V)</th>
                                            <th>Imp (A)</th>
                                            <th>Voc (V)</th>
                                            <th>Isc (A)</th>
                                            <th>Module Efficiency (%)</th>
                                            <!-- <th width="15%">Fill Factor</th> -->
                                        </tr>
                                        @php $j=0; @endphp
                                        @foreach($annexureData['appDataNOCT'] as $data)
                                        @php $j++; @endphp
                                        <tr class="text-center">
                                            <td>{{$j}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                   @foreach($data->annexure as $pmax)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $pmax->pmax }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            <td class="text-center">
                                                <table width="100%">
                                                 @foreach($data->annexure as $power_output)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $power_output->power_output }}</td>
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
                                            <!-- <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $fill_factor)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $fill_factor->fill_factor }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td> -->
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table><br>

                                <!-- 3.6	Temperature Characteristics -->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.6</th>
                                            <th scope="col" colspan="13" class="text-left">Module Temperature
                                                Characteristics</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                            <th colspan="3" class="text-center">Module Temperature Characteristics</th>
                                        </tr>
                                        <tr>
                                            <th>Temperature Co-efficient of Pmax</th>
                                            <th>Temperature Coefficient of Voc</th>
                                            <th>Temperature Coefficient of Isc</th>
                                        </tr>
                                        @php $b=0; @endphp
                                        @foreach($annexureData['Annexure1Sub4'] as $data)
                                        @php $b++; @endphp
                                        <tr>
                                            <td>{{$b}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
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
                                
                                <!-- 3.7	Module Operational Ratings -->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.7</th>
                                            <th scope="col" colspan="14" class="text-left">Module Operational Ratings
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                            <th colspan="5" class="text-center">Module Operational Ratings</th>
                                        </tr>
                                        <tr>
                                            <!-- <th>Operational Temperature (ᴼC)</th> -->
                                            <th>Operational Temperature (ᴼC)</th>
                                            <th>Maximum System Voltage (V)</th>
                                            <th>Maximum Fuse Rating (A)</th>
                                            <th>By-pass Diode Rating</th>
                                            <th>Fire Rating</th>
                                        </tr>
                                        @php $a=0; @endphp
                                        @foreach($annexureData['Annexure1Sub3'] as $data)
                                        @php $a++; @endphp
                                        <tr class="text-center">
                                            <td>{{$a}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                   @foreach($data->annexure as $operation_temp)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $operation_temp->operation_temp }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
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
                                        
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <br>
                                
                                <!-- 3.8	Mechanical Data -->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.8</th>
                                            <th scope="col" colspan="13" class="text-left">Mechanical Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                            <th colspan="4" class="text-center">Module Dimensions</th>
                                        </tr>
                                        <tr>
                                            <th>Module Dimensions (in mm)</th>
                                            <th>Area of Module (LxB) (in m2)</th>
                                            <th>Length of Module (in mm)</th>
                                            <th>width of Module (in mm)</th>
                                            <th>Weight (in kg)</th>
                                        </tr>
                                        @php $c=0; @endphp
                                        @foreach($annexureData['Annexure1Sub5'] as $data)
                                        @php $c++; @endphp
                                        <tr>
                                            <td>{{$c}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                            
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $module_dimensions)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $module_dimensions->module_dimensions }}</td>
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

                                <!-- 3.9	Solar Cell Specifications -->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.9</th>
                                            <th scope="col" colspan="13" class="text-left">Solar Cell Specifications
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                            <th colspan="4" class="text-center">Solar Cell Specifications</th>
                                        </tr>
                                        <tr>
                                            <th>No of solar Cells</th>
                                            <th>Efficiency of solar cells</th>
                                            <th>Wattage of solar cells</th>
                                            <th>Dimension (in mm) and area of (in mm²)<br> individual solar cell</th>
                                            <th>Number of bus bars per cell</th>
                                        </tr>
                                        @php $d=0; @endphp
                                        @foreach($annexureData['Annexure1Sub6'] as $data)
                                        @php $d++; @endphp
                                        <tr>
                                            <td>{{$d}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
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

                                 <!-- 3.1 - 3.10	Solar Cell Specifications -->
                                 <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>3.10</th>
                                            <th scope="col" colspan="13" class="text-left">Balance of Materials (BoM)
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                            <th colspan="4" class="text-center">Balance of Materials Specifications</th>
                                        </tr>
                                        <tr>
                                            <th>Sub Supplier</th>
                                            <th>Front Cover	</th>
                                            <th>Back Cover </th>
                                            <th>Frame</th>
                                            <th>Adhesive</th>
                                            <th>Encapsulate</th>
                                            <th>Junction Box</th>
                                            <th>Connector</th>
                                            <th>Cable</th>
                                            <th>By pass Diode</th>
                                        </tr>
                                       
                                        @php $d=0; @endphp
                                        @foreach($annexureData['Annexure1Sub7'] as $data)
                                        @php $d++; @endphp
                                        <tr>
                                            <td>{{$d}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $sub_supplier)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $sub_supplier->sub_supplier }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $front_cover)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $front_cover->front_cover }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $back_cover)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $back_cover->back_cover }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $frame)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $frame->frame }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $adhesive)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $adhesive->adhesive }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $encapsulate)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $encapsulate->encapsulate }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $junction_box)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $junction_box->junction_box }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $connector)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $connector->connector}}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $cable)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $cable->cable}}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $bypass_diode)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $bypass_diode->bypass_diode}}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            
                                        </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <th scope="col" colspan="14" class="text-left">
                                        View BoM Data sheet :
                                            @if($annexureData['applicationDetail']['bom_data_sheet']!='')
                                            <a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['bom_data_sheet'])}}"
                                                class="document text-primary">View
                                                BoM Data sheet</a>
                                            @endif
                                        </th>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>


                      <!-- BIS Registration -->
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h4>BIS Registration</h4>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <!-- 4.0 BIS Registration / Certification Details -->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>4.0</th>
                                            <th scope="col" colspan="13" class="text-left">BIS Registration / Certification Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">4.1 Module Technology</th>
                                            <th rowspan="2">4.2 Mean Wattage and application Range of Wattage</th>
                                
                                        </tr>
                                        <tr>
                                            <th>4.3 BIS Registration / Certificate No.</th>
                                            <th>4.4 BIS Certificate Issue	</th>
                                            <th>4.5 BIS Certificate Valid </th>
                                        </tr>
                                       
                                        @php $d=0; @endphp
                                        @foreach($annexureData['bis'] as $data)
                                        @php $d++; @endphp
                                        <tr>
                                            <td>{{$d}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $bis_certificate_no)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $bis_certificate_no->bis_certificate_no }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $bis_certificate_issue)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $bis_certificate_issue->bis_certificate_issue }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $bis_certificate_valid)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $bis_certificate_valid->bis_certificate_valid }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    <th scope="col" colspan="14" class="text-left">
                                        Certificate :
                                        @php $bis_certificate = '';
                                        @endphp
                                        @foreach($data->annexure as $doc_certificate)
                                            @php  $bis_certificate = $doc_certificate->doc_certificate; 
                                            @endphp
                                        @endforeach
                                        @if($bis_certificate != '')
                                            <small>
                                                <a target="_blank" href="{{ URL::to($docBaseUrl . $bis_certificate) }}"
                                                class="document text-primary">
                                                    <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                </a>
                                            </small>
                                        @endif
                                    </th>
                                    </tfoot>
                                </table><br>

                                 <!-- 4.6 BIS Organisation Details -->
                                 <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>4.6</th>
                                            <th scope="col" colspan="13" class="text-left">	BIS Organisation Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Module Technology</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                        </tr>
                                       
                                        @php $d=0; @endphp
                                        @foreach($annexureData['nabl'] as $data)
                                        @php $d++; @endphp
                                        <tr>
                                            <td>{{$d}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $orgn_contact_name)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $orgn_contact_name->orgn_contact_name }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $orgn_contact_address)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $orgn_contact_address->orgn_contact_address }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $orgn_contact_phone)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $orgn_contact_phone->orgn_contact_phone }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $orgn_contact_email)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $orgn_contact_email->orgn_contact_email }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            
                                        
                                        </tr>
                                        @endforeach

                                    </tbody>
                                
                                </table><br>

                                <!-- 4.7 BIS Lab Contact Details -->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>4.7</th>
                                            <th scope="col" colspan="13" class="text-left">	Lab Contact Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Module Technology</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                        </tr>
                                       
                                        @php $d=0; @endphp
                                        @foreach($annexureData['lab'] as $data)
                                        @php $d++; @endphp
                                        <tr>
                                            <td>{{$d}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $lab_contact_name)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $lab_contact_name->lab_contact_name }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $lab_contact_address)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $lab_contact_address->lab_contact_address }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $lab_contact_phone)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $lab_contact_phone->lab_contact_phone }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $lab_contact_email)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $lab_contact_email->lab_contact_email }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                 <!-- 4.8 BIS Accreditation Body Details -->
                                 <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>4.8</th>
                                            <th scope="col" colspan="13" class="text-left">	 Accreditation Body Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Module Technology</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                        </tr>
                                       
                                        @php $d=0; @endphp
                                        @foreach($annexureData['accred'] as $data)
                                        @php $d++; @endphp
                                        <tr>
                                            <td>{{$d}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $accred_contact_name)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $accred_contact_name->accred_contact_name }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $accred_contact_address)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $accred_contact_address->accred_contact_address }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $accred_contact_phone)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $accred_contact_phone->accred_contact_phone }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $accred_contact_email)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $accred_contact_email->accred_contact_email }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- 4.9 BIS Accreditation -->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>4.9</th>
                                            <th scope="col" colspan="13" class="text-left">	 Accreditation
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Module Technology</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                
                                        </tr>
                                        <tr>
                                            <th>Accreditation Valid upto</th>
                                            <th>Attach Accreditation Certificate</th>
                                           
                                        </tr>
                                       
                                        @php $d=0; @endphp
                                        @foreach($annexureData['accred_attach'] as $data)
                                        @php $d++; @endphp
                                        <tr>
                                            <td>{{$d}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $accred_valid_upto)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $accred_valid_upto->accred_valid_upto }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                            <table width="100%">
                                                @php $accred_certificate=''; @endphp
                                                @foreach($data->annexure as $doc_accred_certificate)

                                                @php $accred_certificate=$doc_accred_certificate->doc_accred_certificate; @endphp
                                                @endforeach
                                            </table>
                                            @if($accred_certificate!='')
                                            <small><a target="_blank" href="{{URL::to($docBaseUrl.$accred_certificate)}}"
                                                    class="document text-primary"><i
                                                        class="bi bi-file-pdf fa-2x text-danger"></i></a></small>@endif
                                           </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Annexure 2 End-->
                            </div>
                        </div>
                    </div>

                     <!-- 5.0 Collaboration / Design Ownership Details -->
                     <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <h4>Collaboration / Design Ownership Details</h4>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <!-- Annexure 5.1 Start-->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th colspan="9" class=" text-left">5.1 Collaboration / Design Ownership Details</th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Type of Modules</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $j = 1 @endphp
                                        @foreach($annexureData['bis'] as $sub_annex_1)
                                        <tr>
                                            <td>{{$j++}}</td>
                                            <td>{{$sub_annex_1->module_name}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>

                                <!-- Annexure 5.2 End-->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th colspan="9" class=" text-left">5.2 Whether Collaboration available for this Solar Photovoltaic(PV) Model Model</th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Type of Modules</th>
                                            <th>Whether Collaboration available for this Solar Photovoltaic(PV) Model Model</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $f = 1; @endphp
                                        @foreach($annexureData['estd'] as $data)
                                        <tr>
                                            <td>{{$f++}}</td>
                                            <td>{{$data->module_name}} </td>
                                            <td>
                                                <table width="100%">
                                                  @foreach($data->annexure as $whether_enlisted)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $whether_enlisted->whether_enlisted }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Annexure 5.3 End-->
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th colspan="9" class=" text-left">5.3 Collaborator Details</th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Type of Modules</th>
                                            <th>Name</th>
                                            <th>Country</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @php $g = 1; @endphp
                                        @foreach($annexureData['name_cmpny'] as $data)
                                        <tr>
                                            <td>{{$g++}}</td>
                                            <td>{{$data->module_name}} </td>
                                            <td><table width="100%">
                                                    @foreach($data->annexure as $name_of_company)
                                                    <?php //echo "<pre/>";print_r($data->annexure);?>
                                                    <tr>
                                                        <td>
                                                            {{ $name_of_company->name_of_company }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $coll_address)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $coll_address->coll_address }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $collab_phone)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $collab_phone->collab_phone }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $collab_email)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $collab_email->collab_email }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                  <!-- Annexure 5.4 End-->
                                  <table class="table  text-center">
                                    <thead>
                                        <tr>
                                            <th colspan="9" class=" text-left">5.4 Indian Territory Jurisdiction of Collaboration and period of Collaboration</th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Type of Modules</th>
                                            <th>Indian Territory Jurisdiction of Collaboration and period of Collaboration</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @php $f = 1; @endphp
                                        @foreach($annexureData['ind_terr'] as $data)
                                        <tr>
                                            <td>{{$f++}}</td>
                                            <td>{{$data->module_name}} </td>
                                            <td>
                                                <table width="100%">
                                                  @foreach($data->annexure as $ind_territory)
                                                    <tr>
                                                        <td>
                                                            {{ $ind_territory->ind_territory }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                 
                                </table>

                                  <!-- Annexure 5.5 End-->
                                  <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th colspan="9" class=" text-left">5.5 Owner of design rights of the Solar Photovoltaic(PV) Module Model available with the Indian Company</th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th>S.No</th>
                                            <th>Type of Modules</th>
                                            <th>Owner of design rights of the Solar Photovoltaic(PV) Module Model available with the Indian Company</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @php $f = 1; @endphp
                                        @foreach($annexureData['ownership'] as $data)
                                        <tr>
                                            <td>{{$f++}}</td>
                                            <td>{{$data->module_name}} </td>
                                            <td>
                                                <table width="100%">
                                                  @foreach($data->annexure as $ownership_right)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $ownership_right->ownership_right }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                     <!-- Type Registration BIS -->
                     <div class="accordion-item">
                        <h2 class="accordion-header" id="headingNine">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                <h4>BIS Type Registration</h4>
                            </button>
                        </h2>
                        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <!-- 6.0 BIS Registration / Certification Details -->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>6.0</th>
                                            <th scope="col" colspan="13" class="text-left">BIS Registration / Certification Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">6.1 Module Technology</th>
                                            <th rowspan="2">6.2 Mean Wattage and application Range of Wattage</th>
                                
                                        </tr>
                                        <tr>
                                            <th>6.3 BIS Type Certificate No.</th>
                                            <th>6.4 BIS Certificate Issue	</th>
                                            <th>6.5 BIS Certificate Valid </th>
                                        </tr>
                            
                                        @php $h = 0; @endphp
                                        @foreach($annexureData['type_cert'] as $data)
                                        @php $d++; @endphp
                                        <tr>
                                            <td>{{$h++}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $cert_attach_no)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $cert_attach_no->cert_attach_no }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $type_certificate_issue)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $type_certificate_issue->type_certificate_issue }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $type_certificate_valid)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $type_certificate_valid->type_certificate_valid }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        
                                        </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                    <th scope="col" colspan="14" class="text-left">
                                        Certificate :
                                            @php $new_certificate = ''; @endphp
                                                @foreach($data->annexure as $doc_certificate)
                                                    @php $new_certificate = $doc_certificate->new_certificate; @endphp
                                                @endforeach
                                            @if($new_certificate != '')
                                            <small>
                                                <a target="_blank" href="{{ URL::to($docBaseUrl . $new_certificate) }}"
                                                class="document text-primary">
                                                    <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                </a>
                                            </small>
                                            
                                        @endif
                                    </th>
                                    </tfoot>
                                </table><br>

                                 <!-- 6.6 BIS Organisation Details -->
                                 <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>6.6</th>
                                            <th scope="col" colspan="13" class="text-left">	Type Certification Scheme & Documents
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Module Technology</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                        </tr>
                                        <tr>
                                            <th>6.6 Type Certification Scheme</th>
                                            <th>6.7 Type Certification </th>
                                            <th>6.8 Upload Documents</th>
                                        </tr>
                                        @php $j=0; @endphp
                                        @foreach($annexureData['iecselect'] as $data)
                                        @php $j++; @endphp
                                        <tr>
                                            <td>{{$j}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $type_certificate_scheme)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $type_certificate_scheme->type_certificate_scheme }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $type_certificate_pro)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $type_certificate_pro->type_certificate_pro }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @php $compliance_attach = ''; @endphp
                                                    @foreach($data->annexure as $compliance_certificate)
                                                        @php $compliance_attach = $compliance_certificate->compliance_attach; @endphp
                                                    @endforeach
                                                </table>
                                                @if($compliance_attach != '')
                                                <small><a target="_blank" href="{{URL::to($docBaseUrl.$compliance_attach)}}" class="document text-primary"><i class="bi bi-file-pdf fa-2x text-danger"></i></a></small>@endif
                                            </td>
                                           
                                        </tr>
                                        @endforeach

                                    </tbody>
                                
                                </table><br>

                                <!-- 6.9 Name of Cartification Body -->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>6.9</th>
                                            <th scope="col" colspan="13" class="text-left">	6.9 Name of Cartification Body
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Module Technology</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                
                                        </tr>
                                        <tr>
                                            <th>Name of Cartification Body</th>
                                            <!-- <th>Name of Cartification Body</th> -->
                                        </tr>
                                       
                                        @php $d=0; @endphp
                                        @foreach($annexureData['certificate_body'] as $data)
                                        @php $d++; @endphp
                                        <tr>
                                            <td>{{$d}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $nise_certificate_body)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $nise_certificate_body->nise_certificate_body }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <!-- <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $tuv_certificate_body)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $tuv_certificate_body->tuv_certificate_body }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td> -->
                                     
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                 <!-- 6.10 Certifying Body Details -->
                                 <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>6.10</th>
                                            <th scope="col" colspan="13" class="text-left">	Certifying Body Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Module Technology</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                        </tr>
                                       
                                        @php $h=0; @endphp
                                        @foreach($annexureData['certifying'] as $data)
                                        @php $h++; @endphp
                                        <tr>
                                            <td>{{$h}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $certify_body_name)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $certify_body_name->certify_body_name }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $certify_body_address)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $certify_body_address->certify_body_address }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $certify_body_phone)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $certify_body_phone->certify_body_phone }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $certify_body_email)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $certify_body_email->certify_body_email }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- 6.11 Accreditation Body Details -->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>6.11</th>
                                            <th scope="col" colspan="13" class="text-left">	Accreditation Body Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Module Technology</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                        </tr>
                                       
                                        @php $l=0; @endphp
                                        @foreach($annexureData['accred_body'] as $data)
                                        @php $l++; @endphp
                                        <tr>
                                            <td>{{$l}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $accred_body_name)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $accred_body_name->accred_body_name }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $accred_body_address)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $accred_body_address->accred_body_address }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $accred_body_phone)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $accred_body_phone->accred_body_phone }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $accred_body_email)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $accred_body_email->accred_body_email }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                 <!-- 6.12 Accreditation Details -->
                                 <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>6.12</th>
                                            <th scope="col" colspan="13" class="text-left">	Accreditation
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">S.No</th>
                                            <th rowspan="2">Module Technology</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage</th>
                                
                                        </tr>
                                        <tr>
                                            <th>Accreditation Valid upto </th>
                                            <th>Attach Accreditation Certificate</th>
                                            <!-- <th>Attachment No.</th> -->
                                        </tr>
                                       
                                        @php $m=0; @endphp
                                        @foreach($annexureData['accred_attach_item'] as $data)
                                        @php $m++; @endphp
                                        <tr>
                                            <td>{{$m}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->applicable_model_covered}}</td>
                                           
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $accred_body_valid_upto)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $accred_body_valid_upto->accred_body_valid_upto }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                    <table width="100%">
                                                        @php $accred_body_attach = ''; @endphp
                                                        @foreach($data->annexure as $doc_accred_body_attach)
                                                            @php $accred_body_attach = $doc_accred_body_attach->accred_body_attach; @endphp
                                                        @endforeach
                                                    </table>
                                                    @if($accred_body_attach != '')
                                                        <small>
                                                            <a target="_blank" href="{{ URL::to($docBaseUrl . $accred_body_attach) }}" class="document text-primary">
                                                                <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                            </a>
                                                        </small>
                                                        @else
                                                        <small>No certificate available.</small>
                                                    @endif
                                            </td>
                                            <!-- <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $accred_body_cert_no)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $accred_body_cert_no->accred_body_cert_no }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td> -->
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>


                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <h4> Manufacturing Facility Details</h4>
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <!-- Manufacturing Facility Details-->

                                <!-- 7.0	Manufacturing Facility Details -->
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>7.0</th>
                                            <th scope="col" colspan="13" class="text-left">	Manufacturing Facility Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">7.0 S.No</th>
                                            <th rowspan="2">7.1 Module Technology</th>
                                            <th rowspan="2">7.2 Manufacturing Facility(Cell, Module)</th>
                                
                                        </tr>
                                        <tr>
                                            <th>7.3 Location Details </th>
                                            
                                        </tr>
                                       
                                        @php $o=0; @endphp
                                        @foreach($annexureData['manufacture_facility_details'] as $data)
                                        @php $o++; @endphp
                                        <tr>
                                            <td>{{$o}}</td>
                                            <td>{{$data->module_name}}</td>
                                
                                            <td>
											  <table width="100%">
                                                @php $calibration_certificate = ''; @endphp
                                                    @foreach($data->annexure as $doc_calibration_certificate)
                                                        @php $calibration_certificate = $doc_calibration_certificate->calibration_certificate; @endphp
                                                    @endforeach
                                                </table>

                                                @if($calibration_certificate != '')
                                                    <small>
                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $calibration_certificate) }}" class="document text-primary">
                                                            <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                        </a>
                                                    </small>
                                                @endif
												    
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $location_assembly)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $location_assembly->location_assembly }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- 7.4 - 7.7	ISO Certification Details -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>7.4 - 7.7</th>
                                            <th scope="col" colspan="13" class="text-left">ISO Certification Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <th>S.No</th>
                                            <th>7.4 ISO Certificate Assembly</th>
                                            <th>7.5 Name of the ISO Certificate Body</th>
                                            <!-- <th>7.6 ISO Certificate as per standard</th> -->
                                            <th>7.7 ISO Certificate Valid Upto</th>
                                            <th>7.7 ISO Certificate Document</th>

                                        </tr>
                                        @php $p=0; @endphp
                                        @foreach($annexureData['iso_certificate_list'] as $data)
                                        @php $p++; @endphp
                                        <tr>
                                            <td>{{$p}}</td>
                                            <!-- <td>{{$data->module_name}}</td> -->
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $iso_certificate)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $iso_certificate->iso_certificate }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $issuing_agency)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $issuing_agency->issuing_agency }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <!-- <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $issuing_date)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $issuing_date->issuing_date }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td> -->
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $certificate_validate)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $certificate_validate->certificate_validate }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                 <table width="100%" >
                                                    @php $iso_certificate_doc = ''; @endphp

                                                    @foreach($data->annexure as $iso_certificate_doc)
                                                        @php $iso_certificate_doc = $iso_certificate_doc->iso_certificate_doc; @endphp
                                                    @endforeach
                                                    </table>
                                                    @if($iso_certificate_doc != '')
                                                        <small><a target="_blank"
                                                                href="{{URL::to($docBaseUrl . $iso_certificate_doc)}}"
                                                                class="document">View
                                                                Certificate</a></small>
                                                        @endif
                                            </td>
                                           
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>          
                                <!-- 7.8	ISO Certification Contact Details -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>7.8</th>
                                            <th scope="col" colspan="13" class="text-left">ISO Certification Contact Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <th width="5%">S.No</th>
                                            <th width="20%">ISO Certificate Name</th>
                                            <th width="30%">ISO Certificate Address</th>
                                            <th width="10%">ISO Certificate Phone </th>
                                            <th width="10%">ISO Certificate Email</th>
                                          
                                        </tr>
                                        @foreach($annexureData['iso_certificate_contact'] as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $iso_name_body)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $iso_name_body->iso_name_body }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $iso_address_body)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $iso_address_body->iso_address_body }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $iso_phone_body)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $iso_phone_body->iso_phone_body }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $iso_email_body)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $iso_email_body->iso_email_body }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <!-- 7.9	ISO Certification Contact Details -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>7.9</th>
                                            <th scope="col" colspan="13" class="text-left">ISO Certification Contact Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <th width="5%">S.No</th>
                                            <th width="20%">Accreditation Valid upto</th>
                                            <!-- <th width="30%">Accreditation Attachment Number</th> -->
                                            <th width="10%">Accreditation Certificate </th>
                                          
                                        </tr>
                                        @php $r=0; @endphp
                                        @foreach($annexureData['accreditation_cert'] as $data)
                                        @php $r++; @endphp
                                       
                                        <tr>
                                            <td>{{$r}}</td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $accred_date)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $accred_date->accred_date }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <!-- <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $accred_no)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $accred_no->accred_no }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td> -->
                                            <td>
                                                <table width="100%" >
                                                    @php $accred_cert_doc = ''; @endphp
                                                    @foreach($data->annexure as $accred_cert_doc)
                                                        @php $accred_cert_doc = $accred_cert_doc->accred_cert_doc; @endphp
                                                   
                                                    @endforeach
                                                </table>
                                                    @if($accred_cert_doc != '')
                                                        <small><a target="_blank"
                                                            href="{{URL::to($docBaseUrl . $accred_cert_doc)}}"
                                                            class="document">View
                                                            Certificate</a></small>
                                                    @endif
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- 7.10 - 7.11 Manufacturing Capacity of PV Modeles -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>7.10 - 7.11</th>
                                            <th scope="col" colspan="13" class="text-left"> Manufacturing Capacity of PV Modeles
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <th width="5%">S.No</th>
                                            <th width="20%">7.10 Installed Manufacturing Capacity of PV Modeles (mw)</th>
                                            <th width="30%">7.11 Manufacturing Capacity of PV Modeles Attachment last three years</th>
                                    
                                        </tr>
                                        @php $s=0; @endphp
                                        @foreach($annexureData['mf_pv_capacity'] as $data)
                                        @php $s++; @endphp
                                       
                                        <tr>
                                            <td>{{$s}}</td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $mfp_capacity)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $mfp_capacity->mfp_capacity }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%" >
                                                    @php $mfp_attach_doc = ''; @endphp
                                                    @foreach($data->annexure as $mfp_attach_doc)
                                                        @php $mfp_attach_doc = $mfp_attach_doc->mfp_attach_doc; @endphp
                                                    @endforeach
                                                </table>
                                                    @if($mfp_attach_doc != '')
                                                        <small><a target="_blank"
                                                                href="{{URL::to($docBaseUrl . $mfp_attach_doc)}}"
                                                                class="document">View
                                                                Certificate</a></small>
                                                        @endif
                                                </td>
                                           
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                  <!-- 7.12 - 7.13	Purchase of Raw Materials & Details of sales in last three years -->
                                  <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>7.12 - 7.13</th>
                                            <th scope="col" colspan="13" class="text-left">	Purchase of Raw Materials & Details of sales in last three years
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <th width="5%">S.No</th>
                                            <th width="20%">Purchase of Raw Materials Attachment</th>
                                            <th width="30%">Details of sales in last three years</th>
                                        </tr>
                                        @php $t=0; @endphp
                                        @foreach($annexureData['raw_materials_attach'] as $data)
                                        @php $t++; @endphp
                                       
                                        <tr>
                                            <td>{{$t}}</td>
                                            <td>
                                                <table width="100%" >
                                                    @php $raw_mtrl_docs = ''; @endphp
                                                    @foreach($data->annexure as $raw_mtrl_docs)
                                                        @php $raw_mtrl_docs = $raw_mtrl_docs->raw_mtrl_docs; @endphp
                                                    @endforeach
                                                </table>
                                                    @if($raw_mtrl_docs != '')
                                                        <small><a target="_blank"
                                                                href="{{URL::to($docBaseUrl . $raw_mtrl_docs)}}"
                                                                class="document">View
                                                                Certificate</a></small>
                                                        @endif
                                               </td>
                                            <td>
                                            <table width="100%" >
                                                @php $details_sales_docs = ''; @endphp
                                                @foreach($data->annexure as $details_sales_docs)
                                                    @php $details_sales_docs = $details_sales_docs->details_sales_docs; @endphp
                                                @endforeach
                                            </table>
                                                @if($details_sales_docs != '')
                                                    <small><a target="_blank"
                                                            href="{{URL::to($docBaseUrl . $details_sales_docs)}}"
                                                            class="document">View
                                                            Certificate</a></small>
                                                    @endif
                                                </td>  
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                 <!-- 7.14 - 7.16 Profit & Loss, Statement of assets & Balance Sheet in last three years  -->
                                 <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>7.14 - 7.16</th>
                                            <th scope="col" colspan="13" class="text-left">Profit & Loss, Statement of assets & Balance Sheet in last three years
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <th width="5%">S.No</th>
                                            <th width="20%">Profit & Loss account for last three years</th>
                                            <th width="20%">Statement of assets & liabilities for last three years</th>
                                            <th width="20%">Balance Sheet for last three years </th>
                                        </tr>
                                        @php $u=0; @endphp
                                        @foreach($annexureData['psb_attach'] as $data)
                                        @php $u++; @endphp
                                       
                                        <tr>
                                            <td>{{$u}}</td>
                                            <td>
                                                <table width="100%" >
                                                    @php $profit_loss_docs = ''; @endphp
                                                    @foreach($data->annexure as $profit_loss_docs)
                                                        @php $profit_loss_docs = $profit_loss_docs->profit_loss_docs; @endphp
                                                    @endforeach
                                                </table>
                                                    @if($profit_loss_docs != '')
                                                    <small><a target="_blank"
                                                            href="{{URL::to($docBaseUrl . $profit_loss_docs)}}"
                                                            class="document">View
                                                            Certificate</a></small>
                                                    @endif
                                               </td>
                                            <td>
                                                <table width="100%" >
                                                    @php $statement_assests_docs = ''; @endphp
                                                    @foreach($data->annexure as $statement_assests_docs)
                                                        @php $statement_assests_docs = $statement_assests_docs->statement_assests_docs; @endphp
                                                    @endforeach
                                                </table>
                                                    @if($statement_assests_docs != '')
                                                        <small><a target="_blank"
                                                                href="{{URL::to($docBaseUrl . $statement_assests_docs)}}"
                                                                class="document">View
                                                                Certificate</a></small>
                                                        @endif
                                                </td>  
                                                <td>
                                                    <table width="100%" >
                                                    @php $balance_sheet_docs = ''; @endphp
                                                    @foreach($data->annexure as $balance_sheet_docs)
                                                        @php $balance_sheet_docs = $balance_sheet_docs->balance_sheet_docs; @endphp
                                                    @endforeach
                                                     </table>
                                                    @if($balance_sheet_docs != '')
                                                        <small><a target="_blank"
                                                                href="{{URL::to($docBaseUrl . $balance_sheet_docs)}}"
                                                                class="document">View
                                                                Certificate</a></small>
                                                        @endif
                                                </td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                <h4>Application / Inspection Fee</h4>
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <!-- 8.0 Details of Payment of Application Fee -->
                                <table class="table table-bordered">
                                    <tr class="table-dark">
                                            <th>8.0</th>
                                            <th scope="col" colspan="13" class="text-left"> Details of Payment of Application Fee
                                            </th>
                                        </tr>
                                    <tr class="table-primary">
                                        <th width="25%">Payment Mode:</th>
                                        <td>@if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails']))
                                                {{$annexureData['paymentdetails']->payment_mode}}
                                            @else
                                                N/A
                                            @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Amoiunt Paid:</th>
                                        <td>@if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails']))
                                             {{$annexureData['paymentdetails']->amt_paid}}
                                             @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Transaction Number: </th>
                                        <td>@if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails']))
                                             {{$annexureData['paymentdetails']->transaction_number}}
                                             @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Transaction Date:</th>
                                        <td>@if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails']))
                                             {{$annexureData['paymentdetails']->transaction_date}}
                                             @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bank Name:</th>
                                        <td>@if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails']))
                                             {{$annexureData['paymentdetails']->bank_name}}
                                             @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Attach Proof of Payment:</th>
                                        <td>
                                            @if(isset($annexureData['paymentdetails']->transaction_receipt))
                                                <a target="_blank"
                                                href="{{ URL::to($attchmentBaseUrl . $annexureData['paymentdetails']->transaction_receipt) }}"
                                                class="document text-primary">View Receipt</a>
                                            @else
                                                No payment details available.
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Whether Acknowledge of Payment :</th>
                                        <td>@if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails']))
                                             {{$annexureData['paymentdetails']->whether_acknowledge}}
                                             @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                <!-- 9.0 Details of Payment of Inspection Fee -->
                                <table class="table table-bordered">
                                    <tr class="table-dark">
                                            <th>9.0</th>
                                            <th scope="col" colspan="13" class="text-left"> Details of Payment of Inspection Fee
                                            </th>
                                        </tr>
                                        @if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails']))
                                            <tr class="table-primary">
                                                <th width="25%">Payment Mode:</th>
                                                <td>{{$annexureData['paymentdetails']->pymt_mode_insp}}</td>
                                            </tr>
                                            <tr>
                                                <th>Amount Paid:</th>
                                                <td>{{$annexureData['paymentdetails']->insp_amt_paid}}</td>
                                            </tr>
                                            <tr>
                                                <th>Transaction Number:</th>
                                                <td>{{$annexureData['paymentdetails']->insp_transaction_no}}</td>
                                            </tr>
                                            <tr>
                                                <th>Transaction Date:</th>
                                                <td>{{$annexureData['paymentdetails']->insp_transaction_date}}</td>
                                            </tr>
                                            <tr>
                                                <th>Bank Name:</th>
                                                <td>{{$annexureData['paymentdetails']->insp_bank_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Attach Proof of Payment:</th>
                                                <td>
                                                    <a target="_blank"
                                                    href="{{ URL::to($attchmentBaseUrl . $annexureData['paymentdetails']->transaction_receipt) }}"
                                                    class="document text-primary">View Receipt</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Whether Acknowledgment of Payment:</th>
                                                <td>{{$annexureData['paymentdetails']->insp_whether_acknowledge}}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="2">Payment details not available.</td>
                                            </tr>
                                        @endif
                                </table>

                            </div>
                        </div>
                    </div>

                     <!-- Affidavit and Inemnity -->
                     <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                <h4>Affidavit and Inemnity</h4>
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                            <table class="table table-bordered">
                                    <tr class="table-dark">
                                            <th>10.0</th>
                                            <th scope="col" colspan="13" class="text-left">Affidavit and Inemnity </th>
                                        </tr>
                                    <tr class="table-primary">
                                        <th width="25%">10.1 Model :</th>
                                        <td>
                                            @if ($data->module_type == 17)     
                                            @else
                                                {{ $data->module_name }}
                                            @endif 
                                            @if($data->module_name=='Other')
                                            <?php echo $data->other; ?>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="table-dark">
                                            <th>10.2</th>
                                            <th scope="col" colspan="13" class="text-left">Affidavit
                                            </th>
                                    </tr>
                                    
                                    <tr>
                                        <th>Application and upload duly signed copy :</th>
                                        <td><a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['signatory_document'])}}"
                                                class="document text-primary">View Receipt</a></td>
                                    </tr>
                                    <tr>
                                        <th>Affidavit Provided as per Annexture-||:</th>
                                        <td>{{$annexureData['applicationDetail']['affidavit']}}</td>
                                    </tr>
                                    <tr class="table-dark">
                                            <th>10.3</th>
                                            <th scope="col" colspan="13" class="text-left"> Indemnity
                                            </th>
                                    </tr>
                                    <tr>
                                        <th>Application and upload duly signed copy :</th>
                                        <td><a target="_blank"
                                                href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['indemnity_document'])}}"
                                                class="document text-primary">View Receipt</a></td>
                                    </tr>
                                    <tr>
                                        <th>Indemnity Provided as per Annexture-||:</th>
                                        <td>{{$annexureData['applicationDetail']['indemnity']}}</td>
                                    </tr>
                                    
                                </table>
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
    

                <!-- second table -->
      