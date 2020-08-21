<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - {{ $title }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @section('header')
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/all.css') }}" rel="stylesheet">
    @show
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
                                <span>QQ群：927940615</span><br>
                                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModalCenter">
                                    顯示二維碼
                                </button>
                            </div>
                            <div class="col-md-4">
                                <span>QQ群负责人1：56769274</span><br>
                                <span>QQ群负责人2：554821034</span>
                            </div>
                            <div class="col-md-4">
                                <span>E-mail：124620278@qq.com</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">QQ群二維碼</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ URL::asset('img/qrcode.png') }}" alt="QQ群二維碼">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script src="{{ asset('js/app.js') }}"></script>
@show
</body>
</html>
