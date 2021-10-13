@extends('administration.index')

@section('content')

    <div class="container-create-category flex-column w-100">

        <div class="p-10 w-100">
            <label for="category_name">Название категории</label>
            <input class="need-validate w-100" id="category_name" type="text">
        </div>

        <div class="p-10 w-100">
            <label class="category-img-label" for="category_img" style="max-width: 300px; max-height: 300px; border: 1px solid black;">Загрузите картинку</label>
            <input id="category_img" type="file" accept="image/jpeg, image/png, image/bmp" class="w-100">
        </div>

        <div class="p-10 w-100 hide">
            <label for="category_seo">SEO</label>
            <input id="category_seo" type="text" class="w-100">
        </div>

        <div class="p-10 w-100">

            <div class="border flex-wrap">
                @foreach($allPropertiesCategories as $propertyCategories)

                    <div class="w-10 p-10 flex-column-center">
                        <label class="block">{{$propertyCategories->title}}</label>
                        <input name="usedProperties[{{$propertyCategories->id}}]" class="cp" type="checkbox">
                    </div>

                @endforeach
            </div>



        </div>

        <div class="p-10 w-100">
            <button class="create-category-btn container-btn w-100">Создать</button>
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
            let dataForm = GetDataFormContainer('container-create-category');

            let createCategoryBtn = document.body.querySelector('.container-create-category .container-btn');
            createCategoryBtn.hide();

            Ajax("{{route('save-category-admin')}}", 'post', dataForm).then((response) => {
                if (response.status) {
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                        location.href = "{{route('categories-admin-page')}}";
                    }, 1500);
                } else {
                    ShowFlashMessage(response.message);
                    createCategoryBtn.show();
                }
            });
        });

    </script>

@stop
