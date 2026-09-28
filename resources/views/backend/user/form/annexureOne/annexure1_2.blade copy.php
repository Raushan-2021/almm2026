@extends('layouts.masters.backend')
@section('title', 'Annexure 1 :: Details of Solar PV Modules')
@section('content')

<div class="row">
    @include('layouts.partials.backend._stepper')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-header with-border">
                            <a class="btn btn-success btn-sm" href="javascript:;"
                                onclick="$('#show_data').toggle('slow')"><i class="fa fa-plus"></i> Add</a>

                        </div>

                        <div class="box-body">
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <span class="invalid-feedback all_valid_class" style="display:block">
                                {{ $error }} </span>
                            @endforeach
                            @endif
                            <form action="{{ URL::to('/users/annexure-one-b')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Type of Model</label>
                                                    <select name="module_type" id="module_type" class="form-control"
                                                        onChange="getDataValue(this)">
                                                        <option value="">Select Module</option>
                                                        @foreach($moduleList as $module)
                                                        <option data-id="{{$module->main_model}}"
                                                            value="{{$module->id}}" @if(isset($annexuredata->
                                                            module_type) &&
                                                            $annexuredata->module_type==$module->id)selected @endif>
                                                            {{$module->module_type}} ({{$module->main_model}})</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Main Model</label>
                                                    <input type="text" name="model_code" placeholder="Main Model"
                                                        id="model_code" class="form-control" maxlength="70" readonly
                                                        value="{{ $annexuredata->model_code ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Pmax (Wp) of Main Model</label>
                                                    <input type="text" name="pmax_model"
                                                        placeholder="Pmax (Wp) of Main Model" id="pmax_model"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->pmax_model ?? '' }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">Electrical Data</label>
                                                    <select name="electrical_data_type" id="electrical_data_type"
                                                        class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="1" @if(isset($annexuredata->electrical_data_type)
                                                            && $annexuredata->electrical_data_type==1)
                                                            selected @endif>STC</option>
                                                        <option value="2" @if(isset($annexuredata->electrical_data_type)
                                                            && $annexuredata->electrical_data_type==2)
                                                            selected @endif>NOCT</option>
                                                    </select>
                                                </div>


                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered1">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Applicable models covered under ± 5% of Mean
                                                        Wattage</th>
                                                    <th>Pmax (Wp) of Applicable Models Model</th>
                                                    <th>Pmax(Wp)</th>
                                                    <th>Vmp (V)</th>
                                                    <th>Imp (A)</th>
                                                    <th>Voc (V)</th>
                                                    <th>Isc (A)</th>
                                                    <th>Module Efficiency (%)</th>
                                                    <th>Fill Factor</th>
                                                    <th></th>

                                                </tr>
                                                <tbody id="add-data">
                                                    @if($annexuredata!=null)

                                                    @foreach($annexuredata->vmp as
                                                    $value)
                                                    <tr class="record">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td> <input type="number" min="0"
                                                                name="applicable_mean_wattage[]"
                                                                id="applicable_mean_wattage_{{$loop->iteration}}"
                                                                placeholder="Enter Applicable Mean Wattage"
                                                                value="{{$annexuredata->applicable_mean_wattage[$loop->iteration-1]}}">
                                                        </td>
                                                        <td> <input type="number" min="0" name="pmax_applicable_model[]"
                                                                id="pmax_applicable_model_{{$loop->iteration}}"
                                                                placeholder="Enter Mean
                                                        Wattage"
                                                                value="{{$annexuredata->pmax_applicable_model[$loop->iteration-1]}}">
                                                        </td>
                                                        <td> <input type="number" min="0" name="pmax_watt[]"
                                                                id="pmax_watt_{{$loop->iteration}}"
                                                                placeholder="Enter Pmax (Wp) "
                                                                value="{{$annexuredata->pmax_watt[$loop->iteration-1]}}">
                                                        </td>



                                                        <td> <input type="number" min="0" name="vmp[]"
                                                                id="vmp_{{$loop->iteration}}"
                                                                placeholder="Enter VMP (V) " value="{{$value}}">
                                                        </td>
                                                        <td> <input type="number" name="imp[]"
                                                                id="imp{{$loop->iteration-1}}" min="0" step="any"
                                                                placeholder="Enter Imp (A)"
                                                                value="{{$annexuredata->imp[$loop->iteration-1]}}">
                                                        </td>
                                                        <td><input type="number" name="voc[]" id="voc" min="0"
                                                                step="any" placeholder="Enter Voc (V)"
                                                                value="{{$annexuredata->voc[$loop->iteration-1]}}"></td>
                                                        <td><input type="number" name="isc[]" id="isc" min="0"
                                                                step="any" placeholder="Enter Isc (A)"
                                                                value="{{$annexuredata->isc[$loop->iteration-1]}}"></td>
                                                        <td><input type="number" name="model_efficiency[]"
                                                                id="model_efficiency" min="0" step="any"
                                                                placeholder="Enter Module Efficiency (%)"
                                                                value="{{$annexuredata->model_efficiency[$loop->iteration-1]}}">
                                                        </td>
                                                        <td><input type="text" name="fill_factor[]" id="fill_factor"
                                                                min="0" step="any" placeholder="Enter Fill Factor"
                                                                value="{{$annexuredata->fill_factor[$loop->iteration-1]}}">
                                                        </td>
                                                        <td width="8%">
                                                            @if($loop->iteration==1)
                                                            <a href="javascript:;" id="add-row">Add
                                                                <i class="fa fa-plus text-success"></i></a>
                                                            @else
                                                            <a href="javascript:;" class="remove_fields">Delete <i
                                                                    class="fa fa-trash text-danger"></i></a>
                                                            @endif

                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td>1</td>
                                                        <td> <input type="number" min="0"
                                                                name="applicable_mean_wattage[]"
                                                                id="applicable_mean_wattage"
                                                                placeholder="Enter Applicable Mean Wattage" value="0">
                                                        </td>
                                                        <td> <input type="number" min="0" name="pmax_applicable_model[]"
                                                                id="pmax_applicable_model" placeholder="Enter Mean
                                                        Wattage" value="0">
                                                        </td>
                                                        <td> <input type="number" min="0" name="pmax_watt[]"
                                                                id="pmax_watt" placeholder="Enter Pmax (Wp) " value="0">
                                                        </td>



                                                        <td> <input type="number" min="0" name="vmp[]" id="vmp"
                                                                placeholder="Enter VMP (V) " value="0">
                                                        </td>
                                                        <td> <input type="number" name="imp[]" id="imp" min="0"
                                                                step="any" placeholder="Enter Imp (A)" value="0">
                                                        </td>
                                                        <td><input type="number" name="voc[]" id="voc" min="0"
                                                                step="any" placeholder="Enter Voc (V)" value="0"></td>
                                                        <td><input type="number" name="isc[]" id="isc" min="0"
                                                                step="any" placeholder="Enter Isc (A)" value="0"></td>
                                                        <td><input type="number" name="model_efficiency[]"
                                                                id="model_efficiency" min="0" step="any"
                                                                placeholder="Enter Module Efficiency (%)" value="0">
                                                        </td>
                                                        <td><input type="text" name="fill_factor[]" id="fill_factor"
                                                                min="0" step="any" placeholder="Enter Fill Factor"
                                                                value="0">
                                                        </td>
                                                        <td width="8%"><a href="javascript:;" id="add-row">Add
                                                                <i class="fa fa-plus text-success"></i></a>
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
                                                value="@if(isset($annexuredata->id) && $annexuredata->id !='')Update @else Save @endif"
                                                class="btn btn-success" id="">
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$annexuredata->id}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$application_id}}">
                                            <a href="{{URL::to('users/annexure-one-b/'.$application_id)}}"
                                                class="btn btn-danger"> Cancel <i class="fa fa-times"></i></a>

                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>3.2</th>
                                            <th scope="col" colspan="13">Electrical Data (STC) of Solar PV Modules</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Sr.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Main Model</th>

                                            <th rowspan="2" width="10%">Pmax (Wp) of Main Model</th>
                                            <th colspan="10" class="text-center">Electrical Data at STC</th>
                                            <th rowspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th width="10%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th>Pmax (Wp) of Applicable Models Model</th>
                                            <th>Pmax (Wp)</th>
                                            <th>Vmp (V)</th>
                                            <th>Imp (A)</th>
                                            <th>Voc (V)</th>
                                            <th>Isc (A)</th>
                                            <th>Module Efficiency (%)</th>
                                            <th>Fill Factor</th>
                                        </tr>
                                        @php $i=0; @endphp
                                        @foreach($appData as $data)

                                        @if($data->electrical_data_type ==1)
                                        @php $i++; @endphp
                                        <tr class="text-center">
                                            <td>{{$i}}</td>
                                            <td>{{$data->module_type}}</td>
                                            <td>{{$data->model_code}}</td>
                                            <td>{{$data->pmax_model}}</td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->applicable_mean_wattage) as
                                                    $applicable_mean_wattage)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $applicable_mean_wattage }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->pmax_applicable_model) as
                                                    $pmax_applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $pmax_applicable_model }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->pmax_watt) as
                                                    $pmax_watt)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $pmax_watt }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->vmp) as
                                                    $vmp)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $vmp }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->imp) as
                                                    $imp)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $imp }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->voc) as
                                                    $voc)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $voc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->isc) as
                                                    $isc)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $isc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->model_efficiency) as
                                                    $model_efficiency)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $model_efficiency }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->fill_factor) as
                                                    $fill_factor)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $fill_factor }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <a
                                                    href="{{URL::to('users/annexure-one-b/'.$data->application_id.'/'.$data->id)}}">Edit
                                                    <i class="fa fa-edit"></i></a>
                                                <a href="{{URL::to('users/delete-annexure/1/'.$data->id)}}"
                                                    onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                    class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                            </td>

                                        </tr>
                                        @endif
                                        @endforeach

                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>3.2.1</th>
                                            <th scope="col" colspan="13">Electrical Data (NOCT) of Solar PV Modules</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Sr.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Main Model</th>

                                            <th rowspan="2" width="10%">Pmax (Wp) of Main Model</th>
                                            <th colspan="10" class="text-center">Electrical Data at NOCT</th>
                                            <th rowspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th width="10%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th>Pmax (Wp) of Applicable Models Model</th>
                                            <th>Pmax (Wp)</th>
                                            <th>Vmp (V)</th>
                                            <th>Imp (A)</th>
                                            <th>Voc (V)</th>
                                            <th>Isc (A)</th>
                                            <th>Module Efficiency (%)</th>
                                            <th>Fill Factor</th>
                                        </tr>
                                        @php $j=0; @endphp
                                        @foreach($appData as $data)
                                        @if($data->electrical_data_type ==2)
                                        @php $j++; @endphp
                                        <tr class="text-center">
                                            <td>{{$j}}</td>
                                            <td>{{$data->module_type}}</td>
                                            <td>{{$data->model_code}}</td>
                                            <td>{{$data->pmax_model}}</td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->applicable_mean_wattage) as
                                                    $applicable_mean_wattage)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $applicable_mean_wattage }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->pmax_applicable_model) as
                                                    $pmax_applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $pmax_applicable_model }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->pmax_watt) as
                                                    $pmax_watt)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $pmax_watt }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->vmp) as
                                                    $vmp)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $vmp }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->imp) as
                                                    $imp)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $imp }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->voc) as
                                                    $voc)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $voc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->isc) as
                                                    $isc)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $isc }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->model_efficiency) as
                                                    $model_efficiency)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $model_efficiency }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    @foreach (json_decode($data->fill_factor) as
                                                    $fill_factor)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $fill_factor }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <a
                                                    href="{{URL::to('users/annexure-one-b/'.$data->application_id.'/'.$data->id)}}">Edit
                                                    <i class="fa fa-edit"></i></a>
                                                <a href="{{URL::to('users/delete-annexure/1/'.$data->id)}}"
                                                    onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                    class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                            </td>

                                        </tr>
                                        @endif
                                        @endforeach

                                    </tbody>
                                    <tr>
                                        <th colspan="14">
                                        @if($appData!=null)

                                            <a href="{{URL::to('users/annexure-one-c/'.$application_id)}}"
                                                class="btn btn-warning" style="float:right;">Next <i
                                                    class="fa fa-arrow-right"></i></a>
                                            @endif
                                            <a href="{{URL::to('users/annexure-one/'.$application_id)}}"
                                                class="btn btn-danger" style="float:right;"><i
                                                    class="fa fa-arrow-left"></i> Back </a>

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
                '</td><td> <input type="number" min="0" name="applicable_mean_wattage[]" id="applicable_mean_wattage_' +
                counter +
                '" placeholder="Enter Applicable Mean Wattage" value="0" step="any" required> </td> <td> <input type="number" min="0" name="pmax_applicable_model[]"  id="pmax_applicable_model_' +
                counter +
                '" placeholder="Enter MeanWattage" step="any" value="0" required></td><td> <input type="number" min="0" name="pmax_watt[]" id="pmax_watt_' +
                counter +
                '" placeholder="Enter Pmax (Wp) " value="0" required></td><td><input type="number" min="0" step="any" name="vmp[]" id="vmp_' +
                counter +
                '" placeholder="Enter VMP (V) " value="0" step="any" required class="form-control vmp_' +
                counter +
                '"></td><td><input  type="number" min="0" step="any" name="imp[]" value="0" id="imp_' +
                counter +
                '" placeholder="Enter Imp (A)" value="0" class="form-control" required></td><td><input  type="number" min="0" step="any" name="voc[]" id="voc_' +
                counter +
                '" placeholder="Enter Voc (V)"  value="0"class="form-control" required></td><td><input type="number" min="0" step="any" name="isc[]" id="isc_' +
                counter +
                '" placeholder="Enter Isc (A)" value="0" class="form-control" required></td><td><input  type="number" min="0" step="any" name="model_efficiency[]"  value="0"  id="model_efficiency_' +
                counter +
                '" placeholder="Enter Module Efficiency (%)"  value="0" class="form-control" required></td><td><input type="text" value="0"  name="fill_factor[]" id="fill_factor_' +
                counter +
                '" placeholder="Enter Fill Factor" class="form-control" required></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data");
            tableBody.append(markup);
        });
    });
    </script>
    @endpush
