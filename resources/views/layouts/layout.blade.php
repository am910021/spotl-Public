<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - {{ $title }}</title>

    <!--  product env  -->
<!--
        <link href="{{ URL::asset('css/all.css') }}" rel="stylesheet">
-->

    <!--  debug env  -->
    <link href="/assets/css/test.css" rel="stylesheet">


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
            padding: 50px;

        }

        .custom-container {
            background-color: rgba(240, 248, 255, 0.5);
            border-color: black;
            border-width: 4px;
            border-style: solid;
        }

        .login-row {
            margin-top: 15px;
        }

        .login-row > div > a {
            color: black;
            font-weight: bold;
        }

        .login-row > div > a:hover {
            color: #1d68a7;
        }

        .custom-a {
            color: black;
        }

        .menu {
            height: 230px;
        }

        .custom-ul > li > div > a {
            font-weight: bold;
            font-size: medium;
        }

        .custom-ul {
            margin: 0 auto;
        }

        .custom-ul > li {
            font-size: xx-large;
        }

        .custom-ul > li > div {
            padding: 0;
            border-width: 0;
        }


        .custom-ul > li > div {
            background-color: rgba(255, 255, 255, 0);
        }


        div.dropdown-divider {
            border-top: 2px solid black;
            margin: 0;
        }

        .sub-block {
            background-color: white;
        }

        .sub-row {
            padding: 15px;
        }

        .sub-block > div > div > img {
            width: 108px;
            height: 192px;
        }

        .sub-block > div > div > ul {
            margin-top: 10px;
        }
    </style>

    @yield('style')

</head>
<body>

<div id="app">
    <div class="container-fluid ">
        <div class="row custom-row">
            <div class="col-md-12 custom-container">

                <div class="row login-row">
                    <div class="col-md-9" style="visibility:hidden">
                        <p class="text-lg-center ">ha ha </p>

                    </div>
                    <div class="col-md-3 text-right">

                        @guest
                            <a class="h2" href="{{ route("login") }}"><u>登入/註冊</u></a>
                        @else
                            <a class="h2" href="{{ route("logout") }}"><u>登出</u></a>
                        @endguest
                    </div>
                </div>

                <div class="row menu">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg ">
                            <div class="navbar-collapse collapse w-100 dual-collapse2 order-1 order-md-0">
                                <ul class="navbar-nav custom-ul text-center">

                                    <li class="nav-item">
                                        <a class="nav-link custom-a font-weight-bold"
                                           href="{{ route("index") }}">::首頁::</a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link custom-a font-weight-bold" href="#"
                                           id="navbarDropdownMenuLink" data-toggle="dropdown">::公告::</a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item" href="{{ route('update') }}">更新內容</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('blackList') }}">封處名單</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">排行榜</a>
                                            <div class="dropdown-divider"></div>
                                        </div>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link custom-a font-weight-bold" href="{{ route('index') }}"
                                           id="navbarDropdownMenuLink" data-toggle="dropdown">::充值::</a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item" href="#">Alipay</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Wechat</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Paypal</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item"
                                               href="{{ route('member.rechargeAndRedeem') }}">{{ __('Recharge/Redeem') }}</a>
                                            <div class="dropdown-divider"></div>
                                        </div>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link custom-a font-weight-bold" href="{{ route('index') }}"
                                           id="navbarDropdownMenuLink" data-toggle="dropdown">::活動::</a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item" href="#">幸運抽獎</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">刮刮樂</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">超值首充</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Cash/Code商城</a>
                                            <div class="dropdown-divider"></div>
                                        </div>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link custom-a font-weight-bold" href="#">聊天室</a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link custom-a font-weight-bold" href="{{ route('index') }}"
                                           id="navbarDropdownMenuLink" data-toggle="dropdown">::拓展內容::</a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item" href="#">公會</a>
                                            <div class="dropdown-divider"></div>

                                        </div>
                                    </li>

                                    @auth
                                        @if(auth()->user()->isAdmin && auth()->user()->type == 0)
                                            <li class="nav-item dropdown">
                                                <a class="nav-link custom-a font-weight-bold"
                                                   href="{{ route("admin.main") }}">::管理員頁面::</a>
                                            </li>
                                        @endif
                                    @endauth

                                </ul>
                            </div>

                        </nav>

                    </div>
                </div>

                @yield('content')

                <div class="row sub-row">
                    <div class="col-md-12 sub-block text-center">
                        <div class="row">
                            <div class="col-md-4">
                                <span>QQ群:xxxxxx</span>
                            </div>
                            <div class="col-md-4">
                                <span>QQ客服:xxxxxx</span>
                            </div>
                            <div class="col-md-4">
                                <span>Email:xxxxxx</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@yield('script')
</body>
</html>
