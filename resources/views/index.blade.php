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
<div class="ui menu">
    <a href="/" class="header item">
        УНИВЕР
    </a>
    <div class="ui simple dropdown item">
        Управление <i class="dropdown icon"></i>
        <div class="menu">
            <a href="{{url('/management/form_count')}}" class="item @yield('form_count')">Кол-во студентов по форме обучения</a>
            <a href="{{url('/management/discipline_info')}}" class="item @yield('discipline_info')">Информация о дисциплине</a>
            <a href="{{url('/management/students')}}" class="item @yield('students')">Управление студентами</a>
            <a href="{{url('/management/plan')}}" class="item @yield('plan')">Управление планом обучения</a>
            <a href="{{url('/tasks/info')}}" class="item @yield('info')">Управление журналом успеваемости</a>
        </div>
    </div>
    <a class="item @yield('get-info')" href="{{url('/get_info')}}">Выдать справку об успеваемости</a>
</div>
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
