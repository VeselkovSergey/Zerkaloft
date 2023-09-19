@extends('administration.index')

@section('content')

    <div class="container-create-filter">
        <input class="hide" id="filter_id" type="text" value="{{isset($filter->id) ? $filter->id : ''}}">
        <div class="mb-10">
            <label for="filter_title">Название</label>
            <input class="need-validate" id="filter_title" type="text" value="{{isset($filter->title) ? $filter->title : ''}}">
        </div>
        <div class="mb-10">
            <label for="filter_group">Группа</label>
            <input class="need-validate" id="filter_group" type="text" value="{{isset($filter->group) ? $filter->group : ''}}">
        </div>
        <div>
            <button class="save-filter-btn container-btn">Сохранить</button>
            @if(isset($filter->id))
            <button onclick="DeleteFilter({{$filter->id}})" class="delete-filter-btn container-btn">Удалить</button>
            @endif
        </div>
    </div>

@stop

@section('js')

    <script>

        document.body.querySelector('.save-filter-btn').addEventListener('click', () => {
            LoaderShow();
            let dataForm = GetDataFormContainer('container-create-filter');

            let saveBtn = document.body.querySelector('.container-create-filter .container-btn');
            saveBtn.hide();

            Ajax("{{route('save-filters-admin')}}", 'post', dataForm).then((response) => {
                LoaderHide();
                if (response.status) {
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                        location.href = "{{route('filters-admin-page')}}";
                    }, 1500);
                } else {
                    ShowFlashMessage(response.message);
                    saveBtn.show();
                }
            });
        });

        function DeleteFilter(id) {
            LoaderShow();
            Ajax("{{route('delete-filters-admin')}}", 'post', {id: id}).then((response) => {
                LoaderHide();
                if (response.status) {
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                        location.href = "{{route('filters-admin-page')}}";
                    }, 1500);
                } else {
                    ShowFlashMessage(response.message);
                }
            });
        }

    </script>

@stop
