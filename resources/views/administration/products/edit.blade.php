@extends('administration.index')

@section('content')

    <div>

        @foreach($completeCombinations as $combination)

            <div class="m-5 p-5 product-combination-container">

                <div class="w-100 flex-center-vertical cp" data-combination="{{$combination->id}}">
                    <div>{{($combination->productModification ? '(существует) ' : '') . $combination->title}}</div>
                    <div class="flex-center-vertical">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                        </svg>
                    </div>
                </div>

                <div data-combination-container="{{$combination->id}}" class="border hide container-create-product flex-column w-100">

                    <div class="p-10 w-100 flex">
                        <label class="block">
                            Активный
                            <input name="active" type="checkbox" {{$combination->productModification ? $combination->productModification->active ? 'checked' : '' : ''}}>
                        </label>
                    </div>

                    <div class="hide">
                        <label for="category_id" class="block w-100">Абстрактный продукт</label>
                        <input id="category_id" type="text" class="w-100" value="{{$product->id}}">
                    </div>

                    <div class="hide">
                        <label for="product_combination" class="block w-100">Комбинация</label>
                        <input id="product_combination" type="text" class="w-100" value="{{$combination->id}}">
                    </div>

                    <div class="p-10 w-100">
                        <label for="product_name" class="block w-100">Название продукта</label>
                        <input id="product_name" type="text" class="w-100" value="{{$combination->productModification->title ?? $combination->title}}">
                    </div>

                    <div class="p-10 w-100 hide">
                        <label for="product_seo" class="block w-100">SEO</label>
                        <input id="product_seo" type="text" class="w-100">
                    </div>

                    <div class="p-10 w-100">
                        <label for="product_description" class="block w-100">Описание</label>
                        <textarea class="w-100" name="product_description" id="product_description">{{$combination->productModification->description ?? $combination->title}}</textarea>
                    </div>

                    <div class="border m-10">
                        <div class="btn-new-price p-10 flex-center-vertical cp w-fit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                            </svg>
                            <span class="pl-5">Добавить цену</span>
                        </div>

                            @if(!empty($combination->productModification))

                                <div class="price-container p-10 w-100" data-count-prices="{{count($combination->productModification->Prices)}}">

                                    @foreach($combination->productModification->Prices as $key => $productPrice)

                                        <div class="price flex border mb-10" data-id="{{$key}}">
                                            <div class="p-10 w-50">
                                                <label for="count-{{$key}}" class="block w-100">Измерение</label>
                                                <input name="count[]" id="count-{{$key}}" type="text" class="w-100" value="{{$productPrice->count}}">
                                            </div>

                                            <div class="p-10 w-50">
                                                <label for="price-{{$key}}" class="block w-100">Стоимость</label>
                                                <input name="price[]" id="price-{{$key}}" type="text" class="w-100" value="{{$productPrice->price}}">
                                            </div>

                                            <div class="btn-dell-price cp p-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                                                </svg>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>

                            @else

                                <div class="price-container p-10 w-100" data-count-prices="1">
                                    <div class="price flex border mb-10" data-id="1">
                                        <div class="p-10 w-50">
                                            <label for="count-1" class="block w-100">Измерение</label>
                                            <input name="count[]" id="count-1" type="text" class="w-100">
                                        </div>

                                        <div class="p-10 w-50">
                                            <label for="price-1" class="block w-100">Стоимость</label>
                                            <input name="price[]" id="price-1" type="text" class="w-100">
                                        </div>

                                        <div class="btn-dell-price p-10 cp">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                            @endif

                    </div>

                    @if(!empty($combination->productModification->img) && sizeof(unserialize($combination->productModification->img)))

                        @foreach(unserialize($combination->productModification->img) as $img)

                                <div class="p-10 w-100">
                                    <label class="product-img-label" for="product_img{{$combination->id}}" style="max-width: 300px; max-height: 300px; background-image: url('{{route('files', $img)}}')"></label>
                                    <input class="hide w-100" id="product_img{{$combination->id}}" name="product_img" type="file" accept="image/jpeg, image/png, image/bmp">
                                </div>

                        @endforeach

                    @else

                        <div class="p-10 w-100">
                            <label class="product-img-label" for="product_img{{$combination->id}}" style="max-width: 300px; max-height: 300px; border: 1px solid black;">Загрузите картинку</label>
                            <input class="hide w-100" id="product_img{{$combination->id}}" name="product_img" type="file" accept="image/jpeg, image/png, image/bmp">
                        </div>

                    @endif


                    <div class="p-10 w-100">
                        <button class="create-product-btn container-btn">Сохранить</button>
                        <button class="delete-product-btn container-btn">Удалить</button>
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
                combinationContainer.showToggle();
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

            productCombinationContainer.querySelector('.btn-new-price').addEventListener('click', () => {
                AddPrice(productCombinationContainer)
            });

            productCombinationContainer.querySelectorAll('.btn-dell-price').forEach((el) => {
                el.addEventListener('click', (event) => {
                    DellPrice(event, productCombinationContainer);
                });
            });

            productCombinationContainer.querySelector('.create-product-btn').addEventListener('click', () => {
                let dataForm = GetDataFormContainer('container-create-product', productCombinationContainer);

                let createProductBtn = productCombinationContainer.querySelector('.container-create-product .container-btn');
                createProductBtn.hide();

                Ajax("{{route('save-product-admin')}}", 'post', dataForm).then((response) => {
                    ShowFlashMessage(response.message);
                    createProductBtn.show();
                });
            });

            productCombinationContainer.querySelector('.delete-product-btn').addEventListener('click', (event) => {
                let dataForm = GetDataFormContainer('container-create-product', productCombinationContainer);
                event.target.hide();
                Ajax("{{route('delete-product-admin')}}", 'post', dataForm).then((response) => {
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                       location.reload();
                    }, 1500);
                    event.target.show();
                });
            });

        });

        function AddPrice(productCombinationContainer) {
            let pricesContainer = productCombinationContainer.querySelector('.price-container');
            let countPrices = pricesContainer.dataset.countPrices;
            countPrices++;

            let newPrice = document.createElement("div");
            newPrice.dataset.id = countPrices;
            newPrice.className = 'price mb-10 flex border';
            newPrice.innerHTML =    '<div class="p-10 w-50">'+
                                        '<label for="count-' + countPrices + '" class="block w-50">Измерение</label>'+
                                        '<input name="count[]" id="count-' + countPrices + '" type="text" class="w-100">'+
                                    '</div>'+
                                    '<div class="p-10 w-50">'+
                                        '<label for="price-' + countPrices + '" class="block w-50">Стоимость</label>'+
                                        '<input name="price[]" id="price-' + countPrices + '" type="text" class="w-100">'+
                                    '</div>'+
                                    '<div class="btn-dell-price p-10 cp" data-id="' + countPrices + '">'+
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
