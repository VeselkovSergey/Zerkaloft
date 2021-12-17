@extends('management.index')

@section('content')

    <div style="width: 100%;">

        <div style="font-weight: bold; font-size: 20px;">
            Заказы обратного звонка
        </div>
        
        <div>
            <div style="display: table; width: 100%; text-align: center;">

                <div style="display: table-header-group; border-bottom: 1px solid grey; width: 100%;">
                    <div style="display: table-row;">
                        <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">ID</div>
                        <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">Номер телефона</div>
                        <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">Имя</div>
                        <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">Дата</div>
                    </div>
                </div>

                <div class="table-order" style="display: table-row-group;">
                    @if(sizeof($allCallbackOrders))
                        @foreach($allCallbackOrders as $callbackOrder)
                            <div style="display: table-row;">
                                <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$callbackOrder->id}}</div>
                                <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$callbackOrder->phone}}</div>
                                <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$callbackOrder->name}}</div>
                                <div style="display: table-cell; padding: 10px 5px; border-right: 1px solid grey; border-bottom: 1px solid grey;">{{$callbackOrder->created_at->format('d.m.Y H:i:s')}}</div>
                            </div>
                        @endforeach
                    @else
                        <div>Нет заказов</div>
                    @endif
                </div>

            </div>
        </div>
    </div>

@stop

@section('js')

@stop
