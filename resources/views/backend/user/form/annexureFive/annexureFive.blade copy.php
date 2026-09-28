@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Annexure 5 ::Module Production, Sale and Purchase Data')
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
                            <form action="{{ URL::to('/users/annexure-five')}}" method="POST" id="formAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display: @if($annexuredata!=null)  @else none @endif">
                                    @if($annexuredata!=null)
                                    <input type="hidden" name="id" value="{{$annexuredata->id}}">
                                    @endif
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>PV Module Production Data in MW </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Month</label>
                                                    <select name="month" id="month" class="form-control">
                                                        <option value=''>--Select Month--</option>
                                                        <option value='January' @if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='January') selected @endif >January
                                                        </option>
                                                        <option value='February' @if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='February') selected @endif>February
                                                        </option>
                                                        <option value='March' @if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='March') selected @endif> March
                                                        </option>
                                                        <option value='April' @if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='April') selected @endif >April
                                                        </option>
                                                        <option value='May' @if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='May') selected @endif >May</option>
                                                        <option value='June' @if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='June') selected @endif >June</option>
                                                        <option value='July' @if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='July') selected @endif >July</option>
                                                        <option value='August' @if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='August') selected @endif >August
                                                        </option>
                                                        <option value='September' @if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='September') selected @endif
                                                            >September</option>
                                                        <option value='October' @if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='October') selected @endif >October
                                                        </option>
                                                        <option value='November' @if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='November') selected @endif >November
                                                        </option>
                                                        <option value='December' @if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='December') selected @endif >December
                                                        </option>

                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Financial Year</label>
                                                    <select name="financial_year" id="financial_year"
                                                        class="form-control">
                                                        <option value="">--Select Financial Year--</option>
                                                        @php
                                                        $startYear = date("Y")+2;
                                                        $prevYear = date("Y")+1;
                                                        for ($i = 0; $i < 3; $i++) { $startYear=$startYear - 1;
                                                            $prevYear=$prevYear - 1;
                                                            $financial_year=$prevYear."-".$startYear; @endphp <option
                                                            value="{{$prevYear}}-{{$startYear}}"
                                                            @if(isset($annexuredata->financial_year) &&
                                                            $annexuredata->financial_year==$financial_year) selected
                                                            @endif>{{$financial_year}}</option>
                                                            @php
                                                            }
                                                            @endphp
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Actual PV Module Production Data</label>
                                                    <input type="text" name="module_production_data"
                                                        placeholder="Actual PV Module Production Data"
                                                        id="module_production_data" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->module_production_data ?? '' }}">

                                                </div>

                                                <div class="col-md-12">
                                                    <p>PV Module Sales Data for last 3 financial year</p>
                                                    <br>
                                                </div>


                                                <div class="col-md-4">
                                                    <label for="">Total Module Sales (in MW)</label>
                                                    <input type="text" name="module_sale"
                                                        placeholder="Total Module Sales (in MW)" id="module_sale"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->module_sale ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Module Sales Amount (in Rs)</label>
                                                    <input type="text" name="module_sale_amount"
                                                        placeholder="Module Sales Amount (in Rs)"
                                                        id="module_sale_amount" class="form-control"
                                                        value="{{ $annexuredata->module_sale_amount ?? '' }}">
                                                </div>



                                                <div class="col-md-4">
                                                    <label for="">EPC and Other Sales Amount (in Rs)</label>
                                                    <input type="text" name="epc_other_amount"
                                                        placeholder="EPC and Other Sales Amount (in Rs)"
                                                        id="epc_other_amount" class="form-control"
                                                        value="{{ $annexuredata->epc_other_amount ?? '' }}">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Total Sales Amount (Rs)</label>
                                                    <input type="text" name="total_sales"
                                                        placeholder="Total Sales Amount (Rs)" id="total_sales"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->total_sales ?? '' }}">
                                                </div>



                                                <div class="col-md-12">
                                                    <p>Raw Material Purchase Data </p>
                                                    <br>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Raw Material Purchase for Module Amount (Rs)</label>
                                                    <input type="text" name="raw_purchase_module"
                                                        placeholder="Raw Material Purchase for Module Amount (Rs)"
                                                        id="raw_purchase_module" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->raw_purchase_module ?? '' }}">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Other Raw Material Purchase Amount (Rs)</label>
                                                    <input type="text" name="other_raw_purchase"
                                                        placeholder="Other Raw Material Purchase Amount (Rs)"
                                                        id="other_raw_purchase" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->other_raw_purchase ?? '' }}">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Total Purchase Amount (Rs)</label>
                                                    <input type="text" name="total_purchase"
                                                        placeholder="Total Purchase Amount (Rs)" id="total_purchase"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->total_purchase ?? '' }}">
                                                </div>

                                            </div>
                                        </th>
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

                                            <a href="{{URL::to('users/annexure-five/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="fa fa-times"></i> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>


                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingModule">
                                        <button class="accordion-button bg-success text-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOneModule"
                                            aria-expanded="true" aria-controls="collapseOneModule">
                                            <h4>PV Module Production Data in MW for last 3 financial year</h4>
                                        </button>
                                    </h2>
                                    <div id="collapseOneModule" class="accordion-collapse collapse show"
                                        aria-labelledby="headingModule" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
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
                                                        <th>Current Financial Year {{$current_financial_year}}</th>
                                                        <th>Last Financial Year {{$last_financial_year}}</th>
                                                        <th>Last to Last Financial Year {{$lasttolast_financial_year}}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $months = array(1 => 'April', 2 => 'May', 3 => 'June', 4 =>
                                                    'July', 5 =>
                                                    'August', 6 => 'September', 7 => 'October', 8 => 'November', 9 =>
                                                    'December', 10 =>
                                                    'January', 11 => 'February', 12 => 'March');
                                                    @endphp
                                                    @foreach($months as $num => $name)

                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$name}}</td>
                                                        <td>{{\App\Models\Annexure5::getFinancialData($application_id,$name,$current_financial_year)}}
                                                        </td>
                                                        <td>{{\App\Models\Annexure5::getFinancialData($application_id,$name,$last_financial_year)}}
                                                        </td>
                                                        <td>{{\App\Models\Annexure5::getFinancialData($application_id,$name,$lasttolast_financial_year)}}
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>

                                            <!-- Module 1 End-->
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button bg-success text-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <h4>PV Module Sales Data for last 3 financial year</h4>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse "
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <table class="table table-bordered">

                                                @php
                                                $startYear = date("Y")+1;
                                                $prevYear = date("Y");
                                                $current_financial_year = $prevYear."-".$startYear;
                                                @endphp

                                                <thead>
                                                    <tr>
                                                        <th colspan="7" class="bg-gray">
                                                            <h4>Current Financial Year ({{$prevYear}} - {{$startYear}})
                                                            </h4>
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-warning">
                                                        <th>S.No</th>
                                                        <th>Month</th>
                                                        <th>Total Module Sales (in MW)</th>
                                                        <th>Module Sales Amount (in Rs)</th>
                                                        <th>EPC and Other Sales Amount (in Rs)</th>
                                                        <th>Total Sales Amount (Rs)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $total_module_sale_mv_1=0;
                                                    $total_module_sale_amt_1=0;
                                                    $total_other_sale_amt_1=0;
                                                    $total_sale_amt_1=0;
                                                    @endphp
                                                    @foreach($appData as $data)
                                                    @php
                                                    $total_module_sale_mv_1+=$data->module_sale;
                                                    $total_module_sale_amt_1+=$data->module_sale_amount;
                                                    $total_other_sale_amt_1+=$data->epc_other_amount;
                                                    $total_sale_amt_1+=$data->total_sales;
                                                    @endphp
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->month}}</td>
                                                        <td>{{$data->module_sale}}</td>
                                                        <td>{{$data->module_sale_amount}}</td>
                                                        <td>{{$data->epc_other_amount}}</td>
                                                        <td>{{$data->total_sales}}</td>
                                                        <td>
                                                            <a
                                                                href="{{URL::to('users/annexure-five/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                                <i class="fa fa-edit"></i></a>
                                                            <a href="{{URL::to('users/delete-annexure/5/'.$general->encodeid($data->id))}}"
                                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                                class="text-danger">Delete <i
                                                                    class="fa fa-trash"></i></a>

                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr class="bg-gray">
                                                        <th>Total :</th>
                                                        <th>--</th>
                                                        <th>{{$total_module_sale_mv_1}} MV</th>
                                                        <th>{{$total_module_sale_amt_1}} INR</th>
                                                        <th>{{$total_other_sale_amt_1}} INR</th>
                                                        <th>{{$total_sale_amt_1}} INR</th>
                                                        <th>--</th>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <br><br>
                                            <table class="table table-bordered">
                                                @php
                                                $startYear = date("Y");
                                                $prevYear = date("Y")-1;
                                                $last_financial_year = $prevYear."-".$startYear;
                                                @endphp

                                                <thead>
                                                    <tr>
                                                        <th colspan="7" class="bg-gray">
                                                            <h4>Last Financial Year ({{$prevYear}} - {{$startYear}})
                                                            </h4>
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-warning">
                                                        <th>S.No</th>
                                                        <th>Month</th>
                                                        <th>Total Module Sales (in MW)</th>
                                                        <th>Module Sales Amount (in Rs)</th>
                                                        <th>EPC and Other Sales Amount (in Rs)</th>
                                                        <th>Total Sales Amount (Rs)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $total_module_sale_mv_2=0;
                                                    $total_module_sale_amt_2=0;
                                                    $total_other_sale_amt_2=0;
                                                    $total_sale_amt_2=0;
                                                    @endphp
                                                    @foreach($lfyappData as $data)
                                                    @php
                                                    $total_module_sale_mv_2+=$data->module_sale;
                                                    $total_module_sale_amt_2+=$data->module_sale_amount;
                                                    $total_other_sale_amt_2+=$data->epc_other_amount;
                                                    $total_sale_amt_2+=$data->total_sales;
                                                    @endphp
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->month}}</td>
                                                        <td>{{$data->module_sale}}</td>
                                                        <td>{{$data->module_sale_amount}}</td>
                                                        <td>{{$data->epc_other_amount}}</td>
                                                        <td>{{$data->total_sales}}</td>
                                                        <td>
                                                            <a
                                                                href="{{URL::to('users/annexure-five/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                                <i class="fa fa-edit"></i></a>
                                                            <a href="{{URL::to('users/delete-annexure/5/'.$general->encodeid($data->id))}}"
                                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                                class="text-danger">Delete <i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr class="bg-gray">
                                                        <th>Total :</th>
                                                        <th>--</th>
                                                        <th>{{$total_module_sale_mv_2}} MV</th>
                                                        <th>{{$total_module_sale_amt_2}} INR</th>
                                                        <th>{{$total_other_sale_amt_2}} INR</th>
                                                        <th>{{$total_sale_amt_2}} INR</th>
                                                        <th>--</th>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <br><br>
                                            <table class="table table-bordered">
                                                @php
                                                $startYear = date("Y")-1;
                                                $prevYear = date("Y")-2;
                                                $lasttolast_financial_year = $prevYear."-".$startYear;
                                                @endphp

                                                <thead>
                                                    <tr>
                                                        <th colspan="7" class="bg-gray">
                                                            <h4>Last To Last Financial Year ({{$prevYear}} -
                                                                {{$startYear}})
                                                            </h4>
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-warning">
                                                        <th>S.No</th>
                                                        <th>Month</th>
                                                        <th>Total Module Sales (in MW)</th>
                                                        <th>Module Sales Amount (in Rs)</th>
                                                        <th>EPC and Other Sales Amount (in Rs)</th>
                                                        <th>Total Sales Amount (Rs)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $total_module_sale_mv_3=0;
                                                    $total_module_sale_amt_3=0;
                                                    $total_other_sale_amt_3=0;
                                                    $total_sale_amt_3=0;
                                                    @endphp
                                                    @foreach($ltlfyappData as $data)
                                                    @php
                                                    $total_module_sale_mv_3+=$data->module_sale;
                                                    $total_module_sale_amt_3+=$data->module_sale_amount;
                                                    $total_other_sale_amt_3+=$data->epc_other_amount;
                                                    $total_sale_amt_3+=$data->total_sales;
                                                    @endphp
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->month}}</td>
                                                        <td>{{$data->module_sale}}</td>
                                                        <td>{{$data->module_sale_amount}}</td>
                                                        <td>{{$data->epc_other_amount}}</td>
                                                        <td>{{$data->total_sales}}</td>
                                                        <td>
                                                            <a
                                                                href="{{URL::to('users/annexure-five/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                                <i class="fa fa-edit"></i></a>
                                                            <a href="{{URL::to('users/delete-annexure/5/'.$general->encodeid($data->id))}}"
                                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                                class="text-danger">Delete <i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr class="bg-gray">
                                                        <th>Total :</th>
                                                        <th>--</th>
                                                        <th>{{$total_module_sale_mv_3}} MV</th>
                                                        <th>{{$total_module_sale_amt_3}} INR</th>
                                                        <th>{{$total_other_sale_amt_3}} INR</th>
                                                        <th>{{$total_sale_amt_3}} INR</th>
                                                        <th>--</th>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <!-- Annexure 1 End-->
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed bg-success text-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            <h4>Raw Material Purchase Data for last 3 financial year</h4>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <table class="table table-bordered">

                                                @php
                                                $startYear = date("Y")+1;
                                                $prevYear = date("Y");
                                                $current_financial_year = $prevYear."-".$startYear;
                                                @endphp

                                                <thead>
                                                    <tr>
                                                        <th colspan="6" class="bg-gray">
                                                            <h4>Current Financial Year ({{$prevYear}} - {{$startYear}})
                                                            </h4>
                                                        </th>
                                                    </tr>
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
                                                    @php
                                                    $total_raw_module_purchase_mv_1=0;
                                                    $total_other_purchase_amt_1=0;
                                                    $total_purchase_amt_1=0;
                                                    @endphp
                                                    @foreach($appData as $data)
                                                    @php
                                                    $total_raw_module_purchase_mv_1+=$data->raw_purchase_module;
                                                    $total_other_purchase_amt_1+=$data->other_raw_purchase;
                                                    $total_purchase_amt_1+=$data->total_purchase;
                                                    @endphp
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->month}}</td>
                                                        <td>{{$data->raw_purchase_module}}</td>
                                                        <td>{{$data->other_raw_purchase}}</td>
                                                        <td>{{$data->total_purchase}}</td>
                                                        <td>
                                                            <a
                                                                href="{{URL::to('users/annexure-five/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                                <i class="fa fa-edit"></i></a>
                                                            <a href="{{URL::to('users/delete-annexure/5/'.$general->encodeid($data->id))}}"
                                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                                class="text-danger">Delete <i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr class="bg-gray">
                                                        <th>Total :</th>
                                                        <th>--</th>
                                                        <th>{{$total_raw_module_purchase_mv_1}} MV</th>
                                                        <th>{{$total_other_purchase_amt_1}} INR</th>
                                                        <th>{{$total_purchase_amt_1}} INR</th>
                                                        <th>--</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br><br>
                                            <table class="table table-bordered">

                                                @php
                                                $startYear = date("Y");
                                                $prevYear = date("Y")-1;
                                                $last_financial_year = $prevYear."-".$startYear;
                                                @endphp

                                                <thead>
                                                    <tr>
                                                        <th colspan="6" class="bg-gray">
                                                            <h4>Last Financial Year ({{$prevYear}} - {{$startYear}})
                                                            </h4>
                                                        </th>
                                                    </tr>
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
                                                    @php
                                                    $total_raw_module_purchase_mv_2=0;
                                                    $total_other_purchase_amt_2=0;
                                                    $total_purchase_amt_2=0;
                                                    @endphp
                                                    @foreach($lfyappData as $data)
                                                    @php
                                                    $total_raw_module_purchase_mv_2+=$data->raw_purchase_module;
                                                    $total_other_purchase_amt_2+=$data->other_raw_purchase;
                                                    $total_purchase_amt_2+=$data->total_purchase;
                                                    @endphp
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->month}}</td>
                                                        <td>{{$data->raw_purchase_module}}</td>
                                                        <td>{{$data->other_raw_purchase}}</td>
                                                        <td>{{$data->total_purchase}}</td>
                                                        <td>
                                                            <a
                                                                href="{{URL::to('users/annexure-five/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                                <i class="fa fa-edit"></i></a>
                                                            <a href="{{URL::to('users/delete-annexure/5/'.$general->encodeid($data->id))}}"
                                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                                class="text-danger">Delete <i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr class="bg-gray">
                                                        <th>Total :</th>
                                                        <th>--</th>
                                                        <th>{{$total_raw_module_purchase_mv_2}} MV</th>
                                                        <th>{{$total_other_purchase_amt_2}} INR</th>
                                                        <th>{{$total_purchase_amt_2}} INR</th>
                                                        <th>--</th>
                                                    </tr>
                                                </tbody>
                                            </table>


                                            <br><br>
                                            <table class="table table-bordered">

                                                @php
                                                $startYear = date("Y")-1;
                                                $prevYear = date("Y")-2;
                                                $lasttolast_financial_year = $prevYear."-".$startYear;
                                                @endphp

                                                <thead>
                                                    <tr>
                                                        <th colspan="6" class="bg-gray">
                                                            <h4>Last To Last Financial Year ({{$prevYear}} -
                                                                {{$startYear}})
                                                            </h4>
                                                        </th>
                                                    </tr>
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
                                                    @php
                                                    $check=0;
                                                    $total_raw_module_purchase_mv_3=0;
                                                    $total_other_purchase_amt_3=0;
                                                    $total_purchase_amt_3=0;
                                                    @endphp
                                                    @foreach($ltlfyappData as $data)
                                                    @php
                                                    $check=1;
                                                    $total_raw_module_purchase_mv_3+=$data->raw_purchase_module;
                                                    $total_other_purchase_amt_3+=$data->other_raw_purchase;
                                                    $total_purchase_amt_3+=$data->total_purchase;
                                                    @endphp
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->month}}</td>
                                                        <td>{{$data->raw_purchase_module}}</td>
                                                        <td>{{$data->other_raw_purchase}}</td>
                                                        <td>{{$data->total_purchase}}</td>
                                                        <td>
                                                            <a
                                                                href="{{URL::to('users/annexure-five/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id))}}">Edit
                                                                <i class="fa fa-edit"></i></a>
                                                            <a href="{{URL::to('users/delete-annexure/5/'.$general->encodeid($data->id))}}"
                                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                                class="text-danger">Delete <i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr class="bg-gray">
                                                        <th>Total :</th>
                                                        <th>--</th>
                                                        <th>{{$total_raw_module_purchase_mv_3}} MV</th>
                                                        <th>{{$total_other_purchase_amt_3}} INR</th>
                                                        <th>{{$total_purchase_amt_3}} INR</th>
                                                        <th>--</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="13">
                                        @if($check>0)

                                        <a href="{{URL::to('users/annexure-seven/'.$general->encodeid($application_id))}}"
                                            class="btn btn-warning" style="float:right">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        @endif
                                        <a href="{{URL::to('users/annexure-four-five/'.$general->encodeid($application_id))}}"
                                            class="btn btn-danger" style="float:right"><i class="fa fa-arrow-left"></i>
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
                '</td><td><select name="option_type[]" id="option_type' +
                counter +
                '" class="form-control"> <option value="0">Main</option> <option value="1">Alternate 1</option> <option value="2">Alternate 2</option>  </select></td><td><input type="text" name="make_details[]" placeholder="Enter Make Details" id="make_details' +
                counter +
                '" class="form-control" maxlength="70" value=""></td><td><input type="text" name="model_details[]" id="model_details_' +
                counter +
                '" placeholder=" Enter Making Details"  class="form-control" ></td><td><input  type="text" name="specifications[]" id="specifications_' +
                counter +
                '" placeholder="Enter specifiaction Details" value="" class="form-control" ></td><td><input  type="text" name="country_origin[]" id="country_origin_' +
                counter +
                '" placeholder="Enter Country of Origin" value="" class="form-control" ></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-3");
            tableBody.append(markup);
        });

    });
    </script>
    @endpush