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
        <div class="container-buttons">
            <button class="save-property-categories-btn container-btn">Сохранить</button>
            <button class="delete-property-categories-btn container-btn">Удалить</button>
        </div>
    </div>

@stop

@section('js')

    <script>

        document.body.querySelector('.save-property-categories-btn').addEventListener('click', () => {
            let dataForm = GetDataFormContainer('container-create-property-categories');

            let containerButtons = document.body.querySelector('.container-buttons');
            containerButtons.hide();

            Ajax("{{route('save-property-categories-admin')}}", 'post', dataForm).then((response) => {
                ShowFlashMessage(response.message);
                containerButtons.show();
            });
        });

        document.body.querySelector('.delete-property-categories-btn').addEventListener('click', () => {
            let dataForm = GetDataFormContainer('container-create-property-categories');

            let containerButtons = document.body.querySelector('.container-buttons');
            containerButtons.hide();

            Ajax("{{route('delete-property-categories-admin')}}", 'post', dataForm).then((response) => {
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
