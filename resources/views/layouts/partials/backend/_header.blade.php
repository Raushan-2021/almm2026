<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ URL::to('/' . Auth::getDefaultDriver()) }}" class="logo d-flex align-items-center">
            @if(Auth::guard('users')->check() || Auth::guard('mnre')->check() || Auth::guard('nise')->check())
                <img src="{{ URL::asset('frontend/images/ALMM_logo.png') }}" style="height: 50px;" alt="ALMM logo">
            @elseif(Auth::guard('MFFT')->check() || Auth::guard('NIWE')->check() || Auth::guard('MNREWIND')->check())
                <img src="{{ URL::asset('frontend/images/RLMM_logo.png') }}" style="height: 50px;" alt="RLMM logo">
            @endif
            <span class="d-none d-lg-block"></span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <table class="mob_stng" style="margin-left: 15px;">
        <tbody>
            <tr>
                                <!-- <td class="gov-india"><span class="responsive_go_hindi" lang="hi"><a target="_blank"
                                            href="javascript:void(0)" role="link">भारत सरकार</a></span><br><span
                                        class="li_eng responsive_go_eng"><a target="_blank" href="javascript:void(0)"
                                            role="link">Government of India</a></span></td>
                                <td class="ministry"><a href="javascript:void(0)" onclick="menu('https://mnre.gov.in/');"
                                        target="_blank" referrerpolicy="no-referrer" alt="Ministry of New And Renewable Energy"
                                        title="Ministry of New And Renewable Energy"><span class="responsive_minis_hi"
                                            lang="hi">नवीन और नवीकरणीय ऊर्जा मंत्रालय</span></a>
                                    <br><a href="javascript:void(0)" onclick="menu('https://mnre.gov.in/');" target="_blank"
                                        referrerpolicy="no-referrer" alt="Ministry of New And Renewable Energy"
                                        title="Ministry of New And Renewable Energy"><span
                                            class="li_eng responsive_minis_eng">Ministry of New And Renewable
                                            Energy</span></a>
                                </td> -->
                                <td><img src="{{ URL::asset('frontend/images/mnre_logo.png') }}"
                                style="height: 50px; margin-bottom: 15px;"></td>
                </tr>
            </tbody>
    </table>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">


            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell" style="font-size:21px;"></i>
                    <span class="badge bg-primary badge-number" id="notificationCount"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile1">
                    <span id="notificationData"></span>


                </ul>
            </li>


            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <!--  <img src="images/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
                    <span class="d-none d-md-block dropdown-toggle ps-2"><small
                            class="welcomeUser">Welcome</small>{{ Auth::user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                        <!-- <span>Web Designer</span> -->
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                
                    @php
                        if(Auth::guard('users')->check()) {
                            $editProfileUrl = URL::to('/users/edit-profile');
                        } elseif(Auth::guard('nise')->check()) {
                            $editProfileUrl = URL::to('/nise/edit-profile');
                        } elseif(Auth::guard('mnre')->check()) {
                            $editProfileUrl = URL::to('/mnre/edit-profile');
                        } elseif(Auth::guard('MNREWIND')->check()) {
                            $editProfileUrl = URL::to('/mnre_wind_users/edit-profile');
                        } elseif(Auth::guard('MFFT')->check()) {
                            $editProfileUrl = URL::to('/mfft/edit-profile');
                        } elseif(Auth::guard('NIWE')->check()) {
                            $editProfileUrl = URL::to('/niwe/edit-profile');
                        } else {
                            $editProfileUrl = '#'; // fallback
                        }
                    @endphp

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ $editProfileUrl }}">
                            <i class="bi bi-person"></i>
                            <span>Edit Profile</span>
                        </a>
                    </li>

                    <!-- <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ URL::to('/' .Auth::getDefaultDriver(). '/edit-profile') }}">
                            <i class="bi bi-person"></i>
                            <span>Edit Profile</span>
                        </a>
                    </li> -->



                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    @php
                        if(Auth::guard('users')->check()) {
                            $changePasswordUrl = URL::to('/users/change-password');
                        } elseif(Auth::guard('nise')->check()) {
                        $changePasswordUrl = URL::to('/nise/change-password');
                        } elseif(Auth::guard('mnre')->check()) {
                            $changePasswordUrl = URL::to('/mnre/change-password');
                        } elseif(Auth::guard('MNREWIND')->check()) {
                            $changePasswordUrl = URL::to('/mnre_wind_users/change-password');
                        } elseif(Auth::guard('MFFT')->check()) {
                            $changePasswordUrl = URL::to('/mfft/change-password');
                        } elseif(Auth::guard('NIWE')->check()) {
                            $changePasswordUrl = URL::to('/niwe/change-password');
                        } else {
                            $changePasswordUrl = '#'; // fallback
                        }
                    @endphp

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ $changePasswordUrl }}">
                            <i class="bi bi-gear"></i>
                            <span>Change Password</span>
                        </a>
                    </li>

                    <!-- <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{URL::to('/'.Auth::getDefaultDriver().'/change-password')}}">
                            <i class="bi bi-gear"></i>
                            <span>Change Password</span>
                        </a>
                    </li> -->
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" onclick="myFunction()">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                        <form method="POST" id="logoutForm" action="{{ route('logout') }}">
                            @csrf
                            <input type="hidden" name="usid" value="{{ Auth::user()->id}}" />
                        </form>
                    </li>

                </ul>
            </li>

        </ul>
    </nav>
    <script>
    function myFunction() {
        document.getElementById("logoutForm").submit();
    }
    </script>
</header>