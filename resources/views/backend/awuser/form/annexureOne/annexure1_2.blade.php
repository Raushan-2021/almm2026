@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Details of Solar PV Modules')
@php
$attcBaseUrl ='users/preview-docs/Attachment/';
@endphp
<?php
use App\Models\Module;
?>
@section('content')
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
   <a class="nav-link " href="{{ URL::to('users/annexure-one/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Mechanical Data<br>4.1 - 4.2</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link active" href="{{ URL::to('users/annexure-one-b/' . $general->encodeid($application_id)) }}">
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

                            <form action="{{ URL::to('/users/annexure-one-b')}}" method="POST" id="formAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                <!--    <tr>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="20%">Module Technology</th>
                                                    <td class="text-primary">{{$annexuredata->module_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="15%">Mean Wattage and application Range of Wattage for the Model Module</th>
                                                    <td class="text-primary">{{$annexuredata->applicable_model_covered ?? ''}}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <th>Module Electric Data</th>
                                                    <td colspan="3" class="text-primary">
                                                        @if(($annexuredata->electrical_data_type ?? '')==1)STC @else
                                                        NOCT @endif</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td>
                                            <table class="table table-bordered text-center">
                                                <tr>
                                                    <!-- <th>S.No</th> -->
                                                    <!-- <th width="10%">Applicable models covered under ± 5% of Mean Wattage
                                                    </th> -->
                                                    <th width="10%">Pmax (Wp)<small class="text-danger"> * </small> </th>
                                                    <th>Power output Tolerance-Pmax(W)<small class="text-danger"> * </small></th>
                                                    <th>Vmp (V)<small class="text-danger"> * </small></th>
                                                    <th>Imp (A)<small class="text-danger"> * </small></th>
                                                    <th>Voc (V)<small class="text-danger"> * </small></th>
                                                    <th>Isc (A)<small class="text-danger"> * </small></th>
                                                    <!-- <th>Module Efficiency (%)<small class="text-danger"> * </small></th>
                                                    <th>Fill Factor<small class="text-danger"> * </small></th> -->

                                                </tr>
                                                <tbody id="add-data">
                                             
                                                    @if(!Empty($annexuredata))
                                                 
                                                    <tr class="record">
                                                        
                                                        <td><input type="number" min="0"
                                                                name="pmax" id="pmax_"
                                                                placeholder="Enter Pmax (Wp) " value="{{ $annexuredata['pmax'] ?? '' }}">
                                                            <i name="pmax."></i>
                                                        </td>
                                                        <td> <input type="number" min="0"
                                                                name="power_output" id="power_output_"
                                                                placeholder="Enter Power output Tolerance-Pmax (Wp) " value="{{ $annexuredata['power_output'] ?? '' }}">
                                                            <i name="power_output."></i>
                                                           </td>
                                                        <td style="display:none"> <input type="number" min="0"
                                                                name="pmax_watt" id="pmax_watt_"
                                                                placeholder="Enter Pmax (Wp) " value="00"
                                                                data-id="{{ $annexuredata['pmax_watt'] ?? '' }}">
                                                            <i name="pmax_watt."></i>
                                                        </td>
                                                        <td> <input type="number" min="0" step="any" name="vmp"
                                                                id="vmp_"
                                                                placeholder="Enter VMP (V) "
                                                                value="{{ $annexuredata['vmp'] ?? '' }}">
                                                            <i name="vmp."></i>
                                                        </td>
                                                        <td> <input type="number" name="imp"
                                                                id="imp_" min="0" step="any"
                                                                placeholder="Enter Imp (A)"
                                                                value="{{ $annexuredata['imp'] ?? '' }}">
                                                            <i name="imp."></i>
                                                        </td>
                                                        <td><input type="number" name="voc"
                                                                id="voc_" min="0" step="any"
                                                                placeholder="Enter Voc (V)"
                                                                value="{{ $annexuredata['voc'] ?? '' }}">
                                                            <i name="voc."></i>
                                                        </td>

                                                        <td><input type="number" name="isc"
                                                                id="isc_" min="0" step="any"
                                                                placeholder="Enter Isc (A)"
                                                                value="{{ $annexuredata['isc'] ?? '' }}">
                                                            <i name="isc."></i>
                                                        </td>
                                                        <!-- <td><input type="number" name="model_efficiency"
                                                                id="model_efficiency_" min="0"
                                                                step="any" max="100"
                                                                placeholder="Enter Module Efficiency (%)"
                                                                value="{{ $annexuredata['model_efficiency'] ?? '' }}">
                                                            <i name="model_efficiency."></i>
                                                        </td>
                                                        <td class="text-left"><input type="text" name="fill_factor"
                                                                id="fill_factor_" min="0" step="any"
                                                                placeholder="Enter Fill Factor"
                                                                value="{{ $annexuredata['fill_factor'] ?? '' }}">
                                                            <i name="fill_factor."></i> -->
                                                            <!-- if() -->
                                                            <!-- <input type="checkbox" name="same"
                                                                id="same"
                                                                onchange="copydata()"
                                                                style="font-size:12px;"> <span
                                                                class="text-primary same_as_above">Autofill as filled
                                                                above</span> -->
                                                            <!-- endif -->
                                                        </td>
                                                    </tr>
                                                    
                                                    @endif
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="submit" name="submit" class="btn btn-success" id="submit"><i
                                                    class='bi bi-arrow-bar-up'></i> @if(isset($annexuredata->id) &&
                                                $annexuredata->id !='')Update @else Save @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <input type="hidden" name="electrical_data_type" id="electrical_data_type"
                                                value="1">
                                            <a href="{{URL::to('users/annexure-one-b/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>

                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered text-center  mt-4">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th >4.3</th>
                                            <th scope="col" colspan="13"  class="text-left">Electrical Data at STC
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <!--    <tr>
                                            <th rowspan="2">Sr.No</th>
                                            <th rowspan="2">Module Technology</th>
                                            <th rowspan="2">Mean Wattage and application Range of Wattage for the Model Module</th>
                                            
                                            <th colspan="10" class="text-center">Electrical Data at STC</th>

                                        </tr> -->
                                        <tr>
                                        <th>Sr.No</th>
                                        <th width="15%">Model Names of Solar Modules</th>
                                        <th width="10%">Model Wattage</th>
                                            <th width="10%">Pmax (Wp) </th>
                                            <th width="10%">Power output Tolerance-Pmax(W)</th>
        
                                            <th>Vmp (V)</th>
                                            <th>Imp (A)</th>
                                            <th>Voc (V)</th>
                                            <th>Isc (A)</th>
                                            <th>Module Efficiency (%)</th>
                                            <th width="15%">Fill Factor</th>

                                        </tr>
                                        @php $i=0; @endphp
                                        @foreach($appData as $data)
 
                                        <?php                                    
                                        $rows=Module::where('id',$data->module_type)->first();
                                        ?>
                                        @php $i++;$check=0; @endphp
                                        <tr class="text-center">
                                            <td>{{$i}}</td>
                                            <td>{{ $rows->sub_model_name }}</td>
                                            <td class="">{{ $rows->sub_model_wattage }}</td>
                                            <!-- <td> @if ($data->module_type == 17) 
                                            <?php //$oth=json_decode($data->other_module_title) ; echo $oth[0]; ?>
                                            @else
                                                {{ $data->module_name }}
                                            @endif
                                            </td> -->
                                            <td class="text-center">{{ $data->pmax }}</td>
                                            <td class="text-center">{{ $data->power_output }}</td>
                                            <td style="display:none">{{ $data->pmax_watt }}</td>
                                            <td>{{ $data->vmp }}</td>
                                            <td>{{ $data->imp }}</td>
                                            <td>{{ $data->voc }}</td>
                                            <td>{{ $data->isc }}</td>
                                            <td>{{ $data->model_efficiency }}</td>
                                            <td>{{ $data->fill_factor }}</td>
                                            <td>
                                                <a
                                                    href="{{URL::to('users/annexure-one-b/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/1')}}">Edit
                                                    <i class="bi bi-pencil-square"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </form>
                            <form action="{{ URL::to('/users/annexure-one-b-attachment')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax1">
                                @csrf
                                @method('POST')
                                <hr>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Upload Module Data sheet <span class="text-danger">*</span> <br> <small
                                                class="text-primary">(Max.
                                                2MB and PDF Format
                                                Only)</small>

                                        </td>
                                        <td> <input type="file" name="module_data_sheet" id="module_data_sheet"
                                                class="from-control pdf_file_2mb"
                                                style="width: 26%;margin-right: 10px;" />
                                                <!-- onchange="showUploadButton()" -->
                                            <input type="submit" name="submit" value="upload"
                                                class="btn btn-success btn-sm" />
                                                <!-- style="display: none;" -->
                                            @if($module_data_sheet->module_data_sheet!='')
                                            <span>
                                                <strong><a target="_blank"
                                                        href="{{URL::to($attcBaseUrl.$module_data_sheet->module_data_sheet)}}"
                                                        class="document1 text-danger"
                                                        style="float:right; font-size:12px !important">View
                                                        Electric Data sheet </a></strong>
                                            </span>
                                            @endif <br>
                                            @error('module_data_sheet') <span class="text-danger">
                                                {{ $message }} </span> @enderror
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-one/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    @if($module_data_sheet!=null)
                                    <a href="{{URL::to('users/annexure-one-c/'.$general->encodeid($application_id))}}"
                                        class="btn btn-warning">Next <i class="bi bi-arrow-bar-right"></i></a>
                                    @endif

                                </div>
                            </div>
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
    <script>
    function copydata(id) {
        var chk = $('#same' + id).is(":checked");
        if (chk) {
            $('#pmax_watt_' + id).val($('#pmax_watt_' + (id - 1)).val());
            $('#vmp_' + id).val($('#vmp_' + (id - 1)).val());
            $('#imp_' + id).val($('#imp_' + (id - 1)).val());
            $('#voc_' + id).val($('#voc_' + (id - 1)).val());
            $('#isc_' + id).val($('#isc_' + (id - 1)).val());
            $('#model_efficiency_' + id).val($('#model_efficiency_' + (id - 1)).val());
            $('#fill_factor_' + id).val($('#fill_factor_' + (id - 1)).val());
        } else {
            $('#pmax_watt_' + id).val('');
            $('#vmp_' + id).val('');
            $('#imp_' + id).val('');
            $('#voc_' + id).val('');
            $('#isc_' + id).val('');
            $('#model_efficiency_' + id).val('');
            $('#fill_factor_' + id).val('');
        }
    }
    </script>
    
 <script>
    function showUploadButton() {
        var fileInput = document.getElementById('cell_data_sheet');
        var uploadButton = document.getElementById('uploadButton');
        
        if (fileInput.files.length > 0) {
            uploadButton.style.display = 'inline-block'; 
        } else {
            uploadButton.style.display = 'none';
        }
    }
</script>
    @endsection