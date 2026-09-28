 <meta charset="utf-8">
 <?php header('X-Frame-Options: DENY'); ?>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <link rel="stylesheet" href="{{ URL::asset('frontend/css/all.min.css')}}" crossorigin="anonymous"
     referrerpolicy="no-referrer" />
 <link href="{{ URL::asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
 <link href="{{ URL::asset('frontend/css/style.css') }}" rel="stylesheet">
 <script src="{{ URL::asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
 <link rel="stylesheet" href="{{ URL::asset('frontend/css/animations.css') }}" />
 <script src="{{ URL::asset('frontend/js/jquery.min.js') }}"></script>

 <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png">
 <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">

 <script type="text/javascript">
document.cookie = "PHPSESSID= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
 </script>