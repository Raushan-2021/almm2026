@inject('general', 'App\Http\Controllers\Backend\mfft\MainController')
@extends('layouts.masters.backend')
@section('title', 'New Application')
@section('content')

@php $docBaseUrl ='users/preview-docs/Certificate/';
$logoBaseUrl ='mfft/preview-docs/Logo/';
$attcBaseUrl ='mfft/preview-docs/Attachment/';
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
                    

                    <form action="{{URL::to('/mfft/awnew-application')}}" method="POST"
                    enctype="multipart/form-data" id="formFileAjax">

                    <div class="row">
                              
                <h4 class=" pt-2 pb-0 " style="color: #015296; font-weight: 600; padding-left:20px">1 Details of Wind Turbine Manufacturer and Model </h4>
                    <div class="col-lg-12">
                        
                        <div class="box-body">
                   
                                @csrf
                                @method('POST')

                                            <div class="row">
                                                <div class="col-xl-12"><strong>a) Name of Indian Company  <small
                                                class="text-danger"> * </small></strong></div>
                                                <div class="col-xl-12 padding20">
                                                    <div class="row cmn_form_bg">
                                                        <div class="col-lg-3">
                                                            <label class="pb-2">Name of Indian Company <small
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
                                                            <small class="text-primary">(Attach a copy of certificate of Incorporation issued by Registrar of Companies)</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12"> <strong>b) Registered Office Address  <small
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

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12"> <strong>c) Communication Address <small
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
                                                    </div>
                                                </div>
                                            </div>

                                              <div class="row">
                                                <div class="col-xl-12"> <strong> d) Address to be mentioned in list, if enlisted<small
                                                class="text-danger"> * </small></strong></div>
                                                <div class="col-xl-6 padding20">
                                                    <div class="row cmn_form_bg">
                                                        <div class="form-group">
                                                            <label><strong>Select Address Type</strong> <small class="text-danger">*</small></label><br>
                                                            <input type="radio" name="address_type" value="communication" id="address_type_communication"
                                                        
                                                            @if(isset($appData->address_type) && ($appData->address_type == 'communication')) checked @endif>
                                                            <label for="address_type_communication">Communication Address</label><br>
                                                            <input type="radio" name="address_type" value="registered" id="address_type_registered" 
                                                             @if(isset($appData->address_type) && ($appData->address_type == 'registered' )) checked @endif>
                                                            <label for="address_type_registered">Registered Office Address</label>

                                                          <!-- <label for="">Registered Office Address : -  {{ $appData->plant_address ?? old('plant_address') }}</label> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12"> <strong> e) Does company's  objectives include wind  businesss<small
                                                class="text-danger"> * </small></strong></div>
                                                <div class="col-xl-6 padding20">
                                                    <div class="row cmn_form_bg">
                                                        <div class="form-group">
                                                                <label><strong>Does company's  objectives include wind  businesss </strong> <small class="text-danger">*</small></label><br>
                                                            <select name="is_applied" id="is_applied">
                                                                <option value="">Select</option>
                                                                <option value="Yes" @if(($appData->is_applied ?? '')=='Yes')
                                                                    selected @endif>Yes</option>
                                                                <option value="No" @if(($appData->is_applied ?? '')=='No') selected
                                                                    @endif>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-xl-12"> <strong>f) Wind Turbine Model Applied for (Model Name)  <small
                                                class="text-danger"> * </small></strong></div>
                                                <div class="col-xl-12 padding20">
                                                    <div class="row cmn_form_bg">
                                                        <div class="col-xl-4">
                                                            <label class="pb-2 pt-2">Wind Turbine Model Applied <small
                                                            class="text-danger"> * </small></label>
                                                            <textarea name="turbine_model" id="turbine_model" cols="10" rows="2"
                                                                    class="form-control" maxlength="150"
                                                                    placeholder="Wind Turbine Model Applied">{{ $appData->turbine_model ?? old('turbine_model') }}</textarea>
                                                                @error('turbine_model') <span class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} </span> @enderror
                                                                <i class="word-count" id="turbine_model_char"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12"> <strong>g) Wind Turbine Details<small
                                                class="text-danger"> * </small></strong></div>
                                                <div class="col-xl-12 padding20">
                                                    <div class="row cmn_form_bg">
                                                        <div class="col-xl-4">
                                                            <label for="rotor_diameter" class="pb-2 pt-2">
                                                                Rotor Diameter in Meters (m) <small class="text-danger">*</small>
                                                            </label>
                                                            <input type="number" name="rotor_diameter" id="rotor_diameter" 
                                                                class="form-control @error('rotor_diameter') is-invalid @enderror" 
                                                                placeholder="Enter rotor diameter in m"
                                                                value="{{ $appData->rotor_diameter ?? old('rotor_diameter') }}" step="0.01" min="0" >
                                                            @error('rotor_diameter') 
                                                                <span class="invalid-feedback custom_valid_class">
                                                                    {{ $message }}
                                                                </span> 
                                                            @enderror
                                                            <i class="word-count" id="rotor_diameter_char"></i>
                                                        </div>

                                                        <div class="col-lg-3">
                                            
                                                                <label class="pb-2 pt-2" for="hub_height">Hub Height in Meters (m)  <small class="text-danger">*</small></label>
                                                                <input type="number" name="hub_height" id="hub_height" oninput="javascript: if (this.value.length > 
                                                                this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" 
                                                                    pattern="[0-9]{1,12}" 
                                                                placeholder="Hub Height in m" 
                                                                    class="form-control"
                                                                    value="{{ $appData->hub_height ?? old('hub_height') }}" 
                                                                    >
                                                                @error('hub_height') <span
                                                                    class="invalid-feedback custom_valid_class">
                                                                    {{ $message }} </span> @enderror
                                                                            
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label class="pb-2 pt-2" for="email">Tower Type <small
                                                                class="text-danger">* </small></label>
                                                                <input type="text" name="tower_type" id="tower_type"
                                                                class="form-control" placeholder="Tower Type"
                                                                value="{{ $appData->tower_type ?? old('tower_type') }}">
                                                            @error('tower_type') <span
                                                                class="invalid-feedback custom_valid_class">
                                                                {{ $message }} </span> @enderror
                                                        </div>

                                                       
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-xl-12"> <strong> h) Authorized signatory details <small
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
                                            
                                <table class="table table-bordered">
                                  
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

                                         <a href="{{ URL::to('mfft/annexure-four/'.$general->encodeid($appData->id))}}"
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