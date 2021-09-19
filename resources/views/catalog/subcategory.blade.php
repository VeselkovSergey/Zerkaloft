@extends('app')

@section('content')

    @php($title_page = $subcategory->title)

    <div>

        <div class="flex-wrap w-100">
            <div class="w-100">
                <h2 class="m-5 ml-25">
                    {{$subcategory->title}}
                </h2>
                <div>
                    @foreach($products as $product)
                        <li class="p-5">
                            <a class="color-black" href="{{route('product', [$subcategory->Category->semantic_url, $subcategory->semantic_url, $product->semantic_url])}}">
                                {{$product->title}}
                            </a>
                        </li>
                    @endforeach
                </div>
            </div>
        </div>

    </div>



@stop

@section('js')

@stop
