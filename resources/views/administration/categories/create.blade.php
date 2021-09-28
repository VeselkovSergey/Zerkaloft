@extends('administration.index')

@section('content')

    <div class="container-create-category" style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            <label for="category_name" style="display: block; width: 100%;">Название категории</label>
            <input class="need-validate" id="category_name" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label class="category-img-label" for="category_img" style="max-width: 300px; max-height: 300px; border: 1px solid black;">Загрузите картинку</label>
            <input id="category_img" type="file" accept="image/jpeg, image/png, image/bmp" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%; display: none;">
            <label for="category_seo" style="display: block; width: 100%;">SEO</label>
            <input id="category_seo" type="text" style="width: 100%;">
        </div>

        <div class="m-5 p-5 border flex-wrap w-100">

            @foreach($allPropertiesCategories as $propertyCategories)

                <div class="w-20">
                    <label class="block">{{$propertyCategories->title}}</label>
                    <input name="usedProperties[]" class="cp" type="checkbox">
                </div>

            @endforeach

        </div>

        <div style="padding: 10px; width: 100%;">
            <button class="create-category-btn container-btn" style="width: 100%;">Создать</button>
        </div>

    </div>

@stop

@section('js')

    <script>

        document.getElementById('category_img').addEventListener('input', (event) => {
            let fileReader = new FileReader();
            fileReader.addEventListener("load", () => {
                let labelCategoryImg = document.querySelector(".category-img-label");
                labelCategoryImg.innerHTML = '';
                labelCategoryImg.style.border = '';
                labelCategoryImg.style.backgroundImage = "url(" + fileReader.result + ")";
            }, false);
            fileReader.readAsDataURL(event.target.files[0]);
        });

        document.body.querySelector('.create-category-btn').addEventListener('click', () => {
            let dataForm = getDataFormContainer('container-create-category');

            let createCategoryBtn = document.body.querySelector('.container-create-category .container-btn');
            createCategoryBtn.classList.add('hide-el');

            Ajax("{{route('save-category-admin')}}", 'post', dataForm).then((response) => {
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
