@inject('general', 'App\Http\Controllers\Backend\RlmmMnre\MainController')

@extends('layouts.masters.backend')
@section('content')
@section('title', 'Applications Detail')
@php $docBaseUrl ='mnre_wind_users/preview-docs/Annexure/';
$attchmentBaseUrl ='mnre_wind_users/preview-docs/Attachment/';
$bomBaseUrl ='mnre_wind_users/preview-docs/BOM/';
$logoBaseUrl ='mnre_wind_users/preview-docs/Logo/';
@endphp

<?php
use App\Models\Module;
use App\Models\RlmmForwardDetail;
use App\Models\RlmmMomAppvdMnre;
?>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">

                <div class="col-md-12">
                    <a onclick="history.back()" class="btn btn-warning"><i
                            class="bi bi-arrow-bar-left"></i>Back</a>
                        <?php
                        $appid=$appData['id'];

                        $forward_sttaus= RlmmForwardDetail::where('application_id',$appid)->where('user_type','niwe')->where('forward_to','mnre')->first();
                        if(empty($forward_sttaus))
                        {
                        ?>

                        @if($appData['forward_status']=='mnre')
                            <button type="button" class="btn btn-primary btn-sm btn-block btn-lg" data-bs-toggle="modal"
                                data-bs-target="#myModal">Forward to NIWE <i class="bi bi-chevron-bar-contract"
                                    aria-hidden="true"></i></button>
                                    
                            <button type="button" class="btn btn-danger btn-sm btn-block btn-lg" data-bs-toggle="modal"
                                data-bs-target="#correctionBtn">Send Back for Correction <i class="bi bi-chevron-bar-contract"
                                    aria-hidden="true"></i></button>
                        @endif

                        <?php
                        }
                        else{
                            $isexit=RlmmMomAppvdMnre::where('application_id',$appid)->first();
                            if(empty($isexit))
                            {
                        ?>

                        @if(!$appData['is_approved'])
                            <button type="button" class="btn btn-success btn-sm btn-block btn-lg"
                                data-bs-toggle="modal" data-bs-target="#approvedmnre"
                                data-momid="{{@$appData['id']}}"> Committee Approval </button>
                        @endif

                        <?php
                            }
                        }
                        ?>

                    <table class="table table-bordered">
                        <tr>
                            <th colspan="2">Details of Wind Turbine Manufacturer and Model
                            </th>
                        </tr>
                        <tr>
                            <td width="30%" class="table-primary"> <strong>1 a). Name of Manufacturer</strong>
                            </td>
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
                            <td width="30%" class="table-primary"> <strong> b). Registered Office Address </strong> <br> </td>
                            <th>
                                <div class="row">
                                    <div class="col-md-6">
                                        Address: <span class="text-primary">{{$appData['register_office_address']}}</span>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            Phone: <span class="text-primary">{{$appData['register_office_phone']}}</span>
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td width="30%" class="table-primary"> <strong> c). Communication Address </strong> <br></td>
                            <th>
                                <div class="row">
                                    <div class="col-md-6">
                                        Address: <span class="text-primary">{{$appData['com_address']}}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone">Phone:</label>
                                        <span class="text-primary">{{$appData['com_phone']}}</span>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td width="30%" class="table-primary"> <strong> d). Address to be mentioned in list, if enlisted </strong> <br></td>
                            <th>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="phone">if enlisted : </label> 
                                        <span class="text-primary"> {{$appData['address_type']}} </span>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td width="30%" class="table-primary"> <strong> e). Does company's objectives include wind businesss </strong> <br>
                            </td>
                            <th>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="phone">Does company's objectives : </label>
                                        <span class="text-primary">{{$appData['is_applied']}} </span>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td width="30%" class="table-primary"> <strong> f). Wind Turbine Model Applied for (Model Name) </strong> <br> </td>
                            <th>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="text">Wind Turbine Model : </label>
                                        <span class="text-primary">{{$appData['turbine_model']}}</span>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td width="30%" class="table-primary"> <strong> g). Wind Turbine Details </strong> <br></td>
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
                            <td width="30%" class="table-primary"> <strong> h). Authorized signatory details</strong> <br></td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Name:</label> <span class="text-primary">{{$appData['authorize_name']}}</sapn>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Designation:</label><span class="text-primary">{{$appData['authorize_designation']}}</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%" class="table-primary"> <strong></strong> <br></td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""> Phone No : </label><span class="text-primary"> {{$appData['person_contact_no']}}
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""> E-mail : </label><span class="text-primary"> {{$appData['person_email']}}
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Board Resolution / Authorization Letter : </div>
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

                    <!-- Module's Start-->
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                                <h2 class="accordion-header" id="headingModule">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOneModule" aria-expanded="true"
                                        aria-controls="collapseOneModule">
                                        <h4>2. Collaboration / Design Ownership details</h4>
                                    </button>
                                </h2>
                                <div id="collapseOneModule" class="accordion-collapse collapse show"
                                    aria-labelledby="headingModule" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        <!-- Collaboration / Design Ownership details -->
                                        <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr class="table-dark">
                                                        <th>2.</th>
                                                        <th scope="col" colspan="13" class="text-left">Collaboration / Design Ownership details
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="table-primary" >
                                                        <th rowspan="2" style="width:80px">S.No</th>
                                                        <th rowspan="2">a) Module Details </th>
                                                        <th rowspan="2">b) Whether Collaboration available for this wind turbine model </th>
                                                    </tr>
                                                    <tr></tr>
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
                                                    <th scope="col" colspan="13" class="text-left">	c) Name of Collaborator and Country
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="table-primary">
                                                    <th width="5%">S.No</th>
                                                    <th width="20%">Name</th>
                                                    <th width="20%">Country</th>
                                                    <th width="20%">Address</th>
                                                    <th width="15%">Phone</th>
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
                                                    <th scope="col" colspan="13" class="text-left">Indian Territory Jurisdiction & Ownership of design rights
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="table-primary">
                                                    <th width="5%">S.No</th>
                                                    <th width="50%">d) Indian Territory Jurisdiction of Collaboration and period of Collaboration</th>
                                                    <th width="45%">e) Ownership of design rights of the wind turbine model available with the lndian Company</th>
                                                    
                                                </tr>
                                            
                                                <tr>
                                                <td>{{1}}</td>
                                                <td>{{$annexuredata['ind_territory']}}</td>
                                                <td>{{$annexuredata['ownership_right']}}</td>
                                                </tr>
                                            
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <h4>3. Type Certification Details</h4>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    <!-- Type Certification Details -->
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>3.(a - e)</th>
                                                <th scope="col" colspan="13" class="text-left"> Type Certification Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-primary">
                                                <th width="5%">S.No</th>
                                                <th width="15%">a). Rated Capacity of the wind turbine</th>
                                                <th width="20%">b). Model</th>
                                            
                                                <th width="15%">c). Type Certificate No</th>
                                                <th width="15%">d). Certificate Issue</th>
                                                <th width="15%">e). Certificate Valid</th>
                                                <th width="15%">c). Certificate</th>
                                            </tr>
                                            <tr>
                                                <td>{{1}}</td>
                                                <td>{{$annexuredata['wind_turbine_capacity']}}</td>
                                                <td>{{ $main_model }}</td>
                                                <td class="">{{$annexuredata['cert_attach_no']}}</td>
                                                <td class="text-center">{{$annexuredata['type_certificate_issue']}}</td>
                                                <td class="text-center">{{$annexuredata['type_certificate_valid']}}</td>
                                                <td> @if(!empty($annexuredata->new_certificate))
                                                    <small>
                                                        <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->new_certificate) }}" class="document text-primary">
                                                            <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                        </a>
                                                    </small>
                                                    @else
                                                        <small>No certificate available.</small>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table><br>

                                    <!-- Type Certification Scheme & Documents -->
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>3.(f - h)</th>
                                                <th scope="col" colspan="13" class="text-left">Type Certification Scheme & Documents
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-primary">
                                                <th width="5%">S.No</th>
                                                <th width="25%">f) Type Certification Scheme</th>
                                                <th width="25%">g) Type Certification </th>
                                                <th width="25%">h) Upload Documents  </th>
                                                <th width="20%">i) Name of Certification Body  </th>
                                            </tr>  
                                            <tr>
                                                <td>{{1}}</td>
                                                <td>{{$annexuredata['type_certificate_scheme']}}</td>
                                                <td>{{$annexuredata['type_certificate_pro']}}</td>
                                                <td><table width="100%">
                                                    @if(!empty($annexuredata->compliance_attach))
                                                        <small>
                                                            <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->compliance_attach) }}" class="document text-primary">
                                                                <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                            </a>
                                                        </small>
                                                    @else
                                                        <small>No certificate available.</small>
                                                    @endif
                                                </table>
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
                                                <th scope="col" colspan="13" class="text-left">For Certification Bodies
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-primary">
                                                <th width="5%">S.No</th>
                                                <th width="30%">a. Name of the Accreditation Body</th>
                                                <th width="30%">b. Accreditation Valid upto </th>
                                                <th width="35%">b. Attach Accreditation Certificate  </th>
                                            </tr>  
                                            <tr>
                                                <td>{{1}}</td>
                                                <td>{{$annexuredata['certify_body_name']}}</td>
                                                <td>{{$annexuredata['accred_body_valid_upto']}}</td>
                                                <td><table width="100%">
                                                    @if(!empty($annexuredata->accred_body_attach))
                                                        <small>
                                                            <a target="_blank" href="{{ URL::to($docBaseUrl . $annexuredata->accred_body_attach) }}" class="document text-primary">
                                                                <i class="bi bi-file-pdf fa-2x text-danger"></i>
                                                            </a>
                                                        </small>
                                                    @else
                                                        <small>No certificate available.</small>
                                                    @endif
                                                </table></td>
                                            
                                            </tr>
                                        </tbody>
                                    </table><br>

                                    <!-- Contact Person of Certification Body for authentication -->
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>3.1</th>
                                                <th scope="col" colspan="13" class="text-left">Contact Person of Certification Body for authentication
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-primary">
                                                <th width="5%">S.No</th>
                                                <th width="45%">c). Contact Person of Certification Body </th>
                                                <th width="50%">d). Contact details including E-mail </th>
                                            </tr>  
                                            <tr>
                                                <td>{{1}}</td>
                                                <td>{{$annexuredata['certify_body_phone']}}</td>
                                                <td>{{$annexuredata['certify_body_email']}}</td>
                                            </tr>
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
                                    <h4>4. Manufacturing Facility Details</h4>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <!-- Manufacturing Facility Details -->
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>4</th>
                                                <th scope="col" colspan="13" class="text-left">Manufacturing Facility Details
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr class="table-primary">
                                                <th width="5%" >S.No</th>
                                                <th width="20%">a). Wind Turbine Part</th>
                                            
                                                <th width="25%">b). Number of Manufacturing Facility</th>
                                                <th width="25%">c). Location Details </th>
                                                <th width="25%">d). Wind Turbine Model</th>
                                            </tr>
                                            <tr>
                                                 @foreach ($annexuremultipledata as $index => $row)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $row->wind_turbine_part }}</td>
                                                    <td>{{ $row->mfg_facility_no }}</td>
                                                    <td>{{ $row->nacelle_address }}</td>
                                                    <td>{{ $row->wind_turbine_model }}</td>
                                                </tr>
                                                 @endforeach
                                            </tr>
                                        </tbody>
                                    </table><br>

                                    <!-- ISO Certification Details for the Manufacturing Plant -->
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>4</th>
                                                <th scope="col" colspan="13" class="text-left">ISO Certification Details for the Manufacturing Plant
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-primary">
                                                <th width="5%">S.No</th>
                                                <th width="20%">d). ISO Certificate number for the Nacelle & Hub assembly</th>
                                           
                                                <th width="25%">e). Name of the ISO Certification Body</th>
                                                <th width="25%">f). ISO Certificate as per standard </th>
                                                <th width="25%">g). Validity of the ISO certificate & Certificate Document</th>
                                                 
                                            </tr>
                                            <tr>
                                                <td>{{1}}</td>
                                                <td>{{$annexuredata['iso_certificate']}}</td>
                                                <td>{{$annexuredata['issuing_agency']}}</td>
                                                <td>{{$annexuredata['issuing_date']}}</td>
                                                <!-- <td>{{$annexuredata['certificate_validate']}}</td> -->
                                                <td style="position:relative">{{date("d-m-Y", strtotime($annexuredata->certificate_validate))}} <span style="    padding-left: 10px;"> 
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
                                                <th scope="col" colspan="13" class="text-left">The Accreditation Body
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-primary">
                                                <th width="5%">S.No</th>
                                                <th width="15%">h). Name of the Accreditation Body</th>
                                           
                                                <th width="20%">i). Accreditation Valid upto</th>
                                                <th width="20%">i). Attach Accreditation Certificate </th>
                                                <th width="20%">j). Contact Person of Certification Body</th>
                                                <th width="20%">k). Contact details including E-mail</th>

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
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Affidavit and Inemnity -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    <h4>5. Affidavit and Inemnity</h4>
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <!-- Affidavit & Indemnity -->
                                    <table class="table table-bordered">
                                        <tr class="table-dark">
                                                <th>5.a</th>
                                                <th scope="col" colspan="13" class="text-left">Affidavit
                                                </th>
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
                                                <th scope="col" colspan="13" class="text-left"> Indemnity
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
                                    
                                    <!-- <table class="table table-bordered">
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
                                    </table> -->
                                </div>
                            </div>
                        </div>
                    </div><br>

                    </div>
                </div>
            </div>
        </div>

