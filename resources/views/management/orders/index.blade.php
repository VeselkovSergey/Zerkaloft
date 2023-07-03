@extends('management.index')

@section('content')

    <div style="width: 100%;">

        <div class="m-10">
            <label for="">Поиск по номеру клиента</label>
            <input type="text" class="input-for-search-by-phone" placeholder="79991234567">
        </div>

        <div class="m-10">
            <label for="">Поиск по товару</label>
            <input type="text" class="input-for-search-by-string" placeholder="визитки">
        </div>

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

                <div class="table-order" style="display: table-row-group;">
                    @include('management.orders.generationOrder')
                </div>

            </div>
        </div>
    </div>

@stop

@section('js')

    <script>

        document.body.querySelector('.input-for-search-by-phone').addEventListener('change', (event) => {
            let clientPhone = event.target.value;
            Ajax("{{route('get-orders-by-phone')}}", 'post', {client_phone: clientPhone}).then((response) => {
                document.body.querySelector('.table-order').innerHTML = response;
            });
        });

        document.body.querySelector('.input-for-search-by-string').addEventListener('change', (event) => {
            let querySearch = event.target.value;
            Ajax("{{route('get-orders-by-string')}}", 'post', {querySearch: querySearch}).then((response) => {
                document.body.querySelector('.table-order').innerHTML = response;
            });
        });

    </script>

@stop
