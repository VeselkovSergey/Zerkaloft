@extends('administration.index')

@section('content')

    <div class="font-semibold p-10">Наши работы</div>
    @if(sizeof($allGallery))
        <div class="flex-wrap">
            @foreach($allGallery as $gallery)
                <div class="border flex-column-center mr-10 mb-10">
                    <div class="p-10">
                        <div class="category-img-label" style="max-width: 300px; max-height: 300px; background-image: url('{{route('files', unserialize($gallery->img)[0])}}')"></div>
                    </div>
                    <a href="{{route('edit-gallery-page', $gallery->id)}}">Редактировать</a>
                </div>
            @endforeach
        </div>
    @else
        <div class="font-semibold">Нет галереи!</div>
    @endif

@stop

@section('js')

@stop
