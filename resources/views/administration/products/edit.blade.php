@extends('administration.index')

@section('content')

    <style>
        .price {
            display: flex;
            border: 1px solid;
        }
    </style>

    <div class="m-5 p-5">

        @foreach($completeCombinations as $combination)



            <div class="m-5 p-5 product-combination-container">

                <div class="w-100 flex-center-vertical cp" data-combination="{{$combination->id}}">
                    <div>{{$combination->title}}</div>
                    <div class="flex-center-vertical">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                        </svg>
                    </div>
                </div>


                <div data-combination-container="{{$combination->id}}" class="border hide-el container-create-product flex-column w-100">

                    <div class="p-10 w-100">
                        <label class="block">Активный</label>
                        <input type="checkbox">
                    </div>

                    <div class="hide-el">
                        <label for="category_id" style="display: block; width: 100%;">Абстрактный продукт</label>
                        <input id="category_id" type="text" style="width: 100%;" value="{{$product->id}}">
                    </div>

                    <div class="hide-el">
                        <label for="product_combination" style="display: block; width: 100%;">Комбинация</label>
                        <input id="product_combination" type="text" style="width: 100%;" value="{{$combination->id}}">
                    </div>

                    <div style="padding: 10px; width: 100%;">
                        <label for="product_name" style="display: block; width: 100%;">Название продукта</label>
                        <input id="product_name" type="text" style="width: 100%;">
                    </div>

                    <div style="padding: 10px; width: 100%; display: none;">
                        <label for="product_seo" style="display: block; width: 100%;">SEO</label>
                        <input id="product_seo" type="text" style="width: 100%;">
                    </div>

                    <div style="padding: 10px; width: 100%;">
                        <label for="product_description" style="display: block; width: 100%;">Описание</label>
                        <textarea style="width: 100%;" name="product_description" id="product_description"></textarea>
                    </div>

                    <div class="btn-new-price" style="cursor:pointer; display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                        </svg>
                        <span>Добавить цену</span>
                    </div>

                    <div class="price-container" style="padding: 10px; width: 100%;" data-count-prices="1">

                        <div class="price" data-id="1" style="display: flex; border: 1px solid;">
                            <div style="padding: 10px; width: 50%;">
                                <label for="count-1" style="display: block; width: 100%;">Измерение</label>
                                <input name="count[]" id="count-1" type="text" style="width: 100%;">
                            </div>

                            <div style="padding: 10px; width: 50%;">
                                <label for="price-1" style="display: block; width: 100%;">Стоимость</label>
                                <input name="price[]" id="price-1" type="text" style="width: 100%;">
                            </div>

                            <div class="btn-dell-price" style="cursor:pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                                </svg>
                            </div>
                        </div>

                    </div>

                    <div style="padding: 10px; width: 100%;">
                        <label class="product-img-label" for="product_img{{$combination->id}}" style="max-width: 300px; max-height: 300px; border: 1px solid black;">Загрузите картинку</label>
                        <input class="hide-el" id="product_img{{$combination->id}}" name="product_img" type="file" accept="image/jpeg, image/png, image/bmp" style="width: 100%;">
                    </div>

                    <div style="padding: 10px; width: 100%;">
                        <button class="create-product-btn container-btn" style="width: 100%;">Сохранить</button>
                    </div>

                </div>

            </div>

        @endforeach

    </div>





@stop

@section('js')

    <script>

        document.body.querySelectorAll('[data-combination]').forEach((el) => {
            el.addEventListener('click', () => {
                let combinationId = el.dataset.combination;
                let combinationContainer = document.body.querySelector('[data-combination-container="' + combinationId + '"]');
                ToggleShowElement(combinationContainer);
           });
        });

        document.body.querySelectorAll('.product-combination-container').forEach((productCombinationContainer) => {
            let productImg = productCombinationContainer.querySelector('[name="product_img"]');
            let labelProductImg = productCombinationContainer.querySelector('.product-img-label');

            productImg.addEventListener('input', (event) => {
                let fileReader = new FileReader();
                fileReader.addEventListener("load", () => {
                    labelProductImg.innerHTML = '';
                    labelProductImg.style.border = '';
                    labelProductImg.style.backgroundImage = "url(" + fileReader.result + ")";
                }, false);
                fileReader.readAsDataURL(event.target.files[0]);
            });

            productCombinationContainer.querySelector('.btn-new-price').addEventListener('click', (event) => {
                AddPrice(productCombinationContainer)
            });

            productCombinationContainer.querySelector('.btn-dell-price').addEventListener('click', (event) => {
                DellPrice(event, productCombinationContainer);
            });

            productCombinationContainer.querySelector('.create-product-btn').addEventListener('click', () => {
                let dataForm = getDataFormContainer('container-create-product', false, productCombinationContainer);

                let createProductBtn = productCombinationContainer.querySelector('.container-create-product .container-btn');
                //createProductBtn.classList.add('hide-el');

                Ajax("{{route('save-product-admin')}}", 'post', dataForm).then((response) => {
                    if (response.status) {
                        ShowFlashMessage(response.message);
                        {{--setTimeout(() => {--}}
                        {{--    //location.href = "{{route('products-admin-page')}}";--}}
                        {{--}, 1500);--}}
                    } else {
                        ShowFlashMessage(response.message);
                        //createProductBtn.classList.remove('hide-el');
                    }
                });
            });

        });

        function AddPrice(productCombinationContainer) {
            let pricesContainer = productCombinationContainer.querySelector('.price-container');
            let countPrices = pricesContainer.dataset.countPrices;
            countPrices++;

            let newPrice = document.createElement("div");
            newPrice.dataset.id = countPrices;
            newPrice.className = 'price';

            newPrice.innerHTML = '<div style="padding: 10px; width: 50%;">'+
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
                DellPrice(event, productCombinationContainer);
            });
        }

        function DellPrice(event, productCombinationContainer) {
            let pricesContainer = productCombinationContainer.querySelector('.price-container');
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
