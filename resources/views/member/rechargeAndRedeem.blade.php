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
                                                Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>.
                                                Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse
                                                platea
                                                dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh,
                                                lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut
                                                cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur,
                                                    nisi
                                                    id commodo imperdiet, metus nunc consequat lectus, id bibendum diam
                                                    velit et dui.</em> Proin massa magna, vulputate nec bibendum nec,
                                                posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu,
                                                    pharetra
                                                    quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat
                                                    eu.</small>
                                            </p>

                                            <div class="row">
                                                <div class="col-md-6 offset-3">
                                                    <button type="button" class="btn btn-block btn-info">
                                                        {{ __('Click to buy') }}
                                                    </button>
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

                                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                    <strong>{{ __('Redeem Success!') }}</strong> {{ session('item') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @elseif ( session('status') == 2)
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ __('Fail!') }}</strong> {{ session('item') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
