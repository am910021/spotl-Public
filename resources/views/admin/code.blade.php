@extends('layouts.layout')

@section('header')
    <link href="{{ URL::asset('test/tempusdominus.css') }}" rel="stylesheet">
    <!--  debug env  -->
    <link href="/assets/css/test.css" rel="stylesheet">
    <link href="{{ URL::asset('handsontable/handsontable.full.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('test/tempusdominus.js') }}"></script>
    <script src="{{ asset('handsontable/handsontable.full.min.js') }}"></script>
    <script src="{{ asset('handsontable/languages/all.min.js') }}"></script>

    <script>
        var now = "{!! \Carbon\Carbon::now()->isoFormat('YYYY/MM/DD HH:mm') !!}"

        $(function () {
            $('#start_time').datetimepicker({
                locale: 'zh-tw',
                format: 'L',
            });
        });

        $(function () {
            $('#end_time').datetimepicker({
                locale: 'zh-tw',
                format: 'L',
            });
        });

        @if(session('data'))
        var data = {!! json_encode(session('data')) !!};
        @else
        var data = {!! json_encode($data) !!};
        @endif

        var hotElement = document.querySelector('#hot');
        var hot = new Handsontable(hotElement, {
            data: data,
            width: '100%',
            rowHeaders: true,
            columnSorting: true,
            colHeaders: ['卡號', '密碼', '物品種類', '物品數量', '生成用戶', '生成時間', '有效期(開始)', '有效期(結束)', '最大可兌換次數', '剩餘可兌換次數', '價錢'],
            columns: [
                {
                    data: 'code',
                    width: 150,
                    readOnly: true,
                }, {
                    data: 'pass',
                    width: 150,
                    readOnly: true,
                }, {
                    data: 'item_type',
                    readOnly: true,
                }, {
                    data: 'item_amount',
                    readOnly: true,
                }, {
                    data: 'generate_username',
                    readOnly: true,
                }, {
                    data: 'generate_timestamp',
                    readOnly: true,
                }, {
                    data: 'effective_start',
                    readOnly: true,
                }, {
                    data: 'effective_end',
                    readOnly: true,
                }, {
                    data: 'max_redemption',
                    readOnly: true,
                }, {
                    data: 'remaining_redemption',
                    readOnly: true,
                }, {
                    data: 'price',
                    readOnly: true,
                },
            ]
        });
        $('#hot-display-license-info').remove();

        var button1 = document.getElementById('export-file');
        var exportPlugin1 = hot.getPlugin('exportFile');

        button1.addEventListener('click', function () {
            exportPlugin1.downloadFile('csv', {
                bom: false,
                columnDelimiter: ',',
                columnHeaders: true,
                exportHiddenColumns: true,
                exportHiddenRows: true,
                fileExtension: 'csv',
                filename: 'Handsontable-CSV-file_[YYYY]-[MM]-[DD]',
                mimeType: 'text/csv',
                rowDelimiter: '\r\n',
                rowHeaders: false
            });
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
                                <div class="col-md-12">

                                    <div class="card" id="card-main">
                                        <div
                                            class="card-header h5">{{ __('Admin:') }} {{ auth()->user()->username }}</div>


                                        <div class="card-body">
                                            <form action="{{ route('admin.code.query') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="clo-md-2">
                                                        <a href="{{ route('admin.code.add') }}"
                                                           class="btn btn-block btn-info">
                                                            {{ __('Code Generate') }}
                                                        </a>
                                                    </div>

                                                    <div class="input-group col-md-3">

                                                        {{ Form::text(
                                                        'start_time',
                                                         null,
                                                        ['id'=>'start_time',
                                                        'class'=> 'form-control datetimepicker-input'. ($errors->has('start_time') ? ' is-invalid' : null),
                                                        'data-target'=>'#start_time',
                                                        'data-toggle'=>'datetimepicker',
                                                        'autocomplete'=>'off',
                                                        'placeholder'=>'查尋時間(開始)'
                                                        ])  }}

                                                        <div class="input-group-append"
                                                             data-target="#start_time"
                                                             data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i
                                                                    class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>

                                                    <div class="input-group col-md-3">

                                                        {{ Form::text(
                                                        'end_time',
                                                        null,
                                                        ['id'=>'end_time',
                                                        'class'=> 'form-control datetimepicker-input'. ($errors->has('end_time') ? ' is-invalid' : null),
                                                        'data-target'=>'#end_time',
                                                        'data-toggle'=>'datetimepicker',
                                                        'autocomplete'=>'off',
                                                        'placeholder'=>'查尋時間(結束)'
                                                        ])  }}

                                                        <div class="input-group-append"
                                                             data-target="#end_time"
                                                             data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i
                                                                    class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>

                                                    <div class="clo-md-2">
                                                        <button type="submit"
                                                           class="btn btn-block btn-info">
                                                            {{ __('Query') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>

                                            <div class="row">
                                                <div class="clo-md-12">
                                                    &nbsp;
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="clo-md-12">
                                                    <div id="hot"></div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="clo-md-12">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="clo-md-2">
                                                    <a href="#" id="export-file"
                                                       class="btn btn-block btn-info">
                                                        {{ __('Download') }}
                                                    </a>
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
