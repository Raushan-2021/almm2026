@extends('layouts.awmasters.backend')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4" style="float:right">
                    <div class="dropdown">
                        {{-- <button class="dropbtn">Change Financial Year <span id="selectedYear">: As on Date</span></button> --}}
                        <div class="dropdown-content" id="year_user_dashboard">
                            <a href="javascript:;" data-value="As on Date">As on Date</a>
                            @for ($i = $currentYear; $i >= 2018; $i--)
                                <a href="javascript:;" data-value="{{ $i }}-{{ $i + 1 }}">
                                    {{ $i }}-{{ $i + 1 }}</a>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <!-- <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk1">
                        <p class="icon"><i class="fa-solid fa-users"></i></p>
                        <p class="name">Total Application</p>
                        <p class="num" id="applications">{{ $data['applications'] }}</p>
                    </div>
                </div> -->
                
                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk2">
                        <a href="{{ URL::to('mfft/awuser-applications?stat=' . base64_encode('submitted')) }}">
                            <p class="icon"><i class="fa-solid fa-file-lines"></i> </p>
                            <p class="name">Total Submitted Application(s)</p>
                            <p class="num" id="application_submitted">{{ $data['application_submitted'] }}</p>
                            
                        </a>
                    </div>
                </div>
                
                {{-- <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk3">
                        <a href="{{ URL::to('mfft/awuser-applications?stat=' . base64_encode('pending')) }}">
                            <p class="icon"><i class="fa-solid fa-file-export"></i></p>
                            <p class="name">Applications forwarded to NIWE</p>
                            <p class="num" id="application_forwarded_niwe">{{ $data['application_forwarded_niwe'] }}</p>
                            
                        </a>
                    </div>
                </div> --}}

                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk8">
                        <a href="{{ URL::to('mfft/awuser-applications?stat=' . base64_encode('approvedAtNIWE')) }}">
                            <p class="icon"><i class="fa-solid fa-check"></i></p>
                            <p class="name">Approved Applications at NIWE</p>
                            <p class="num" id="inspection_completed">{{ $data['inspection_completed'] }}</p>
                        </a>
                    </div>
                </div>

                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk4">
                        <a href="{{ URL::to('mfft/awuser-applications?stat=' . base64_encode('underReviewMNRE')) }}">
                            <p class="icon"><i class="fa-solid fa-forward"></i></p>
                            <p class="name">Applications under review at MNRE</p>
                            <p class="num" id="application_pending_mnre"> {{ $data['application_pending_mnre'] }}</p>
                        </a>
                    </div>
                </div>

                <!-- <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk8">
                        <p class="icon"><i class="fa-solid fa-check"></i></p>
                        <p class="name">Inspection completed</p>
                        <p class="num" id="inspection_completed">{{ $data['inspection_completed'] }}</p>
                    </div>
                </div>
                 -->
                <!-- <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk5">
                        <p class="icon"><i class="fa-solid fa-file-import"></i></p>
                        <p class="name">Inspection Reports Pending with NISE</p>
                        <p class="num">0</p>
                    </div>
                </div> -->
                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk6">
                        <a href="{{ URL::to('mfft/awuser-applications?stat=' . base64_encode('pendingReviewNIWE')) }}">
                            <p class="icon"><i class="fa-solid fa-file-signature"></i></p>
                            <p class="name">Pending verification NIWE</p>
                            <p class="num" id="application_pending_niwe">{{ isset($data['application_pending_niwe']) ? $data['application_pending_niwe'] : '0' }}
                 </p>
                        </a>
                    </div>
                </div>

                <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
                    <div class="col-xxl-12 report_summary blk7">
                        <a href="{{ URL::to('mfft/awuser-applications?stat=' . base64_encode('scheduledInspections')) }}">
                            <p class="icon"><i class="fa-solid fa-file-contract"></i></p>
                            <p class="name">Scheduled Inspection(s)</p>
                            <p class="num" id="application_inspection_fixed">{{ $data['application_inspection_fixed'] }}
                            </p>
                        </a>
                    </div>
                </div>

                <!--
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
    <style>
        .dropbtn {
            background-color: #04AA6D;
            color: white;
            padding: 3px 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
@endsection
