@extends('administration.index')

@section('content')

    <div class="container-phone flex-column w-100">

        <div class="p-5 w-50">
            <label for="phone" style="display: block; width: 100%;">Телефон</label>
            <input class="need-validate" id="phone" name="phone" type="text"  value="{{$phone}}" style="width: 100%;">
        </div>

        <div class="p-5">
            <button class="save-phone-button">Сохранить</button>
        </div>

    </div>

@stop

@section('js')

    <script>

        document.body.querySelector('.save-phone-button').addEventListener('click', () => {

            let dataForm = getDataFormContainer('container-phone');

            Ajax("{{route('save-phone')}}", 'post', dataForm).then((response) => {
                ShowFlashMessage(response.message);
            });
        });

    </script>

@stop
