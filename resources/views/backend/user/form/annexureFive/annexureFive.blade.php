@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Module Production, Sale and Purchase Data')
@php
$attcBaseUrl ='users/preview-docs/Attachment/';
@endphp
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
                            <form action="{{ URL::to('/users/annexure-five')}}" method="POST" id="formAjax1">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display: @if($annexuredata!=null)  @else none @endif">

                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">PV Module Production Data / Sale Data / Raw Material
                                                        Purchase
                                                        Data <small class="text-danger"> * </small></label>
                                                    <select name="datatype" id="datatype" class="form-control">
                                                        <option value=''>~~~Choose~~~</option>
                                                        <option value='1' @if(($urlParameter["datatype"] ?? '' )==1)
                                                            selected @endif>PV Module Sale Data</option>
                                                        <option value='2' @if(($urlParameter["datatype"] ?? '' )==2)
                                                            selected @endif>Raw Material Purchase Data</option>
                                                        <option value='3' @if(($urlParameter["datatype"] ?? '' )==3)
                                                            selected @endif>PV Module Production Data</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">Financial Year<small class="text-danger"> * </small></label>
                                                    <select name="financial_year" id="financial_year"
                                                        class="form-control">
                                                        <option value="">--Select Financial Year--</option>
                                                        @php
                                                        $startYear = date("Y")+2;
                                                        $prevYear = date("Y")+1;$yrFlg=0;
                                                        for ($i = 0; $i < 3; $i++) { $startYear=$startYear - 1;
                                                            $prevYear=$prevYear - 1;
                                                            $financial_year=$prevYear."-".$startYear; @endphp <option
                                                            value="{{$prevYear}}-{{$startYear}}"
                                                            @if(($urlParameter["financialyear"] ?? ''
                                                            )==$financial_year) selected @endif>{{$financial_year}}
                                                            </option>
                                                            @php
                                                            if(($urlParameter["financialyear"] ?? '')==$financial_year){
                                                            $yrFlg=1;
                                                            }
                                                            }
                                                            if($yrFlg==0 && isset($urlParameter["financialyear"])){
                                                            @endphp
                                                            <option value="{{$urlParameter["financialyear"]}}" selected>
                                                                {{$urlParameter["financialyear"]}}
                                                            </option>
                                                            @php
                                                            }
                                                            @endphp
                                                    </select>
                                                </div>


                                                <div class="col-md-12 @if(isset($urlParameter['datatype']) && $urlParameter['datatype']==1) @else hidden
                                                    @endif " id="moduledata"><br>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr class="bg-warning">
                                                                <th>S.No</th>
                                                                <th>Month</th>
                                                                <th>Module Export Sales (in MW)</th>
                                                                <th>Module Domestic Sales (in MW)</th>
                                                                <th>Module Sales Amount (in Rs)</th>
                                                                <th>EPC and Other Sales Amount (in Rs)</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if($annexuredata!=null)

                                                            @foreach($annexuredata as $data)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$data->month}}
                                                                    <input type="hidden" name="month[]"
                                                                        value="{{$data->month}}" id="">
                                                                </td>
                                                                <td><input type="number" min="0" step="any"
                                                                        name="module_sale[]" id=""
                                                                        value="{{$data->module_sale}}"></td>
                                                                <td><input type="number" min="0" step="any"
                                                                        name="module_sale_domestic[]" id=""
                                                                        value="{{$data->module_sale_domestic}}"></td>
                                                                <td><input type="number" min="0" step="any"
                                                                        name="module_sale_amount[]"
                                                                        value="{{$data->module_sale_amount}}" id="">
                                                                </td>
                                                                <td><input type="number" min="0" step="any"
                                                                        name="epc_other_amount[]"
                                                                        value="{{$data->epc_other_amount}}" id="">
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                            @endforeach
                                                            @else
                                                            @php $months = array(1 => 'April', 2 => 'May', 3 => 'June',
                                                            4 =>
                                                            'July', 5 =>
                                                            'August', 6 => 'September', 7 => 'October', 8 => 'November',
                                                            9 =>
                                                            'December', 10 =>
                                                            'January', 11 => 'February', 12 => 'March');
                                                            @endphp
                                                            @foreach($months as $num => $name)

                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$name}} <input type="hidden" name="month[]"
                                                                        value="{{$name}}" id=""></td>
                                                                <td><input type="number" min="0" step="any"
                                                                        name="module_sale[]" id="" value="0.00"></td>
                                                                <td><input type="number" min="0" step="any"
                                                                        name="module_sale_domestic[]" id=""
                                                                        value="0.00"></td>
                                                                <td><input type="number" min="0" step="any"
                                                                        name="module_sale_amount[]" id="" value="0.00">
                                                                </td>
                                                                <td><input type="number" min="0" step="any"
                                                                        name="epc_other_amount[]" id="" value="0.00">
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                            @endforeach
                                                            @endif

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-12 @if(isset($urlParameter['datatype']) && $urlParameter['datatype']==2) @else hidden
                                                    @endif" id="rawdata"><br>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr class="bg-warning">
                                                                <th>S.No</th>
                                                                <th>Month </th>
                                                                <th>Raw Material Purchase for Module Amount (Rs)</th>
                                                                <th>Other Raw Material Purchase Amount (Rs)</th>

                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if($annexuredata!=null)

                                                            @foreach($annexuredata as $data)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$data->month}}<input type="hidden" name="month[]"
                                                                        value="{{$data->month}}" id=""></td>
                                                                <td><input type="number" min="0" step="any"
                                                                        name="raw_purchase_module[]" id=""
                                                                        value="{{$data->raw_purchase_module}}"></td>
                                                                <td><input type="number" min="0" step="any"
                                                                        name="other_raw_purchase[]"
                                                                        value="{{$data->other_raw_purchase}}" id="">
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                            @endforeach
                                                            @else
                                                            @php $months = array(1 => 'April', 2 => 'May', 3 => 'June',
                                                            4 =>
                                                            'July', 5 =>
                                                            'August', 6 => 'September', 7 => 'October', 8 => 'November',
                                                            9 =>
                                                            'December', 10 =>
                                                            'January', 11 => 'February', 12 => 'March');
                                                            @endphp
                                                            @foreach($months as $num => $name)

                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$name}}</td>
                                                                <td><input type="number" min="0" step="any"
                                                                        name="raw_purchase_module[]" id="" value="0.00">
                                                                </td>
                                                                <td><input type="number" min="0" step="any"
                                                                        name="other_raw_purchase[]" value="0.00" id="">
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                            @endforeach
                                                            @endif

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-12 @if(isset($urlParameter['datatype']) && $urlParameter['datatype']==3) @else hidden
                                                    @endif" id="productiondata"><br>
                                                    <table class="table table-bordered">

                                                        @php
                                                        $total1=$total2=$total3=0;
                                                        $startYear = date("Y")+1;
                                                        $prevYear = date("Y");
                                                        $current_financial_year = $prevYear."-".$startYear;

                                                        $startYear1 = date("Y");
                                                        $prevYear1 = date("Y")-1;
                                                        $last_financial_year = $prevYear1."-".$startYear1;

                                                        $startYear2 = date("Y")-1;
                                                        $prevYear2 = date("Y")-2;
                                                        $lasttolast_financial_year = $prevYear2."-".$startYear2;
                                                        @endphp

                                                        <thead>
                                                            <tr class="bg-warning">
                                                                <th>S.No</th>
                                                                <th>Month</th>
                                                                <th>Financial Year {{$financialYear['current']?? ''}}
                                                                </th>
                                                                <th>Financial Year {{$financialYear['last'] ?? ''}}</th>
                                                                <th>Financial Year
                                                                    {{$financialYear['lastTolast'] ?? ''}} </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @php $months = array(1 => 'April', 2 => 'May', 3 => 'June',
                                                            4 =>
                                                            'July', 5 =>
                                                            'August', 6 => 'September', 7 => 'October', 8 => 'November',
                                                            9 =>
                                                            'December', 10 =>
                                                            'January', 11 => 'February', 12 => 'March');
                                                            @endphp
                                                            @foreach($months as $num => $name)

                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$name}} <input type="hidden" name="monthAll[]"
                                                                        id="" value="{{$name}}"> </td>
                                                                <td><input type="number" min="0" step="any" name="cf[]"
                                                                        id="" value="0.00">
                                                                    <input type="hidden" name="cf_fy" id=""
                                                                        value="{{$current_financial_year}}">
                                                                </td>
                                                                <td><input type="number" min="0" step="any" name="lf[]"
                                                                        id="" value="0.00">
                                                                    <input type="hidden" name="lf_fy" id=""
                                                                        value="{{$last_financial_year}}">
                                                                </td>
                                                                <td><input type="number" min="0" step="any" name="llf[]"
                                                                        id="" value="0.00">
                                                                    <input type="hidden" name="llf_fy" id=""
                                                                        value="{{$lasttolast_financial_year}}">
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>

                                    <tr>
                                        <td>
                                            <button type="submit" name="submit" class="btn btn-success" id="submit">
                                                <i class='bi bi-arrow-bar-up'></i> @if(isset($annexuredata->id) &&
                                                $annexuredata->id !='')Update @else Save @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="{{$urlParameter['edit'] ?? ''}}">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">

                                            <a href="{{URL::to('users/annexure-five/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>

                                        </td>
                                    </tr>
                                </table>
                            </form>

                            <div class="card1  shadow1">
                                <h2 class="text-center1">Module Production, Sale and Purchase Data (Last 3 Financial
                                    Year)
                                    <a class="btn btn-success btn-sm" style="float:right" href="javascript:;"
                                        onclick="$('#show_data').toggle('slow')"><i class="fa fa-plus"></i> Add
                                        Financial
                                        Details</a>
                                    <hr>
                                </h2>
                                <nav>
                                    <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                        <button class="nav-link bg-primary text-light active" id="nav-home-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab"
                                            aria-controls="nav-home" aria-selected="true">PV Module Production Data in
                                            MW</button>
                                        <button class="nav-link  bg-warning text-light" id="nav-profile-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab"
                                            aria-controls="nav-profile" aria-selected="false">Raw Material Purchase
                                            Data</button>
                                        <button class="nav-link  bg-info text-light" id="nav-contact-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab"
                                            aria-controls="nav-contact" aria-selected="false">PV Module Sales
                                            Data</button>

                                    </div>
                                </nav>
                                <div class="tab-content p-3 border bg-gray" id="nav-tabContent">
                                    <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <p><strong>PV Module Production Data in
                                                MW</strong>
                                            <hr />
                                        </p>
                                        @if(!empty($appData['datatype3']))
                                        <table class="table table-bordered">


                                            <thead>

                                                <tr class="bg-warning">
                                                    <th>S.No</th>
                                                    <th>Month</th>
                                                    <th>Financial Year {{$financialYear['current']?? ''}}</th>
                                                    <th>Financial Year {{$financialYear['last'] ?? ''}}</th>
                                                    <th>Financial Year {{$financialYear['lastTolast'] ?? ''}}
                                                    </th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=0;$currentData=$lastData=$lasttolast=0;@endphp
                                                @foreach($appData['datatype3']['current'] as $data)
                                                @php
                                                $currentData+=$data['module_production_data'];
                                                $lastData+=$appData['datatype3']['last'][$loop->iteration]['module_production_data'];
                                                $lasttolast+=$appData['datatype3']['lastTolast'][$loop->iteration]['module_production_data'];

                                                @endphp
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$data['month']}}</td>


                                                    <td><span class="productiondspan{{$data['id']}}"
                                                            id="productiondspan{{$data['id']}}">{{$data['module_production_data']}}</span>
                                                        <input type="number" data-id="{{$data['id']}}"
                                                            id="module_production_data{{$data['id']}}"
                                                            value="{{$data['module_production_data']}}"
                                                            class="productiondtext{{$data['id']}} hidden"
                                                            onblur="updateData(this)">
                                                    </td>
                                                    <td><span class="productiondspan{{$data['id']}}"
                                                            id="productiondspan{{$appData['datatype3']['last'][$loop->iteration]['id']}}">{{$appData['datatype3']['last'][$loop->iteration]['module_production_data']}}</span>
                                                        <input type="number"
                                                            data-id="{{$appData['datatype3']['last'][$loop->iteration]['id']}}"
                                                            id="module_production_data{{$appData['datatype3']['last'][$loop->iteration]['id']}}"
                                                            value="{{$appData['datatype3']['last'][$loop->iteration]['module_production_data']}}"
                                                            class="productiondtext{{$data['id']}} hidden"
                                                            onblur="updateData(this)">
                                                    </td>
                                                    <td><span class="productiondspan{{$data['id']}}"
                                                            id="productiondspan{{$appData['datatype3']['lastTolast'][$loop->iteration]['id']}}">{{$appData['datatype3']['lastTolast'][$loop->iteration]['module_production_data']}}</span>
                                                        <input type="number"
                                                            data-id="{{$appData['datatype3']['lastTolast'][$loop->iteration]['id']}}"
                                                            id="module_production_data{{$appData['datatype3']['lastTolast'][$loop->iteration]['id']}}"
                                                            value="{{$appData['datatype3']['lastTolast'][$loop->iteration]['module_production_data']}}"
                                                            class="productiondtext{{$data['id']}} hidden"
                                                            onblur="updateData(this)">
                                                    </td>
                                                    <td>
                                                        <!-- <a
                                                                href="{{URL::to('users/annexure-five/'.$general->encodeid($data['application_id']).'/'.$data['financial_year'].'/'.$general->encodeid($data['type']))}}">Edit
                                                                <i class="bi bi-pencil-square"></i></a> -->
                                                        <a href="javascript:;" onclick="showBox('{{$data['id']}}')"
                                                            id="edit{{$data['id']}}">Edit<i
                                                                class="bi bi-pencil-square"></i></a>
                                                        <a href="javascript:;" class="hidden"
                                                            onclick="hideBox('{{$data['id']}}')"
                                                            id="cancel{{$data['id']}}">Update <i
                                                                class="fa fa-times"></i></a>


                                                    </td>



                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <th colspan="2">Total</th>
                                                    <th>{{ number_format($currentData,2)}}</th>
                                                    <th>{{number_format($lastData,2)}}</th>
                                                    <th>{{number_format($lasttolast,2)}}</th>
                                                    <td></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <p><strong>Raw Material Purchase Data</strong></p>

                                        @if(!empty($appData['datatype2']))
                                        <div class="container1 p-2 d-flex align-items-start">
                                            <ul class="nav nav-pills flex-column nav-pills border-end border-3 me-3 align-items-end"
                                                id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button
                                                        class="nav-link text-light bg-success fw-semibold active position-relative"
                                                        id="pills-home-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-home" type="button" role="tab"
                                                        aria-controls="pills-home"
                                                        aria-selected="true">{{$financialYear['current']?? ''}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button
                                                        class="nav-link bg-primary  text-light fw-semibold position-relative"
                                                        id="pills-profile-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-profile" type="button" role="tab"
                                                        aria-controls="pills-profile"
                                                        aria-selected="false">{{$financialYear['last'] ?? ''}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button
                                                        class="nav-link bg-danger  text-light fw-semibold position-relative"
                                                        id="pills-contact-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-contact" type="button" role="tab"
                                                        aria-controls="pills-contact"
                                                        aria-selected="false">{{$financialYear['lastTolast'] ?? ''}}</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content border rounded-3 border-dark p-3 text-danger w-100"
                                                id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                                    aria-labelledby="pills-home-tab">
                                                    <h2 class="text-dark">Financial Year
                                                        {{$financialYear['current'] ?? ''}}</h2>
                                                    <p>

                                                    <table class="table table-bordered">
                                                        <!-- Code : 2 -->
                                                        <thead>

                                                            <tr class="bg-warning">
                                                                <th>S.No</th>
                                                                <th>Month</th>
                                                                <th>Raw Material Purchase for Module Amount (Rs)</th>
                                                                <th>Other Raw Material Purchase Amount (Rs)</th>
                                                                <th>Total Purchase Amount (Rs)</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $count1=$raw_purchase_module=$other_raw_purchase=0;
                                                            @endphp
                                                            @foreach($appData['datatype2'] as $data)
                                                            @if(($financialYear['current'] ??
                                                            '')==$data->financial_year)
                                                            @php
                                                            $count1+=1;$raw_purchase_module+=$data->raw_purchase_module;$other_raw_purchase+=$data->other_raw_purchase;
                                                            @endphp
                                                            <tr>
                                                                <td>{{$count1}}</td>
                                                                <td>{{$data->month}}</td>
                                                                <td>{{$data->raw_purchase_module}}</td>
                                                                <td>{{$data->other_raw_purchase}}</td>
                                                                <td>{{$data->raw_purchase_module + $data->other_raw_purchase}}
                                                                </td>
                                                                <td><a
                                                                        href="{{URL::to('users/annexure-five/'.$general->encodeid($data->application_id).'/'.$data->financial_year.'/'.$general->encodeid($data->type))}}">Edit
                                                                        <i class="bi bi-pencil-square"></i></a>

                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            <tr class="bg-gray">
                                                                <th>Total :</th>
                                                                <th>--</th>
                                                                <th>{{$raw_purchase_module}}</th>
                                                                <th>{{$other_raw_purchase}}</th>
                                                                <th>{{$raw_purchase_module+$other_raw_purchase}}</th>
                                                                <th>--</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </p>
                                                </div>
                                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                                    aria-labelledby="pills-profile-tab">
                                                    <h2 class="text-dark">Financial Year
                                                        {{$financialYear['last'] ?? ''}}</h2>
                                                    <p>
                                                    <table class="table table-bordered">
                                                        <!-- Code : 2 -->
                                                        <thead>
                                                            <tr class="bg-warning">
                                                                <th>S.No</th>
                                                                <th>Month</th>
                                                                <th>Raw Material Purchase for Module Amount (Rs)</th>
                                                                <th>Other Raw Material Purchase Amount (Rs)</th>
                                                                <th>Total Purchase Amount (Rs)</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $count2=$raw_purchase_module2=$other_raw_purchase2=0;;
                                                            @endphp
                                                            @foreach($appData['datatype2'] as $data)
                                                            @if($data->financial_year==$financialYear['last'])
                                                            @php
                                                            $count2+=1;$raw_purchase_module2+=$data->raw_purchase_module;$other_raw_purchase2+=$data->other_raw_purchase;
                                                            @endphp
                                                            <tr>
                                                                <td>{{$count2}}</td>
                                                                <td>{{$data->month}}</td>
                                                                <td>{{$data->raw_purchase_module}}</td>
                                                                <td>{{$data->other_raw_purchase}}</td>
                                                                <td>{{$data->raw_purchase_module + $data->other_raw_purchase}}
                                                                </td>
                                                                <td>
                                                                    <a
                                                                        href="{{URL::to('users/annexure-five/'.$general->encodeid($data->application_id).'/'.$data->financial_year.'/'.$general->encodeid($data->type))}}">Edit
                                                                        <i class="bi bi-pencil-square"></i></a>

                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            <tr class="bg-gray">
                                                                <th>Total :</th>
                                                                <th>--</th>
                                                                <th>{{$raw_purchase_module2}}</th>
                                                                <th>{{$other_raw_purchase2}}</th>
                                                                <th>{{$raw_purchase_module2+$other_raw_purchase2}}</th>
                                                                <th>--</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </p>
                                                </div>
                                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                                    aria-labelledby="pills-contact-tab">
                                                    <h2 class="text-dark">Financial Year
                                                        {{$financialYear['lastTolast'] ?? ''}}</h2>
                                                    <p>
                                                    <table class="table table-bordered">
                                                        <!-- Code : 2 -->
                                                        <thead>
                                                            <tr class="bg-warning">
                                                                <th>S.No</th>
                                                                <th>Month</th>
                                                                <th>Raw Material Purchase for Module Amount (Rs)</th>
                                                                <th>Other Raw Material Purchase Amount (Rs)</th>
                                                                <th>Total Purchase Amount (Rs)</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $count3=$raw_purchase_module3=$other_raw_purchase3=0;
                                                            @endphp
                                                            @foreach($appData['datatype2'] as $data)
                                                            @if($data->financial_year==$financialYear['lastTolast'])
                                                            @php
                                                            $count3+=1;$raw_purchase_module3+=$data->raw_purchase_module;$other_raw_purchase3+=$data->other_raw_purchase;
                                                            @endphp
                                                            <tr>
                                                                <td>{{$count3}}</td>
                                                                <td>{{$data->month}}</td>
                                                                <td>{{$data->raw_purchase_module}}</td>
                                                                <td>{{$data->other_raw_purchase}}</td>
                                                                <td>{{$data->raw_purchase_module + $data->other_raw_purchase}}
                                                                </td>
                                                                <td>
                                                                    <a
                                                                        href="{{URL::to('users/annexure-five/'.$general->encodeid($data->application_id).'/'.$data->financial_year.'/'.$general->encodeid($data->type))}}">Edit
                                                                        <i class="bi bi-pencil-square"></i></a>

                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            <tr class="bg-gray">
                                                                <th>Total :</th>
                                                                <th>--</th>
                                                                <th>{{$raw_purchase_module3}}</th>
                                                                <th>{{$other_raw_purchase3}}</th>
                                                                <th>{{$raw_purchase_module3+$other_raw_purchase3}}</th>
                                                                <th>--</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                        aria-labelledby="nav-contact-tab">
                                        <p><strong>PV Module Sales Data</strong></p>
                                        @php $check=0;@endphp
                                        @if(!empty($appData['datatype1']))

                                        <div class="container1 p-2 d-flex align-items-start">
                                            <ul class="nav nav-pills flex-column nav-pills border-end border-3 me-3 align-items-end"
                                                id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button
                                                        class="nav-link text-light bg-success fw-semibold active position-relative"
                                                        id="current-tab" data-bs-toggle="pill" data-bs-target="#current"
                                                        type="button" role="tab" aria-controls="current"
                                                        aria-selected="true">{{$financialYear['current'] ?? ''}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button
                                                        class="nav-link bg-primary  text-light fw-semibold position-relative"
                                                        id="last-tab" data-bs-toggle="pill" data-bs-target="#last"
                                                        type="button" role="tab" aria-controls="last"
                                                        aria-selected="false">{{$financialYear['last'] ?? ''}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button
                                                        class="nav-link bg-danger  text-light fw-semibold position-relative"
                                                        id="lasttolast-tab" data-bs-toggle="pill"
                                                        data-bs-target="#lasttolast" type="button" role="tab"
                                                        aria-controls="lasttolast"
                                                        aria-selected="false">{{$financialYear['lastTolast'] ?? ''}}</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content border rounded-3 border-dark p-3 text-danger w-100"
                                                id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="current" role="tabpanel"
                                                    aria-labelledby="current-tab">
                                                    <h2 class="text-dark">Financial Year
                                                        {{$financialYear['current'] ?? ''}}</h2>
                                                    <p>
                                                    <table class="table table-bordered">

                                                        <thead>
                                                            <tr class="bg-warning">
                                                                <th>S.No</th>
                                                                <th>Month</th>
                                                                <th>Module Export Sales (in MW)</th>
                                                                <th>Module Domestic Sales (in MW)</th>
                                                                <th>Total Module Sales (in MW)</th>
                                                                <th>Module Sales Amount (in Rs)</th>
                                                                <th>EPC and Other Sales Amount (in Rs)</th>
                                                                <th>Total Sales Amount (Rs)</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $countModuleSale1=0;$total_module_sale=$module_sale_domestic=$total_module_sale_amount=$epc_other_amount=0;
                                                            @endphp
                                                            @foreach($appData['datatype1'] as $data)
                                                            @if(($financialYear['current'] ??
                                                            '')==$data->financial_year)
                                                            @php $countModuleSale1+=1;
                                                            $total_module_sale+=$data->module_sale;
                                                            $module_sale_domestic+=$data->module_sale_domestic;
                                                            $total_module_sale_amount+=$data->module_sale_amount;
                                                            $epc_other_amount+=$data->epc_other_amount;
                                                            @endphp
                                                            <tr>
                                                                <td>{{$countModuleSale1}}</td>
                                                                <td>{{$data->month}}</td>
                                                                <td>{{$data->module_sale}}</td>
                                                                <td>{{$data->module_sale_domestic}}</td>
                                                                <td class="bg-gray">
                                                                    {{$total_module_sale+$module_sale_domestic}}
                                                                </td>
                                                                <td>{{$data->module_sale_amount}}</td>
                                                                <td>{{$data->epc_other_amount}}</td>
                                                                <td class="bg-gray">
                                                                    {{$data->module_sale_amount+$data->epc_other_amount}}
                                                                </td>
                                                                <td>
                                                                    <a
                                                                        href="{{URL::to('users/annexure-five/'.$general->encodeid($data->application_id).'/'.$data->financial_year.'/'.$general->encodeid($data->type))}}">Edit
                                                                        <i class="bi bi-pencil-square"></i></a>


                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            <tr class="bg-gray">
                                                                <th>Total :</th>
                                                                <th>--</th>
                                                                <th>{{$total_module_sale}}</th>
                                                                <th>{{$module_sale_domestic}}</th>
                                                                <th>{{$module_sale_domestic+$total_module_sale}}</th>
                                                                <th>{{$total_module_sale_amount}}</th>
                                                                <th>{{$epc_other_amount}}</th>
                                                                <th>{{$total_module_sale_amount+$epc_other_amount}}
                                                                </th>
                                                                <th>--</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </p>
                                                </div>
                                                <div class="tab-pane fade" id="last" role="tabpanel"
                                                    aria-labelledby="last-tab">
                                                    <h2 class="text-dark">Financial Year
                                                        {{$financialYear['last'] ?? ''}}</h2>
                                                    <p>
                                                    <table class="table table-bordered">

                                                        <thead>
                                                            <tr class="bg-warning">
                                                                <th>S.No</th>
                                                                <th>Month</th>
                                                                <th>Module Export Sales (in MW)</th>
                                                                <th>Module Domestic Sales (in MW)</th>
                                                                <th>Total Module Sales (in MW)</th>
                                                                <th>Module Sales Amount (in Rs)</th>
                                                                <th>EPC and Other Sales Amount (in Rs)</th>
                                                                <th>Total Sales Amount (Rs)</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $countModuleSale2=0;$total_module_sale2=$module_sale_domestic2=$total_module_sale_amount2=$epc_other_amount2=0;
                                                            @endphp
                                                            @foreach($appData['datatype1'] as $data)
                                                            @if(($financialYear['last'] ?? '')==$data->financial_year)
                                                            @php $countModuleSale2+=1;
                                                            $total_module_sale2+=$data->module_sale;
                                                            $module_sale_domestic2+=$data->module_sale_domestic;
                                                            $total_module_sale_amount2+=$data->module_sale_amount;
                                                            $epc_other_amount2+=$data->epc_other_amount;
                                                            @endphp
                                                            <tr>
                                                                <td>{{$countModuleSale2}}</td>
                                                                <td>{{$data->month}}</td>
                                                                <td>{{$data->module_sale}}</td>
                                                                <td>{{$data->module_sale_domestic}}</td>
                                                                <td class="bg-gray">
                                                                    {{$data->total_module_sale2+$module_sale_domestic2}}
                                                                </td>
                                                                <td>{{$data->module_sale_amount}}</td>
                                                                <td>{{$data->epc_other_amount}}</td>
                                                                <td class="bg-gray">
                                                                    {{$data->module_sale_amount+$data->epc_other_amount}}
                                                                </td>
                                                                <td>
                                                                    <a
                                                                        href="{{URL::to('users/annexure-five/'.$general->encodeid($data->application_id).'/'.$data->financial_year.'/'.$general->encodeid($data->type))}}">Edit
                                                                        <i class="bi bi-pencil-square"></i></a>


                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            <tr class="bg-gray">
                                                                <th>Total :</th>
                                                                <th>--</th>
                                                                <th>{{$total_module_sale2}}</th>
                                                                <th>{{$module_sale_domestic2}}</th>
                                                                <th>{{$total_module_sale2+$module_sale_domestic2}}</th>
                                                                <th>{{$total_module_sale_amount2}}</th>
                                                                <th>{{$epc_other_amount2}}</th>
                                                                <th>{{$total_module_sale_amount2+$epc_other_amount2}}
                                                                </th>
                                                                <th>--</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </p>
                                                </div>
                                                <div class="tab-pane fade" id="lasttolast" role="tabpanel"
                                                    aria-labelledby="lasttolast-tab">
                                                    <h2 class="text-dark">Financial Year
                                                        {{$financialYear['lastTolast'] ?? ''}}</h2>
                                                    <p>
                                                    <table class="table table-bordered">

                                                        <thead>
                                                            <tr class="bg-warning">
                                                                <th>S.No</th>
                                                                <th>Month</th>
                                                                <th>Module Export Sales (in MW)</th>
                                                                <th>Module Domestic Sales (in MW)</th>
                                                                <th>Total Module Sales (in MW)</th>
                                                                <th>Module Sales Amount (in Rs)</th>
                                                                <th>EPC and Other Sales Amount (in Rs)</th>
                                                                <th>Total Sales Amount (Rs)</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $countModuleSale3=0;$total_module_sale3=$module_sale_domestic3=$total_module_sale_amount3=$epc_other_amount3=0;
                                                            @endphp
                                                            @foreach($appData['datatype1'] as $data)
                                                            @if(($financialYear['lastTolast'] ??
                                                            '')==$data->financial_year)
                                                            @php $countModuleSale3+=1;
                                                            $total_module_sale3+=$data->module_sale;
                                                            $module_sale_domestic3+=$data->module_sale_domestic;
                                                            $total_module_sale_amount3+=$data->module_sale_amount;
                                                            $epc_other_amount3+=$data->epc_other_amount;
                                                            $check=1;
                                                            @endphp
                                                            <tr>
                                                                <td>{{$countModuleSale3}}</td>
                                                                <td>{{$data->month}}</td>
                                                                <td>{{$data->module_sale}}</td>
                                                                <td>{{$data->module_sale_domestic}}</td>
                                                                <td class="bg-gray">
                                                                    {{$data->total_module_sale2+$module_sale_domestic2}}
                                                                </td>
                                                                <td>{{$data->module_sale_amount}}</td>
                                                                <td>{{$data->epc_other_amount}}</td>
                                                                <td class="bg-gray">
                                                                    {{$data->module_sale_amount+$data->epc_other_amount}}
                                                                </td>
                                                                <td>
                                                                    <a
                                                                        href="{{URL::to('users/annexure-five/'.$general->encodeid($data->application_id).'/'.$data->financial_year.'/'.$general->encodeid($data->type))}}">Edit
                                                                        <i class="bi bi-pencil-square"></i></a>


                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            <tr class="bg-gray">
                                                                <th>Total :</th>
                                                                <th>--</th>
                                                                <th>{{$total_module_sale3}}</th>
                                                                <th>{{$module_sale_domestic3}}</th>
                                                                <th>{{$total_module_sale3+$module_sale_domestic3}}</th>
                                                                <th>{{$total_module_sale_amount3}}</th>
                                                                <th>{{$epc_other_amount3}}</th>
                                                                <th>{{$total_module_sale_amount2+$epc_other_amount3}}
                                                                </th>
                                                                <th>--</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>



                                        @endif

                                    </div>
                                </div>
                            </div>
                            <form action="{{ URL::to('/users/annexure-five-attachment')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax1">
                                @csrf
                                @method('POST')
                                <hr>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Upload Balance Sheet <span class="text-danger">*</span> <br> <small
                                                class="text-primary">(Max.
                                                10MB and PDF Format
                                                Only)</small>


                                        </td>
                                        <td>
                                            @if($attc_balance_sheet_last_years->attc_balance_sheet_last_years!='')
                                            <span>
                                                <strong><a target="_blank"
                                                        href="{{URL::to($attcBaseUrl.$attc_balance_sheet_last_years->attc_balance_sheet_last_years)}}"
                                                        class="document1 text-danger"
                                                        style="float:right; font-size:12px !important">View
                                                        Balance Sheet</a></strong>
                                            </span>
                                            @endif
                                            <input type="file" name="attc_balance_sheet_last_years"
                                                id="attc_balance_sheet_last_years" class="from-control pdf_file_10mb"
                                                style="width: 26%;margin-right: 10px;" onchange="showdataupload()"/>
                                            <input type="submit" name="submit" value="upload"
                                                class="btn btn-success  btn-sm" style="display: none;" />
                                            <br>
                                            <small class="text-primary">(Balance Sheet for last three years or the
                                                period of existence of such units, whichever is less)</small>



                                            <br>
                                            @error('attc_balance_sheet_last_years') <span class="text-danger">
                                                {{ $message }} </span> @enderror
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                        </td>

                                    </tr>
                                </table>
                            </form>


                            <br>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-four-five/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    @if($check>0 && $attc_balance_sheet_last_years->attc_balance_sheet_last_years!='' && !empty($appData['datatype1']) && !empty($appData['datatype2']) && !empty($appData['datatype3']))
                                    <a href="{{URL::to('users/annexure-seven/'.$general->encodeid($application_id))}}"
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

    li.nav-item {
        margin-bottom: 5px !important;
    }
    </style>

    @endsection
    @push('backend-js')
    <script>
    $('#financial_year').change(function() {
        var dt = $('#datatype').val();

        $('#moduledata').addClass('hidden');
        $('#rawdata').addClass('hidden');
        $('#productiondata').addClass('hidden');
        if (dt == 1) {
            $('#moduledata').removeClass('hidden');
        } else if (dt == 2) {
            $('#rawdata').removeClass('hidden');
        } else if (dt == 3) {
            $('#productiondata').removeClass('hidden');
        }
    });
    $('#datatype').change(function() {
        var dt = this.value;
        //alert(dt);
        $('#financial_year').show();
        $('#moduledata').addClass('hidden');
        $('#rawdata').addClass('hidden');
        $('#productiondata').addClass('hidden');
        if (dt == 3) {
            $('#financial_year').val('');
            $('#financial_year').hide();
            $('#productiondata').removeClass('hidden');
        }

        //$('#financial_year').val('');
        //$('#financial_year').hide();


    });

    function showBox(id) {
        $('.productiondtext' + id).removeClass('hidden');
        $('.productiondspan' + id).addClass('hidden');
        $('#edit' + id).addClass('hidden');
        $('#cancel' + id).removeClass('hidden');
    }

    function hideBox(id) {
        $('.productiondtext' + id).addClass('hidden');
        $('.productiondspan' + id).removeClass('hidden');
        $('#edit' + id).removeClass('hidden');
        $('#cancel' + id).addClass('hidden');
    }

    function updateData(data) {
        var id = $(data).attr('data-id');
        var vl = $('#module_production_data' + id).val();
        $.ajax({
            type: "POST",
            url: baseUrl + '/users/api/updateAnnexure5Data',
            data: {
                datavalue: vl,
                dataid: id
            },
            success: function(data) {
                //alert(data.status)
            }
        });

        $('#productiondspan' + id).html(vl);
        //alert(vl);
    }
    </script>

<script>
    function showdataupload()
    {
        var fileInput = document.getElementById('cell_data_sheet');
        var uploadButton = document.getElementById('uploadButton');
        
        if (fileInput.files.length > 0) {
            uploadButton.style.display = 'inline-block'; 
        } else {
            uploadButton.style.display = 'none'; 
        }
    }

    
</script>



    @endpush