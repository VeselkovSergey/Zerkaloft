@extends("new-design.app")

@section("content")
    @if(isset($carouselImages) && count($carouselImages))
        <div>
            <div class="w-100 slider" data-not-zoom="true">
                @foreach($carouselImages as $carouselImage)
                    <a href="{{$carouselImage->link}}">
                        <picture>
                            @if(isset($carouselImage->fileId[1]))
                                <source media="(max-width: 540px)" srcset="{{route('files', $carouselImage->fileId[1])}}">
                            @endif
                                <img src="{{route('files', $carouselImage->fileId)}}" alt="акция">
                        </picture>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
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
            <div class="w-50-adaptive-100 slider" data-not-zoom="true">
                @foreach($dataFirstBlock->imageFileId as $key => $imgId)
                    <picture>
                        @if(isset($dataFirstBlock->imageSquareFileId[$key]))
                            <source media="(max-width: 540px)" srcset="{{route('files', $dataFirstBlock->imageSquareFileId[$key])}}">
                        @endif
                        <img src="{{route('files', $imgId)}}" alt="о нас">
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
        @include("new-design.assets.filters", ['route' => route('catalog')])
        <div class="flex-wrap">
            @php
                if (isset($searchQuery)) {
                    $products = \App\Models\Products::where('search_words', 'like', '%' . $searchQuery . '%')->with('Prices')->get();
                } else {
                    $products = \App\Models\Products::where('show_main_page', 1)->with('Prices')->get();
                }
            @endphp
            @foreach($products->shuffle() as $product)
            <a href="{{$product->Link()}}" class="flex w-25-adaptive-50 color-white">
                <div class="p-10">
                    <div class="product-container pos-rel">
                        <div>
                            <img style="" src="{{$product->FirstImgUrl()}}" alt="{{$product->title}}">
                        </div>
                        <div class="product-description z-1 pos-abs-adaptive-static">
                            <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                                <div class="border-radius-25 show-adaptive p-10 w-100 mb-a font-size-12">{{$product->title}}</div>
                                <div class="hide-adaptive p-10 w-100 mb-a">{{$product->title}}</div>
                                {{--                        @foreach($product->Properties() as $property)--}}
                                {{--                            <div class="font-light">{{$property->value}}</div>--}}
                                {{--                        @endforeach--}}
                                <div class="border-radius-25 p-10 mt-a w-100 text-center mt-10"
                                     style="background-color: white; color: black">ОТ {{$product->Prices->first()->price}} ₽
                                </div>
                            </div>
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
