@extends('administration.index')

@section('content')

    <div class="container-create-product" style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            <label for="product_name" style="display: block; width: 100%;">Название продукта</label>
            <input id="product_name" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%; display: none;">
            <label for="product_seo" style="display: block; width: 100%;">SEO</label>
            <input id="product_seo" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="product_parent" style="display: block; width: 100%;">Подкатегория</label>

            <select name="product_parent" class="need-validate" id="product_parent" style="width: 100%;">

                @if(sizeof($allSubcategories))

                    <option disabled selected value="">Выберите подкатегорию</option>

                    @foreach($allSubcategories as $subcategory)

                        <option value="{{$subcategory->id}}">{{$subcategory->title}}</option>

                    @endforeach

                @else

                    <option disabled>Нет подкатегорий</option>

                @endif

            </select>

        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="product_description" style="display: block; width: 100%;">Описание</label>
            <textarea style="width: 100%;" name="product_description" id="product_description"></textarea>
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="product_price" style="display: block; width: 100%;">Стоимость</label>
            <input id="product_price" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label class="product-img-label" for="product_img" style="max-width: 300px; max-height: 300px; border: 1px solid black;">Загрузите картинку</label>
            <input id="product_img" type="file" accept="image/jpeg, image/png, image/bmp" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <button class="create-product-btn container-btn" style="width: 100%;">Создать</button>
        </div>

    </div>

@stop

@section('js')

    <script>

        document.getElementById('product_img').addEventListener('input', (event) => {
            let fileReader = new FileReader();
            fileReader.addEventListener("load", () => {
                let labelProductImg = document.querySelector(".product-img-label");
                labelProductImg.innerHTML = '';
                labelProductImg.style.border = '';
                labelProductImg.style.backgroundImage = "url(" + fileReader.result + ")";
            }, false);
            fileReader.readAsDataURL(event.target.files[0]);
        });

        document.body.querySelector('.create-product-btn').addEventListener('click', () => {
            let dataForm = getDataFormContainer('container-create-product');

            let createProductBtn = document.body.querySelector('.container-create-product .container-btn');
            createProductBtn.classList.add('hide-el');

            Ajax("{{route('save-product-admin')}}", 'post', dataForm).then((response) => {
                if (response.status) {
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                        location.href = "{{route('products-admin-page')}}";
                    }, 1500);
                } else {
                    ShowFlashMessage(response.message);
                    createProductBtn.classList.remove('hide-el');
                }
            });
        });

    </script>

@stop
