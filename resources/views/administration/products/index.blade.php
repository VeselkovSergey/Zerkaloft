@extends('administration.index')

@section('content')

    <div class="font-semibold p-10">Все продукты</div>
    @if(sizeof($allProducts))
        @foreach($allProducts as $product)
            <div class="flex-space-between p-5 m-5 border">
                <div data-product-id="{{$product->id}}">Продукты категории: {{$product->title}}</div>
                <a href="{{route('edit-product-admin-page', $product->id)}}">Редактировать</a>
            </div>
        @endforeach
    @else
        <div class="font-semibold">Нет продуктов!</div>
    @endif

@stop

@section('js')

@stop
