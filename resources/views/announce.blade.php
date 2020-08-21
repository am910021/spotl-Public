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

                </div>

                <div class="col-md-6">
                    <div class="row sub-row">
                        <div class="col-md-12 sub-block">

                            <div class="row">
                                <div class="col-md-12">
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

                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <span>發布時間:2020/08/07</span>
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
