@extends('administration.index')

@section('content')

    <style>
        .price {
            display: flex;
            border: 1px solid;
        }
    </style>

    <div class="container-create-carousel-image" style="display: flex; flex-direction: column; width: 100%;">

        <input class="need-validate hide" id="carouselImageId" type="text" style="width: 100%;" value="{{!empty($carouselImage) ? $carouselImage->id : ''}}">

        <div style="padding: 10px; width: 100%;">
            <label for="carouselImageSequence" style="display: block; width: 100%;">Порядок</label>
            <input class="need-validate" id="carouselImageSequence" type="text" style="width: 100%;" value="{{!empty($carouselImageValue) ? $carouselImageValue->sequence : ''}}">
        </div>

        <div style="padding: 10px; width: 100%;">
            <label class="carousel-image-label" for="carouselImage" style="width: 80%; height: 350px;/*max-width: 300px; max-height: 300px;*/ border: 1px solid black; {{!empty($carouselImageValue) ? 'background-image: url("' . route('files', $carouselImageValue->fileId) . '")' : ''}}">{{!empty($carouselImageValue) ? '' : 'Загрузите картинку'}}</label>
            <input id="carouselImage" type="file" accept="image/jpeg, image/png, image/bmp" style="width: 100%;">
        </div>

        <div style="padding: 10px; width: 100%;">
            <button class="create-carousel-image-btn container-btn" style="width: 100%;">Сохранить</button>
        </div>

    </div>

@stop

@section('js')

    <script>

        document.getElementById('carouselImage').addEventListener('input', (event) => {
            let fileReader = new FileReader();
            fileReader.addEventListener("load", () => {
                let labelProductImg = document.querySelector(".carousel-image-label");
                labelProductImg.innerHTML = '';
                labelProductImg.style.backgroundImage = "url(" + fileReader.result + ")";
            }, false);
            fileReader.readAsDataURL(event.target.files[0]);
        });

        document.body.querySelector('.create-carousel-image-btn').addEventListener('click', () => {
            let dataForm = getDataFormContainer('container-create-carousel-image');

            Ajax("{{route('save-carousel-image-page')}}", 'post', dataForm).then((response) => {
                if (response.status) {
                    ShowFlashMessage(response.message);
                } else {
                    ShowFlashMessage(response.message);
                }
            });
        });

    </script>

@stop
