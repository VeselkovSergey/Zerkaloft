@php
    $actionConditionAuth = !\Illuminate\Support\Facades\Auth::check() ? 'LoginPage()' : 'UserOrdersPage()';

    $phone = \App\Models\Settings::where('type', \App\Models\Settings::TypeByWords['mainPhone'])->first();
    $phone = json_decode($phone->value)->phone;

    $additionalPhones = \App\Models\Settings::where('type', \App\Models\Settings::TypeByWords['additionalPhones'])->first();
    $additionalPhones = json_decode($additionalPhones->value)->additionalPhones;

    $viberPhone = \App\Models\Settings::where('type', \App\Models\Settings::TypeByWords['viberPhone'])->first();
    $viberPhone = json_decode($viberPhone->value)->viberPhone;

    $whatsappPhone = \App\Models\Settings::where('type', \App\Models\Settings::TypeByWords['whatsappPhone'])->first();
    $whatsappPhone = json_decode($whatsappPhone->value)->whatsappPhone;

    $telegramPhone = \App\Models\Settings::where('type', \App\Models\Settings::TypeByWords['telegramPhone'])->first();
    $telegramPhone = json_decode($telegramPhone->value)->telegramPhone;

    $mail = \App\Models\Settings::where('type', \App\Models\Settings::TypeByWords['mail'])->first();
    $mail = json_decode($mail->value)->mail;
@endphp

<!DOCTYPE html>
<html lang="ru">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="yandex-verification" content="1bc095e408e6a616" />

        <meta name="description" content="{{isset($metaDescription) ? $metaDescription : 'Рекламное агенство'}}">

        @yield('meta')

        <title>{{ isset($title_page) ? $title_page : env('APP_NAME') }}</title>

        <link href='{{ route('sitemap') }}' rel='alternate' title='Sitemap' type='application/rss+xml'/>

        <link href="{{asset('resources/css/helpers.css')}}" rel="stylesheet">
        <link href="{{asset('resources/css/loaders.css')}}" rel="stylesheet">

        <link href="{{asset('resources/css/app.css')}}" rel="stylesheet">

        <link href="{{asset('resources/css/adaptive.scss')}}" rel="stylesheet">

        <link href="{{asset('fonts/fonts.css')}}" rel="stylesheet">

{{--        <link href="{{asset('resources/scss/app.scss')}}" rel="stylesheet">--}}

        @yield('css')

        <script src="{{ asset('resources/js/add.prototypes.js') }}"></script>

    </head>

    <body class="bg-logo-victoria {{--scroll-off--}}">

{{--        <div class="loader bg-blue pos-abs top-0 left-menu z-5 w-100 h-100">--}}
{{--            <div class="flex-center w-100vw h-100vh">--}}
{{--                <img src="{{url('img/oval.svg')}}" alt="">--}}
{{--            </div>--}}
{{--        </div>--}}

        <header class="flex-wrap pos-sticky top-0 bg-white z-1 color-violet p-5">@include('layouts.header')</header>

        <div class="flash-message flash-message-error hide"></div>

        <nav class="left-menu hide z-2 pos-fix top-0 left-0 w-100 h-100">
            <div class="shadow-menu w-100 h-100 bg-black pos-abs" style="opacity: 0.5"></div>
            <div class="left-menu-content-container bg-white h-100 pos-rel" style="width: fit-content; max-width: calc(100% - 96px);">
                <div class="close-menu-button cp pos-abs top-0" style="right: -48px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                    </svg>
                </div>
                <div class="scroll-auto pr-25 h-100">
                    @foreach(\App\Models\Categories::all() as $category)
                        <div class="menu-category-container p-5 pos-rel main-left-menu">
                            <div class="title-category-container ">
                                <div class="menu-category p-5 pr-25 cp border-radius-5">{{$category->title}}</div>
                                <div class="expander-menu-category pos-abs cp" style="top: 11px; right: 11px; transform: rotate(0.0turn);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="menu-category-detail hide">
                                @foreach($category->Products as $product)
                                    <div class="pl-10 py-5 cp">
                                        <a class="link-menu clear-a color-violet" href="{{route('product', [$category->semantic_url, $product->semantic_url])}}">{{$product->title}}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div class="fast-menu-in-left-menu">
                        <div class="flex-column p-5">
                            <a class="p-5 w-100 color-black cp" href="{{route('fast-order-page')}}">Быстрое оформление</a>
                            <a class="p-5 w-100 color-black cp" href="{{route('online-order')}}">Онлайн заказ</a>
                            <a class="p-5 w-100 color-black cp" href="{{route('calculator-page')}}">Онлайн калькулятор</a>
                            <a class="p-5 w-100 color-black cp" href="{{route('about-page')}}">О компании</a>
                            <a class="p-5 w-100 color-black cp button-back-call" href="#">Обратный звонок</a>
                            <a class="p-5 w-100 color-black cp" href="https://api.whatsapp.com/send/?phone=79999999999">WhatsApp</a>
                            <a class="p-5 w-100 color-black cp" href="https://tele.click/STigranS">Телеграм</a>
                            <a class="p-5 w-100 color-black cp" href="{{route('basket-page')}}">Корзина</a>
                            <a class="p-5 w-100 color-black cp" href="#" onclick="{{$actionConditionAuth}}">
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    Профиль
                                @else
                                    Вход
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="m-25">@yield('content')</main>

        <footer>@include('layouts.footer')</footer>

        <script>
            const suggestionsProducts = "{{route('suggestion-categories-and-products')}}";
            const createCallbackOrderRequestRoute = "{{route('create-callback-order')}}";
        </script>

        <script>
            // const loader = document.body.querySelector('.loader');
            // window.onload = () => {
            //     loader.hide();
            //     document.body.classList.remove('scroll-off');
            // }

            if (window.outerWidth <= 540) {
                const containerBasketAndProfile = document.body.querySelector('.container-basket-and-profile');
                const footer = document.body.querySelector('footer');
                document.body.insertBefore(containerBasketAndProfile, footer);
                let additionalPhones = CreateElement('div', {class: 'button-blue call-me w-100 text-center additional-phones', content: 'Позвонить'}, containerBasketAndProfile);
                additionalPhones.dataset.additionalPhones="{{$additionalPhones}}";
            }

        </script>

        <script src="{{ asset('resources/js/jsssss.js') }}"></script>

        @include('assets.js.main-script')


        @yield('js')

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(87637156, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/87637156" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    </body>

</html>
