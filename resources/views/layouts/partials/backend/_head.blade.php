<head>
    <title>Ministry of New And Renewable Energy | @yield('title')</title>
    <?php header('X-Frame-Options: DENY'); ?>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('backend/css/all.min.css')}}"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

    <link href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet">
    <script src="{{asset('backend/js/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('backend/css/animations.css')}}" />
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('sweetalert2/sweetalert2.min.css')}}" />

    <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('images/favicon.png')}}">
    @stack('backend-css')
</head>