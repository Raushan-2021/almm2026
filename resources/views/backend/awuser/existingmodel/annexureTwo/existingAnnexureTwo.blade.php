@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Annexure 2 ::Bill of Material Details')
@section('content')
@php $docBaseUrl ='users/preview-docs/BOM/';
@endphp
<div class="row">
    @include('backend.user.form._stepper')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box-body">
                            <form action="{{ URL::to('/users/existing-annexure-two')}}" method="POST"
                                enctype="multipart/form-data" id="formAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if((!empty($annexuredata) ?? '')==3) @else none @endif">
                                    <tr>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="20%">Type of Model</th>
                                                    <td class="text-primary">{{$annexuredata->module_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="15%">Main Model</th>
                                                    <td class="text-primary">{{$annexuredata->main_model ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pmax (Wp) of Main Model</th>
                                                    <td colspan="3" class="text-primary">
                                                        {{$annexuredata->pmax_model ?? ''}} Wp</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class=" table table-bordered module_type text-center"
                                                id="module_type3">
                                                <tr>
                                                    <th width="5%">S.No</th>
                                                    <th width="10%">Applicable models covered under ± 5% of Mean
                                                        Wattage</th>
                                                    <th width="10%">Pmax (Wp) of Applicable Models Model</th>
                                                    <th width="15%"></th>

                                                </tr>
                                                <tbody id="add-data-3">
                                                    @if(!Empty($annexuredata))
                                                    @foreach($annexuredata->applicable_model_covered as $value)

                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$annexuredata->applicable_model_covered[$loop->iteration-1] ?? ''}}
                                                        </td>
                                                        <td>{{$annexuredata->applicable_model[$loop->iteration-1] ?? ''}}
                                                            Wp</td>

                                                        <td><input type="file" name="bom_attachment[]"
                                                                id="bom_attachment" required>
                                                            <i name="bom_attachment.{{$loop->iteration-1}}"></i>
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tr>

                                                    <td colspan="4">
                                                        <a href="{{URL::asset('public/downloadables/BillOfMaterial_BOM.xlsx')}}"
                                                            class="text-primary" style="float:right !important"
                                                            download> <i class="bi bi-file-pdf"></i> Download Sample
                                                            Document</a>
                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="submit" name="submit" class="btn btn-success" id="submit">
                                                <i class='fa fa-check'></i> @if(isset($annexuredata->id) &&
                                                $annexuredata->id !='')Update @else Save @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <a href="{{URL::to('users/existing-annexure-two/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="fa fa-times"></i> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Main Model</th>
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
                                    @php $j++; @endphp
                                    <tr class="@if($data->filter ==1) table-success @endif">
                                        <td>{{$j}}</td>
                                        <td>{{$data->module_name}}</td>
                                        <td>{{$data->main_model}}</td>
                                        <td class="text-center">{{$data->pmax_model}} Wp</td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($data->applicable_model_covered as $applicable_model_covered)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model_covered }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach ($data->applicable_model as $applicable_model)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $applicable_model }} Wp</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach ($data->annexure as $bom_attachment)
                                                @php $check=1; @endphp
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        <a target="_blank"
                                                            href="{{URL::to($docBaseUrl.$bom_attachment->bom_attachment)}}"
                                                            class="document">View</a></small></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            @if($data->filter==2)<a
                                                href="{{URL::to('users/existing-annexure-two/' .$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                <i class="fa fa-edit"></i></a>@endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tr>
                                    <th colspan="13">
                                        @if($check>0)

                                        <a href="{{URL::to('users/existing-annexure-three/'.$general->encodeid($application_id))}}"
                                            class="btn btn-warning" style="float:right;">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        @endif
                                        <a href="{{URL::to('users/existing-annexure-one-c/'.$general->encodeid($application_id))}}"
                                            class="btn btn-danger" style="float:right;"><i class="fa fa-arrow-left"></i>
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
    @endsection