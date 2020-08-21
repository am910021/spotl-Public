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
                <div class="col-md-2 font-weight-bold">

                </div>

                <div class="col-md-8">
                    <div class="row sub-row">
                        <div class="col-md-12 ">

                            <div class="card">
                                <div class="card-header h5">{{ __('Manage list') }}</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 ">
                                            <a href="{{ route('admin.code') }}" class="btn btn-block btn-info">
                                                {{ __('Code Manage') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 offset-3">&nbsp;</div>
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
