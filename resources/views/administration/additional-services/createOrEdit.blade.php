@extends('administration.index')

@section('content')

    <div class="container-create-additional-service">
        <input class="hide" id="additional_service_id" type="text" value="{{isset($additionalService->id) ? $additionalService->id : ''}}">
        <div class="mb-10">
            <label for="additional_service_title">Название дополнительной услуги</label>
            <input class="need-validate" id="additional_service_title" type="text" value="{{isset($additionalService->title) ? $additionalService->title : ''}}">
        </div>
        <div>
            <button class="save-additional-service-btn container-btn">Сохранить</button>
            @if(isset($additionalService->id))
            <button onclick="DeleteAdditionalService({{$additionalService->id}})" class="delete-additional-service-btn container-btn">Удалить</button>
            @endif
        </div>
    </div>

@stop

@section('js')

    <script>

        document.body.querySelector('.save-additional-service-btn').addEventListener('click', () => {
            let dataForm = GetDataFormContainer('container-create-additional-service');

            let saveAdditionalServiceBtn = document.body.querySelector('.container-create-additional-service .container-btn');
            saveAdditionalServiceBtn.hide();

            Ajax("{{route('save-additional-service-admin')}}", 'post', dataForm).then((response) => {
                if (response.status) {
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                        location.href = "{{route('additional-services-admin-page')}}";
                    }, 1500);
                } else {
                    ShowFlashMessage(response.message);
                    saveAdditionalServiceBtn.show();
                }
            });
        });

        function DeleteAdditionalService(id) {
            Ajax("{{route('delete-additional-service-admin')}}", 'post', {id: id}).then((response) => {
                if (response.status) {
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                        location.href = "{{route('additional-services-admin-page')}}";
                    }, 1500);
                } else {
                    ShowFlashMessage(response.message);
                }
            });
        }

    </script>

@stop
