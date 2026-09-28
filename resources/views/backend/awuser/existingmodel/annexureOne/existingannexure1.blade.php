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

                            <form action="{{URL::to('/users/existing-annexure-one')}}" method="POST"
                                enctype="multipart/form-data" id="formAjax">
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
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered1">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th width="20%" class="text-center">Applicable models covered under
                                                        +- 5%, Pmax of Main Model</th>
                                                    <th class="text-center">Pmax (Wp) of Applicable Models Model</th>
                                                    <th>No of Cells & Cell Type (Full/Half/Third/Other)</th>
                                                    <th>System Voltage (VDC)</th>
                                                    <th></th>
                                                </tr>
                                                <tbody>
                                                    @if(!Empty($annexuredata))
                                                    @foreach($annexuredata->applicable_model_covered as $record)
                                                    <tr class="record">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td class="text-center">
                                                            {{$annexuredata->applicable_model_covered[$loop->iteration-1] ?? ''}}
                                                        </td>
                                                        <td class="text-center">
                                                            {{$annexuredata->applicable_model[$loop->iteration-1] ?? ''}}
                                                            Wp</td>
                                                        <td> <input type="text" name="no_of_cells[]"
                                                                id="no_of_cells_{{$loop->iteration}}" min="0" step="any"
                                                                placeholder="Enter No of Cells & Cell Type. eg : 08 (Half) *"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['no_of_cells'] ?? '' }}"
                                                                class="from-control">
                                                            <i name="no_of_cells.{{$loop->iteration-1}}"></i>
                                                        </td>
                                                        <td><input type="number" name="system_voltage[]"
                                                                id="system_voltage_{{$loop->iteration}}" min="0"
                                                                step="any" placeholder="Enter System Voltage (VDC)*"
                                                                value="{{ $annexuredata['annexure'][$loop->iteration-1]['system_voltage'] ?? '' }}"
                                                                class="from-control">
                                                            <i name="system_voltage.{{$loop->iteration-1}}"></i>
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
                                            <a href="{{URL::to('users/annexure-one/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class='fa fa-close'></i> Cancel </a>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>3.1 </th>
                                            <th scope="col" colspan="8" class="text-left">Solar PV Model Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Sr.No</th>
                                            <th>Type Of Modules</th>
                                            <th>Main Model</th>
                                            <th>Pmax (Wp) of Main Model</th>
                                            <th width="15%">Applicable models covered under +- 5%, Pmax of Main Model
                                            </th>
                                            <th width="15%">Pmax (Wp) of Applicable Models Model</th>
                                            <th width="15%">No of Cells & Cell Type (Full/Half/Third)</th>
                                            <th>System Voltage (VDC)</th>
                                            <th></th>
                                        </tr>
                                        @php $check=0; @endphp
                                        @foreach($appData as $data)

                                        <tr class="@if($data->filter ==1) table-success @endif">
                                            <th rowspan="">{{ $loop->iteration }}</th>
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
                                                    @foreach ($data->applicable_model as $applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $applicable_model }} Wp</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>

                                            @if(!Empty($data->annexure))

                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach($data->annexure as $ann_data)
                                                    @php $check=1; @endphp
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $ann_data->no_of_cells }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach($data->annexure as $ann_data2)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $ann_data2->system_voltage }}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            </td>
                                            @endif
                                            <td>
                                                @if($data->filter==2)
                                                <a href="{{URL::to('users/existing-annexure-one/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}"
                                                    onClick="editAnnexureData({{$general->encodeid($data->id)}})">Edit
                                                    <i class="fa fa-edit"></i></a> @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tr>
                                        <th colspan="9">
                                            @if($check>0)
                                            <a href="{{URL::to('users/existing-annexure-one-b/'.$general->encodeid($application_id))}}"
                                                class="btn btn-warning" style="float:right;">Next <i
                                                    class="fa fa-arrow-right"></i></a>
                                            @endif
                                            <a href="{{URL::to('users/module-existing-master/'.$general->encodeid($application_id))}}"
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
                '</td><td><input type="number" min="0" step="any" name="pmax_applicable_model[]" id="pmax_applicable_model_' +
                counter +
                '" placeholder="Enter Pmax in (Wp)" class="form-control pmax_applicable_model_' +
                counter +
                '"></td><td><input type="text" name="no_of_cells[]" id="no_of_cells_' +
                counter +
                '" placeholder="Enter No of Cells & Cell Type " class="form-control"></td><td><input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="system_voltage[]" id="system_voltage_' +
                counter +
                '" placeholder="Enter System Voltage (VDC)" class="form-control"></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data");
            tableBody.append(markup);
        });
    });
    </script>
    @endpush