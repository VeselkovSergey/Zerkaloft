@extends('app')

@section('content')

    <div>

        @if(sizeof($allProductsInBasket))

        <div>

            <div style="padding: 25px;">

                <div style=" border-radius: 15px; box-shadow: 0 0 10px rgb(0 0 0 / 75%); flex-wrap: wrap; padding: 25px;" class="client-order-information">

                    <div style="font-weight: bold; font-size: 40px; display: flex; justify-content: space-between;">
                        <div>
                            Корзина
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

                                <div style="display: flex; width: 100%; padding: 25px; border-bottom: 1px solid grey; height: 200px; align-items: center;" data-product-container="{{$product->id}}">

                                    <div style="padding-right: 30px;">
                                        @foreach(unserialize($product->img) as $img)

                                            <div class="" style="display: flex;justify-content: center;align-items: center; width:150px;">
                                                <img style="border-radius: 15px; max-width: 150px; max-height: 150px;" src="{{route('files', $img)}}" alt="Изображение {{$product->title}}">
                                            </div>

                                        @endforeach
                                    </div>

                                    <div style="display: flex; width: 100%; justify-content: space-between; align-items: center; height: 100%;">

                                        <div style="display: flex; flex-direction: column; height: 100%; justify-content: space-around;">
                                            <a  class="product-name-in-basket cp" href="{{route('product', [$product->Subcategory->Category->semantic_url, $product->Subcategory->semantic_url, $product->semantic_url])}}">
                                                <div style="font-size: 25px;">{{$product->title}}</div>
                                            </a>
                                            <div style="font-size: 20px; font-weight: bold;">{{$product->price}}</div>
                                        </div>

                                        <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <button class="button-delete-product-in-basket cp" style="display: flex; justify-content: center; align-items: center; border: unset; color: unset; background-color: unset;" data-product-id="{{$product->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                                </svg>
                                            </button>
                                            <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                                                <input data-product-id="{{$product->id}}" class="input-count-product-in-basket" data-count-product="{{$product->id}}" value="{{$productsInBasket[$product->id]}}" type="text" autocomplete="off" maxlength="2" style="font-size: 20px; cursor: default; border: unset; width: 40px; height: 40px; text-align: center;">
                                                {{--                                    <div  style="width: 40px; height: 40px; line-height: 40px; font-size: 20px;">{{$productsInBasket[$product->id]}}</div>--}}
                                            </div>
                                            <button class="button-add-product-in-basket cp" style="display: flex; justify-content: center; align-items: center; border: unset; color: unset; background-color: unset;" data-product-id="{{$product->id}}">
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

                <div style="display: flex; width: 100%; border-radius: 15px; box-shadow: 0 0 10px rgb(0 0 0 / 75%); flex-wrap: wrap; padding: 25px;" class="client-order-information">

                    <div style="width: 50%;">
                        <div style="padding: 10px;">
                            <label for="client_name">Имя</label>
                            <input data-type-mask="letters" class="need-validate" id="client_name" name="client_name" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Имя" value="{{auth()->check() ? auth()->user()->Name() : ''}}">
                        </div>
                    </div>

                    <div style="width: 50%;">
                        <div style="padding: 10px;">
                            <label for="client_surname">Фамилия</label>
                            <input data-type-mask="letters" class="need-validate" id="client_surname" name="client_surname" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Фамилия" value="{{auth()->check() ? auth()->user()->Surname() : ''}}">
                        </div>
                    </div>

                    <div style="width: 50%;">
                        <div style="padding: 10px;">
                            <label for="client_phone">Номер телефона</label>
                            <input data-type-mask="phone" class="need-validate phone-mask" id="client_phone" maxlength="17" name="client_phone" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="+7(999)-999-99-99" value="{{auth()->check() ? auth()->user()->Phone() : ''}}">
                        </div>
                    </div>

                    <div style="width: 50%;">
                        <div style="padding: 10px;">
                            <label for="client_email">Электронная почта</label>
                            <input class="need-validate" id="client_email" name="client_email" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="domain@email.ru" value="{{auth()->check() ? auth()->user()->email : ''}}">
                        </div>
                    </div>

                    <div style="width: 100%;">
                        <div style="padding: 10px;">
                            <label for="client_comment">Комметарий</label>
                            <textarea id="client_comment" name="client_comment" style="resize: none; width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" placeholder="Комметарий"></textarea>
                        </div>
                    </div>

                    <div style="width: 100%;">
                        <div style="padding: 10px;">
                            <label for="type_payment">Тип оплаты</label>
                            <select name="type_payment" id="type_payment" style="background-color: unset; width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;">
                                <option value="1">Оплата при получении</option>
                                <option value="2">Онлайн оплата</option>
                            </select>
                        </div>
                    </div>

                    <div style="width: 100%;">
                        <div style="padding: 10px;">
                            <label for="type_delivery">Способ получения</label>
                            <select name="type_delivery" id="type_delivery" style="background-color: unset; width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;">
                                <option value="1">Самовывоз</option>
                                <option value="2">Доставка</option>
                            </select>
                        </div>
                    </div>

                    <div style="width: 100%;">
                        <div style="padding: 10px;">
                            <label for="delivery_address">Адрес</label>
                            <input class="need-validate" id="delivery_address" name="delivery_address" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Адрес" value="г.Москва, ул.Тверская, дом 1" readonly>
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

        @else
            <div>

                <div style="padding: 25px;">

                    <div style="font-weight: bold; font-size: 30px; display: flex; justify-content: space-between;">

                            <div>
                                В корзине пусто
                            </div>

                        </div>

                    </div>

            </div>
        @endif

    </div>


