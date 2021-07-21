@extends('administration.index')

@section('content')

{{--    {{dd($product)}}--}}

    <div class="container-create-product" style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%; display: none;">
            <label for="product_id" style="display: block; width: 100%;">ID продукта</label>
            <input class="need-validate" id="product_id" name="subcategory_id" type="text"  value="{{$product->id}}" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="product_name" style="display: block; width: 100%;">Название продукта</label>
            <input id="product_name" type="text" style="width: 100%;" value="{{$product->title}}">
        </div>

        <div style="padding: 10px; width: 100%; display: none;">
            <label for="product_seo" style="display: block; width: 100%;">SEO</label>
            <input id="product_seo" type="text" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label for="product_parent" style="display: block; width: 100%;">Подкатегория</label>

            <select name="product_parent" class="need-validate" id="product_parent" style="width: 100%;">

                @if(sizeof($allSubcategories))

                    <option disabled >Выберите подкатегорию</option>

                    @foreach($allSubcategories as $subcategory)

                        <option @if($product->subcategory_id === $subcategory->id) selected @endif value="{{$subcategory->id}}">{{$subcategory->title}}</option>

                    @endforeach

                @else

                    <option disabled>Нет подкатегорий</option>

                @endif

            </select>

        </div>

        @foreach(unserialize($product->img) as $img)

            <div style="padding: 10px; width: 100%;">
                <label class="product-img-label" for="product_img" style="max-width: 300px; max-height: 300px; background-image: url('{{route('files', $img)}}')"></label>
                <input id="product_img" name="product_img" type="file" accept="image/jpeg, image/png, image/bmp" style="width: 100%;">
            </div>

        @endforeach

        <div style="padding: 10px; width: 100%;">
            <button class="save-product-btn container-btn" style="width: 100%;">Сохранить</button>
        </div>

        <div style="padding: 10px; width: 100%;">
            <button class="delete-product-btn container-btn" style="width: 100%;">Удалить</button>
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

        document.body.querySelector('.save-product-btn').addEventListener('click', () => {
            let dataForm = getDataFormContainer('container-create-product');

            let editAndDeleteProductBtn = document.body.querySelectorAll('.container-create-product .container-btn');
            editAndDeleteProductBtn.forEach((btn) => {
                btn.classList.add('hide-el');
            });

            Ajax("{{route('save-product-admin')}}", 'post', dataForm).then((response) => {
                if (response.status) {
                    ShowFlashMessage(response.message);
                } else {
                    ShowFlashMessage(response.message);
                }
                editAndDeleteProductBtn.forEach((btn) => {
                    btn.classList.remove('hide-el');
                });
            });
        });

        document.body.querySelector('.delete-product-btn').addEventListener('click', () => {
            let dataForm = getDataFormContainer('container-create-product');

            let editAndDeleteProductBtn = document.body.querySelectorAll('.container-create-product .container-btn');
            editAndDeleteProductBtn.forEach((btn) => {
                btn.classList.add('hide-el');
            });

            Ajax("{{route('delete-product-admin')}}", 'post', dataForm).then((response) => {
                if (response.status) {
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                        location.href = "{{route('products-admin-page')}}";
                    }, 1500);
                } else {
                    ShowFlashMessage(response.message);
                    editAndDeleteProductBtn.forEach((btn) => {
                        btn.classList.remove('hide-el');
                    });
                }
            });
        });

    </script>

@stop
