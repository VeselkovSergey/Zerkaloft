@extends('administration.index')

@section('content')

    <style>
        .price {
            display: flex;
            border: 1px solid;
        }
    </style>

    <div class="container-create-product" style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%; display: none;">
            <label for="product_id" style="display: block; width: 100%;">ID продукта</label>
            <input class="need-validate" id="product_id" name="product_id" type="text"  value="{{$product->id}}" style="width: 100%;">
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

        <div style="padding: 10px; width: 100%;">
            <label for="product_description" style="display: block; width: 100%;">Описание</label>
            <textarea style="width: 100%;" name="product_description" id="product_description">{{$product->description}}</textarea>
        </div>

{{--        <div style="padding: 10px; width: 100%;">--}}
{{--            <label for="product_price" style="display: block; width: 100%;">Стоимость</label>--}}
{{--            <input id="product_price" type="text" style="width: 100%;" value="{{$product->price}}">--}}
{{--        </div>--}}

        <div class="btn-new-price" style="cursor:pointer; display: flex; align-items: center;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
            </svg>
            <span>Добавить цену</span>
        </div>

        <div class="price-container" style="padding: 10px; width: 100%;" data-count-prices="{{count($product->Prices)}}">

            @foreach($product->Prices as $key => $productPrice)

            <div class="price" data-id="{{$key}}" style="display: flex; border: 1px solid;">
                <div style="padding: 10px; width: 50%;">
                    <label for="count-{{$key}}" style="display: block; width: 100%;">Измерение</label>
                    <input name="count[]" id="count-{{$key}}" type="text" style="width: 100%;" value="{{$productPrice->count}}">
                </div>

                <div style="padding: 10px; width: 50%;">
                    <label for="price-{{$key}}" style="display: block; width: 100%;">Стоимость</label>
                    <input name="price[]" id="price-{{$key}}" type="text" style="width: 100%;" value="{{$productPrice->price}}">
                </div>

                <div class="btn-dell-price" style="cursor:pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                    </svg>
                </div>
            </div>

            @endforeach

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

        document.body.querySelector('.btn-new-price').addEventListener('click', (event) => {
            AddPrice()
        });

        document.body.querySelectorAll('.btn-dell-price').forEach((price) => {
            price.addEventListener('click', (event) => {
                DellPrice(event);
            });
        });

        function AddPrice() {
            let pricesContainer = document.querySelector('.price-container');
            let countPrices = pricesContainer.dataset.countPrices;
            countPrices++;

            let newPrice = document.createElement("div");
            newPrice.dataset.id = countPrices;
            newPrice.className = 'price';

            newPrice.innerHTML =    '<div style="padding: 10px; width: 50%;">'+
                                        '<label for="count-' + countPrices + '" style="display: block; width: 100%;">Измерение</label>'+
                                        '<input name="count[]" id="count-' + countPrices + '" type="text" style="width: 100%;">'+
                                    '</div>'+

                                    '<div style="padding: 10px; width: 50%;">'+
                                        '<label for="price-' + countPrices + '" style="display: block; width: 100%;">Стоимость</label>'+
                                        '<input name="price[]" id="price-' + countPrices + '" type="text" style="width: 100%;">'+
                                    '</div>'+

                                    '<div class="btn-dell-price" data-id="' + countPrices + '" style="cursor:pointer;">'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">'+
                                            '<path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>'+
                                        '</svg>'+
                                    '</div>';

            pricesContainer.append(newPrice);
            newPrice.querySelector('.btn-dell-price').addEventListener('click', (event) => {
                DellPrice(event);
            });
        }

        function DellPrice(event) {
            let pricesContainer = document.querySelector('.price-container');
            if (pricesContainer.children.length > 1) {
                event.path.forEach((el) => {
                    if (el.classList !== undefined) {
                        if (el.classList.contains('price')) {
                            el.remove();
                        }
                    }
                });
            }
        }

    </script>

@stop
