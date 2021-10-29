<div class="logo-container flex-center mr-10">
    <a class="flex-center clear-a color-violet" href="{{route('home-page')}}">
        <img width="100" src="{{url('img/logo.jpeg')}}" alt="logo">
        <div class="flex-column-center ml-10">
            <div class="font-semibold" style="font-size: 3em;">Victoria</div>
            <div>Рекламное агенство</div>
        </div>
    </a>
</div>

<div class="menu flex-center cp mr-10">
    <div class="flex-center border-radius-5" style="border: 1px solid #2e3192; padding: 4px 10px">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
        <div class="ml-10 text-menu font-semibold">КАТАЛОГ</div>
    </div>
</div>

<div class="search-container-header flex-center mr-10" style="flex: 1;">
    <div class="pos-rel w-100">
        <div class="pos-abs" style="top: 11px; left: 10px; color: grey;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search color-pink" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </div>
        <input class="main-search-input w-100 p-10 border-radius-5" style="border: 1px solid #2e3192; text-indent: 30px;" type="text">
        <div class="delete-value-search-input hide pos-abs cp" style="top: 9px; right: 10px; color: grey;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </div>
    </div>
</div>


<div class="flex-column-center mr-10">
    <div class="flex-center social-contact">
        <img class="mx-5" width="32" src="{{url('icon/telegram.svg')}}" alt="">
        <img class="mx-5" width="32" src="{{url('icon/viber.svg')}}" alt="">
        <img class="mx-5" width="32" src="{{url('icon/whatsapp.svg')}}" alt="">
    </div>
    <div class="phone-container-header flex-center font-semibold pt-25">
        <a class="text-center" style="text-decoration: none;" href="tel:{{env('PHONE_COMPANY')}}">{{env('PHONE_COMPANY')}}</a>
    </div>
</div>

<div class="flex-column-center" style="justify-content: space-between;">
    @php
        $actionConditionAuth = !\Illuminate\Support\Facades\Auth::check() ? 'LoginPage()' : 'UserOrdersPage()';
    @endphp
    <div class="flex-center">
        <div class="button-basket flex-column-center text-center cp p-5 mx-10">
            <a href="{{route('basket-page')}}" style="text-decoration: unset; color: unset;">
                <div class="pos-rel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <div class="count-item-in-bag hide color-black pos-abs right-0 p-5" style="background-color: #ec407a;border-radius: 100px;top: -10px;min-width: 26px;">
                        0
                    </div>
                </div>
                <div class="text-center">
                    Корзина
                </div>
            </a>
        </div>
        <div onclick="{{$actionConditionAuth}}" class="container-profile flex-column-center text-center cp p-5 mx-10">
            <div class="profile-svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                </svg>
            </div>
            <div class="text-center">
                @if(\Illuminate\Support\Facades\Auth::check())
                    Профиль
                @else
                    Вход
                @endif
            </div>
        </div>
    </div>
    <button class="button-back-call button-blue text-center p-5 border border-radius-5 cp">
        Обратный звонок
    </button>
</div>

<div class="fast-menu flex-center w-100 font-semibold" style="justify-content: space-between; padding:5px 15%;">
    <a class="cp text-center" href="#">Быстрое оформление</a>
    <a class="cp text-center" href="{{route('online-order')}}">Онлайн заказ</a>
    <a class="cp text-center form-fast-order" href="#">Индивидульный заказ</a>
    <a class="cp text-center" href="{{route('calculator-page')}}">Онлайн калькулятор</a>
    <a class="cp text-center" href="{{route('about-page')}}">О компании</a>
</div>
