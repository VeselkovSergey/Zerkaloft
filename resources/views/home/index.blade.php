@extends('app')

@section('content')

    <div>

        @if(!isset($searchQuery))

            @if(isset($carouselImages))
                {{--Для онлайн заказа (та же страница но без слайдера)--}}

                @if(count($carouselImages))

                    <div class="carousel mx-a mb-25">

                        <div class="carousel-container shadow border-radius-15 flex">
                            @foreach($carouselImages as $carouselImage)
                                <a href="{{$carouselImage->link}}" class="img-carousel">
                                    <img src="{{route('files', $carouselImage->fileId)}}" class="w-100 h-100" alt="">
                                </a>
                            @endforeach
                        </div>

                        <div class="container-btn-slider" style="position: absolute; top: calc(50% - 24px); left: 24px;">
                            <div class="btn-slider btn-slider-prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                                </svg>
                            </div>
                        </div>

                        <div class="container-btn-slider" style="position: absolute; top: calc(50% - 24px); right: 24px;">
                            <div class="btn-slider btn-slider-next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                                    <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                </svg>
                            </div>
                        </div>

                    </div>

                @endif

            @else

                <div class="font-semibold text-center">
                    {{\App\Http\Controllers\Administration\SettingsController::OnlineOrderInfo()->text}}
                </div>

            @endif

        @endif


        <div class="flex-wrap-center w-100">

            @php
                if (isset($searchQuery)) {
                    $products = \App\Models\Products::where('search_words', 'like', '%' . $searchQuery . '%')->get();
                } else {
                    $products = \App\Models\Products::where('show_main_page', 1)->get();
                }
            @endphp

            @foreach($products as $product)

                <div class="category-cart-main-page p-25">
                    <div class="smooth-block shadow pos-rel border-radius-15 mx-a w-100 h-100">
                        <a href="{{$product->Link()}}">
                            <img class="category-img-main" src="{{$product->FirstImgUrl()}}" alt="Изображение {{$product->title}}">
                            <div class="shadow-text w-100 h-100 flex-center border-radius-15 pos-abs top-0">
                                <div class="color-white text-center" style="font-size: 24px;">
                                    {{$product->title}}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            @endforeach

            @php
                if (isset($searchQuery)) {
                    $categories = \App\Models\Categories::where('search_words', 'like', '%' . $searchQuery . '%')->get();
                } else {
                    $categories = \App\Models\Categories::orderBy('sequence')->get();
                }
            @endphp

            @foreach($categories as $category)

                @foreach(unserialize($category->img) as $img)

                    <div class="category-cart-main-page p-25">

                        <div class="smooth-block shadow pos-rel border-radius-15 mx-a w-100 h-100">
                            <a href="{{route('category', $category->semantic_url)}}">
                                <img class="category-img-main" src="{{route('files', $img)}}" alt="Изображение {{$category->title}}">
                                <div class="shadow-text pos-abs top-0 w-100 h-100 flex-center border-radius-15">
                                    <div class="color-white text-center" style="font-size: 24px;">
                                        {{$category->title}}
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>

                @endforeach

            @endforeach
        </div>

    </div>

@stop

@section('js')

@stop
