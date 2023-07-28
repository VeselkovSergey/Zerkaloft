@extends('administration.index')

@section('content')

    <div class="font-semibold p-10">Все картинки карусели</div>
    @if(sizeof($carouselImages))
        @foreach($carouselImages as $carouselImage)
            <div class="flex-space-between border p-5 m-5">
                <img width="200" src="{{route('files', json_decode($carouselImage->value)->fileId[0])}}" alt="">
                <img width="200" class="mr-a" src="{{route('files', json_decode($carouselImage->value)->fileId[1])}}" alt="">
                <div class="mr-10" data-product-id="{{$carouselImage->id}}">Очередь: {{json_decode($carouselImage->value)->sequence}}</div>
                <a href="{{route('edit-carousel-image-page', $carouselImage->id)}}">Редактировать</a>
            </div>
        @endforeach
    @else
        <div class="font-semibold">Нет картинок карусели!</div>
    @endif

@stop

@section('js')

@stop
