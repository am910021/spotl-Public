@extends('layouts.layout')

@section('header')
    <link href="{{ URL::asset('test/tempusdominus.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/all.css') }}" rel="stylesheet">

@endsection

@section('script')
    <script src="{{ asset('test/tempusdominus.js') }}"></script>

    <script type="text/javascript">

        var now = "{!! \Carbon\Carbon::now()->isoFormat('YYYY/MM/DD HH:mm') !!}"

        $(function () {
            $('#start_time').datetimepicker({
                locale: 'zh-tw',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });
            $('#start_time').val(now);
        });

        $(function () {
            $('#end_time').datetimepicker({
                locale: 'zh-tw',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });
            $('#end_time').val(now);
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
                <div class="col-md-2 font-weight-bold">

                </div>

                <div class="col-md-8">
                    <div class="row sub-row">
                        <div class="col-md-12 ">

                            <div class="row">
                                <div class="col-md-8 offset-2">

                                    <div class="card" id="card-main">
                                        <div
                                            class="card-header h5">{{ __('Admin:') }} {{ auth()->user()->username }}</div>


                                        <div class="card-body">


                                            @if( session('status') == 1)

                                                <div class="alert alert-primary alert-dismissible fade show"
                                                     role="alert">
                                                    <strong>{{ __('Generate Success!') }}</strong> {{ session('item') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @elseif ( session('status') == 2)
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                     role="alert">
                                                    <strong>{{ __('Generate Fail!') }}</strong> {{ session('item') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif

                                            <form method="POST" action="{{ route('admin.code.add') }}" id="redeem">
                                                @csrf

                                                <div class="form-group row">
                                                    <label for="security-code"
                                                           class="col-md-3 col-form-label text-md-right">{{ __('Security Code') }}</label>

                                                    <div class="col-md-8">
                                                        {{ Form::password(
                                                        'security_code',
                                                        ['id'=>'security-code',
                                                        'class'=> 'form-control'. ($errors->has('security_code') ? ' is-invalid' : null),
                                                        'required' => '',
                                                        'autocomplete'=>'security_code',
                                                        'autofocus'=>''])  }}

                                                        @error('security_code')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="item-type"
                                                           class="col-md-3 col-form-label text-md-right">{{ __('Item Type') }}</label>

                                                    <div class="col-md-8">
                                                        {{ Form::select(
                                                            'item_type',
                                                            $item_type,
                                                            old('item_type'),
                                                            ['id'=>'item-type',
                                                                'class'=> 'form-control'. ($errors->has('item_type') ? ' is-invalid' : null),
                                                            'required' => '',
                                                            'autocomplete'=>'item_type',
                                                            'autofocus'=>''])  }}

                                                        @error('item_type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="item-amount"
                                                           class="col-md-3 col-form-label text-md-right">{{ __('Item Amount') }}</label>
                                                    <div class="col-md-8">
                                                        {{ Form::number(
                                                        'item_amount',
                                                        1,
                                                        ['id'=>'item-amount',
                                                        'class'=> 'form-control'. ($errors->has('item_amount') ? ' is-invalid' : null),
                                                        'required' => '',
                                                        'autocomplete'=>'item_amount',
                                                        'autofocus'=>'',
                                                        'min'=>'1'
                                                        ])  }}

                                                        @error('item_amount')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="start_time" data-target="#start_time"
                                                           data-toggle="start_time"
                                                           class="col-md-3 col-form-label text-md-right">{{ __('Start Time') }}</label>

                                                    <div class="input-group col-md-8">

                                                        {{ Form::text(
                                                        'start_time',
                                                         null,
                                                        ['id'=>'start_time',
                                                        'class'=> 'form-control datetimepicker-input'. ($errors->has('start_time') ? ' is-invalid' : null),
                                                        'required' => '',
                                                        'data-target'=>'#start_time',
                                                        'data-toggle'=>'datetimepicker',
                                                        'autocomplete'=>'start_time',
                                                        'autofocus'=>''
                                                        ])  }}

                                                        <div class="input-group-append"
                                                             data-target="#start_time"
                                                             data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i
                                                                    class="fa fa-calendar"></i></div>
                                                        </div>

                                                        @error('start_time')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="end_time" data-target="#end_time"
                                                           data-toggle="end_time"
                                                           class="col-md-3 col-form-label text-md-right">{{ __('End Time') }}</label>

                                                    <div class="input-group col-md-8">

                                                        {{ Form::text(
                                                        'end_time',
                                                        null,
                                                        ['id'=>'end_time',
                                                        'class'=> 'form-control datetimepicker-input'. ($errors->has('end_time') ? ' is-invalid' : null),
                                                        'required' => '',
                                                        'data-target'=>'#end_time',
                                                        'data-toggle'=>'datetimepicker',
                                                        'autocomplete'=>'end_time',
                                                        'autofocus'=>''
                                                        ])  }}

                                                        <div class="input-group-append"
                                                             data-target="#end_time"
                                                             data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i
                                                                    class="fa fa-calendar"></i></div>
                                                        </div>

                                                        @error('end_time')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="max-redemption"
                                                           class="col-md-3 col-form-label text-md-right">{{ __('Max Redemption') }}</label>

                                                    <div class="col-md-8">
                                                        {{ Form::number(
                                                        'max_redemption',
                                                        1,
                                                        ['id'=>'max-redemption',
                                                        'class'=> 'form-control'. ($errors->has('max_redemption') ? ' is-invalid' : null),
                                                        'required' => '',
                                                        'autocomplete'=>'max_redemption',
                                                        'autofocus'=>'',
                                                        'min'=>'1'
                                                        ])  }}

                                                        @error('max_redemption')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="amount"
                                                           class="col-md-3 col-form-label text-md-right">{{ __('Generate Amount') }}</label>

                                                    <div class="col-md-8">
                                                        {{ Form::number(
                                                        'amount',
                                                        1,
                                                        ['id'=>'amount',
                                                        'class'=> 'form-control'. ($errors->has('amount') ? ' is-invalid' : null),
                                                        'required' => '',
                                                        'autocomplete'=>'amount',
                                                        'autofocus'=>''])  }}

                                                        @error('amount')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="price"
                                                           class="col-md-3 col-form-label text-md-right">{{ __('Price(RMB)') }}</label>

                                                    <div class="col-md-8">
                                                        {{ Form::number(
                                                        'price',
                                                        '',
                                                        ['id'=>'price',
                                                        'class'=> 'form-control'. ($errors->has('price') ? ' is-invalid' : null),
                                                        'required' => '',
                                                        'autocomplete'=>'price',
                                                        'autofocus'=>'',
                                                         'min'=>'0'
                                                        ])  }}

                                                        @error('price')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="form-group row mb-0">
                                                    <div class="col-md-8 offset-3">
                                                        <button type="submit" class="btn btn-block btn-success">
                                                            {{ __('Generate') }}
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

                <div class="col-md-2 font-weight-bold">

                </div>
            </div>
        </div>
    </div>



@endsection
