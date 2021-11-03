@extends('app')

@section('content')

    @php($title_page = $category->title)

    <div>

        <div class="flex-wrap w-100">
            <h2 class="w-100 m-5 ml-25">
                {{$category->title}}
            </h2>
            <div class="w-100 m-5 flex-wrap">
                @foreach($categoryAdditionalLinks as $categoryAdditionalLink)
                    <div class="m-5">
                        <a class="clear-a button-blue" href="{{route('category', $category->semantic_url)}}?{{\App\Helpers\StringHelper::TransliterateURL($categoryAdditionalLink)}}">{{$categoryAdditionalLink}}</a>
                    </div>
                @endforeach
            </div>
            @foreach($products as $product)
                <div class="product-category-page p-10">
                    <div class="smooth-block w-100 pos-rel">
                        <a href="{{route('product', [$category->semantic_url, $product->semantic_url])}}">
                            @foreach(unserialize($product->img) as $img)
                                <img style="border-radius: 15px;" src="{{route('files', $img)}}" alt="Изображение {{$product->title}}">
                            @endforeach
                            <div class="shadow-text w-100 h-100 flex-center border-radius-15 pos-abs top-0" style="background-color: rgba(0, 0, 0, 0.2);">
                                <div class="color-white text-center" style="font-size: 24px;">
                                    {{$product->title}}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>



@stop

@section('js')

@stop
