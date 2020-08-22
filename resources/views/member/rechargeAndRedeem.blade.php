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

                </div>

                <div class="col-md-6">
                    <div class="row sub-row">
                        <div class="col-md-12 ">

                            <div class="row">
                                <div class="col-md-8 offset-2">

                                    <div class="card">
                                        <div class="card-header h5">{{ __('Buy Cash card') }}</div>
                                        <div class="card-body">
                                            <p>
                                                本页面提供Cash充值，新手礼包的购买(需登陆)(卡号密码兑换使用) 玩家根据自己需求点击下方链接
                                                进入购卡页面后选择相应种类完成支付
                                                购买后复制显示的卡号密码回到本页面最下方进行兑换 确认账号无误后击“兑换”（成功后会显示充值款额）
                                                兑换过的卡密不能再次使用，玩家也请勿购买二手卡密
                                                通过购买其他玩家卡密引发的问题，本服概不处理
                                                **特别备注：新手礼包里不同类型的礼包每个账号终生只能兑换1次，玩家购买前请一定要确认该账号未曾购买过该类型礼包，重复购买导致不可用玩家自行负责退还）
                                            </p>

                                            <div class="row">
                                                <div class="col-md-5 offset-1">
                                                    <a href="https://ip_address_removed/s/AtPz3ng" target="_blank" type="button"
                                                       class="btn btn-block btn-info">
                                                        {{ __('Click to Recharge') }}
                                                    </a>
                                                </div>

                                                <div class="col-md-5">
                                                    <a href="https://ip_address_removed/s/AJ8aVZO" target="_blank" type="button" class="btn btn-block btn-info">
                                                        {{ __('Click to Buy') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 offset-3">&nbsp;</div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header h5">{{ __('Redeem Cash card') }}</div>


                                        <div class="card-body">


                                            @if( session('status') == 1)

                                                <div class="alert alert-primary alert-dismissible fade show"
                                                     role="alert">
                                                    <strong>{{ __('Redeem Success!') }}</strong> {{ session('item') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @elseif ( session('status') == 2)
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                     role="alert">
                                                    <strong>{{ __('Fail!') }}</strong> {{ session('msg') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif

                                            <form method="POST" action="{{ route('member.redeem') }}" id="redeem">
                                                @csrf

                                                <div class="form-group row">
                                                    <label for="cardNumber"
                                                           class="col-md-3 col-form-label text-md-right">{{ __('Card Number') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="cardNumber" type="text"
                                                               class="form-control @error('cardNumber') is-invalid @enderror"
                                                               name="cardNumber" value="{{ old('cardNumber') }}"
                                                               required autocomplete="cardNumber" autofocus>

                                                        @error('cardNumber')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password"
                                                           class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password"
                                                               class="form-control @error('password') is-invalid @enderror"
                                                               name="password" required autocomplete="current-password">

                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-3">
                                                        <button type="submit" class="btn btn-block btn-success">
                                                            {{ __('Redeem') }}
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 font-weight-bold">

                </div>
            </div>
        </div>
    </div>



@endsection
