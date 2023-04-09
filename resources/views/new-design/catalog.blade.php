@php
$bredcrumbs = [
    "Главная" => route("home-page"),
    $category->title => route('category', $category->semantic_url),
];
@endphp

@php($title_page = $category->title)

@php($metaDescription = $category->title . '. ' . $category->title)

@extends("new-design.app")

@section("content")
    <div class="catalog">
        @include("new-design.bredcrumbs", $bredcrumbs)
        <div class="flex-wrap mb-10 px-0-adaptive-10 hide">
            <div class="mr-10">
                <div class="p-10">Категория</div>
                <div>
                    <select name="" id="" class="select-3 font-light">
                        <option value="123" selected>Объемные буквы</option>
                    </select>
                </div>
            </div>
            <div class="mr-10">
                <div class="p-10">Тип</div>
                <div>
                    <select name="" id="" class="select-3 font-light">
                        <option value="123" selected>Объемные буквы</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="flex-wrap-adaptive-block">
            @foreach($productsByNotOnlyInCalculator as $product)
                <a href="{{$product->Link()}}" class="block w-33-adaptive-100 pos-rel product-container color-white">
                    <div>
                        @foreach(unserialize($product->img) as $img)
                            <img style="" src="{{route('files', $img)}}" alt="{{$product->title}}">
                        @endforeach
                    </div>
                    <div class="product-description z-1 pos-abs-adaptive-static">
                        <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                            <div class="border-radius-25 show-adaptive p-10 w-100 mb-a text-center">{{$product->title}}</div>
                            <div class="hide-adaptive p-10 w-100 mb-a">{{$product->title}}</div>
{{--                            @foreach($product->Category->Properties as $property)--}}
{{--                                <div class="font-light">{{$property->title}}</div>--}}
{{--                            @endforeach--}}
                            <div class="border-radius-25 p-10 mt-a w-100 text-center mt-10"
                                 style="background-color: white; color: black">К ТОВАРУ
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        @include("new-design.info")
    </div>
@endsection
