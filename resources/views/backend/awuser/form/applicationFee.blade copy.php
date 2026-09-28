@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'ALMM :: Application / Inspection Fee')
@section('content')
@php $docBaseUrl ='users/preview-docs/Attachment/';
@endphp
<div class="row">
    @include('backend.user.form._stepper_application')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-body">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="11" class="text-left bg-primary">
                                            <h3 class="text-light">Application / Inspection Fee</h3>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Sr.No</th>
                                        <th width="25%">Type Of Modules</th>
                                        <th width="15%">Main Model</th>
                                        <th width="15%">Applicable models covered under +- 5%, Pmax of Main Model</th>
                                        <th width="10%">No. of Cells</th>
                                        <th>System Voltage (VDC)</th>
                                        <th width="10%">Application Rate of Modules per MW <br>(in Rs)</th>

                                        <th width="10%">Total Installed Manufacturing Capacity in MW/Year</th>
                                        <th width="10%">Amount (in Rs)</th>
                                        <th>Remarks</th>
                                    </tr>
                                    @php $total=0;$inspectionFee=0;$fees=0;$gst=0; @endphp
                                    @foreach($appData as $data)
                                    @php $total+=$data->applicationfees;
                                    $inspectionFee=$data->inspectionfees;
                                    $fees = $data->fees;
                                    if($data->isSaarc==1){
                                    $gst=$data->gst;
                                    }
                                    @endphp

                                    <tr>
                                        <th rowspan="">{{ $loop->iteration }}</th>
                                        <td>{{$data->module_name}}</td>
                                        <td>{{$data->main_model}}</td>
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
                                                @foreach($data->annexure as $ann_data)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $ann_data->no_of_cells }}</td>
                                                </tr>
                                                @endforeach

                                            </table>
                                        </td>
                                        <td class="text-center">
                                            <table width="100%">
                                                @foreach($data->annexure as $ann_data2)
                                                <tr>
                                                    <td style="border-bottom:1px dashed #ccc;">
                                                        {{ $ann_data2->system_voltage }}</td>
                                                </tr>
                                                @endforeach

                                            </table>
                                        </td>
                                        <td class="text-center"> {{$data->fees}} </td>
                                        <td>{{$applicationData->manufacturing_capacity}}</td>
                                        <td>{{$data->applicationfees}}</td>
                                        <td>@if($loop->iteration>1) Subsequent Models at 1% @else 1st Model at 100%
                                            @endif</td>
                                    </tr>
                                    @endforeach
                                    <!-- GST Calculation -->

                                    @php

                                    $totalGST = ($total*($gst/100));
                                    $totalWithGST = $total+$totalGST;
                                    $totalInspectionGST = ($inspectionFee*($gst/100));
                                    $totalInspectionWithGST = $inspectionFee+$totalInspectionGST;
                                    $finalAmount = number_format(($totalWithGST+$totalInspectionWithGST),2);
                                    $payment_id = $fees.'||'.$finalAmount.'||'.$inspectionFee.'||'.$gst;
                                    @endphp
                                    <tr style="border-top:2px solid #000" class=" bg-primary">
                                        <td colspan="7" class="text-left">
                                            <h3 class="text-light">Payment Details</h3>
                                        </td>
                                        <th class="text-left text-light  bg-primary">Application Fees</th>
                                        <th class="table-primary text-light  bg-primary">{{number_format($total, 2)}}
                                        </th>
                                        <td class="table-primary  bg-primary"></td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            Payment Mode:
                                        </td>
                                        <td colspan="5" class="text-left text-primary">
                                            {{$applicationData->payment_mode ?? '----'}}</td>
                                        <th class="text-left table-primary">GST @18% on Application fee @if($gst==0)
                                            <br><i class="text-primary">GST Exempted due to Lactio of plant in SEZ</i>
                                            @endif
                                        </th>
                                        <th class="table-primary">{{number_format($totalGST, 2)}}</th>
                                        <td class="table-primary">@if($gst!=0) GST @ 18% @endif</td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            Transaction Number :
                                        </td>
                                        <td colspan="5" class="text-left text-primary">
                                            {{$applicationData->transaction_number ?? '----'}}</td>
                                        <th class="text-left table-primary">Application fee Total</th>
                                        <th class="table-primary">{{number_format($totalWithGST, 2)}}</th>
                                        <td class="table-primary"></td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            Transaction Date:
                                        </td>
                                        <td colspan="5" class="text-left text-primary">
                                            {{$applicationData->transaction_date ?? '----'}}</td>
                                        <th class="text-left table-primary">Inspection fee </th>
                                        <th class="table-primary">{{number_format($inspectionFee,2)}}</th>
                                        <td class="table-primary"></td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            Bank Name: {{$applicationData->is_sez ?? '----'}}
                                        </td>
                                        <td colspan="5" class="text-left text-primary">
                                            {{$applicationData->bank_name ?? '----'}} </td>
                                        <th class="text-left table-primary">GST @18% on Inspection fee @if($gst==0)
                                            <br><i class="text-primary">GST Exempted due to Lactio of plant in SEZ</i>
                                            @endif
                                        </th>
                                        <th class="table-primary">{{number_format($totalInspectionGST,2)}}</th>
                                        <td class="table-primary"> @if($gst!=0) GST @ 18% @endif</td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">Attach Proof of Payment : </td>
                                        <td colspan="5" class="text-left text-primary">
                                            @if(($applicationData->transaction_receipt ?? '') !=null)
                                            <span><a target="_blank"
                                                    href="{{URL::to($docBaseUrl.$applicationData->transaction_receipt)}}"
                                                    class="document text-primary">View
                                                    Proof of Payment</a></span> @else ---- @endif
                                        </td>
                                        <th class="text-left table-primary">Inspection fee Total </th>
                                        <th class="table-primary">{{number_format($totalInspectionWithGST,2)}}</th>
                                        <td class="table-primary"></td>

                                    </tr>
                                    <tr>
                                        <td colspan="7" class="text-left">

                                        </td>
                                        <th class="text-left table-success">Total Amount</th>
                                        <th class="table-success">{{$finalAmount}}</th>
                                        <td class="table-success"></td>

                                    </tr>
                                    <!-- <tr>
                                        <td colspan="7"></td>
                                        <th class="text-left table-success">Total Balance</th>
                                        <th class="table-success">{{$finalAmount}}</th>
                                        <td class="table-success"></td>
                                    </tr> -->
                                    <tr>
                                        <td colspan="10" class="text-left">
                                            <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">Add Payment Details</a>

                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                            <br>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-eight/'.$general->encodeid($applicationData->app_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    @if(($applicationData->transaction_receipt ?? '') !=null)
                                    <a href="{{ URL::to('users/application-submission/'.$general->encodeid($applicationData->app_id))}}"
                                        class="btn btn-warning">Next <i class='bi bi-arrow-bar-right'></i></a>
                                    @endif



                                </div>
                            </div>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Transaction Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ URL::to('/users/application-fees')}}" method="POST"
                                            enctype="multipart/form-data" id="formFileAjax">
                                            <div class="modal-body">

                                                @csrf
                                                @method('POST')
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="" class="label">Payment Mode: <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select name="payment_mode" id="payment_mode">
                                                            <option value="Offline" @if(($applicationData->payment_mode
                                                                ?? '')=='Offline') selected @endif>Offline</option>
                                                            <option value="Online" @if(($applicationData->payment_mode
                                                                ?? '')=='Online') selected @endif>Online</option>
                                                        </select>
                                                    </div>
                                                    <div><br></div>
                                                    <!--  -->
                                                    <div class="col-md-4">
                                                        <label for="">Transaction Number: <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="transaction_number"
                                                            placeholder="Enter Transaction Number"
                                                            id="transaction_number" class="form-control"
                                                            value="{{$applicationData->transaction_number ?? ''}}">
                                                    </div>
                                                    <div><br></div>
                                                    <!--  -->
                                                    <div class="col-md-4">
                                                        <label for="">Transaction Date: <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="date" name="transaction_date" id="transaction_date"
                                                            class="form-control"
                                                            value="{{$applicationData->transaction_date ?? ''}}">
                                                    </div>
                                                    <div><br></div>
                                                    <!--  -->
                                                    <div class="col-md-4">
                                                        <label for="">Name of Bank: <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="bank_name"
                                                            placeholder="Enter Bank Name" id="bank_name"
                                                            class="form-control"
                                                            value="{{$applicationData->bank_name ?? ''}}">
                                                    </div>
                                                    <div><br></div>
                                                    <!--  -->
                                                    <div class="col-md-4">
                                                        <label for="">Upload Proof of Payment: <span
                                                                class="text-danger">*</span> <br>
                                                            <small class="text-danger">(Please upload Receipt in PDF
                                                                format and max. size allowed 2MB)</small>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="file" name="transaction_receipt"
                                                            id="transaction_receipt" class="form-control pdf_file_2mb">

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" id="submit"
                                                    class="btn btn-primary">Save Payment Details</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="application_id"
                                value="{{$general->encodeid($applicationData->app_id)}}">
                            <input type="hidden" name="payment_id" value="{{base64_encode($payment_id)}}">

                            </form>

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

    .valid_class {
        color: #e73434;
        font-weight: 100;
        font-family: arial;
        font-size: 11px;
        /* margin-top: -14px; */
        /* position: absolute; */
        display: block;
    }
    </style>
    @endsection