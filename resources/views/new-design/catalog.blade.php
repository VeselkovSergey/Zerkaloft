@php
$bredcrumbs = [
    "Главная" => route("home-page"),
];

if (isset($category)) {
    $bredcrumbs[$category->title] = route('category', $category->semantic_url);
    $title_page = $category->title;
    $metaDescription = $category->title . '. ' . $category->title;
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
            @if(!sizeof($products))
                <h3>Нет товаров удовлетвряющих фильтрам</h3>
            @endif
            @foreach($products as $product)
                <a href="{{$product->Link()}}" class="block w-33-adaptive-100 pos-rel product-container color-white">
                    <div>
                        <img style="" src="{{$product->FirstImgUrl()}}" alt="{{$product->title}}">
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

@section('js')
    <script>
        document.body.querySelector('.filters-container').querySelectorAll('.filter').forEach((filter) => {
            filter.addEventListener('change', () => {
                let checkedFilters = []
                document.body.querySelector('.filters-container').querySelectorAll('.filter:checked').forEach((checkedFilter) => {
                    checkedFilters.push(`${checkedFilter.value}=${checkedFilter.value}`)
                })
                location.href = "{{route('catalog')}}?" + checkedFilters.join("&")
            })
        })
    </script>
@endsection
