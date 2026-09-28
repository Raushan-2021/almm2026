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

                            <form action="{{ URL::to('/users/existing-annexure-one-b')}}" method="POST" id="formAjax">
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
                                                    <th>Module Electric Data</th>
                                                    <td colspan="3" class="text-primary">
                                                        @if(($annexuredata->electrical_data_type ?? '')==1)STC @else
                                                        NOCT @endif</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered text-center">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th width="10%">Applicable models covered under ± 5% of Mean Wattage
                                                    </th>
                                                    <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                                    <th>Pmax(Wp)</th>
                                                    <th>Vmp (V)</th>
                                                    <th>Imp (A)</th>
                                                    <th>Voc (V)</th>
                                                    <th>Isc (A)</th>
                                                    <th>Module Efficiency (%)</th>
                                                    <th>Fill Factor</th>

                                                </tr>
                                                <tbody id="add-data">
                                                    @if(!Empty($annexuredata))
                                                    @foreach($annexuredata->applicable_model_covered as $value)
                                                    <tr class="record">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$annexuredata->applicable_model_covered[$loop->iteration-1] ?? ''}}
                                                        </td>
                                                        <td>{{$annexuredata->applicable_model[$loop->iteration-1] ?? ''}}
                                                            Wp</td>
                                                        <td> <input type="number" min="0" name="pmax_watt[]"
                                                                id="pmax_watt_{{$loop->iteration}}"
                                                                placeholder="Enter Pmax (Wp) "
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['pmax_watt'] ?? '' }}">
                                                            <i name="pmax_watt.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td> <input type="number" min="0" step="any" name="vmp[]"
                                                                id="vmp_{{$loop->iteration}}"
                                                                placeholder="Enter VMP (V) "
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['vmp'] ?? '' }}">
                                                            <i name="vmp.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td> <input type="number" name="imp[]"
                                                                id="imp{{$loop->iteration-1}}" min="0" step="any"
                                                                placeholder="Enter Imp (A)"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['imp'] ?? '' }}">
                                                            <i name="imp.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="number" name="voc[]" id="voc" min="0"
                                                                step="any" placeholder="Enter Voc (V)"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['voc'] ?? '' }}">
                                                            <i name="voc.{{$loop->iteration-1}}"></i>
                                                        </td>

                                                        <td><input type="number" name="isc[]" id="isc" min="0"
                                                                step="any" placeholder="Enter Isc (A)"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['isc'] ?? '' }}">
                                                            <i name="isc.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="number" name="model_efficiency[]"
                                                                id="model_efficiency" min="0" step="any" max="100"
                                                                placeholder="Enter Module Efficiency (%)"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['model_efficiency'] ?? '' }}">
                                                            <i name="model_efficiency.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="text" name="fill_factor[]" id="fill_factor"
                                                                min="0" step="any" placeholder="Enter Fill Factor"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['fill_factor'] ?? '' }}">
                                                            <i name="fill_factor.{{$loop->iteration-1}}"></i>
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
                                            <input type="hidden" name="electrical_data_type" id="electrical_data_type"
                                                value="{{$annexuredata->electrical_data_type ?? ''}}">
                                            <a href="{{URL::to('users/existing-annexure-one-b/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="fa fa-times"></i> Cancel </a>

                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered text-center hidden">
                                    <thead>
                                        <tr>
                                            <th>3.2</th>
                                            <th scope="col" colspan="13" class="text-left">Module Electric Data at STC
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Sr.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Main Model</th>
                                            <th rowspan="2" width="10%">Pmax (Wp) of Main Model</th>
                                            <th colspan="10" class="text-center">Electrical Data at STC</th>

                                        </tr>
                                        <tr>
                                            <th width="10%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                            <th>Pmax (Wp)</th>
                                            <th>Vmp (V)</th>
                                            <th>Imp (A)</th>
                                            <th>Voc (V)</th>
                                            <th>Isc (A)</th>
                                            <th>Module Efficiency (%)</th>
                                            <th width="15%">Fill Factor</th>
                                        </tr>
                                        @php $i=0; @endphp
                                        @foreach($appData['appDataSTC'] as $data)


                                        @php $i++; @endphp
                                        <tr class="text-center @if($data->filter ==1) table-success @endif">
                                            <td>{{$i}}</td>
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
                                                    @foreach($data->annexure as $pmax_watt)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $pmax_watt->pmax_watt }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $vmp)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $vmp->vmp }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $imp)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $imp->imp }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $voc)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $voc->voc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $isc)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $isc->isc }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $model_efficiency)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $model_efficiency->model_efficiency }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $fill_factor)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $fill_factor->fill_factor }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td width="5%">
                                                @if($data->filter ==2)
                                                <a
                                                    href="{{URL::to('users/existing-annexure-one-b/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/1')}}">Edit
                                                    <i class="fa fa-edit"></i></a>
                                                @endif
                                            </td>

                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>

                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>3.3</th>
                                            <th scope="col" colspan="13" class="text-left">Module Electric Data at NOCT
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Sr.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Main Model</th>

                                            <th rowspan="2" width="10%">Pmax (Wp) of Main Model</th>
                                            <th colspan="10" class="text-center">Electrical Data at NOCT</th>

                                        </tr>
                                        <tr>
                                            <th width="10%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                            <th>Pmax (Wp)</th>
                                            <th>Vmp (V)</th>
                                            <th>Imp (A)</th>
                                            <th>Voc (V)</th>
                                            <th>Isc (A)</th>
                                            <th>Module Efficiency (%)</th>
                                            <th width="15%">Fill Factor</th>
                                        </tr>
                                        @php $j=0; $check=0;@endphp
                                        @foreach($appData['appDataNOCT'] as $data)
                                        @php $j++; @endphp
                                        <tr class="text-center @if($data->filter ==1) table-success @endif">
                                            <td>{{$j}}</td>
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
                                                    @foreach($data->annexure as $pmax_watt)
                                                    @php $check=1; @endphp
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $pmax_watt->pmax_watt }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $vmp)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $vmp->vmp }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $imp)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $imp->imp }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $voc)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $voc->voc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $isc)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $isc->isc }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $model_efficiency)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $model_efficiency->model_efficiency }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $fill_factor)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $fill_factor->fill_factor }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td width="5%">
                                                @if($data->filter ==2)
                                                <a
                                                    href="{{URL::to('users/existing-annexure-one-b/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/2')}}">Edit
                                                    <i class="fa fa-edit"></i></a>
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                    <tr>
                                        <th colspan="14">

                                            <a href="{{URL::to('users/existing-annexure-one/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger" style="float:left;"><i
                                                    class="fa fa-arrow-left"></i> Back </a>
                                            @if($check>0)
                                            <a href="{{URL::to('users/existing-annexure-one-c/'.$general->encodeid($application_id))}}"
                                                class="btn btn-warning" style="float:left;">Next <i
                                                    class="fa fa-arrow-right"></i></a>
                                            @endif

                                        </th>
                                    </tr>
                                </table>

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
        position: absolute;

        right: 35px;
        margin-top: -24px;
    }
    </style>

    @endsection