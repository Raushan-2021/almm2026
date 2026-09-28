@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Manufacturing facility Details')
@section('content')

<div class="row">
    @include('backend.user.form._stepper')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')


        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <!-- <div class="box-header with-border">
                            
                        </div> -->

                        <div class="box-body">
                            <form action="{{ URL::to('/users/annexure-four')}}" method="POST" id="formAjax1">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered">
                                    <tr class="bg-warning">
                                        <th colspan="3" class=" text-left">5.1 Manufacturing facility Details</th>
                                    </tr>
                                    <tr>
                                        <th width="5%">S.No</th>
                                        <th width="45%">Particulars</th>
                                        <th>Details</th>
                                    </tr>
                                    <tr>
                                        <th>1</th>
                                        <th>Manufacturing Plant Floor Area (in m2)<small class="text-danger"> * </small></th>
                                        <td><input type="number" name="plant_floor_area"
                                                placeholder="Manufacturing Plant Floor Area (in m2)"
                                                id="plant_floor_area" class="form-control" maxlength="70"
                                                value="{{ $annexuredata->plant_floor_area ?? '' }}">
                                            @error('plant_floor_area') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror</td>
                                        <?php $check=0;
                                        if(isset($annexuredata->plant_floor_area) && $annexuredata->plant_floor_area>0) { $check=1;}
                                        ?>

                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <th>Manufacturing Plant operational since<small class="text-danger"> * </small>
                                            <!-- {{$annexuredata->plant_operational_date ?? ''}}</th> -->
                                        <td><input type="month" name="plant_operational_date" placeholder="Main Model"
                                                id="plant_operational_date" class="form-control" maxlength="70"
                                                value="{{ $annexuredata->plant_operational_date ?? '' }}">
                                            @error('plant_operational_date') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <th>No. of Manufacturing Lines<small class="text-danger"> * </small></th>
                                        <td><input type="number" min="0" step="any" name="no_manufaturing_line"
                                                placeholder="No. of Manufacturing Lines" id="no_manufaturing_line"
                                                class="form-control" maxlength="70"
                                                value="{{ $annexuredata->no_manufaturing_line ?? '' }}">
                                            @error('no_manufaturing_line') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>4</th>
                                        <th>No. of Working Days in a year<small class="text-danger"> * </small></th>
                                        <td><input type="number" min="0" step="any" name="no_working_day"
                                                placeholder="No. of Working Days in a year" id="no_working_day"
                                                class="form-control" maxlength="70"
                                                value="{{ $annexuredata->no_working_day ?? '' }}">
                                            @error('no_working_day') <span class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>5</th>
                                        <th>Total PV model Manufacturing Capacity (in mm)<small class="text-danger"> * </small> </th>
                                        <td><input type="number" name="manufacturing_capacity"
                                                placeholder="Total PV model Manufacturing Capacity "
                                                id="manufacturing_capacity" class="form-control" 
                                                value="{{ $annexuredata->manufacturing_capacity ?? '' }}">
                                            @error('manufacturing_capacity') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>6</th>
                                        <th>Electricity Load Connected to manufacturing plant (in kW)<small class="text-danger"> * </small></th>
                                        <td><input type="number" name="electricity_load"
                                                placeholder="Electricity Load Connected to manufacturing plant (in kW)"
                                                id="electricity_load" class="form-control" min="0" step="any"
                                                value="{{ $annexuredata->electricity_load ?? '' }}">
                                            @error('electricity_load') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>7</th>
                                        <th>Average Electricity Consumption per day (in kWh)<small class="text-danger"> * </small></th>
                                        <td><input type="number" min="0" step="any" name="electricity_consumption"
                                                placeholder="Average Electricity Consumption per day (in kWh)"
                                                id="electricity_consumption" class="form-control" maxlength="70"
                                                value="{{ $annexuredata->electricity_consumption ?? '' }}">
                                            @error('electricity_consumption') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>8</th>
                                        <th>Details of Power Backup Available with capacity (in mm)<small class="text-danger"> * </small></th>
                                        <td><textarea name="power_backup_details" id="power_backup_details"
                                                placeholder="Details of Power Backup Available with capacity" cols="30"
                                                rows="5">{{ $annexuredata->power_backup_details ?? '' }}</textarea><br>
                                            @error('power_backup_details') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                </table>
                                <div class="row">
                                    <div class="col-lg-12 text-center">

                                        <button type="submit" name="submit" class="btn btn-success" id="submit1">
                                            <i class='bi bi-arrow-bar-up'></i> @if(isset($annexuredata->id) &&
                                            $annexuredata->id !='')Update @else Save @endif</button>
                                        <input type="hidden" name="edit_id" id="edit_id"
                                            value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                        <input type="hidden" name="application_id" id="application_id"
                                            value="{{$general->encodeid($application_id)}}">
                                        <a href="{{URL::to('users/annexure-four/'.$general->encodeid($application_id))}}"
                                            class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>




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
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <!-- <div class="box-header with-border">
                            
                        </div> -->

                        <div class="box-body">

                            <a class="btn btn-success btn-sm" href="javascript:;"
                                onclick="$('#show_data').toggle('slow')"><i class="fa fa-plus"></i> Add Manufacturing
                                Plant under same Brand/Company name</a>
                            <br><br>
                            <form action="{{ URL::to('/users/annexure-six')}}" method="POST"
                                enctype="multipart/form-data" id="formAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display: @if($annexuredata6->id ?? '')  @else none @endif">
                                    @if($appData!=null)
                                    <input type="hidden" name="id" value="{{$annexuredata6->id ?? ''}}">
                                    @endif
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Name of Company <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="name_of_company"
                                                        placeholder="Name of Company" id="name_of_company"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata6->name_of_company ?? '' }}">

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Country <span class="text-danger">*</span> </label>

                                                    <select name="country" id="country" class="form-control">
                                                        <option value="">Select</option>
                                                        @foreach($countrydata as $country)
                                                        <option value="{{$country->countrycd}}"
                                                            @if(isset($annexuredata6->country) &&
                                                            $annexuredata6->country==$country->countrycd)selected
                                                            @endif>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>


                                                <div class="col-md-6">
                                                    <label for="">Whether Enlisted in ALMM <span
                                                            class="text-danger">*</span> </label>
                                                    <select name="whether_enlisted" id="whether_enlisted"
                                                        class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Yes" @if(isset($annexuredata6->whether_enlisted)
                                                            &&
                                                            $annexuredata6->whether_enlisted=="Yes")selected @endif>Yes
                                                        </option>
                                                        <option value="No" @if(isset($annexuredata6->whether_enlisted)
                                                            &&
                                                            $annexuredata6->whether_enlisted=="No")selected @endif>No
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6 hidden">
                                                    <label for="">No. of PV Models Enlisted in ALMM</label>
                                                    <input type="number" min="0" name="noofpv_models"
                                                        placeholder="No. of PV Models Enlisted in ALMM"
                                                        id="noofpv_models" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata6->noofpv_models ?? '0' }}" readonly>

                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">Enlisted/Rated PV Modules Manufacturing
                                                        Capacity (in mm)<span class="text-danger">*</span> </label>
                                                    <input type="text" name="manufacturing_capacity"
                                                        placeholder="Enlisted/Rated PV Modules Manufacturing Capacity"
                                                        id="manufacturing_capacity" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata6->manufacturing_capacity ?? '' }}">

                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Address <span class="text-danger">*</span> </label>
                                                    <textarea name="address" id="address" class="form-control" cols="30"
                                                        rows="5"
                                                        placeholder="Complete Address of Brand/Company name">{{ $annexuredata6->address ?? '' }}</textarea>

                                                </div>


                                            </div>
                                        </th>
                                    </tr>

                                    <tr>
                                        <td>
                                            <button type="submit" name="submit" class="btn btn-success" id="submit">
                                                <i class='bi bi-arrow-bar-up'></i> @if(isset($annexuredata6->id) &&
                                                $annexuredata6->id !='')Update @else Save @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata6->id)){{$general->encodeid($annexuredata6->id)}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <a href="{{URL::to('users/annexure-four/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th width="20%">Name of Company</th>
                                        <th>Country</th>
                                        <th width="25%">Address</th>
                                        <th>Whether Enlisted in ALMM </th>
                                        <!-- <th>No. of PV Models Enlisted in ALMM</th> -->
                                        <th>Enlisted/Rated PV Modules Manufacturing Capacity (in mm)</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($appData as $data)

                                    @php
                                    $result =
                                    \App\Models\Country::select('name')->where('countrycd',$data->country)->first();
                                    @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->name_of_company}}</td>
                                        <td>
                                            @if($result)
                                            {{$result['name']}}
                                            @else
                                            @endif
                                        </td>
                                        <td>{{$data->address}}</td>
                                        <td>{{$data->whether_enlisted}}</td>
                                        <!-- <td>{{$data->noofpv_models}}</td> -->
                                        <td>{{$data->manufacturing_capacity}}</td>
                                        <td>
                                            <a
                                                href="{{URL::to('users/annexure-four/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/6/'.$general->encodeid($data->id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-three/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back
                                    </a>
                                    @if($check>0)
                                    <a href="{{URL::to('users/annexure-four-two/'.$general->encodeid($application_id))}}"
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
    .invalid-feedback {
        position: inherit !important;
        margin-top: -15px;
        width: 100%;
        font-size: .875em;
        color: #dc3545;
    }
    </style>

    @endsection
    @push('backend-js')
    <script>
    $('#whether_enlisted').change(function() {
        $('#noofpv_models').attr('readonly', 'readonly').val('0');
        if (this.value == 'Yes') {
            $('#noofpv_models').removeAttr('readonly');
        }
        //background-color: #ccc !important;
    });
    </script>
    @endpush