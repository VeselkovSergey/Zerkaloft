@extends('management.index')

@section('content')

    <div style="width: 100%; padding: 25px;">
        <div style="font-weight: bold; font-size: 20px;">
            Заказ № {{$order->id}} от {{$order->created_at->format('d.m.Y H:i:s')}}
        </div>

        <div style="font-weight: bold; font-size: 20px;">
            <label style="display: block;">Изменить статус заказа</label>
            <select class="change-order-properties" name="order_status">
                @foreach(\App\Models\Orders::OrderStatus as $orderStatusKey => $orderStatus)
                    <option value="{{$orderStatusKey}}" @if($order->order_status === $orderStatusKey) selected @endif >{{$orderStatus}}</option>
                @endforeach
            </select>
        </div>

        <div style="font-weight: bold; font-size: 20px;">
            <label style="display: block;">Изменить статус оплаты</label>
            <select class="change-order-properties" name="payment_status">
                @foreach(\App\Models\Orders::PaymentStatus as $paymentStatusKey => $paymentStatus)
                    <option value="{{$paymentStatusKey}}" @if($order->payment_status === $paymentStatusKey) selected @endif >{{$paymentStatus}}</option>
                @endforeach
            </select>
        </div>

        <div style="font-weight: bold; font-size: 20px;">
            <label style="display: block;">Изменить тип оплаты</label>
            <select class="change-order-properties" name="type_payment">
                @foreach(\App\Models\Orders::PaymentType as $paymentTypeKey => $paymentType)
                    <option value="{{$paymentTypeKey}}" @if($order->type_payment === $paymentTypeKey) selected @endif >{{$paymentType}}</option>
                @endforeach
            </select>
        </div>

        <div style="font-weight: bold; font-size: 20px;">
            <label style="display: block;">Изменить тип доставки</label>
            <select class="change-order-properties" name="type_delivery">
                @foreach(\App\Models\Orders::DeliveryType as $deliveryTypeKey => $deliveryType)
                    <option value="{{$deliveryTypeKey}}" @if($order->type_delivery === $deliveryTypeKey) selected @endif >{{$deliveryType}}</option>
                @endforeach
            </select>
        </div>

        <div class="all-cart-product" style="overflow: hidden;">

            @foreach($allProductsInOrder as $key => $product)

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
                            <div style="font-size: 20px; font-weight: bold;">{{$dataProductsInOrder[$product->id]->price}}</div>
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                            <button class="button-delete-product-in-basket cp" style="display: flex; justify-content: center; align-items: center; border: unset; color: unset; background-color: unset;" data-product-id="{{$product->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </button>
                            <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                                <input data-product-id="{{$product->id}}" class="input-count-product-in-basket" data-count-product="{{$product->id}}" value="{{$dataProductsInOrder[$product->id]->count}}" type="text" autocomplete="off" maxlength="2" style="font-size: 20px; cursor: default; border: unset; width: 40px; height: 40px; text-align: center;">
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

@stop

@section('js')

    <script>

        document.body.querySelectorAll('.change-order-properties').forEach((select) => {
            select.addEventListener('change', () => {

                let selectName = select.name;
                let selectValue = select.options[select.selectedIndex].value;

                let changeData = [];
                changeData[selectName] = selectValue;

                Ajax("{{route('change-order-properties-management', $order->id)}}", 'post', changeData).then((response) => {
                    ShowFlashMessage(response['message']);
                });
            })
        });

        document.body.querySelector('.button-delete-product-in-basket').addEventListener('click', () => {
            let countProductInOrder = document.body.querySelector('.input-count-product-in-basket');
            let countProductInOrderValue = parseInt(countProductInOrder.value);
            countProductInOrderValue = countProductInOrderValue - 1
            let productId = countProductInOrder.dataset.productId;
            if (countProductInOrderValue > 0) {
                countProductInOrder.value = countProductInOrderValue;
            } else {
                document.body.querySelector('[data-product-container="' + productId + '"]').remove();
            }
            ChangeCountProductInOrder(countProductInOrderValue, productId);
        });

        document.body.querySelector('.button-add-product-in-basket').addEventListener('click', () => {
            let countProductInOrder = document.body.querySelector('.input-count-product-in-basket');
            let countProductInOrderValue = parseInt(countProductInOrder.value);
            countProductInOrderValue = countProductInOrderValue + 1;
            let productId = countProductInOrder.dataset.productId;
            countProductInOrder.value = countProductInOrderValue;
            ChangeCountProductInOrder(countProductInOrderValue, productId);
        });

        function ChangeCountProductInOrder(count, productId) {
            let data = [];
            data['count'] = count;
            data['product_id'] = productId;
            Ajax("{{route('change-count-product-in-order-management', $order->id)}}", 'post', data).then((response) => {
                // ShowFlashMessage(response['message']);
            });
        }

    </script>

@stop
