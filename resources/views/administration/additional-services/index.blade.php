@extends('administration.index')

@section('content')

    <div class="font-semibold p-10">Все дополнительные услуги</div>
    @if(sizeof($allAdditionalServices))
        @foreach($allAdditionalServices as $allAdditionalService)
            <div class="flex-space-between p-5 m-5 border">
                <div data-additional-service-id="{{$allAdditionalService->id}}">{{$allAdditionalService->title}}</div>
                <a href="{{route('edit-additional-service-page', $allAdditionalService->id)}}">Редактировать</a>
            </div>
        @endforeach
    @else
        <div class="font-semibold">Нет дополнительных услуг!</div>
    @endif

@stop

@section('js')

@stop
