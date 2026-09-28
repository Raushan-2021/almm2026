<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Ministry of New And Renewable Energy</title>
        @include('layouts.partials.frontend._head')

        @yield('styles')
    </head>



    <head>
        <title>MNRE | Home</title>
        <!--Has all the sylesheets attached already!-->
        @include('layouts.partials.frontend._head')
        <link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}">
        <!--Custom CSS or CSS Files for particular page-->
        @yield('styles')
    </head>

    <body id="home-body" onload="startTime()">
        <div>
            <!--Application Header-->
            @include('layouts.partials.frontend._header')
            <!--Page Content Main-->
            <section id="content">
                <div id="loader" class="overlay">
                    <div class="overlay__inner">
                        <div class="overlay__content">
                            <span class="spinner"></span>
                            <div class="clearfix mb-15"></div>
                            <span class="colorWhite">Processing, Please wait</span>
                        </div>
                    </div>
                </div>
                @yield('content')
            </section>
            @if(Session::has('msg'))
            <div class="clearfix"></div>
            @include('layouts.partials.modals.msgModal')
            @endif
            @include('layouts.partials.modals.helpDeskModal')
            <div class="clearfix"></div>
            <!--Footer of Application-->
            @include('layouts.partials.frontend._footer')
        </div>
        <!--Has all the scripts already attached-->
        @include('layouts.partials.frontend._base')
        <!--Custom scripts for particular pages-->
        @yield('scripts')
    </body>

</html>
