@extends('layouts.masters.backend')
@section('content')
@section('title', 'Application Fee Master')
@php $docBaseUrl ='nise/preview-docs/NISE/'; @endphp
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/add-application-fee')}}" class="btn btn-info float-end">
                    <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus-circle fa-w-20"></i></span> ADD Fees
                </a>
            </div>
            <div class="col-md-12">
                @include('layouts.partials.backend._flash')
                <table id="stakeHoldersTable1" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%">SNo.</th>
                            <th width="13%">Fees</th>
                            <th width="15%">Order Date</th>
                            <th width="20%">Order Letter</th>
                            <th width="10%">Status</th>
                            <th width="10%">Updated At</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feeList as $key => $fee)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$fee->fees}} INR</td>
                            <td>{{$fee->order_date}}</td>
                            <td><a href="{{URL::to($docBaseUrl.$fee->order_letter)}}" class="text-primary" target="_blank">View Letter</a></td>
                            <td>@if($fee->status==1) <strong class="text-success">Active</strong> @else Inactive @endif</td>
                            <td>{{$fee->updated_at}}</td>
                            <td><a href="{{URL::to('/'.Auth::getDefaultDriver().'/add-application-fee/'.base64_encode($fee->id))}}" class="">Edit</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection