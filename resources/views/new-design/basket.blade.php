@extends("new-design.app")

@section("content")
    @if(sizeof($allProductsInBasket))

    <div class="basket-products">
        <div class="px-0-adaptive-10">
            <div class="w-70-adaptive-100 mb-10 all-cart-product">
                @foreach($allProductsInBasket as $product)
                    <div class="container-product-in-basket flex-adaptive-column"
                         style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid white;"
                         data-product-container="{{$product->id . '-' . $product->price_id}}"
                    >
                        <div class="hide-adaptive">
                            @foreach(unserialize($product->img) as $img)
                                <div class="mr-10" style="width: 40px; height: 40px;">
                                    <img src="{{route('files', $img)}}" alt="{{$product->title}}">
                                </div>
                            @endforeach
                        </div>
                        <div class="w-90-adaptive-100">
                            <div class="mr-10-adaptive-0">
                                <div class="flex">
                                    <div class="mb-10 flex-center">
                                        <div class="show-adaptive">
                                            @foreach(unserialize($product->img) as $img)
                                                <div class="mr-10" style="width: 40px; height: 40px;">
                                                    <img src="{{route('files', $img)}}" alt="{{$product->title}}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="w-100 mb-10" style="border: 1px solid white; border-radius: 25px; padding: 10px;">
                                        {{$product->title}}
                                    </div>
                                </div>
                                <div class="flex-adaptive-column">
                                    <div class="w-75-adaptive-100">
                                        <div class="mr-10-adaptive-0">
                                            @if(isset($additionalServices[$product->id]))
                                                @foreach($additionalServices[$product->id] as $additionalService)
                                            <div
                                                data-product-id="{{$product->id}}"
                                                data-product-price-id="{{$product->price_id}}"
                                                data-product-container="{{$product->id . '-' . $product->price_id}}"
                                                data-additional-service-id="{{$additionalService->additional_service_id}}"
                                                data-additional-service-price="{{$additionalService->price}}"
                                                class="mb-10"
                                                style="border: 1px solid white; border-radius: 25px; padding: 10px;"
                                            >
                                                <span>{{$additionalService->AdditionalServices->title}} - {{$additionalService->price}}</span>
                                                <span style="display: none;" class="flex-center ml-5 cp delete-additional-service">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </span>
                                            </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w-25-adaptive-100 flex-column-end-y">
                                        <div class="flex-center" style="border: 1px solid white; border-radius: 25px; padding: 10px; margin-bottom: 10px;">
                                            {{$product->count}} {{$product->price}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-10-adaptive-100">
                            <div class="flex-space-x container-amount" style="border: 1px solid white; border-radius: 25px; padding: 10px;">
                                <div class="flex-center button-delete-product-in-basket"
                                     data-product-id="{{$product->id}}"
                                     data-product-price-id="{{$product->price_id}}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>
                                    </svg>
                                </div>
                                <div>
                                    <input data-product-id="{{$product->id}}"
                                           data-delete-accept="false"
                                           data-product-price-id="{{$product->price_id}}"
                                           class="input-count-product-in-basket border"
                                           data-count-product="{{$product->id . '-' . $product->price_id}}"
                                           value="{{$productsInBasket[$product->id][$product->price_id]['count']}}"
                                           type="text" autocomplete="off" maxlength="2"
                                           readonly
                                           style="border: unset; cursor: default; width: 26px; text-align: center; color: white; background-color: var(--main-bg-color);">
                                </div>
                                <div class="flex-center button-add-product-in-basket" style="color: green;"
                                     data-product-id="{{$product->id}}"
                                     data-product-price-id="{{$product->price_id}}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div>Итого: <span class="sum-products-prices-in-basket"></span></div>
            <div class="flex-adaptive-column client-order-information">
                <div class="w-70-adaptive-100 mb-10" style="margin-right: auto;">
                    <div class="h3 flex-center mb-10">ОФОРМЛЕНИЕ</div>
                    <div>
                        <div class="flex-space-x-adaptive-column">
                            <div class="mb-10 w-50-adaptive-100 mr-10-adaptive-0">
                                <input
                                    id="client_name"
                                    name="client_name"
                                    type="text"
                                    placeholder="Имя"
                                    class="need-validate"
                                    style="border: 1px solid white; border-radius: 25px; padding: 10px 10px 10px 20px; width: calc(100% - 31px); background-color: var(--main-bg-color); color: white; font-size: 16px;"
                                    value="{{auth()->check() ? auth()->user()->Name() : ''}}"
                                >
                            </div>
                            <div class="mb-10 w-50-adaptive-100">
                                <input
                                    type="text"
                                    placeholder="Фамилия"
                                    style="border: 1px solid white; border-radius: 25px; padding: 10px 10px 10px 20px; width: calc(100% - 31px); background-color: var(--main-bg-color); color: white; font-size: 16px;"
                                    class="need-validate"
                                    id="client_surname"
                                    name="client_surname"
                                    value="{{auth()->check() ? auth()->user()->Surname() : ''}}"
                                >
                            </div>
                        </div>
                        <div class="flex-space-x-adaptive-column">
                            <div class="mb-10 w-50-adaptive-100 mr-10-adaptive-0">
                                <input
                                    type="text"
                                    placeholder="Телефон"
                                    style="border: 1px solid white; border-radius: 25px; padding: 10px 10px 10px 20px; width: calc(100% - 31px); background-color: var(--main-bg-color); color: white; font-size: 16px;"
                                    class="need-validate phone-mask"
                                    id="client_phone"
                                    name="client_phone"
                                    value="{{auth()->check() ? auth()->user()->Phone() : ''}}"
                                >
                            </div>
                            <div class="mb-10 w-50-adaptive-100">
                                <input
                                    type="text"
                                    placeholder="Электронная почта"
                                    style="border: 1px solid white; border-radius: 25px; padding: 10px 10px 10px 20px; width: calc(100% - 31px); background-color: var(--main-bg-color); color: white; font-size: 16px;"
                                    class="need-validate"
                                    id="client_email"
                                    name="client_email"
                                    value="{{auth()->check() ? auth()->user()->email : ''}}"
                                >
                            </div>
                        </div>
                        <div class="mb-10">
                            <textarea
                                id="client_comment"
                                name="client_comment"
                                cols="30"
                                rows="5"
                                placeholder="Комментарий"
                                style="resize: vertical; border: 1px solid white; border-radius: 25px; padding: 10px 10px 10px 20px; width: calc(100% - 31px); background-color: var(--main-bg-color); color: white; font-size: 16px;"
                            ></textarea>
                        </div>
                        <div class="flex-space-x-adaptive-column">
                            <div class="mb-10 w-50-adaptive-100 mr-10-adaptive-0">
                                <select name="type_payment" id="type_payment" class="select-3 w-100">
                                    <option value="1">Оплата при получении</option>
                                    <option value="2">Онлайн оплата</option>
                                </select>
                            </div>
                            <div class="mb-10 w-50-adaptive-100">
                                <select name="type_delivery" id="type_delivery" class="select-3 w-100">
                                    <option value="1">Самовывоз</option>
                                    <option value="2">Доставка</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-10">
                            <input
                                type="text"
                                placeholder="Адрес"
                                style="border: 1px solid white; border-radius: 25px; padding: 10px 10px 10px 20px; width: calc(100% - 31px); background-color: var(--main-bg-color); color: white; font-size: 16px;"
                                class="need-validate"
                                id="delivery_address"
                                name="delivery_address"
                                value="{{$pickupAddress}}"
                                readonly
                            >
                        </div>
                    </div>
                </div>

                <div class="w-25-adaptive-100 flex-column-end-y mb-10">
                    <div class="mb-10" style="border: 1px solid white; border-radius: 25px; padding: 20px;">
                        <div class="button-create-order mb-20 text-center" style="padding: 10px 20px; border: 1px solid black; border-radius: 25px; font-size: 20px; background-color: white; color: black;">ОФОРМИТЬ</div>
                        <div class="order-payment-button hide mb-20 text-center" style="padding: 10px 20px; border: 1px solid black; border-radius: 25px; font-size: 20px; background-color: white; color: black;">ОПЛАТИТЬ</div>
                        <div>
                            <span style="vertical-align: middle; color: var(--pink-color);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                </svg>
                            </span>
                            Согласен с <a href="#">условиями</a> Правил
                            пользования торговой площадкой и правилами
                            возврата и обработки персональных данных.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include("new-design.info")
    </div>

    @endif

    <div class="basket-empty @if(sizeof($allProductsInBasket)) hide @endif">В корзине пусто</div>

@endsection

@section("js")
    <script src="https://3dsec.sberbank.ru/payment/docsite/assets/js/ipay.js"></script>

    <script>

        const ipay = new IPAY({api_token: sberKey});

        const buttonAddProductInBasket = document.body.querySelector('.button-create-order');
        const orderPaymentButton = document.body.querySelector('.order-payment-button');

        function OrderPay() {
            if (!CheckingFieldForEmptiness('client-order-information', true)) {
                return false;
            }

            ipayCheckout({
                    amount: localStorage.getItem('sumProductsPricesInBasket'),
                    currency: 'RUB',
                    order_number: '',
                    // description: 'А. С. Пушкин. Избранное (подарочное издание)'
                },
                function (order) {
                    let buttonAddProductInBasket = document.body.querySelector('.button-create-order');
                    if (buttonAddProductInBasket !== null) {
                        triggerEvent(buttonAddProductInBasket, 'click');
                    }
                    //showSuccessfulPurchase(order)
                },
                function (order) {
                    //showFailurefulPurchase(order)
                });
        }


        document.body.querySelector('#type_payment')?.addEventListener('change', (event) => {
            if (parseInt(event.target.value) === 1) {
                buttonAddProductInBasket.show();
                orderPaymentButton.hide();
            } else {
                orderPaymentButton.show();
                buttonAddProductInBasket.hide();
            }
        });

        @if(!sizeof($allProductsInBasket))
        ClearAllProductsInBasket();
        @endif

        const pickupAddress = "{{$pickupAddress}}";

        let sumProductsPricesInBasket = document.body.querySelector('.sum-products-prices-in-basket');
        if (sumProductsPricesInBasket) {
            sumProductsPricesInBasket.innerHTML = '(' + localStorage.getItem('sumProductsPricesInBasket') + ' руб)';
        }

        document.body.querySelectorAll('.delete-additional-service').forEach((additionalServiceButton) => {
            additionalServiceButton.addEventListener('click', (event) => {
                let clickedButton = event.target;
                let additionalServiceClicked = clickedButton.closest('.additional-service');
                let productId = additionalServiceClicked.dataset.productId;
                let productPriceId = additionalServiceClicked.dataset.productPriceId;
                let additionalServiceContainer = clickedButton.closest('.additional-service-container');

                additionalServiceClicked.remove();

                let additionalServicesSelection = [];
                let additionalServicesSelectionPrice = [];
                let additionalServices = additionalServiceContainer.querySelectorAll('.additional-service');
                additionalServices.forEach((additionalService) => {
                    additionalServicesSelection.push(additionalService.dataset.additionalServiceId);
                    additionalServicesSelectionPrice.push(additionalService.dataset.additionalServicePrice);
                });

                let count = document.body.querySelector('[data-count-product="' + productId + '-' + productPriceId + '"]').value

                changeCountProductInBasket({
                    productId: productId,
                    productPriceId: productPriceId,
                    additionalServicesSelection: additionalServicesSelection,
                    additionalServicesSelectionPrice: additionalServicesSelectionPrice
                }, 'input', count);

                sumProductsPricesInBasket.innerHTML = '(' + localStorage.getItem('sumProductsPricesInBasket') + ' руб)';

            });
        });

        document.body.querySelectorAll('.button-add-product-in-basket').forEach((product) => {
            let productId = product.dataset.productId;
            let productPriceId = product.dataset.productPriceId;
            product.addEventListener('click', (e) => {
                document.body.querySelector('[data-count-product="' + productId + '-' + productPriceId + '"]').value = changeCountProductInBasket({
                    productId: productId,
                    productPriceId: productPriceId
                });
                sumProductsPricesInBasket.innerHTML = '(' + localStorage.getItem('sumProductsPricesInBasket') + ' руб)';
            });
        });

        document.body.querySelectorAll('.button-delete-product-in-basket').forEach((product) => {
            let productId = product.dataset.productId;
            let productPriceId = product.dataset.productPriceId;
            product.addEventListener('click', (e) => {

                let countProductInBasketPreProcess = e.target.closest('.container-amount').querySelector('.input-count-product-in-basket');

                if (parseInt(countProductInBasketPreProcess.value) === 1 && countProductInBasketPreProcess.dataset.deleteAccept === 'false') {
                    ModalWindow('Остался последний товар в корзине! Если хотите удалить, просто повторите удаление.');
                    countProductInBasketPreProcess.dataset.deleteAccept = 'true';
                    setTimeout(() => {
                        countProductInBasketPreProcess.dataset.deleteAccept = 'false';
                    }, 15000)
                    return;
                }

                let countProductInBasket = changeCountProductInBasket({
                    productId: productId,
                    productPriceId: productPriceId
                }, false);
                if (countProductInBasket === 0) {
                    document.body.querySelector('[data-product-container="' + productId + '-' + productPriceId + '"]').remove();
                    EmptyBasketCheck();
                } else {
                    document.body.querySelector('[data-count-product="' + productId + '-' + productPriceId + '"]').value = countProductInBasket;
                }
                sumProductsPricesInBasket.innerHTML = '(' + localStorage.getItem('sumProductsPricesInBasket') + ' руб)';
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
                countProductInBasket = changeCountProductInBasket({
                    productId: productId,
                    productPriceId: productPriceId
                }, 'input', countProductInBasket);
                if (countProductInBasket === 0) {
                    document.body.querySelector('[data-product-container="' + productId + '-' + productPriceId + '"]').remove();
                    EmptyBasketCheck();
                } else {
                    document.body.querySelector('[data-count-product="' + productId + '-' + productPriceId + '"]').value = countProductInBasket;
                }
                sumProductsPricesInBasket.innerHTML = '(' + localStorage.getItem('sumProductsPricesInBasket') + ' руб)';
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
                    inputDeliveryAddress.value = pickupAddress;
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

        let buttonClearBasket = document.body.querySelector('.button-clear-basket');
        if (buttonClearBasket) {
            buttonClearBasket.addEventListener('click', () => {
                ClearAllProductsInBasket(true);
            });
        }

        startTrackingNumberInput();


    </script>
@endsection
