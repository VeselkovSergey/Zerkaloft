@php
$bredcrumbs = [
    "Главная" => route("home-page"),
];

$bredcrumbs[$category->title] = route('category', $category->semantic_url);
$title_page = $category->title;
$metaDescription = $category->title . '. ' . $category->title;

@endphp

@extends("new-design.app")

@section("content")
    <div class="catalog">
        @include("new-design.bredcrumbs", $bredcrumbs)
        @include("new-design.assets.filters", ['route' => route('category', $category->semantic_url)])
        <div class="flex-wrap">
            @if(!sizeof($products))
                <h3>Нет товаров удовлетвряющих фильтрам</h3>
            @endif
            @foreach($products as $product)
                    <a href="{{$product->Link()}}" class="flex w-25-adaptive-50 color-white">
                        <div class="p-10">
                            <div class="product-container pos-rel">
                                <div>
                                    <img style="" src="{{$product->FirstImgUrl()}}" alt="{{$product->title}}">
                                </div>
                                <div class="product-description z-1 pos-abs-adaptive-static">
                                    <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                                        <div class="border-radius-25 show-adaptive p-10 w-100 mb-a text-center">{{$product->title}}</div>
                                        <div class="hide-adaptive p-10 w-100 mb-a">{{$product->title}}</div>
                                        {{--                        @foreach($product->Properties() as $property)--}}
                                        {{--                            <div class="font-light">{{$property->value}}</div>--}}
                                        {{--                        @endforeach--}}
                                        <div class="border-radius-25 p-10 mt-a w-100 text-center mt-10"
                                             style="background-color: white; color: black">К ТОВАРУ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
            @endforeach
        </div>
        @include("new-design.info")
    </div>
@endsection
