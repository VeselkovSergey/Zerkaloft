@extends('administration.index')

@section('content')

    <div class="container-create-category" style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            <label for="category_name" style="display: block; width: 100%;">Название категории</label>
            <input class="need-validate" id="category_name" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%; display: none;">
            <label for="category_seo" style="display: block; width: 100%;">SEO</label>
            <input id="category_seo" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <button class="create-category-btn container-btn" style="width: 100%;">Создать</button>
        </div>

    </div>

@stop

@section('js')

    <script>

        document.body.querySelector('.create-category-btn').addEventListener('click', () => {
            let dataForm = getDataFormContainer('container-create-category');

            let createCategoryBtn = document.body.querySelector('.container-create-category .container-btn');
            createCategoryBtn.classList.add('hide-el');

            Ajax("{{route('save-category-admin')}}", 'post', dataForm).then((response) => {
                console.log(response)
                console.log(response.status)
                if (response.status) {
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                        location.href = "{{route('categories-admin-page')}}";
                    }, 1500);
                } else {
                    ShowFlashMessage(response.message);
                    createCategoryBtn.classList.remove('hide-el');
                }
            });
        });

    </script>

@stop
