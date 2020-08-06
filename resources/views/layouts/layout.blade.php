<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}-@yield('title')</title>

    <!--  product env  -->
<!--
        <link href="{{ URL::asset('css/all.css') }}" rel="stylesheet">
-->

    <!--  debug env  -->
    <link href="assets/css/test.css" rel="stylesheet">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .custom-row {
            padding-top: 50px;
            padding-left: 50px;
            padding-right: 50px;
        }

        .custom-container {
            background-color: rgba(240, 248, 255, 0.5);
            border-color: black;
            border-width: 4px;
            border-style: solid;
        }

    </style>
</head>
<body>
<div id="app">
    <div class="container-fluid ">
        <div class="row custom-row">
            <div class="col-md-12 custom-container">


            </div>
        </div>
    </div>
</div>
</body>
</html>
