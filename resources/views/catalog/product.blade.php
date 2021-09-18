@extends('app')

@section('content')

    @php($title_page = $product->title)

    <div style="padding: 25px 0;">

        <style>
            .smooth-block:hover {
                transform: scale(1.05);
                cursor: pointer;
                transition: transform .3s;
            }
        </style>

        <div style="display: none;" data-product-id="{{$product->id}}" class="product-id">
            {{$product->id}}
        </div>

        <div style="font-size: 25px; font-weight: bold; text-align: center; text-transform:uppercase; padding: 10px; border-bottom: 1px solid grey">
            {{$product->title}}
        </div>

        <div style="display: flex; flex-wrap: wrap; width: 100%; padding-top: 30px;">

            <div style="width: 50%;">
                <div style="display: flex; justify-content: center;">
                    <div style="display: flex;flex-wrap: wrap;max-width: 90%;justify-content: center;">
                        @foreach(unserialize($product->img) as $img)
                            <div class="" style="border-radius: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.25); position: relative;">
                                <img style="border-radius: 15px;" src="{{route('files', $img)}}" alt="Изображение {{$product->title}}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div style="width: 50%;">
                <select name="price" class="need-validate" id="price" style="width: 100%;">
                    @if(sizeof($product->Prices))
                        @foreach($product->Prices as $productPrice)
                            <option value="{{$productPrice->id}}" @if(($product->Prices)[0]->id == $productPrice->id) selected @endif >{{$productPrice->count . ' ' . $productPrice->price}}</option>
                        @endforeach
                    @else
                        <option disabled>Нет цен</option>
                    @endif
                </select>

                <div style="font-weight: bold; font-size: 20px; padding: 20px 0;">
                    <button class="button-add-in-basket" style="">Добавить в корзину</button>
                </div>

                <div>
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

            {{--if (!productAdded) {--}}
                changeCountProductInBasket({productId: productId, productPriceId: productPriceId, productPriceText: productPriceText});
            {{--    buttonAddInBasket.innerHTML = 'Перейти в корзину';--}}
            {{--    productAdded = true;--}}
            {{--} else {--}}
            {{--    location.href = "{{route('basket-page')}}";--}}
            {{--}--}}
        });

    </script>

@stop
