@extends('administration.index')

@section('content')

    <div style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            <label for="product_name" style="display: block; width: 100%;">Название продукта</label>
            <input id="product_name" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="product_seo" style="display: block; width: 100%;">SEO</label>
            <input id="product_seo" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="product_parent" style="display: block; width: 100%;">Подкатегория</label>
            <input id="product_parent" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="product_img" style="display: block; width: 100%;">Картинка</label>
            <input id="product_img" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <button style="width: 100%;">Сохранить</button>
        </div>

        <div style="padding: 10px; width: 100%;">
            <button style="width: 100%;">Удалить</button>
        </div>

    </div>

@stop

@section('js')

@stop
