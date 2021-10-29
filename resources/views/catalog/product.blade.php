@extends('app')

@section('content')

    @php($title_page = $product->title)

    <div>

        <div data-product-id="{{$product->id}}" class="product-id hide">{{$product->id}}</div>

        <div class="full-text-product text-center pb-10" style="font-size: 24px; font-weight: bold; text-transform: uppercase; border-bottom: 1px solid grey">{{$product->Category->title . ' ' . $product->title}}</div>

        <div class="product-container-product-page flex-wrap mt-20">

            <div class="mb-25">
                <div class="flex-center">
                    @foreach(unserialize($product->img) as $img)
                        <img class="border-radius-15" src="{{route('files', $img)}}" alt="Изображение {{$product->title}}">
                    @endforeach
                </div>
            </div>

            <div class="px-25">
                <select name="price" class="need-validate w-100 p-5 border-radius-5" id="price">
                    @if(sizeof($product->Prices))
                        @php($tempProductPrice = [])
                        @foreach($product->Prices as $productPrice)
                                @php($tempProductPrice[$productPrice->id] = $productPrice->toArray())
                            <option value="{{$productPrice->id}}" @if(($product->Prices)[0]->id == $productPrice->id) selected @endif >{{$productPrice->count . ' ' . $productPrice->price}}</option>
                        @endforeach
                        @php($product->prices = $tempProductPrice)
                    @else
                        <option disabled>Нет цен</option>
                    @endif
                </select>

                <div class="mt-20 flex">
                    <button class="button-add-in-basket p-5 mr-10">В корзину</button>
                    <a class="clear-a button-link-basket-page hide" href="{{route('basket-page')}}"><button class="button-blue">Перейти в корзину</button></a>
                </div>

                <div class="mt-20">
                    {{$product->description}}
                </div>

            </div>

        </div>

    </div>

@stop

@section('js')

    <script>

        const product = JSON.parse('@json($product->getAttributes(), JSON_UNESCAPED_UNICODE)');

        let productAdded = false;
        let buttonAddInBasket = document.body.querySelector('.button-add-in-basket')
        let buttonLinkBasketPage = document.body.querySelector('.button-link-basket-page')
        buttonAddInBasket.addEventListener('click', (e) => {
            let productId = product.id;
            let productPriceId = document.body.querySelector('#price').value;
            let productFullInformation = product;
            changeCountProductInBasket({productId: productId, productPriceId: productPriceId, productFullInformation: productFullInformation});
            if (!productAdded) {
                buttonAddInBasket.innerHTML = '+1 в корзину';
                buttonLinkBasketPage.show()
            }
        });

    </script>

@stop
