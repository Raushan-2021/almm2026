@inject('general', 'App\Http\Controllers\Backend\Users\MainController')
@extends('layouts.masters.backend')
@section('title', 'New Application')
@section('content')

@php $docBaseUrl ='users/preview-docs/Certificate/';
$logoBaseUrl ='users/preview-docs/Logo/';
$attcBaseUrl ='users/preview-docs/Attachment/';
@endphp
<style>
    .comn_drop_shdow{border: 1px solid #dedede;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 0 5px #dedede;}
    .cmn_form_bg{border: 1px solid #dedede;
    padding: 8px 8px 10px 8px;
    border-radius: 5px;
    background: #fdfdfd;}
    
.padding20{padding: 10px 20px;}
</style>
<div class="row">

    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        
        <div class="comn_drop_shdow">
            <div class="container-fluid">
                <div class="row">
                <div class=" text-right pt-2" >
                        
                        <small class="text-danger  ">* All Fields are mandatory</small>
                    </div>
                    

                    <form action="{{URL::to('/users/new-application')}}" method="POST"
                    enctype="multipart/form-data" id="formFileAjax">

                    <div class="row">
                                              
                                                <div class="col-xl-12 padding20">
                                                    <div class="row cmn_form_bg">
                                                        <div class="col-lg-4">
                                                            <label class="pb-2">Type of Application <small
                                                            class="text-danger"> * </small></label>


                                                            <select name="application_type" class="form-control  " id="application_type">
                                                                        <option value="">Please Select</option>
                                                                    <option value="1" <?php if(isset($appData->application_type)){ ?> {{ $appData->application_type == '1' ? 'selected' : '' }}  <?php } ?>>Fresh / New Application</option>
                                                                    <option value="2" <?php if(isset($appData->application_type)){ ?> {{ $appData->application_type == '2' ? 'selected' : '' }}  <?php } ?>>Inclusion of additional models for already enlisted unit</option>
                                                                    <option value="3" <?php if(isset($appData->application_type)){ ?> {{ $appData->application_type == '3' ? 'selected' : '' }}  <?php } ?>>Renewal of ALMM enlistment</option>
                                                                    <option value="4" <?php if(isset($appData->application_type)){ ?> {{ $appData->application_type == '4' ? 'selected' : '' }}  <?php } ?>>Enlistment for co-branded models</option>
                                                                    <option value="5" <?php if(isset($appData->application_type)){ ?> {{ $appData->application_type == '5' ? 'selected' : '' }}  <?php } ?>>Capacity Addition</option>
                                                                    <option value="6" <?php if(isset($appData->application_type)){ ?> {{ $appData->application_type == '6' ? 'selected' : '' }}  <?php } ?>>Any Other</option>
                                                            </select>


                                                
                                                        </div>
                                                        <div class="col-lg-4 textbox-container"
                                                        <?php if(isset($appData->application_type) && $appData->application_type == '6'){
                                                         echo 'style=display:block';
                                                        }else{
                                                            echo 'style=display:none';
                                                        } ?>
                                                    >
                                                        <label class="pb-2 pt-2">Type of Application Details<small
                                                            class="text-danger"> * </small></label>
                                                                <textarea name="other_application_type" id="other_application_type"
                                                                cols="10" rows="2" class="form-control textbox-container" maxlength="50"
                                                                placeholder="Type of Application Details"    <?php if(isset($appData->application_type) && $appData->application_type == '6'){
                                                                  echo 'style=display:block';
                                                        }else{
                                                            echo 'style=display:none';
                                                        } ?>>{{ $appData->other_application_type ?? old('other_application_type') }}</textarea>
                                                            @error('other_application_type') 
                                                            <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                            <i class="word-count" id="reg_address_char"></i>

                                                        </div>

                                                        <div class="col-lg-4">
                                                        <label class="pb-2 pt-2">Additional Informatiom, if any</label>
                                                                <textarea name="additional_information" id="additional_information"
                                                                cols="10" rows="2" class="form-control" maxlength="100"
                                                                >{{ $appData->additional_information ?? old('additional_information') }}</textarea>
                                                            @error('additional_information') 
                                                            <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                            <i class="word-count" id="additional_information_char"></i>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                    
                <h4 class=" pt-2 pb-0 " style="color: #015296; font-weight: 600; padding-left:20px">1.0 Details of Solar Photovoltaic (PV) Module Manufacturer and Model </h4>
                    <div class="col-lg-12">
                        
                        <div class="box-body">
                   
                                @csrf
                                @method('POST')

                                            <div class="row">
                                                <div class="col-xl-12"><strong>1.1 Name of Company <small
                                                class="text-danger"> * </small></strong></div>
                                                <div class="col-xl-12 padding20">
                                                    <div class="row cmn_form_bg">
                                                        <div class="col-lg-3">
                                                            <label class="pb-2">Company Name <small
                                                            class="text-danger"> * </small></label>
                                                            <input type="text" name="manufacturer_name"
                                                                placeholder="Name Of Company" id="manufacturer_name"
                                                                class="form-control" maxlength="70"
                                                                value="{{ $appData->manufacturer_name ?? old('manufacturer_name') }}">
                                                        </div>
                                                        <div class="col-lg-9">
                                                            @if(!empty($appData->attc_incorporation_cerificate))
                                                            <span><a target="_blank" style="float:right"
                                                                    href="{{URL::to($attcBaseUrl.$appData->attc_incorporation_cerificate)}}"
                                                                    class="document1 text-danger">View Document</a></span>
                                                            @endif
                                                            <label class="pb-2" for="">Certificate of Incorporation <small
                                                                    class="text-primary">(Max.
                                                                    2MB and PDF Format
                                                                    Only)</small><small
                                                                    class="text-danger"> * </small></label>
                                                            <input type="file" name="certificate_incorporation"
                                                                id="certificate_incorporation"
                                                                class="form-control pdf_file_2mb mb-0">
                                                            <small class="text-primary">(In case of Indian company, attach a copy of Certificate of Incorporation 
                                                                issued by Registrar of Companies)</small>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12"> <strong>1.2 Registered Office Address of the Company <small
                                                class="text-danger">* </small></strong></div>
                                                <div class="col-xl-12 padding20">
                                                    <div class="row cmn_form_bg">
                                                        <div class="col-xl-4">
                                                            <label class="pb-2 pt-2">Address<small
                                                            class="text-danger"> * </small></label>
                                                                <textarea name="register_office_address" id="register_office_address"
                                                                cols="10" rows="2" class="form-control" maxlength="250"
                                                                placeholder="Registered Office Address of the Manufacturer">{{ $appData->register_office_address ?? old('register_office_address') }}</textarea>
                                                            @error('register_office_address') <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                            <i class="word-count" id="reg_address_char"></i>
                                                        </div>

                                                        <div class="col-lg-2">
                                                    
                                                                <label class="pb-2 pt-2" for="register_office_phone">Phone <small class="text-danger">*</small></label>
                                                            
                                                            <input type="number" name="register_office_phone" id="register_office_phone" 
                                                                placeholder="Contact Number" class="form-control"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" 
                                                                pattern="[0-9]{1,10}"  
                                                                value="{{ $appData->register_office_phone ?? old('register_office_phone') }}">
                                                            @error('register_office_phone')
                                                                <span class="invalid-feedback custom_valid_class">
                                                                    {{ $message }}
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label class="pb-2 pt-2" for="email">Email id <small
                                                                class="text-danger">* </small></label>
                                                                <input type="email" name="register_office_email"
                                                                    id="register_office_email" class="form-control"
                                                                    placeholder="Email Address"
                                                                    value="{{ $appData->register_office_email ?? old('register_office_email') }}">
                                                                @error('register_office_email') <span
                                                                    class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} </span> @enderror
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label class="pb-2 pt-2" for="Longitude">Country <small
                                                            class="text-danger">* </small></label>
                                                            <select name="reg_country" id="reg_country">
                                                                <option value="">Select</option>
                                                                @foreach($countries as $country)
                                                                <option value="{{$country->countrycd}}" @if((!Empty($appData->
                                                                    country) && $appData->reg_country==$country->countrycd) || ($country->countrycd == '99' && empty($appData->com_country)))
                                                                    selected
                                                                    @endif >{{$country->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('country') <br> <br> <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                        </div>
                                                    </div>
            
                                                </div>
                                                
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12"> <strong>1.3 Communication Address of the
                                                Company <small
                                                class="text-danger"> * </small></strong></div>
                                                <div class="col-xl-12 padding20">
                                                    <div class="row cmn_form_bg">
                                                        <div class="col-xl-4">
                                                            <label class="pb-2 pt-2">Address <small
                                                            class="text-danger"> * </small></label>
                                                            <textarea name="com_address" id="com_address" cols="10" rows="2"
                                                                    class="form-control" maxlength="150"
                                                                    placeholder="Communication Office Address of the Manufacturer">{{ $appData->com_address ?? old('com_address') }}</textarea>
                                                                @error('com_address') <span class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} </span> @enderror
                                                                <i class="word-count" id="com_address_char"></i>
                                                        </div>

                                                        <div class="col-lg-2">
                                                                <label class="pb-2 pt-2" for="register_office_phone">Phone <small class="text-danger">*</small></label>
                                                                <input type="number" name="com_phone" id="com_phone"
                                                                    class="form-control" placeholder="Contact Number"  oninput="javascript: if (this.value.length > 
                                                                    this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" 
                                                                    pattern="[0-9]{1,10}"  
                                                                    value="{{ $appData->com_phone ?? old('com_phone') }}">
                                                                @error('com_phone') <span
                                                                    class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} </span> @enderror
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label class="pb-2 pt-2" for="email">Email id <small
                                                                class="text-danger">* </small></label>
                                                                <input type="email" name="com_email" id="com_email"
                                                                    class="form-control" placeholder="Email Address"
                                                                    value="{{ $appData->com_email ?? old('com_email') }}">
                                                                @error('com_email') <span
                                                                    class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} </span> @enderror
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label class="pb-2 pt-2" for="Longitude">Country <small class="text-danger">* </small></label>
                                                            <select name="com_country" id="com_country">
                                                                <option value="">Select</option>
                                                                @foreach($countries as $country)
                                                                    <option value="{{$country->countrycd}}" 
                                                                        @if((!empty($appData->com_country) && $appData->com_country == $country->countrycd) || ($country->countrycd == '99' && empty($appData->com_country)))
                                                                            selected
                                                                        @endif
                                                                    >
                                                                        {{$country->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('country') 
                                                                <br> 
                                                                <br> 
                                                                <span class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} 
                                                                </span> 
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12"> <strong>1.4 Location/Address of Manufacturing Plant<small
                                                class="text-danger"> * </small></strong></div>
                                                <div class="col-xl-12 padding20">
                                                    <div class="row cmn_form_bg">
                                                        <div class="col-xl-4">
                                                            <label class="pb-2 pt-2">Address <small
                                                            class="text-danger"> * </small></label>
                                                            <textarea name="plant_address" id="plant_address" cols="10" rows="2"
                                                                class="form-control" 
                                                                placeholder="Address of Manufacturing Plant">{{ $appData->plant_address ?? old('plant_address') }}</textarea>
                                                            @error('plant_address') <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                            <i class="word-count" id="plant_address_char"></i>
                                                        </div>

                                                        <div class="col-lg-2">
                                                                <label class="pb-2 pt-2" for="register_office_phone">Latitude <small class="text-danger">*</small></label>
                                                                <input type="text" name="plant_latitude" id="plant_latitude"
                                                                class="form-control" placeholder="Plant Latitude(Format XX.XXXXXX)"
                                                                value="{{ $appData->plant_latitude ?? old('plant_latitude') }}">
                                                            @error('plant_latitude') <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                                <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                            class="text-primary" target="_blank">Click Here to get
                                                            Latitude/Longitude/GPS</a>
                                                        </div>

                                                        <div class="col-lg-3">
                                                                <label class="pb-2 pt-2" for="email">Longitude <small
                                                                    class="text-danger">* </small></label>
                                                                    <input type="text" name="plant_longitude" id="plant_longitude"
                                                                class="form-control" placeholder="Plant Longitude(Format XX.XXXXXX)"
                                                                value="{{ $appData->plant_longitude ?? old('plant_longitude') }}">
                                                            @error('plant_longitude') <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label class="pb-2 pt-2" for="gps_latitude">Latitude Direction for North/South <small class="text-danger">* </small></label>
                                                            <div class="d-flex">
                                                                <!-- North Dropdown -->
                                                                <select name="gps_latitude" id="gps_latitude" class="form-control">
                                                                    <option value="north" {{ old('gps_latitude', $appData->gps_latitude ?? '') == 'north' ? 'selected' : '' }}>North</option>
                                                                    <option value="south" {{ old('gps_latitude', $appData->gps_latitude ?? '') == 'south' ? 'selected' : '' }}>South</option>
                                                                </select>
                                                            </div>

                                                            @error('gps_latitude')
                                                            <span class="invalid-feedback custom_valid_class">{{ $message }}</span>
                                                            @enderror
                                                    
                                                        </div>

                                                        <!-- <div class="col-lg-3">
                                                                <label class="pb-2 pt-2" for="gps_latitude">GPS Coordinates North/South <small
                                                                class="text-danger">* </small></label>
                                                                <input type="text" name="gps_latitude" id="gps_latitude"
                                                                class="form-control" placeholder="GPS Coordinates North/South"
                                                                value="{{ $appData->gps_latitude ?? old('gps_latitude') }}">
                                                            @error('gps_latitude') <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                        </div> -->

                                                        <!-- <div class="col-xl-3">
                                                            <label class="pb-2 pt-2">GPS Coordinates East/West<small
                                                            class="text-danger"> * </small></label>
                                                                <input type="text" name="gps_longitude" id="gps_longitude"
                                                                class="form-control" placeholder="GPS Coordinates East/West"
                                                                value="{{ $appData->gps_longitude ?? old('gps_longitude') }}">
                                                            @error('gps_longitude') <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                        </div> -->
                                                        <div class="col-xl-3">
                                                            <label class="pb-2 pt-2">Longitude Direction for East/West <small class="text-danger"> * </small></label>
                                                            <div class="d-flex">
                                                                <!-- East/West Dropdown -->
                                                                <select name="gps_longitude" id="gps_longitude" class="form-control">
                                                                    <option value="east" {{ old('gps_longitude', $appData->gps_longitude ?? '') == 'east' ? 'selected' : '' }}>East</option>
                                                                    <option value="west" {{ old('gps_longitude', $appData->gps_longitude ?? '') == 'west' ? 'selected' : '' }}>West</option>
                                                                </select>
                                                                <!-- Longitude Input
                                                                <input type="number" name="gps_longitude_value" id="gps_longitude_value" class="form-control ms-2"
                                                                    placeholder="Longitude" value="{{ old('gps_longitude_value', $appData->gps_longitude_value ?? '') }}"> -->
                                                            </div>
                                                            @error('gps_longitude')
                                                            <span class="invalid-feedback custom_valid_class">{{ $message }}</span>
                                                            @enderror
                                                            
                                                        </div>


                                                        <div class="col-lg-3">
                                                    
                                                                <label class="pb-2 pt-2" for="register_office_phone">Phone <small class="text-danger">*</small></label>
                                                                <input type="number" name="plant_phone" id="plant_phone" oninput="javascript: if (this.value.length > 
                                                                this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" 
                                                                    pattern="[0-9]{1,12}" 
                                                                placeholder="Contact/Phone Number" 
                                                                    class="form-control"
                                                                    value="{{ $appData->plant_phone ?? old('plant_phone') }}" 
                                                                    >
                                                                @error('plant_phone') <span
                                                                    class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} </span> @enderror
                                                                            
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label class="pb-2 pt-2" for="email">Email id <small
                                                                class="text-danger">* </small></label>
                                                                <input type="email" name="plant_email" id="plant_email"
                                                                class="form-control" placeholder="Email Address"
                                                                value="{{ $appData->plant_email ?? old('plant_email') }}">
                                                            @error('plant_email') <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label class="pb-2 pt-2" for="Longitude">Country <small
                                                            class="text-danger">* </small></label>
                                                            <select name="country" id="country">
                                                                <option value="">Select</option>
                                                                @foreach($countries as $country)
                                                                <option value="{{$country->countrycd}}" @if((!Empty($appData->
                                                                    country) && $appData->country==$country->countrycd) || ($country->countrycd == '99' && empty($appData->com_country)))
                                                                    selected selected
                                                                    @endif >{{$country->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('country') <br> <br> <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                          <!--  <div class="row">
                                                <div class="col-xl-12"> <strong>1.5 Address to be mentioned in list, if enlisted<small
                                                class="text-danger"> * </small></strong></div>
                                                <div class="col-xl-6 padding20">
                                                    <div class="row cmn_form_bg">
                                                        <div class="form-group">
                                                            <!-- <label><strong>Select Address Type</strong> <small class="text-danger">*</small></label><br>
                                                            <input type="radio" name="address_type" value="communication" id="address_type_communication"
                                                        
                                                            @if(isset($appData->address_type) && ($appData->address_type == 'communication')) checked @endif>
                                                            <label for="address_type_communication">Communication Address</label><br>
                                                            <input type="radio" name="address_type" value="registered" id="address_type_registered" 
                                                             @if(isset($appData->address_type) && ($appData->address_type == 'registered' )) checked @endif>
                                                            <label for="address_type_registered">Registered Office Address</label> -->
                                                       <!--     <label for="">Registered Office Address : -  {{ $appData->plant_address ?? old('plant_address') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->

                                       <!--     <div class="row">
                                                <div class="col-xl-12"> <strong>1.6 Whether applying for more than one Models of PV Modules<small
                                                class="text-danger"> * </small></strong></div>
                                                <div class="col-xl-6 padding20">
                                                    <div class="row cmn_form_bg">
                                                        <div class="form-group">
                                                                <label><strong>Select Whether applying for more than one Models of PV Modules </strong> <small class="text-danger">*</small></label><br>
                                                            <select name="is_applied" id="is_applied">
                                                                <option value="">Select Whether applying for more than one Models of PV Modules</option>
                                                                <option value="Yes" @if(($appData->is_applied ?? '')=='Yes')
                                                                    selected @endif>Yes</option>
                                                                <option value="No" @if(($appData->is_applied ?? '')=='No') selected
                                                                    @endif>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                           
                                            <!-- <div class="row">
                                                <div class="col-xl-12">
                                                <h4 class=" pt-2 pb-0 " style="color: #015296; font-weight: 600;">Authorized signatory details  </h4>
                                                </div>
                                            </div> -->

                                            <div class="row">
                                                <div class="col-xl-12"> <strong> 2.0 Authorized signatory details <small
                                                class="text-danger"> * </small></strong></div>
                                                <div class="col-xl-12 padding20">
                                                    <div class="row cmn_form_bg">
                                                        

                                                        <div class="col-lg-3">
                                                    
                                                                <label class="pb-2 pt-2" for="register_office_phone">Name <small class="text-danger">*</small></label>
                                                                <input type="text" name="authorize_name" id="authorize_name"
                                                                    maxlength="50" placeholder="Authorized Signatory Name"
                                                                    class="form-control"
                                                                    value="{{ $appData->authorize_name ?? old('authorize_name') }}">
                                                                @error('authorize_name') <span
                                                                    class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} </span> @enderror
                                                                
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label class="pb-2 pt-2" for="email">Designation<small
                                                                class="text-danger">* </small></label>
                                                                <input type="text" name="authorize_designation"
                                                                    id="authorize_designation" maxlength="50"
                                                                    placeholder="Designation" class="form-control"
                                                                    value="{{ $appData->authorize_designation ?? old('authorize_designation') }}">
                                                                @error('authorize_designation') <span
                                                                    class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} </span> @enderror
                                                        </div>

                                                        
                                                        <div class="col-lg-3">
                                                            <label class="pb-2 pt-2" for="email">Phone No<small
                                                                class="text-danger">* </small></label>
                                                                <input type="number" name="person_contact_no" id="person_contact_no" 
                                                                    placeholder="Contact Number" class="form-control" oninput="javascript: if (this.value.length > 
                                                                    this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" 
                                                                    pattern="[0-9]{1,10}" 
                                                                    value="{{ $appData->person_contact_no ?? old('person_contact_no') }}">
                                                                @error('person_contact_no') <span
                                                                    class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} </span> @enderror
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="pb-2 pt-2" for="email">Email id<small
                                                                class="text-danger">* </small></label>
                                                                <input type="email" name="person_email" id="person_email"
                                                                placeholder="Contact Email" class="form-control"
                                                                value="{{ $appData->person_email ?? old('person_email') }}">
                                                            @error('person_email') <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                        </div>
                                                        <div class="col-lg-3">
                                                                <label class="pb-2 pt-2" for="">Board Resolution / Authorization Letter <small
                                                            class="text-danger">*</small><small
                                                                    class="text-primary">(Max. 2MB and PDF Format
                                                                    Only)</small></label>
                                                            <input type="file" name="authorize_letter" id="authorize_letter"
                                                                class="pdf_file">
                                                            @if(!empty($appData->authorize_letter))
                                                            <br>
                                                            <input type="hidden" name="old_authorize_letter"
                                                                value="{{$appData->authorize_letter}}" id="">
                                                            <span><a target="_blank"
                                                                    href="{{URL::to($attcBaseUrl.$appData->authorize_letter)}}"
                                                                    class="document1 text-danger"> 
                                                                    <strong><small class="text-primary">(Issued by Chairman / Managing Director)</small></strong>
                                                                    View Authorized Document</a></span>
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-xl-12"> <strong> Contact Person <small
                                                class="text-danger"> * </small></strong></div>
                                                <div class="col-xl-12 padding20">
                                                    <div class="row cmn_form_bg">
                                                        

                                                        <div class="col-lg-3">
                                                                <label class="pb-2 pt-2" for="register_office_phone">Name <small class="text-danger">*</small></label>
                                                                
                                                                                <input type="text" name="contact_person_name"
                                                                        id="contact_person_name" placeholder="Contact Person Name"
                                                                        class="form-control"
                                                                        value="{{ $appData->contact_person_name ?? old('contact_person_name') }}">
                                                                    @error('contact_person_name') <span
                                                                        class="invalid-feedback custom_valid_class">
                                                                        {{ $message }} </span> @enderror
                                                        </div>
                                                        <div class="col-lg-3">
                                                                <label class="pb-2 pt-2" for="register_office_phone">Designation <small class="text-danger">*</small></label>
                                                                <input type="text" name="person_designation" id="person_designation"
                                                                    placeholder="Designation" class="form-control"
                                                                    value="{{ $appData->person_designation ?? old('person_designation') }}">
                                                                @error('person_designation') <span
                                                                    class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} </span> @enderror 
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label class="pb-2 pt-2" for="email">Phone No<small
                                                                class="text-danger">* </small></label>
                                                                <input type="number" name="person_contact_no" id="person_contact_no" 
                                                                    placeholder="Contact Number" class="form-control" oninput="javascript: if (this.value.length > 
                                                                    this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" 
                                                                    pattern="[0-9]{1,10}" 
                                                                    value="{{ $appData->person_contact_no ?? old('person_contact_no') }}">
                                                                @error('person_contact_no') <span
                                                                    class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} </span> @enderror
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="pb-2 pt-2" for="email">Email id<small
                                                                class="text-danger">* </small></label>
                                                                <input type="email" name="person_email" id="person_email"
                                                                placeholder="Contact Email" class="form-control"
                                                                value="{{ $appData->person_email ?? old('person_email') }}">
                                                            @error('person_email') <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                        </div>

                                                        
                                                    </div>
                                                </div>
                                                
                                            </div> -->
                                            <!-- <div class="row">
                                                <div class="col-xl-12"> <strong> Applied Manufacturing Capacity (in MW/year) *</strong></div>
                                                <div class="col-xl-12 padding20">
                                                    <div class="row cmn_form_bg">
                                                        

                                                        <div class="col-lg-3">
                                                    
                                                                <label class="pb-2 pt-2" for="register_office_phone">Applied Capacity  (in MW/year)<small class="text-danger">*</small></label>
                                                                
                                                                <input type="number" name="manufacturing_capacity"
                                                                    id="manufacturing_capacity" class="form-control"
                                                                    placeholder="Total PV Manufacturing Capacity (in MW)"
                                                                    value="{{ $appData->manufacturing_capacity ?? old('manufacturing_capacity') }}">
                                                                @error('manufacturing_capacity') <span
                                                                    class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} </span> @enderror
                                                        </div>
                                                        

                                                        
                                                    </div>
                                                </div>
                                                
                                            </div> -->

                                <table class="table table-bordered">
                                   <!-- <tr>

                                       
                                        <td>
                                             <div class="row">
                                                <div class="col-xl-12">1.1 Name of Company *</div>
                                                <div class="col-md-6">
                                                    <label for="">&nbsp;</label>
                                                    <input type="text" name="manufacturer_name"
                                                        placeholder="Name of Manufacturer" id="manufacturer_name"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $appData->manufacturer_name ?? old('manufacturer_name') }}">
                                                </div>
                                                <div class="col-md-6">
                                                    @if(!empty($appData->attc_incorporation_cerificate))
                                                    <span><a target="_blank" style="float:right"
                                                            href="{{URL::to($attcBaseUrl.$appData->attc_incorporation_cerificate)}}"
                                                            class="document1 text-danger">View Document</a></span>
                                                    @endif
                                                    <strong><label for="">Certificate of Incorporation <small
                                                            class="text-primary">(Max.
                                                            2MB and PDF Format
                                                            Only)</small><small
                                                            class="text-danger">*</small></label><strong>
                                                    <input type="file" name="certificate_incorporation"
                                                        id="certificate_incorporation"
                                                        class="form-control pdf_file_2mb mb-0">
                                                    <small class="text-primary">(In case of Indian company, attach a copy of Certificate of Incorporation 
                                                        issued by Registrar of Companies)</small>

                                                </div>
                                            </div> 
                                        </td>
                                    </tr>-->
                                    <!-- <tr>
                                        <td width="30%"> <strong>Manufacturer Brand Name & Logo <small
                                                    class="text-danger">*</small></strong> </small>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">&nbsp;</label>
                                                    <input type="text" name="manufacturer_brand_name"
                                                        placeholder="Manufacturer Brand Name"
                                                        id="manufacturer_brand_name" class="form-control" maxlength="60"
                                                        value="{{ $appData->manufacturer_brand_name ?? old('manufacturer_brand_name') }}">


                                                </div>
                                                <div class="col-md-6">
                                                <strong><label for="">Upload Logo <small class="text-primary">(Max.
                                                            1MB and JPG,PNG Format
                                                            Only)</small><small
                                                            class="text-danger">*</small></label></strong>
                                                    <input type="file" name="manufacturer_brand_logo"
                                                        id="manufacturer_brand_logo" class="form-control img_file mb-0">
                                                    @if(!empty($appData->manufacturer_brand_logo))
                                                    <input type="hidden" name="old_manufacturer_brand_logo"
                                                        value="{{$appData->manufacturer_brand_logo}}" id="">
                                                    <a href="{{URL::to($logoBaseUrl.$appData->manufacturer_brand_logo)}}"
                                                        target="_blank" style="float:right" class=" text-danger"
                                                        alt="{{ $appData->manufacturer_brand_name ?? old('manufacturer_brand_name') }} Logo">
                                                        <i class="bi bi-image text-danger"></i> View Logo</a>

                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr> -->
                                  
                                        <!--  <tr>
 <td width="30%"> <strong>1.2 Registered Office Address of the
                                                Company
                                                <small class="text-danger">*</small></strong> <br>
                                        </td>
                                        <th>
                                            <textarea name="register_office_address" id="register_office_address"
                                                cols="10" rows="2" class="form-control" maxlength="250"
                                                placeholder="Registered Office Address of the Manufacturer">{{ $appData->register_office_address ?? old('register_office_address') }}</textarea>
                                            @error('register_office_address') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                            <i class="word-count" id="reg_address_char"></i>
                                             <small class="max-char"> (Max. 1000 Characters)</small> 
                                            <div class="row">
                                            <div class="col-md-4">
                                                    <strong>
                                                        <label for="register_office_phone">Phone <small class="text-danger">*</small></label>
                                                    </strong>
                                                    <input type="number" name="register_office_phone" id="register_office_phone" 
                                                        placeholder="Contact Number" class="form-control"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" 
                                                        pattern="[0-9]{1,10}"  
                                                        value="{{ $appData->register_office_phone ?? old('register_office_phone') }}">
                                                    @error('register_office_phone')
                                                        <span class="invalid-feedback custom_valid_class">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4">
                                                <strong><label for="email">Email id <small
                                                    class="text-danger">* </small></label></strong>
                                                    <input type="email" name="register_office_email"
                                                        id="register_office_email" class="form-control"
                                                        placeholder="Email Address"
                                                        value="{{ $appData->register_office_email ?? old('register_office_email') }}">
                                                    @error('register_office_email') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                                <div class="col-md-4">
                                                <strong><label for="Longitude">Country <small
                                                    class="text-danger">* </small></label></strong>
                                                    <select name="reg_country" id="reg_country">
                                                        <option value="">Select</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{$country->countrycd}}" @if(!Empty($appData->
                                                            country) && $appData->reg_country==$country->countrycd)
                                                            selected
                                                            @endif >{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('country') <br> <br> <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                            </div>
                                        </th> 
                                    </tr>-->
                                  <!--   <tr>

                                        <td width="30%"> 
                                            <strong>1.3 Communication Address of the
                                                Company <small class="text-danger">*</small></strong> -->
                                                 <!-- <br>( <input
                                                    type="checkbox" name="is_comm_add_same" id="is_comm_add_same"
                                                    @if(isset($appData->is_comm_add_same) &&
                                                $appData->is_comm_add_same ==1)checked
                                                @endif> Check,if address same as registered
                                                address) -->
                                      <!--  </td>
                                        <th>
                                             <textarea name="com_address" id="com_address" cols="10" rows="2"
                                                class="form-control" maxlength="150"
                                                placeholder="Communication Office Address of the Manufacturer">{{ $appData->com_address ?? old('com_address') }}</textarea>
                                            @error('com_address') <span class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                            <i class="word-count" id="com_address_char"></i> -->
                                            <!-- <small class="max-char"> (Max. 1000 Characters)</small> -->
                                            <!-- <div class="row">
                                            
                                                <div class="col-md-4">
                                                <strong><label for="phone">Phone <small
                                                    class="text-danger">* </small></label></strong>
                                                    <input type="number" name="com_phone" id="com_phone"
                                                        class="form-control" placeholder="Contact Number"  oninput="javascript: if (this.value.length > 
                                                        this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" 
                                                        pattern="[0-9]{1,10}"  
                                                        value="{{ $appData->com_phone ?? old('com_phone') }}">
                                                    @error('com_phone') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>

                                                <div class="col-md-4">
                                                <strong><label for="email">Email id<small
                                                    class="text-danger">*</small></label></strong>
                                                    <input type="email" name="com_email" id="com_email"
                                                        class="form-control" placeholder="Email Address"
                                                        value="{{ $appData->com_email ?? old('com_email') }}">
                                                    @error('com_email') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                                <div class="col-md-4">
                                                <strong><label for="Longitude">Country <small
                                                    class="text-danger">*</small></label></strong>
                                                    <select name="com_country" id="com_country">
                                                        <option value="">Select</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{$country->countrycd}}" @if(!Empty($appData->
                                                            country) && $appData->com_country==$country->countrycd)
                                                            selected
                                                            @endif >{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('country') <br> <br> <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                            </div> 
                                        </th>
                                    </tr>
                                    <tr>-->

                                        <!-- <td width="30%"> <strong>1.4 Address of Manufacturing Plant
                                                <small
                                                    class="text-danger">*</small></strong> <br>
                                        </td> -->
                                        <!--<th>
                                            <div class="row">
                                                <div class="col-md-7">
                                                     <textarea name="plant_address" id="plant_address" cols="10" rows="2"
                                                        class="form-control" maxlength="250"
                                                        placeholder="Address of Manufacturing Plant">{{ $appData->plant_address ?? old('plant_address') }}</textarea>
                                                    @error('plant_address') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                    <i class="word-count" id="plant_address_char"></i> -->
                                                    <!-- <small class="max-char"> (Max. 1000 Characters)</i></small> -->
                                                <!-- </div>
                                                <div class="col-md-5">
                                                    <div class="col-md-12">
                                                    <strong> <label for="">Latitude  <small
                                                        class="text-danger">*</small></label></strong>
                                                        <input type="text" name="plant_latitude" id="plant_latitude"
                                                            class="form-control" placeholder="Plant Latitude"
                                                            value="{{ $appData->plant_latitude ?? old('plant_latitude') }}">
                                                        @error('plant_latitude') <span
                                                            class="invalid-feedback custom_valid_class">
                                                            {{ $message }} </span> @enderror
                                                    </div>
                                                    <div class="col-md-12">
                                                    <strong><label for="Longitude">Longitude  <small
                                                        class="text-danger">*</small></label></strong>
                                                        <input type="text" name="plant_longitude" id="plant_longitude"
                                                            class="form-control" placeholder="Plant Longitude"
                                                            value="{{ $appData->plant_longitude ?? old('plant_longitude') }}">
                                                        @error('plant_longitude') <span
                                                            class="invalid-feedback custom_valid_class">
                                                            {{ $message }} </span> @enderror
                                                    </div>
                                                    <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                        class="text-primary" target="_blank">Click Here to get
                                                        Latitude/Longitude</a> -->
                                               <!--  </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-md-4">
                                                    <strong> <label for="">GPS Coordinates North<small
                                                        class="text-danger">*</small></label></strong>
                                                        <input type="text" name="gps_latitude" id="gps_latitude"
                                                            class="form-control" placeholder="GPS Coordinates North"
                                                            value="{{ $appData->gps_latitude ?? old('gps_latitude') }}">
                                                        @error('gps_latitude') <span
                                                            class="invalid-feedback custom_valid_class">
                                                            {{ $message }} </span> @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                    <strong><label for="Longitude">GPS Coordinates East <small
                                                        class="text-danger">*</small></label></strong>
                                                        <input type="text" name="gps_longitude" id="gps_longitude"
                                                            class="form-control" placeholder="GPS Coordinates East"
                                                            value="{{ $appData->gps_longitude ?? old('gps_longitude') }}">
                                                        @error('gps_longitude') <span
                                                            class="invalid-feedback custom_valid_class">
                                                            {{ $message }} </span> @enderror
                                                    </div> -->
                                                    <!-- <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                        class="text-primary" target="_blank">Click Here to get
                                                        Latitude/Longitude</a> -->
                                          <!--  </div>
                                            
                                            
                                     
                                            <div class="row">
                                                 <div class="col-md-4">
                                                <strong><label for="phone">Phone <small
                                                    class="text-danger">*</small></label></strong>
                                                    <input type="number" name="plant_phone" id="plant_phone" oninput="javascript: if (this.value.length > 
                                                    this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" 
                                                        pattern="[0-9]{1,12}" 
                                                      placeholder="Contact/Phone Number" 
                                                        class="form-control"
                                                        value="{{ $appData->plant_phone ?? old('plant_phone') }}" 
                                                        >
                                                    @error('plant_phone') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>

                                                <div class="col-md-4"><strong><label for="email">Email id <small
                                                class="text-danger">*</small></label><strong>
                                                    <input type="email" name="plant_email" id="plant_email"
                                                        class="form-control" placeholder="Email Address"
                                                        value="{{ $appData->plant_email ?? old('plant_email') }}">
                                                    @error('plant_email') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>

                                                <div class="col-md-4">
                                                <strong><label for="Longitude"> Country <small
                                                    class="text-danger">*</small></label></strong>
                                                    <select name="country" id="country">
                                                        <option value="">Select</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{$country->countrycd}}" @if(!Empty($appData->
                                                            country) && $appData->country==$country->countrycd) selected
                                                            @endif >{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('country') <br> <br> <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div> -->

                                               <!-- <div class="col-md-12">
                                                     <div id="floating-panel">
                                                    <input id="latlng" type="text" value="40.714224,-73.961452">
                                                    <input id="submit" type="button" value="Get Address">
                                                    </div>
                                                    <div id="map"></div> 
                                                </div>
                                            </div>

                                        </th>
                                    </tr>
-->
                                    <!-- <tr id="isIndiaCompany">

                                        <td width="30%"> <strong>Whether the Manufacturing Plant is Located in SEZ (Only
                                                if Indian Company)
                                                <small class="text-danger">*</small></strong> <br>

                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select name="is_sez" id="is_sez">
                                                        <option value="">Select</option>
                                                        <option value="Yes" @if(($appData->is_sez ?? '')=='Yes')
                                                            selected @endif>Yes</option>
                                                        <option value="No" @if(($appData->is_sez ?? '')=='No') selected
                                                            @endif>No</option>
                                                    </select>
                                                </div>

                                            </div>

                                        </td>

                                    </tr> -->
                                    <!-- <tr id="isSez">

                                        <td width="30%"> <strong>GST Number/Certificate
                                                <small class="text-danger">*</small></strong> <br>


                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">GST Number<small class="text-danger">*</small></label>
                                                    <input type="text" name="gst_number" id="gst_number"
                                                        value="{{ $appData->gst_number ?? old('gst_number') }}"
                                                        placeholder="Please enter GST Number" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">GST Certificate<small class="text-danger">*</small>
                                                        <small class="text-primary">(Max. 1MB
                                                            and PDF Format
                                                            Only)</small></label>
                                                    <input type="file" name="gst_document" id="gst_document"
                                                        class="form-control mb-0 pdf_file">


                                                </div>
                                                <div class="col-md-12">
                                                    @if(!empty($appData->gst_document))

                                                    <span><a target="_blank"
                                                            href="{{URL::to($attcBaseUrl.$appData->gst_document)}}"
                                                            class="document1 text-primary">View
                                                            GST Document</a></span>
                                                    @endif
                                                </div>

                                            </div>

                                        </td>

                                    </tr> -->
                                    <!-- <tr class="bg-warning">
                                    <td> <strong>2.0 Authorized signatory details <small class="text-danger">*</small>
                                            </strong> <br>
                                        </td>
                                     </td>
                                    <tr> -->
                                    
                                        <!-- <td width="30%" > <strong> Authorized signatory details <small
                                                    class="text-danger">*</small></strong> <br></td> -->
                                        <!-- <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                <strong><label for="">Name <small
                                                    class="text-danger">*</small></label></strong>
                                                    <input type="text" name="authorize_name" id="authorize_name"
                                                        maxlength="50" placeholder="Authorized Signatory Name"
                                                        class="form-control"
                                                        value="{{ $appData->authorize_name ?? old('authorize_name') }}">
                                                    @error('authorize_name') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>

                                                <div class="col-md-6">
                                                <strong><label for="">Designation  <small
                                                    class="text-danger">*</small></label></strong>
                                                    <input type="text" name="authorize_designation"
                                                        id="authorize_designation" maxlength="50"
                                                        placeholder="Designation" class="form-control"
                                                        value="{{ $appData->authorize_designation ?? old('authorize_designation') }}">
                                                    @error('authorize_designation') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                                <div class="col-md-6">
                                                <strong><label for="">Board Resolution / Authorization Letter <small
                                                    class="text-danger">*</small><small
                                                            class="text-primary">(Max. 1MB and PDF Format
                                                            Only)</small></label></strong>
                                                    <input type="file" name="authorize_letter" id="authorize_letter"
                                                        class="pdf_file">
                                                    @if(!empty($appData->authorize_letter))
                                                    <br>
                                                    <input type="hidden" name="old_authorize_letter"
                                                        value="{{$appData->authorize_letter}}" id="">
                                                    <span><a target="_blank"
                                                            href="{{URL::to($attcBaseUrl.$appData->authorize_letter)}}"
                                                            class="document1 text-danger"> 
                                                            <strong><small class="text-primary">(Issued by Chairman / Managing Director)</small></strong>
                                                            View Authorized Document</a></span>
                                                    @endif
                                                    <br>
                                                </div>
                                            </div>
                                        </td> 
                                    </tr>-->
                                    <!-- <td width="30%"> <strong>Contact Person <small class="text-danger">*</small>
                                            </strong> <br>
                                        </td> -->
                                        <!-- <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                <strong><label for="">Name <small
                                                    class="text-danger">*</small></label></strong>
                                                    <input type="text" name="contact_person_name"
                                                        id="contact_person_name" placeholder="Contact Person Name"
                                                        class="form-control"
                                                        value="{{ $appData->contact_person_name ?? old('contact_person_name') }}">
                                                    @error('contact_person_name') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                                <div class="col-md-6">
                                                <strong><label for="">Designation <small
                                                    class="text-danger">*</small></label></strong>
                                                    <input type="text" name="person_designation" id="person_designation"
                                                        placeholder="Designation" class="form-control"
                                                        value="{{ $appData->person_designation ?? old('person_designation') }}">
                                                    @error('person_designation') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>

                                                <div class="col-md-6">
                                                <strong><label for="">Phone No <small
                                                    class="text-danger">*</small></label></strong>
                                                    <input type="number" name="person_contact_no" id="person_contact_no" 
                                                        placeholder="Contact Number" class="form-control" oninput="javascript: if (this.value.length > 
                                                    this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" 
                                                        pattern="[0-9]{1,10}" 
                                                        value="{{ $appData->person_contact_no ?? old('person_contact_no') }}">
                                                    @error('person_contact_no') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                                <div class="col-md-6">
                                                <strong><label for="">Email id <small
                                                    class="text-danger">*</small></label></strong>
                                                    <input type="email" name="person_email" id="person_email"
                                                        placeholder="Contact Email" class="form-control"
                                                        value="{{ $appData->person_email ?? old('person_email') }}">
                                                    @error('person_email') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                            </div>
                                        </td> -->

                                   <!--  </tr>
                                    <tr>
                                    <tr>

                                        <td width="20%"> 
                                            <strong>Applied Manufacturing Capacity  (in
                                                MW/year)</strong><small
                                                class="text-danger"> * </small> -->
                                            <!-- <br><br>
                                            <i>Formula for calculating PV model Manufacturing Capacity:</i><br>
                                            <br>
                                            <small> <i>
                                                    <u><span
                                                            style="margin-top: 0px; position: absolute; margin-left: -9px;font-size: 18px;">(</span>No.
                                                        of Cells Processed in an Hour</u><br>
                                                    <span style="margin-left: 15px;">No.of cells in highest Wp
                                                        PV
                                                        model</span> <br>
                                                    x Wattage of Highest Wp PV Model x
                                                    24 x 350 x 0.9)

                                                </i> </small> -->
                                       <!-- </td>
                                        <th>

                                             <div class="row">
                                                <div class="col-md-12">
                                                    <input type="number" name="manufacturing_capacity"
                                                        id="manufacturing_capacity" class="form-control"
                                                        placeholder="Total PV Manufacturing Capacity (in MW)"
                                                        value="{{ $appData->manufacturing_capacity ?? old('manufacturing_capacity') }}">
                                                    @error('manufacturing_capacity') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                            </div> 
                                        </th>-->
                                    </tr>
                                </table>
                                <br>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <button type="submit" name="submit" class="btn btn-success" id="submit"><i class="fas fa-save"></i>@if(isset($appData->id)) Update @else
                                             Save
                                            @endif</button>
                                        @if(isset($appData->id))

                                        <!-- <a href="{{ URL::to('users/new-application/'.$general->encodeid($appData->id))}}"
                                            class="btn btn-danger">Cancel <i class='bi bi-x'></i></a> -->
                                    <!--    <a href="{{ URL::to('users/module-master/'.$general->encodeid($appData->id))}}"
                                            class="btn btn-warning">Next <i class='bi bi-arrow-bar-right'></i></a> -->

                                         <a href="{{ URL::to('users/annexure-four-three/'.$general->encodeid($appData->id))}}"
                                            class="btn btn-warning">Next <i class='bi bi-arrow-bar-right'></i></a>
                                        <input type="hidden" name="edit_id" id="edit_id"
                                            value="{{$general->encodeid($appData->id)}}">
                                        @endif
                                        <input type="hidden" name="step1" id="step1" value="{{$appData->step1 ?? 0}}">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <style>
    .max-char {

        right: 35px;
        font-size: 10px;
        color: #337ab7;
    }

    .document {
        margin-top: -8px;
        position: absolute;
        font-size: 10px !important;
    }

    .word-count {
        float: right;
        color: red;
        font-weight: 400;
        font-size: 11px;
    }
    </style>

    @endsection
    @push('backend-js')
    <script>
    // $('#register_office_address').on('keyup', function(event) {
    //     var maxlength = 1000;
    //     var len = $(this).val().length;
    //     if (len >= maxlength) {
    //         $(this).val($(this).val().substring(-1, len - 1));
    //     }
    //     $('#reg_address_char').html((maxlength - len + " Characters left"));
    // });
    // $('#com_address').on('keyup', function(event) {
    //     var maxlength = 1000;
    //     var len = $(this).val().length;
    //     if (len >= maxlength) {
    //         $(this).val($(this).val().substring(-1, len - 1));
    //     }
    //     $('#com_address_char').html((maxlength - len + " Characters left"));
    // });
    // $('#plant_address').on('keyup', function(event) {
    //     var maxlength = 1000;
    //     var len = $(this).val().length;
    //     if (len >= maxlength) {
    //         $(this).val($(this).val().substring(-1, len - 1));
    //     }
    //     $('#plant_address_char').html((maxlength - len + " Characters left"));
    // });
    $(function() {
          // Event listener for change event on the dropdown
          $('#application_type').change(function() {
                // Get the selected value
                var selectedValue = $(this).val();

                // alert(selectedValue); 
                
                // If "Other" is selected, show the textbox
                if (selectedValue === "6") {
                    $('.textbox-container').show();
                } else {
                    $('.textbox-container').hide();
                }
            });
        $('#country').change(function() {
            // alert('hi');
            $('#isIndiaCompany').hide();
            $('#isSez').hide();
            // $saarcList=array(1,18,25,99,130,149,162,200);
            var ssarcAry = ["1", "18", "25", "99", "130", "149", "162", "200"];
            if ($.inArray($(this).val(), ssarcAry) != -1) {
                $('#isIndiaCompany').show();
                $('#isSez').show();
                $('#gst_number').val('');
                $('#is_sez').val('');
            }

        });
        $('#is_sez').change(function() {
            $('#isSez').show();
            if ($(this).val() == 'Yes') {
                $('#isSez').hide();
                $('#gst_number').val('');
            }
        });
        $("#is_comm_add_same").click(function() {
            if ($('[type="checkbox"]').is(":checked")) {
                $('#com_address').val($('#register_office_address').val()).attr('readonly',
                    'readonly');
                $('#com_phone').val($('#register_office_phone').val()).attr('readonly', 'readonly');
                $('#com_email').val($('#register_office_email').val()).attr('readonly', 'readonly');
                $("#com_country").val($("#reg_country").val()).attr('readonly', 'readonly');
                
            } else {
                $('#com_address').val('').attr('placeholder',
                    'Communication Office Address of the Manufacturer').removeAttr('readonly',
                    'readonly');
                $('#com_phone').val('').attr('placeholder', 'Contact Number').removeAttr('readonly',
                    'readonly');
                $('#com_email').val('').attr('placeholder', 'Email Address').removeAttr('readonly',
                    'readonly');
                $('#com_country').val('').removeAttr('readonly', 'readonly');
            }
            //return false;
        })
    });
    </script>
    @if(($appData->is_sez ?? '')=='Yes')
    <script>
    $(document).ready(function() {
        $('#isSez').hide();
    });
    </script>
    @endif
    @if(($appData->country ?? '')!=99)
    <script>
    $(document).ready(function() {
        $('#isIndiaCompany').hide();
        $('#isSez').hide();
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const comAddressSection = document.getElementById('com_address_section');
    const plantAddressSection = document.getElementById('plant_address_section');
    const addressTypeInputs = document.getElementsByName('address_type');

    addressTypeInputs.forEach(input => {
        input.addEventListener('change', function () {
            if (this.value === 'communication') {
                comAddressSection.style.display = 'block';
                plantAddressSection.style.display = 'none';
            } else {
                comAddressSection.style.display = 'none';
                plantAddressSection.style.display = 'block';
            }
        });
    });
});
</script>
    @endif
    @endpush