@extends('administration.index')

@section('content')

    <div class="container-phone flex-column w-100">

        <div class="p-5 w-50">
            <label for="phone" style="display: block; width: 100%;">Телефон</label>
            <input class="need-validate" id="phone" name="phone" type="text"  value="{{$phone}}" style="width: 100%;">
        </div>

        <div class="p-5 w-50">
            <label for="additionalPhones" style="display: block; width: 100%;">Дополнительные телефоны</label>
            <input class="need-validate" id="additionalPhones" name="additionalPhones" type="text"  value="{{$additionalPhones}}" style="width: 100%;">
        </div>

        <div class="p-5 w-50">
            <label for="viberPhone" style="display: block; width: 100%;">Номер viber</label>
            <input class="need-validate" id="viberPhone" name="viberPhone" type="text"  value="{{$viberPhone}}" style="width: 100%;">
        </div>

        <div class="p-5 w-50">
            <label for="whatsappPhone" style="display: block; width: 100%;">Номер whatsap</label>
            <input class="need-validate" id="whatsappPhone" name="whatsappPhone" type="text"  value="{{$whatsappPhone}}" style="width: 100%;">
        </div>

        <div class="p-5 w-50">
            <label for="telegramPhone" style="display: block; width: 100%;">Номер telegram</label>
            <input class="need-validate" id="telegramPhone" name="telegramPhone" type="text"  value="{{$telegramPhone}}" style="width: 100%;">
        </div>

        <div class="p-5 w-50">
            <label for="mail" style="display: block; width: 100%;">Почта</label>
            <input class="need-validate" id="mail" name="mail" type="text"  value="{{$mail}}" style="width: 100%;">
        </div>

        <div class="p-5">
            <button class="save-phone-button">Сохранить</button>
        </div>

    </div>

@stop

@section('js')

    <script>

        document.body.querySelector('.save-phone-button').addEventListener('click', () => {

            let dataForm = GetDataFormContainer('container-phone');

            Ajax("{{route('save-phone')}}", 'post', dataForm).then((response) => {
                ShowFlashMessage(response.message);
            });
        });

    </script>

@stop
