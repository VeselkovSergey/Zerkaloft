<div class="logo-container flex-center mr-10">
    <a class="flex-center clear-a color-violet" href="{{route('home-page')}}">
        <img class="img-logo" src="{{route('files', \App\Http\Controllers\Administration\SettingsController::GetHeaderLogo()->imageFileId)}}" alt="logo">
    </a>
</div>

<div class="flex-center search-button-small-screen-container" style="width: 45%">
    <div  class="border-radius-5 p-5" style="border: 1px solid #2e3192; width: 100%;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search color-pink" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
        Поиск
    </div>
</div>

<div class="menu flex-center cp mr-10">
    <div class="flex-center border-radius-5 button-blue" style="padding: 4px 10px; display: flex;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
        <div class="ml-10 text-menu font-semibold">КАТАЛОГ</div>
    </div>
</div>

<div class="search-container-header flex-center hide" style="flex: 1;">
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

<div class="social-contact flex-column-center" style="justify-content: space-evenly;">
    <div class="flex-center social-contact-container">
        <img class="mx-10 additional-phones" width="20" data-additional-phones="{{$additionalPhones}}" src="{{url('icon/phone.svg')}}" alt="">
        <div class="callback button-back-call">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-telephone-inbound-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM15.854.146a.5.5 0 0 1 0 .708L11.707 5H14.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 1 0v2.793L15.146.146a.5.5 0 0 1 .708 0z"/>
            </svg>
        </div>
        <a class="mx-10" href="mailto:{{$mail}}?subject=Вопрос">
            <img class="mx-10" width="20" src="{{url('icon/mail.svg')}}" alt="">
        </a>
{{--        <a class="mx-10 hide viber" href="viber://chat?number=%2B{{$viberPhone}}">--}}
{{--            <img class="mx-10" width="24" src="{{url('icon/viber.svg')}}" alt="">--}}
{{--        </a>--}}
        <a class="mx-10 hide whatsapp" href="https://api.whatsapp.com/send/?phone={{$whatsappPhone}}">
            <img class="mx-10" width="24" src="{{url('icon/whatsapp.svg')}}" alt="">
        </a>
        <a  class="mx-10 hide telegram" href="https://t.me/{{$telegramPhone}}">
            <img class="mx-10" width="24" src="{{url('icon/telegram.svg')}}" alt="">
        </a>
    </div>
    <div class="phone-container-header flex-center font-semibold">
        <a class="text-center" style="text-decoration: none;" href="tel:{{$phone}}">{{$phone}}</a>
    </div>
</div>

<div class="container-basket-and-profile flex-column-center color-violet mr-10">
    <div class="flex-center basket-and-profile">
        <div class="button-basket flex-column-center text-center cp px-10">
            <a href="{{route('basket-page')}}" style="text-decoration: unset; color: unset;">
                <div class="pos-rel">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 459.529 459.529">
                        <path d="M17,55.231h48.733l69.417,251.033c1.983,7.367,8.783,12.467,16.433,12.467h213.35c6.8,0,12.75-3.967,15.583-10.2
                                    l77.633-178.5c2.267-5.383,1.7-11.333-1.417-16.15c-3.117-4.817-8.5-7.65-14.167-7.65H206.833c-9.35,0-17,7.65-17,17
                                    s7.65,17,17,17H416.5l-62.9,144.5H164.333L94.917,33.698c-1.983-7.367-8.783-12.467-16.433-12.467H17c-9.35,0-17,7.65-17,17
                                    S7.65,55.231,17,55.231z"/>
                        <path d="M135.433,438.298c21.25,0,38.533-17.283,38.533-38.533s-17.283-38.533-38.533-38.533S96.9,378.514,96.9,399.764
                                    S114.183,438.298,135.433,438.298z"/>
                        <path d="M376.267,438.298c0.85,0,1.983,0,2.833,0c10.2-0.85,19.55-5.383,26.35-13.317c6.8-7.65,9.917-17.567,9.35-28.05
                                    c-1.417-20.967-19.833-37.117-41.083-35.7c-21.25,1.417-37.117,20.117-35.7,41.083
                                    C339.433,422.431,356.15,438.298,376.267,438.298z"/>
                    </svg>
                    <div class="count-item-in-bag hide color-black pos-abs right-0 p-5">
                        0
                    </div>
                </div>
                <div class="text-center text-basket">
                    Корзина
                </div>
            </a>
        </div>
        <div onclick="{{$actionConditionAuth}}" class="container-profile flex-column-center text-center cp px-10">
            <div class="profile-svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                </svg>
            </div>
            <div class="text-center text-profile">
                @if(\Illuminate\Support\Facades\Auth::check())
                    Профиль
                @else
                    Вход
                @endif
            </div>
        </div>
    </div>
</div>

@php
    $fastMenuSetting = \App\Http\Controllers\Administration\SettingsController::GetFastMenu();
@endphp

<div class="fast-menu flex-center w-100 font-semibold" style="justify-content: space-around; padding:5px 15%;">
    <a class="cp text-center {{$fastMenuSetting->fastOrderLink === 'true' ? '' : ' hide '}}" href="{{route('fast-order-page')}}">Быстрое оформление</a>
    <a class="cp text-center {{$fastMenuSetting->onlineOrderLink === 'true' ? '' : ' hide '}}" href="{{route('online-order')}}">Онлайн заказ</a>
    <a class="cp text-center form-special-order {{$fastMenuSetting->specialOrderLink === 'true' ? '' : ' hide '}}" href="#special-order">Индивидульный заказ</a>
    <a class="cp text-center {{$fastMenuSetting->calculatorLink === 'true' ? '' : ' hide '}}" href="{{route('calculator-page')}}">Онлайн калькулятор</a>
    <a class="cp text-center" href="{{route('about-page')}}">О компании</a>
</div>


<div class="pos-rel w-100">
    <button class="pos-abs button-back-call header button-blue text-center border border-radius-5 cp" style="right: 10px; top: -25px;">
        Обратный звонок
    </button>
</div>
