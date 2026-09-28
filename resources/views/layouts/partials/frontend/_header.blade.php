<nav id="homenav" class="navbar navbar-mnre navbar-fixed-top navbar-expand-lg navbar-light bg-light header">
    <div class="container-fluid pl-0">
        <div class="navbar-header col-md-4 col-sm-6 col-xs-6">
            <a class="navbar-brand" target="_blank" referrerpolicy="no-referrer" href="https://mnre.gov.in">
                <img class="ind_tri_color" src="{{URL::asset('public/images/tri_color_side.jpg')}}">
                <div class="home-logo-holder">
                    <img src="{{URL::asset('public/images/logo.png')}}">
                </div>
            </a>
        </div>
        <ul class="nav navbar-nav collapse navbar-collapse">
            <li class="{{ request()->route()->getName() == 'home' ? 'active' : '' }}"><a href="{{url('/')}}">HOME</a>
            </li>
            <li class="{{ request()->route()->getName() == 'about-the-programmes' ? 'active' : '' }}"><a
                    href="{{url('about-the-programmes')}}">ABOUT THE PROGRAMMES</a></li>
            <li class="{{ request()->route()->getName() == 'downloads' ? 'active' : '' }}"><a
                    href="{{url('downloads')}}">FORMS/DOWNLOADS</a></li>
            <li><a data-toggle="modal" data-target="#helpDeskModal" href="#">HELP DESK</a></li>
            <li class="{{ request()->route()->getName() == 'faqs' ? 'active' : '' }}"><a href="{{url('faqs')}}">FAQs</a>
            </li>
            <li class="text-left {{ request()->is('login') ? 'active' : '' }}"><a
                    href="{{url('login')}}">@if(Auth::check()) DASHBOARD @else LOGIN @endif</a></li>
        </ul>
        <ul class="nav navbar-nav">
            <li><a class="glyphicon glyphicon-align-right visible-xs-block" onclick='OpenMenu();'></a></li>
        </ul>
    </div>
</nav>
<div class="container-fluid mobile-menu">
    <div class="row">
        <div class="col-sm-12 pt-30">
            <button onclick='CloseMenu();'>X</button>
            <ul class="mobile-list">
                <li><a href="{{url('/')}}">HOME</a></li>
                <li><a href="{{url('about-the-programmes')}}">ABOUT THE PROGRAMMES</a></li>
                <li><a href="{{url('downloads')}}">FORMS/DOWNLOADS</a></li>
                <li><a href="#">HELP DESK</a></li>
                <li class="{{ request()->route()->getName() == 'faqs' ? 'active' : '' }}"><a
                        href="{{url('faqs')}}">FAQs</a></li>
                <li><a href="{{url('login')}}">@if(Auth::check()) DASHBOARD @else LOGIN @endif</a></li>
            </ul>
        </div>
    </div>
</div>
