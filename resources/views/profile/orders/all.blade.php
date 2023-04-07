@extends('profile.index')

@section('profile-content')

    <div class="w-100">
        <div class="w-100" style="display: table; text-align: center;">

            <div class="w-100" style="display: table-header-group; border-bottom: 1px solid grey;">
                <div style="display: table-row;">
                    <div class="p-5" style="display: table-cell; border-right: 1px solid grey; border-bottom: 1px solid grey;">ID заказа</div>
                    <div class="p-5" style="display: table-cell; border-right: 1px solid grey; border-bottom: 1px solid grey;">Тип оплаты</div>
                    <div class="p-5" style="display: table-cell; border-right: 1px solid grey; border-bottom: 1px solid grey;">Тип доставки</div>
                    <div class="p-5" style="display: table-cell; border-right: 1px solid grey; border-bottom: 1px solid grey;">Статус оплаты</div>
                    <div class="p-5" style="display: table-cell; border-right: 1px solid grey; border-bottom: 1px solid grey;">Статус заказа</div>
                    <div class="p-5" style="display: table-cell; border-right: 1px solid grey; border-bottom: 1px solid grey;">Дата заказа</div>
                    <div class="p-5" style="display: table-cell; border-bottom: 1px solid grey;"></div>
                </div>
            </div>

            <div style="display: table-row-group;">
                @foreach($userOrders as $order)
                    <div style="display: table-row;">
                        <div class="p-5" style="display: table-cell; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$order->id}}</div>
                        <div class="p-5" style="display: table-cell; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$order->PaymentType()}}</div>
                        <div class="p-5" style="display: table-cell; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$order->DeliveryType()}}</div>
                        <div class="p-5" style="display: table-cell; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$order->PaymentStatus()}}</div>
                        <div class="p-5" style="display: table-cell; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$order->OrderStatus()}}</div>
                        <div class="p-5" style="display: table-cell; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$order->created_at->format('d.m.Y H:i:s')}}</div>
                        <div class="p-5" style="display: table-cell; border-bottom: 1px solid grey;">
                            <a class="button-blue block" style="color: black;" href="{{route('user-order-page', $order->id)}}">Открыть</a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

@stop

@section('profile-js-container')

@stop
