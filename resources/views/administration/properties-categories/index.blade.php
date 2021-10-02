@extends('administration.index')

@section('content')

    <div style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            Все свойства категорий
        </div>

        <div>

{{--            <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">--}}

{{--                <div>Название свойства категорий</div>--}}
{{--                <div>Действие</div>--}}

{{--            </div>--}}

            @if(sizeof($allPropertiesCategories))

                @foreach($allPropertiesCategories as $propertyCategories)

                    <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">

                        <div data-category-id="{{$propertyCategories->id}}">{{$propertyCategories->title}}</div>
{{--                        <div>--}}
{{--                            <a style="width: 100%;" href="{{route('edit-property-categories-admin-page', $propertyCategories->id)}}">Редактировать</a>--}}
{{--                        </div>--}}

                    </div>

                @endforeach

            @else

                <div style="display: flex; padding: 5px; border: 1px solid black; margin: 5px; justify-content: space-between;">
                    Нет свойств категорий!
                </div>

            @endif

        </div>

    </div>

@stop

@section('js')

@stop
