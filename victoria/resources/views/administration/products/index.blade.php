@extends('administration.index')

@section('content')

    <div style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            Все продукты
        </div>

        <div>

            <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">

                <div>Название продукта</div>
                <div>Действие</div>

            </div>

            @if(sizeof($allProducts))

                @foreach($allProducts as $product)

                    <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">

                        <div data-product-id="{{$product->id}}">{{$product->title}}</div>
                        <div>
                            <a style="width: 100%;" href="{{route('edit-product-admin-page', $product->id)}}">Редактировать</a>
                        </div>

                    </div>

                @endforeach

            @else

                <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">
                    Нет продуктов!
                </div>

            @endif

        </div>

    </div>

@stop

@section('js')

@stop
