@extends('administration.index')

@section('content')

    <div class="container-calculator-text flex-column w-100">

        <div class="p-10 w-100">
            <label for="calculatorText">Текст для онлайн калькулятора</label>
            <textarea class="w-100" name="calculatorText" id="calculatorText">{{$calculatorPageText}}</textarea>
        </div>

        <div class="p-5">
            <button class="save-calculator-text-button">Сохранить</button>
        </div>

    </div>

    <div class="container-online-order-text flex-column w-100">

        <div class="p-10 w-100">
            <label for="onlineOrderText">Текст для онлайн заказа</label>
            <textarea class="w-100" name="onlineOrderText" id="onlineOrderText">{{$onlineOrderPageText}}</textarea>
        </div>

        <div class="p-5">
            <button class="save-online-order-text-button">Сохранить</button>
        </div>

    </div>

    <div class="container-fast-order-text flex-column w-100">

        <div class="p-10 w-100">
            <label for="fastOrderText">Текст для быстрого оформления</label>
            <textarea class="w-100" name="fastOrderText" id="fastOrderText">{{$fastOrderPageText}}</textarea>
        </div>

        <div class="p-5">
            <button class="save-fast-order-text-button">Сохранить</button>
        </div>

    </div>

@stop

@section('js')

    <script>

        document.body.querySelector('.save-calculator-text-button').addEventListener('click', () => {

            let dataForm = GetDataFormContainer('container-calculator-text');

            Ajax("{{route('save-calculator-text')}}", 'post', dataForm).then((response) => {
                ShowFlashMessage(response.message);
            });
        });

        document.body.querySelector('.save-online-order-text-button').addEventListener('click', () => {

            let dataForm = GetDataFormContainer('container-online-order-text');

            Ajax("{{route('save-online-order-text')}}", 'post', dataForm).then((response) => {
                ShowFlashMessage(response.message);
            });
        });

        document.body.querySelector('.save-fast-order-text-button').addEventListener('click', () => {

            let dataForm = GetDataFormContainer('container-fast-order-text');

            Ajax("{{route('save-fast-order-text')}}", 'post', dataForm).then((response) => {
                ShowFlashMessage(response.message);
            });
        });

    </script>

@stop
