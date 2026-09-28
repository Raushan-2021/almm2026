@inject('general', 'App\Http\Controllers\Backend\Users\MainController')
@extends('layouts.masters.backend')
@section('title', 'Module Master')
@section('content')
@include('backend.user.form._stepper_application')
<?php
use App\Models\Module;
?>
<style>
     .comn_drop_shdow{border: 1px solid #dedede;
    background: #ffffff;
    border-radius: 0px 0px 8px 8px;
    box-shadow: 0 0 5px #dedede;}
    .table_max_height{max-height:350px; overflow:auto}
 
        .tab_desgn ul li {
            background: #f1f1f1;
            /* border-right: 1px solid #d1d1d1; */

            height: 80px;
            position: relative;
        }

        .tab_desgn ul li:last-child {
            border-right: none;
            ;
        }

        .tab_desgn ul li a {
            /* position: relative; */
            background-color: #0d6efd00 !important;
            color: #777777 !important;
            font-weight: 600;
            text-transform: uppercase;
            padding: 0;
            margin: 0;
            border-radius: 0 !important;

            text-align: center;
            padding: 15px 0;
            background-color: #eee;
            box-shadow: 0 0 0 1px #ddd;
            top: 15px;
            transition: top .2s;
            height: 100%;border-top: 1px solid #49be80!important;
        }

        .tab_desgn ul li a div {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding-top: 20px;
        }

        .tab_desgn ul li a.active {
            /* position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            
            color: #2754db !important;
            font-weight: 600;
            text-transform: uppercase;
            border: 1px solid #dedede;
             */
            border-radius: 0;
            border-bottom: 0;
            background-color: #ffffff !important;
            background: #fff;
            box-shadow: 1px 1px 0 1px #fff, 0 0px 0 1px #ddd, -1px 1px 0 0px #ddd inset;
            padding-bottom: 30px;
            border-top: 1px solid #49be80;
        }

        .arrow-down {
            display: none;
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 22px solid #49be80;
            position: absolute;
            top: -1px;
            left: calc(50% - 20px);
        }

        .arrow-down-inner {
            display: none;
            width: 0;
            height: 0;
            border-left: 18px solid transparent;
            border-right: 18px solid transparent;
            border-top: 12px solid #fff;
            position: absolute;
            top: -1px;
            left: 38.4%;
        }

        .tab_desgn ul li a.active .arrow-down {
            display: block !important;
        }

        .tab_desgn ul li a.active .arrow-down-inner {
            display: block !important;
        }

        .tab_desgn .tab-content {
            border: 1px solid #dedede;
            border-top: none;

        }

        .tab_desgn ul li a.active div {
            color: #4d72c7;
        }
    </style>

<div class="container-fluid tab_desgn ">
<!-- Nav pills -->
<ul class="nav nav-pills nav-justified" role="tablist">
<li class="nav-item">
    <a class="nav-link " href="{{ URL::to('users/annexure-four-three/'  .$general->encodeid($id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
      <div>Manufacturing Facility<br>3.0 - 3.7</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link active" href="{{ URL::to('users/module-master/' . $general->encodeid($id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Solar PV Modules<br> 4.0</div>
    </a>
</li>

<li class="nav-item">
   <a class="nav-link " href="{{ URL::to('users/annexure-one/' . $general->encodeid($id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Mechanical Data<br>4.1 - 4.2</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-one-b/' . $general->encodeid($id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Electrical Data <br>4.3</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-one-c/' . $general->encodeid($id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Solar Cell & BoM<br>4.4- 4.5</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-three/' . $general->encodeid($id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>BIS Registration<br>5.0 </div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link"  href="{{ URL::to('users/application-fees/' . $general->encodeid($id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Application Fee<br>6.0</div>
    </a>
</li>
    
<li class="nav-item">
    <a class="nav-link"  href="{{ URL::to('users/application-submission/' .$general->encodeid($id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Affidavit & Indemnity<br>7.0</div>
    </a>
</li>

</ul>
</div>


<div class="row" style="padding:0 10px">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="comn_drop_shdow">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        
                        <div class="col-lg-12 pt-3"><div class="  d-flex justify-content-end" >
                            <a class="btn btn-success btn-sm"
                                href="{{ URL::to('/users/addModule/'.$general->encodeid($id))}}"><i
                                    class="fa fa-plus"></i> Add</a>
                        </div>
                        <div class=" pb-2" >
                            <strong>4.0 Details of Solar PV Modules:</strong> 
                        </div>
                        
                        <div class="box-body " style="padding:0">
                            <div style="table-responsive " class="table_max_height">
                            <table class="table table-bordered table-striped ">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th width="5%">S.No</th>
                                        <th width="10%">Module Technology</th>
                                        <th width="10%">Model Name</th>
                                        <th width="10%">Wattage of applied main model (W)</th>
                                        <th width="10%">Model Names of applied sub-models</th>
                                        <th width="10%">Wattage of applied sub-models (W)</th>
                                        <th width="10%">No. $ type of cells in module (eg. 144 Half-Cut cells)</th>
                                        <th width="10%">Max System Voltage (V)</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $k=0;?>
                                    @foreach($moduleData as $key=>$data)
                                    @php
                                        $rows=Module::where('main_module_id',$data->id)->get();
                                        $cnt1=count($rows);
                                        $i=0;
                                        $j=1;
                                    //print_r($rows);
                                    $data = json_decode($data);
                                    $cnt=count($moduleData);
                                    @endphp
                                    
                                   @foreach($rows as $row)

                                      @if($i==0)
                                      <?php $k++; ?>
                                      <tr>
                                      <td rowspan="{{$cnt1}}">{{$k}}</td>
                                      <td rowspan="{{$cnt1}}"> @if ($data->module_type == 17)     
                                            @else
                                                {{ $data->module_name }}
                                            @endif 
                                           @if($data->module_type==17)

                                            <?php echo $data->other; ?>
                                            @endif</td>
                                            <td  rowspan="{{$cnt1}}">{{$data->main_model_name}}</td>
                                            <td  rowspan="{{$cnt1}}">{{$data->main_wattage}}</td>
                                            <td >{{$row->sub_model_name}}</td>
                                            <td >{{$row->sub_model_wattage}}</td>
                                            <td >{{$row->cell_type}}</td>
                                            <td >{{$row->max_system_volatge}}</td>
                                            <td  rowspan="{{$cnt1}}">  <input type="hidden" name="edit_id" id="edit_id"
                                          value="@if(isset($moduleData->id)){{$general->encodeid($moduleData->id)}}@endif">
                                            <a href="{{URL::to('/users/editModule/'.$general->encodeid($id).'/'.$general->encodeid($data->id))}}">
                                                Edit <i class="bi bi-pencil-square"></i></a>
                                            &nbsp;
                                            <a href="{{URL::to('/users/deleteModule/'.$general->encodeid($data->id))}}"
                                                onClick="return confirm('Are you sure you want to delete this module?');"
                                                class="text-danger"> Delete <i class="bi bi-trash-fill"></i></a></td>
                                    </tr>  
                                      @else
                                      <tr>
                                      <td >{{$row->sub_model_name}}</td>
                                            <td >{{$row->sub_model_wattage}}</td>
                                            <td >{{$row->cell_type}}</td>
                                            <td >{{$row->max_system_volatge}}</td>
                                    </tr>  
                                      @endif
                                    <?php
                                    $i++;
                                    ?>
                                   @endforeach
                                  <!--  <tr>
                                        <td  rowspan="{{$cnt}}">{{$loop->iteration}}</td>
                                        <td  rowspan="{{$cnt}}">
                                         @if ($data->module_type == 17)     
                                            @else
                                                {{ $data->module_name }}
                                            @endif 
                                           @if($data->module_type==17)

                                            <?php echo $data->other; ?>
                                            @endif
                                        </td>
                                        <td  rowspan="{{$cnt}}">{{$data->main_model_name}}</td>

                                        <td  rowspan="{{$cnt}}">{{$data->main_wattage}}</td>
                                     
                                 
                                        <td>{{$data->main_wattage}}</td>
                                        <td>{{$data->main_wattage}}</td>
                                        <td>{{$data->main_wattage}}</td>
                                        <td>{{$data->main_wattage}}</td>
                                     


                                        <td>
                                         <input type="hidden" name="edit_id" id="edit_id"
                                          value="@if(isset($moduleData->id)){{$general->encodeid($moduleData->id)}}@endif">
                                            <a href="{{URL::to('/users/editModule/'.$general->encodeid($id).'/'.$general->encodeid($data->id))}}">
                                                Edit <i class="bi bi-pencil-square"></i></a>
                                            &nbsp;
                                            <a href="{{URL::to('/users/deleteModule/'.$general->encodeid($data->id))}}"
                                                onClick="return confirm('Are you sure you want to delete this module?');"
                                                class="text-danger"> Delete <i class="bi bi-trash-fill"></i></a>
                                        </td>
                                    </tr>-->
                                  
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                            
                            <div class="row">
                                <div class="col-lg-12 pb-3 pt-4 text-center">
                                    <a href="{{URL::to('users/annexure-four-three/'.$general->encodeid($id))}}"
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
</div>
@endsection
