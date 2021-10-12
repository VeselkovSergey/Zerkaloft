@extends('profile.index')

@section('profile-content')

    <div style="width: 100%;">
        <div style="font-weight: bold; font-size: 20px;">
            Заказ № {{$order->id}} от {{$order->created_at->format('d.m.Y H:i:s')}}
        </div>

        <div class="all-cart-product" style="overflow: hidden;">

            @foreach($allProductsInOrder as $key => $productPrice)

                <div style="display: flex; width: 100%; padding: 25px; border-bottom: 1px solid grey; height: 200px; align-items: center;" data-product-container="{{$productPrice->id}}">

                    <div style="padding-right: 30px;">
                        @foreach(unserialize($productPrice->Product->img) as $img)

                            <div class="" style="display: flex;justify-content: center;align-items: center; width:150px;">
                                <img style="border-radius: 15px; max-width: 150px; max-height: 150px;" src="{{route('files', $img)}}" alt="Изображение {{$productPrice->Product->title}}">
                            </div>

                        @endforeach
                    </div>

                    <div style="display: flex; width: 100%; justify-content: space-between; align-items: center; height: 100%;">

                        <div style="display: flex; flex-direction: column; height: 100%; justify-content: space-around;">
                            <a  class="product-name-in-basket cp" href="{{route('product', [$productPrice->Product->Category->semantic_url, $productPrice->Product->semantic_url])}}">
                                <div style="font-size: 25px;">{{$productPrice->Product->title}}</div>
                            </a>
                            <div style="font-size: 20px; font-weight: bold;">{{$dataProductsInOrder[$productPrice->id]->text}}</div>
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
{{--                            <button class="button-delete-product-in-basket cp" style="display: flex; justify-content: center; align-items: center; border: unset; color: unset; background-color: unset;" data-product-id="{{$product->id}}">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">--}}
{{--                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>--}}
{{--                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>--}}
{{--                                </svg>--}}
{{--                            </button>--}}
                            <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
{{--                                <input data-product-id="{{$product->id}}" class="input-count-product-in-basket" data-count-product="{{$product->id}}" value="{{$productsInBasket[$product->id]}}" type="text" autocomplete="off" maxlength="2" style="font-size: 20px; cursor: default; border: unset; width: 40px; height: 40px; text-align: center;">--}}
                                                                    <div  style="width: 40px; height: 40px; line-height: 40px; font-size: 20px;">{{$dataProductsInOrder[$productPrice->id]->count}}</div>
                            </div>
{{--                            <button class="button-add-product-in-basket cp" style="display: flex; justify-content: center; align-items: center; border: unset; color: unset; background-color: unset;" data-product-id="{{$product->id}}">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">--}}
{{--                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>--}}
{{--                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>--}}
{{--                                </svg>--}}
{{--                            </button>--}}
                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

@stop

@section('profile-js-container')

@stop
