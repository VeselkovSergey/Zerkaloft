<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta')

        <title>Панель управления</title>

        <link href="{{asset('resources/css/helpers.css')}}" rel="stylesheet">
        <link href="{{asset('resources/css/loaders.css')}}" rel="stylesheet">
        <link href="{{asset('resources/css/app.css')}}" rel="stylesheet">

        @yield('css')

        <script src="{{ asset('resources/js/add.prototypes.js') }}"></script>

    </head>

    <body class="w-100">

        <header class="shadow bg-white pos-sticky top-0 z-5">@include('management.layouts.header')</header>

        <div class="flash-message flash-message-error hide"></div>

        <nav class="w-20 shadow p-5 border-radius-5 pos-abs">

            <?php
            $adminMenu = [
                [
                    'title' => 'Заказы',
                    'subMenu' => [
                        [
                            'title' => 'Все заказы',
                            'link' => route('orders-management-page'),
                        ],
                    ],
                ],
                [
                    'title' => 'Заказы обратного звонка',
                    'subMenu' => [
                        [
                            'title' => 'Все заказы',
                            'link' => route('all-callback-orders'),
                        ],
                    ],
                ],
            ];
            ?>

            @foreach($adminMenu as $menuItem)
                <div class="menu-category-container p-5">
                    <div class="flex-center border cp p-5 border-radius-5">
                        <div class="menu-category flex-a">{{$menuItem['title']}}</div>
                        <div class="expander-menu-category flex-center" style="transform: rotate(0.0turn);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="menu-category-detail hide">
                        <div class="pl-10 py-10">
                            @foreach($menuItem['subMenu'] as $subMenuItem)
                                <a class="block" href="{{$subMenuItem['link']}}">{{$subMenuItem['title']}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </nav>

        <main class="w-80 ml-a p-20">@yield('content')</main>

        <script src="{{ asset('resources/js/jsssss.js') }}"></script>

        @yield('js')

    </body>

</html>
