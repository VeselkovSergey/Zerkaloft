@extends('app')

@section('content')

    <div class="basket-container">

        @if(sizeof($allProductsInBasket))

        <div class="basket-products">

            <div style="padding: 25px;">

                <div style=" border-radius: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.25); flex-wrap: wrap; padding: 25px;" class="client-order-information">

                    <div style="font-weight: bold; font-size: 40px; display: flex; justify-content: space-between;">
                        <div>
                            Корзина
                            <span class="sum-products-prices-in-basket"></span>
                        </div>
                        <button class="button-show-products-cart-in-basket" style="border: unset; color: unset; background-color: unset;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-chevron-down cp" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>

                    </div>

                    <div>

                        <div class="all-cart-product" style="overflow: hidden;">

                            @foreach($allProductsInBasket as $product)

                                <div style="display: flex; width: 100%; padding: 25px; border-bottom: 1px solid grey; height: 200px; align-items: center;" data-product-container="{{$product->id . '-' . $product->price_id}}">

                                    <div style="padding-right: 30px;">
                                        @foreach(unserialize($product->img) as $img)

                                            <div class="" style="display: flex;justify-content: center;align-items: center; width:150px;">
                                                <img style="border-radius: 15px; max-width: 150px; max-height: 150px;" src="{{route('files', $img)}}" alt="Изображение {{$product->title}}">
                                            </div>

                                        @endforeach
                                    </div>

                                    <div style="display: flex; width: 100%; justify-content: space-between; align-items: center; height: 100%;">

                                        <div style="display: flex; flex-direction: column; height: 100%; justify-content: space-around;">
                                            <a  class="product-name-in-basket cp" href="{{route('product', [$product->Product->Category->semantic_url, $product->Product->semantic_url])}}">
                                                <div style="font-size: 25px;">{{$product->title}}</div>
                                            </a>
                                            <div style="font-size: 20px; font-weight: bold;">{{$product->count . ' ' . $product->price}}</div>
                                        </div>

                                        <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <button class="button-delete-product-in-basket cp" style="display: flex; justify-content: center; align-items: center; border: unset; color: unset; background-color: unset;" data-product-id="{{$product->id}}" data-product-price-id="{{$product->price_id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                                </svg>
                                            </button>
                                            <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                                                <input data-product-id="{{$product->id}}" data-product-price-id="{{$product->price_id}}" class="input-count-product-in-basket" data-count-product="{{$product->id . '-' . $product->price_id}}" value="{{$productsInBasket[$product->id][$product->price_id]['count']}}" type="text" autocomplete="off" maxlength="2" style="font-size: 20px; cursor: default; border: unset; width: 40px; height: 40px; text-align: center;">
                                            </div>
                                            <button class="button-add-product-in-basket cp" style="display: flex; justify-content: center; align-items: center; border: unset; color: unset; background-color: unset;" data-product-id="{{$product->id}}" data-product-price-id="{{$product->price_id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                </svg>
                                            </button>
                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            </div>

            <div style="padding: 25px;">

                <div style="display: flex; width: 100%; border-radius: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.25); flex-wrap: wrap; padding: 25px;" class="client-order-information">

                    <div style="width: 50%;">
                        <div style="padding: 10px;">
                            <label for="client_name">Имя</label>
                            <input data-type-mask="letters" class="need-validate border-black" id="client_name" name="client_name" style="width: 100%; padding: 10px; border-radius: 5px;" type="text" placeholder="Имя" value="{{auth()->check() ? auth()->user()->Name() : ''}}">
                        </div>
                    </div>

                    <div style="width: 50%;">
                        <div style="padding: 10px;">
                            <label for="client_surname">Фамилия</label>
                            <input data-type-mask="letters" class="need-validate border-black" id="client_surname" name="client_surname" style="width: 100%; padding: 10px; border-radius: 5px;" type="text" placeholder="Фамилия" value="{{auth()->check() ? auth()->user()->Surname() : ''}}">
                        </div>
                    </div>

                    <div style="width: 50%;">
                        <div style="padding: 10px;">
                            <label for="client_phone">Номер телефона</label>
                            <input data-type-mask="phone" class="need-validate phone-mask border-black" id="client_phone" maxlength="17" name="client_phone" style="width: 100%; padding: 10px; border-radius: 5px;" type="text" placeholder="+7(999)-999-99-99" value="{{auth()->check() ? auth()->user()->Phone() : ''}}">
                        </div>
                    </div>

                    <div style="width: 50%;">
                        <div style="padding: 10px;">
                            <label for="client_email">Электронная почта</label>
                            <input class="need-validate border-black" id="client_email" name="client_email" style="width: 100%; padding: 10px; border-radius: 5px;" type="text" placeholder="domain@email.ru" value="{{auth()->check() ? auth()->user()->email : ''}}">
                        </div>
                    </div>

                    <div style="width: 100%;">
                        <div style="padding: 10px;">
                            <label for="client_comment">Комметарий</label>
                            <textarea id="client_comment" name="client_comment" class="border-black" style="resize: none; width: 100%; padding: 10px; border-radius: 5px;" placeholder="Комметарий"></textarea>
                        </div>
                    </div>

                    <div style="width: 100%;">
                        <div style="padding: 10px;">
                            <label for="type_payment">Тип оплаты</label>
                            <select name="type_payment" id="type_payment" class="border-black" style="background-color: unset; width: 100%; padding: 10px; border-radius: 5px;">
                                <option value="1">Оплата при получении</option>
                                <option value="2">Онлайн оплата</option>
                            </select>
                        </div>
                    </div>

                    <div style="width: 100%;">
                        <div style="padding: 10px;">
                            <label for="type_delivery">Способ получения</label>
                            <select name="type_delivery" id="type_delivery" class="border-black" style="background-color: unset; width: 100%; padding: 10px; border-radius: 5px;">
                                <option value="1">Самовывоз</option>
                                <option value="2">Доставка</option>
                            </select>
                        </div>
                    </div>

                    <div style="width: 100%;">
                        <div style="padding: 10px;">
                            <label for="delivery_address">Адрес</label>
                            <input class="need-validate border-black suggestions-address" id="delivery_address" name="delivery_address" style="width: 100%; padding: 10px; border-radius: 5px;" type="text" placeholder="Адрес" value="г.Москва, ул.Тверская, дом 1" readonly>
                        </div>
                    </div>

                    <div style="width: 100%;">
                        <div style="padding: 10px;">
                            <div style="font-weight: bold; font-size: 20px; text-align: center;">
                                <button class="button-create-order" style="width: 80%; margin: auto;">Оформить заказ</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        @endif

        <div class="basket-empty @if(sizeof($allProductsInBasket)) hide @endif">

            <div style="padding: 25px;">

                <div style="font-weight: bold; font-size: 30px; display: flex; justify-content: space-between;">

                    <div>
                        В корзине пусто
                    </div>

                </div>

            </div>

        </div>

    </div>


