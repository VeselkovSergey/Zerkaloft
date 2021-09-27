@extends('administration.index')

@section('content')

    <div style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            Все картинки карусели
        </div>

        <div>

            <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">

                <div>Название карусели</div>
                <div>Действие</div>

            </div>

            @if(sizeof($carouselImages))

                @foreach($carouselImages as $carouselImage)

                    <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">

                        <div data-product-id="{{$carouselImage->id}}">{{$carouselImage->value}}</div>
                        <div>
                            <a style="width: 100%;" href="{{route('edit-carousel-image-page', $carouselImage->id)}}">Редактировать</a>
                        </div>

                    </div>

                @endforeach

            @else

                <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">
                    Нет картинок карусели!
                </div>

            @endif

        </div>

    </div>

@stop

@section('js')

@stop
