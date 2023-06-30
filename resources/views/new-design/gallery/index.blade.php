@php
    $bredcrumbs = [
        "Главная" => route("home-page"),
    ];

    if (isset($category)) {
        $bredcrumbs['Галерея'] = route('gallery');
        $title_page = 'Галерея';
        $metaDescription = 'Выполненные работы';
    }

@endphp

@extends("new-design.app")

@section("content")
    <div class="catalog">
        @include("new-design.bredcrumbs", $bredcrumbs)
        <div class="flex-wrap filters-container">
            @foreach($filters as $filter)
                <div class="checkbox-wrapper-1 mb-20 mr-20" style="width: min-content;">
                    <input id="filter-{{$filter->id}}" type="checkbox" name="{{$filter->id}}" class="custom-checkbox filter" {{in_array($filter->id, request()->keys()) ? " checked " : ""}} value="{{$filter->id}}">
                    <label for="filter-{{$filter->id}}" style="white-space: nowrap;">{{$filter->title}}</label>
                </div>
            @endforeach
        </div>
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
                            <div class="border-radius-25 show-adaptive p-10 w-100 mb-a text-center">{{--{{$item->description}}--}}</div>
                            <div class="hide-adaptive p-10 w-100 mb-a">{{--{{$item->description}}--}}</div>
                            {{--                            @foreach($product->Category->Properties as $property)--}}
                            {{--                                <div class="font-light">{{$property->title}}</div>--}}
                            {{--                            @endforeach--}}
                            <div class="border-radius-25 p-10 mt-a w-100 text-center mt-10"
                                 style="background-color: white; color: black">К РАБОТЕ
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        @include("new-design.info")
    </div>
@endsection

@section('js')
    <script>
        document.body.querySelector('.filters-container').querySelectorAll('.filter').forEach((filter) => {
            filter.addEventListener('change', () => {
                let checkedFilters = []
                document.body.querySelector('.filters-container').querySelectorAll('.filter:checked').forEach((checkedFilter) => {
                    checkedFilters.push(`${checkedFilter.value}=${checkedFilter.value}`)
                })
                location.href = "{{route('gallery')}}?" + checkedFilters.join("&")
            })
        })
    </script>
@endsection
