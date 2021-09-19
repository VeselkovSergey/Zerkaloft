@extends('app')

@section('content')

    @php($title_page = $category->title)

    <div>

        <style>
            .smooth-block:hover {
                transform: scale(1.05);
                cursor: pointer;
                transition: transform .3s;
            }
        </style>

        <div class="flex-wrap w-100">
            @foreach($subcategories as $subcategory)
                <div class="w-100">
                    <h2 class="m-5 ml-25">
                        {{$subcategory->title}}
                    </h2>
                    <div class="flex-wrap w-100">
                        @foreach($subcategory->Products as $product)
                            <div class="w-25 p-10">
                                <div class="smooth-block w-100 pos-rel">
                                    <a href="{{route('product', [$category->semantic_url, $subcategory->semantic_url, $product->semantic_url])}}">
                                        @foreach(unserialize($product->img) as $img)
                                            <img style="border-radius: 15px;" src="{{route('files', $img)}}" alt="Изображение {{$product->title}}">
                                        @endforeach
                                        <div class="title-category" style="background-color: rgba(0, 0, 0, 0.2);width: 100%;height: 100%;display: flex;justify-content: center;align-items: center;border-radius: 15px;position: absolute;top: 0;">
                                            <div style="color: white; font-size: 40px;">
                                                {{$product->title}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

    </div>



@stop

@section('js')

@stop
