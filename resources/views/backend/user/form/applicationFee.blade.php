@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'ALMM :: Application / Inspection Fee')
@section('content')
@php $docBaseUrl ='users/preview-docs/Attachment/';
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
    <a class="nav-link " href="{{ URL::to('users/annexure-four-three/'  .$general->encodeid($applicationData->app_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
      <div>Manufacturing Facility<br>3.0 - 3.7</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link " href="{{ URL::to('users/module-master/' . $general->encodeid($applicationData->app_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Solar PV Modules<br> 4.0</div>
    </a>
</li>

<li class="nav-item ">
   <a class="nav-link " href="{{ URL::to('users/annexure-one/' . $general->encodeid($applicationData->app_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Mechanical Data<br>4.1 - 4.2</div>
    </a>
</li>

<li class="nav-item ">
    <a class="nav-link" href="{{ URL::to('users/annexure-one-b/' . $general->encodeid($applicationData->app_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Electrical Data <br>4.3</div>
    </a>
</li>

<li class="nav-item ">
    <a class="nav-link" href="{{ URL::to('users/annexure-one-c/' . $general->encodeid($applicationData->app_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Solar Cell & BoM<br>4.4- 4.5</div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-three/' . $general->encodeid($applicationData->app_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>BIS Registration<br>5.0 </div>
    </a>
</li>

<li class="nav-item ">
    <a class="nav-link active"  href="{{ URL::to('users/application-fees/' . $general->encodeid($applicationData->app_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Application Fee<br>6.0</div>
    </a>
</li>
    
<li class="nav-item">
    <a class="nav-link"  href="{{ URL::to('users/application-submission/' .$general->encodeid($applicationData->app_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Affidavit & Indemnity<br>7.0</div>
    </a>
</li>

</ul>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="row" style="padding:0 10px">
    @include('backend.user.form._stepper_application')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="comn_drop_shdow">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-body pt-4">

                            <table class="table table-bordered text-center">
                                <thead>
                                   
                                    <tr style="" class=" bg-primary">
                                        <td colspan="2" class="text-left">
                                        <div class="text-light" style="font-size: 18px;">6.0 Details of Payment of Application Fee </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="text-left">
                                            Payment Mode:
                                        </td>
                                        <td width="50%"   class="text-left text-primary">
                                            {{$applicationData->payment_mode ?? '----'}}</td>
                                    </tr>
                                    <tr>
                                        <td  class="text-left">
                                           Amount Paid :
                                        </td>
                                        <td  class="text-left text-primary">
                                            {{$applicationData->amt_paid ?? '----'}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td  class="text-left">
                                            Transaction Number :
                                        </td>
                                        <td  class="text-left text-primary">
                                            {{$applicationData->transaction_number ?? '----'}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td  class="text-left">
                                            Transaction Date:
                                        </td>
                                        <td  class="text-left text-primary">
                                            {{$applicationData->transaction_date ?? '----'}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td  class="text-left">
                                            Bank Name: {{$applicationData->is_sez ?? '----'}}
                                        </td>
                                        <td  class="text-left text-primary">
                                            {{$applicationData->bank_name ?? '----'}} </td>
                                    </tr>
                                    <tr>
                                        <td  class="text-left">Attach Proof of Payment : </td>
                                        <td  class="text-left text-primary">
                                            @if(($applicationData->transaction_receipt ?? '') !=null)
                                            <span><a target="_blank"
                                                    href="{{URL::to($docBaseUrl.$applicationData->transaction_receipt)}}"
                                                    class="document text-primary">View
                                                    Proof of Payment</a></span> @else ---- @endif
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                        </td>
                                        <td class="text-left">Whether Acknowledge of Payment attached</td>
                                        <td  class="text-left text-primary">
                                        {{$applicationData->whether_acknowledge ?? '----'}} </td>
                                    </tr> -->
                                    <tr>
                                        <td  class="text-left">
                                            <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">Add Payment Details</a>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>

                            <table class="table table-bordered text-center mt-4">
                                <thead>
                                    <tr style="" class=" bg-primary">
                                        <td colspan="2"  class="text-left">
                                            <div class="text-light" style="font-size: 18px;">6.1 Details of Payment of Inspection Fee </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%"  class="text-left">
                                            Payment Mode:
                                        </td>
                                        <td width="50%"  class="text-left text-primary">
                                            {{$applicationData->pymt_mode_insp ?? '----'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                        Amount Paid :
                                        </td>
                                        <td  class="text-left text-primary">
                                            {{$applicationData->insp_amt_paid ?? '----'}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td  class="text-left">
                                            Transaction Number :
                                        </td>
                                        <td  class="text-left text-primary">
                                            {{$applicationData->insp_transaction_no ?? '----'}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td  class="text-left">
                                            Transaction Date:
                                        </td>
                                        <td  class="text-left text-primary">
                                            {{$applicationData->insp_transaction_date ?? '----'}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td  class="text-left">
                                            Bank Name: {{$applicationData->is_sez ?? '----'}}
                                        </td>
                                        <td class="text-left text-primary">
                                            {{$applicationData->insp_bank_name ?? '----'}} </td>
                                    </tr>
                                    <tr>
                                        <?php //print_r($docBaseUrl); ?>
                                        <td  class="text-left">Attach Proof of Payment : </td>
                                        <td  class="text-left text-primary">
                                            @if(($applicationData->insp_transaction_receipt ?? '') !=null)
                                            <span><a target="_blank"
                                                    href="{{URL::to($docBaseUrl.$applicationData->transaction_receipt)}}"
                                                    class="document text-primary">View
                                                    Proof of Payment</a></span> @else ---- @endif
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                        </td>
                                        <td class="text-left">Whether Acknowledge of Payment attached</td>
                                        <td  class="text-left text-primary">
                                        {{$applicationData->insp_whether_acknowledge ?? '----'}} </td>
                                    </tr> -->
                                    <tr>
                                        <td  class="text-left">
                                            <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addPaymentModal">Add Payment Details</a>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>

                            <br>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{URL::to('users/annexure-three/'.$general->encodeid($applicationData->app_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                        Back </a>
                                    @if(($applicationData->insp_transaction_receipt ?? '') !=null)
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
                                                        <label for="">Amount Paid: <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="amt_paid"
                                                            placeholder="Enter Paid Amount"
                                                            id="amt_paid" class="form-control"
                                                            value="{{$applicationData->amt_paid ?? ''}}">
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

                                                    <!-- <div class="col-md-4">
                                                        <label for="whether_acknowledge">Whether Acknowledge of Payment attached: <span class="text-danger">*</span></label>
                                                    </div> -->
                                                    <!-- <div class="col-md-8">
                                                        <select name="whether_acknowledge" id="whether_acknowledge" class="form-control">
                                                            <option value="">Select</option>
                                                            @foreach(['Yes' => 'yes', 'No' => 'no'] as $display => $value)
                                                                <option value="{{ $value }}" 
                                                                    @if(isset($applicationData->whether_acknowledge) && $applicationData->whether_acknowledge === $value) 
                                                                        selected 
                                                                    @endif>
                                                                    {{ $display }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div> -->
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
                                </form>

                            <!-- Modal for Adding Payment Details -->
                            <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addPaymentModalLabel">Add Payment Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ URL::to('/users/inspection-fees')}}" method="POST" enctype="multipart/form-data" id="formFileAjax">
                                            <div class="modal-body">

                                                @csrf
                                                @method('POST')
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="" class="label">Payment Mode: <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select name="pymt_mode_insp" id="pymt_mode_insp" class="form-control">
                                                            <option value="Offline" @if(($applicationData->pymt_mode_insp ?? '')=='Offline') selected @endif>Offline</option>
                                                            <option value="Online" @if(($applicationData->pymt_mode_insp ?? '')=='Online') selected @endif>Online</option>
                                                        </select>
                                                    </div>
                                                    <div><br></div>

                                                    <!--  -->
                                                    <div class="col-md-4">
                                                        <label for="">Amount Paid: <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="insp_amt_paid" placeholder="Enter Paid Amount" id="insp_amt_paid" class="form-control" value="{{$applicationData->insp_amt_paid ?? ''}}">
                                                    </div>
                                                    <div><br></div>

                                                    <!--  -->
                                                    <div class="col-md-4">
                                                        <label for="">Transaction Number: <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="insp_transaction_no" placeholder="Enter Transaction Number" id="insp_transaction_no" class="form-control" value="{{$applicationData->insp_transaction_no ?? ''}}">
                                                    </div>
                                                    <div><br></div>
                                                
                                                    <!--  -->
                                                    <div class="col-md-4">
                                                        <label for="">Transaction Date: <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="date" name="insp_transaction_date" id="insp_transaction_date" class="form-control" value="{{$applicationData->insp_transaction_date ?? ''}}">
                                                    </div>
                                                    <div><br></div>
                                                    <!--  -->
                                                    <div class="col-md-4">
                                                        <label for="">Name of Bank: <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="insp_bank_name" placeholder="Enter Bank Name" id="insp_bank_name" class="form-control" value="{{$applicationData->insp_bank_name ?? ''}}">
                                                    </div>
                                                    <div><br></div>
                                                
                                                    <!--  -->
                                                    <div class="col-md-4">
                                                        <label for="">Upload Proof of Payment: <span class="text-danger">*</span> <br>
                                                            <small class="text-danger">(Please upload Receipt in PDF format and max. size allowed 2MB)</small>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="file" name="insp_transaction_receipt" id="insp_transaction_receipt" class="form-control pdf_file_2mb">
                                                    </div>

                                                    <!-- <div class="col-md-4">
                                                        <label for="insp_whether_acknowledge">Whether Acknowledge of Payment attached: <span class="text-danger">*</span></label>
                                                    </div> -->
                                                    <!-- <div class="col-md-8">
                                                        <select name="insp_whether_acknowledge" id="insp_whether_acknowledge" class="form-control">
                                                            <option value="">Select</option>
                                                            @foreach(['Yes' => 'yes', 'No' => 'no'] as $display => $value)
                                                                <option value="{{ $value }}" 
                                                                    @if(isset($applicationData->insp_whether_acknowledge) && $applicationData->insp_whether_acknowledge === $value) 
                                                                        selected 
                                                                    @endif>
                                                                    {{ $display }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <input type="hidden" name="eid" value="{{$applicationData->id}}">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" id="submit1" class="btn btn-primary">Save Payment Details</button>
                                            </div>
                                            <input type="hidden" name="application_id"
                                            value="{{$general->encodeid($applicationData->app_id)}}">
                                        </form>
                                    </div>
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