<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/all.min.css')}}" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link href="{{ URL::asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet"  referrerpolicy="no-referrer">
    <link href="{{ URL::asset('frontend/css/style.css') }}" rel="stylesheet"  referrerpolicy="no-referrer">
    <script src="{{ URL::asset('frontend/js/bootstrap.bundle.min.js') }}"  referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/animations.css') }}"  referrerpolicy="no-referrer" />
    <!-- <script src="{{ URL::asset('frontend/js/jquery-3.2.1.min.js') }}"></script> -->
    <script type="text/javascript">
    document.cookie = "PHPSESSID= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('frontend/images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('frontend/images/favicon.png') }}">
</head>

<body>
<style>
    img.menu_icons {
    height: 20px;
}
.social_icons{position: absolute;
    top: 25%;
    right: 0;
    z-index: 1111;}

.social_icons a {
    display: block;margin-bottom: 10px;
}
.social_icons a img{width: 45px; height:45px}
</style>

     <div class="social_icons">
                    <a class="hvr-hang" href="https://www.facebook.com/MNREMinistry/?ref_type=bookmark" target="_blank" referrerpolicy="no-referrer"><img src="{{ URL::asset('frontend/images/meta_fb.png') }}"  ></a>
                    <a class="hvr-hang" href="" referrerpolicy="no-referrer"><img src="{{ URL::asset('frontend/images/twitter.png') }}"></a>
                    <a class="hvr-hang" href="https://in.linkedin.com/company/ministry-of-new-and-renewable-energy-mnre" target="_blank" referrerpolicy="no-referrer"><img src="{{ URL::asset('frontend/images/linkedin.png') }}"  ></a>
                    <a class="hvr-hang" href="https://www.youtube.com/channel/UClk55sdIRCrxHtJe17bicCg" target="_blank" referrerpolicy="no-referrer"><img src="{{ URL::asset('frontend/images/youtube.png') }}"  ></a>
                      
                </div>
    <section>
        <nav id="stick_nav" class="navbar navbar-expand-lg  navbar-light bg-light bgWhite rounded sticky">

            <div class="container-fluid">
                <a class="navbar-brand" href=""><img src="{{ URL::asset('frontend/images/ALMM_main_logo.png') }}"
                        style="height: 50px;" alt="almm logo">
                    <!-- <img src="{{ URL::asset('frontend/images/azdi_ka_mohtsv.png') }}" style="height: 60px;" alt="aazadi ka amrit mahotsav"> -->
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="nav justify-content-center">
      <li class="nav-item">
        <img src="{{ URL::asset('frontend/images/Group-47.png') }}" style="width:210px" alt="mnre logo">
      </li>
     
    </ul>
                <div class="navbar-collapse collapse  justify-content-md-end" id="navbarCollapse">
                    <ul class="navbar-nav    mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->route()->getName() == 'home' ? 'active' : '' }}"
                                aria-current="page" href="{{url('/')}}"><button type="button"
                                    class="btn btn-link"><img src="{{ URL::asset('frontend/images/home_menu.png') }}"
                                class="menu_icons"> Home</button></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/login') }}"><button type="button"
                                    class="btn btn-warning"> <img src="{{ URL::asset('frontend/images/solar_menu.png') }}"
                                class="menu_icons"> Almm Solar</button></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/rmllogin') }}"><button type="button"
                                    class="btn btn-primary"><img src="{{ URL::asset('frontend/images/turbine_menu.png') }}"
                                class="menu_icons"> Almm Wind</button></a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ url('/feedback') }}"><button type="button"
                                    class="btn btn-link"><img src="{{ URL::asset('frontend/images/feedback_menu.png') }}"
                                class="menu_icons"> Feedback</button></a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/contact-us') }}"><button type="button"
                                    class="btn btn-link"> <img src="{{ URL::asset('frontend/images/contact_menu.png') }}"
                                class="menu_icons"> Contact Us</button></a>
                        </li>

                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Type
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{URL::to('/login')}}">Almm Solar</a></li>
                            <li><a class="dropdown-item" href="{{URL::to('/rmllogin')}}">Almm Wind</a></li>
                                
                            </ul>
                        </li> -->
                         <script>   
                             document.querySelectorAll('.dropdown-item').forEach(item => {
                             item.addEventListener('click', event => {
                                const selected = event.target.textContent;
                                console.log('Selected type:', selected);
                                // Do something with the selected value
                            });
                         });
                         </script>  


                        @if(Auth::guard('users')->check())
                        <a class="nav-link active" href="{{URL::to('/users')}}">
                            <button type="button" class="btn btn-outline-success">Dashboard</button></a>
                        @elseif(Auth::guard('mnre')->check())

                        <a class="nav-link active" href="{{URL::to('/mnre')}}">
                            <button type="button" class="btn btn-outline-success">Dashboard</button></a>
                        @elseif(Auth::guard('nise')->check())

                        <a class="nav-link active" href="{{URL::to('/nise')}}">
                            <button type="button" class="btn btn-outline-success">Dashboard</button></a>
                        @else
                        <!-- <li>
                            <a class="nav-link {{ request()->is('register') ? 'active' : '' }}"
                                href="{{url('register-user')}}"> <button type="button"
                                    class="btn btn-success">Register</button></a>
                        </li>
                        <li>
                            <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{url('login')}}">
                                <button type="button" class="btn btn-outline-success">Login</button></a>
                        </li> -->
                        @endif
                    </ul>

                </div>
            </div>
        </nav>
    </section>

  