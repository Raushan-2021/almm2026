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
                        <div class="box-body">
                            @if ($errors->any())
                            <span class="invalid-feedback1 all_valid_class text-danger" style="display:block">*Please enter all details properly. Do not use special characters.</span>
                            @endif
                            <form action="{{URL::to('/users/annexure-one')}}" method="POST" enctype="multipart/form-data"  id="formAjax1">
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
                                                </tr><tr>
                                                    <th width="15%">Main Model</th>
                                                    <td class="text-primary">{{$annexuredata->main_model ?? ''}}</td>
                                                </tr><tr>
                                                    <th>Pmax (Wp) of Main Model</th>
                                                    <td colspan="3" class="text-primary">{{$annexuredata->pmax_model ?? ''}}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered1">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th width="20%" class="text-center">Applicable models covered under +- 5%, Pmax of Main Model</th>
                                                    <th class="text-center">Pmax (Wp) of Applicable Models Model</th>
                                                    <th>No of Cells & Cell Type (Full/Half/Third/Other)</th>
                                                    <th>System Voltage (VDC)</th>
                                                    <th></th>
                                                </tr>
                                                <tbody>
                                                    @if($annexuredata!=null)
                                                        @foreach($annexuredata->applicable_model_covered as $value)
                                                        @php
                                                            if($annexuredata->annexure!=null){
                                                            $no_cell=json_decode($annexuredata->annexure['no_of_cells']);
                                                            $system_voltage=json_decode($annexuredata->annexure['system_voltage']);
                                                            }
                                                        @endphp
                                                        <tr class="record">
                                                            <td>{{$loop->iteration}}</td>
                                                            <td class="text-center">{{$value}}</td>
                                                            <td class="text-center">{{ $annexuredata->applicable_model[$loop->iteration-1] }} Wp</td>
                                                            <td> <input type="text" name="no_of_cells[]"
                                                                    id="no_of_cells_{{$loop->iteration}}" min="0" step="any"
                                                                    placeholder="Enter No of Cells & Cell Type. eg : 08 (Half) *"
                                                                    value="{{ $no_cell[$loop->iteration-1] ?? '' }}" class="from-control">
                                                                    <i name="no_of_cells.{{$loop->iteration-1}}"></i>
                                                            </td>
                                                            <td><input type="number" name="system_voltage[]"
                                                                    id="system_voltage_{{$loop->iteration}}" min="0"
                                                                    step="any" placeholder="Enter System Voltage (VDC)*"
                                                                    value="{{ $system_voltage[$loop->iteration-1] ?? '' }}"  class="from-control">
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
                                            <input type="submit" name="submit"
                                                value="@if(isset($annexuredata->id) && $annexuredata->id !='')Update @else Save @endif"
                                                class="btn btn-success" id="">
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$annexuredata->id}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$application_id}}">
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
                                            <th width="15%">Applicable models covered under +- 5%, Pmax of Main Model</th>
                                            <th width="15%">Pmax (Wp) of Applicable Models Model</th>
                                            <th width="15%">No of Cells & Cell Type (Full/Half/Third)</th>
                                            <th>System Voltage (VDC)</th>
                                            <th></th>
                                        </tr>
                                        @foreach($appData as $data)
                                        <tr>
                                            <th rowspan="">{{ $loop->iteration }}</th>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->main_model}}</td>
                                            <td class="text-center">{{$data->pmax_model}} Wp</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                @foreach (json_decode($data->applicable_model_covered) as
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
                                                @foreach (json_decode($data->applicable_model) as
                                                $applicable_model)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model }} Wp</td>
                                                </tr>
                                                @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                   @if($data->annexure!=null)
                                                   @foreach (json_decode($data->annexure->no_of_cells) as
                                                    $no_of_cells)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $no_of_cells }}</td>
                                                    </tr>
                                                    @endforeach
                                                   @else
                                                   <tr>
                                                        <td class="text-danger"><a href="{{URL::to('users/annexure-one/'.$data->application_id.'/'.$data->id)}}"
                                                    onClick="editAnnexureData({{$data->id}})">Fill Details</a></td>
                                                   </tr>
                                                     
                                                   @endif
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                @if($data->annexure!=null)
                                                   @foreach (json_decode($data->annexure->system_voltage) as
                                                    $system_voltage)
                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            {{ $system_voltage }}</td>
                                                    </tr>
                                                    @endforeach
                                                   @else
                                                   <tr>
                                                        <td class="text-danger"><a href="{{URL::to('users/annexure-one/'.$data->application_id.'/'.$data->id)}}"
                                                    onClick="editAnnexureData({{$data->id}})">Fill Details</a></td>
                                                   </tr>
                                                     
                                                   @endif
                                                </table>
                                            </td>
                                            <td><a href="{{URL::to('users/annexure-one/'.$data->application_id.'/'.$data->id)}}"
                                                    onClick="editAnnexureData({{$data->id}})">Edit <i
                                                        class="fa fa-edit"></i></a> 
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tr>
                                        <th colspan="9">
                                            @if($appData!=null)
                                            <a href="{{URL::to('users/annexure-one-b/'.$application_id)}}"
                                                class="btn btn-warning" style="float:right;">Next <i
                                                    class="fa fa-arrow-right"></i></a>
                                            @endif
                                            <a href="{{URL::to('users/module-master/'.$application_id)}}"
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
