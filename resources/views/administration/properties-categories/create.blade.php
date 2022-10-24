@extends('administration.index')

@section('content')

    <div class="container-create-category-property">
        <div class="mb-10">
            <label for="property_categories_title">Название свойства категорий</label>
            <input class="need-validate" id="property_categories_title" type="text">
        </div>
        <div class="mb-10">
            <label for="property_categories_sequence">Очередность</label>
            <input class="need-validate" id="property_categories_sequence" type="text">
        </div>
        <div class="mb-10">
            <label for="property_categories_is_professional" class="flex">
                <input id="property_categories_is_professional" type="checkbox">
                <span>Профессиональная настройка</span>
            </label>
        </div>
        <div class="border mb-10">
            <div class="btn-new-price p-10 flex-center-vertical cp w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                </svg>
                <span class="pl-5">Добавить значение</span>
            </div>
            <div class="items-container w-100 p-10" data-count-prices="0">

            </div>
        </div>
        <div>
            <button class="create-category-property-btn container-btn">Создать</button>
        </div>
    </div>

@stop

@section('js')

    <script>

        document.body.querySelector('.create-category-property-btn').addEventListener('click', () => {
            LoaderShow();
            let dataForm = GetDataFormContainer('container-create-category-property');

            let createCategoryBtn = document.body.querySelector('.container-create-category-property .container-btn');
            createCategoryBtn.hide();

            Ajax("{{route('save-property-categories-admin')}}", 'post', dataForm).then((response) => {
                LoaderHide();
                if (response.status) {
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                        location.href = "{{route('properties-categories-admin-page')}}";
                    }, 1500);
                } else {
                    ShowFlashMessage(response.message);
                    createCategoryBtn.show();
                }
            });
        });

        document.body.querySelector('.btn-new-price').addEventListener('click', () => {
            addItem()
        });

        addItem()
        function addItem() {
            let itemsContainer = document.querySelector('.items-container');

            let newItem = document.createElement("div");
            newItem.className = 'flex border mb-5';

            newItem.innerHTML =    '<div class="w-100 p-10"><div class="w-100">'+
                                        '<label>Значение</label>'+
                                        '<input name="property_categories_values[]" type="text">'+
                                    '</div>'+

                                    '<div class="is_default_value_container ' + (property_categories_is_professional.checked ? '' : ' hide ') + '">'+
                                        '<label class="flex">' +
                                            '<input name="is_default_value[]" type="radio" ' + (itemsContainer.children.length === 0 ? ' checked ' : '') + '>' +
                                            'Значение по умолчанию' +
                                        '</label>'+
                                    '</div></div>'+

                                    '<div class="btn-dell-price cp p-10 ' + (itemsContainer.children.length === 0 ? ' hide ' : '') + '">'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">'+
                                            '<path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>'+
                                        '</svg>'+
                                    '</div>';

            itemsContainer.append(newItem);

            newItem.querySelector('.btn-dell-price').addEventListener('click', () => {
                if (itemsContainer.children.length > 1) {
                    newItem.remove();
                    if (document.body.querySelectorAll('[name="is_default_value[]"]:checked').length === 0) {
                        document.body.querySelector('[name="is_default_value[]"]').checked = true;
                    }
                }
            });
        }

        property_categories_is_professional.addEventListener('change', () => {
          document.body.querySelectorAll('[name="is_default_value[]"]').forEach((el) => {
              if (property_categories_is_professional.checked) {
                  el.closest('.is_default_value_container').show()
              } else {
                  el.closest('.is_default_value_container').hide()
              }
          })
        })

    </script>

@stop
