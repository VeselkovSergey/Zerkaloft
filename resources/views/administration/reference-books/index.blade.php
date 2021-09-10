@extends('administration.index')

@section('content')

    <div style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            Все справочники
        </div>

        <div>

            <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">

                <div>Название спрвочника</div>
                <div>Действие</div>

            </div>

            @if(sizeof($allReferenceBooks))

                @foreach($allReferenceBooks as $referenceBook)

                    <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">

                        <div data-subcategory-id="{{$referenceBook->id}}">{{$referenceBook->title}}</div>
                        <div>
                            <a style="width: 100%;" href="{{route('edit-reference-book-admin-page', $referenceBook->id)}}">Редактировать</a>
                        </div>

                    </div>

                @endforeach

            @else

                <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">
                    Нет спрвочников!
                </div>

            @endif

        </div>

    </div>

@stop

@section('js')

@stop
