@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Details of Solar PV Modules')
@section('content')
@php
$attcBaseUrl ='users/preview-docs/Attachment/';
@endphp
<?php
use App\Models\Module;
use App\Models\Annexure1;
?>
<style>
    .comn_drop_shdow{border: 1px solid #dedede;
    background: #ffffff;
    border-radius: 0px 0px 8px 8px;
    box-shadow: 0 0 5px #dedede;}
    .table_max_height{max-height:350px; overflow:auto}
 
        .tab_desgn ul li {
            background: #f1f1f1;
            /* border-right: 1px solid #d1d1d1; */

            height: 80px;
            position: relative;
        }

        .tab_desgn ul li:last-child {
            border-right: none;
            ;
        }

        .tab_desgn ul li a {
            /* position: relative; */
            background-color: #0d6efd00 !important;
            color: #777777 !important;
            font-weight: 600;
            text-transform: uppercase;
            padding: 0;
            margin: 0;
            border-radius: 0 !important;

            text-align: center;
            padding: 15px 0;
            background-color: #eee;
            box-shadow: 0 0 0 1px #ddd;
            top: 15px;
            transition: top .2s;
            height: 100%;border-top: 1px solid #49be80!important;
        }

        .tab_desgn ul li a div {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding-top: 20px;
        }

        .tab_desgn ul li a.active {
            /* position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            
            color: #2754db !important;
            font-weight: 600;
            text-transform: uppercase;
            border: 1px solid #dedede;
             */
            border-radius: 0;
            border-bottom: 0;
            background-color: #ffffff !important;
            background: #fff;
            box-shadow: 1px 1px 0 1px #fff, 0 0px 0 1px #ddd, -1px 1px 0 0px #ddd inset;
            padding-bottom: 30px;
            border-top: 1px solid #49be80;
        }

        .arrow-down {
            display: none;
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 22px solid #49be80;
            position: absolute;
            top: -1px;
            left: calc(50% - 20px);
        }

        .arrow-down-inner {
            display: none;
            width: 0;
            height: 0;
            border-left: 18px solid transparent;
            border-right: 18px solid transparent;
            border-top: 12px solid #fff;
            position: absolute;
            top: -1px;
            left: 38.4%;
        }

        .tab_desgn ul li a.active .arrow-down {
            display: block !important;
        }

        .tab_desgn ul li a.active .arrow-down-inner {
            display: block !important;
        }

        .tab_desgn .tab-content {
            border: 1px solid #dedede;
            border-top: none;

        }

        .tab_desgn ul li a.active div {
            color: #4d72c7;
        }
    </style>

<div class="container-fluid tab_desgn ">
<!-- Nav pills -->
<ul class="nav nav-pills nav-justified" role="tablist">
<li class="nav-item">
    <a class="nav-link " href="{{ URL::to('users/annexure-four-three/'  .$general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
      <div>Manufacturing Facility<br>3.0 - 3.7</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link " href="{{ URL::to('users/module-master/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Solar PV Modules<br> 4.0</div>
    </a>
</li>

<li class="nav-item">
   <a class="nav-link active" href="{{ URL::to('users/annexure-one/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Mechanical Data<br>4.1 - 4.2</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-one-b/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Electrical Data <br>4.3</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-one-c/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Solar Cell & BoM<br>4.4- 4.5</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-three/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>BIS Registration<br>5.0 </div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link"  href="{{ URL::to('users/application-fees/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Application Fee<br>6.0</div>
    </a>
</li>
    
<li class="nav-item">
    <a class="nav-link"  href="{{ URL::to('users/application-submission/' .$general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Affidavit & Indemnity<br>7.0</div>
    </a>
</li>

</ul>
</div>



<div class="row" style="padding:0 10px">
    @include('backend.user.form._stepper')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="comn_drop_shdow">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box-body">
                            @if ($errors->any())
                            <span class="invalid-feedback1 all_valid_class text-danger" style="display:block">*Please enter all details properly. Do not use special characters.</span>
                            @endif
                            <form action="{{URL::to('/users/annexure-one')}}" method="POST" enctype="multipart/form-data"  id="formAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                    
                              <!--      <tr>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="20%">Type of Model</th>
                                                    <td class="text-primary">{{$annexuredata->module_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="20%">Mean Wattage and application Range of Wattage for the Model Module</th>
                                                    <td class="text-primary">{{$annexuredata->applicable_model_covered ?? ''}}</td>
                                                </tr>
                                                
                                            </table>
                                        </td>
                                    </tr> -->

                                    <tr>
                                        <td>
                                            <table class="table table-bordered1">
                                                <tr>
                                                    <!-- <th>S.No</th> -->
                                                    <!-- <th width="20%" class="">Type Of Modules</th>
                                                    <th class="">Mean Wattage and application Range of Wattage for the Model Module</th> -->
                                                    <th>Length of Module (in mm)<small class="text-danger"> * </small></th>
                                                    <th>Width of Module (in mm)<small class="text-danger"> * </small></th>
                                                    <th>Height of Module (in mm)<small class="text-danger"> * </small></th>
                                        
                                                    <th>Weight (in kg)<small class="text-danger"> * </small></th>
                                                    <th></th>
                                                </tr>
                                                <tbody>
                                                        @if($annexuredata!=null)
                                                        
                                                        <tr class="record">

                                                            <!-- <td class="">{{ $annexuredata->applicable_model }} </td> -->
                                                        <td> <input type="number" min="0" step="any"
                                                                name="module_length"
                                                                id="module_length_"
                                                                onblur="calculateArea()"
                                                                placeholder="Enter Length of Module (in mm)"
                                                                class=" data- md_module_length"
                                                                value="{{ $annexuredata['module_length'] ?? ''  }}"
                                                                >
                                                            <i name="module_length."></i>
                                                        </td>
                                                        <td><input type="number" name="module_breadth"
                                                                id="module_breadth_" min="0"
                                                                onblur="calculateArea()" step="any"
                                                                placeholder="Enter Breadth of Module (in mm)"
                                                                class="data- md_module_breadth"
                                                                value="{{ $annexuredata['module_breadth'] ?? ''  }}">
                                                            <i name="module_breadth."></i>
                                                        </td>
                                                            <td><input type="number" min="0" step="any"
                                                                name="module_dimensions"
                                                                id="module_dimensions_"
                                                                onblur="calculateArea()"
                                                                placeholder="Enter Module Dimensions(in mm)"
                                                                class=" data- md_module_dimensions"
                                                                value="{{ $annexuredata['module_dimensions'] ?? ''  }}">
                                                            <i name="module_dimensions."></i>
                                                        </td> 
                                                   <!--     <td><input type="number" name="module_area"
                                                                id="module_area_" min="0" step="any"
                                                                placeholder="Enter Area of Module (LxB) (in m2)"
                                                                class=" data- md_module_area"
                                                                value="{{ $annexuredata['annexure'][0]['module_area'] ?? '' }}"
                                                                 >
                                                            <i name="module_area."></i>
                                                        </td> -->
                                                        
                                                        <td class="text-left"><input type="number"
                                                                name="module_weight"
                                                                id="module_weight_" min="0"
                                                                step="any" placeholder="Enter Weight (in kg)"
                                                                class=" data- md_module_weight"
                                                                value="{{ $annexuredata['module_weight'] ?? '' }}"
                                                                >
                                                            <i name="module_weight."></i>
                                                            
                                                            <!-- <input type="checkbox" name="same"
                                                                id="sameMD"
                                                                onchange="copydataMD()"
                                                                style="font-size:12px;"> <span
                                                                class="text-primary same_as_above">Autofill as filled
                                                                above</span> -->
                                                            
                                                        </td>

                                                        </tr>
                                                        
                                                    @endif
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="submit" name="submit"
                                                value=" @if(isset($annexuredata) && is_object($annexuredata) && $annexuredata->id != null)Update @else Save @endif"
                                               class="btn btn-success" id="">
                                               @if(isset($annexuredata) && $annexuredata != null)
                                                    <input type="hidden" name="edit_id" id="edit_id" value="{{ $general->encodeid($annexuredata->id) }}">
                                                @endif
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                                <a href="{{URL::to('users/annexure-one/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>
                                        </td>
                                    </tr>
                                </table>

                                <table class="table table-bordered table-striped   mt-3">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th width="10%">4.1 </th>
                                            <th scope="col" colspan="13" class="text-left">Mechanical Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Sr.No</th>
                                            <th width="15%">Model Names of Solar Modules</th>
                                            <th width="10%">Model Wattage</th>
                                            <th width="10%">Length of Module (in mm) </th>
                                            <th width="10%">Width of Module (in mm)</th>
                                            <th width="10%">Height of Module (in mm)</th>
                                            <th width="10%">Area of Module (in mm square)</th>
                                            <th width="10%">Weight of Module (in mm)</th>
                                            <th></th>
                                        </tr>                           
                                            @foreach($moduleData as $key => $data)
                                            <?php                                    
                                            $rows=Annexure1::where('module_type',$data->id)->first();
                                            ?>
                                            <tr>
                                                <td scope="row">{{ $key + 1 }}</td>
                                                <td>{{ $data->sub_model_name }}</td>
                                                <td>{{ $data->sub_model_wattage }}</td>
                                                <td>{{ $rows->module_length }}</td>
                                                <td>{{ $rows->module_breadth }}</td>
                                                <td>{{ $rows->module_dimensions }}</td>
                                                <td>{{ $rows->module_area }}</td>
                                                <td>{{ $rows->module_weight }}</td>

                                                <td>
                                                    <a href="{{ URL::to('users/annexure-one/' . $general->encodeid($data->application_id) . '/' . $general->encodeid($data->id)) }}"
                                                    onClick="editAnnexureData({{ $data->id }})">
                                                        Edit <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                        </tr>
                                            @endforeach


                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>

                    <form action="{{ URL::to('/users/annexure-one-attachment')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax1">
                                @csrf
                                @method('POST')
                                <hr>
                                <table class="table table-bordered  table-striped mt-4" >
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th width="10%">4.2 </th>
                                            <th scope="col" colspan="15" class="text-left">Warranty Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </table>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Upload Warranty Details <span class="text-danger">*</span> <br> <small
                                                class="text-primary">(Max.
                                                2MB and PDF Format
                                                Only)</small>
                                        </td>
                                        <td> <input type="file" name="module_one_data_sheet" id="module_one_data_sheet"
                                                class="from-control pdf_file_2mb"
                                                style="width: 26%;margin-right: 10px;" />

                                            <input type="submit" name="submit" value="upload"
                                                class="btn btn-success btn-sm" />
                                            @if($module_one_data_sheet->module_one_data_sheet!='')
                                            <span>
                                                <strong><a target="_blank"
                                                        href="{{URL::to($attcBaseUrl.$module_one_data_sheet->module_one_data_sheet)}}"
                                                        class="document1 text-danger"
                                                        style="float:right; font-size:12px !important">View
                                                        Warranty Details </a></strong>
                                            </span>
                                            @endif <br>
                                            @error('module_one_data_sheet') <span class="text-danger">
                                                {{ $message }} </span> @enderror
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                        </td>
                                       </tr>
                                    <tbody>
                                </table>
                        </form>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                   
                                        <a href="{{URL::to('users/module-master/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i
                                                    class="fa fa-arrow-left"></i> Back </a>
                                         @if($appData!=null)
                                            <a href="{{URL::to('users/annexure-one-b/'.$general->encodeid($application_id))}}"
                                                class="btn btn-warning">Next <i
                                                    class="fa fa-arrow-right"></i></a>
                                        @endif
                                        <br><br>
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
    position: absolute;
    right: 35px;
    margin-top: -24px;
}
</style>
@endsection
@push('backend-js')
<script>
    function getDataValue(data) {
        var dt = $(data).find(':selected').attr('data-id');
        $('#model_code').val(dt);
    }
    $('input[type=radio][name=enlisted_almm]').change(function() {
        if (this.value == 0) {
            $('.enlistData').addClass('hide');
        } else if (this.value == 1) {
            $('.enlistData').removeClass('hide');
        }
    });
</script>
<script>
    let counter = $('#add-data tr').length;
    $(document).ready(function() {
        $(document).on('click', '.remove_fields', function() {
            $(this).closest('.record').remove();
            counter = counter - 1;
        });
        //<button type="button" class="remove_fields btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
        $("#add-row").click(function() {
            counter = counter + 1;
            markup =
                '<tr class="record"><td>' +
                counter +
                '</td><td><input type="number" min="0" step="any" name="pmax_applicable_model[]" id="pmax_applicable_model_' +
                counter +
                '" placeholder="Enter Pmax in (Wp)" class="form-control pmax_applicable_model_' +
                counter +
                '"></td><td><input type="text" name="no_of_cells[]" id="no_of_cells_' +
                counter +
                '" placeholder="Enter No. of Cells & Cell Type " class="form-control"></td><td><input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="system_voltage[]" id="system_voltage_' +
                counter +
                '" placeholder="Enter System Voltage (VDC)" class="form-control"></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data");
            tableBody.append(markup);
        });
    });
</script>
@endpush
