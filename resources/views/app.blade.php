<!DOCTYPE html>
<html lang="ru">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @yield('meta')

        <title>{{ isset($title_page) ? $title_page : env('APP_NAME') }}</title>

        <link href="{{asset('resources/css/helpers.css')}}" rel="stylesheet">
        <link href="{{asset('resources/css/loaders.css')}}" rel="stylesheet">

        <link href="{{asset('resources/css/app.css')}}" rel="stylesheet">

        <link href="{{asset('resources/scss/app.scss')}}" rel="stylesheet">

{{--        @include('assets.css.main-style')--}}
{{--        @include('assets.css.loader-style')--}}

        @yield('css')

    </head>

    <body  style="background-image: url('img/bg.jpeg');background-repeat: no-repeat;background-size: contain;background-attachment: fixed;">

    <div class="modal hide-el">

        <div class="modal-flash-message hide-el">

            <div class="modal-flash-message-content">
            </div>

        </div>

        <div class="modal-container">
            <div class="window-modal">

                <div class="modal-close-button">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M12.6365 13.3996L13.4001 12.636L7.76373 6.99961L13.4001 1.36325L12.6365 0.599609L7.0001 6.23597L1.36373 0.599609L0.600098 1.36325L6.23646 6.99961L0.600098 12.636L1.36373 13.3996L7.0001 7.76325L12.6365 13.3996Z"
                              fill="#000000"></path>
                    </svg>
                </div>

                <div class="modal-content">
                </div>

            </div>
        </div>

    </div>

        <div class="no-mobile-version">
            <h1>Версия для маленьких экранов в разработке</h1>
        </div>

        <header style="">
            @include('layouts.header')
        </header>

        <div class="flash-message flash-message-error hide-el">
1
        </div>

        <nav class="left-menu">
            <div>
                @foreach(\App\Models\Categories::all() as $category)

                    <div class="menu-category-container p-5 pos-rel">
                        <div class="title-category-container bg-white">
                            <div class="menu-category p-5 pr-25 cp border-radius-5">{{$category->title}}</div>
                            <div class="expander-menu-category pos-abs" style="top: 11px; right: 11px; transform: rotate(0.0turn); cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="children-category hide-el">
                            @foreach(\App\Models\Subcategories::where('category_id', $category->id)->get() as $subcategory)
                                <div style="padding: 3px; position: relative;" class="menu-subcategory-container">

                                    <div class="title-subcategory-container bg-white">
                                        <div class="menu-subcategory p-5 pr-25 cp border-radius-5">{{$subcategory->title}}</div>
                                        <div class="expander-menu-subcategory pos-abs cp" style="top: 11px; right: 11px; transform: rotate(0.0turn);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="children-subcategory hide-el">
                                        @foreach(\App\Models\Products::where('subcategory_id', $subcategory->id)->get() as $product)
                                            <div class="menu-product">
                                                <div style="display: flex; flex-direction: column; padding: 5px 0 5px 25px;">
                                                    <a href="{{route('product', [$category->semantic_url, $subcategory->semantic_url, $product->semantic_url])}}" class="bg-white p-5 color-black" style="text-decoration: none;">{{$product->title}}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                @endforeach

            </div>
        </nav>

        <main class="m-25">

            @yield('content')

        </main>

{{--        <footer style="height: 100px;">--}}
{{--            @include('layouts.footer')--}}
{{--        </footer>--}}

        @include('assets.js.main-script')

    <script src="{{ asset('resources/js/jsssss.js') }}"></script>

    @yield('js')

    </body>

</html>