@stop

@section('js')

    <script>

        document.body.querySelectorAll('.button-add-product-in-basket').forEach((product) => {
           let productId = product.dataset.productId;
           product.addEventListener('click', (e) => {
               document.body.querySelector('[data-count-product="' + productId + '"]').value = changeCountProductInBasket(productId);
           });
        });

        document.body.querySelectorAll('.button-delete-product-in-basket').forEach((product) => {
            let productId = product.dataset.productId;
            product.addEventListener('click', (e) => {
                let countProductInBasket = changeCountProductInBasket(productId, false);
                if (countProductInBasket === 0) {
                    document.body.querySelector('[data-product-container="' + productId + '"]').remove();
                } else {
                    document.body.querySelector('[data-count-product="' + productId + '"]').value = countProductInBasket;
                }
            });
        });

        document.body.querySelectorAll('.input-count-product-in-basket').forEach((product) => {
            let productId = product.dataset.productId;
            product.addEventListener('change', (e) => {
                let countProductInBasket = Math.abs(e.target.value);
                countProductInBasket = changeCountProductInBasket(productId, 'input', countProductInBasket);
                if (countProductInBasket === 0) {
                    document.body.querySelector('[data-product-container="' + productId + '"]').remove();
                } else {
                    document.body.querySelector('[data-count-product="' + productId + '"]').value = countProductInBasket;
                }
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
                        HideElement(document.body.querySelector('.all-cart-product'));
                    }, 200);
                } else {
                    productsCartInBasketShown = true;
                    document.body.querySelector('.button-show-products-cart-in-basket > svg').classList.remove('rotation-90');
                    ShowElement(document.body.querySelector('.all-cart-product'));
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
                let dataForm = getDataFormContainer('client-order-information', false);
                if (!dataForm) {
                    ShowFlashMessage('Заполните все поля!', 5000);
                    return false;
                }

                dataForm['ordered_products'] = GetAllProductsInBasket();

                let createOrderButton = document.body.querySelector('.client-order-information .button-create-order');
                HideElement(createOrderButton);

                Ajax("{{route('create-order')}}", 'post', dataForm).then((response) => {
                    if (response.status) {
                        ClearAllProductsInBasket();
                        ShowModal('<div style="background-color: white; padding: 25px; font-size: 20px;">Заказ оформлен! С Вами скоро свяжутся!</div>');
                        document.body.querySelector('.modal-close-button').addEventListener('click', (el) => {
                            location.href = "{{route('home-page')}}";
                        });
                    } else {
                        ShowFlashMessage(response.message, 5000);
                    }
                });
            });
        }

        startTrackingNumberInput();


    </script>

@stop
