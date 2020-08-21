@extends('layouts.layout')

@section('header')
    @parent

@endsection

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
                                Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>.
                                Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea
                                dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh,
                                lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut
                                cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi
                                    id commodo imperdiet, metus nunc consequat lectus, id bibendum diam
                                    velit et dui.</em> Proin massa magna, vulputate nec bibendum nec,
                                posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra
                                    quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat
                                    eu.</small>
                            </p>
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
