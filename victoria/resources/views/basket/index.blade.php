@extends('app')

@section('content')

    <div>

        <div>

            <div style="font-weight: bold; font-size: 40px; padding: 25px 25px 0 25px; display: flex; justify-content: space-between;">
                <div>
                    Корзина
                </div>
                <div class="button-show-products-cart-in-basket">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-chevron-down cp" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>

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

            <div style="padding: 25px;">

                <div style="display: flex; width: 50%; border-radius: 15px; box-shadow: 0 0 10px rgb(0 0 0 / 75%); flex-wrap: wrap;">

                    <div style="width: 50%;">
                        <div style="padding: 10px;">
                            <label for="client_name">Имя</label>
                            <input id="client_name" name="client_name" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Имя" value="">
                        </div>
                    </div>

                    <div style="width: 50%;">
                        <div style="padding: 10px;">
                            <label for="client_surname">Фамилия</label>
                            <input id="client_surname" name="client_surname" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Фамилия" value="">
                        </div>
                    </div>

                    <div style="width: 100%;">
                        <div style="padding: 10px;">
                            <label for="client_phone">Номер телефона</label>
                            <input id="client_phone" name="client_phone" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="+79999999999" value="">
                        </div>
                    </div>

                    <div style="width: 100%;">
                        <div style="padding: 10px;">
                            <label for="client_email">Почта</label>
                            <input id="client_email" name="client_email" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Почта" value="">
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
                            <div style="font-weight: bold; font-size: 20px; text-align: center;">
                                <button class="button-add-in-basket" style="width: 80%;">Оформить заказ</button>
                            </div>
                        </div>
                    </div>



                </div>

            </div>

        </div>

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
        document.body.querySelector('.button-show-products-cart-in-basket').addEventListener('click', (e) => {
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
        })



    </script>

@stop
