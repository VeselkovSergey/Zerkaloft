@extends('administration.index')

@section('content')

    <div style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            Все категории
        </div>

        <div>

{{--            <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">--}}

{{--                <div>Название категории</div>--}}
{{--                <div>Действие</div>--}}

{{--            </div>--}}

            @if(sizeof($allCategories))

                @foreach($allCategories as $category)

                    <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">

                        <div data-category-id="{{$category->id}}">{{$category->title}}</div>
{{--                        <div>--}}
{{--                            <a style="width: 100%;" href="{{route('edit-category-admin-page', $category->id)}}">Редактировать</a>--}}
{{--                        </div>--}}

                    </div>

                @endforeach

            @else

                <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">
                    Нет категорий!
                </div>

            @endif

        </div>

    </div>

@stop

@section('js')

@stop