@stop

@section('js')

    <script>

        let sumProductsPricesInBasket = document.body.querySelector('.sum-products-prices-in-basket');
        if (sumProductsPricesInBasket) {
            sumProductsPricesInBasket.innerHTML = '('+ localStorage.getItem('sumProductsPricesInBasket') +' руб)';
        }

        document.body.querySelectorAll('.button-add-product-in-basket').forEach((product) => {
           let productId = product.dataset.productId;
           let productPriceId = product.dataset.productPriceId;
           product.addEventListener('click', (e) => {
               document.body.querySelector('[data-count-product="' + productId + '-' + productPriceId + '"]').value = changeCountProductInBasket({productId: productId, productPriceId: productPriceId});
               sumProductsPricesInBasket.innerHTML = '('+ localStorage.getItem('sumProductsPricesInBasket') +' руб)';
           });
        });

        document.body.querySelectorAll('.button-delete-product-in-basket').forEach((product) => {
            let productId = product.dataset.productId;
            let productPriceId = product.dataset.productPriceId;
            product.addEventListener('click', (e) => {
                let countProductInBasket = changeCountProductInBasket({productId: productId, productPriceId: productPriceId}, false);
                if (countProductInBasket === 0) {
                    document.body.querySelector('[data-product-container="' + productId + '-' + productPriceId + '"]').remove();
                    EmptyBasketCheck();
                } else {
                    document.body.querySelector('[data-count-product="' + productId + '-' + productPriceId + '"]').value = countProductInBasket;
                }
                sumProductsPricesInBasket.innerHTML = '('+ localStorage.getItem('sumProductsPricesInBasket') +' руб)';
            });
        });

        function EmptyBasketCheck() {
            if (document.body.querySelector('.all-cart-product').children.length === 0) {
                document.body.querySelector('.basket-products').remove();
                document.body.querySelector('.basket-empty').show();
            }
        }

        document.body.querySelectorAll('.input-count-product-in-basket').forEach((product) => {
            let productId = product.dataset.productId;
            let productPriceId = product.dataset.productPriceId;
            product.addEventListener('change', (e) => {
                let countProductInBasket = Math.abs(e.target.value);
                countProductInBasket = changeCountProductInBasket({productId: productId, productPriceId: productPriceId}, 'input', countProductInBasket);
                if (countProductInBasket === 0) {
                    document.body.querySelector('[data-product-container="' + productId + '-' + productPriceId + '"]').remove();
                    EmptyBasketCheck();
                } else {
                    document.body.querySelector('[data-count-product="' + productId + '-' + productPriceId + '"]').value = countProductInBasket;
                }
                sumProductsPricesInBasket.innerHTML = '('+ localStorage.getItem('sumProductsPricesInBasket') +' руб)';
            });
        });

        let productsCartInBasketShown = true;
        let buttonShowProductsCartInBasket = document.body.querySelector('.button-show-products-cart-in-basket');
        if (buttonShowProductsCartInBasket !== null) {
            buttonShowProductsCartInBasket.addEventListener('click', (e) => {
                if (productsCartInBasketShown) {
                    productsCartInBasketShown = false;
                    document.body.querySelector('.button-show-products-cart-in-basket > svg').classList.add('rotation-90');
                    document.body.querySelector('.all-cart-product').classList.add('height-0');
                    setTimeout(() => {
                        document.body.querySelector('.all-cart-product').hide();
                    }, 200);
                } else {
                    productsCartInBasketShown = true;
                    document.body.querySelector('.button-show-products-cart-in-basket > svg').classList.remove('rotation-90');
                    document.body.querySelector('.all-cart-product').show();
                    setTimeout(() => {
                        document.body.querySelector('.all-cart-product').classList.remove('height-0');
                    }, 10);
                }
            });
        }

        let inputTypeDelivery = document.body.querySelector('#type_delivery');
        if (inputTypeDelivery !== null) {
            inputTypeDelivery.addEventListener('change', (e) => {
                let inputDeliveryAddress = document.body.querySelector('#delivery_address');
                if (parseInt(e.target.value) === 1) {
                    inputDeliveryAddress.readOnly = true;
                    inputDeliveryAddress.value = 'г.Москва, ул.Тверская, дом 1';
                } else {
                    inputDeliveryAddress.readOnly = false;
                    @php
                        $address = auth()->check() ? auth()->user()->type_user === 2 ? auth()->user()->DetailedInformation->address_physical_org : '' : '';
                    @endphp
                    inputDeliveryAddress.value = "{{$address}}";
                }
            });
        }

        document.body.querySelectorAll('[data-type-mask="phone"], [data-type-mask="letters"]').forEach((input) => {
            let typeMask = input.dataset.typeMask;
            input.addEventListener('input', (e) => {
                if (typeMask === 'phone') {
                    input.value = returnOnlyPhoneNumber(input.value);
                } else if (typeMask === 'letters') {
                    input.value = returnOnlyLetter(input.value);
                }
            });
        });

        let buttonAddProductInBasket = document.body.querySelector('.button-create-order');
        if (buttonAddProductInBasket !== null) {
            buttonAddProductInBasket.addEventListener('click', (e) => {

                if (!CheckingFieldForEmptiness('client-order-information', true)) {
                    return false;
                }

                let dataForm = GetDataFormContainer('client-order-information');

                dataForm['ordered_products'] = GetAllProductsInBasket();

                let createOrderButton = document.body.querySelector('.client-order-information .button-create-order');
                createOrderButton.hide();

                Ajax("{{route('create-order')}}", 'post', dataForm).then((response) => {
                    if (response.status) {
                        ClearAllProductsInBasket();
                        ModalWindow('Заказ оформлен! С Вами скоро свяжутся!', () => {
                            location.href = "{{route('home-page')}}";
                        });
                    } else {
                        ShowFlashMessage(response.message, 5000);
                        createOrderButton.show();
                    }
                });
            });
        }

        startTrackingNumberInput();


    </script>

@stop
