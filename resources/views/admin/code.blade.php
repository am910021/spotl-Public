@extends('layouts.layout')

@section('style')
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker();
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
                <div class="col-md-3 font-weight-bold">

                </div>

                <div class="col-md-6">
                    <div class="row sub-row">
                        <div class="col-md-12 ">

                            <div class="row">
                                <div class="col-md-8 offset-2">

                                    <div class="card">
                                        <div
                                            class="card-header h5">{{ __('Admin:') }} {{ auth()->user()->username }}</div>


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
                                                    <strong>{{ __('Fail!') }}</strong> {{ session('item') }}
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
                                                           class="col-md-3 col-form-label text-md-right">{{ __('Item Type') }}</label>

                                                    <div class="col-md-6">
{{--                                                        <input id="cardNumber" type="text"--}}
{{--                                                               class="form-control @error('cardNumber') is-invalid @enderror"--}}
{{--                                                               name="cardNumber" value="{{ old('cardNumber') }}"--}}
{{--                                                               required autocomplete="cardNumber" autofocus>--}}

                                                        {!! Form::select('item_type', $item_type, Input::old('item_type'), ['class'=> 'form-control'])  !!}


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
