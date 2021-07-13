@extends('administration.index')

@section('content')

    <div style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            <label for="category_name" style="display: block; width: 100%;">Название категории</label>
            <input id="category_name" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="category_seo" style="display: block; width: 100%;">SEO</label>
            <input id="category_seo" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <button style="width: 100%;">Создать</button>
        </div>

    </div>

@stop

@section('js')

@stop
