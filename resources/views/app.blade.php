@php
    $actionConditionAuth = !\Illuminate\Support\Facades\Auth::check() ? 'LoginPage()' : 'UserOrdersPage()';
@endphp

<!DOCTYPE html>
<html lang="ru">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta')

        <title>{{ isset($title_page) ? $title_page : env('APP_NAME') }}</title>

        <link href="{{asset('resources/css/helpers.css')}}" rel="stylesheet">
        <link href="{{asset('resources/css/loaders.css')}}" rel="stylesheet">

        <link href="{{asset('resources/css/app.css')}}" rel="stylesheet">

        <link href="{{asset('resources/css/adaptive.css')}}" rel="stylesheet">

        <link href="{{asset('fonts/fonts.css')}}" rel="stylesheet">

{{--        <link href="{{asset('resources/scss/app.scss')}}" rel="stylesheet">--}}

        @yield('css')

        <script src="{{ asset('resources/js/add.prototypes.js') }}"></script>

    </head>

    <body class="bg-logo-victoria">

        <header class="flex-wrap pos-sticky top-0 bg-white z-1 color-violet py-10">@include('layouts.header')</header>

        <div class="flash-message flash-message-error hide"></div>

        <nav class="left-menu hide z-2 pos-fix top-0 left-0 w-100 h-100">
            <div class="shadow-menu w-100 h-100 bg-black pos-abs" style="opacity: 0.5"></div>
            <div class="bg-white h-100 pos-rel" style="width: fit-content; max-width: calc(100% - 96px);">
                <div class="close-menu-button cp pos-abs top-0" style="right: -48px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                    </svg>
                </div>
                <div class="scroll-auto pr-25 h-100">
                    @foreach(\App\Models\Categories::all() as $category)
                        <div class="menu-category-container p-5 pos-rel">
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
                            <a class="p-5 w-100 color-black cp" href="{{route('calculator-page')}}">Онлайн заказ</a>
                            <a class="p-5 w-100 color-black cp" href="{{route('calculator-page')}}">Онлайн калькулятор</a>
                            <a class="p-5 w-100 color-black cp" href="{{route('about-page')}}">О компании</a>
                            <a class="p-5 w-100 color-black cp button-back-call" href="#">Обратный звонок</a>
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

        <script>
            const suggestionsProducts = "{{route('suggestion-products')}}";
        </script>

        <script src="{{ asset('resources/js/jsssss.js') }}"></script>

        @include('assets.js.main-script')


        @yield('js')

    </body>

</html>
