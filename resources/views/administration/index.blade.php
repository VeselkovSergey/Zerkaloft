<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta')

    <title>Панель администратора</title>

    <link href="{{asset('resources/css/helpers.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/loaders.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/modal.css')}}" rel="stylesheet">

    @yield('css')

    <script src="{{ asset('resources/js/add.prototypes.js') }}"></script>

</head>

<body class="w-100">

    <header class="shadow bg-white pos-sticky top-0">@include('administration.layouts.header')</header>

    <div class="flash-message flash-message-error hide"></div>

        <?php
        $adminMenu = [
            [
                'title' => 'Свойства категорий',
                'subMenu' => [
                    [
                        'title' => 'Все свойства',
                        'link' => route('properties-categories-admin-page'),
                    ],
                    [
                        'title' => 'Новое свойство категорий',
                        'link' => route('create-property-categories-admin-page'),
                    ],
                ],
            ],
            [
                'title' => 'Категории',
                'subMenu' => [
                    [
                        'title' => 'Все категории',
                        'link' => route('categories-admin-page'),
                    ],
                    [
                        'title' => 'Новая категория',
                        'link' => route('create-category-admin-page'),
                    ],
                ],
            ],
            [
                'title' => 'Продукты',
                'subMenu' => [
                    [
                        'title' => 'Все продукты',
                        'link' => route('products-admin-page'),
                    ],
                    [
                        'title' => 'Выгрузить в CSV',
                        'link' => route('products-to-csv'),
                    ],
//                    [
//                        'title' => 'Новый продукт',
//                        'link' => route('create-product-admin-page'),
//                    ],
                ],
            ],
            [
                'title' => 'Дополнительные услуги',
                'subMenu' => [
                    [
                        'title' => 'Все дополнительные услуги',
                        'link' => route('additional-services-admin-page'),
                    ],
                    [
                        'title' => 'Новая дополнительная услуга',
                        'link' => route('create-additional-service-page'),
                    ],
                ],
            ],
            [
                'title' => 'Фильтры',
                'subMenu' => [
                    [
                        'title' => 'Все фильтры',
                        'link' => route('filters-admin-page'),
                    ],
                    [
                        'title' => 'Новый фильтр',
                        'link' => route('create-filters-page'),
                    ],
                ],
            ],
            [
                'title' => 'Галерея',
                'subMenu' => [
                    [
                        'title' => 'Галерея',
                        'link' => route('gallery-admin-page'),
                    ],
                    [
                        'title' => 'Новая работа',
                        'link' => route('create-gallery-page'),
                    ],
                ],
            ],
            [
                'title' => 'Настройки системы',
                'subMenu' => [
                    [
                        'title' => 'Все картинки карусели',
                        'link' => route('all-carousel-images-page'),
                    ],
                    [
                        'title' => 'Создать картинку карусели',
                        'link' => route('create-carousel-image-page'),
                    ],
                    [
                        'title' => 'Текста',
                        'link' => route('texts'),
                    ],
                    [
                        'title' => 'Номера телефонов и почта',
                        'link' => route('edit-phone-page'),
                    ],
                ],
            ],
            [
                'title' => 'Пользователи',
                'subMenu' => [
                    [
                        'title' => 'Все пользователи',
                        'link' => route('all-users-page'),
                    ],
                ],
            ],
        ];
        ?>

    <nav class="left-menu hide z-2 pos-fix top-0 left-0 w-100 h-100">
        <div class="shadow-menu w-100 h-100 bg-black pos-abs" style="opacity: 0.5"></div>
        <div class="left-menu-content-container bg-white h-100 pos-rel" style="width: fit-content; max-width: calc(100% - 96px);">
            <div class="close-menu-button cp pos-abs top-0" style="right: -48px">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                </svg>
            </div>
            <div class="scroll-auto pr-25 h-100">
                @foreach($adminMenu as $menuItem)
                    <div class="menu-category-container p-5 pos-rel main-left-menu">
                        <div class="title-category-container ">
                            <div class="menu-category p-5 pr-25 cp border-radius-5">{{$menuItem['title']}}</div>
                            <div class="expander-menu-category pos-abs cp" style="top: 11px; right: 11px; transform: rotate(0.0turn);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="menu-category-detail hide">
                            @foreach($menuItem['subMenu'] as $subMenuItem)
                                <div class="pl-10 py-5 cp">
                                    <a class="link-menu clear-a color-violet" href="{{$subMenuItem['link']}}">{{$subMenuItem['title']}}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </nav>

    <main class="p-20">@yield('content')</main>

    @include('assets.js.main-script')

    @yield('js')

</body>

</html>
