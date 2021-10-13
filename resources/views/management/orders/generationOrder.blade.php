@if(sizeof($allOrders))
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
@else
    <div>Нет заказов</div>
@endif