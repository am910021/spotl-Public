@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <span class="h1">{{ $title }}</span>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div
                        class="card-header h5">{{ __('Admin:') }} {{ auth()->user()->username }}</div>

                    <div class="card-body" id="card">
                        <p>注意：账号不能中文、不可复杂特殊字符，账号密码不能超过12位，每位玩家最多注册两个账号。</p>
                        <br>
                        <br>
                        <form method="POST" action="{{ route('admin.account.add.update') }}">
                            @csrf

                            @if( session('status') == 1)

                                <div class="alert alert-primary alert-dismissible fade show"
                                     role="alert">
                                    <strong>{{ __('Add').__('Success!') }}</strong> {{ __('Account').': '.session('account') }}
                                    <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @elseif ( session('status') == 2)
                                <div class="alert alert-danger alert-dismissible fade show"
                                     role="alert">
                                    <strong>{{ __('Add').__('Fail!') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="username"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="input-group col-md-6">

                                    <input id="username" type="text"
                                           class="form-control @error('username') is-invalid @enderror" name="username"
                                           value="{{ old('username') }}" required autocomplete="name" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">必填</div>
                                    </div>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="input-group col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" autocomplete="email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">必填</div>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="input-group col-md-6">
                                    <input id="phone" type="text"
                                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                                           value="{{ old('phone') }}" autocomplete="phone">
                                    <div class="input-group-append">
                                        <div class="input-group-text">必填</div>
                                    </div>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('gender',  __('Gender') , ['class' => 'col-md-4 col-form-label text-md-right']) !!}

                                <div class="input-group col-md-6">

                                    {{ Form::select(
                                        'gender',
                                        $gender_type,
                                        -1 ,
                                        ['id'=>'gender',
                                            'class'=> 'form-control'. ($errors->has('gender') ? ' is-invalid' : null),
                                        'required' => '',
                                        'autocomplete'=>'gender',
                                        'autofocus'=>''])  }}

                                    <div class="input-group-append">
                                        <div class="input-group-text">必填</div>
                                    </div>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="input-group col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">必填</div>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="input-group col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">必填</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
