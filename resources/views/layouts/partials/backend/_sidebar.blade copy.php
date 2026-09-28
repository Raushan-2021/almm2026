<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
       <li class="nav-item">
            @if(Auth::guard('users')->check() || Auth::guard('mnre')->check() || Auth::guard('nise')->check())
                <a class="nav-link" href="{{ url('/' . Auth::getDefaultDriver()) }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            @elseif(Auth::guard('MFFT')->check())
                <a class="nav-link" href="{{ url('/mfft') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            @elseif(Auth::guard('NIWE')->check())
                <a class="nav-link" href="{{ url('/niwe') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            @elseif(Auth::guard('MNREWIND')->check())
            <a class="nav-link" href="{{ url('/mnre_wind_users') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
            @endif
           
        </li>

        <!-- <li class="nav-heading">Pages</li> -->
        <!--MNRE USERS SECTION START--->
        @if (Auth::guard('mnre')->check())
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <!-- <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>NISE Users</span>
                    </a>
                </li> -->
                <!-- <li>
                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/mnre-user-list')}}">
                        <i class="bi bi-circle"></i><span>MNRE Users</span>
                    </a>
                </li> -->
                <li>
                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/manufacturer-user-list')}}">
                        <i class="bi bi-circle"></i><span>Manufacturer</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{URL::to('/'.Auth::getDefaultDriver().'/manufacturer-user-list')}}">
                <i class="bi bi-boxes"></i>
                <span>Manufacturers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{URL::to('/'.Auth::getDefaultDriver().'/applications-list')}}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Received Applications</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{URL::to('/'.Auth::getDefaultDriver().'/feedbacks')}}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Feedbacks</span>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-clipboard2-check"></i>
                <span>Inspections</span>
            </a>
        </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-clipboard2-check"></i>
                <span>Payment</span>
            </a>
        </li> -->
         <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-bar-graph-fill"></i><span>Reports</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                {{-- <li><a href="{{URL::to('/'.Auth::getDefaultDriver().'/applications-list')}}"><i class="bi bi-circle"></i><span>Applications</span></a></li>
                <li><a href="#"><i class="fa fa-user-plus"></i>Quality Check Manufacturer</a></li> --}}
                <li><a href="{{URL::to('mnre/reports')}}"><i class="bi bi-circle"></i>Generate Approved Lists</a></li>
                {{-- <li><a href="#"><i class="bi bi-circle"></i>Renewals</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Uploads</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Help Documents</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Annexures</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Fee details</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Approved lists I & II</a></li> --}}
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{URL::to('/'.Auth::getDefaultDriver().'/audit-trail')}}">
                <i class="bi bi-clipboard2-check"></i>
                <span>Audit Trails</span>
            </a>
        </li>
        @endif
        @if (Auth::guard('nise')->check())
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <!-- <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>NISE Users</span>
                    </a>
                </li> -->
                <li>
                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/manufacturer-user-list')}}"><i class="bi bi-circle"></i><span>Manufacturer Users</span></a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{URL::to('/'.Auth::getDefaultDriver().'/applications-list')}}">
                <i class="bi bi-boxes"></i>
                <span>Received Applications</span>
            </a>
        </li>
        <li class="nav-item">
            {{-- OLD HREF --}} {{-- href="{{URL::to('/'.Auth::getDefaultDriver().'/applications-list?stat=c2NoZWR1bGVk')}}" --}}
            <a class="nav-link collapsed" href="{{URL::to('/'.Auth::getDefaultDriver().'/applications-list?stat=' . base64_encode('scheduled'))}}">
                <i class="bi bi-boxes"></i>
                <span>Scheduled Inspections</span>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-file-earmark-text"></i>
                <span>Submitted Inspections</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#"><i class="bi bi-clipboard2-check"></i><span>Track Records</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#"><i class="bi bi-clipboard2-check"></i> <span>Payment</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-bar-graph-fill"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li><a href="#"><i class="bi bi-circle"></i><span>Application & Inspections</span></a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Quality Check Manufacturer</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Generate Approved Lists</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Renewals</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-bar-graph-fill"></i><span>Uploads</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li><a href="#"><i class="bi bi-circle"></i>Help Documents</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Annexures</a></li>
                <li><a href="{{URL::to('/'.Auth::getDefaultDriver().'/application-fee-master')}}"><i class="bi bi-circle"></i>Fee details</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Approved lists I & II</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Bank Details</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>About Programme</a></li>
            </ul>
        </li> -->
        @endif
        <!--NISE USERS SECTION END--->
        <!--MNRE USERS SECTION START--->
        @if (Auth::guard('users')->check())
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-bar-graph-fill"></i><span>Manage Applications</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li><a href="{{URL::to('/users/user-applications')}}"><i class="bi bi-distribute-vertical"></i>My Application(s)</a></li>
                <li><a href="{{URL::to('/users/new-application')}}"><i class="bi bi-circle"></i>Submit New Application</a></li>
                <!-- <li><a href="{{URL::to('/users/select-existing-application')}}"><i class="bi bi-circle"></i>PV
                        Model addition at the existing<br> manufacturing
                        facility</a>
                <li><a href="javascript:;" class="text-gray"><i class="bi bi-circle"></i>Application for new
                        manufacturing<br> facility</a></li>
                <li><a href="javascript:;" class="text-gray"><i class="bi bi-circle"></i>Renewal</a></li>
                <li><a href="javascript:;" class="text-gray"><i class="bi bi-circle"></i>Co–ALMM</a></li> -->
            </ul>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href=""> <i class="bi bi-boxes"></i> <span>Inspection </span> </a>
        </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href=""> <i class="bi bi-boxes"></i> <span>Renewals </span> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href=""> <i class="bi bi-boxes"></i> <span>Transactions </span> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href=""> <i class="bi bi-boxes"></i> <span>Reports </span> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href=""> <i class="bi bi-boxes"></i> <span>Track Record </span> </a>
        </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav-download" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-bar-graph-fill"></i><span>Downloads</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav-download" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li><a href=""><i class="bi bi-circle"></i>New Application</a></li>
                <li><a href=""><i class="bi bi-circle"></i>Approved list I & II</a> </li>
                <li><a href="javascript:;"><i class="bi bi-circle"></i>Fee Criteria</a></li>
            </ul>
        </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href=""> <i class="bi bi-boxes"></i> <span>Help Documents </span> </a>
        </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href=""> <i class="bi bi-boxes"></i> <span>Feedback </span> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href=""> <i class="bi bi-boxes"></i> <span>NISE Bank Details </span> </a>
        </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav-profile" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-bar-graph-fill"></i><span>My Profile</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav-profile" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li><a href="{{URL::to('/'.Auth::getDefaultDriver().'/edit-profile')}}"><i class="bi bi-circle"></i>
                        Personal Details</a></li>
                <li><a href="{{URL::to('/'.Auth::getDefaultDriver().'/change-password')}}"><i
                            class="bi bi-circle"></i>Change Password</a></li>
                <li><a onclick="myFunction()"><i class="bi bi-circle"></i>Logout</a> </li>
                <form method="POST" id="logoutForm" action="{{ route('logout') }}" check>
                    @csrf
                    <input type="hidden" name="usid" id="" value="{{ Auth::user()->id}}" />
                </form>
            </ul>
        </li> -->
        @endif
        <!--MNRE USERS SECTION END--->

        <!-- Rlmm wind sidebar for user -->
        @if (Auth::guard('MFFT')->check())
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#mfft-forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-bar-graph-fill"></i><span>Manage Applications</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="#mfft-forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li><a href="{{URL::to('/mfft/awuser-applications')}}"><i class="bi bi-distribute-vertical"></i>My Application(s)</a></li>
                <li><a href="{{URL::to('/mfft/awnew-application')}}"><i class="bi bi-circle"></i>Submit New Application</a></li>
                <!-- <li><a href="{{URL::to('/users/select-existing-application')}}"><i class="bi bi-circle"></i>PV
                        Model addition at the existing<br> manufacturing
                        facility</a>
                <li><a href="javascript:;" class="text-gray"><i class="bi bi-circle"></i>Application for new
                        manufacturing<br> facility</a></li>
                <li><a href="javascript:;" class="text-gray"><i class="bi bi-circle"></i>Renewal</a></li>
                <li><a href="javascript:;" class="text-gray"><i class="bi bi-circle"></i>Co–ALMM</a></li> -->
            </ul>
        </li>
        @endif

        @if (Auth::guard('NIWE')->check())
        
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#niwe-components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Niwe Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="niwe-components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>NIWE Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL::to('/niwe/manufacturer-user-list')}}"><i class="bi bi-circle"></i><span>Manufacturer Users</span></a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{URL::to('/niwe/applications-list/')}}">
                <i class="bi bi-boxes"></i>
                <span>Received Applications</span>
            </a>
        </li>
        @endif


        @if (Auth::guard('MNREWIND')->check())

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#mnrewind-components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Mnre Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="mnrewind-components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <a href="{{URL::to('/mnre_wind_users/create-mnre-user/')}}">
                        <i class="bi bi-circle"></i><span>Create Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL::to('/mnre_wind_users/mnre-user-list')}}">
                        <i class="bi bi-circle"></i><span>MNRE Users List</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{URL::to('/mnre_wind_users/manufacturer-user-list')}}">
                <i class="bi bi-boxes"></i>
                <span>Manufacturers List</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{URL::to('/mnre_wind_users/applications-list')}}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Received Applications</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{URL::to('/mnre_wind_users/feedbacks')}}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Feedbacks</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{URL::to('/'.Auth::getDefaultDriver().'/audit-trail')}}">
                <i class="bi bi-clipboard2-check"></i>
                <span>Audit Trails</span>
            </a>
        </li>
        @endif


    </ul>
    <a href="https://www.nic.in/" target="_blank"><img class="nicLogo" src="{{URL::asset('images/footerNIC.png')}}" width="100%"></a>
</aside>
<script>
    function myFunction() { document.getElementById("logoutForm").submit();}
</script>