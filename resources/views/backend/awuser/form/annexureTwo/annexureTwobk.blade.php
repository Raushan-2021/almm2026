@extends('layouts.masters.backend')
@section('title', 'Annexure 2 ::Bill of Material Details')
@section('content')

<div class="row">
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
                            <form action="{{ URL::to('/users/annexure-two')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data" style="display:none">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-4">
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
                                                <div class="col-md-4">
                                                    <label for="">Main Model</label>
                                                    <input type="text" name="model_code" placeholder="Main Model"
                                                        id="model_code" class="form-control" maxlength="70" value="">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Pmax (Wp) of Main Model</label>
                                                    <input type="text" name="pmax_model"
                                                        placeholder="Pmax (Wp) of Main Model" id="pmax_model"
                                                        class="form-control" maxlength="70" value="">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Applicable models covered under ± 5% of Mean
                                                        Wattage</label>
                                                    <input type="text" name="applicable_mean_wattage"
                                                        placeholder="Applicable models covered under ± 5% of Mean Wattage"
                                                        id="applicable_mean_wattage" class="form-control" maxlength="70"
                                                        value="">
                                                </div>



                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class=" table table-bordered module_type" id="module_type3">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Bill Material</th>
                                                    <th>Specification</th>
                                                    <th></th>

                                                </tr>
                                                <tbody id="add-data-3">

                                                    <tr class="primaryRow">
                                                        <td>1</td>
                                                        <td><select name="bill_material_id[]" id=""
                                                                class="form-control">
                                                                @foreach($billMaterial as $material)
                                                                <option value="{{$material->id}}">
                                                                    {{$material->bill_title}}</option>
                                                                @endforeach

                                                            </select></td>
                                                        <td>
                                                            <table class="table">

                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>Option</th>
                                                                    <th>Make</th>
                                                                    <th>Model</th>
                                                                    <th>Specification <small class="text-primary">(Max.
                                                                            200
                                                                            Characters)</small></th>
                                                                    <th>Country of Origin</th>
                                                                    <th></th>

                                                                </tr>
                                                                <tbody id="add-sub-data-31">
                                                                    <tr class="secondaryRow">
                                                                        <td>1</td>
                                                                        <td><select name="option_type[]" id=""
                                                                                class="form-control">
                                                                                <option value="0">Main</option>
                                                                                <option value="1">Alternate 1</option>
                                                                                <option value="2">Alternate 2</option>
                                                                            </select></td>
                                                                        <td><input type="text" name="make_details[]"
                                                                                placeholder="Enter Make Details"
                                                                                id="make_details" class="form-control"
                                                                                maxlength="70" value="">
                                                                        </td>
                                                                        <td> <input type="text" name="model_details[]"
                                                                                id="model_details"
                                                                                placeholder="Enter Model Details"
                                                                                value="">
                                                                        </td>
                                                                        <td> <input type="text" name="specifications[]"
                                                                                id="specifications"
                                                                                placeholder="Enter specifiaction Details"
                                                                                value="">
                                                                        </td>
                                                                        <td> <input type="text" name="country_origin[]"
                                                                                id="country_origin"
                                                                                placeholder="Enter Country of Origin"
                                                                                value="">
                                                                        </td>
                                                                        <td width="8%">
                                                                            <a href="javascript:;"
                                                                                id="add-sub-row-31">Add <i
                                                                                    class="fa fa-plus text-success"></i></a>


                                                                        </td>
                                                                    </tr>
                                                                </tbody>

                                                            </table>
                                                        </td>
                                                        <td width="8%">
                                                            <a href="javascript:;" id="add-row-3">Add
                                                                <i class="fa fa-plus text-success"></i></a>
                                                        </td>

                                                    </tr>
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
                                            <a href="{{URL::to('users/annexure-two/'.$application_id)}}"
                                                class="btn btn-danger"> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Main Model</th>
                                        <th width="8%">Pmax (Wp) of Main Model</th>
                                        <th width="8%">Applicable models covered under ± 5% of Mean Wattage</th>
                                        <th>Bill of Material</th>
                                        <th></th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Specification</th>
                                        <th>Country of Origin</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appData as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->module_type}}</td>
                                        <td>{{$data->model_code}}</td>
                                        <td>{{$data->pmax_model}}</td>
                                        <td>{{$data->applicable_mean_wattage}}</td>
                                        <td>Solar Cell</td>
                                        <td>
                                            <table wisth="100%">
                                                @foreach (json_decode($data->option_type) as
                                                $option_type)
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td>
                                                        @if($option_type==0)
                                                        Mail
                                                        @elseif($option_type==1)
                                                        Alternate 1
                                                        @else
                                                        Alternate 2
                                                        @endif</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                @foreach (json_decode($data->make_details) as
                                                $make_details)
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td>{{$make_details}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                @foreach (json_decode($data->model_details) as
                                                $model_details)
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td>{{$model_details}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                @foreach (json_decode($data->specifications) as
                                                $specifications)
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td>{{$specifications}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                @foreach (json_decode($data->country_origin) as
                                                $country_origin)
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td>{{$country_origin}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
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
    </script>
    <script>
    let counter = $('#add-data-3 .primaryRow').length;
    $(document).ready(function() {

        $(document).on('click', '.remove_fields', function() {

            $(this).closest('.record').remove();
            counter = counter - 1;

        });
        //Operational Ratings
        $("#add-row-3").click(function() {
            counter = counter + 1;
            counter_sub = counter - 1;
            markup_sub =
                '<tr class="record record3 secondaryRow"><td>' +
                counter_sub +
                '</td><td><select name="option_type[]" id="option_type' +
                counter_sub +
                '" class="form-control"> <option value="0">Main</option> <option value="1">Alternate 1</option> <option value="2">Alternate 2</option>  </select></td><td><input type="text" name="make_details[]" placeholder="Enter Make Details" id="make_details' +
                counter_sub +
                '" class="form-control" maxlength="70" value=""></td><td><input type="text" name="model_details[]" id="model_details_' +
                counter_sub +
                '" placeholder=" Enter Making Details"  class="form-control" ></td><td><input  type="text" name="specifications[]" id="specifications_' +
                counter_sub +
                '" placeholder="Enter specifiaction Details" value="" class="form-control" ></td><td><input  type="text" name="country_origin[]" id="country_origin_' +
                counter_sub +
                '" placeholder="Enter Country of Origin" value="" class="form-control" ></td><td><a href="javascript:;" id="add-sub-row-3' +
                counter + '">Add <i class="fa fa-plus text-success"></i></a></td></tr>';
            markup =
                '<tr class="record record3 primaryRow"><td>' +
                counter +
                '</td><td><select name="bill_material_id[]" id="bill_material_id' +
                counter +
                '" class="form-control"> @foreach($billMaterial as $material) <option value="{{$material->id}}"> {{$material->bill_title}}</option> @endforeach </select></td><td><table class="table"><tr><th>S.No</th><th>Option</th> <th>Make</th><th>Model</th><th>Specification <small class="text-primary">(Max.200 Characters)</small></th> <th>Country of Origin</th> <th></th> </tr> <tbody id="add-sub-data-3' +
                counter + '">' +
                markup_sub +
                '</tbody></table></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-3");
            tableBody.append(markup);
        });

    });



    $(document).ready(function() {

        let counter_sub = $('#add-sub-data-3' + counter + ' .secondaryRow').length;
        alert(counter_sub);
        $(document).on('click', '.remove_fields', function() {

            $(this).closest('.record').remove();
            counter_sub = counter_sub - 1;

        });
        //Operational Ratings
        $("#add-sub-row-3" + counter).click(function() {
            //alert(counter);
            counter_sub = counter_sub + 1;
            markup_sub =
                '<tr class="record record3 secondaryRow"><td>' +
                counter_sub +
                '</td><td><select name="option_type[]" id="option_type' +
                counter_sub +
                '" class="form-control"> <option value="0">Main</option> <option value="1">Alternate 1</option> <option value="2">Alternate 2</option>  </select></td><td><input type="text" name="make_details[]" placeholder="Enter Make Details" id="make_details' +
                counter_sub +
                '" class="form-control" maxlength="70" value=""></td><td><input type="text" name="model_details[]" id="model_details_' +
                counter_sub +
                '" placeholder=" Enter Making Details"  class="form-control" ></td><td><input  type="text" name="specifications[]" id="specifications_' +
                counter_sub +
                '" placeholder="Enter specifiaction Details" value="" class="form-control" ></td><td><input  type="text" name="country_origin[]" id="country_origin_' +
                counter_sub +
                '" placeholder="Enter Country of Origin" value="" class="form-control" ></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-sub-data-3" + counter);
            tableBody.append(markup_sub);
        });

    });
    </script>
    @endpush
