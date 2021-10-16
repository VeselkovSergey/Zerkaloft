@extends('administration.index')

@section('content')

    <div class="flex-column">
        <div class="font-semibold p-10">Все категории</div>
        <div>
            @if(sizeof($allCategories))
                @foreach($allCategories as $category)
                    <div class="flex-space-between p-5 m-5 border">
                        <div data-category-id="{{$category->id}}">{{$category->title}}</div>
                        <a href="{{route('edit-category-admin-page', $category->id)}}">Редактировать</a>
                    </div>
                @endforeach
            @else
                <div class="font-semibold">Нет категорий!</div>
            @endif
        </div>
    </div>

@stop

@section('js')

@stop
