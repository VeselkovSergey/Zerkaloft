@extends('administration.index')

@section('content')

    <div class="container-calculator-text flex-column w-100">

        <div class="p-10 w-100">
            <label for="calculatorText">Текст для онлайн калькулятора</label>
            <textarea class="w-100" name="calculatorText" id="calculatorText">{{$calculatorPageText}}</textarea>
        </div>

        <div class="p-5">
            <button class="saveCalculatorTextButton">Сохранить</button>
        </div>

    </div>

@stop

@section('js')

    <script>

        document.body.querySelector('.saveCalculatorTextButton').addEventListener('click', () => {

            let dataForm = GetDataFormContainer('container-calculator-text');

            Ajax("{{route('save-calculator-text')}}", 'post', dataForm).then((response) => {
                ShowFlashMessage(response.message);
            });
        });

    </script>

@stop
