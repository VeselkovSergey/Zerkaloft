<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @yield('meta')

        <title>{{ isset($title_page) ? $title_page : env('APP_NAME') }}</title>

        @include('administration.assets.css.admin-style')
        @include('administration.assets.css.loader-style')

        @yield('css')

    </head>

    <body style="max-width: 100%;">

    <div class="modal hide-el" style="position: fixed; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1000;">
        <div class="modal-container" style="position: fixed; top: 10%; width: 100%; margin: auto; display: flex;">
            <div class="window-modal" style="margin: auto; /*background-color: white;*/ max-height: 80vh; overflow:auto;">
                <div class="modal-content">

                </div>
            </div>
        </div>
    </div>

        <div class="no-mobile-version">
            <h1>Версия для маленьких экранов в разработке</h1>
        </div>

        <header style="height: 100px; background-color: #1976d2; position: sticky; top: 0; z-index: 5; box-shadow: 0 3px 10px rgb(0 0 0);">
            @include('administration.layouts.header')
        </header>

        <nav style="position: absolute; top: 150px; left: 25px; width: 13%; box-shadow: 0 0 10px rgb(0 0 0 / 75%); padding: 25px;">
            <div>

                <div style="padding: 3px; position: relative;">
                    <div class="menu-category" style="border: 1px solid black; padding: 3px; cursor: pointer; border-radius: 3px;">Категории</div>
                    <div class="expander-menu-category" style="position: absolute; top: 11px; right: 11px; line-height: 1; transform: rotate(0.0turn); cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </div>
                    <div class="menu-category-detail hide-el">
                        <div style="display: flex; flex-direction: column; padding: 15px 0 25px 15px;">
                            <a href="{{route('categories-admin-page')}}">Все категории</a>
                            <a href="{{route('create-category-admin-page')}}">Новая категория</a>
                        </div>
                    </div>
                </div>

                <div style="padding: 3px; position: relative;">
                    <div class="menu-category" style="border: 1px solid black; padding: 3px; cursor: pointer; border-radius: 3px;">Подкатегории</div>
                    <div class="expander-menu-category" style="position: absolute; top: 11px; right: 11px; line-height: 1; transform: rotate(0.0turn); cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </div>
                    <div class="menu-category-detail hide-el">
                        <div style="display: flex; flex-direction: column; padding: 15px 0 25px 15px;">
                            <a href="{{route('subcategories-admin-page')}}">Все подкатегории</a>
                            <a href="{{route('create-subcategory-admin-page')}}">Новая подкатегория</a>
                        </div>
                    </div>
                </div>

                <div style="padding: 3px; position: relative;">
                    <div class="menu-category" style="border: 1px solid black; padding: 3px; cursor: pointer; border-radius: 3px;">Продукты</div>
                    <div class="expander-menu-category" style="position: absolute; top: 11px; right: 11px; line-height: 1; transform: rotate(0.0turn); cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </div>
                    <div class="menu-category-detail hide-el">
                        <div style="display: flex; flex-direction: column; padding: 15px 0 25px 15px;">
                            <a href="{{route('products-admin-page')}}">Все продукты</a>
                            <a href="{{route('create-product-admin-page')}}">Новый продукт</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main style="min-height: calc(100vh - 200px); margin: 25px 15% 0 15%;">

            @yield('content')

        </main>

{{--        <footer style="height: 100px;">--}}
{{--            @include('administration.layouts.footer')--}}
{{--        </footer>--}}

        @include('administration.assets.js.admin-script')

    @yield('js')

    </body>

</html>
