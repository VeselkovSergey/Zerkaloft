<div style="height: 100%; display: flex; /*margin: 0 20%;*/">

    <a class="logo-container" href="{{route('home-page')}}">
        <div class="logo"></div>
    </a>

{{--    <div class="menu-mobile" style="/*display: flex;*/ display: none; justify-content: center; align-items: center; padding: 0 32px;">--}}

{{--        <div class="menu-btn" style="line-height: 1;">--}}
{{--            <svg style="border: 2px solid; border-radius: 4px; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="48" height="32" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">--}}
{{--                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>--}}
{{--            </svg>--}}
{{--            <div style="width: 100%; text-align: center; font-size: 14px;">--}}
{{--                Меню--}}
{{--            </div>--}}
{{--        </div>--}}



{{--        <style>--}}
{{--            /*.menu-container::-webkit-scrollbar {*/--}}
{{--            /*    width: 12px;               !* width of the entire scrollbar *!*/--}}
{{--            /*}*/--}}

{{--            /*.menu-container::-webkit-scrollbar-track {*/--}}
{{--            /*    background: #a4a4a4;        !* color of the tracking area *!*/--}}
{{--            /*}*/--}}

{{--            /*.menu-container::-webkit-scrollbar-thumb {*/--}}
{{--            /*    background-color: #606060;    !* color of the scroll thumb *!*/--}}
{{--            /*}*/--}}
{{--            /*.menu-container::-webkit-scrollbar-thumb:hover {*/--}}
{{--            /*    background-color: #818181;    !* color of the scroll thumb *!*/--}}
{{--            /*}*/--}}
{{--            /*.menu:hover>.menu-container {*/--}}
{{--            /*    display: block;*/--}}
{{--            /*}*/--}}
{{--            .menu-btn:active {--}}
{{--                transform: scale(1.05);--}}
{{--            }--}}
{{--            .menu-container {--}}
{{--                display: none;--}}
{{--            }--}}
{{--            .menu-container a {--}}
{{--                color: #000;--}}
{{--                text-decoration: none;--}}
{{--            }--}}
{{--            .menu-container a:hover {--}}
{{--                color: #e91e63;--}}
{{--                text-decoration: none;--}}
{{--            }--}}
{{--        </style>--}}

{{--        <div class="menu-container" style="box-shadow: 0 0 35px rgb(0 0 0); position: absolute; width: 60%; height: 350px; background-color: #c3c3c3; top: 110px; left: 20%; overflow: auto;">--}}
{{--            <div style="padding: 15px 30px; display: flex; flex-wrap: wrap;">--}}

{{--                @for($i = 0; $i < 10; $i++)--}}
{{--                    <div style="width: 25%; padding-bottom: 15px;">--}}

{{--                        <div style="font-weight: bold;">Печатная реклама</div>--}}
{{--                        <div style="padding-left: 15px;">--}}
{{--                            <a href="#" style="display: block;">Визитки</a>--}}
{{--                            <a href="#" style="display: block;">Листовки</a>--}}
{{--                            <a href="#" style="display: block;">Буклеты</a>--}}
{{--                            <a href="#" style="display: block;">Брошюры</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                @endfor--}}

{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}

    <div style="margin: auto; width: 100%;">
        <div style="position: relative; top: 10px;">
            <div style="position: absolute; top: 10px; left: 10px; color: grey;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </div>
            <input class="main-search-input" style="width: 100%; border: none; padding: 10px; border-radius: 5px; text-indent: 30px;" type="text" placeholder="Поиск" value="">
            <div class="delete-value-search-input hide-el" style="position: absolute; top: 10px; right: 10px; cursor: pointer; color: grey;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </div>

            <div class="fast-menu" style="display: flex; justify-content: center;">
                <a href="#" style="display: block;">Услуги</a>
                <a href="#" style="display: block;">Онлайн калькулятор</a>
                <a href="#" style="display: block;">Быстрое оформление</a>
                <a href="#" style="display: block;">О компании</a>
            </div>
        </div>
    </div>

    <div style="display: flex; width: 20%; justify-content: center; align-items: center; line-height: 1;">
        @php
            $actionConditionAuth = !\Illuminate\Support\Facades\Auth::check() ? 'LoginPage()' : 'UserOrdersPage()';
        @endphp
        <div onclick="{{$actionConditionAuth}}" class="container-profile" style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; padding: 0 16px; text-align: center; cursor: pointer;">
            <div style="width: 100%;">
                <svg style="/*border: 2px solid; border-radius: 4px;*/" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                </svg>
            </div>

            <div style="width: 100%; text-align: center; font-size: 14px;">
                @if(\Illuminate\Support\Facades\Auth::check())
                    Профиль
                @else
                    Вход
                @endif
            </div>
        </div>
        <div class="button-basket" style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; padding: 0 16px; text-align: center; cursor: pointer;">
            <a href="{{route('basket-page')}}" style="text-decoration: unset; color: unset;">

                <div style="width: 100%; position: relative;">
                    <svg style="/*border: 2px solid; border-radius: 4px;*/" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                        <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    <div class="count-item-in-bag hide-el" style="position: absolute;background-color: #ec407a;border-radius: 100px;top: -10px;padding: 5px;right: 0px; min-width: 26px;">
                        0
                    </div>
                </div>
                <div style="width: 100%; text-align: center; font-size: 14px;">
                    Корзина
                </div>

            </a>
        </div>
    </div>

    <div style="display: flex; width: 25%; justify-content: center; align-items: center; line-height: 1;">
        <a style="color: #000; text-decoration: none; font-size: 24px;" href="tel:+79999999999"> +7 (999) 999-99-99 </a>
    </div>

</div>
