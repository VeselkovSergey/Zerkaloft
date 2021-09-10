@extends('administration.index')

@section('content')

    <div class="container-create-subcategory" style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%; display: none;">
            <label for="subcategory_id" style="display: block; width: 100%;">ID подкатегории</label>
            <input class="need-validate" id="subcategory_id" name="subcategory_id" type="text"  value="{{$subcategory->id}}" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="subcategory_name" style="display: block; width: 100%;">Название подкатегории</label>
            <input class="need-validate" id="subcategory_name" type="text"  value="{{$subcategory->title}}" style="width: 100%;">
        </div>

        @foreach(unserialize($subcategory->img) as $img)

            <div style="padding: 10px; width: 100%;">
                <label class="subcategory-img-label" for="subcategory_img" style="max-width: 300px; max-height: 300px; background-image: url('{{route('files', $img)}}')"></label>
                <input id="subcategory_img" name="subcategory_img" type="file" accept="image/jpeg, image/png, image/bmp" style="width: 100%;">
            </div>

        @endforeach

        <div style="padding: 10px; width: 100%; display: none;">
            <label for="subcategory_seo" style="display: block; width: 100%;">SEO</label>
            <input id="subcategory_seo" name="subcategory_seo" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="subcategory_parent" style="display: block; width: 100%;">Категория</label>

            <select name="subcategory_parent" class="need-validate" id="subcategory_parent" style="width: 100%;">

                @if(sizeof($allCategories))

                    <option disabled >Выберите категорию</option>

                    @foreach($allCategories as $category)

                        <option @if($subcategory->category_id === $category->id) selected @endif value="{{$category->id}}">{{$category->title}}</option>

                    @endforeach

                @else

                    <option disabled>Нет категорий</option>

                @endif

            </select>

        </div>

        <div style="padding: 10px; width: 100%;">
            <button class="save-subcategory-btn container-btn" style="width: 100%;">Сохранить</button>
        </div>

        <div style="padding: 10px; width: 100%;">
            <button class="delete-subcategory-btn container-btn" style="width: 100%;">Удалить</button>
        </div>

    </div>

@stop

@section('js')

    <script>

        document.getElementById('subcategory_img').addEventListener('input', (event) => {
            let fileReader = new FileReader();
            fileReader.addEventListener("load", () => {
                let labelSubcategoryImg = document.querySelector(".subcategory-img-label");
                labelSubcategoryImg.innerHTML = '';
                labelSubcategoryImg.style.border = '';
                labelSubcategoryImg.style.backgroundImage = "url(" + fileReader.result + ")";
            }, false);
            fileReader.readAsDataURL(event.target.files[0]);
        });

        document.body.querySelector('.save-subcategory-btn').addEventListener('click', () => {
            let dataForm = getDataFormContainer('container-create-subcategory');

            let editAndDeleteSubcategoryBtn = document.body.querySelectorAll('.container-create-subcategory .container-btn');
            editAndDeleteSubcategoryBtn.forEach((btn) => {
                btn.classList.add('hide-el');
            });

            Ajax("{{route('save-subcategory-admin')}}", 'post', dataForm).then((response) => {
                if (response.status) {
                    ShowFlashMessage(response.message);
                } else {
                    ShowFlashMessage(response.message);
                }
                editAndDeleteSubcategoryBtn.forEach((btn) => {
                    btn.classList.remove('hide-el');
                });
            });
        });

        document.body.querySelector('.delete-subcategory-btn').addEventListener('click', () => {
            let dataForm = getDataFormContainer('container-create-subcategory');

            let editAndDeleteSubcategoryBtn = document.body.querySelectorAll('.container-create-subcategory .container-btn');
            editAndDeleteSubcategoryBtn.forEach((btn) => {
                btn.classList.add('hide-el');
            });

            Ajax("{{route('delete-subcategory-admin')}}", 'post', dataForm).then((response) => {
                if (response.status) {
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                        location.href = "{{route('subcategories-admin-page')}}";
                    }, 1500);
                } else {
                    ShowFlashMessage(response.message);
                    editAndDeleteSubcategoryBtn.forEach((btn) => {
                        btn.classList.remove('hide-el');
                    });
                }
            });
        });

    </script>

@stop
