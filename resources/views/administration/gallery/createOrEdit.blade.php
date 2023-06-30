@extends('administration.index')

@section('content')

    <div class="container-create-gallery">
        <input class="hide" id="gallery_id" type="text" value="{{isset($item->id) ? $item->id : ''}}">
        <div class="mb-10">
            <label for="gallery_title">Описание</label>
            <textarea class="need-validate" name="" id="gallery_description" cols="50"
                      rows="5">{{isset($item->description) ? $item->description : ''}}</textarea>
        </div>
        <div class="mb-10">
            <label for="gallery_title">Технические характеристики</label>
            <textarea class="need-validate" name="" id="gallery_tech_properties" cols="50"
                      rows="5">{{isset($item->tech_properties) ? $item->tech_properties : ''}}</textarea>
        </div>
        <div>

            <h4 class="p-5">Фильтры</h4>

            @if(!sizeof($filters))
                <div class="p-5">---</div>
            @endif

            @foreach($filters as $filter)
                @php
                    $isChecked = "";
                    if (isset($item)) {
                        foreach ($item->filters as $itemFilter) {
                            $isChecked = $itemFilter->id === $filter->id ? 'checked' : '';
                        }
                    }
                @endphp
                <div class="filter-id-{{$filter->id}}">
                    <label class="hide">
                        <input class="hide" name="filter_id[]" type="text"
                               value="{{$filter->id}}">
                    </label>
                    <div class="flex">
                        <div class="p-5">
                            <label class="block">
                                {{$filter->title}}
                                <input data-filter-id-activation="{{$filter->id}}"
                                       name="filter_activation[]" type="checkbox" {{$isChecked}}>
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="p-10 w-100">
            <label class="category-img-label" for="gallery_img"
                   style="max-width: 300px; max-height: 300px; border: 1px solid black;">Загрузите картинку</label>
            <input id="gallery_img" type="file" accept="image/jpeg, image/png, image/bmp, image/webp" class="w-100">
        </div>

        @if(isset($item))
            @foreach(unserialize($item->img) as $img)

                <div style="padding: 10px;">
                    <div class="category-img-label" for="category_img"
                         style="max-width: 300px; max-height: 300px; background-image: url('{{route('files', $img)}}')">

                    </div>
                </div>

            @endforeach
        @endif

        <div>
            <button class="save-gallery-btn container-btn">Сохранить</button>
            @if(isset($item->id))
                <button onclick="DeleteFilter({{$item->id}})" class="delete-gallery-btn container-btn">Удалить
                </button>
            @endif
        </div>
    </div>

@stop

@section('js')

    <script>

        document.getElementById("gallery_img").addEventListener("input", (event) => {
            let fileReader = new FileReader()
            fileReader.addEventListener("load", () => {
                let labelCategoryImg = document.querySelector(".category-img-label")
                labelCategoryImg.innerHTML = ""
                labelCategoryImg.style.border = ""
                labelCategoryImg.style.backgroundImage = "url(" + fileReader.result + ")"
            }, false)
            fileReader.readAsDataURL(event.target.files[0])
        })

        document.body.querySelector(".save-gallery-btn").addEventListener("click", () => {
            LoaderShow()
            let dataForm = GetDataFormContainer("container-create-gallery")

            let saveBtn = document.body.querySelector(".container-create-gallery .container-btn")
            saveBtn.hide()

            Ajax("{{route('save-gallery-admin')}}", "post", dataForm).then((response) => {
                LoaderHide()
                if (response.status) {
                    ShowFlashMessage(response.message)
                    setTimeout(() => {
                        location.href = "{{route('gallery-admin-page')}}"
                    }, 1500)
                } else {
                    ShowFlashMessage(response.message)
                    saveBtn.show()
                }
            })
        })

        function DeleteFilter(id) {
            LoaderShow()
            Ajax("{{route('delete-gallery-admin')}}", "post", {id: id}).then((response) => {
                LoaderHide()
                if (response.status) {
                    ShowFlashMessage(response.message)
                    setTimeout(() => {
                        location.href = "{{route('gallery-admin-page')}}"
                    }, 1500)
                } else {
                    ShowFlashMessage(response.message)
                }
            })
        }

    </script>

@stop
