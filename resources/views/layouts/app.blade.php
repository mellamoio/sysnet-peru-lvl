<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> @yield('title') </title>

        <!-- Fevicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/sysnet-favicon.png') }}">
        <!-- Start CSS -->
        @yield('style')
        <link href="{{ asset('assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/flag-icon.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
        <!-- End CSS -->
    </head>
    <body class="vertical-layout">
        <!-- Start Containerbar -->
        <div id="containerbar" class="container-fluid">
            <!-- Start Rightbar -->
            @include('layouts.rightbar')
            @yield('content')
            <!-- End Rightbar -->
        </div>
        <!-- End Containerbar -->

        <!-- Start JS -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/js/detect.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/js/horizontal-menu.js') }}"></script>
        <script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>
        @yield('script')
        <!-- Core JS -->
        <script src="{{ asset('assets/js/core.js') }}"></script>
        <!-- End JS -->
    </body>
</html>
