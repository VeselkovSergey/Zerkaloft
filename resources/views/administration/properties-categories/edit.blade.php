@extends('administration.index')

@section('content')

    <div class="container-create-property-categories">
        <div class="mb-10 hide">
            <label for="property_categories_id">ID свойства категорий</label>
            <input class="need-validate" id="property_categories_id" type="text" value="{{$propertyCategories->id}}">
        </div>
        <div class="mb-10">
            <label for="property_categories_title">Название свойства категорий</label>
            <input class="need-validate" id="property_categories_title" type="text" value="{{$propertyCategories->title}}">
        </div>
        <div class="mb-10">
            <label for="property_categories_sequence">Очередность</label>
            <input class="need-validate" id="property_categories_sequence" type="text" value="{{$propertyCategories->property_categories_sequence}}">
        </div>
        <div class="mb-10">
            Значения:
            @foreach($propertyCategories->Values as $value)
                <div>{{$value->value}}</div>
            @endforeach
        </div>
        <div class="container-buttons">
            <button class="save-property-categories-btn container-btn">Сохранить</button>
            <button class="delete-property-categories-btn container-btn">Удалить</button>
        </div>
    </div>

@stop

@section('js')

    <script>

        document.body.querySelector('.save-property-categories-btn').addEventListener('click', () => {
            LoaderShow();
            let dataForm = GetDataFormContainer('container-create-property-categories');

            let containerButtons = document.body.querySelector('.container-buttons');
            containerButtons.hide();

            Ajax("{{route('save-property-categories-admin')}}", 'post', dataForm).then((response) => {
                LoaderHide();
                ShowFlashMessage(response.message);
                containerButtons.show();
            });
        });

        document.body.querySelector('.delete-property-categories-btn').addEventListener('click', () => {
            LoaderShow();
            let dataForm = GetDataFormContainer('container-create-property-categories');

            let containerButtons = document.body.querySelector('.container-buttons');
            containerButtons.hide();

            Ajax("{{route('delete-property-categories-admin')}}", 'post', dataForm).then((response) => {
                LoaderHide();
                ShowFlashMessage(response.message);
                if (response.status) {
                    setTimeout(() => {
                        location.href = "{{route('properties-categories-admin-page')}}";
                    }, 1500)
                } else {
                    containerButtons.show();
                }
            });
        });

    </script>

@stop
