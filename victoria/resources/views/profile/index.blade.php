@extends('app')

@section('content')


    <div style="padding: 25px 0;">

        <div>

            <div style="display: flex;">
                <div style="">
                    <div style="padding: 10px;">
                        <div style="font-weight: bold; font-size: 20px; text-align: center;">
                            <a href="{{route('user-orders-page')}}">
                                <button class="button-blue" style="margin: auto;">Заказы</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div style="">
                    <div style="padding: 10px;">
                        <div style="font-weight: bold; font-size: 20px; text-align: center;">
                            <a href="{{route('user-settings-page')}}">
                                <button class="button-blue" style="margin: auto;">Профиль</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div style="margin-left: auto;">
                    <div style="padding: 10px;">
                        <div style="font-weight: bold; font-size: 20px; text-align: center;">
                            <a href="{{route('logout')}}">
                                <button class="button-blue" style="margin: auto;">Выход</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div style="padding: 25px;">

                <div style="display: flex; width: 100%; border-radius: 15px; box-shadow: 0 0 10px rgb(0 0 0 / 75%); flex-wrap: wrap; padding: 25px;" class="client-order-information">

                    @yield('profile-content')

                </div>

            </div>

    </div>


@stop

@section('js')



@yield('profile-js-container')

@stop
