<html>
<title></title>

<head>
    <link href="{{ public_path('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

</head>
<style>
table {
    width: 100%;
}

tr,
th,
td {
    border: 1px solid #ccc;
    padding: 5px;
    text-align: left;
    margin: 0px;
}
</style>

<body>
    @php $logoBaseUrl ='users/preview-docs/Logo/';
    $docBaseUrl ='users/preview-docs/Attachment/';
    @endphp
    <table cellspacing="0" class="table table-bordered table-striped">
        <tr>
            <th colspan="3" class="bg-primary">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{URL::to('/'.Auth::getDefaultDriver())}}" class="logo d-flex align-items-center">
                        <img src="{{URL::asset('public/images/logo.png')}}" alt="" style="width:15%">
                        <span class="d-none d-lg-block"></span>
                    </a>
                    <i class="bi bi-list toggle-sidebar-btn"></i>
                </div>
            </th>
        </tr>
        <tr>
            <th colspan="3" class="bg-primary">Details of Solar Photovoltaic (PV) Module Manufacturer</th>
        </tr>
        <tr>
            <th width="30%">Type of Application</th>
            <th colspan="2">
                @if($application_data->application_type ==1)New Application @endif
            </th>
        </tr>
        <tr>
            <th>Name of Manufacturer</th>
            <th colspan="2">
                {{$application_data->manufacturer_name }}
            </th>
        </tr>
        <tr>
            <th>Manufacturer Brand Name & Logo</th>
            <th>
                {{$application_data->manufacturer_brand_name }}
            </th>
            <th><img src="{{ url('storage/documents/systems/Logo/'.$application_data->manufacturer_brand_logo)}}"
                    alt="{{$application_data->manufacturer_name }}" style="width:50px;t" /></th>
        </tr>
        <tr>
            <th>Registered Office Address of the Manufacturer</th>
            <td colspan="2">
                <b>Address:</b> {{$application_data->register_office_address}}<br>
                <b>Phone:</b> {{$application_data->register_office_phone}}<br>
                <b>Email:</b> {{$application_data->register_office_email}}
            </td>
        </tr>
        <tr>
            <th>Communication Address of the Manufacturer</th>
            <td colspan="2">
                <b>Address:</b> {{$application_data->com_address}}<br>
                <b>Phone:</b> {{$application_data->com_phone}}<br>
                <b>Email:</b> {{$application_data->com_email}}
            </td>
        </tr>
        <tr>
            <th>Location/Address of Manufacturing Plant including Latitude/Longitude for the current application
            </th>
            <td colspan="2">
                <b>Address:</b> {{$application_data['plant_address']}}<br>
                <b>Phone:</b> {{$application_data->plant_phone}}<br>
                <b>Email:</b> {{$application_data->plant_email}}<br>
                <b>Latitude:</b>{{$application_data->plant_latitude}}<br>
                <b>Longitude:</b>{{$application_data->plant_longitude}}
            </td>
        </tr>
        <tr>
            <th>Contact Person</th>
            <td colspan="2">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Name:</label>
                        {{$application_data->contact_person_name}}
                    </div>
                    <div class="col-md-6">
                        <label for="">Designation:</label>
                        {{$application_data->person_designation}}
                    </div>
                    <div class="col-md-6">
                        <label for="">Phone No:</label>
                        {{$application_data->person_contact_no}}
                    </div>
                    <div class="col-md-6">
                        <label for="">E-mail:</label>
                        {{$application_data->person_email}}
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>No. of Main PV Model Applied</th>
            <td colspan="2">
                <div class="row">
                    <div class="col-md-12">
                        <table cellspacing="0">
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
            <th>Total PV Manufacturing Capacity (in MW/year)</th>
            <td colspan="2">{{$application_data->manufacturing_capacity}} MW</td>
        </tr>
        <tr>
            <th>Module List</th>
            <td colspan="2">
                <table cellspacing="0" class="table table-bordered">
                    <thead>
                        <tr class="bg-warning">
                            <th width="5%">S.No</th>
                            <th width="10%">Type of Modules</th>
                            <th width="10%">Main Model</th>
                            <th width="10%">Pmax (Wp) of Main Model</th>
                            <th width="10%">Applicable models covered under +- 5%, Pmax of Main Model</th>
                            <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($moduleData as $data)
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
            </td>
        </tr>
        <tr>
            <th>Details of Payment of Fee</th>
            <td colspan="2">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Total Amount Paid:</label>
                        {{$payment_data->application_amount_paid ?? ''}} INR
                    </div>
                    <div class="col-md-6">
                        <label for="">Bank Name:</label>
                        {{$payment_data->bank_name ?? ''}}
                    </div>
                    <div class="col-md-6">
                        <label for="">Payment Date:</label>
                        {{$payment_data->transaction_date ?? ''}}
                    </div>
                    <div style="clear:both"></div>
                    <div class="col-md-6">
                        <label for="">UTR/reference No:</label>
                        {{$payment_data->transaction_number ?? ''}}
                    </div>
                    <div class="col-md-6">

                        <label for="">Mode of Payment:</label>
                        {{$payment_data->payment_mode ?? ''}}
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-center">
                <table cellspacing="0" style="border:0px;">
                    <tr style="border:0px;">
                        <td style="border:0px;">
                            <div class="col-md-3">
                                <i>{{$application_data->authorize_name}}<br>
                                    {{$application_data->authorize_designation}}<br><br><br>
                                    ..............................</i>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>