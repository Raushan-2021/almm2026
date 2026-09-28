@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Annexure 1 :: Details of Solar PV Modules')
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

                            <form action="{{ URL::to('/users/existing-annexure-one-c')}}" method="POST" id="formAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                    <tr>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="20%">Type of Model</th>
                                                    <td class="text-primary">{{$annexuredata->module_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="15%">Main Model</th>
                                                    <td class="text-primary">{{$annexuredata->main_model ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pmax (Wp) of Main Model</th>
                                                    <td colspan="3" class="text-primary">
                                                        {{$annexuredata->pmax_model ?? ''}} Wp</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="4" class="text-primary">
                                                        @if(($annexuredata->subAnnexureType ?? '')==3)
                                                        Module Operational Ratings
                                                        @elseif(($annexuredata->subAnnexureType ?? '') ==4)
                                                        Module Temperature Characteristics
                                                        @elseif(($annexuredata->subAnnexureType ?? '') ==5)
                                                        Module Dimensions
                                                        @elseif(($annexuredata->subAnnexureType ?? '') ==6)
                                                        Solar Cell Specifications
                                                        @endif
                                        </td>
                                    </tr>
                                </table>
                                </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table class="table table-bordered text-center module_type" id="module_type3"
                                            style="display:@if(($annexuredata->subAnnexureType ?? '')==3) @else none @endif">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Applicable models covered under ± 5% of Mean
                                                    Wattage</th>
                                                <th>Pmax (Wp) of Applicable Models Model</th>
                                                <th>Operational Temperature (ᴼC)</th>
                                                <th>Maximum System Voltage (V)</th>
                                                <th>Maximum Fuse Rating </th>
                                                <th>By-pass Diode Rating</th>
                                                <th>Fire Rating<br><i class="text-primary">(Maximum 50 Characters)</i>
                                                </th>
                                                <th>Warranty Details <br><i class="text-primary">(Maximum 200
                                                        Characters)</i></th>

                                            </tr>
                                            <tbody id="add-data-3">
                                                @if(!Empty($annexuredata))
                                                @foreach($annexuredata->applicable_model_covered as $value)
                                                <tr class="record">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$annexuredata->applicable_model_covered[$loop->iteration-1] ?? ''}}
                                                    </td>
                                                    <td>{{$annexuredata->applicable_model[$loop->iteration-1] ?? ''}} Wp
                                                    </td>
                                                    <td><input type="number" min="0" step="any" name="operation_temp[]"
                                                            placeholder=" Operational Temperature (ᴼC)"
                                                            id="operation_temp_{{$loop->iteration-1}}"
                                                            class="form-control" maxlength="70"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['operation_temp'] ?? '' }}">
                                                        <i name="operation_temp.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="number" min="0" step="any" name="max_voltage[]"
                                                            placeholder="Maximum System Voltage (V)"
                                                            id="max_voltage_{{$loop->iteration-1}}" class="form-control"
                                                            maxlength="70"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['max_voltage'] ?? '' }}">
                                                        <i name="max_voltage.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="number" min="0" step="any" name="max_fuse_rating[]"
                                                            placeholder="Maximum Fuse Rating"
                                                            id="max_fuse_rating_{{$loop->iteration-1}}"
                                                            class="form-control" max="60"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['max_fuse_rating'] ?? '' }}">
                                                        <i name="max_fuse_rating.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="number" min="0" step="any" name="diode_rating[]"
                                                            placeholder="By-pass Diode Rating"
                                                            id="diode_rating_{{$loop->iteration-1}}"
                                                            class="form-control" max="100"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['diode_rating'] ?? '' }}">
                                                        <i name="diode_rating.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="text" name="fire_rating[]"
                                                            placeholder="By-pass Diode Rating"
                                                            id="fire_rating_{{$loop->iteration-1}}" class="form-control"
                                                            maxlength="50"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['fire_rating'] ?? '' }}">
                                                        <i name="fire_rating.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="text" name="warrenty_details[]"
                                                            placeholder="Enter Warranty Details"
                                                            id="warrenty_details_{{$loop->iteration-1}}"
                                                            class="form-control" maxlength="250"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['warrenty_details'] ?? '' }}">
                                                        <i name="warrenty_details.{{$loop->iteration-1}}"></i>
                                                    </td>

                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered text-center  module_type" id="module_type4"
                                            style="display:@if(($annexuredata->subAnnexureType ?? '')==4) @else none @endif; width:100%">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Applicable models covered under ± 5% of Mean Wattage</th>
                                                <th>Pmax (Wp) of Applicable Models Model</th>
                                                <th>Temperature Co-efficient of Pmax</th>
                                                <th>Temperature Coefficient of Voc</th>
                                                <th>Temperature Coefficient of Isc</th>

                                            </tr>
                                            <tbody id="add-data-4">
                                                @if(!Empty($annexuredata))
                                                @foreach($annexuredata->applicable_model_covered as $value)
                                                <tr class="record">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$annexuredata->applicable_model_covered[$loop->iteration-1] ?? ''}}
                                                    </td>
                                                    <td>{{$annexuredata->applicable_model[$loop->iteration-1] ?? ''}} Wp
                                                    </td>
                                                    <td><input type="number" min="0" step="any" name="pmax_watt[]"
                                                            placeholder="Enter Temperature Co-efficient of Pmax "
                                                            id="pmax_watt_{{$loop->iteration}}" class="form-control"
                                                            maxlength="70"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['pmax_watt'] ?? ''  }}">
                                                        <i name="pmax_watt.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="number" min="0" step="any" name="voc[]"
                                                            placeholder="Enter Voc (V)" id="voc_{{$loop->iteration}}"
                                                            class="form-control" maxlength="70"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['voc'] ?? '' }}">
                                                        <i name="voc.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="number" min="0" step="any" name="isc[]"
                                                            placeholder="Enter Isc (A)" id="isc_{{$loop->iteration}}"
                                                            class="form-control" maxlength="70"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['isc'] ?? '' }}">
                                                        <i name="isc.{{$loop->iteration-1}}"></i>
                                                    </td>

                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered  text-center module_type" id="module_type5"
                                            style="display:@if(($annexuredata->subAnnexureType ?? '')==5) @else none @endif">
                                            <tr>
                                                <th>S.No</th>
                                                <th width="15%">Applicable models covered under ± 5% of Mean Wattage
                                                </th>
                                                <th width="15%">Pmax (Wp) of Applicable Models Model</th>
                                                <th>Length of Module (in mm)</th>
                                                <th>Breadth of Module (in mm)</th>
                                                <th>Area of Module (LxB) (in m2)</th>
                                                <th>Weight (in kg)</th>

                                            </tr>
                                            <tbody id="add-data-5">
                                                @if(!Empty($annexuredata))
                                                @foreach($annexuredata->applicable_model_covered as $value)
                                                <tr class="record">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$annexuredata->applicable_model_covered[$loop->iteration-1] ?? ''}}
                                                    </td>
                                                    <td>{{$annexuredata->applicable_model[$loop->iteration-1] ?? ''}} Wp
                                                    </td>
                                                    <td> <input type="number" min="0" step="any" name="module_length[]"
                                                            id="module_length"
                                                            placeholder="Enter Length of Module (in mm)"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['module_length'] ?? ''  }}">
                                                        <i name="module_length.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="number" name="module_breadth[]" id="module_breadth"
                                                            min="0" step="any"
                                                            placeholder="Enter Breadth of Module (in mm)"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['module_breadth'] ?? ''  }}">
                                                        <i name="module_breadth.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="number" name="module_area[]" id="module_area"
                                                            min="0" step="any"
                                                            placeholder="Enter Area of Module (LxB) (in m2)"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['module_area'] ?? '' }}">
                                                        <i name="module_area.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="number" name="module_weight[]" id="module_weight"
                                                            min="0" step="any" placeholder="Enter Weight (in kg)"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['module_weight'] ?? '' }}">
                                                        <i name="module_weight.{{$loop->iteration-1}}"></i>
                                                    </td>

                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered text-center module_type" id="module_type6"
                                            style="display:@if(($annexuredata->subAnnexureType ?? '')==6) @else none @endif">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Applicable models covered under ± 5% of Mean Wattage</th>
                                                <th>Pmax (Wp) of Applicable Models Model</th>
                                                <th>Technology type of solar cells</th>
                                                <th>Efficiency of solar cells</th>
                                                <th>Wattage of full solar cells (Wp)</th>
                                                <th>Full Cell Size (Dimension in mm)</th>
                                                <th>Cell Type used in module</th>
                                                <th>No of Cells in a Module</th>
                                                <th>Number of bus bars per cell</th>

                                            </tr>
                                            <tbody id="add-data-6">
                                                @if(!Empty($annexuredata))
                                                @foreach($annexuredata->applicable_model_covered as $value)
                                                <tr class="record">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$annexuredata->applicable_model_covered[$loop->iteration-1] ?? ''}}
                                                    </td>
                                                    <td>{{$annexuredata->applicable_model[$loop->iteration-1] ?? ''}} Wp
                                                    </td>
                                                    <td> <input type="text" name="cell_technology[]"
                                                            id="cell_technology"
                                                            placeholder="Enter Technology type of solar cells"
                                                            maxlength="100"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['cell_technology'] ?? '' }}">
                                                        <i name="cell_technology.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="number" min="0" step="any" name="cell_efficiency[]"
                                                            id="cell_efficiency"
                                                            placeholder="Enter Efficiency of solar cells"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['cell_efficiency'] ?? '' }}">
                                                        <i name="cell_efficiency.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="number" name="cell_wattage[]" id="cell_wattage"
                                                            min="0" step="any"
                                                            placeholder="Enter Wattage of full solar cells (Wp)"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['cell_wattage'] ?? '' }}">
                                                        <i name="cell_wattage.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="number" name="cell_dimension[]" id="cell_dimension"
                                                            min="0" step="any"
                                                            placeholder="Enter Full Cell Size (Dimension in mm)"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['cell_dimension'] ?? '' }}">
                                                        <i name="cell_dimension.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><select name="cell_type[]" id="cell_type[]">
                                                            <option value="Full" @if(($annexuredata['annexure'][$loop->
                                                                iteration-1]['cell_type'] ?? '') == 'Full') selected
                                                                @endif>Full</option>
                                                            <option value="Half" @if(($annexuredata['annexure'][$loop->
                                                                iteration-1]['cell_type'] ?? '') == 'Half') selected
                                                                @endif>Half</option>
                                                            <option value="Third" @if(($annexuredata['annexure'][$loop->
                                                                iteration-1]['cell_type'] ?? '') == 'Third') selected
                                                                @endif>Third</option>
                                                        </select>
                                                        <i name="cell_type.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="number" name="cell_total_no[]" id="cell_total_no"
                                                            min="0" max="999"
                                                            placeholder="Enter No of Cells in a Module"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['cell_total_no'] ?? ''  }}">
                                                        <i name="cell_total_no.{{$loop->iteration-1}}"></i>
                                                    </td>
                                                    <td><input type="number" name="cell_total_bus[]" id="cell_total_bus"
                                                            min="0" max="999"
                                                            placeholder="Enter Number of bus bars per cell"
                                                            value="{{ $annexuredata['annexure'][$loop->iteration-1]['cell_total_bus'] ?? '' }}">
                                                        <i name="cell_total_bus.{{$loop->iteration-1}}"></i>
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
                                                class='fa fa-check'></i> @if(isset($annexuredata->id) &&
                                            $annexuredata->id !='')Update @else Save @endif</button>

                                        <input type="hidden" name="edit_id" id="edit_id"
                                            value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                        <input type="hidden" name="application_id" id="application_id"
                                            value="{{$general->encodeid($application_id)}}">
                                        <input type="hidden" name="sub_annexure_type" id="sub_annexure_type"
                                            value="{{$annexuredata->subAnnexureType ?? ''}}">
                                        <a href="{{URL::to('users/existing-annexure-one-c/'.$general->encodeid($application_id))}}"
                                            class="btn btn-danger"><i class="fa fa-times"></i> Cancel </a>

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
                                        <th rowspan="2">Type Of Modules</th>
                                        <th rowspan="2">Main Model</th>
                                        <th rowspan="2">Pmax (Wp) of Main Model</th>
                                        <th rowspan="2" width="10%">Applicable models covered under +- 5% of
                                            Mean Wattege</th>
                                        <th rowspan="2" width="10%">Pmax (Wp) of Applicable Models Model</th>
                                        <th colspan="5" class="text-center">Operational Ratings</th>
                                        <th></th>
                                    </tr>
                                    <tr>

                                        <th>Operational Temperature (ᴼC)</th>
                                        <th>Maximum System Voltage (V)</th>
                                        <th>Maximum Fuse Rating</th>
                                        <th>By-pass Diode Rating</th>
                                        <th>Fire Rating</th>
                                        <th>Warranty Details</th>
                                    </tr>
                                    @php $a=0; @endphp
                                    @foreach($appData['AnnexureSub3'] as $data)
                                    @php $a++; @endphp
                                    <tr class="text-center @if($data->filter ==1) table-success @endif">
                                        <td>{{$a}}</td>
                                        <td>{{$data->module_name}}</td>
                                        <td>{{$data->main_model}}</td>
                                        <td class="text-center">{{$data->pmax_model}} Wp</td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($data->applicable_model_covered as
                                                $applicable_model_covered)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model_covered }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($data->applicable_model as
                                                $applicable_model)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model }} Wp</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $operation_temp)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $operation_temp->operation_temp }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
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
                                            @if($data->filter==2)
                                            <a
                                                href="{{URL::to('users/existing-annexure-one-c/' .$general->encodeid($data->application_id).'/' .$general->encodeid($data->id).'/3')}}">Edit
                                                <i class="fa fa-edit"></i></a>@endif
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
                                        <th rowspan="2">Type Of Modules</th>
                                        <th rowspan="2">Main Model</th>
                                        <th rowspan="2">Pmax (Wp) of Main Model</th>
                                        <th rowspan="2" width="15%">Applicable models covered under +- 5% of
                                            Mean Wattege</th>
                                        <th rowspan="2" width="15%">Pmax (Wp) of Applicable Models Model</th>
                                        <th colspan="3" class="text-center">Module Temperature Characteristics</th>
                                        <th width="8%"></th>
                                    </tr>
                                    <tr>

                                        <th>Temperature Co-efficient of Pmax</th>
                                        <th>Temperature Coefficient of Voc</th>
                                        <th>Temperature Coefficient of Isc)</th>
                                    </tr>
                                    @php $b=0; @endphp
                                    @foreach($appData['AnnexureSub4'] as $data)
                                    @php $b++; @endphp
                                    <tr class="@if($data->filter ==1) table-success @endif">
                                        <td>{{$b}}</td>
                                        <td>{{$data->module_name}}</td>
                                        <td>{{$data->main_model}}</td>
                                        <td class="text-center">{{$data->pmax_model}} Wp</td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($data->applicable_model_covered as $applicable_model_covered)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model_covered }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($data->applicable_model as $applicable_model)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model }} Wp</td>
                                                </tr>
                                                @endforeach
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
                                        <td> @if($data->filter==2)
                                            <a
                                                href="{{URL::to('users/existing-annexure-one-c/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/4')}}">Edit
                                                <i class="fa fa-edit"></i></a>@endif
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
                                        <th rowspan="2">Type Of Modules</th>
                                        <th rowspan="2">Main Model</th>
                                        <th rowspan="2">Pmax (Wp) of Main Model</th>
                                        <th rowspan="2" width="15%">Applicable models covered under +- 5% of
                                            Mean Wattege</th>
                                        <th rowspan="2" width="15%">Pmax (Wp) of Applicable Models Model</th>
                                        <th colspan="4" class="text-center">Module Dimensions</th>
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
                                    <tr class="@if($data->filter ==1) table-success @endif">
                                        <td>{{$c}}</td>
                                        <td>{{$data->module_name}}</td>
                                        <td>{{$data->main_model}}</td>
                                        <td class="text-center">{{$data->pmax_model}} Wp</td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($data->applicable_model_covered as $applicable_model_covered)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model_covered }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($data->applicable_model as $applicable_model)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model }} Wp</td>
                                                </tr>
                                                @endforeach
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
                                        <td>@if($data->filter==2)
                                            <a
                                                href="{{URL::to('users/existing-annexure-one-c/'.$general->encodeid($data->application_id). '/'.$general->encodeid($data->id).'/5')}}">Edit
                                                <i class="fa fa-edit"></i></a>@endif
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table><br>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>3.7</th>
                                        <th scope="col" colspan="13" class="text-left">Solar Cell Specifications</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="@if($data->filter ==1) table-success @endif">
                                        <th rowspan="2">S.No</th>
                                        <th rowspan="2">Type Of Modules</th>
                                        <th rowspan="2">Main Model</th>
                                        <th rowspan="2">Pmax (Wp) of Main Model</th>
                                        <th rowspan="2" width="15%">Applicable models covered under +- 5% of
                                            Mean Wattege</th>
                                        <th rowspan="2" width="15%">Pmax (Wp) of Applicable Models Model</th>
                                        <th colspan="4" class="text-center">Module Dimensions</th>
                                        <th width="10%"></th>
                                    </tr>
                                    <tr>

                                        <th>Technology type of solar cells</th>
                                        <th>Efficiency of solar cells</th>
                                        <th>Wattage of full solar cells</th>
                                        <th>Full Cell Size (Dimension in mm)</th>
                                        <th>Cell Type used in module (Full/Half/Third)</th>
                                        <th>No of Cells in a Module</th>
                                        <th>Number of bus bars per cell</th>
                                    </tr>
                                    @php $d=0;$check=0; @endphp
                                    @foreach($appData['AnnexureSub6'] as $data)
                                    @php $d++; @endphp
                                    <tr class="@if($data->filter ==1) table-success @endif">
                                        <td>{{$d}}</td>
                                        <td>{{$data->module_name}}</td>
                                        <td>{{$data->main_model}}</td>
                                        <td class="text-center">{{$data->pmax_model}} Wp</td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($data->applicable_model_covered as $applicable_model_covered)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model_covered }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($data->applicable_model as $applicable_model)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model }} Wp</td>
                                                </tr>
                                                @endforeach
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
                                            @if($data->filter==2)
                                            <a
                                                href="{{URL::to('users/existing-annexure-one-c/' .$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/6')}}">Edit
                                                <i class="fa fa-edit"></i></a>@endif
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                                <tr>
                                    <th colspan="14">
                                        @if($check>0)
                                        <a href="{{URL::to('users/existing-annexure-two/'.$general->encodeid($application_id))}}"
                                            class="btn btn-warning" style="float:right;">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        @endif
                                        <a href="{{URL::to('users/existing-annexure-one-b/'.$general->encodeid($application_id))}}"
                                            class="btn btn-danger" style="float:right;"><i class="fa fa-arrow-left"></i>
                                            Back </a>

                                    </th>
                                </tr>
                            </table>

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

    function showParameters(val) {
        $('.module_type').hide();
        $(".record" + val).remove();
        $('#module_type' + val).show();
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
    let counter = $('#add-data-3 tr').length;

    $(document).ready(function() {
        $(document).on('click', '.remove_fields', function() {

            $(this).closest('.record').remove();
            counter = counter - 1;

        });
        //Operational Ratings
        $("#add-row-3").click(function() {
            counter = counter + 1;
            markup =
                '<tr class="record record3"><td>' +
                counter +
                '</td><td><input type="number" step="any" min="0" value="0" name="applicable_mean_wattage[]" placeholder="Applicable models covered under ± 5% of Mean Wattage" id="applicable_mean_wattage' +
                counter +
                '" class="form-control" maxlength="70" value="0"></td><td><input type="text" name="pmax_applicable_model[]" placeholder="Pmax (Wp) of Applicable Models Model" id="pmax_applicable_model' +
                counter +
                '" class="form-control" maxlength="70" value="0"></td><td><input type="number" min="0" value="0" step="any" name="operation_temp[]" id="operation_temp_' +
                counter +
                '" placeholder=" Operational Temperature (ᴼC)"  class="form-control" ></td><td><input  type="number" min="0" step="any" name="max_voltage[]" id="max_voltage_' +
                counter +
                '" placeholder="Maximum System Voltage (V)" value="0" class="form-control" ></td><td><input  type="number" min="0" step="any" name="max_fuse_rating[]" id="max_fuse_rating_' +
                counter +
                '" placeholder="Maximum Fuse Rating" value="0" class="form-control" ></td><td><input type="number" value="0" min="0" step="any" name="diode_rating[]" id="diode_rating_' +
                counter +
                '" placeholder="By-pass Diode Rating" class="form-control" ></td><td><input  type="number" min="0" value="0" step="any" name="fire_rating[]" id="fire_rating_' +
                counter +
                '" placeholder="Enter Fire Rating" step="any" min="0" value="0" class="form-control" ></td><td><input type="text"  name="warrenty_details[]" id="warrenty_details_' +
                counter +
                '" placeholder="Enter Warranty Details" maxlength="250" class="form-control" ></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-3");
            tableBody.append(markup);
        });
        //Module Temperature Characteristics
        $("#add-row-4").click(function() {
            counter = counter + 1;
            markup =
                '<tr class="record record4"><td>' +
                counter +
                '</td><td><input type="text" name="applicable_mean_wattage_4[]" placeholder="Applicable models covered under ± 5% of Mean Wattage" id="applicable_mean_wattage_' +
                counter +
                '" class="form-control"  maxlength="70" value=""></td><td><input type="text" name="pmax_applicable_model_4[]"  placeholder="Pmax (Wp) of Applicable Models Model" id="pmax_applicable_model' +
                counter +
                '" class="form-control" maxlength="70" value=""></td><td><input  type="number" min="0" step="any" name="pmax_watt[]" id="pmax_watt_' +
                counter +
                '" placeholder="Enter Temperature Co-efficient of Pmax " class="form-control" ></td><td><input  type="number" min="0" step="any" name="voc[]" id="voc_' +
                counter +
                '" placeholder="Enter Voc (V)" class="form-control" ></td><td><input type="number" min="0" step="any" name="isc[]" id="isc_' +
                counter +
                '" placeholder="Enter Isc (A)" class="form-control" ></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-4");
            tableBody.append(markup);
        });
        //Module Dimensions
        $("#add-row-5").click(function() {
            counter = counter + 1;
            markup =
                '<tr class="record record5"><td>' +
                counter +
                '</td><td><input type="text" name="applicable_mean_wattage_5[]" placeholder="Applicable models covered under ± 5% of Mean Wattage" id="applicable_mean_wattage_' +
                counter +
                '" class="form-control"  maxlength="70" value=""></td><td><input type="text" name="pmax_applicable_model_5[]"  placeholder="Pmax (Wp) of Applicable Models Model" id="pmax_applicable_model' +
                counter +
                '" class="form-control" maxlength="70" value=""></td><td><input  type="number" min="0" step="any" name="module_length[]" id="module_length_' +
                counter +
                '" placeholder="Enter Length of Module (in mm)" class="form-control" ></td><td><input  type="number" min="0" step="any" name="module_breadth[]" id="module_breadth_' +
                counter +
                '" placeholder="Enter Breadth of Module (in mm)" class="form-control" ></td><td><input type="number" min="0" step="any" name="module_area[]" id="module_area_' +
                counter +
                '" placeholder="Enter Area of Module (LxB) (in m2)" class="form-control" ></td><td><input type="number" min="0" step="any" name="module_weight[]" id="module_weight_' +
                counter +
                '" placeholder="Enter Weight (in kg)" class="form-control" ></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-5");
            tableBody.append(markup);
        });
        //Solar Cell Specifications
        $("#add-row-6").click(function() {
            counter = counter + 1;
            markup =
                '<tr class="record record6"><td>' +
                counter +
                '</td><td><input type="text" name="applicable_mean_wattage_6[]" placeholder="Applicable models covered under ± 5% of Mean Wattage" id="applicable_mean_wattage_' +
                counter +
                '" class="form-control"  maxlength="70" value=""></td><td><input type="text" name="pmax_applicable_model_6[]"  placeholder="Pmax (Wp) of Applicable Models Model" id="pmax_applicable_model' +
                counter +
                '" class="form-control" maxlength="70" value=""></td><td><input  type="text" name="cell_technology[]" id="cell_technology_' +
                counter +
                '" placeholder="Enter Technology type of solar cells" class="form-control" ></td><td><input  type="number" min="0" step="any" name="cell_efficiency[]" id="cell_efficiencyh_' +
                counter +
                '" placeholder="Enter Efficiency of solar cells" class="form-control" ></td><td><input type="number" min="0" step="any" name="cell_wattage[]" id="cell_wattage_' +
                counter +
                '" placeholder="Enter Wattage of full solar cells (Wp)" class="form-control" ></td><td><input type="number" min="0" step="any" name="cell_dimension[]" id="cell_dimension_' +
                counter +
                '" placeholder="Enter Full Cell Size (Dimension in mm)" class="form-control" ></td><td><select name="cell_type[]" id="cell_type' +
                counter +
                '"> <option value="Full">Full</option> <option value="Half">Half</option> <option value="Third">Third</option></select></td><td><input type="number" name="cell_total_no[]" id="cell_total_no_' +
                counter +
                '" min="0" step="any" placeholder="Enter No of Cells in a Module"></td><td><input type="number" name="cell_total_bus[]" id="cell_total_bus_' +
                counter +
                '" min="0" step="any" placeholder="Enter Number of bus bars per cell"></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-6");
            tableBody.append(markup);
        });
    });
    </script>
    @endpush