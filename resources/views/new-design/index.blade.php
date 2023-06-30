@extends("new-design.app")

@section("content")
    <div class="main-page">
{{--        <div class="flex-wrap-evenly-x flex-center-y hide-adaptive" style="min-height: calc(100vh - 120px); display: none;">--}}
{{--            <div class="w-20">--}}
{{--                <img class="border-image" width="100%" src="/assets/imgs/img-1.png" alt="">--}}
{{--            </div>--}}
{{--            <div class="w-20">--}}
{{--                <img class="border-image" width="100%" src="/assets/imgs/img-1.png" alt="">--}}
{{--            </div>--}}
{{--            <div class="w-20">--}}
{{--                <img class="border-image" width="100%" src="/assets/imgs/img-1.png" alt="">--}}
{{--            </div>--}}
{{--        </div>--}}
        @php
            $dataFirstBlock = \App\Http\Controllers\Administration\SettingsController::dataFirstBlockOnMainPage();
        @endphp
        <div class="flex-adaptive-block p-20" style="background-color: {{$dataFirstBlock->bgColor}};">
            <div class="w-50-adaptive-100 slider">
                @foreach($dataFirstBlock->imageFileId as $key => $imgId)
                    <picture>
                        @if(isset($dataFirstBlock->imageSquareFileId[$key]))
                            <source media="(max-width: 540px)" srcset="{{route('files', $dataFirstBlock->imageSquareFileId[$key])}}">
                        @endif
                        <img src="{{route('files', $imgId)}}">
                    </picture>
                @endforeach
            </div>
            <div class="w-50-adaptive-100 flex-center font-36-adaptive">
                <h1 class="px-20 text-center font-36-adaptive-24">
                    {!! $dataFirstBlock->text !!}
                </h1>
            </div>
        </div>
        @include("new-design.info")
        <div class="flex-wrap filters-container">
            @foreach($filters as $filter)
                <div class="checkbox-wrapper-1 mb-20 mr-20" style="width: min-content;">
                    <input id="filter-{{$filter->id}}" type="checkbox" name="{{$filter->id}}" class="custom-checkbox filter" {{in_array($filter->id, request()->keys()) ? " checked " : ""}} value="{{$filter->id}}">
                    <label for="filter-{{$filter->id}}" style="white-space: nowrap;">{{$filter->title}}</label>
                </div>
            @endforeach
        </div>
        <div class="flex-wrap-adaptive-block">
            @php
                if (isset($searchQuery)) {
                    $products = \App\Models\Products::where('search_words', 'like', '%' . $searchQuery . '%')->get();
                } else {
                    $products = \App\Models\Products::where('show_main_page', 1)->get();
                }
            @endphp
            @foreach($products as $product)
            <a href="{{$product->Link()}}" class="block w-33-adaptive-100 pos-rel product-container color-white">
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
            </a>
            @endforeach
            <div class="flex-wrap-adaptive-block">
                @php
                    if (isset($searchQuery)) {
                        $categories = \App\Models\Categories::where('search_words', 'like', '%' . $searchQuery . '%')->get();
                    } else {
                        $categories = \App\Models\Categories::orderBy('sequence')->get();
                    }
                @endphp
                @foreach($categories as $category)
                <a href="{{route('category', $category->semantic_url)}}" class="block color-white w-50-adaptive-100 category-container pos-rel">
                    <div>
                        @foreach(unserialize($category->img) as $img)
                            <img style="" src="{{route('files', $img)}}" alt="{{$category->title}}">
                        @endforeach
                    </div>
                    <div class="category-description pos-abs-adaptive-static z-1 p-20 text-center font-36-adaptive">
                        {{$category->title}}
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section("js")
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
