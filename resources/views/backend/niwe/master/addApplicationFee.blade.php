@extends('layouts.masters.backend')
@section('title', 'Add Application Fee')
@section('content')
@php $docBaseUrl ='nise/preview-docs/NISE/'; @endphp
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-header with-border">
                            <a class="btn btn-success btn-sm float-end" href="{{ URL::to('/'.Auth::getDefaultDriver().'/application-fee-master')}}"><i
                                    class="fa fa-arrow"></i> Back</a>
                        </div>

                        <div class="box-body">
                            <form action="{{ URL::to('/'.Auth::getDefaultDriver().'/add-application-fee')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Application Fee (INR)</label>
                                                    <input type="number" name="fees" placeholder="Enter Application Fee"
                                                        id="fees" class="form-control" value="{{ $feedata->fees ?? old('fees') }}">
                                                    @error('fees') <span class="invalid-feedback valid_class"
                                                        role="alert"> {{ $message }} </span> @enderror

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Order Date</label>
                                                    <input type="date" name="order_date"
                                                        id="order_date" class="form-control" value="{{ $feedata->order_date ?? old('order_date') }}">
                                                    @error('order_date') <span class="invalid-feedback valid_class"
                                                        role="alert"> {{ $message }} </span> @enderror
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="">Order Letter <span class="text-primary">(PDF file only and Max. size allowed 1 MB)</span></label>
                                                    <input type="file" name="order_letter" id="order_letter"
                                                        class="form-control" >
                                                    @error('order_letter') <span class="invalid-feedback valid_class"
                                                        role="alert"> {{ $message }} </span> @enderror
                                                    
                                                    @if(($feedata->order_letter ?? '')!=null)
                                                    <input type="hidden" name="old_order_letter" id="" value="{{$feedata->order_letter}}">
                                                    <a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$feedata->order_letter)}}"
                                                        class="document text-success">View Uploaded Letter</a>@endif
                                                        </div>
                                                <div class="col-md-6 ">
                                                    <label for="">Status </label><br>
                                                    <input type="radio" name="status" id="" value="1" @if(isset($feedata->status) && $feedata->status==1)checked @else checked @endif >Active
                                                    <input type="radio" name="status" id="" value="0" @if(isset($feedata->status) && $feedata->status==0)checked @endif> Inactive
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" name="submit" value="Save" class="btn btn-success" id="">
                                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $feedata->id ?? 0 }}">
                                            <a href="{{ URL::to('/'.Auth::getDefaultDriver().'/application-fee-master')}}" class="btn btn-danger"> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


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
    .valid_class {
        color: #d34f4f;
        font-size: 10px;
        font-weight: 600;
        margin-top: -16px;
        position: absolute;
    }

    </style>

    @endsection
