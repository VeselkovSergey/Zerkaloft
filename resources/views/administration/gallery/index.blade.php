@extends('administration.index')

@section('content')

    <div class="font-semibold p-10">Галерея</div>
    @if(sizeof($allGallery))
        <div class="flex-wrap">
            @foreach($allGallery as $gallery)
                <div class="border flex-column-center mr-10 mb-10">
                    @foreach(unserialize($gallery->img) as $img)

                        <div class="p-10">
                            <div class="category-img-label" for="category_img" style="max-width: 300px; max-height: 300px; background-image: url('{{route('files', $img)}}')"></div>
                        </div>

                    @endforeach
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
