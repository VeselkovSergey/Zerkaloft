@extends('app')

@section('content')

    <div class="flex mb-10">
        <a class="button-blue mr-5" href="{{route('user-orders-page')}}">Заказы</a>
        <a class="button-blue mr-5" href="{{route('user-settings-page')}}">Профиль</a>
        <a class="button-blue ml-a" href="{{route('logout')}}">Выход</a>
    </div>

    <div class="client-order-information p-25 border-radius-10 shadow scroll-auto">
        @yield('profile-content')
    </div>

@stop

@section('js')

@yield('profile-js-container')

@stop
