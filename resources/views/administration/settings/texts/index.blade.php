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

    <div class="container-about-text flex-column w-100">

        <div class="p-10 w-100">
            <label for="aboutText">Текст для страницы о нас</label>
            <textarea class="w-100" name="aboutText" id="aboutText">{{$aboutPageInfo->text}}</textarea>
        </div>

        <div class="p-5">
            <button class="save-about-text-button">Сохранить</button>
        </div>

    </div>

    <div class="container-footer-text flex-column w-100">

        <div class="p-10 w-100">
            <label for="footerText">Текст футера</label>
            <textarea class="w-100" name="footerText" id="footerText">{{$footerText->text}}</textarea>
        </div>

        <div class="p-5">
            <button class="save-footer-text-button">Сохранить</button>
        </div>

    </div>

    <div class="container-header-logo flex-column w-100">

        <div class="p-10 w-100">
            <label for="headerLogo">Картинка для логотипа</label>
            <input type="file" name="headerLogo" id="headerLogo">
        </div>

        <div class="p-5">
            <button class="save-header-logo-button">Сохранить</button>
        </div>

    </div>

    <div class="container-body-image flex-column w-100">

        <div class="p-10 w-100">
            <label for="bodyImage">Картинка для фона</label>
            <input type="file" name="bodyImage" id="bodyImage">
        </div>

        <div class="p-5">
            <button class="save-body-image-button">Сохранить</button>
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

        document.body.querySelector('.save-about-text-button').addEventListener('click', () => {
            LoaderShow();

            let dataForm = GetDataFormContainer('container-about-text');

            Ajax("{{route('save-about-text')}}", 'post', dataForm).then((response) => {
                LoaderHide();
                ShowFlashMessage(response.message);
            });
        });

        document.body.querySelector('.save-footer-text-button').addEventListener('click', () => {
            LoaderShow();

            let dataForm = GetDataFormContainer('container-footer-text');

            Ajax("{{route('save-footer-text')}}", 'post', dataForm).then((response) => {
                LoaderHide();
                ShowFlashMessage(response.message);
            });
        });

        document.body.querySelector('.save-header-logo-button').addEventListener('click', () => {
            LoaderShow();

            let dataForm = GetDataFormContainer('container-header-logo');

            Ajax("{{route('save-header-logo')}}", 'post', dataForm).then((response) => {
                LoaderHide();
                ShowFlashMessage(response.message);
            });
        });

        document.body.querySelector('.save-body-image-button').addEventListener('click', () => {
            LoaderShow();

            let dataForm = GetDataFormContainer('container-body-image');

            Ajax("{{route('save-body-image')}}", 'post', dataForm).then((response) => {
                LoaderHide();
                ShowFlashMessage(response.message);
            });
        });

    </script>

@stop
