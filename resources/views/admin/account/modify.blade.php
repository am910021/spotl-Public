@extends('layouts.layout')

@section('header')
    <link href="{{ URL::asset('test/tempusdominus.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/all.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('test/tempusdominus.js') }}"></script>

    <script type="text/javascript">


        $(function () {
            var minDate = moment(new Date);
            minDate.subtract(1, 'week');

            $('#ban_to').datetimepicker({
                locale: 'zh-tw',
                format: 'YYYY/MM/DD HH:mm',
                minDate: minDate,
            });

            @if( $gameUser->usr_ban_time !=0)
            var now = "{!! \Carbon\Carbon::createFromTimestamp($gameUser->usr_ban_time)->format('Y/m/d H:i') !!}"
            $('#ban_to').val(now);
            @endif

        });

    </script>
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

                <div class="col-md-12">
                    <div class="row sub-row">
                        <div class="col-md-12 ">

                            <div class="row">
                                <div class="col-md-8 offset-md-2">

                                    <div class="card" id="card-main">
                                        <div
                                            class="card-header h5">{{ __('Admin:') }} {{ auth()->user()->username }}</div>


                                        <div class="card-body" id="card">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a class="btn btn-info" href="{{ route('admin.account') }}">上一頁</a>
                                                </div>
                                            </div>

                                            @if( session('status') == 1)
                                                <div class="alert alert-primary alert-dismissible fade show"
                                                     role="alert">
                                                    <strong>{{ __('Modify Success!') }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @elseif ( session('status') == 2)
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                     role="alert">
                                                    <strong>{{ __('Modify Fail!') }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif

                                            {!! Form::open(['url' => route('admin.account.update', $gnum)]) !!}
                                            {!!  Form::number('gnum', $gnum, $attributes = ['hidden'=>true]) !!}

                                            <div class="form-group row">
                                                {!! Form::label('note',  __('Note') , ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                                <div class="input-group col-md-6">
                                                    {!! Form::text(
                                                    'note',
                                                    '遊戲帳號與網站帳號是連動的。',
                                                    ['id'=>'note',
                                                    'class'=> 'form-control',
                                                    'required' => '',
                                                    'autocomplete'=>'note',
                                                    'autofocus'=>'',
                                                    'readonly'=>true,
                                                    'disabled'=>'true'
                                                    ])  !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                {!! Form::label('game_username',  __('Game Username') , ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                                <div class="input-group col-md-6">
                                                    {!! Form::text(
                                                     'game_username',
                                                     $gameUser->usr_name,
                                                     ['id'=>'game_username',
                                                     'class'=> 'form-control'. ($errors->has('game_username') ? ' is-invalid' : null),
                                                     'required' => '',
                                                     'autocomplete'=>'game_username',
                                                     'autofocus'=>'',
                                                     'readonly'=>true,
                                                     'disabled'=>'true'
                                                     ])  !!}
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">唯讀</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                {!! Form::label('web_username',  __('Web Username') , ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                                <div class="input-group col-md-6">
                                                    {!! Form::text(
                                                    'web_username',
                                                    $user->username,
                                                    ['id'=>'web_username',
                                                    'class'=> 'form-control'. ($errors->has('web_username') ? ' is-invalid' : null),
                                                    'required' => true,
                                                    'autocomplete'=>'web_username',
                                                    'autofocus'=>''
                                                    ])  !!}
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">必填</div>
                                                    </div>
                                                    @error('web_username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                {!! Form::label('email',  __('Email') , ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                                <div class="input-group col-md-6">
                                                    {!! Form::text(
                                                    'email',
                                                    $user->email,
                                                    ['id'=>'email',
                                                    'class'=> 'form-control'. ($errors->has('email') ? ' is-invalid' : null),
                                                    'required' => false,
                                                    'autocomplete'=>'email',
                                                    'autofocus'=>''
                                                    ])  !!}
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">選填</div>
                                                    </div>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                {!! Form::label('phone',  __('Phone') , ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                                <div class="input-group col-md-6">
                                                    {!! Form::text(
                                                    'phone',
                                                    $gameUser->usr_phone,
                                                    ['id'=>'phone',
                                                    'class'=> 'form-control'. ($errors->has('phone') ? ' is-invalid' : null),
                                                    'required' => false,
                                                    'autocomplete'=>'phone',
                                                    'autofocus'=>''
                                                    ])  !!}
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">選填</div>
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
                                                        $gameUser->usr_gender,
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

                                            <hr>
                                            <div class="form-group row">
                                                {!! Form::label('note2',  __('Note') , ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                                <div class="input-group col-md-6">
                                                    {!! Form::text(
                                                    'note2',
                                                    '需要修改密碼在填入。',
                                                    ['id'=>'note2',
                                                    'class'=> 'form-control',
                                                    'required' => '',
                                                    'autocomplete'=>'note2',
                                                    'autofocus'=>'',
                                                    'readonly'=>true,
                                                    'disabled'=>'true'
                                                    ])  !!}
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="password"
                                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                <div class="input-group col-md-6">
                                                    <input id="password" type="password"
                                                           class="form-control @error('password') is-invalid @enderror"
                                                           name="password"
                                                           autocomplete="new-password">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">選填</div>
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
                                                           name="password_confirmation"
                                                           autocomplete="new-password">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">選填</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="form-group row">
                                                {!! Form::label('note3',  __('Note') , ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                                <div class="input-group col-md-6">
                                                    {!! Form::text(
                                                    'note3',
                                                    '以下為設定鎖定帳號，有需要在填入。',
                                                    ['id'=>'note3',
                                                    'class'=> 'form-control',
                                                    'required' => '',
                                                    'autocomplete'=>'note3',
                                                    'autofocus'=>'',
                                                    'readonly'=>true,
                                                    'disabled'=>'true'
                                                    ])  !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                {!! Form::label('ban_to',  __('Ban to') , ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                                <div class="input-group col-md-6">
                                                    {!!   Form::text(
                                                       'ban_to',
                                                        null,
                                                       ['id'=>'ban_to',
                                                       'class'=> 'form-control datetimepicker-input'. ($errors->has('ban_to') ? ' is-invalid' : null),
                                                       'required' => false,
                                                       'data-target'=>'#ban_to',
                                                       'data-toggle'=>'datetimepicker',
                                                       'autocomplete'=>'ban_to',
                                                       'autofocus'=>''
                                                       ])  !!}
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">選填</div>
                                                    </div>
                                                    @error('ban_to')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                {!! Form::label('ban_type',  __('Ban Type') , ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                                <div class="input-group col-md-6">
                                                    {!! Form::number(
                                                    'ban_type',
                                                    $gameUser->usr_ban_type,
                                                    ['id'=>'ban_type',
                                                    'class'=> 'form-control'. ($errors->has('ban_type') ? ' is-invalid' : null),
                                                    'required' => false,
                                                    'autocomplete'=>'ban_type',
                                                    'autofocus'=>''
                                                    ])  !!}
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">選填</div>
                                                    </div>
                                                    @error('ban_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row mb-0">
                                                <div class="col-md-4 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Modify') }}
                                                    </button>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection
