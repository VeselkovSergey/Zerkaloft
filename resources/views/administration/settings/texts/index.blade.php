@extends('administration.index')

@section('content')

    <div class="container-calculator-text flex-column w-100">

        <div class="p-10 w-100">
            <label for="calculatorText">Текст для онлайн калькулятора</label>
            <textarea class="w-100" name="calculatorText" id="calculatorText">{{$calculatorPageInfo->text}}</textarea>
        </div>

        <div class="p-10 w-100">
            <label for="calculatorImage">Картинка для калькулятора</label>
            <input type="file" name="calculatorImage" id="calculatorImage">
        </div>

        <div class="p-5">
            <button class="save-calculator-text-button">Сохранить</button>
        </div>

    </div>

    <div class="container-online-order-text flex-column w-100">

        <div class="p-10 w-100">
            <label for="onlineOrderText">Текст для онлайн заказа</label>
            <textarea class="w-100" name="onlineOrderText" id="onlineOrderText">{{$onlineOrderPageInfo->text}}</textarea>
        </div>

        <div class="p-10 w-100">
            <label for="onlineOrderImage">Картинка для онлайн заказа</label>
            <input type="file" name="onlineOrderImage" id="onlineOrderImage">
        </div>

        <div class="p-5">
            <button class="save-online-order-text-button">Сохранить</button>
        </div>

    </div>

    <div class="container-fast-order-text flex-column w-100">

        <div class="p-10 w-100">
            <label for="fastOrderText">Текст для быстрого оформления</label>
            <textarea class="w-100" name="fastOrderText" id="fastOrderText">{{$fastOrderPageInfo->text}}</textarea>
        </div>

        <div class="p-10 w-100">
            <label for="fastOrderImage">Картинка для быстрого оформления</label>
            <input type="file" name="fastOrderImage" id="fastOrderImage">
        </div>

        <div class="p-5">
            <button class="save-fast-order-text-button">Сохранить</button>
        </div>

    </div>

@stop

@section('js')

    <script>

        document.body.querySelector('.save-calculator-text-button').addEventListener('click', () => {
            LoaderShow();

            let dataForm = GetDataFormContainer('container-calculator-text');

            Ajax("{{route('save-calculator-text')}}", 'post', dataForm).then((response) => {
                LoaderHide();
                ShowFlashMessage(response.message);
            });
        });

        document.body.querySelector('.save-online-order-text-button').addEventListener('click', () => {
            LoaderShow();

            let dataForm = GetDataFormContainer('container-online-order-text');

            Ajax("{{route('save-online-order-text')}}", 'post', dataForm).then((response) => {
                LoaderHide();
                ShowFlashMessage(response.message);
            });
        });

        document.body.querySelector('.save-fast-order-text-button').addEventListener('click', () => {
            LoaderShow();

            let dataForm = GetDataFormContainer('container-fast-order-text');

            Ajax("{{route('save-fast-order-text')}}", 'post', dataForm).then((response) => {
                LoaderHide();
                ShowFlashMessage(response.message);
            });
        });

    </script>

@stop
