@extends('management.index')

@section('content')

    <div>
        <label>
            Сумма платежа
            <input type="number" class="sum">
        </label>
        <button class="create-payment-link-button button-blue mt-10">Создать</button>.

        <input class="link-container">
    </div>

@stop

@section('js')

    <script>

        const sum = document.body.querySelector('.sum');
        const linkContainer = document.body.querySelector('.link-container');

        document.body.querySelector('.create-payment-link-button').addEventListener('click', () => {
            console.log(sum.value)
            if (sum.value.length > 0) {
                linkContainer.value = 'https://3dsec.sberbank.ru/payment/docsite/payform-1.html?token='+sberKey+'&def=%7B%22amount%22:%22'+sum.value+'%22%7D&ask=description&ask=email&lang=ru';
            }
        });

    </script>

@stop
