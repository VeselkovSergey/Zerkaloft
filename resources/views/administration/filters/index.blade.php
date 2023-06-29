@extends('administration.index')

@section('content')

    <div class="font-semibold p-10">Все фильтры</div>
    @if(sizeof($allFilters))
        @foreach($allFilters as $filter)
            <div class="flex-space-between p-5 m-5 border">
                <div data-additional-service-id="{{$filter->id}}">{{$filter->title}}</div>
                <a href="{{route('edit-filters-page', $filter->id)}}">Редактировать</a>
            </div>
        @endforeach
    @else
        <div class="font-semibold">Нет фильтров!</div>
    @endif

@stop

@section('js')

@stop
