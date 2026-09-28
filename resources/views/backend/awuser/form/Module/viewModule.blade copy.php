@inject('general', 'App\Http\Controllers\Backend\Users\MainController')
@extends('layouts.masters.backend')
@section('title', 'Module Master')
@section('content')
@include('backend.user.form._stepper_application')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-header with-border">
                            <a class="btn btn-success btn-sm"
                                href="{{ URL::to('/users/addModule/'.$general->encodeid($id))}}"><i
                                    class="fa fa-plus"></i> Add</a>
                        </div>

                        <div class="box-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-warning">
                                        <th width="5%">S.No</th>
                                        <th width="10%">Module Technology</th>
                                        <!-- <th width="10%">Representative Main Model</th>
                                        <th width="10%">Pmax (Wp) of Main Model</th> -->
                                        <th width="10%">Mean Wattage and application Range of Wattage for the Module Model</th>
                                        <!-- <th width="10%">Pmax (Wp) of Applicable Models Model</th> -->
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($moduleData as $data)
                                    @php
                                    $data = json_decode($data);
                                    @endphp
                                    
                                   
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->module_name}}

                                        <!-- @if ($data->module_type == 17) 
                                                <?php $oth=json_decode($data->other_module_title) ; echo $oth[0]; ?>
                                            @else
                                                {{ $data->module_name }}
                                            @endif -->
                                            <!-- {{$data->module_name}} -->

                                        </td>
                                        <!-- <td>{{$data->main_model}}</td>
                                        <td>{{$data->pmax_model}}</td> -->
                                        <td>
                                            @foreach(json_decode($data->applicable_model_covered) as $amc)
                                            {{$amc}}<br>
                                            @endforeach
                                        </td>
                                        <!-- <td>
                                            @foreach(json_decode($data->applicable_model) as $am)
                                            {{$am}}<br>
                                            @endforeach
                                        </td> -->
                                        <td>
                                            <a
                                                href="{{URL::to('/users/editModule/'.$general->encodeid($id).'/'.$general->encodeid($data->id))}}">
                                                Edit <i class="bi bi-pencil-square"></i></a>
                                            &nbsp;
                                            <a href="{{URL::to('/users/deleteModule/'.$general->encodeid($data->id))}}"
                                                onClick="return confirm('Are you sure you want to delete this module?');"
                                                class="text-danger"> Delete <i class="bi bi-trash-fill"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/new-application/'.$general->encodeid($id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i> Back
                                    </a>
                                    @if($moduleData->isNotEmpty())

                                    <a href="{{URL::to('users/annexure-one/'.$general->encodeid($id))}}"
                                        class="btn btn-warning">Next <i class="bi bi-arrow-bar-right"></i></a>

                                    <input type="hidden" name="step1" id="step1" value="">
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


    @endsection