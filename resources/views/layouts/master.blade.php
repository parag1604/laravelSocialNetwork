<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{URL::to('favicon.ico')}}" type="image/x-icon">

        <title>GAA - @yield('title')</title>

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="{{URL::to('src/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{URL::to('src/css/bootstrap-theme.min.css')}}">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{URL::to('src/css/styles.css')}}">

        <!-- Compiled and minified JavaScript -->
        <script src="{{URL::to('src/js/jquery.min.js')}}"></script>
        <script src="{{URL::to('src/js/bootstrap.min.js')}}"></script>

        <!-- Custom Script -->
        <script src="{{URL::to('src/js/app-scripts.js')}}"></script>

    </head>
    <body>
        @include('includes.header')
        <div class="container" id="main-content">
            @yield('content')
        </div>
        @include('includes.footer')
    </body>
</html>
