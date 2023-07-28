@extends('administration.index')

@section('content')

    <div class="container-create-carousel-image">

        <div class="mb-10 hide">
            <label for="carouselImageId">ID</label>
            <input class="need-validate" id="carouselImageId" type="text" value="{{!empty($carouselImage) ? $carouselImage->id : ''}}">
        </div>

        <div class="mb-10">
            <label for="carouselImageSequence">Порядок</label>
            <input class="need-validate" id="carouselImageSequence" type="text" value="{{!empty($carouselImageValue) ? $carouselImageValue->sequence : ''}}">
        </div>

        <div class="mb-10">
            <label for="carouselImageLink">Ссылка</label>
            <input class="need-validate" id="carouselImageLink" type="text" value="{{!empty($carouselImageValue) ? $carouselImageValue->link : '#'}}">
        </div>

        <div class="mb-10">
            <label class="carousel-image-label border" for="carouselImage" style="width: 80%; height: 350px; {{!empty($carouselImageValue) ? 'background-image: url("' . route('files', $carouselImageValue->fileId[0]) . '")' : ''}}">{{!empty($carouselImageValue) ? '' : 'Загрузите картинку'}}</label>
            <input id="carouselImage" type="file" accept="image/jpeg, image/png, image/bmp, image/webp">
        </div>

        <div class="mb-10">
            <label class="carousel-image-label border" for="carouselImage2" style="width: 350px; height: 350px; {{!empty($carouselImageValue) && isset($carouselImageValue->fileId[1]) ? 'background-image: url("' . route('files', $carouselImageValue->fileId[1]) . '")' : ''}}">{{!empty($carouselImageValue) ? '' : 'Загрузите картинку'}}</label>
            <input id="carouselImage2" type="file" accept="image/jpeg, image/png, image/bmp, image/webp">
        </div>

        <div class="container-buttons">
            <button class="create-carousel-image-btn container-btn">Сохранить</button>
            @if(!empty($carouselImage))
                <button class="delete-carousel-image-btn container-btn">Удалить</button>
            @endif
        </div>

    </div>

@stop

@section('js')

    <script>

        document.getElementById('carouselImage').addEventListener('input', (event) => {
            let fileReader = new FileReader();
            fileReader.addEventListener("load", () => {
                let labelProductImg = document.body.querySelector('label[for="carouselImage"]');
                labelProductImg.innerHTML = '';
                labelProductImg.style.backgroundImage = "url(" + fileReader.result + ")";
            }, false);
            fileReader.readAsDataURL(event.target.files[0]);
        });

        document.getElementById('carouselImage2').addEventListener('input', (event) => {
            let fileReader = new FileReader();
            fileReader.addEventListener("load", () => {
                let labelProductImg = document.body.querySelector('label[for="carouselImage2"]');
                labelProductImg.innerHTML = '';
                labelProductImg.style.backgroundImage = "url(" + fileReader.result + ")";
            }, false);
            fileReader.readAsDataURL(event.target.files[0]);
        });

        document.body.querySelector('.create-carousel-image-btn').addEventListener('click', () => {
            LoaderShow();
            let dataForm = GetDataFormContainer('container-create-carousel-image');

            let containerButtons = document.body.querySelector('.container-buttons');
            containerButtons.hide();

            Ajax("{{route('save-carousel-image-page')}}", 'post', dataForm).then((response) => {
                LoaderHide();
                ShowFlashMessage(response.message);
                if (response.status) {
                    setTimeout(() => {
                        location.href = "{{route('all-carousel-images-page')}}";
                    }, 1500);
                } else {
                    containerButtons.show();
                }
            });
        });

        document.body.querySelector('.delete-carousel-image-btn')?.addEventListener('click', () => {
            LoaderShow();
            let dataForm = GetDataFormContainer('container-create-carousel-image');

            let containerButtons = document.body.querySelector('.container-buttons');
            containerButtons.hide();

            Ajax("{{route('delete-carousel-image-page')}}", 'post', dataForm).then((response) => {
                LoaderHide();
                ShowFlashMessage(response.message);
                if (response.status) {
                    setTimeout(() => {
                        location.href = "{{route('all-carousel-images-page')}}";
                    }, 1500);
                } else {
                    containerButtons.show();
                }
            });
        });

    </script>

@stop
