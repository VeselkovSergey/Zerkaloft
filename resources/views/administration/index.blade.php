<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('meta')

    {{--        <title>{{ isset($title_page) ? $title_page : env('APP_NAME') }}</title>--}}
    <title>Панель администратора</title>

    <link href="{{asset('resources/css/helpers.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/loaders.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/app.css')}}" rel="stylesheet">

    @include('administration.assets.css.admin-style')
    @include('administration.assets.css.loader-style')

    @yield('css')

    <script src="{{ asset('resources/js/add.prototypes.js') }}"></script>

</head>

<body class="w-100">

    <div class="modal hide-el pos-fix w-100 h-100 bg-white z-5">
        <div class="modal-container pos-fix w-100 m-a flex" style="top: 10%;">
            <div class="window-modal m-a" style="max-height: 80vh; overflow:auto;">
                <div class="modal-content">

                </div>
            </div>
        </div>
    </div>

    <header class="shadow bg-white pos-sticky top-0 z-5">@include('administration.layouts.header')</header>

    <div class="flash-message flash-message-error"></div>

    <nav class="w-20 shadow p-5" style="position: absolute; top: 80px; left: 10px;">
        <div class="p-5 pos-rel">
            <div class="menu-category border p-5 cp border-radius-5 border p-5 cp border-radius-5">Свойства категорий</div>
            <div class="expander-menu-category pos-abs  cp" style="transform: rotate(0.0turn); top: 10px; right:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </div>
            <div class="menu-category-detail hide-el">
                <div style="display: flex; flex-direction: column; padding: 15px 0 25px 15px;">
                    <a href="{{route('properties-categories-admin-page')}}">Все свойства</a>
                    <a href="{{route('create-property-categories-admin-page')}}">Новое свойство категорий</a>
                </div>
            </div>
        </div>

        <div class="p-5 pos-rel">
            <div class="menu-category border p-5 cp border-radius-5">Категории</div>
            <div class="expander-menu-category pos-abs  cp" style="transform: rotate(0.0turn); top: 10px; right:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </div>
            <div class="menu-category-detail hide-el">
                <div style="display: flex; flex-direction: column; padding: 15px 0 25px 15px;">
                    <a href="{{route('categories-admin-page')}}">Все категории</a>
                    <a href="{{route('create-category-admin-page')}}">Новая категория</a>
                </div>
            </div>
        </div>

{{--        <div class="p-5 pos-rel">--}}
{{--            <div class="menu-category border p-5 cp border-radius-5">Подкатегории</div>--}}
{{--            <div class="expander-menu-category pos-abs  cp" style="transform: rotate(0.0turn); top: 10px; right:10px;">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"--}}
{{--                     class="bi bi-chevron-right" viewBox="0 0 16 16">--}}
{{--                    <path fill-rule="evenodd"--}}
{{--                          d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>--}}
{{--                </svg>--}}
{{--            </div>--}}
{{--            <div class="menu-category-detail hide-el">--}}
{{--                <div style="display: flex; flex-direction: column; padding: 15px 0 25px 15px;">--}}
{{--                    <a href="{{route('subcategories-admin-page')}}">Все подкатегории</a>--}}
{{--                    <a href="{{route('create-subcategory-admin-page')}}">Новая подкатегория</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="p-5 pos-rel">
            <div class="menu-category border p-5 cp border-radius-5">Продукты</div>
            <div class="expander-menu-category pos-abs  cp" style="transform: rotate(0.0turn); top: 10px; right:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </div>
            <div class="menu-category-detail hide-el">
                <div style="display: flex; flex-direction: column; padding: 15px 0 25px 15px;">
                    <a href="{{route('products-admin-page')}}">Все продукты</a>
                    {{--                            <a href="{{route('create-product-admin-page')}}">Новый продукт</a>--}}
                </div>
            </div>
        </div>

        <div class="p-5 pos-rel">
            <div class="menu-category border p-5 cp border-radius-5">Настройки системы</div>
            <div class="expander-menu-category pos-abs  cp" style="transform: rotate(0.0turn); top: 10px; right:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </div>
            <div class="menu-category-detail hide-el">
                <div style="display: flex; flex-direction: column; padding: 15px 0 25px 15px;">
                    {{--                            <a href="{{route('edit-phone-main-page')}}">Номер телефона на главной странице</a>--}}
                    <a href="{{route('all-carousel-images-page')}}">Все картинки карусели</a>
                    <a href="{{route('create-carousel-image-page')}}">Создать картинку карусели</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="w-80 ml-a p-20">@yield('content')</main>

    @include('administration.assets.js.admin-script')

    @yield('js')

</body>

</html>
