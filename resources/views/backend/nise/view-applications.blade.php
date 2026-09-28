@inject('general', 'App\Http\Controllers\Backend\Nise\MainController')
@extends('layouts.masters.backend')
@section('content')
@section('title', 'Applications Detail : '.$annexureData['applicationDetail']['application_no'])
@php $docBaseUrl ='nise/preview-docs/Annexure/';
$attchmentBaseUrl ='nise/preview-docs/Attachment/';
$logoBaseUrl ='users/preview-docs/Logo/';
$bomBaseUrl ='users/preview-docs/BOM/';
@endphp
<?php
use App\Models\Module;
?>
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
                
                <blockquote>
                    @if($annexureData['applicationDetail']['forward_status']=='nise')
                    <tr>
                        <td colspan="7">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Forward to MNRE</button>
                            
                                    <!-- <i class="bi bi-chevron-bar-contract" aria-hidden="true"></i> -->
                        
                            <button type="button" class="btn btn-warning " data-bs-toggle="modal"
                                 data-bs-target="#RequestBtn">Request for Document <i class="bi bi-chevron-bar-contract"
                                aria-hidden="true"></i></button>

                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#scheduleInspection">Schedule Inspection Date</button>
                            <!-- <a href="{{URL::to('/'.Auth::getDefaultDriver().'/applications-list')}}"
                                class="btn btn-danger">Back</a> -->
                        </td>
                    </tr>
                    @endif
                </blockquote>
                 <!-- Start New Application View-->
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
                                    <td width="30%" class="table-primary"> <strong>1.3 Communication Address of the Company </strong> <br></td>
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
                        </table>

                        <!-- Manufacture Start-->
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingModule">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOneModule" aria-expanded="true"
                                        aria-controls="collapseOneModule">
                                        <h4>Manufacturing Facility Details</h4>
                                    </button>
                                </h2>
                                <div id="collapseOneModule" class="accordion-collapse collapse show"
                                    aria-labelledby="headingModule" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <!-- 3.0	Manufacturing Facility Details -->
                                        <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr class="table-dark">
                                                        <th>3.0</th>
                                                        <th scope="col" colspan="13" class="text-left">Manufacturing Facility Details (Physical and Financial)
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th rowspan="2">S.No</th>
                                                        <th rowspan="2">3.1 Currently installed Manufacturing Capacity of Solar PV Modules (in MW / Year)</th>
                                                        <th rowspan="2">3.2 Date of Commencement of commercial production by the solar PV module manufacturing unit</th>
                                                        <th rowspan="2">3.3 Upload list of Major Equipment related to Manufacturing and Testing in the specified format as available in the Solar PV module manufacturing unit</th>
                                                    </tr>
                                                    <tr></tr>
                                                    <tr>
                                                        <td>{{1}}</td>
                                                        <td>
                                                            @if (isset($annexuredata->installed_manufacturing_capacity) && !empty($annexuredata->installed_manufacturing_capacity))
                                                                {{$annexuredata->installed_manufacturing_capacity}}
                                                            @else
                                                                Not Available
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (is_object($annexuredata) && isset($annexuredata->production_date))
                                                                {{ $annexuredata->production_date }}
                                                            @else
                                                                Not Available
                                                            @endif
                                                        </td>
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
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mechanical Data -->
                        <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h4>Mechanical Data</h4>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <!-- 4.1	Mechanical Data -->
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr class="table-dark">
                                                    <th>4.1</th>
                                                    <th scope="col" colspan="13" class="text-left">Mechanical Data</th>
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
                                    </div>
                                </div>
                        </div>

                       <!-- Electrical Data at STC -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <h4>Electrical Data at STC</h4>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <!-- 4.0 BIS Registration / Certification Details -->
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>4.3</th>
                                                <th scope="col" colspan="13" class="text-left">Electrical Data at STC
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
                                                <!-- <td>{{ $data->pmax_watt }}</td> -->
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

                        <!-- 4.4 - 4.5. Solar Cell & BOM -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <h4>Solar Cell & BoM</h4>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <!-- Solar Cell & BoM 4.4 Start-->
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th colspan="13" class="text-left">4.4 Solar Cell</th>
                                            </tr>
                                            <tr class="table-dark">
                                                <th>S.No</th>
                                                <th>Model Names of Solar Modules</th>
                                                <th>Module Wattage</th>
                                                <th>Technology type of solar cells</th>
                                                <th>No. of solar cells & type</th>
                                                <th>Efficiency Range of Solar Cell (Min %)</th>
                                                <th>Efficiency Range of Solar Cell (Max %)</th>
                                                <th>Wattage Range of Solar Cell (Min W)</th>
                                                <th>Wattage Range of Solar Cell (Max W)</th>
                                                <th>Solar Cell Dimension (X)</th>
                                                <th>×</th>
                                                <th>Solar Cell Dimension (Y)</th>
                                                <th>No. of bus bars per solar cell</th>
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
                                            <tr>
                                                <th colspan="13" class="text-left">
                                                    Cell Data Sheet :
                                                    @if(!empty($annexureData['applicationDetail']['cell_data_sheet']))
                                                        <a target="_blank"
                                                            href="{{ URL::to($attchmentBaseUrl . $annexureData['applicationDetail']['cell_data_sheet']) }}"
                                                            class="document text-primary">View Cell Data Sheet</a>
                                                    @endif
                                                </th>
                                            </tr>
                                        </tfoot>

                                    </table>
                                    <br>

                                    <!-- Solar Cell & BoM End 4.5 -->
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

                        <!-- 5.0 Type Registration BIS -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                    <h4>BIS Registration</h4>
                                </button>
                            </h2>
                            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <!-- 5.0 BIS Registration / Certification Details -->
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>5.0</th>
                                                <th scope="col" colspan="13" class="text-left"> BIS Registration / Certification Details
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
                                </div>
                            </div>
                        </div>

                        <!-- Application / Inspection Fee -->
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
                                                <th>6.0</th>
                                                <th scope="col" colspan="13" class="text-left"> Details of Payment of Application Fee
                                                </th>
                                            </tr>
                                        <tr class="table-primary">
                                            <th width="25%">Payment Mode:</th>
                                            <td>{{$applicationData->payment_mode ?? '----'}}
                                                <!-- @if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails']))
                                                    {{$annexureData['paymentdetails']->payment_mode}}
                                                @else
                                                    N/A
                                                @endif -->
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Amoiunt Paid:</th>
                                            <td>{{$applicationData->amt_paid ?? '----'}}
                                                <!-- @if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails']))
                                                {{$annexureData['paymentdetails']->amt_paid}}
                                                @else
                                                    N/A
                                                @endif -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Transaction Number: </th>
                                            <td> {{$applicationData->transaction_number ?? '----'}}
                                                <!-- @if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails']))
                                                {{$annexureData['paymentdetails']->transaction_number}}
                                                @else
                                                    N/A
                                                @endif -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Transaction Date:</th>
                                            <td>{{$applicationData->transaction_date ?? '----'}}
                                                <!-- @if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails']))
                                                {{$annexureData['paymentdetails']->transaction_date}}
                                                @else
                                                    N/A
                                                @endif -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Bank Name:</th>
                                            <td> {{$applicationData->bank_name ?? '----'}}
                                                <!-- @if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails']))
                                                {{$annexureData['paymentdetails']->bank_name}}
                                                @else
                                                    N/A
                                                @endif -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Attach Proof of Payment:</th>
                                            <td>
                                            @if(($applicationData->transaction_receipt ?? '') !=null)
                                                <span><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$applicationData->transaction_receipt)}}"
                                                        class="document text-primary">View
                                                        Proof of Payment</a></span> @else ---- @endif
                                                <!-- @if(isset($annexureData['paymentdetails']->transaction_receipt))
                                                    <a target="_blank"
                                                    href="{{ URL::to($attchmentBaseUrl . $annexureData['paymentdetails']->transaction_receipt) }}"
                                                    class="document text-primary">View Receipt</a>
                                                @else
                                                    No payment details available.
                                                @endif -->
                                            </td>
                                        </tr>

                                        <!-- <tr>
                                            <th>Whether Acknowledge of Payment :</th>
                                            <td>@if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails']))
                                                {{$annexureData['paymentdetails']->whether_acknowledge}}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr> -->
                                    </table>
                                    <!-- 9.0 Details of Payment of Inspection Fee -->
                                    <table class="table table-bordered">
                                        <tr class="table-dark">
                                                <th>6.1</th>
                                                <th scope="col" colspan="13" class="text-left"> Details of Payment of Inspection Fee
                                                </th>
                                            </tr>
                                            <!-- @if(isset($annexureData['paymentdetails']) && is_object($annexureData['paymentdetails'])) -->
                                                <tr class="table-primary">
                                                    <th width="25%">Payment Mode:</th>
                                                    <td>{{$applicationData->pymt_mode_insp ?? '----'}}
                                                        <!-- {{$annexureData['paymentdetails']->pymt_mode_insp}} -->
                                                    </td>
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
                                            <!-- @else -->
                                                <!-- <tr>
                                                    <td colspan="2">Payment details not available.</td>
                                                </tr> -->
                                            <!-- @endif -->
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
                                                <th scope="col" colspan="13" class="text-left">Affidavit and Inemnity
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
            </div>

        </div>
    </div>
