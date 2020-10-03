@extends('layouts.layout')

@section('header')
    <link href="{{ URL::asset('test/tempusdominus.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('handsontable/handsontable.full.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('test/tempusdominus.js') }}"></script>
    <script src="{{ asset('handsontable/handsontable.full.min.js') }}"></script>
    <script src="{{ asset('handsontable/languages/all.min.js') }}"></script>
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
                                <div class="col-md-12">

                                    <div class="card" id="card-main">
                                        <div
                                            class="card-header h5">{{ __('Admin:') }} {{ auth()->user()->username }}</div>


                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <a class="btn btn-info" href="{{ route('admin.account') }}">上一頁</a>
                                                </div>
                                                <div class="col-md-3">
                                                    <a class="btn btn-info" href="{{ route('admin.account.add') }}">新增帳號</a>
                                                </div>
                                            </div>
<br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">遊戲編號</th>
                                                                <th scope="col">網站編號</th>
                                                                <th scope="col">遊戲帳號</th>
                                                                <th scope="col">網站帳號</th>
                                                                <th scope="col">註冊日期</th>
                                                                <th scope="col">註冊IP</th>
                                                                <th scope="col">狀態</th>
                                                                <th scope="col">封鎖直到</th>
                                                                <th scope="col">編輯</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @foreach( $users as $index => $user)
                                                                <tr @if( $index % 2 == 0 ) class="table-info" @endif>
                                                                    <th scope="row">{{ $user['gnum'] }}</th>
                                                                    <td>{{ $user['num'] }}</td>
                                                                    <td>{{ $user['gusername'] }}</td>
                                                                    <td>{{ $user['username'] }}</td>
                                                                    <td>{{ $user['reg_time'] }}</td>
                                                                    <td>{{ $user['reg_ip'] }}</td>
                                                                    <td>{{ $user['status'] }}</td>
                                                                    @if($user['ban_time'] > 0)
                                                                        <td>{!! \Carbon\Carbon::createFromTimestamp($user['ban_time'])->format('Y/m/d H:i') !!}</td>
                                                                    @else
                                                                        <td></td>
                                                                    @endif
                                                                    <td><a class="btn btn-success"
                                                                           href="{{ route('admin.account.modify', $user['gnum']) }}"><i
                                                                                class="far fa-edit"></i></a></td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
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

            </div>
        </div>
    </div>



@endsection
