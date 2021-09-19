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

        @yield('css')

    </head>

    <body class="bg-logo-victoria">

        <div class="modal hide-el">
        <div class="modal-flash-message hide-el">
            <div class="modal-flash-message-content"></div>
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
                <div class="modal-content"></div>
            </div>
        </div>
    </div>

        <header class="flex-wrap pos-sticky top-0 bg-white z-1">@include('layouts.header')</header>

        <div class="flash-message flash-message-error hide-el"></div>

        <nav class="left-menu hide z-2 pos-fix top-0 left-0 w-100 h-100">
            <div class="shadow-menu w-100 h-100 bg-black pos-abs" style="opacity: 0.5"></div>
            <div class="bg-white h-100 pos-rel pr-25" style="width: fit-content;">
                <div class="close-menu-button cp pos-abs top-0" style="right: -48px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                    </svg>
                </div>
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
                        <div class="children-category hide-el">
                            @foreach(\App\Models\Subcategories::where('category_id', $category->id)->get() as $subcategory)
                                <div class="menu-subcategory-container p-5 pos-rel">
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

        <main class="m-25">@yield('content')</main>

        @include('assets.js.main-script')

        <script src="{{ asset('resources/js/jsssss.js') }}"></script>

        @yield('js')

    </body>

</html>