</div>

<!-- Forward to mnre  -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Review</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('nise/forwardto') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{$annexureData['applicationDetail']['id']}}">
                    <div class="form-group">
                        <label for="forward_status" class="col-form-label">Forward Status:</label>
                        <select name="forward_status" id="forward_status" class="form-control">
                            <option value="mnre">Forward to MNRE For Approved</option>
                        </select>
                    </div><br>
                    <!-- Upload dpr for Mnre  -->
                    <!-- <div class="col-md-12">
                        <label for="">Upload DPR Documents <small class="text-primary">(File should be in PDF Format and Max. 10 MB)</small></label>
                        <input type="file" name="dpr_document" id="dpr_document" class="form-control pdf_file_10mb">
                        @error('dpr_document') <span class="valid_class"> {{ $message }} </span> @enderror
                    </div> -->
                    <!-- msg for mnre  -->
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea name="description" class="form-control" id="message-text" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Forward to User for correction by niwe -->
<div class="modal" id="RequestBtn">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Request for Documents</h4>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>
            <!-- Modal body -->
            <form action="{{ url('nise/forwardto') }}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{$annexureData['applicationDetail']['id']}}">
                    <div class="form-group">
                        <label for="forward_status" class="col-form-label">Document Status:</label>
                        <select name="forward_status" id="forward_status">
                            
                            <option value="return_nise">Query to Applicant</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea name="description" class="form-control" id="message-text" required></textarea>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <!-- Bootstrap 5 button -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Back</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Schedule Inspection  -->
<div class="modal" id="scheduleInspection">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Schedule Inspection Date</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

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