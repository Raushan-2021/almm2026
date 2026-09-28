<!DOCTYPE html>
<html>
    @include('layouts.partials.backend._head')

    <body>
        @include('layouts.partials.backend._header')
        @include('layouts.partials.backend._sidebar')
        <main id="main" class="main">

            <div class="pagetitle">
                <h1>@yield('title')</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </nav>
            </div>


            <section class="section">
                @yield('content')
            </section>
        </main>
        @include('layouts.partials.backend._modals')
        @include('layouts.partials.modals.association')
        @include('layouts.partials.modals.systemApprove')
        @include('layouts.partials.backend._scripts')
        <div id="loading-bg-ajax" class="loading-bg-ajax hide">
            <div class="ajax-loader">
                <img src="{{ url('/public/backend/images/loader.gif') }}" class="img-responsive" style="width:35%" />
            </div>
        </div>
        <style>
        .loading-bg-ajax {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            z-index: 99999;
            background-color: #000000;
            opacity: .5;
        }

        .ajax-loader {
            position: absolute;
            z-index: 9999999999;
            top: 30%;
            left: 52%;
        }

        .hide {
            display: none;
        }

        </style>
    </body>

</html>
