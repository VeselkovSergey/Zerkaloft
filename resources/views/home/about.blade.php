@extends('app')

@section('content')

    @php($title_page = 'О компании')

    <div class="flex-center">

{{--        <pre>--}}

        <div class="about-text">

            {!! $aboutPage->text !!}

{{--        </pre>--}}
        </div>

    </div>



@stop

@section('js')

@stop
