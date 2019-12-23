<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <title>@yield('page-title')</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{url('/semantic-ui/semantic.min.css')}}">
    <link rel="stylesheet" href="{{url('/assets/css/main.css')}}">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script src="{{url('/assets/js/vendor/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
</head>
<body>
<div class="ui fluid container">
    <div style="padding: 15px">
        @yield('main-content')
    </div>
</div>
<script src="{{url('/assets/js/vendor/popper.min.js')}}"></script>
<script src="{{url('/semantic-ui/semantic.min.js')}}"></script>
<script src="{{url('/assets/js/main.js')}}"></script>
</body>
</html>
