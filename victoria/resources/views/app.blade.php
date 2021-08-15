<!DOCTYPE html>
<html lang="ru">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @yield('meta')

        <title>{{ isset($title_page) ? $title_page : env('APP_NAME') }}</title>

        @include('assets.css.main-style')
        @include('assets.css.loader-style')

        @yield('css')

    </head>

    <body>

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

        <header>
            @include('layouts.header')
        </header>

        <div class="flash-message flash-message-error hide-el">
1
        </div>

        <nav class="left-menu">
            <div>
                @foreach(\App\Models\Categories::all() as $category)

                    <div class="menu-category-container" style="padding: 3px; position: relative;">
                        <div class="title-category-container" style="background-color: #00aff2;">
                            <div class="menu-category" style="/*border: 1px solid black;*/ padding: 3px; cursor: pointer; border-radius: 3px;">{{$category->title}}</div>
                            <div class="expander-menu-category" style="position: absolute; top: 11px; right: 11px; line-height: 1; transform: rotate(0.0turn); cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="children-category hide-el">
                            @foreach(\App\Models\Subcategories::where('category_id', $category->id)->get() as $subcategory)
                                <div style="padding: 3px; position: relative;" class="menu-subcategory-container">

                                    <div class="title-subcategory-container" style="background-color: #fff200;">
                                        <div class="menu-subcategory" style="/*border: 1px solid black;*/ padding: 3px; cursor: pointer; border-radius: 3px;">{{$subcategory->title}}</div>
                                        <div class="expander-menu-subcategory" style="position: absolute; top: 11px; right: 11px; line-height: 1; transform: rotate(0.0turn); cursor: pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="children-subcategory hide-el">
                                        @foreach(\App\Models\Products::where('subcategory_id', $subcategory->id)->get() as $product)
                                            <div class="menu-product">
                                                <div style="display: flex; flex-direction: column; padding: 5px 0 5px 25px;">
                                                    <a href="{{route('product', [$category->semantic_url, $subcategory->semantic_url, $product->semantic_url])}}" style="background-color: #ff0090; padding: 3px; color: black; text-decoration: none;">{{$product->title}}</a>
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

        <main style="min-height: calc(100vh - 200px); margin: 25px 15% 0 15%;">

            @yield('content')

        </main>

        <footer style="height: 100px;">
            @include('layouts.footer')
        </footer>

        @include('assets.js.main-script')

    @yield('js')

    </body>

</html>
