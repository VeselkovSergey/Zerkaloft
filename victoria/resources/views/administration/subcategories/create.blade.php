@extends('administration.index')

@section('content')

{{--    <div style="display: flex; flex-direction: column; width: 100%;">

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

    </div>--}}

    <div class="container-create-category" style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            <label for="subcategory_name" style="display: block; width: 100%;">Название подкатегории</label>
            <input class="need-validate" id="subcategory_name" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%; display: none;">
            <label for="subcategory_seo" style="display: block; width: 100%;">SEO</label>
            <input id="subcategory_seo" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="subcategory_parent" style="display: block; width: 100%;">Категория</label>

            <select name="subcategory_parent" class="need-validate" id="subcategory_parent" style="width: 100%;">

                @if(sizeof($allCategories))

                        <option disabled selected value="">Выберите категорию</option>

                    @foreach($allCategories as $category)

                        <option value="{{$category->id}}">{{$category->title}}</option>

                    @endforeach

                @else

                    <option disabled>Нет категорий</option>

                @endif

            </select>



{{--            <input id="subcategory_parent" type="text" style="width: 100%;">--}}
        </div>

        <div style="padding: 10px; width: 100%;">
            <button class="create-subcategory-btn container-btn" style="width: 100%;">Создать</button>
        </div>

    </div>


@stop

@section('js')

@stop
