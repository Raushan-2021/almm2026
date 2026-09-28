@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Details of Solar PV Modules')
@php
$attcBaseUrl ='users/preview-docs/Attachment/';
@endphp
@section('content')

<div class="row">
    @include('backend.user.form._stepper')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
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
                                                        <h4>@if(($annexuredata->subAnnexureType ?? '')==3)
                                                            3.4 Module Operational Ratings
                                                            @elseif(($annexuredata->subAnnexureType ?? '') ==4)
                                                            3.5 Module Temperature Characteristics
                                                            @elseif(($annexuredata->subAnnexureType ?? '') ==5)
                                                            3.6 Module Dimensions
                                                            @elseif(($annexuredata->subAnnexureType ?? '') ==6)
                                                            3.7 Solar Cell Specifications
                                                            @endif</h4>

                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th width="20%">Module Technology</th>
                                                    <td class="text-primary">{{$annexuredata->module_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="15%">Representative Main Model</th>
                                                    <td class="text-primary">{{$annexuredata->main_model ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pmax (Wp) of Main Model</th>
                                                    <td colspan="3" class="text-primary">
                                                        {{$annexuredata->pmax_model ?? ''}} Wp</td>
                                                </tr>

                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered text-center module_type"
                                                id="module_type3"
                                                style="display:@if(($annexuredata->subAnnexureType ?? '')==3) @else none @endif">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Applicable models covered under ± 5% of Mean
                                                        Wattage</th>
                                                    <th>Pmax (Wp) of Applicable Models Model</th>
                                                    <!-- <th>Operational Temperature (ᴼC)</th> -->
                                                    <th>Maximum System Voltage (V)<small class="text-danger"> * </small></th>
                                                    <th>Maximum Fuse Rating (A)<small class="text-danger"> * </small></th>
                                                    <th>By-pass Diode Rating<small class="text-danger"> * </small></th>
                                                    <th>Fire Rating<br><i class="text-primary">(Maximum 50
                                                            Characters)<small class="text-danger"> * </small></i>
                                                    </th>
                                                    <th>Warranty Details <br><i class="text-primary">(Maximum 200
                                                            Characters)<small class="text-danger"> * </small></i></th>

                                                </tr>
                                                <tbody id="add-data-3">
                                                    @if(!Empty($annexuredata))
                                                    @foreach($annexuredata->applicable_model_covered as $value)
                                                    <tr class="record">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$annexuredata->applicable_model_covered[$loop->iteration-1] ?? ''}}
                                                        </td>
                                                        <td>{{$annexuredata->applicable_model[$loop->iteration-1] ?? ''}}
                                                            Wp
                                                        </td>
                                                        <td style="display:none">
                                                            <!-- {{ $annexuredata['annexure'][$loop->iteration-1]['operation_temp'] ?? '' }}     -->
                                                            <input type="number" step="any" name="operation_temp[]"
                                                                placeholder=" Operational Temperature (ᴼC)"
                                                                id="operation_temp_{{$loop->iteration}}"
                                                                class="form-control data-{{$loop->iteration}} mor_operation_temp"
                                                                maxlength="70" value="0" @if($loop->iteration>1)
                                                            readonly @endif>
                                                            <i name="operation_temp.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="number" min="0" step="any" name="max_voltage[]"
                                                                placeholder="Maximum System Voltage (V)"
                                                                id="max_voltage_{{$loop->iteration}}"
                                                                class="form-control data-{{$loop->iteration}} mor_max_voltage"
                                                                maxlength="70"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['max_voltage'] ?? '' }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="max_voltage.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="number" min="0" step="any"
                                                                name="max_fuse_rating[]"
                                                                placeholder="Maximum Fuse Rating"
                                                                id="max_fuse_rating_{{$loop->iteration}}"
                                                                class="form-control data-{{$loop->iteration}} mor_max_fuse_rating"
                                                                max="60"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['max_fuse_rating'] ?? '' }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="max_fuse_rating.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="number" min="0" step="any"
                                                                name="diode_rating[]" placeholder="By-pass Diode Rating"
                                                                id="diode_rating_{{$loop->iteration}}"
                                                                class="form-control data-{{$loop->iteration}} mor_diode_rating"
                                                                max="100"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['diode_rating'] ?? '' }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="diode_rating.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="text" name="fire_rating[]"
                                                                placeholder="By-pass Diode Rating"
                                                                id="fire_rating_{{$loop->iteration}}"
                                                                class="form-control data-{{$loop->iteration}} mor_fire_rating"
                                                                maxlength="50"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['fire_rating'] ?? '' }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="fire_rating.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td class="text-left"><input type="text"
                                                                name="warrenty_details[]"
                                                                placeholder="Enter Warranty Details"
                                                                id="warrenty_details_{{$loop->iteration}}"
                                                                class="form-control data-{{$loop->iteration}} mor_warrenty_details"
                                                                maxlength="250"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['warrenty_details'] ?? '' }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="warrenty_details.{{$loop->iteration-1}}"></i>
                                                            @if($loop->iteration>1)
                                                            <input type="checkbox" name="same{{$loop->iteration-1}}"
                                                                id="same{{$loop->iteration}}"
                                                                onchange="copydata({{$loop->iteration}})"
                                                                style="font-size:12px;"> <span
                                                                class="text-primary same_as_above">Autofill as filled
                                                                above</span>
                                                            @endif
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered text-center  module_type"
                                                id="module_type4"
                                                style="display:@if(($annexuredata->subAnnexureType ?? '')==4) @else none @endif; width:100%">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Applicable models covered under ± 5% of Mean Wattage</th>
                                                    <th>Pmax (Wp) of Applicable Models Model</th>
                                                    <th>Temperature Co-efficient of Pmax<small class="text-danger"> * </small></th>
                                                    <th>Temperature Coefficient of Voc<small class="text-danger"> * </small></th>
                                                    <th>Temperature Coefficient of Isc<small class="text-danger"> * </small></th>

                                                </tr>
                                                <tbody id="add-data-4">
                                                    @if(!Empty($annexuredata))
                                                    @foreach($annexuredata->applicable_model_covered as $value)
                                                    <tr class="record">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$annexuredata->applicable_model_covered[$loop->iteration-1] ?? ''}}
                                                        </td>
                                                        <td>{{$annexuredata->applicable_model[$loop->iteration-1] ?? ''}}
                                                            Wp
                                                        </td>
                                                        <td><input type="number" step="any" name="pmax_watt[]"
                                                                placeholder="Enter Temperature Co-efficient of Pmax "
                                                                id="pmax_watt_{{$loop->iteration}}"
                                                                class="form-control data-{{$loop->iteration}} mtc_pmax_watt"
                                                                maxlength="70"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['pmax_watt'] ?? ''  }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="pmax_watt.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="number" min="0" step="any" name="voc[]"
                                                                placeholder="Enter Voc (V)"
                                                                id="voc_{{$loop->iteration}}"
                                                                class="form-control data-{{$loop->iteration}} mtc_voc"
                                                                maxlength="70"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['voc'] ?? '' }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="voc.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td class="text-left"><input type="number" min="0" step="any"
                                                                name="isc[]" placeholder="Enter Isc (A)"
                                                                id="isc_{{$loop->iteration}}"
                                                                class="form-control data-{{$loop->iteration}} mtc_isc"
                                                                maxlength="70"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['isc'] ?? '' }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="isc.{{$loop->iteration-1}}"></i>
                                                            @if($loop->iteration>1)
                                                            <input type="checkbox" name="same{{$loop->iteration-1}}"
                                                                id="sameMTC{{$loop->iteration}}"
                                                                onchange="copydataMTC({{$loop->iteration}})"
                                                                style="font-size:12px;"> <span
                                                                class="text-primary same_as_above">Autofill as filled
                                                                above</span>
                                                            @endif
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered  text-center module_type"
                                                id="module_type5"
                                                style="display:@if(($annexuredata->subAnnexureType ?? '')==5) @else none @endif">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th width="15%">Applicable models covered under ± 5% of Mean Wattage
                                                    </th>
                                                    <th width="15%">Pmax (Wp) of Applicable Models Model</th>
                                                    <th>Length of Module (in mm)<small class="text-danger"> * </small></th>
                                                    <th>Breadth of Module (in mm)<small class="text-danger"> * </small></th>
                                                    <th>Area of Module (LxB) (in m2)<small class="text-danger"> * </small></th>
                                                    <th>Weight (in kg)<small class="text-danger"> * </small></th>

                                                </tr>
                                                <tbody id="add-data-5">
                                                    @if(!Empty($annexuredata))
                                                    @foreach($annexuredata->applicable_model_covered as $value)
                                                    <tr class="record">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$annexuredata->applicable_model_covered[$loop->iteration-1] ?? ''}}
                                                        </td>
                                                        <td>{{$annexuredata->applicable_model[$loop->iteration-1] ?? ''}}
                                                            Wp
                                                        </td>
                                                        <td> <input type="number" min="0" step="any"
                                                                name="module_length[]"
                                                                id="module_length_{{$loop->iteration}}"
                                                                onblur="calculateArea({{$loop->iteration}})"
                                                                placeholder="Enter Length of Module (in mm)"
                                                                class=" data-{{$loop->iteration}} md_module_length"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['module_length'] ?? ''  }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="module_length.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="number" name="module_breadth[]"
                                                                id="module_breadth_{{$loop->iteration}}" min="0"
                                                                onblur="calculateArea({{$loop->iteration}})" step="any"
                                                                placeholder="Enter Breadth of Module (in mm)"
                                                                class="data-{{$loop->iteration}} md_module_breadth"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['module_breadth'] ?? ''  }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="module_breadth.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="number" name="module_area[]"
                                                                id="module_area_{{$loop->iteration}}" min="0" step="any"
                                                                placeholder="Enter Area of Module (LxB) (in m2)"
                                                                class=" data-{{$loop->iteration}} md_module_area"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['module_area'] ?? '' }}"
                                                                readonly @if($loop->iteration>1) @endif>
                                                            <i name="module_area.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td class="text-left"><input type="number"
                                                                name="module_weight[]"
                                                                id="module_weight_{{$loop->iteration}}" min="0"
                                                                step="any" placeholder="Enter Weight (in kg)"
                                                                class=" data-{{$loop->iteration}} md_module_weight"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['module_weight'] ?? '' }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="module_weight.{{$loop->iteration-1}}"></i>
                                                            @if($loop->iteration>1)
                                                            <input type="checkbox" name="same{{$loop->iteration-1}}"
                                                                id="sameMD{{$loop->iteration}}"
                                                                onchange="copydataMD({{$loop->iteration}})"
                                                                style="font-size:12px;"> <span
                                                                class="text-primary same_as_above">Autofill as filled
                                                                above</span>
                                                            @endif
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered text-center module_type"
                                                id="module_type6"
                                                style="display:@if(($annexuredata->subAnnexureType ?? '')==6) @else none @endif">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Applicable models covered under ± 5% of Mean Wattage</th>
                                                    <th>Pmax (Wp) of Applicable Models Model</th>
                                                    <th>Base Material Doping Type (n-type/p-type)<small class="text-danger"> * </small></th>
                                                    <th>Efficiency of solar cells<small class="text-danger"> * </small></th>
                                                    <th>Wattage of full solar cells (Wp)<small class="text-danger"> * </small></th>
                                                    <th>Full Cell Size (Dimension in mm)<small class="text-danger"> * </small></th>
                                                    <th>Cell Type used in module<small class="text-danger"> * </small></th>
                                                    <th>No of Cells in a Module<small class="text-danger"> * </small></th>
                                                    <th>Number of bus bars per cell<small class="text-danger"> * </small></th>

                                                </tr>
                                                <tbody id="add-data-6">
                                                    @if(!Empty($annexuredata))
                                                    @foreach($annexuredata->applicable_model_covered as $value)
                                                    <tr class="record">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$annexuredata->applicable_model_covered[$loop->iteration-1] ?? ''}}
                                                        </td>
                                                        <td>{{$annexuredata->applicable_model[$loop->iteration-1] ?? ''}}
                                                            Wp
                                                        </td>
                                                        <td> <input type="text" name="cell_technology[]"
                                                                id="cell_technology_{{$loop->iteration}}"
                                                                placeholder="Enter Technology type of solar cells"
                                                                maxlength="100"
                                                                class="data-{{$loop->iteration}} csc_cell_technology"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['cell_technology'] ?? '' }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="cell_technology.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="number" min="0" step="any"
                                                                name="cell_efficiency[]"
                                                                id="cell_efficiency_{{$loop->iteration}}"
                                                                class="data-{{$loop->iteration}}  csc_cell_efficiency"
                                                                placeholder="Enter Efficiency of solar cells"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['cell_efficiency'] ?? '' }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="cell_efficiency.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="number" name="cell_wattage[]"
                                                                id="cell_wattage_{{$loop->iteration}}" min="0"
                                                                step="any"
                                                                class="data-{{$loop->iteration}} csc_cell_wattage"
                                                                placeholder="Enter Wattage of full solar cells (Wp)"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['cell_wattage'] ?? '' }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="cell_wattage.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="number" name="cell_dimension[]"
                                                                id="cell_dimension_{{$loop->iteration}}" min="0"
                                                                step="any"
                                                                class="data-{{$loop->iteration}} csc_cell_dimension"
                                                                placeholder="Enter Full Cell Size (Dimension in mm)"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['cell_dimension'] ?? '' }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="cell_dimension.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><select name="cell_type[]"
                                                                id="cell_type_{{$loop->iteration}}"
                                                                class="data-{{$loop->iteration}} csc_cell_type">
                                                                <option value="">Select</option>
                                                                <option value="Full"
                                                                    @if(($annexuredata['annexure'][$loop->
                                                                    iteration-1]['cell_type'] ?? '') == 'Full') selected
                                                                    @endif>Full</option>
                                                                <option value="Half"
                                                                    @if(($annexuredata['annexure'][$loop->
                                                                    iteration-1]['cell_type'] ?? '') == 'Half') selected
                                                                    @endif>Half</option>
                                                                <option value="Cut"
                                                                    @if(($annexuredata['annexure'][$loop->
                                                                    iteration-1]['cell_type'] ?? '') == 'Cut') selected
                                                                    @endif>Cut</option>
                                                            </select>
                                                            <i name="cell_type.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="number" name="cell_total_no[]"
                                                                id="cell_total_no_{{$loop->iteration}}" min="0"
                                                                max="999"
                                                                class="data-{{$loop->iteration}} csc_cell_total_no"
                                                                placeholder="Enter No of Cells in a Module"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['cell_total_no'] ?? ''  }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="cell_total_no.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td class="text-left"><input type="number"
                                                                name="cell_total_bus[]"
                                                                id="cell_total_bus_{{$loop->iteration}}" min="0"
                                                                max="999"
                                                                class="data-{{$loop->iteration}} csc_cell_total_bus"
                                                                placeholder="Enter Number of bus bars per cell"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['cell_total_bus'] ?? '' }}"
                                                                @if($loop->iteration>1) readonly @endif>
                                                            <i name="cell_total_bus.{{$loop->iteration-1}}"></i>
                                                            @if($loop->iteration>1)
                                                            <input type="checkbox" name="same{{$loop->iteration-1}}"
                                                                id="sameSCS{{$loop->iteration}}"
                                                                onchange="copydataSCS({{$loop->iteration}})"
                                                                style="font-size:12px;"> <span
                                                                class="text-primary same_as_above">Autofill as filled
                                                                above</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
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
                                                value="{{$annexuredata->subAnnexureType ?? ''}}">
                                            <a href="{{URL::to('users/annexure-one-c/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>3.4</th>
                                        <th scope="col" colspan="14" class="text-left">Module Operational Ratings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th rowspan="2">S.No</th>
                                        <th rowspan="2">Module Technology</th>
                                        <th rowspan="2">Representative Main Model</th>
                                        <th rowspan="2">Pmax (Wp) of Main Model</th>
                                        <th rowspan="2" width="10%">Applicable models covered under +- 5% of
                                            Mean Wattege</th>
                                        <th rowspan="2" width="10%">Pmax (Wp) of Applicable Models Model</th>
                                        <th colspan="5" class="text-center">Operational Ratings</th>
                                        <th></th>
                                    </tr>
                                    <tr>

                                        <!-- <th>Operational Temperature (ᴼC)</th> -->
                                        <th>Maximum System Voltage (V)</th>
                                        <th>Maximum Fuse Rating (A)</th>
                                        <th>By-pass Diode Rating</th>
                                        <th>Fire Rating</th>
                                        <th>Warranty Details</th>
                                    </tr>
                                    @php $a=0; @endphp
                                    @foreach($appData['AnnexureSub3'] as $data)
                                    @php $a++; @endphp
                                    <tr class="text-center">
                                        <td>{{$a}}</td>
                                        <td> @if ($data->module_type == 17) 
                                                <?php $oth=json_decode($data->other_module_title) ; echo $oth[0]; ?>
                                            @else
                                                {{ $data->module_name }}
                                            @endif</td>
                                        <td>{{$data->main_model}}</td>
                                        <td class="text-center">{{$data->pmax_model}} Wp</td>
                                        <td class="text-center">
                                            <table width="100%">
                                               
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            <table width="100%">
                                               
                                            </table>
                                        </td>
                                        <!-- <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $operation_temp)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $operation_temp->operation_temp }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td> -->
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $max_voltage)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $max_voltage->max_voltage }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>

                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $max_fuse_rating)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $max_fuse_rating->max_fuse_rating }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $diode_rating)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $diode_rating->diode_rating }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $fire_rating)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $fire_rating->fire_rating }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $warrenty_details)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $warrenty_details->warrenty_details }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td width="5%">
                                            <!-- Sub Annexure 3 -->

                                            <a
                                                href="{{URL::to('users/annexure-one-c/' .$general->encodeid($data->application_id).'/' .$general->encodeid($data->id).'/3')}}" onclick="hideNote()">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <br>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>3.5</th>
                                        <th scope="col" colspan="13" class="text-left">Module Temperature
                                            Characteristics</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th rowspan="2">S.No</th>
                                        <th rowspan="2">Module Technology</th>
                                        <th rowspan="2">Representative Main Model</th>
                                        <th rowspan="2">Pmax (Wp) of Main Model</th>
                                        <th rowspan="2" width="15%">Applicable models covered under +- 5% of
                                            Mean Wattege</th>
                                        <th rowspan="2" width="15%">Pmax (Wp) of Applicable Models Model</th>
                                        <th colspan="3" class="text-center">Module Temperature Characteristics</th>
                                        <th width="8%"></th>
                                    </tr>
                                    <tr>

                                        <th>Temperature Co-efficient of Pmax (T)</th>
                                        <th>Temperature Coefficient of Voc (T)</th>
                                        <th>Temperature Coefficient of Isc (T)</th>
                                    </tr>
                                    @php $b=0; @endphp
                                    @foreach($appData['AnnexureSub4'] as $data)
                                    @php $b++; @endphp
                                    <tr>
                                        <td>{{$b}}</td>
                                        <td> @if ($data->module_type == 17) 
                                                <?php $oth=json_decode($data->other_module_title) ; echo $oth[0]; ?>
                                            @else
                                                {{ $data->module_name }}
                                            @endif</td>
                                        <td>{{$data->main_model}}</td>
                                        <td class="text-center">{{$data->pmax_model}} Wp</td>
                                        <td class="text-center">
                                            <table width="100%">
                                               
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            <table width="100%">
                                               
                                            </table>
                                        </td>

                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $pmax_watt)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $pmax_watt->pmax_watt }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $voc)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $voc->voc }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $isc)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $isc->isc }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <a
                                                href="{{URL::to('users/annexure-one-c/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/4')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table><br>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>3.6</th>
                                        <th scope="col" colspan="13" class="text-left">Module Dimensions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th rowspan="2">S.No</th>
                                        <th rowspan="2">Module Technology</th>
                                        <th rowspan="2">Representative Main Model</th>
                                        <th rowspan="2">Pmax (Wp) of Main Model</th>
                                        <th rowspan="2" width="15%">Applicable models covered under +- 5% of
                                            Mean Wattege</th>
                                        <th rowspan="2" width="15%">Pmax (Wp) of Applicable Models Model</th>
                                        <th colspan="4" class="text-center">Solar Cell Specifications</th>
                                        <th width="8%"></th>
                                    </tr>
                                    <tr>

                                        <th>Length of Module (in mm)</th>
                                        <th>Breadth of Module (in mm)</th>
                                        <th>Area of Module (LxB) (in m2)</th>
                                        <th>Weight (in kg)</th>
                                    </tr>
                                    @php $c=0; @endphp
                                    @foreach($appData['AnnexureSub5'] as $data)
                                    @php $c++; @endphp
                                    <tr>
                                        <td>{{$c}}</td>
                                        <td> @if ($data->module_type == 17) 
                                                <?php $oth=json_decode($data->other_module_title) ; echo $oth[0]; ?>
                                            @else
                                                {{ $data->module_name }}
                                            @endif</td>
                                        <td>{{$data->main_model}}</td>
                                        <td class="text-center">{{$data->pmax_model}} Wp</td>
                                        <td class="text-center">
                                            <table width="100%">
                                               
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            <table width="100%">
                                                
                                            </table>
                                        </td>


                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $module_length)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $module_length->module_length }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $module_breadth)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $module_breadth->module_breadth }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $module_area)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $module_area->module_area }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $module_weight)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $module_weight->module_weight }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <a href="{{URL::to('users/annexure-one-c/'.$general->encodeid($data->application_id). '/'.$general->encodeid($data->id).'/5')}}">
                                                Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>
                                        <!-- <span style="color:red;">Empty Field Edit after show Next Button </span> -->
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table><br>
                            <div style="overflow-x:auto;">
                            <table class="table table-bordered text-center table-responsive">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>3.7</th>
                                        <th scope="col" colspan="14" class="text-left">Solar Cell Specifications</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th rowspan="2">S.No</th>
                                        <th rowspan="2">Module Technology</th>
                                        <th rowspan="2">Representative Main Model</th>
                                        <th rowspan="2">Pmax (Wp) of Main Model</th>
                                        <th rowspan="2" width="15%">Applicable models covered under +- 5% of
                                            Mean Wattege</th>
                                        <th rowspan="2" width="15%">Pmax (Wp) of Applicable Models Model</th>
                                        <th colspan="4" class="text-center">Solar Cell Specifications</th>
                                        <th width="10%"></th>
                                    </tr>
                                    <tr>

                                        <th>Base Materail Doping Type (n-type/p-type)</th>
                                        <th>Efficiency of solar cells</th>
                                        <th>Wattage of full solar cells</th>
                                        <th>Cell Size (Dimension in mm)</th>
                                        <th>Cell Type used in module (Full/Half/Cut)</th>
                                        <th>No of Cells in a Module</th>
                                        <th>Number of bus bars per cell</th>
                                    </tr>
                                    @php $d=0; @endphp
                                    @foreach($appData['AnnexureSub6'] as $data)
                                    @php $d++;$check=0; @endphp
                                    <tr>
                                        <td>{{$d}}</td>
                                        <td> @if ($data->module_type == 17) 
                                                <?php $oth=json_decode($data->other_module_title) ; echo $oth[0]; ?>
                                            @else
                                                {{ $data->module_name }}
                                            @endif</td>
                                        <td>{{$data->main_model}}</td>
                                        <td class="text-center">{{$data->pmax_model}} Wp</td>
                                        <td class="text-center">
                                            <table width="100%">
                                                
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            <table width="100%">
                                                
                                            </table>
                                        </td>


                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $cell_technology)
                                                @php $check=1; @endphp
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_technology->cell_technology }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $cell_efficiency)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_efficiency->cell_efficiency }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $cell_wattage)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_wattage->cell_wattage }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $cell_dimension)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_dimension->cell_dimension }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $cell_type)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_type->cell_type }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $cell_total_no)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_total_no->cell_total_no }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $cell_total_bus)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $cell_total_bus->cell_total_bus }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <a
                                                href="{{URL::to('users/annexure-one-c/' .$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/6')}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                        </td>

                                    </tr>
                                    @endforeach

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
                                                style="width: 26%;margin-right: 10px;" onchange="showUploadButton()" />

                                            <input type="submit" name="submit" value="upload"
                                                class="btn btn-success btn-sm" style="display: none;"/>

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
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-one-b/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    @if($check>0 && $cell_data_sheet->cell_data_sheet!='')
                                    <a href="{{URL::to('users/annexure-two/'.$general->encodeid($application_id))}}"
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