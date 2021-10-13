@extends('administration.index')

@section('content')

    <div class="container-create-category" style="display: flex; flex-direction: column; width: 100%;">

        <div style="padding: 10px; width: 100%;">
            <label for="property_categories_title" style="display: block; width: 100%;">Название свойства категорий</label>
            <input class="need-validate" id="property_categories_title" type="text" style="width: 100%;">
        </div>

        <div class="btn-new-price" style="cursor:pointer; display: flex; align-items: center;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
            </svg>
            <span>Добавить значение</span>
        </div>

        <div class="price-container w-100 p-10" data-count-prices="1">

            <div class="price flex border mb-5" data-id="1">
                <div class="w-100 p-10">
                    <label for="count-1" class="w-100" style="display: block;">Значение</label>
                    <input name="property_categories_values[]" id="count-1" type="text" class="w-100">
                </div>

                <div class="btn-dell-price cp">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                    </svg>
                </div>
            </div>

        </div>

        <div style="padding: 10px; width: 100%;">
            <button class="create-category-btn container-btn" style="width: 100%;">Создать</button>
        </div>

    </div>

@stop

@section('js')

    <script>

        document.body.querySelector('.create-category-btn').addEventListener('click', () => {
            let dataForm = GetDataFormContainer('container-create-category');

            let createCategoryBtn = document.body.querySelector('.container-create-category .container-btn');
            createCategoryBtn.hide();

            Ajax("{{route('save-property-categories-admin')}}", 'post', dataForm).then((response) => {
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

        document.body.querySelector('.btn-new-price').addEventListener('click', (event) => {
            AddPrice()
        });

        document.body.querySelector('.btn-dell-price').addEventListener('click', (event) => {
            DellPrice(event);
        });

        function AddPrice() {
            let pricesContainer = document.querySelector('.price-container');
            let countPrices = pricesContainer.dataset.countPrices;
            countPrices++;

            let newPrice = document.createElement("div");
            newPrice.dataset.id = countPrices;
            newPrice.className = 'price flex border mb-5';

            newPrice.innerHTML = '<div class="w-100 p-10">'+
                '<label for="count-' + countPrices + '" class="w-100" style="display: block;">Значение</label>'+
                '<input name="property_categories_values[]" id="count-' + countPrices + '" type="text" class="w-100">'+
                '</div>'+

                '<div class="btn-dell-price cp" data-id="' + countPrices + '">'+
                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">'+
                '<path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>'+
                '</svg>'+
                '</div>';

            pricesContainer.append(newPrice);
            newPrice.querySelector('.btn-dell-price').addEventListener('click', (event) => {
                DellPrice(event);
            });
        }

        function DellPrice(event) {
            let pricesContainer = document.querySelector('.price-container');
            if (pricesContainer.children.length > 1) {
                event.path.forEach((el) => {
                    if (el.classList !== undefined) {
                        if (el.classList.contains('price')) {
                            el.remove();
                        }
                    }
                });
            }
        }

    </script>

@stop
