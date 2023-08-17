@php
    $bredcrumbs = [
        "Главная" => route("home-page"),
        "Наши работы" => route('gallery'),
    ];

    $title_page = 'Наши работы';
    $metaDescription = 'Здесь находятся наши выполненные работы по зеркалам. Zerkaloft или зеркалофт готов исполнить любое ваше решение. Мы профессионалы в своем деле.';
@endphp

@extends("new-design.app")

@section("content")
    <div class="catalog">
        @include("new-design.bredcrumbs", $bredcrumbs)
        @include("new-design.assets.filters", ['route' => route('gallery')])
        <div class="flex-wrap-adaptive-block">
            @if(!sizeof($items))
                <h3>Нет товаров удовлетвряющих фильтрам</h3>
            @endif
            @foreach($items as $item)
                <a href="{{$item->link()}}" class="block w-33-adaptive-100 pos-rel product-container color-white">
                    <div>
                        <img style="" src="{{$item->FirstImgUrl()}}" alt="{{$item->description}}">
                    </div>
                    <div class="product-description z-1 pos-abs-adaptive-static">
                        <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
{{--                            <div class="border-radius-25 show-adaptive p-10 w-100 mb-a text-center">--}}{{--{{$item->description}}--}}{{--</div>--}}
                            <div class="hide-adaptive p-10 w-100 mb-a">{{--{{$item->description}}--}}</div>
                            {{--                            @foreach($product->Category->Properties as $property)--}}
                            {{--                                <div class="font-light">{{$property->title}}</div>--}}
                            {{--                            @endforeach--}}
                            <div class="border-radius-25 p-10 mt-a w-100 text-center mt-10"
                                 style="background-color: white; color: black">ХОЧУ ТАК ЖЕ
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        @include("new-design.info")
    </div>
@endsection
