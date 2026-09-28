@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'List of Major Machines/Equipments')
@section('content')

<div class="row">
    @include('backend.user.form._stepper')
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
                            <form action="{{ URL::to('/users/annexure-four-two')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Line <small class="text-danger"> * </small></label>
                                                    <select name="line" id="line" class="form-control">
                                                        <option value="">Select Line</option>
                                                        <option value="1" @if($annexuredata!=null && $annexuredata->
                                                            line==1) selected @endif>Line 1</option>
                                                        <option value="2" @if($annexuredata!=null && $annexuredata->
                                                            line==2) selected @endif>Line 2</option>
                                                    </select>

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Compatible Technology <i class="text-primary">(Cell
                                                            Type/Max Cell Size/No. of
                                                            Bus Bar)<small class="text-danger"> * </small></i></label>
                                                    <input type="text" name="compatible_technology"
                                                        placeholder="Enter Compatible Technology"
                                                        id="compatible_technology" class="compatible_technology-control"
                                                        maxlength="70"
                                                        value="{{ $annexuredata->compatible_technology ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="commissioning_date">Commissioning Date<small class="text-danger"> * </small></label>
                                                    <input type="month" name="commissioning_date"
                                                        placeholder="Commissioning Date" id="commissioning_date"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->commissioning_date ?? '' }}"
                                                        min="{{ date('Y-m') }}" 
                                                        onchange="checkIfPastMonth(this)">
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Rated Manufacturing Capacity(in mm) <i
                                                            class="text-primary">(24*7 *365 days working)<small class="text-danger"> * </small></i></label>
                                                    <input type="number" min="0" step="any" name="rated_mfg_capacity"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="rated_mfg_capacity" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->rated_mfg_capacity ?? '' }}">
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered module_type" id="module_type3">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>List of Major Machines/Equipments<small class="text-danger"> * </small></th>
                                                    <th>Machine Type<small class="text-danger"> * </small></th>
                                                    <th>No. of Units<small class="text-danger"> * </small></th>
                                                    <th>Make<small class="text-danger"> * </small></th>
                                                    <th>Model<small class="text-danger"> * </small></th>
                                                    <th>Specification/Rating<small class="text-danger"> * </small></th>
                                                    <th>Country of Origin <small class="text-danger"> * </small></th>
                                                    <th></th>

                                                </tr>
                                                <tbody id="add-data-3">
                                                    @if($annexuredata!=null)

                                                    @foreach($annexuredata->major_equipments as
                                                    $value)
                                                    <tr class="record">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>
                                                            @php
                                                            $selectEquipment =
                                                            $annexuredata->major_equipments[$loop->iteration-1];
                                                            @endphp
                                                            <select name="major_equipments[]" id="major_equipments"
                                                                class="form-control">
                                                                <option value="">Select Machine</option>
                                                                @foreach($machineList as $machine)
                                                                <option value="{{$machine->id}}"
                                                                    @if($selectEquipment==$machine->id)selected
                                                                    @endif>{{$machine->title}}
                                                                </option>
                                                                @endforeach
                                                                <!-- <option value="other">Add Others</option> -->
                                                            </select>
                                        
                                                            <div id="other_machine_input" style="display: none;">
                                                                <label for="other_machine_title">Other Machine Title</label>
                                                                <input type="text" name="other_machine_title[]" id="other_machine_title" class="form-control">
                                                            </div>
                                                        </td>
    

                                                        <td>
                                                            <select name="equipments_type[]" id="equipments_type"
                                                                class="form-control">
                                                                <option value="0">Not Available</option>
                                                                <option value="1" @if($annexuredata->
                                                                    equipments_type[$loop->iteration-1]==1)selected
                                                                    @endif>Manual</option>
                                                                <option value="2" @if($annexuredata->
                                                                    equipments_type[$loop->iteration-1]==2)selected
                                                                    @endif>Semi-Automatic</option>
                                                                <option value="3" @if($annexuredata->
                                                                    equipments_type[$loop->iteration-1]==3)selected
                                                                    @endif>Automatic</option>
                                                            </select>
                                                        </td>
                                                        <td> <input type="number" min="0" step="any"
                                                                name="no_of_units[]" id="no_of_units"
                                                                placeholder="No of units"
                                                                value="{{$annexuredata->no_of_units[$loop->iteration-1]}}">
                                                        </td>
                                                        <td> <input type="text" name="make[]" id="make"
                                                                placeholder="Enter Making of Equipment"
                                                                value="{{$annexuredata->make[$loop->iteration-1]}}">
                                                        </td>
                                                        <td><input type="text" name="model[]" id="model"
                                                                placeholder="Enter Model"
                                                                value="{{$annexuredata->model[$loop->iteration-1]}}">
                                                        </td>
                                                        <td><input type="text" name="rating[]" id="rating"
                                                                placeholder="Enter Specification/Rating"
                                                                value="{{$annexuredata->rating[$loop->iteration-1]}}">
                                                        </td>
                                                        <td>
                                                            @php
                                                            $selectCountry =
                                                            $annexuredata->country_of_origin[$loop->iteration-1];
                                                            @endphp
                                                            <select name="country_of_origin[]" id="country_of_origin"
                                                                class="form-control">
                                                                <option value="">Select Country</option>
                                                                @foreach($countries as $country)
                                                                <option value="{{$country->countrycd}}"
                                                                    @if($selectCountry==$country->countrycd)selected
                                                                    @endif>
                                                                    {{$country->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td width="8%">
                                                            @if($loop->iteration==1)
                                                            <a href="javascript:;" id="add-row-3">Add
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
                                                        <td><select name="major_equipments[]" id="major_equipments"
                                                                class="form-control">
                                                                <option value="">Select Machine</option>
                                                                @foreach($machineList as $machine)
                                                                <option value="{{$machine->id}}">{{$machine->title}}
                                                                </option>
                                                                @endforeach
                                                                <!-- <option value="other">Add Others</option> -->
                                                            </select>
                                                    
                                                            <div id="other_machine_input" style="display: none;">
                                                                <label for="other_machine_title">Other Machine Title:</label>
                                                                <input type="text" name="other_machine_title[]" id="other_machine_title" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <select name="equipments_type[]" id="equipments_type"
                                                                class="form-control">
                                                                <option value="0">Not Available</option>
                                                                <option value="1">Manual</option>
                                                                <option value="2">Semi-Automatic</option>
                                                                <option value="3">Automatic</option>
                                                            </select>
                                                        </td>
                                                        <td> <input type="number" min="0" step="any"
                                                                name="no_of_units[]" id="no_of_units"
                                                                placeholder="No of units" value="">
                                                        </td>
                                                        <td> <input type="text" name="make[]" id="make"
                                                                placeholder="Enter Making of Equipment" value="">
                                                        </td>
                                                        <td><input type="text" name="model[]" id="model"
                                                                placeholder="Enter Model" value=""></td>
                                                        <td><input type="text" name="rating[]" id="rating"
                                                                placeholder="Enter Specification/Rating" value=""></td>
                                                        <td>
                                                            <select name="country_of_origin[]" id="country_of_origin"
                                                                class="form-control">
                                                                <option value="">Select Country</option>
                                                                @foreach($countries as $country)
                                                                <option value="{{$country->countrycd}}">
                                                                    {{$country->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td width="8%">
                                                            <a href="javascript:;" id="add-row-3">Add
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
                                            <button type="submit" name="submit" class="btn btn-success" id="submit">
                                                <i class='bi bi-arrow-bar-up'></i> @if(isset($annexuredata->id) &&
                                                $annexuredata->id !='')Update @else Save @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <a href="{{URL::to('users/annexure-four-two/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>5.2</th>
                                        <th scope="col" colspan="13" class="text-left">List of Major Machines/Equipments
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th width="6%"></th>
                                        <th width="5%">Line</th>
                                        <th width="10%">Compatible Technology (Cell Type/Max Cell Size/No. of Bus Bar)
                                        </th>
                                        <th>Commissioning Date</th>
                                        <th width="10%">Rated Manufacturing Capacity(in mm)(24*7 *365 days working)</th>
                                        <th width="10%">List of Major Machines/Equipments</th>
                                        <th width="10%">Type</th>
                                        <th class="text-center">No. of Units</th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Specification/Rating</th>
                                        <th>Country of Origin </th>

                                    </tr>
                                    @php $check=0; @endphp
                                    @foreach($appData as $data)
                                    @php $check=1; @endphp
                                    <tr>
                                        <td width="10%" rowspan="{{ count(json_decode($data->major_equipments))+1}}">
                                            <a
                                                href="{{URL::to('users/annexure-four-two/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                <i class="bi bi-pencil-square"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/4/'.$general->encodeid($data->id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="bi bi-trash-fill"></i></a>
                                        </td>
                                        <td rowspan="{{ count(json_decode($data->major_equipments))+1}}">
                                            @if($data->line==1)
                                            Line 1
                                            @else
                                            Line 2
                                            @endif
                                            
                                        </td>

                                        <td rowspan="{{ count(json_decode($data->major_equipments))+1}}">
                                            {{$data->compatible_technology}}</td>
                                        <td rowspan="{{ count(json_decode($data->major_equipments))+1}}">
                                            {{$data->commissioning_date}}</td>
                                        <td rowspan="{{ count(json_decode($data->major_equipments))+1}}">
                                            {{$data->rated_mfg_capacity}}</td>


                                    </tr>
                                    @foreach(json_decode($data->major_equipments) as $major_equipments)
                                    <?php  $mjor=json_decode($data->major_equipments)[$loop->iteration - 1];
                                            $other="";
                                          if($mjor=="Add others if any") { 
                                            if($data->other_machine_title != "null")  
                                            {
                                                $other= "-".json_decode($data->other_machine_title)[0];
                                            }
                                        }  
                                    ?>
                            
                                    <tr class="bg-gray">
                                        <td>{{$mjor}} {{$other}}</td>
                                        <td>{{json_decode($data->equipments_type)[$loop->iteration-1]}}</td>
                                        <td>{{json_decode($data->no_of_units)[$loop->iteration-1]}}</td>
                                        <td>{{json_decode($data->make)[$loop->iteration-1]}}</td>
                                        <td>{{json_decode($data->model)[$loop->iteration-1]}}</td>
                                        <td>{{json_decode($data->rating)[$loop->iteration-1]}}</td>
                                        <td>{{json_decode($data->country_of_origin)[$loop->iteration-1]}}</td>


                                    </tr>
                                    @endforeach

                                    @endforeach

                                </tbody>
                                <tr>
                                    <th colspan="13">


                                    </th>
                                </tr>
                            </table>
                            <br>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-four/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    @if($check>0)

                                    <a href="{{URL::to('users/annexure-four-three/'.$general->encodeid($application_id))}}"
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
                '</td><td><select name="major_equipments[]" id="major_equipments' +
                counter +
                '" class="form-control"> <option value="">Select Machine</option> @foreach($machineList as $machine) <option value="{{$machine->id}}">{{$machine->title}} </option> @endforeach </select></td><td><select name="equipments_type[]" id="equipments_type' +
                counter +
                '" class="form-control"> <option value="0">Not Available</option> <option value="1">Manual</option> <option value="2">Semi-Automatic</option> <option value="3">Automatic</option> </select></td><td><input type="number" min="0" value="" step="any" name="no_of_units[]" id="no_of_units_' +
                counter +
                '" placeholder="No of units"  class="form-control" ></td><td><input  type="text" step="any" name="make[]" id="make_' +
                counter +
                '" placeholder="Enter Making of Equipment" value="" class="form-control" ></td><td><input  type="text" name="model[]" id="model_' +
                counter +
                '" placeholder="Enter model" value="" class="form-control" ></td><td><input  type="text"  name="rating[]" id="rating_' +
                counter +
                '" placeholder="Enter Specification/Rating" value="" class="form-control" ></td><td><select name="country_of_origin[]" id="country_of_origin' +
                counter +
                '" class="form-control"> <option value="">Select Country</option> @foreach($countries as $country) <option value="{{$country->countrycd}}"> {{$country->name}}</option> @endforeach </select></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-3");
            tableBody.append(markup);
        });
    });
    </script>
    <script>

    $(document).ready(function() {
        $('#major_equipments').change(function() {
           
            if ($(this).val() == '14') {  
                $('#other_machine_input').show();
            } else {
                $('#other_machine_input').hide();
            }
        });
    });

    // $(document).ready(function() {
    //     $('#major_equipments').change(function() {
           
    //         if ($(this).val() == '14') {  
    //             $('#other_machine_input1').show();
    //         } else {
    //             $('#other_machine_input1').hide();
    //         }
    //     });
    // });

</script>
    @endpush