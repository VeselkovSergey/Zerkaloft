@extends('management.index')

@section('content')

    <div style="width: 100%;">
        <div style="font-weight: bold; font-size: 20px;">
            Заказы
        </div>
        <div>
            <div style="display: table; width: 100%; text-align: center;">

                <div style="display: table-header-group; border-bottom: 1px solid grey; width: 100%;">
                    <div style="display: table-row;">
                        <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">ID заказа</div>
                        <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">Тип оплаты</div>
                        <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">Тип доставки</div>
                        <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">Статус оплаты</div>
                        <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">Статус заказа</div>
                        <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">Дата заказа</div>
                        <div style="display: table-cell; padding: 10px 5px; border-bottom: 1px solid grey;"></div>
                    </div>
                </div>

                <div style="display: table-row-group;">
                    @foreach($allOrders as $order)
                        <div style="display: table-row;">
                            <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$order->id}}</div>
                            <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$order->PaymentType()}}</div>
                            <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$order->DeliveryType()}}</div>
                            <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$order->PaymentStatus()}}</div>
                            <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$order->OrderStatus()}}</div>
                            <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$order->created_at->format('d.m.Y H:i:s')}}</div>
                            <div style="display: table-cell; padding: 10px 5px; border-bottom: 1px solid grey;">
                                <div>
                                    <div style="font-weight: bold; text-align: center;">
                                        <a href="{{route('detail-order-management-page', $order->id)}}">
                                            <button class="button-blue" style="margin: auto;">Открыть</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

@stop

@section('js')

@stop
