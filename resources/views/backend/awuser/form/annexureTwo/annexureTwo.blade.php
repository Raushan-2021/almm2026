@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Bill of Material Details')
@section('content')
@php $docBaseUrl ='users/preview-docs/BOM/';
@endphp
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
    <a class="nav-link " href="{{ URL::to('users/module-master/'  .$general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div>Solar PV Modules <br> 3.0</div>
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link " href="{{ URL::to('users/annexure-one/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> Module <br> 3.1-3.3</div>
    </a>
    </li>

    <li class="nav-item">
        <a class="nav-link " href="{{ URL::to('users/annexure-one-b/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> Module <br>3.4-3.5</div>
    </a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-one-c/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> Module <br>3.6-3.10</div>
    </a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-three/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> 4.Bis Registration</div>
    </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ URL::to('users/annexure-four/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> 5.Collaboration </div>
    </a>
    </li>

    <li class="nav-item">
	<a class="nav-link" href="{{ URL::to('users/annexure-four-two/' . $general->encodeid($application_id)) }}">
		<p class="arrow-down">
			<p class="arrow-down-inner"></p>
		</p>
		<div> 6.Bis Registration </div>
	</a>
    </li>

    <li class="nav-item">
    <a class="nav-link active" href="{{ URL::to('users/annexure-four-three/' . $general->encodeid($application_id)) }}">
		<p class="arrow-down">
			<p class="arrow-down-inner"></p>
		</p>
		<div> 7.Manufacturing Facility </div>
	</a>
    </li>
	
    <li class="nav-item">
        <a class="nav-link"  href="{{ URL::to('users/application-fees/' . $general->encodeid($application_id)) }}">
            <p class="arrow-down">
                <p class="arrow-down-inner"></p>
            </p>
            <div>8-9. Fee</div>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link"  href="{{ URL::to('users/application-submission/' .$general->encodeid($application_id)) }}">
            <p class="arrow-down">
                <p class="arrow-down-inner"></p>
            </p>
            <div>10.Affidavit & Indemnity</div>
        </a>
    </li>
</ul>
</div>

<div class="row" style="padding:0 10px">
    @include('backend.user.form._stepper')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="comn_drop_shdow">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box-body">

                            <form action="{{ URL::to('/users/annexure-two')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>S.No</th>
                                            <th>Module Technology</th>
                                            <th>Mean Wattage and application Range of Wattage</th>
                                            <th width="10%">Pmax (Wp) of Main Model</th>
                                            <th width="10%">Applicable models covered under ± 5% of Mean Wattage</th>
                                            <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                            <th width="10%">BOM File</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $j=0;$check=0; @endphp
                                        @foreach($appData as $data)
                                        @php $j++;$k=0;@endphp
                                        <tr>
                                            <td>{{$j}}</td>
                                            <td> @if ($data->module_type == 17) 
                                                <?php $oth=json_decode($data->other_module_title) ; echo $oth[0]; ?>
                                            @else
                                                {{ $data->module_name }}
                                            @endif</td>
                                            <td>{{$data->main_model}}</td>
                                            <td class="text-center">{{$data->pmax_model}} Wp</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model_covered as
                                                    $applicable_model_covered)

                                                    <tr>
                                                        <td style="border-bottom:1px dashed #ccc;">
                                                            <input type="hidden" name="module_type[]"
                                                                value="{{$data->id ?? ''}}" id="">
                                                            {{ $applicable_model_covered }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach ($data->applicable_model as $applicable_model)

                                                    <tr>
                                                        <td style="border-
                                                        bottom:1px dashed #ccc;">
                                                            {{ $applicable_model }} Wp</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            @if($j==1)
                                            <td rowspan="{{$countSubModule}}" valign="middle">
                                                @foreach ($data->annexure as $bom_attachment)
                                                    @php $check=1;$k++; @endphp
                                                    @if($k==count($data->annexure))
                                                    <a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$bom_attachment->bom_attachment)}}"
                                                        class="document">View</a></small></a>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td rowspan="{{$countSubModule}}" valign="middle">

                                                <!-- <a
                                                href="{{URL::to('users/annexure-two/' .$general->encodeid($application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                <i class="bi bi-pencil-square"></i></a> -->
                                                <!-- Modal -->
                                                <!-- Button trigger modal -->
                                                <a href="javascrip:;" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                    <i class='bi bi-arrow-bar-up'></i> Upload BOM File
                                                </a>

                                                <!-- Modal -->
                                                <d
                                                iv class="modal fade" id="exampleModal" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Bill of
                                                                    Material for Main Model
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="">
                                                                    <tr>
                                                                        <th colspan="3" class="text-left">
                                                                            Bill of Material for Main Model <span
                                                                                class="text-danger">*</span>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3" class="text-left">
                                                                            <input type="file" name="bom_attachment"
                                                                                class="pdf_file_10mb mb-0"
                                                                                id="bom_attachment">
                                                                            <small class="text-primary">(Max. 10MB and
                                                                                PDF
                                                                                Format
                                                                                Only)</small>

                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">



                                                                <button type="submit" name="submit"
                                                                    class="btn btn-success" id="submit">
                                                                    <i class='bi bi-arrow-bar-up'></i>
                                                                    Upload</button>
                                                                <input type="hidden" name="edit_id" id="edit_id"
                                                                    value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                                                <input type="hidden" name="application_id"
                                                                    id="application_id"
                                                                    value="{{$general->encodeid($application_id)}}">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">Close</button>

                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            @endif

                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </form>
                            <br>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-one-c/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    @if($check>0)

                                    <a href="{{URL::to('users/annexure-three/'.$general->encodeid($application_id))}}"
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
    @endsection