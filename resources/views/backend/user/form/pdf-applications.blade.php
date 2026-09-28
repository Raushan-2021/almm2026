@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@php $docBaseUrl ='users/preview-docs/Annexure/';
$attchmentBaseUrl ='users/preview-docs/Attachment/';
$bomBaseUrl ='users/preview-docs/BOM/';
$logoBaseUrl ='users/preview-docs/Logo/';
@endphp
<?php
use App\Models\Module;
?>
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
                                        <!-- <td>1</td> -->
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
                                                    <span
                                                        class="text-primary">{{$annexureData['applicationDetail']['com_phone']}}</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email">Email:</label>
                                                    <span
                                                        class="text-primary">{{$annexureData['applicationDetail']['com_email']}}</span>
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
                                        <div class="col-md-6">
                                                    <label for="plant_address">Address:</label>
                                                    <span class="text-primary">{{$annexureData['applicationDetail']['plant_address']}}</span>
                                                </div>
                                        
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="phone">Phone:</label>
                                                    <span class="text-primary"> {{$annexureData['applicationDetail']['plant_phone']}} </span>
                                                </div>
                                                <div class="col-md-6"><label for="email">Email:</label><span class="text-primary">
                                                    {{$annexureData['applicationDetail']['plant_email']}}</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Latitude:</label><span class="text-primary">
                                                    {{$annexureData['applicationDetail']['plant_latitude']}}</sapn>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Longitude">Longitude:</label><span class="text-primary">
                                                    {{$annexureData['applicationDetail']['plant_longitude']}} </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="gps_latitude">GPS Coordinates North:</label><span class="text-primary">
                                                    {{$annexureData['applicationDetail']['gps_latitude']}}</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="gps_longitude">GPS Coordinates East:</label><span class="text-primary">
                                                    {{$annexureData['applicationDetail']['gps_longitude']}} </span>
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
                                    <!-- <tr>
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
                                    </tr> -->
                                    <!-- <tr>
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
                                    </tr> -->
                                
                                    <tr>
                                        <td width="30%" class="table-primary"> <strong>2.0 Authorized signatory details</strong> <br></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Name:</label> <span class="text-primary">
                                                    {{$annexureData['applicationDetail']['authorize_name']}} </sapn>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">Designation:</label><span class="text-primary">
                                                    {{$annexureData['applicationDetail']['authorize_designation']}} </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Signatory Document:</label><span class="text-primary">
                                                    @if($annexureData['applicationDetail']['signatory_document']!='') </span>
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
                                                    <label for="">Phone No:</label><span class="text-primary">
                                                    {{$annexureData['applicationDetail']['person_contact_no']}} </span>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">E-mail:</label><span class="text-primary">
                                                    {{$annexureData['applicationDetail']['person_email']}} </span>
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
                                            <small> <i>
                                                    <u><span
                                                            style="margin-top: 0px; position: absolute; margin-left: -9px;font-size: 18px;">(</span>No.
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
                
                            <h4>Manufacturing Facility Details</h4>
                            <!-- 3.0	Manufacturing Facility Details -->
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="table-dark">
                                        <th>3.0</th>
                                        <th scope="col" colspan="4" class="text-left">Manufacturing Facility Details (Physical and Financial)
                                        </th>
                                    </tr>
                                    <tr></tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th rowspan="2">S.No</th>
                                        <th rowspan="2">3.1 Currently installed Manufacturing Capacity of Solar PV Modules (in MW / Year)</th>
                                        <th rowspan="2">3.2 Date of Commencement of commercial production by the solar PV module manufacturing unit</th>
                                        <th rowspan="2">3.3 Upload list of Major Equipment related to Manufacturing and Testing in the specified format as available in the Solar PV module manufacturing unit</th>
                                    </tr>
                                    <tr>
                                        <td>{{1}}</td>
                                        <td>{{$annexuredata->installed_manufacturing_capacity}}</td>
                                        <td>{{$annexuredata->production_date}}</td>
                                        <td> <?php if(isset($annexuredata->calibration_certificate) && $annexuredata->calibration_certificate){ ?>
                                                <small>
                                                    <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->calibration_certificate) }}" class="document">
                                                        View Certificate
                                                    </a>
                                                </small>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                                <!-- 3.4	Purchase of Raw Materials & Details of sales in last three years -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-dark">
                                        <th>3.4</th>
                                        <th scope="col" colspan="3" class="text-left">	Purchase of Raw Materials & Details of sales in last three years
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-primary">
                                        <th width="5%">S.No</th>
                                        <th width="20%">Purchase of Raw Materials Attachment</th>
                                        <th width="30%">Details of sales in last three years</th>
                                    </tr>
                                    
                                    <tr>
                                        <td>{{1}}</td>
                                        <td><?php if(isset($annexuredata->details_sales_docs) && $annexuredata->details_sales_docs){ ?>
                                                <small>
                                                    <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->details_sales_docs) }}" class="document">View Certificate </a>
                                                </small>
                                                <?php } ?>
                                        </td>
                                        <td><?php if(isset($annexuredata->raw_mtrl_docs) && $annexuredata->raw_mtrl_docs){ ?>
                                                <small>
                                                    <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->raw_mtrl_docs) }}" class="document">
                                                        View Certificate</a>
                                                </small>
                                                <?php } ?>
                                        </td> 
                                    </tr>
                                    
                                </tbody>
                            </table>

                            <!-- 3.5-3.7 Profit & Loss, Statement of assets & Balance Sheet in last three years  -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-dark">
                                        <th>3.5 - 3.7</th>
                                        <th scope="col" colspan="4" class="text-left">Profit & Loss, Statement of assets & Balance Sheet in last three years
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
                                
                                    <tr>
                                        <td>{{1}}</td>
                                        <td><?php if(isset($annexuredata->profit_loss_docs) && $annexuredata->profit_loss_docs){ ?>
                                                    <small>
                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->profit_loss_docs) }}" class="document">
                                                            View Certificate
                                                        </a>
                                                    </small>
                                                        <?php } ?>
                                        </td>
                                        <td><?php if(isset($annexuredata->statement_assests_docs) && $annexuredata->statement_assests_docs){ ?>
                                                    <small>
                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->statement_assests_docs) }}" class="document">
                                                            View Certificate
                                                        </a>
                                                    </small>
                                                        <?php } ?>
                                        </td>
                                        <td><?php if(isset($annexuredata->balance_sheet_docs) && $annexuredata->balance_sheet_docs){ ?>
                                                    <small>
                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->balance_sheet_docs) }}" class="document">
                                                            View Certificate
                                                        </a>
                                                    </small>
                                                        <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                                                <h4>Module's</h4>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="table-dark">
                                                            <th width="5%">S.No</th>
                                                            <th width="10%">Module Technology</th>
                                                            <th width="10%">Model Name</th>
                                                            <th width="10%">Wattage of applied main model (W)</th>
                                                            <th width="10%">Model Names of applied sub-models </th>
                                                            <th width="10%">Wattage of applied sub-models (W)</th>
                                                            <th width="10%">No. $ type of cells in module (eg. 144 Half-Cut cells)</th>
                                                            <th width="10%">Max System Voltage (V)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($moduleData as $key=>$data)
                                                    @php
                                                        $rows=Module::where('main_module_id',$data->id)->get();
                                                        $cnt1=count($rows);
                                                        $i=0;
                                                        $j=1;
                                                    $data = json_decode($data);
                                                    $cnt=count($moduleData);
                                                    @endphp
                                                    
                                                @foreach($rows as $row)

                                                    @if($i==0)
                                                    <tr>
                                                    <td rowspan="{{$cnt1}}">{{$key+1}}</td>
                                                    <td rowspan="{{$cnt1}}"> @if ($data->module_type == 17)     
                                                            @else
                                                                {{ $data->module_name }}
                                                            @endif 
                                                        @if($data->module_type==17)

                                                            <?php echo $data->other; ?>
                                                            @endif</td>
                                                            <td  rowspan="{{$cnt1}}">{{$data->main_model_name}}</td>
                                                            <td  rowspan="{{$cnt1}}">{{$data->main_wattage}}</td>
                                                            <td >{{$row->sub_model_name}}</td>
                                                            <td >{{$row->sub_model_wattage}}</td>
                                                            <td >{{$row->cell_type}}</td>
                                                            <td >{{$row->max_system_volatge}}</td> 
                                                    </tr>  
                                                    @else
                                                    <tr>
                                                    <td >{{$row->sub_model_name}}</td>
                                                            <td >{{$row->sub_model_wattage}}</td>
                                                            <td >{{$row->cell_type}}</td>
                                                            <td >{{$row->max_system_volatge}}</td>
                                                    </tr>  
                                                    @endif
                                                    <?php
                                                    $i++;
                                                    ?>
                                                @endforeach
                                                <?php echo $data->other; ?>
                                                @endforeach
                                                </tbody>
                                            </table>

                                    
                                                <h4>Mechanical Data</h4>
                                                <!-- 4.1	Mechanical Data -->
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr class="table-dark">
                                                            <th>4.1</th>
                                                            <th scope="col" colspan="8" class="text-left">Mechanical Data</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th rowspan="2">S.No</th>
                                                            <th rowspan="2">Model Names of Solar Modules</th>
                                                            <th rowspan="2">Model Wattage</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Length of Module (in mm)</th>
                                                            <th>Width of Module (in mm)</th>
                                                            <th>Height of Module (in mm)</th>
                                                            <th>Area of Module (in mm square)</th>
                                                            <th>Weight of Module (in mm)</th>
                                                        </tr>
                                                        @php $c=0; @endphp
                                                        @foreach($appData as $data)
                                                        <?php                                    
                                                        $rows=Module::where('id',$data->module_type)->first();
                                                        ?>
                                                        @php $c++; @endphp
                                                        <tr>
                                                            <td>{{$c}}</td>
                                                            <td>{{ $rows->sub_model_name }}</td>
                                                            <td class="">{{ $rows->sub_model_wattage }}</td>
                                                            <td class="text-center">{{ $data->module_length }}</td>
                                                            <td class="text-center">{{ $data->module_breadth }}</td>
                                                            <td class="text-center">{{ $data->module_dimensions }}</td>
                                                            <td>{{ $data->module_area }}</td>
                                                            <td>{{ $data->module_weight }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table><br>

                                                <!-- 4.2	Warranty Details -->
                                                <table class="table table-bordered text-center table-responsive">
                                                    <thead>
                                                        <tr class="table-dark">
                                                            <th>4.2 </th>
                                                            <th scope="col" colspan="2" class="text-left">Warranty Details</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="table-primary">
                                                        </tr>
                                                        <tfoot>
                                                        <th scope="col" colspan="1" class="text-left">
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

                                    <!-- Electrical Data at STC -->
                    
                                                <h4>Electrical Data at STC</h4>
                                                <!-- 4.0 BIS Registration / Certification Details -->
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr class="table-dark">
                                                            <th>4.3</th>
                                                            <th scope="col" colspan="11" class="text-left">Electrical Data at STC
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th rowspan="2">S.No</th>
                                                            <th rowspan="2">Model Names of Solar Modules</th>
                                                            <th rowspan="2">Model Wattage</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Pmax (Wp).</th>
                                                            <th>Power output Tolerance-Pmax(W)	</th>
                                                            <th>Vmp (V) </th>
                                                            <th>Imp (A)</th>
                                                            <th>Voc (V)</th>
                                                            <th>Isc (A)</th>
                                                            <th>Module Efficiency (%)</th>
                                                            <th width="15%">Fill Factor</th>
                                                        </tr>
                                                        @php $d=0; @endphp
                                                        @foreach($appData as $data)
                                                        <?php $rows=Module::where('id',$data->module_type)->first(); ?>
                                                        @php $d++; @endphp
                                                        <tr>
                                                            <td>{{$d}}</td>
                                                            <td>{{ $rows->sub_model_name }}</td>
                                                            <td>{{ $rows->sub_model_wattage }}</td>
                                                            <td>{{ $data->pmax }}</td>
                                                            <td>{{ $data->power_output }}</td>
                                                            <td>{{ $data->vmp }}</td>
                                                            <td>{{ $data->imp }}</td>
                                                            <td>{{ $data->voc }}</td>
                                                            <td>{{ $data->isc }}</td>
                                                            <td>{{ $data->model_efficiency }}</td>
                                                            <td>{{ $data->fill_factor }}</td>
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
                                            </div>
                                        </div>
                                    </div>
                                   
                                        <h4>Solar Cell & BoM</h4>
                                                <!-- Annexure 5.1 Start-->
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="9" class=" text-left">4.4 Solar Cell </th>
                                                        </tr>
                                                        <tr class="table-dark">
                                                            <th>S.No</th>
                                                            <th>Model Names of Solar Modules</th>
                                                            <th>Module Wattage</th>
                                                            <th>Technology type of solar cells</th>
                                                            <th>No. of solar cells & type.Type will be full/half cut etc.</th>
                                                            <th>Efficiency Range of Solar Cell</th>
                                                            <th>Wattage Range of Solar Cell (%)</th>
                                                            <th>Solar Cell Dimention (in mm * mm)</th>
                                                            <th>No. of bus bars per solar cell</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="text-align:center; vertical-align: top;">Min(%)</th>
                                                            <th style="text-align:center; vertical-align: top;">Max(%)</th>
                                                            <th style="text-align:center; vertical-align: top;">Min(W)</th>
                                                            <th style="text-align:center; vertical-align: top;">Max(W)</th>
                                                            <th style="text-align:center; vertical-align: top;">(mm)</th>
                                                            <th style="text-align:center; vertical-align: top;">X</th>
                                                            <th style="text-align:center; vertical-align: top;">(mm)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $d=0; @endphp
                                                        @foreach($appData as $data) 
                                                        <?php                                    
                                                                $rows=Module::where('id',$data->module_type)->first();
                                                                ?>
                                                            @php $d++;$check=0; @endphp
                                                        
                                                        <tr>
                                                            <td>{{$d}}</td>
                                                            <td>{{ $rows->sub_model_name }}</td>
                                                            <td class="">{{ $rows->sub_model_wattage }}</td>
                                                            <td>{{ $data->cell_technology }}</td>
                                                            <td class="">{{ $rows->cell_type }}</td>
                                                            <td>{{ $data->cell_min_efficiency }}</td>
                                                            <td>{{ $data->cell_max_efficiency }}</td>
                                                            <td>{{ $data->cell_min_wattage }}</td>
                                                            <td>{{ $data->cell_max_wattage }}</td>
                                                            <td>{{ $data->cell_demension_one }}</td>
                                                            <td>x</td>
                                                            <td>{{ $data->cell_demension_two }}</td>
                                                            <td>{{ $data->cell_total_bus }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <th scope="col" colspan="1" class="text-left">
                                                            Cell Data Sheet :
                                                            @if($annexureData['applicationDetail']['cell_data_sheet']!='')
                                                            <a target="_blank"
                                                                href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['cell_data_sheet'])}}"
                                                                class="document text-primary">View Cell Data Sheet</a>
                                                            @endif
                                                        </th>
                                                    </tfoot>
                                                </table>
                                                <br>

                                                <!-- Annexure 5.2 End-->
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="9" class=" text-left">4.5 Balance of Materials (BoM)</th>
                                                        </tr>
                                                        <tr class="table-dark">
                                                            <th>S.No</th>
                                                            <th>Model Names of Solar Modules</th>
                                                            <th>Module Wattage</th>
                                                            <th>Front Cover</th>
                                                            <th>Back Cover</th>
                                                            <th>Frame</th>
                                                            <th>Adhesive</th>
                                                            <th>Encapsulate</th>
                                                            <th>Junction Box</th>
                                    
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $f=0; @endphp
                                                        @foreach($appData as $data) 
                                                        <?php                                    
                                                                $rows=Module::where('id',$data->module_type)->first();
                                                                ?>
                                                        @php $f++;$check=0; @endphp
                                                        <tr>
                                                            <td>{{$f}}</td>
                                                            <td>{{ $rows->sub_model_name }}</td>
                                                            <td class="">{{ $rows->sub_model_wattage }}</td>
                                                            <td>{{ $data->front_cover }}</td>
                                                            <td>{{ $data->back_cover }}</td>
                                                            <td>{{ $data->frame }}</td>
                                                            <td>{{ $data->adhesive }}</td>
                                                            <td>{{ $data->encapsulate }}</td>
                                                            <td>{{ $data->junction_box }} </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <th scope="col" colspan="1" class="text-left">
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

                                    <!-- Type Registration BIS -->
                                     <h4>BIS Registration</h4>
                                                <!-- 4.0 BIS Registration / Certification Details -->
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr class="table-dark">
                                                            <th>5.0</th>
                                                            <th scope="col" colspan="8" class="text-left"> BIS Registration / Certification Details
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th rowspan="2">S.No</th>
                                                            <th rowspan="2">Model Names of Solar Modules</th>
                                                            <th rowspan="2">Model Wattage</th>
                                                
                                                        </tr>
                                                        <tr>
                                                            <th>BIS Registration No.</th>
                                                            <th>Date of Inclusion in BIS</th>
                                                            <th>Date till which BIS Registration is Valid </th>
                                                            <th>Upload BIS Registration Certificate</th>
                                                        </tr>
                                                        
                                                        @php $i = 1 @endphp
                                                        @foreach($appData3 as $data)
                                                    
                                                            <?php                                    
                                                            $rows=Module::where('id',$data->module_type)->first();
                                                            ?>
                                                            @php $i++;$check=0; @endphp
                                                        <tr>
                                                            <td>{{$i}}</td>
                                                            <td>{{ $rows->sub_model_name }}</td>
                                                            <td class="">{{ $rows->sub_model_wattage }}</td>
                                                            <td>R-{{$data->bis_certificate_no }}</td>
                                                            <td>{{ $data->bis_certificate_issue }}</td>
                                                            <td>{{ $data->bis_certificate_valid }}</td>
                                                            <td>
                                                                @php $nabl_certificate=''; @endphp
                                                                @php $nabl_certificate=$data->doc_certificate; @endphp
                                                                @if($nabl_certificate!='')
                                                                <small><a target="_blank" href="{{URL::to($docBaseUrl.$nabl_certificate)}}"
                                                                class="document text-primary"><i class="bi bi-file-pdf fa-2x text-danger"></i></a></small>
                                                                @endif
                                                            </td>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            Upload Electric Data sheet:
                                                            @if($annexureData['applicationDetail']['bis_test_report']!='')
                                                            <a target="_blank"
                                                                href="{{URL::to($attchmentBaseUrl.$annexureData['applicationDetail']['bis_test_report'])}}"
                                                                class="document text-primary">View Cell Data Sheet</a>
                                                            @endif
                                                        
                                                        </tfoot>
                                                </table><br>

                                    <h4>Application / Inspection Fee</h4>
                                                <!-- 8.0 Details of Payment of Application Fee -->
                                                <table class="table table-bordered">
                                                    <tr class="table-dark">
                                                            <th>6.0</th>
                                                            <th scope="col" colspan="13" class="text-left"> Details of Payment of Application Fee
                                                            </th>
                                                        </tr>
                                                    <tr class="table-primary">
                                                        <th width="25%">Payment Mode:</th>
                                                        <td>{{$applicationData->payment_mode ?? '----'}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Amoiunt Paid:</th>
                                                        <td>{{$applicationData->amt_paid ?? '----'}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Transaction Number: </th>
                                                        <td> {{$applicationData->transaction_number ?? '----'}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Transaction Date:</th>
                                                        <td>{{$applicationData->transaction_date ?? '----'}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Bank Name:</th>
                                                        <td> {{$applicationData->bank_name ?? '----'}}</td>
                                                    </tr>
                                                
                                                    <tr>
                                                        <th>Attach Proof of Payment:</th>
                                                        <td>
                                                        @if(($applicationData->transaction_receipt ?? '') !=null)
                                                            <span><a target="_blank"
                                                                    href="{{URL::to($docBaseUrl.$applicationData->transaction_receipt)}}"
                                                                    class="document text-primary">View
                                                                    Proof of Payment</a></span> @else ---- @endif
                                                        </td>
                                                    </tr>

                                                </table>
                                                <!-- 9.0 Details of Payment of Inspection Fee -->
                                                <table class="table table-bordered">
                                                    <tr class="table-dark">
                                                            <th>6.1</th>
                                                            <th scope="col" colspan="8" class="text-left"> Details of Payment of Inspection Fee
                                                            </th>
                                                        </tr>
                                                      
                                                            <tr class="table-primary">
                                                                <th width="25%">Payment Mode:</th>
                                                                <td>{{$applicationData->pymt_mode_insp ?? '----'}}
                                                                
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Amount Paid:</th>
                                                                <td>{{$annexureData['paymentdetails']->insp_amt_paid ?? '----'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Transaction Number:</th>
                                                                <td>{{$annexureData['paymentdetails']->insp_transaction_no ?? '----'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Transaction Date:</th>
                                                                <td>{{$annexureData['paymentdetails']->insp_transaction_date ?? '----'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Bank Name:</th>
                                                                <td>{{$annexureData['paymentdetails']->insp_bank_name ?? '----'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Attach Proof of Payment:</th>
                                                                <td>
                                                                    @if(isset($annexureData['paymentdetails']) && !empty($annexureData['paymentdetails']->transaction_receipt))
                                                                        <a target="_blank"
                                                                        href="{{ URL::to($attchmentBaseUrl . $annexureData['paymentdetails']->transaction_receipt) }}"
                                                                        class="document text-primary">
                                                                            View Receipt
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Whether Acknowledgment of Payment:</th>
                                                                <td>{{$annexureData['paymentdetails']->insp_whether_acknowledge ?? '----'}}</td>
                                                            </tr>
                                                    
                                                </table>


                                    <!-- Affidavit and Inemnity -->
                                        <h4>Affidavit and Inemnity</h4>
                                            <table class="table table-bordered">
                                                    <tr class="table-dark">
                                                            <th>10.0</th>
                                                            <th scope="col" colspan="1" class="text-left">Affidavit and Inemnity
                                                            </th>
                                                        </tr>
                                                    <tr class="table-primary">
                                                        <th width="25%">10.1 Model :</th>
                                                        <td>@foreach ($annexuredata1 as $item)
                                                                    {{ $item->module_name }}<br>
                                                                @endforeach</td>
                                                    </tr>
                                                    <tr class="table-dark">
                                                            <th>10.2</th>
                                                            <th scope="col" colspan="1" class="text-left">Affidavit
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
                                                            <th scope="col" colspan="1" class="text-left"> Indemnity
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
                                            
                                   

