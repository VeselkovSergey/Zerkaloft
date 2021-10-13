@extends('administration.index')

@section('content')

    <div class="container-create-category" style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%; display: none;">
            <label for="category_id" style="display: block; width: 100%;">ID категории</label>
            <input class="need-validate" id="category_id" type="text" style="width: 100%;" value="{{$category->id}}">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="category_name" style="display: block; width: 100%;">Название категории</label>
            <input class="need-validate" id="category_name" type="text" style="width: 100%;" value="{{$category->title}}">
        </div>

        @foreach(unserialize($category->img) as $img)

            <div style="padding: 10px; width: 100%;">
                <label class="category-img-label" for="category_img" style="max-width: 300px; max-height: 300px; background-image: url('{{route('files', $img)}}')"></label>
                <input id="category_img" type="file" accept="image/jpeg, image/png, image/bmp" style="width: 100%;">
            </div>

        @endforeach

        <div style="padding: 10px; width: 100%; display: none;">
            <label for="category_seo" style="display: block; width: 100%;">SEO</label>
            <input id="category_seo" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <button class="save-category-btn container-btn" style="width: 100%;">Сохранить</button>
        </div>

        <div style="padding: 10px; width: 100%;">
            <button class="delete-category-btn container-btn" style="width: 100%;">Удалить</button>
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

        document.body.querySelector('.save-category-btn').addEventListener('click', () => {
            let dataForm = getDataFormContainer('container-create-category');

            let editAndDeleteCategoryBtn = document.body.querySelectorAll('.container-create-category .container-btn');
            editAndDeleteCategoryBtn.forEach((btn) => {
                btn.hide();
            });

            Ajax("{{route('save-category-admin')}}", 'post', dataForm).then((response) => {
                if (response.status) {
                    ShowFlashMessage(response.message);
                } else {
                    ShowFlashMessage(response.message);
                }
                editAndDeleteCategoryBtn.forEach((btn) => {
                    btn.show();
                });
            });
        });

        document.body.querySelector('.delete-category-btn').addEventListener('click', () => {
            let dataForm = getDataFormContainer('container-create-category');

            let editAndDeleteCategoryBtn = document.body.querySelectorAll('.container-create-category .container-btn');
            editAndDeleteCategoryBtn.forEach((btn) => {
                btn.hide();
            });

            Ajax("{{route('delete-category-admin')}}", 'post', dataForm).then((response) => {
                if (response.status) {
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                        location.href = "{{route('categories-admin-page')}}";
                    }, 1500);
                } else {
                    ShowFlashMessage(response.message);
                    editAndDeleteCategoryBtn.forEach((btn) => {
                        btn.show();
                    });
                }
            });
        });

    </script>

@stop
