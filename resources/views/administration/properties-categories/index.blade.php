@extends('administration.index')

@section('content')

    <div class="font-semibold p-10">Все свойства категорий</div>
    @if(sizeof($allPropertiesCategories))
        @foreach($allPropertiesCategories as $propertyCategories)
            <div class="flex-space-between border p-5 m-5">
                <div data-category-id="{{$propertyCategories->id}}">{{$propertyCategories->title}}</div>
                <a href="{{route('edit-property-categories-admin-page', $propertyCategories->id)}}">Редактировать</a>
            </div>
        @endforeach
    @else
        <div class="font-semibold">Нет свойств категорий!</div>
    @endif

@stop

@section('js')

@stop
