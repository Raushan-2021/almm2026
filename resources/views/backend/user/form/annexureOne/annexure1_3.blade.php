@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Details of Solar PV Modules')
@php
$attcBaseUrl ='users/preview-docs/Attachment/';
@endphp
@section('content')
<?php
use App\Models\Module;

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

<li class="nav-item ">
   <a class="nav-link " href="{{ URL::to('users/annexure-one/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Mechanical Data<br>4.1 - 4.2</div>
    </a>
</li>

<li class="nav-item ">
    <a class="nav-link" href="{{ URL::to('users/annexure-one-b/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Electrical Data <br>4.3</div>
    </a>
</li>

<li class="nav-item ">
    <a class="nav-link active href="{{ URL::to('users/annexure-one-c/' . $general->encodeid($application_id)) }}">
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
                            <form action="{{ URL::to('/users/annexure-one-c')}}" method="POST" id="formAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                    <tr>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th colspan="4" class="text-light bg-primary">
                                                        <h4>@if(($type ?? '')==6)
                                                            <!-- 3.6 Temperature Characteristics
                                                            @elseif(($annexuredata->subAnnexureType ?? '') ==4) -->
                                                            <!-- 3.7 Maximum Ratings
                                                            @elseif(($annexuredata->subAnnexureType ?? '') ==5) -->
                                                            <!-- 3.8 Mechanical Data -->
                                                            
                                                            4.4 Solar Cell Specifications
                                                            @elseif(($type ?? '') ==7)
                                                            4.5 Balance of Materials (BoM)
                                                            @endif</h4>

                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th width="20%">Module Technology</th>
                                                    <td class="text-primary">{{$annexuredata->module_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="15%">Mean Wattage and application Range of Wattage for the Model Module</th>
                                                    <td class="text-primary">{{$annexuredata->applicable_model_covered ?? ''}}</td>
                                                </tr>
                                                <!-- <tr>
                                                    <th>Pmax (Wp) of Main Model</th>
                                                    <td colspan="3" class="text-primary">
                                                        {{$annexuredata->pmax_model ?? ''}} Wp</td>
                                                </tr> -->

                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        
                                            <!-- 3.7 Input -->
                                            
                                             <!-- 3.9 Input -->
                                            <table class="table table-bordered text-center module_type"
                                                id="module_type6"
                                                style="display:@if(($type ?? '')==6) @else none @endif">
                                                <tr>
                                                     <!-- <th>S.No</th> -->
                                                    <th>Technology type of solar cells</th>
                                                    <!-- <th>No. of solar cells<small class="text-danger"> * </small></th> -->
                                                    <th>Minimum Efficiency of Solar Cell (%)<small class="text-danger"> * </small></th>
                                                    <th>Maximum Efficiency of Solar Cell (%)<small class="text-danger"> * </small></th>
                                                    <th>Minimum Wattage of Solar Cell (%)<small class="text-danger"> * </small></th>
                                                    <th>Maximum Wattage of Solar Cell (%)<small class="text-danger"> * </small></th>
                                                    <th>Solar Cell Dimention (in mm * mm) <small class="text-danger"> * </small></th>
                                                    <th>Solar Cell Dimention (in mm * mm) <small class="text-danger"> * </small></th>
                                                    <th>No. of bus bars per solar cell<small class="text-danger"> * </small></th>
                                                </tr>
                                                <tbody id="add-data-6">
                                                    @if(!Empty($annexuredata))
                                                   
                                                    <tr class="record">
                                                     
                                                    <td> <input type="text" name="cell_technology"
                                                                id="cell_technology_"
                                                                placeholder="Enter Technology type of solar cells"
                                                                maxlength="100"
                                                                class="data- csc_cell_technology"
                                                                value="{{ $annexuredata['cell_technology'] ?? '' }}"
                                                                 >
                                                            <i name="cell_technology."></i>
                                                        </td>
                                                        <!-- <td><input type="number" name="cell_total_no"
                                                                id="cell_total_no_" min="0"
                                                                max="999"
                                                                class="data- csc_cell_total_no"
                                                                placeholder="Enter No of Cells in a Module"
                                                                value="{{ $annexuredata['cell_total_no'] ?? ''  }}">
                                                            <i name="cell_total_no."></i>
                                                        </td> -->
                                                        <td><input type="number" min="0" step="any"
                                                                name="cell_min_efficiency"
                                                                id="cell_min_efficiency_"
                                                                class="data-  csc_cell_efficiency"
                                                                placeholder="Enter Efficiency of solar cells"
                                                                value="{{ $annexuredata['cell_min_efficiency'] ?? '' }}"
                                                                  >
                                                            <i name="cell_efficiency."></i>
                                                        </td>

                                                        <td><input type="number" min="0" step="any"
                                                                name="cell_max_efficiency"
                                                                id="cell_max_efficiency_"
                                                                class="data-  csc_cell_efficiency"
                                                                placeholder="Enter Efficiency of solar cells"
                                                                value="{{ $annexuredata['cell_max_efficiency'] ?? '' }}"
                                                                  >
                                                            <i name="cell_efficiency."></i>
                                                        </td>
                                                        
                                                        <td><input type="number" name="cell_min_wattage"
                                                                id="cell_min_wattage_" min="0"
                                                                step="any"
                                                                class="data- csc_cell_wattage"
                                                                placeholder="Enter Wattage of full solar cells (Wp)"
                                                                value="{{ $annexuredata['cell_min_wattage'] ?? '' }}"
                                                                  >
                                                            <i name="cell_wattage."></i>
                                                        </td>
                                                        <!-- <td>{{$annexuredata->applicable_model_covered ?? ''}}
                                                            Wp
                                                        </td>  -->
                                                                                            
                                                        <td><input type="number" name="cell_max_wattage"
                                                                id="cell_max_wattage_" min="0"
                                                                step="any"
                                                                class="data- csc_cell_wattage"
                                                                placeholder="Enter Wattage of full solar cells (Wp)"
                                                                value="{{ $annexuredata['cell_max_wattage'] ?? '' }}"
                                                                  >
                                                            <i name="cell_wattage."></i>
                                                        </td>
                                                       
                                                       
                                                    
                                                        <td><input type="number" name="cell_demension_one"
                                                                id="cell_dimension_" min="0"
                                                                step="any"
                                                                class="data- csc_cell_dimension"
                                                                placeholder="Enter Dimension (in mm) and area of (in mm²)"
                                                                value="{{ $annexuredata['cell_demension_one'] ?? '' }}"
                                                                 >
                                                            <i name="cell_demension_one."></i>
                                                        </td>

                                                        <td><input type="number" name="cell_demension_two"
                                                                id="cell_demension_two_" min="0"
                                                                step="any"
                                                                class="data- csc_cell_dimension"
                                                                placeholder="Enter Dimension (in mm) and area of (in mm²)"
                                                                value="{{ $annexuredata['cell_demension_two'] ?? '' }}"
                                                                 >
                                                            <i name="cell_demension_two."></i>
                                                        </td>
                                                       
                                                        <td class="text-left"><input type="number"
                                                                name="cell_total_bus"
                                                                id="cell_total_bus_" min="0"
                                                                max="999"
                                                                class="data- csc_cell_total_bus"
                                                                placeholder="Enter Number of bus bars per cell"
                                                                value="{{ $annexuredata['cell_total_bus'] ?? '' }}"
                                                                >
                                                            <i name="cell_total_bus."></i>
                                                            

                                                           
                                                    </tr>
                                                   
                                                    @endif
                                                </tbody>
                                            </table>
                                             <!-- 3.10 Input -->
                                             <table class="table table-bordered text-center module_type"
                                                id="module_type7"
                                                style="display:@if(($type ?? '')==7) @else none @endif">
                                                <tr>
                                                <tr>
                                                     <!-- <th>S.No</th> -->
                                                    <!-- <th>Sub Supplier<small class="text-danger"> * </small></th> -->
                                                    <th>Front Cover<small class="text-danger"> * </small></th>
                                                    <th>Back Cover<small class="text-danger"> * </small></th>
                                                    <th>Frame<small class="text-danger"> * </small></th>
                                                    <th>Adhesive<small class="text-danger"> * </small></th>
                                                    <th>Encapsulate<small class="text-danger"> * </small></th>
                                                    <th>Junction Box<small class="text-danger"> * </small></th>
                                                    <th>Other Components(if Any)<small class="text-danger"> * </small></th>
                                                    <!-- <th>Cable<small class="text-danger"> * </small></th>
                                                    <th>By pass Diode<small class="text-danger"> * </small></th>  -->
                                            
                                                </tr>
                                                <tbody id="add-data-7">
                                                @if(!Empty($type) && $type==7)
                                                   
                                                    <tr class="record">
                                                    <!-- <td><input type="text" name="sub_supplier"
                                                                id="sub_supplier_" min="0"
                                                                max="999"
                                                                class="data- sub_supplier"
                                                                placeholder="Enter No of Cells in a Module"
                                                                value="{{ $annexuredata['sub_supplier'] ?? ''  }}" >
                                                            <i name="sub_supplier."></i>
                                                        </td> -->
                                                     <td><input type="text" name="front_cover"
                                                                id="front_cover_" min="0"
                                                                max="999"
                                                                class="data- front_cover"
                                                                placeholder="Enter Front Cover"
                                                                value="{{ $annexuredata['front_cover'] ?? ''  }}" >
                                                            <i name="sub-supplier."></i>
                                                        </td>
                                                        
                                                        <td><input type="text" name="back_cover"
                                                                id="back_cover_" min="0"
                                                                max="999"
                                                                class="data- back_cover"
                                                                placeholder="Enter Back Cover"
                                                                value="{{ $annexuredata['back_cover'] ?? ''  }}" >
                                                            <i name="back_cover."></i>
                                                        </td>
                                                        <td><input type="text" min="0" step="any"
                                                                name="frame"
                                                                id="frame_"
                                                                class="data- frame"
                                                                placeholder="Enter Frame"
                                                                value="{{ $annexuredata['frame'] ?? '' }}"
                                                                  >
                                                            <i name="frame."></i>
                                                        </td>
                                                        <td><input type="text" name="adhesive"
                                                                id="adhesive_" min="0"
                                                                step="any"
                                                                class="data- adhesive"
                                                                placeholder="Enter Adhesive"
                                                                value="{{ $annexuredata['adhesive'] ?? '' }}"
                                                                  >
                                                            <i name="adhesive."></i>
                                                        </td>
                                                        <td> <input type="text" name="encapsulate"
                                                                id="encapsulate_"
                                                                placeholder="Enter Encapsulate"
                                                                maxlength="100"
                                                                class="data- encapsulate"
                                                                value="{{ $annexuredata['encapsulate'] ?? '' }}"
                                                                 >
                                                            <i name="encapsulate."></i>
                                                        </td>
                                                        <td> <input type="text" name="junction_box"
                                                                id="junction_box_"
                                                                placeholder="Enter Junction Box"
                                                                maxlength="100"
                                                                class="data- junction_box"
                                                                value="{{ $annexuredata['junction_box'] ?? '' }}"
                                                                 >
                                                            <i name="junction_box."></i>
                                                        </td>
                                                        <td> <input type="text" name="connector"
                                                                id="connector_"
                                                                placeholder="Enter Other Components(if Any)"
                                                                maxlength="100"
                                                                class="data- connector"
                                                                value="{{ $annexuredata['connector'] ?? '' }}"
                                                                 >
                                                            <i name="connector."></i>
                                                        </td>
                                                       
                                                        <!-- <td><input type="text" name="cable"
                                                                id="cable_" min="0"
                                                                step="any"
                                                                class="data- cable"
                                                                placeholder="Enter Dimension (in mm) and area of (in mm²)"
                                                                value="{{ $annexuredata['cable'] ?? '' }}"
                                                                 >
                                                            <i name="cable."></i>
                                                        </td> -->

                                                        <!-- <td class="text-left"><input type="text"
                                                                name="bypass_diode"
                                                                id="bypass_diode_" min="0"
                                                                max="999"
                                                                class="data- bypass_diode"
                                                                placeholder="Enter Number of bus bars per cell"
                                                                value="{{ $annexuredata['bypass_diode'] ?? '' }}"
                                                                >
                                                            <i name="bypass_diode."></i> -->
                                                            
                                                            <!-- <input type="checkbox" name="same"
                                                                id="sameSCS"
                                                                onchange="copydataSCS()"
                                                                style="font-size:12px;"> <span
                                                                class="text-primary same_as_above">Autofill as filled
                                                                above</span> -->
                                                            
                                                        <!-- </td> -->
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
                                            <input type="hidden" name="sub_annexure_type" id="sub_annexure_type"
                                                value="{{$type ?? ''}}">
                                            <a href="{{URL::to('users/annexure-one-c/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>
                                        </td>
                                    </tr>
                                </table>


                            </form>

                            <!-- Start Annaxture 3.4 - 3.7 -->
                            <style>
                                .solar_cell_table .table>:not(:last-child)>:last-child>* {
                                    border-bottom-color: inherit!important;
                                }
                            </style>
                           <div class="trable-responsive solar_cell_table">
                           <table class="table table-bordered ">
                                <thead>
                                <tr class="bg-primary text-white">
                                        <th>4.4</th>
                                        <th scope="col" colspan="14" class="text-left">Solar Cell Specifications</th>
                                    </tr>
                                <tr>
                                    <th rowspan="2" style="text-align:center; vertical-align: top;">S.No</th>
                                    <th rowspan="2" style="text-align:center; vertical-align: top;">Model Names of Solar Modules</th>
                                    <th rowspan="2" style="text-align:center; vertical-align: top;">Module Wattage</th>
                                    <th rowspan="2" style="text-align:center; vertical-align: top;">Technology type of solar cells</th>
                                    <th rowspan="2" style="text-align:center; vertical-align: top;">No. of solar cells & type.Type will be full/half cut etc.</th>
                                    <th colspan="2" style="text-align:center; vertical-align: top;">Efficiency Range of Solar Cell</th>
                                    <th colspan="2" style="text-align:center; vertical-align: top;">Wattage Range of Solar Cell (%)</th>
                                    <th colspan="3" style="text-align:center; vertical-align: top;">Solar Cell Dimention (in mm * mm)</th>
                                    <th rowspan="2" style="text-align:center; vertical-align: top;">No. of bus bars per solar cell</th>
                                    <th rowspan="2" style="text-align:center; vertical-align: top;">Action</th>
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
                                            <td><a href="{{URL::to('users/annexure-one-c/' .$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/6')}}">Edit
                                            <i class="bi bi-pencil-square"></i></a></td>
                                </tr>
                                @endforeach 
                                </tbody>
                            </table>
                           </div>
                            
                             <!-- 3.9 Display View  -->
                            <!-- <div style="overflow-x:auto;">
                            <table class="table table-bordered text-center table-responsive mt-4">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th>4.9</th>
                                        <th scope="col" colspan="14" class="text-left">Solar Cell Specifications</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th rowspan="2">S.No</th>
                                        <th rowspan="2">Technology Type</th>
                                        <th rowspan="2" width="15%">Mean Wattage and application Range of Wattage</th>
                                        <th colspan="4" class="text-center">Solar Cell Specifications</th>
                                        <th width="10%"></th>
                                    </tr>
                                    <tr>
                                        <th>No. of solar Cells </th>
                                        <th>Efficiency of solar cells</th>
                                        <th>Wattage of solar cells</th> -->
                                        <!-- <th>Base Materail Doping Type (n-type/p-type)</th> -->
                                        <!-- <th>Dimension (in mm) and area of (in mm²)<br> individual solar cell</th> -->
                                        <!-- <th>Cell Type used in module (Full/Half/Cut)</th> -->
                                        <!-- <th>Number of bus bars per cell</th> -->
                                    <!-- </tr> -->
                                    <!-- @php $d=0; @endphp
                                
                                    @php $d++;$check=0; @endphp
                                    <tr>
                                        <td></td>
                                        <td> -->
                                            <!-- @if ($data->module_type == 17)     
                                                @else
                                                    {{ $data->module_name }}
                                                @endif 
                                            @if($data->module_name=='Other')
                                                <?php //echo $data->other; ?>
                                                @endif -->
                                        <!-- </td>
                                        <td></td>
                                        <td> -->
                                            <!-- <table width="100%">
                                                
                                            </table> -->
                                        <!-- </td>
                                        <td> -->
                                            <!-- <table width="100%">
                                                
                                            </table> -->
                                        <!-- </td>
                                        <td> -->
                                            <!-- <table width="100%">
                                               
                                            </table> -->
                                        <!-- </td> -->

                                        <!-- <td>
                                            <table width="100%">
                                                
                                            </table>
                                        </td> -->
                                        
                                        <!-- <td> -->
                                            <!-- <table width="100%">
                                               
                                            </table> -->
                                        <!-- </td> -->
                                        <!-- <td>
                                            <table width="100%">
                                               
                                            </table>
                                        </td> -->
                                        
                                        <!-- <td> -->
                                            <!-- <table width="100%">
                                               
                                            </table> -->
                                        <!-- </td> -->
                                        <!-- <td>
                                            <a
                                                href="{{URL::to('users/annexure-one-c/' .$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/6')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td> -->

                                    </tr>
                             

                                </tbody>
                            </table>
                            </div>
                            <form action="{{ URL::to('/users/annexure-one-c-attachment')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax1">
                                @csrf
                                @method('POST')
                                <hr>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Upload Cell data sheet <span class="text-danger">*</span> <br> <small
                                                class="text-primary">(Max.
                                                2MB and PDF Format
                                                Only)</small>

                                        </td>
                                        <td> <input type="file" name="cell_data_sheet" id="cell_data_sheet"
                                                class="from-control pdf_file_2mb"
                                                style="width: 26%;margin-right: 10px;"  />
                                                <!-- onchange="showUploadButton()" -->
                                            <input type="submit" name="submit" value="upload"
                                                class="btn btn-success btn-sm" />
                                                <!-- style="display: none;" -->
                                            @if($cell_data_sheet->cell_data_sheet!='')
                                            <span>
                                                <strong><a target="_blank"
                                                        href="{{URL::to($attcBaseUrl.$cell_data_sheet->cell_data_sheet)}}"
                                                        class="document1 text-danger"
                                                        style="float:right; font-size:12px !important">View
                                                        Cell data sheet </a></strong>
                                            </span>
                                            @endif <br>
                                            @error('cell_data_sheet') <span class="text-danger">
                                                {{ $message }} </span> @enderror
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                        </td>
                                        
                                    </tr>
                                </table>
                            </form>
                            <!-- 3.10 Display View  -->
                            <div style="overflow-x:auto;">
                            <table class="table table-bordered text-center table-responsive mt-4">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th>4.5</th>
                                        <th scope="col" colspan="14" class="text-left">Balance of Materials (BoM)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th rowspan="2">S.No</th>
                                        <th rowspan="2">Model Names of Solar Modules</th>
                                        <th rowspan="2" width="15%">Module Wattage </th>
                                        <th colspan="10" class="text-center">Name of Company and location of manufacturing unit of supplier(s) of </th>
                                        <!-- <th width="10%"></th> -->
                                    </tr>
                                    <tr>
                                        <!-- <th>Sub Supplier </th> -->
                                        <th>Front Cover </th>
                                        <th>Back Cover</th>
                                        <th>Frame</th>
                                        <th>Adhesive</th>
                                        <th>Encapsulate</th>
                                        <th>Junction Box</th>
                                        <th>Other Components(if Any)</th>
                                        <th>Action</th>
                                        <!-- <th>Cable </th>
                                        <th>By pass Diode </th> -->
                                    </tr>
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
                                        <td>{{ $data->connector }} </td>
                                        <td>
                                            <a href="{{URL::to('users/annexure-one-c/' .$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/7')}}">Edit
                                            <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach 

                                </tbody>
                            </table>
                            </div>
                            <!-- Upload BOM sheet  -->
                            <form action="{{ URL::to('/users/annexure-bom-datasheet')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax1">
                                @csrf
                                @method('POST')
                                <!-- <hr> -->
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Upload BoM Data sheet <span class="text-danger">*</span> <br> <small
                                                class="text-primary">(Max.
                                                2MB and PDF Format
                                                Only)</small>
                                        </td>
                                        <td> <input type="file" name="bom_data_sheet" id="bom_data_sheet"
                                                class="from-control pdf_file_2mb"
                                                style="width: 26%;margin-right: 10px;"  />
                                                <!-- onchange="showUploadButton()" -->
                                            <input type="submit" name="submit" value="upload"
                                                class="btn btn-success btn-sm" />
                                                <!-- style="display: none;" -->
                                            @if($bom_data_sheet->bom_data_sheet!='')
                                            <span>
                                                <strong><a target="_blank"
                                                        href="{{URL::to($attcBaseUrl.$bom_data_sheet->bom_data_sheet)}}"
                                                        class="document1 text-danger"
                                                        style="float:right; font-size:12px !important">View
                                                        BoM Data sheet </a></strong>
                                            </span>
                                            @endif <br>
                                            @error('bom_data_sheet') <span class="text-danger">
                                                {{ $message }} </span> @enderror
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                        </td>
                                        
                                    </tr>
                                </table>
                            </form>
                            

                            

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-one-b/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                        <!-- $check>0 && $cell_data_sheet->cell_data_sheet!='' -->
                                    @if( $cell_data_sheet->cell_data_sheet!='')
                                    <a href="{{URL::to('users/annexure-three/'.$general->encodeid($application_id))}}"
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
        .note {
            display: block;
        }
        .note.hidden {
            display: none;
        }
    </style>
    <script>
    function hideNote() {
        document.getElementById('note').classList.add('hidden');
    }
</script>
    <style>
    .max-char {
        position: absolute;
        right: 35px;
        margin-top: -24px;
    }
    </style>
    <script>
    function calculateArea(id) {

        var length_mm = $('#module_length_' + id).val();
        var breadth_mm = $('#module_breadth_' + id).val();
        if (breadth_mm > 0) {
            var area_mm = (length_mm * breadth_mm) / 1000000;
            $('#module_area_' + id).val(area_mm);
            $('.md_module_area').val(area_mm);
        }
    }

    function copydata(id) {
        $('.data-' + id).val('');
        var chk = $('#same' + id).is(":checked");
        if (chk) {
            $('#operation_temp_' + id).val($('#operation_temp_' + (id - 1)).val());
            $('#max_voltage_' + id).val($('#max_voltage_' + (id - 1)).val());
            $('#max_fuse_rating_' + id).val($('#max_fuse_rating_' + (id - 1)).val());
            $('#max_fuse_rating_' + id).val($('#max_fuse_rating_' + (id - 1)).val());
            $('#diode_rating_' + id).val($('#diode_rating_' + (id - 1)).val());
            $('#fire_rating_' + id).val($('#fire_rating_' + (id - 1)).val());
            $('#warrenty_details_' + id).val($('#warrenty_details_' + (id - 1)).val());
        }
    }

    function copydataMTC(id) {
        $('.data-' + id).val('');
        var chk = $('#sameMTC' + id).is(":checked");
        if (chk) {
            // MTC - Module Temperature Characteristics
            $('#pmax_watt_' + id).val($('#pmax_watt_' + (id - 1)).val());
            $('#voc_' + id).val($('#voc_' + (id - 1)).val());
            $('#isc_' + id).val($('#isc_' + (id - 1)).val());
        }
    }

    function copydataMD(id) {
        $('.data-' + id).val('');
        var chk = $('#sameMD' + id).is(":checked");
        if (chk) {
            // MTC - Module Temperature Characteristics
            $('#module_length_' + id).val($('#module_length_' + (id - 1)).val());
            $('#module_breadth_' + id).val($('#module_breadth_' + (id - 1)).val());
            $('#module_area_' + id).val($('#module_area_' + (id - 1)).val());
            $('#module_weight_' + id).val($('#module_weight_' + (id - 1)).val());
        }
    }

    function copydataSCS(id) {
        $('.data-' + id).val('');
        var chk = $('#sameSCS' + id).is(":checked");
        if (chk) {
            // MTC - Module Temperature Characteristics
            $('#cell_technology_' + id).val($('#cell_technology_' + (id - 1)).val());
            $('#cell_efficiency_' + id).val($('#cell_efficiency_' + (id - 1)).val());
            $('#cell_wattage_' + id).val($('#cell_wattage_' + (id - 1)).val());
            $('#cell_dimension_' + id).val($('#cell_dimension_' + (id - 1)).val());
            $('#cell_type_' + id).val($('#cell_type_' + (id - 1)).val());
            $('#cell_total_no_' + id).val($('#cell_total_no_' + (id - 1)).val());
            $('#cell_total_bus_' + id).val($('#cell_total_bus_' + (id - 1)).val());
        }
    }
    </script>
    @endsection
    @push('backend-js')
    <script>
    $(document).ready(function() {
        // 3.4 Module Operational Ratings
        $('.mor_max_voltage').blur(function(e) {
            $('.mor_max_voltage').val($(this).val());
        });
        $('.mor_max_fuse_rating').blur(function(e) {
            $('.mor_max_fuse_rating').val($(this).val());
        });
        $('.mor_diode_rating').blur(function(e) {
            $('.mor_diode_rating').val($(this).val());
        });
        $('.mor_fire_rating').blur(function(e) {
            $('.mor_fire_rating').val($(this).val());
        });
        $('.mor_warrenty_details').blur(function(e) {
            $('.mor_warrenty_details').val($(this).val());
        });

        // 3.5 Module Temperature Characteristics
        $('.mtc_pmax_watt').blur(function(e) {
            $('.mtc_pmax_watt').val($(this).val());
        });
        $('.mtc_voc').blur(function(e) {
            $('.mtc_voc').val($(this).val());
        });
        $('.mtc_isc').blur(function(e) {
            $('.mtc_isc').val($(this).val());
        });

        //3.6 Module Dimensions
        $('.md_module_length').blur(function(e) {
            $('.md_module_length').val($(this).val());
        });
        $('.md_module_breadth').blur(function(e) {
            $('.md_module_breadth').val($(this).val());
        });
        // $('.md_module_area').blur(function(e) {
        //     $('.md_module_area').val($(this).val());
        // });
        $('.md_module_area').change(function(e) {
            $('.md_module_area').val($(this).val());
        });
        $('.md_module_weight').blur(function(e) {
            $('.md_module_weight').val($(this).val());
        });


        // 3.7 Solar Cell Specifications
        // $('.csc_cell_technology').blur(function(e) {
        //     $('.csc_cell_technology').val($(this).val());
        // });
        // $('.csc_cell_efficiency').blur(function(e) {
        //     $('.csc_cell_efficiency').val($(this).val());
        // });
        // $('.csc_cell_wattage').blur(function(e) {
        //     $('.csc_cell_wattage').val($(this).val());
        // });
        // $('.csc_cell_dimension').blur(function(e) {
        //     $('.csc_cell_dimension').val($(this).val());
        // });
        // $('.csc_cell_total_no').blur(function(e) {
        //     $('.csc_cell_total_no').val($(this).val());
        // });
        // $('.csc_cell_total_bus').blur(function(e) {
        //     $('.csc_cell_total_bus').val($(this).val());
        // });
        // $('.csc_cell_type').change(function(e) {
        //     $('.csc_cell_type').val($(this).val());
        // });
    });
    </script>
    <script>
    function showUploadButton() {
        var fileInput = document.getElementById('cell_data_sheet');
        var uploadButton = document.getElementById('uploadButton');
        
        if (fileInput.files.length > 0) {
            uploadButton.style.display = 'inline-block'; // Show the upload button
        } else {
            uploadButton.style.display = 'none'; // Hide the upload button if no file is selected
        }
    }
</script>

    @endpush