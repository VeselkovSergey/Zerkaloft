@extends('administration.index')

@section('content')

    <div style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            Все подкатегории
        </div>

        <div>

            <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">

                <div>Название подкатегории</div>
                <div>Действие</div>

            </div>

            @if(sizeof($allSubcategories))

                @foreach($allSubcategories as $subcategory)

                    <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">

                        <div data-subcategory-id="{{$subcategory->id}}">{{$subcategory->title}}</div>
                        <div>
                            <a style="width: 100%;" href="{{route('edit-subcategory-admin-page', $subcategory->id)}}">Редактировать</a>
                        </div>

                    </div>

                @endforeach

            @else

                <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">
                    Нет подкатегорий!
                </div>

            @endif

        </div>

    </div>

@stop

@section('js')

@stop
