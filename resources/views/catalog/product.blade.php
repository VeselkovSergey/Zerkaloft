@extends('app')

@section('content')

    @php($title_page = $product->title)

    <div>

        <div data-product-id="{{$product->id}}" class="product-id hide">{{$product->id}}</div>

        <div class="full-text-product text-center pb-10" style="font-size: 24px; font-weight: bold; text-transform: uppercase; border-bottom: 1px solid grey">{{$product->Category->title . ' ' . $product->title}}</div>

        <div class="flex mt-20">

            <div class="w-50">
                <div class="flex-center">
                    @foreach(unserialize($product->img) as $img)
                        <img class="border-radius-15" src="{{route('files', $img)}}" alt="Изображение {{$product->title}}">
                    @endforeach
                </div>
            </div>

            <div class="w-50">
                <select name="price" class="need-validate w-100 p-5 border-radius-5" id="price">
                    @if(sizeof($product->Prices))
                        @foreach($product->Prices as $productPrice)
                            <option value="{{$productPrice->id}}" @if(($product->Prices)[0]->id == $productPrice->id) selected @endif >{{$productPrice->count . ' ' . $productPrice->price}}</option>
                        @endforeach
                    @else
                        <option disabled>Нет цен</option>
                    @endif
                </select>

                <div class="mt-20">
                    <button class="button-add-in-basket p-5">Добавить в корзину</button>
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

        let productAdded = false;
        let buttonAddInBasket = document.body.querySelector('.button-add-in-basket')
        buttonAddInBasket.addEventListener('click', (e) => {
            let productId = document.body.querySelector('.product-id').dataset.productId;
            let productPriceId = document.body.querySelector('#price').value;
            let productPriceText = document.body.querySelector('#price>option[value="'+productPriceId+'"]').innerHTML;
            let productFullText = document.body.querySelector('.full-text-product').innerHTML;

            if (!productAdded) {
                changeCountProductInBasket({productId: productId, productPriceId: productPriceId, productPriceText: productPriceText, productFullText: productFullText});
                buttonAddInBasket.innerHTML = 'Перейти в корзину';
                productAdded = true;
            } else {
                location.href = "{{route('basket-page')}}";
            }
        });

    </script>

@stop
