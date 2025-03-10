<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __("Welcome to ").config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!--  product env  -->
<!--
        <link href="{{ URL::asset('css/all.css') }}" rel="stylesheet">
        -->

    <!--  debug env  -->
    <link href="assets/css/test.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-image: url("/static/img/LOGO.jpg");
            background-repeat: no-repeat;
            background-position: center top;
            background-size: cover;
            height: 100vh;
            margin: 0;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            #align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
            padding-top: 65vh;
        }

        .title {
            font-size: 30px;
            font-weight: bold;
            text-decoration: underline;

        }

        a:hover.title{
            font-style: oblique;
        }

        a:link.title, a:visited.title{
            color: #1d2124;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">


    <div class="content">
        <a class="title m-b-md" href="{{ url("index") }}">
            {{ __("Enter Index") }}
        </a>


    </div>
</div>
</body>
</html>
