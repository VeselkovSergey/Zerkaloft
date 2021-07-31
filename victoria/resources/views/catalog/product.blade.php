@extends('app')

@section('content')

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

                                <div class="" style="border-radius: 15px; box-shadow: 0 0 10px rgb(0 0 0 / 75%); position: relative;">
{{--                                    <a href="{{route('category', $product->semantic_url)}}">--}}
                                        <img style="border-radius: 15px;" src="{{route('files', $img)}}" alt="Изображение {{$product->title}}">
{{--                                    </a>--}}
                                </div>

                            @endforeach
                        {{--            @for($i = 0; $i < 10; $i++)--}}
                        {{--                <div class="smooth-block" style="width: 48%; margin: 1%; /*border: 1px solid black;*/ border-radius: 15px; box-shadow: 0 0 10px rgb(0 0 0 / 75%);">--}}
                        {{--                    <img style="width: 100%; height: 350px; border-radius: 15px;" src="img.jpg" alt="">--}}
                        {{--                </div>--}}
                        {{--            @endfor--}}
                    </div>

                </div>

            </div>
            <div style="width: 50%;">

                <div style="font-weight: bold; font-size: 20px;">
                    {{$product->price}}
                </div>

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

        //let productAdded = false;
        let buttonAddInBasket = document.body.querySelector('.button-add-in-basket')
        buttonAddInBasket.addEventListener('click', (e) => {
            let productId = document.body.querySelector('.product-id').dataset.productId;
            //if (!productAdded) {
                changeCountProductInBasket(productId);
                //buttonAddInBasket.innerHTML = 'Перейти в корзину';
                //productAdded = true;
            //} else {
                //location.href = "{{route('basket-page')}}";
            //}
        });

    </script>

@stop
