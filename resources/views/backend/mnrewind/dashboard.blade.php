@extends('layouts.masters.backend')
@section('title', 'Dashboard')
@section('content')
    <style>
        .report_summary {
            cursor: pointer;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">


                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk1">
                        <a href="{{ URL::to('mnre_wind_users/manufacturer-user-list') }}">
                            <p class="icon"><i class="fa-solid fa-users"></i></p>
                            <p class="name">Registered Manufacturers</p>
                            <p class="num">{{ isset($data['users']) ? $data['users'] : '0' }}</p>
                            <!-- @print_r($data); -->

                        </a>
                    </div>
                </div>


                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk2">
                        <a href="{{ URL::to('mnre_wind_users/applications-list') }}">
                            <p class="icon"><i class="fa-solid fa-file-lines"></i> </p>
                            <p class="name">Application(s) Received at MNRE</p>
                            <p class="num">{{ $data['application_total'] }}</p>
                        </a>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk4">
                        <a href="{{ URL::to('mnre_wind_users/applications-list?stat=' . base64_encode('underReviewMNRE')) }}">
                            <p class="icon"><i class="fa-solid fa-clock"></i></p>
                            <p class="name">Application(s) under Review with MNRE</p>
                            <p class="num"> {{ $data['pending_mnre'] }}</p>
                        </a>
                    </div>
                </div>

                {{-- <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk3"
                        onclick="window.location.href='{{ url('/mnre_wind_users/application-forwarded-to-niwe') }}'">
                        <p class="icon"><i class="fa-solid fa-file-export"></i></p>
                        <p class="name">Application(s) forwarded to NIWE</p>
                        <p class="num">{{ $data['forwarded_niwe'] }}</p>
                    </div>


                </div> --}}


                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk4">
                        <a href="{{ URL::to('mnre_wind_users/applications-list?stat=' . base64_encode('pendingReviewNIWE')) }}">
                            <p class="icon"><i class="fa-solid fa-clock"></i></p>
                            <p class="name">Application(s) under Review at NIWE</p>
                            <p class="num"> {{ $data['application_in_niwe'] }}</p>
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


                <!-- <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                                                    <div class="col-xxl-12 report_summary blk6">
                                                        <p class="icon"><i class="fa-solid fa-file-signature"></i></p>
                                                        <p class="name">Pending verification NIWE</p>
                                                        <p class="num">{{ $data['pending_niwe_verification'] }}</p>
                                                    </div>


                                                </div> -->

                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk7">
                        <a href="{{ URL::to('mnre_wind_users/applications-list?stat=' . base64_encode('scheduledInspections')) }}">
                            <p class="icon"><i class="fa-solid fa-file-contract"></i></p>
                            <p class="name">Scheduled Inspections </p>
                            <p class="num">{{ $data['inspection_initiated'] }}</p>
                        </a>
                    </div>


                </div>
                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk8">
                        <a href="{{ URL::to('mnre_wind_users/applications-list?stat=' . base64_encode('approvedAtNIWE')) }}">
                            <p class="icon"><i class="fa-solid fa-check"></i></p>
                            <p class="name">Inspection completed</p>
                            <p class="num">{{ $data['inspection_completed'] }}</p>
                        </a>
                    </div>


                </div>
                {{-- <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                <div class="col-xxl-12 report_summary blk9">
                    <p class="icon"><i class="fa-solid fa-file-pen"></i></p>
                    <p class="name">Pending for inspection</p>
                    <p class="num">0</p>
                </div>


            </div> --}}
                {{-- <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                <div class="col-xxl-12 report_summary blk10">
                    <p class="icon"><i class="fa-solid fa-file-invoice"></i></p>
                    <p class="name">Inspection Reports Pending with NIWE</p>
                    <p class="num">0</p>
                </div> --}}


            </div>


        </div>
    </div>

    </div>
@endsection
