@extends('profile.index')

@section('profile-content')

    <div class="w-100 font-semibold">
        <div class="mb-10">
            Заказ № {{$order->id}} от {{$order->created_at->format('d.m.Y H:i:s')}}
        </div>

        <div class="all-cart-product scroll-off">

            @foreach($allProductsInOrder as $key => $productPrice)

                <div class="flex-wrap" data-product-container="{{$productPrice->id}}">

                    @foreach(unserialize($productPrice->Product->img) as $img)
                        <img class="border-radius-10 mr-10 mb--10" style="width: 300px;" src="{{route('files', $img)}}"
                             alt="Изображение {{$productPrice->Product->title}}">
                    @endforeach

                    <div>
                        <a class="product-name-in-basket cp"
                           href="{{route('product', [$productPrice->Product->Category->semantic_url, $productPrice->Product->semantic_url])}}">
                            {{$productPrice->Product->title}}
                        </a>
                        <div class="mb-10">{{$dataProductsInOrder[$productPrice->id]->productFullInformation->prices->{$productPrice->id}->count . ' ' . $dataProductsInOrder[$productPrice->id]->productFullInformation->prices->{$productPrice->id}->price}}</div>

                        <div>{{$dataProductsInOrder[$productPrice->id]->count}} шт.</div>
                    </div>

                </div>

            @endforeach

        </div>

    </div>

@stop

@section('profile-js-container')

@stop