<!-- Forward to Niwe  -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Forward to NIWE</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <form action="{{ url('mnre_wind_users/forwardto') }}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ @$appData['id']}}">
                    <div class="form-group">
                        <label for="forward_status" class="col-form-label">Forward Status:</label>
                        <select name="forward_status" id="forward_status">
                            <option value="niwe">NIWE</option>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Forward</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Forward to User for correction -->
<div class="modal" id="correctionBtn">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Send Back for Correction</h4>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>
            <!-- Modal body -->
            <form action="{{ url('mnre_wind_users/forwardto') }}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ @$appData['id']}}">
                    <div class="form-group">
                        <label for="forward_status" class="col-form-label">Correction Status:</label>
                        <select name="forward_status" id="forward_status">
                           <option value="return_mnre">Query to Applicant</option>
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

      
<!-- Approve Application for MoM -->
<div class="modal fade" id="approvedmnre" tabindex="-1" aria-labelledby="approvedLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="approveForm" action="{{ url('mnre_wind_users/approvemom') }}" method="POST" enctype="multipart/form-data" >
        @csrf

        <input type="hidden" name="mom_id" id="modalMomId">
        <div class="modal-header">
          <h5 class="modal-title" id="approvedLabel">Committee Approval Application</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <label for="approvalMsg" class="form-label">Committee Approval message:</label>
          <textarea class="form-control" id="approvalMsg" name="approval_message" rows="3" required></textarea>

          <label for="approvalFile" class="form-label mt-3">Upload Approval Document:</label>
          <input type="file" class="form-control" id="approvalFile" name="approval_file" required>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- <script>
  document.getElementById('approveForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent actual form submission
    const message = document.getElementById('approvalMsg').value;
    
    // Simulate sending approval (e.g., AJAX call or fetch to backend here)
    alert("Application approved with message:\n" + message);

    // Close modal after submission
    const modal = bootstrap.Modal.getInstance(document.getElementById('approvedmnre'));
    modal.hide();

    // Optionally, update UI or mark the application as approved
    // e.g., disable the button, change text, etc.
  });
</script> -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('approvedmnre');
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const momId = button.getAttribute('data-momid');

            // Set mom_id in the hidden input
            const momIdInput = modal.querySelector('#modalMomId');
            momIdInput.value = momId;
        });
    });
</script>

@endsection