@extends('administration.index')

@section('content')

    <div style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            <label for="subcategory_name" style="display: block; width: 100%;">Название подкатегории</label>
            <input id="subcategory_name" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="subcategory_seo" style="display: block; width: 100%;">SEO</label>
            <input id="subcategory_seo" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="subcategory_parent" style="display: block; width: 100%;">Категория</label>
            <input id="subcategory_parent" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <button style="width: 100%;">Создать</button>
        </div>

        <div style="padding: 10px; width: 100%;">
            <button style="width: 100%;">Удалить</button>
        </div>

    </div>

@stop

@section('js')

@stop
