@extends('administration.index')

@section('content')

    <div class="container-create-reference-book" style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            <label for="reference_book_name" style="display: block; width: 100%;">Название справочника</label>
            <input class="need-validate" id="reference_book_name" type="text" style="width: 100%;">
        </div>

        <div class="container-reference-books-values">

            <div style="display: flex;">

                <div style="padding: 10px; width: 50%;">
                    <label for="reference_book_value_0" style="display: block; width: 100%;">Значение</label>
                    <input class="need-validate" id="reference_book_value_0" type="text" style="width: 100%;">
                </div>

                <div style="padding: 10px; width: 50%;">
                    <label for="reference_book_coefficient_0" style="display: block; width: 100%;">Коэффициент</label>
                    <input class="need-validate" id="reference_book_coefficient_0" type="text" style="width: 100%;">
                </div>

            </div>

        </div>

        <div style="padding: 10px; width: 100%;">
            <button class="create-reference-book-btn container-btn" style="width: 100%;">Добавить еще значение</button>
        </div>

        <div style="padding: 10px; width: 100%;">
            <button class="create-reference-book-btn container-btn" style="width: 100%;">Создать</button>
        </div>

    </div>


@stop

@section('js')

    <script>

        document.body.querySelector('.reference-book').addEventListener('click', () => {
            let dataForm = GetDataFormContainer('container-create-reference-book');

            let createReferenceBookBtn = document.body.querySelector('.container-create-reference-book .container-btn');
            createReferenceBookBtn.hide();

            Ajax("{{route('save-reference-book-admin')}}", 'post', dataForm).then((response) => {
                if (response.status) {
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                        location.href = "{{route('reference-books-admin-page')}}";
                    }, 1500);
                } else {
                    ShowFlashMessage(response.message);
                    createReferenceBookBtn.show();
                }
            });
        });

    </script>

@stop
