<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <!-- Site Properties -->
    <title>{{ config('site.title') }}</title>

    @include('elements.favicon')

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/semantic-ui/semantic.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/redactor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/BeatPicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

    @yield('style-head')

    <script src="{{ asset('lib/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/semantic-ui/semantic.min.js') }}"></script>
    <script src="{{ asset('js/readmore.min.js') }}"></script>
    <script src="{{ asset('js/BeatPicker.min.js') }}"></script>
	<script src="{{ asset('js/redactor.min.js') }}"></script>
	<script src="{{ asset('js/imagemanager.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>

    @yield('script-head')
</head>
<body class="{{ (request()->is('/'))?'home':'' }}">
@yield('body')
@yield('script-end')
</body>
</html>
