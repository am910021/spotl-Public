@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <span class="h1">{{ $title }}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 font-weight-bold">

                    <div class="row sub-row">
                        <div class="col-md-12 sub-block">
                            <div class="row">
                                <div class="col-md-8 text-center">
                                    <span class="h3">遊戲下載</span>

                                    <ul class="list-unstyled">
                                        <li class="list-item">
                                            <u>下載地址1</u>
                                        </li>
                                        <li class="list-item">
                                            <u>下載地址2</u>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <img alt="遊戲下載" src="{{ URL::asset('img/l1.png') }}"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row sub-row">
                        <div class="col-md-12 sub-block">
                            <div class="row">
                                <div class="col-md-8 text-center">
                                    @guest
                                        <span class="h3">個人中心</span>
                                        <ul class="list-unstyled">
                                            <li class="list-item">
                                                <u></u>
                                                <a class="custom-a" href="{{ route('register') }}"><u>帳號註冊</u></a>
                                            </li>
                                        </ul>
                                    @else
                                        <span class="h3">個人中心({{ Auth::user()->username }})</span>
                                        <ul class="list-unstyled">
                                            <li class="list-item">
                                                <a class="custom-a" href="{{ route('member.rechargeAndRedeem') }}">{{ __('Recharge/Redeem') }}</a>
                                            </li>
                                        </ul>
                                    @endguest

                                </div>
                                <div class="col-md-4">
                                    <img alt="遊戲下載" src="{{ URL::asset('img/l2.png') }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="row sub-row">
                        <div class="col-md-12 sub-block">
                            <p>
                                欢迎来到SpOTL彩虹冒险私服游玩，本服务器是基于韩国IO公司官方彩虹冒险最后版本开发出的版本，本版本尚未开发完全，具有以下游玩特色:
                            </p>
                            <ol>
                                <li class="list-item">
                                    多人任务白卡经验最高3倍，任务5通关后房间所有玩家（不论死活）获得额外击杀火龙所获卡的40%~60%
                                </li>
                                <li class="list-item">
                                    玩家"月光宝盒"(物品栏)96格全开
                                </li>
                                <li class="list-item">
                                    "弓"武器可合成出"减少攻击时间" 以及兼容出现"不可使用特殊技能"
                                </li>
                                <li class="list-item">
                                    绝大部分主流界面汉化
                                </li>

                            </ol>
                                更多内容添加下方QQ群了解
                        </div>
                    </div>
                </div>

                <div class="col-md-3 font-weight-bold">

                    <div class="row sub-row">
                        <div class="col-md-12 sub-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <img alt="遊戲下載" src="{{ URL::asset('img/r1.png') }}"/>
                                </div>
                                <div class="col-md-8 text-center">
                                    <span class="h3">最新公告</span>

                                    <ul class="list-unstyled">
                                        <li class="list-item">
                                            <a class="custom-a" href="{{ route('announce') }}"><u>公告1</u></a>
                                        </li>
                                        <li class="list-item">
                                            <a class="custom-a" href="{{ route('announce') }}"><u>公告2</u></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row sub-row">
                        <div class="col-md-12 sub-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <img alt="遊戲下載" src="{{ URL::asset('img/r2.png') }}"/>
                                </div>
                                <div class="col-md-8 text-center">
                                    <span class="h3">個人排行</span>

                                    <ul class="list-unstyled">
                                        <li class="list-item">
                                            <u>1.xxxxx</u>
                                        </li>
                                        <li class="list-item">
                                            <u>2.xxxxx</u>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection
