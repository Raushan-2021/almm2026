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
                                href="{{ URL::to('/users/addExistingModule/'.$general->encodeid($id))}}"><i
                                    class="fa fa-plus"></i> Add</a>
                        </div>

                        <div class="box-body">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th width="5%">S.No</th>
                                        <th width="10%">Type of Modules</th>
                                        <th width="10%">Main Model</th>
                                        <th width="10%">Pmax (Wp) of Main Model</th>
                                        <th width="10%">Applicable models covered under +- 5%, Pmax of Main Model</th>
                                        <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($moduleData as $data)
                                    <tr @if(($data->filter ?? '')==1) class="table-success" @endif>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->module_name}}</td>
                                        <td>{{$data->main_model}}</td>
                                        <td>{{$data->pmax_model}} Wp</td>
                                        <td>
                                            @foreach(json_decode($data->applicable_model_covered) as $amc)
                                            {{$amc}} <span style="border: 0.5px solid #8b8b8b;display: block;"></span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach(json_decode($data->applicable_model) as $am)
                                            {{$am}} Wp <span style="border: 0.5px solid #8b8b8b;display: block;"></span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if(($data->filter ?? '')==2)
                                            <a
                                                href="{{URL::to('/users/editExistingModule/'.$general->encodeid($id).'/'.$general->encodeid($data->id))}}">Edit</a>
                                            &nbsp;
                                            <a href="{{URL::to('/users/deleteExistingModule/'.$general->encodeid($data->id))}}"
                                                onClick="return confirm('Are you sure you want to delete this module?');"
                                                class="text-danger"> Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(!empty($moduleData))

                            <a href="{{URL::to('users/existing-annexure-one/'.$general->encodeid($id))}}"
                                class="btn btn-warning" style="float:right">Next <i class="fa fa-arrow-right"></i></a>

                            <input type="hidden" name="step1" id="step1" value="">
                            @endif
                            <a href="{{URL::to('users/existing-application-step2/'.$general->encodeid($id))}}"
                                class="btn btn-danger" style="float:right"><i class="fa fa-arrow-left"></i> Back </a>


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