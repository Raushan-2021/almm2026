@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Annexure 6 ::Details of all Manufacturing Plant under same Brand/Company name')
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
                            <form action="{{ URL::to('/users/annexure-six')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display: @if($annexuredata!=null)  @else none @endif">
                                    @if($annexuredata!=null)
                                    <input type="hidden" name="id" value="{{$annexuredata->id}}">
                                    @endif
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Name of Company</label>
                                                    <input type="text" name="name_of_company"
                                                        placeholder="Name of Company" id="name_of_company"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->name_of_company ?? '' }}">

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Country</label>

                                                    <select name="country" id="country" class="form-control">
                                                        <option value="">Select</option>
                                                        @foreach($countrydata as $country)
                                                        <option value="{{$country->countrycd}}"
                                                            @if(isset($annexuredata->country) &&
                                                            $annexuredata->country==$country->countrycd)selected
                                                            @endif>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>


                                                <div class="col-md-6">
                                                    <label for="">Whether Enlisted in ALMM</label>
                                                    <select name="whether_enlisted" id="whether_enlisted"
                                                        class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="yes" @if(isset($annexuredata->whether_enlisted)
                                                            &&
                                                            $annexuredata->whether_enlisted=="yes")selected @endif>Yes
                                                        </option>
                                                        <option value="no" @if(isset($annexuredata->whether_enlisted) &&
                                                            $annexuredata->whether_enlisted=="no")selected @endif>No
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">No. of PV Models Enlisted in ALMM</label>
                                                    <input type="number" min="0" name="noofpv_models"
                                                        placeholder="No. of PV Models Enlisted in ALMM"
                                                        id="noofpv_models" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->noofpv_models ?? '' }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">Enlisted/Rated PV Modules Manufacturing
                                                        Capacity</label>
                                                    <input type="text" name="manufacturing_capacity"
                                                        placeholder="Enlisted/Rated PV Modules Manufacturing Capacity"
                                                        id="manufacturing_capacity" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->manufacturing_capacity ?? '' }}">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Address</label>
                                                    <textarea name="address" id="address" class="form-control" cols="30"
                                                        rows="5"
                                                        placeholder="Complete Address of Brand/Company name">{{ $annexuredata->address ?? '' }}</textarea>

                                                </div>


                                            </div>
                                        </th>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="submit" name="submit"
                                                value="@if(isset($annexuredata->id) && $annexuredata->id !='')Update @else Save @endif"
                                                class="btn btn-success" id="">
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <!-- <a href="{{URL::to('users/annexure-two/'.$application_id)}}"
                                                class="btn btn-danger"> Cancel </a> -->

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Name of Company</th>
                                        <th>Country</th>
                                        <th>Address</th>
                                        <th>Whether Enlisted in ALMM </th>
                                        <th>No. of PV Models Enlisted in ALMM</th>
                                        <th>Enlisted/Rated PV Modules Manufacturing Capacity</th>
                                        <th>Action</th>
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
                                        <td>{{$data->noofpv_models}}</td>
                                        <td>{{$data->manufacturing_capacity}}</td>
                                        <td>
                                            <a
                                                href="{{URL::to('users/annexure-six/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="{{URL::to('users/annexure-six-delete/1/'.$general->encodeid($data->id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="13">
                                        @if(!$appData->isEmpty())

                                        <a href="{{URL::to('users/annexure-seven/'.$general->encodeid($application_id))}}"
                                            class="btn btn-warning" style="float:right">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        @endif
                                        <a href="{{URL::to('users/annexure-five/'.$general->encodeid($application_id))}}"
                                            class="btn btn-danger" style="float:right"><i class="fa fa-arrow-left"></i>
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
                '</td><td><select name="option_type[]" id="option_type' +
                counter +
                '" class="form-control"> <option value="0">Main</option> <option value="1">Alternate 1</option> <option value="2">Alternate 2</option>  </select></td><td><input type="text" name="make_details[]" placeholder="Enter Make Details" id="make_details' +
                counter +
                '" class="form-control" maxlength="70" value=""></td><td><input type="text" name="model_details[]" id="model_details_' +
                counter +
                '" placeholder=" Enter Making Details"  class="form-control" ></td><td><input  type="text" name="specifications[]" id="specifications_' +
                counter +
                '" placeholder="Enter specifiaction Details" value="" class="form-control" ></td><td><input  type="text" name="country_origin[]" id="country_origin_' +
                counter +
                '" placeholder="Enter Country of Origin" value="" class="form-control" ></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-3");
            tableBody.append(markup);
        });

    });
    </script>
    @endpush