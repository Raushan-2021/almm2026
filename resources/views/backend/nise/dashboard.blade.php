@extends('layouts.masters.backend')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">


                <!-- <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                                    <div class="col-xxl-12 report_summary blk1">
                                        <p class="icon"><i class="fa-solid fa-users"></i></p>
                                        <p class="name">Total Application</p>
                                        <p class="num">{{ $data['application_total'] }}</p>
                                    </div>
                                </div> -->

                <!--<div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                                    <div class="col-xxl-12 report_summary blk2">
                                        <p class="icon"><i class="fa-solid fa-file-lines"></i> </p>
                                        <p class="name">Application in MNRE</p>
                                        <p class="num">0</p>
                                    </div>
                                </div>


                                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                                    <div class="col-xxl-12 report_summary blk3">
                                        <p class="icon"><i class="fa-solid fa-file-export"></i></p>
                                        <p class="name">Application forwarded to NISE</p>
                                        <p class="num">0</p>
                                    </div>


                                </div>-->
                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk4">
                        <a href="{{ URL::to('nise/applications-list?stat=' . base64_encode('pending')) }}">
                            <p class="icon"><i class="fa-solid fa-clock"></i></p>
                            <p class="name">Application(s) under Review at NISE</p>
                            <p class="num"> {{ $data['application_in_nise'] }}</p>
                        </a>
                    </div>
                </div>


                <!-- <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                                    <div class="col-xxl-12 report_summary blk5">
                                        <p class="icon"><i class="fa-solid fa-file-import"></i></p>
                                        <p class="name">Returned Correction</p>
                                        <p class="num">0</p>
                                    </div>
                                </div> -->


                {{-- <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                <div class="col-xxl-12 report_summary blk6">
                    <p class="icon"><i class="fa-solid fa-file-signature"></i></p>
                    <p class="name">Pending verification from NISE</p>
                    <p class="num">0</p>
                </div>
            </div> --}}
                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk7">
                        <a href="{{ URL::to('nise/applications-list?stat=' . base64_encode('scheduled')) }}">
                            <p class="icon"><i class="fa-solid fa-file-contract"></i></p>
                            <p class="name">Scheduled Inspections </p>
                            <p class="num">{{ $data['inspection_initiated'] }}</p>
                        </a>
                    </div>


                </div>
                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk8">
                        <a href="{{ URL::to('nise/applications-list?stat=' . base64_encode('approvedAtNISE')) }}">
                            <p class="icon"><i class="fa-solid fa-check"></i></p>
                            <p class="name">Inspection completed</p>
                            <p class="num">{{ $data['inspection_completed'] }}</p>
                        </a>
                    </div>
                </div>
                <!-- <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                                    <div class="col-xxl-12 report_summary blk9">
                                        <p class="icon"><i class="fa-solid fa-file-pen"></i></p>
                                        <p class="name">Report Pending for inspection</p>
                                        <p class="num">0</p>
                                    </div>


                                </div>
                                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                                    <div class="col-xxl-12 report_summary blk10">
                                        <p class="icon"><i class="fa-solid fa-file-invoice"></i></p>
                                        <p class="name">Report Pending NISE</p>
                                        <p class="num">0</p>
                                    </div>


                                </div> -->


            </div>
        </div>


    </div>
@endsection
