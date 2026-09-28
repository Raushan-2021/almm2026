@inject('general', 'App\Http\Controllers\Backend\Mfft\AwAnnexureController')


@php $docBaseUrl ='mfft/preview-docs/Annexure/';
$attchmentBaseUrl ='mfft/preview-docs/Attachment/';
$bomBaseUrl ='mfft/preview-docs/BOM/';
$logoBaseUrl ='mfft/preview-docs/Logo/';
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

<h4>RLMM Download Application</h4>

                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="2">Details of Wind Turbine Manufacturer and Model
                                    </th>
                                </tr>
                                <tr>
                                    <td width="30%" class="table-primary"> <strong>1 a). Name of Manufacturer</strong></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {{$appData['manufacturer_name']}}<br>
                                            </div>
                                            <div class="col-md-2">Certificate of incorporation :
                                            </div>
                                            <div class="col-md-4">
                                                @if($appData['attc_incorporation_cerificate']!='')
                                                <a target="_blank"
                                                    href="{{URL::to($attchmentBaseUrl.$appData['attc_incorporation_cerificate'])}}"
                                                    class="document text-primary">View Certificate of incorporation</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%" class="table-primary"> <strong> b). Registered Office Address
                                        </strong> <br>
                                    </td>
                                    <th>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Address: <span
                                                    class="text-primary">{{$appData['register_office_address']}}</span>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    Phone: <span
                                                        class="text-primary">{{$appData['register_office_phone']}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td width="30%" class="table-primary"> <strong> c). Communication Address </strong> <br>
                                    </td>
                                    <th>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Address: <span
                                                    class="text-primary">{{$appData['com_address']}}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone">Phone:</label>
                                                <span
                                                    class="text-primary">{{$appData['com_phone']}}</span>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td width="30%" class="table-primary"> <strong>d). Address to be mentioned in list, if enlisted </strong> <br>
                                    </td>
                                    <th>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="phone">if enlisted : </label>
                                                {{$appData['address_type']}}
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td width="30%" class="table-primary"> <strong>e). Does company's objectives include wind businesss </strong> <br></td>
                                    <th>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="phone">Does company's objectives : </label>
                                                {{$appData['is_applied']}}
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td width="30%" class="table-primary"> <strong>f). Wind Turbine Model Applied for (Model Name) </strong> <br>
                                    </td>
                                    <th>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="text">Wind Turbine Model : </label>
                                                {{$appData['turbine_model']}}
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td width="30%" class="table-primary"> <strong>g). Wind Turbine Details </strong> <br>
                                    </td>
                                    <th>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="plant_address">Rotor Diameter in m :</label>
                                                <span class="text-primary">{{$appData['rotor_diameter']}}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone">Hub Height in m :</label>
                                                <span class="text-primary">{{$appData['hub_height']}}</span>
                                            </div>
                                            <div class="col-md-6"><label for="email">Tower Type :</label>
                                                <span class="text-primary">{{$appData['tower_type']}}</span>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td width="30%" class="table-primary"> <strong>h). Authorized signatory details</strong> <br></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">Name:</label> <span class="text-primary">{{$appData['authorize_name']}}</sapn>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Designation:</label><span class="text-primary">{{$appData['authorize_designation']}}
                                                </span>
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
                                                <label for="">Phone No:</label><span class="text-primary">{{$appData['person_contact_no']}}
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">E-mail:</label><span class="text-primary">{{$appData['person_email']}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">Board Resolution / Authorization Letter :
                                            </div>
                                            <div class="col-md-6">
                                                @if($appData['authorize_letter']!='')
                                                <a target="_blank"
                                                    href="{{URL::to($attchmentBaseUrl.$appData['authorize_letter'])}}"
                                                    class="document text-primary">View Authorization Letter</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <h4>2. Collaboration / Design Ownership details</h4>
                            <!-- Collaboration / Design Ownership details -->
                            <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>2.</th>
                                            <th scope="col" colspan="2" class="text-left">Collaboration / Design Ownership details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th >S.No</th>
                                            <th >a) Module Details </th>
                                            <th >b) Whether Collaboration available for this wind turbine model </th>
                                        </tr>
                                        <tr>
                                            <td>{{1}}</td>
                                            <td>{{ $main_model }}</td>
                                            <td>{{$annexuredata['whether_enlisted']}}</td>
                                        </tr>
                                    </tbody>
                            </table>

                            <!--c) Name of Collaborator and Countr -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-dark">
                                        <th>2</th>
                                        <th scope="col" colspan="5" class="text-left">	c) Name of Collaborator and Country
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-primary">
                                        <th width="5%">S.No</th>
                                        <th width="20%">Name</th>
                                        <th width="20%">Country</th>
                                        <th width="20%">Address</th>
                                        <th width="20%">Phone</th>
                                        <th width="20%">Email</th>
                                    </tr>
                                    @php
                                        $countryCd = $annexuredata->country ?? null;
                                        $result = \App\Models\Country::select('name')->where('countrycd', $countryCd)->first();
                                    @endphp
                                    <tr>
                                        <td>{{1}}</td>
                                        <td>{{$annexuredata['name_of_company']}}</td>
                                        <td> {{ $result->name ?? '' }}</td>
                                        <td>{{$annexuredata['coll_address']}}</td>
                                        <td>{{$annexuredata['collab_phone']}}</td>
                                        <td>{{$annexuredata['collab_email']}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Indian Territory Jurisdiction & Ownership of design rights  -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-dark">
                                        <th>2.</th>
                                        <th scope="col" colspan="2" class="text-left">Indian Territory Jurisdiction & Ownership of design rights
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-primary">
                                        <th width="5%">S.No</th>
                                        <th width="20%">d) Indian Territory Jurisdiction of Collaboration and period of Collaboration</th>
                                        <th width="20%">e) Ownership of design rights of the wind turbine model available with the lndian Company</th>
                                    </tr>
                                    <tr>
                                        <td>{{1}}</td>
                                        <td>{{$annexuredata['ind_territory']}}</td>
                                        <td>{{$annexuredata['ownership_right']}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4>3. Type Certification Details</h4>
                            <!-- Type Certification Details -->
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="table-dark">
                                        <th>3.(a - e)</th>
                                        <th scope="col" colspan="6" class="text-left"> Type Certification Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th >S.No</th>
                                        <th >a). Rated Capacity of the wind turbine</th>
                                        <th>b). Model</th>
                                        <th>c). Type Certificate No</th>
                                        <th>d). Certificate Issue</th>
                                        <th>e). Certificate Valid</th>
                                        <th>c). Certificate</th>
                                    </tr>
                                    <tr>
                                        <td>{{1}}</td>
                                        <td>{{$annexuredata['wind_turbine_capacity']}}</td>
                                        <td>{{ $main_model }}</td>
                                        <td class="">{{$annexuredata['cert_attach_no']}}</td>
                                        <td class="text-center">{{$annexuredata['type_certificate_issue']}}</td>
                                        <td class="text-center">{{$annexuredata['type_certificate_valid']}}</td>
                                        <td style="border-bottom:1px solid #ccc; position: relative">
                                            {{ $annexuredata->cert_attach_no }} @if(!empty($annexuredata->new_certificate))
                                            <span >
                                                <small>
                                                <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->new_certificate) }}" class="document"> 
                                                view
                                                </a>
                                                </small>
                                                @else
                                                <small>No certificate available.</small>
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table><br>

                            <!-- Type Certification Scheme & Documents -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-dark">
                                        <th>3.(f - h)</th>
                                        <th scope="col" colspan="4" class="text-left">Type Certification Scheme & Documents
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-primary">
                                        <th width="5%">S.No</th>
                                        <th width="20%">f) Type Certification Scheme</th>
                                        <th width="20%">g) Type Certification </th>
                                        <th width="20%">h) Upload Documents  </th>
                                        <th width="20%">i) Name of Certification Body  </th>
                                    </tr>  
                                    <tr>
                                        <td>{{1}}</td>
                                        <td>{{$annexuredata['type_certificate_scheme']}}</td>
                                        <td>{{$annexuredata['type_certificate_pro']}}</td>
                                        <td>
                                            @if(!empty($annexuredata->compliance_attach))
                                            <small>
                                                <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->compliance_attach) }}" class="document ">
                                                    view
                                                </a>
                                            </small>
                                            @else
                                                <small>No certificate available.</small>
                                            @endif
                                        </td>
                                        @php
                                            $certificationBodies = [
                                                'niwe' => 'NIWE',
                                                'dnv' => 'DNV',
                                                'dewi_occ' => 'DEWI-OCC',
                                                'tuv_sud' => 'TUV SUD',
                                                'tuv_nord' => 'TUV NORD',
                                                'tuv_rheinland' => 'TUV RHEINLAND',
                                                'wind_guard' => 'WIND GUARD',
                                            ];
                                        @endphp
                                        <td>
                                            @if($annexuredata->nise_certificate_body === 'anyother')
                                                {{ $annexuredata->anyother_field ?? 'Other' }}
                                            @else
                                                {{ $certificationBodies[$annexuredata->nise_certificate_body] ?? 'N/A' }}
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table><br>

                            <!-- For Certification Bodies -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-dark">
                                        <th>3.1</th>
                                        <th scope="col" colspan="3" class="text-left">For Certification Bodies
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-primary">
                                        <th width="5%">S.No</th>
                                        <th width="20%">a. Name of the Accreditation Body</th>
                                        <th width="20%">b. Accreditation Valid upto </th>
                                        <th width="20%">b. Attach Accreditation Certificate  </th>
                                    </tr>  
                                    <tr>
                                        <td>{{1}}</td>
                                        <td>{{$annexuredata['certify_body_name']}}</td>
                                        <td>{{$annexuredata['accred_body_valid_upto']}}</td>
                                        <td>
                                            @if(!empty($annexuredata->accred_body_attach))
                                                <small>
                                                    <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->accred_body_attach) }}" class="document text-primary">
                                                        view 
                                                    </a>
                                                </small>
                                            @else
                                                <small>No certificate available.</small>
                                            @endif
                                        </td>                                               
                                    </tr>
                                </tbody>
                            </table><br>

                            <!-- Contact Person of Certification Body for authentication -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-dark">
                                        <th>3.1</th>
                                        <th scope="col" colspan="2" class="text-left">Contact Person of Certification Body for authentication
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-primary">
                                        <th width="5%">S.No</th>
                                        <th width="20%">c). Contact Person of Certification Body </th>
                                        <th width="20%">d). Contact details including E-mail </th>
                                    </tr>  
                                    <tr>
                                        <td>{{1}}</td>
                                        <td>{{$annexuredata['certify_body_phone']}}</td>
                                        <td>{{$annexuredata['certify_body_email']}}</td>
                                    </tr>
                                </tbody>
                            </table><br>

                            <h4>4. Manufacturing Facility Details</h4>
                            <!-- Manufacturing Facility Details -->
                            <table class="table text-center">
                                <thead>
                                    <tr class="table-dark">
                                        <th style="width: 5%;">4</th>
                                        <th colspan="4" class="text-left">Manufacturing Facility Details</th>
                                    </tr>
                                    <tr>
                                        <th>S.No</th>
                                        <th>a). Wind Turbine Part</th>
                                        <th>b). Number of Manufacturing Facility</th>
                                        <th>c). Location Details</th>
                                        <th>d). Wind Turbine Model</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($annexuremultipledata as $index => $row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $row->wind_turbine_part }}</td>
                                        <td>{{ $row->mfg_facility_no }}</td>
                                        <td>{{ $row->nacelle_address }}</td>
                                        <td>{{ $row->wind_turbine_model }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table><br>

                            <!-- ISO Certification Details for the Manufacturing Plant -->
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="table-dark">
                                        <th>4</th>
                                        <th scope="col" colspan="4" class="text-left">ISO Certification Details for the Manufacturing Plant
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>S.No</th>
                                        <th>d). ISO Certificate number for the Nacelle & Hub assembly</th>
                                        <th>e). Name of the ISO Certification Body</th>
                                        <th>f). ISO Certificate as per standard </th>
                                        <th>g). Validity of the ISO certificate & Certificate Document</th>
                                    </tr>
                                    <tr>
                                        <td>{{1}}</td>
                                        <td>{{$annexuredata['iso_certificate']}}</td>
                                        <td>{{$annexuredata['issuing_agency']}}</td>
                                        <td>{{$annexuredata['issuing_date']}}</td>
                                        <!-- <td>{{$annexuredata['certificate_validate']}}</td> -->
                                        <td style="position:relative">{{date("d-m-Y", strtotime($annexuredata->certificate_validate))}} <span style="position: absolute;
                                            right: 0;
                                            top: 0px;"> 
                                            @if(!empty($annexuredata->iso_certificate_doc))
                                            <small>
                                            @php
                                            $docUrl = url('storage/documents/' . $annexuredata->iso_certificate_doc);
                                            @endphp
                                            <a target="_blank" href="{{ $docUrl }}">
                                                <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                            </a>
                                            </small>
                                            @else
                                                <small>No certificate </small>
                                            @endif</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table><br>

                            <!-- The Accreditation Body -->
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="table-dark">
                                        <th>4</th>
                                        <th scope="col" colspan="5" class="text-left">The Accreditation Body
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>S.No</th>
                                        <th>h). Name of the Accreditation Body</th>
                                        <th>i). Accreditation Valid upto</th>
                                        <th>i). Attach Accreditation Certificate </th>
                                        <th>j). Contact Person of Certification Body</th>
                                        <th>k). Contact details including E-mail</th>
                                    </tr>
                                    <tr>
                                        <td>{{1}}</td>
                                        <td>{{$annexuredata['iso_name_body']}}</td>
                                        <td>{{$annexuredata['accred_date']}}</td>
                                        <td><?php if(isset($annexuredata->accred_cert_doc) && $annexuredata->accred_cert_doc){ ?>
                                                <small>
                                                    <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->accred_cert_doc) }}" class="document">
                                                        View Certificate
                                                    </a>
                                                </small>
                                                <?php } ?>
                                        </td>
                                        <td>{{$annexuredata['iso_phone_body']}}</td>
                                        <td>{{$annexuredata['issuing_date']}}</td>
                                    </tr>
                                </tbody>
                            </table><br>

                            <h4>5. Affidavit and Inemnity</h4>
                            <!-- Affidavit & Indemnity -->
                            <table class="table table-bordered">
                                <tr class="table-dark">
                                        <th>5.a</th>
                                        <th scope="col"  class="text-left">Affidavit</th>
                                </tr>
                                <tr>
                                    <th>Upload Affidavit :</th>
                                    <td>
                                        @if($appData['signatory_document']!='')
                                        <a target="_blank"
                                            href="{{URL::to($attchmentBaseUrl.$appData['signatory_document'])}}"
                                            class="document text-primary">View File</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Affidavit Provided :</th>
                                    <td>{{$appData['affidavit']}}</td>
                                </tr>
                                <tr class="table-dark">
                                        <th>5.b</th>
                                        <th scope="col"  class="text-left"> Indemnity
                                        </th>
                                </tr>
                                <tr>
                                    <th>Upload Indemnity :</th>
                                    <td>@if($appData['signatory_document']!='')
                                        <a target="_blank"
                                            href="{{URL::to($attchmentBaseUrl.$appData['indemnity_document'])}}"
                                            class="document text-primary">View File</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Indemnity Provided :</th>
                                    <td>{{$appData['indemnity']}}</td>
                                </tr>
                            </table>

                                            
                
