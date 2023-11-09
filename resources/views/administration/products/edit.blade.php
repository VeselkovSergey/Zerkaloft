@extends('administration.index')

@section('content')

    <style>
        .product-images {
            display: flex;
        }
        .product-images > .image {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 300px;
            height: 200px;
            cursor: pointer;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>

    <div class="mb-10">
        <a href="{{route('products-admin-page')}}" class="button-blue w-fit">назад в продукты</a>
    </div>

    <div>

        @foreach($categoryPropertiesWithValues as $property)

            <div class="mb-10">
                <label for="{{$property->propertyId}}">{{$property->propertyTitle}}</label>
                <select class="category-property" name="{{$property->propertyTitle}}" id="{{$property->propertyId}}">
                    @foreach($property->propertyValues as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>

        @endforeach

        <div class="product-combination-container hide">
            <div class="border container-create-product flex-column w-100">

                <div class="p-10 w-100 flex">
                    <label class="block">
                        CODE
                        <span class="code"></span>
                    </label>
                </div>

                <div class="p-10 w-100 flex">
                    <label class="block">
                        Активный
                        <input name="active" type="checkbox">
                    </label>
                </div>

                <div class="p-10 w-100 flex">
                    <label class="block">
                        Активный для просмотра в каталоге
                        <input name="not_only_calculator" type="checkbox">
                    </label>
                </div>

                <div class="p-10 w-100 flex">
                    <label class="block">
                        Показывать на главной странице
                        <input name="show_main_page" type="checkbox">
                    </label>
                </div>

                <div class="p-10 w-100 flex">
                    <label class="block">
                        Показывать в популярном
                        <input name="isPopular" type="checkbox">
                    </label>
                </div>

                <div class="p-10 w-100 flex">
                    <label class="block">
                        Показывать кнопку добавить +1 в корзину
                        <input name="show_add_more" type="checkbox">
                    </label>
                </div>

                <div>

                    <h4 class="p-5">Доп.услуги</h4>

                    @if(!sizeof($allAdditionalServices))
                        <div class="p-5">---</div>
                    @endif

                    @foreach($allAdditionalServices as $allAdditionalService)
                        <div class="additional-service-id-{{$allAdditionalService->id}}">
                            <label class="hide">
                                <input class="hide" name="additional_service_id[]" type="text"
                                       value="{{$allAdditionalService->id}}">
                            </label>
                            <div class="flex">
                                <div class="p-5">
                                    <label class="block">
                                        {{$allAdditionalService->title}}
                                        <input data-additional-service-id-activation="{{$allAdditionalService->id}}"
                                               name="additional_service_activation[]" type="checkbox">
                                    </label>
                                </div>
                                <div class="p-5 flex">
                                    <label class="block">
                                        <input data-additional-service-id-price="{{$allAdditionalService->id}}"
                                               name="additional_service_price[]" type="text" placeholder="цена">
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div>

                    <h4 class="p-5">Фильтры</h4>

                    @if(!sizeof($filters))
                        <div class="p-5">---</div>
                    @endif

                    @foreach($filters as $filter)
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
                                               name="filter_activation[]" type="checkbox">
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="hide">
                    <label for="category_id" class="block w-100">Абстрактный продукт</label>
                    <input id="category_id" type="text" class="w-100" value="{{$category->id}}">
                </div>

                <div class="hide">
                    <label for="product_combination_for_delete" class="block w-100">Комбинация</label>
                    <input id="product_combination_for_delete" type="text" class="w-100">
                </div>

                <div class="p-10 w-100">
                    <label for="product_name" class="block w-100">Название продукта</label>
                    <input id="product_name" type="text" class="w-100">
                </div>

                <div class="p-10 w-100">
                    <label for="product_description" class="block w-100">Описание</label>
                    <textarea class="w-100" rows="5" name="product_description" id="product_description"></textarea>
                </div>

                <div class="p-10 w-100">
                    <label for="product_tech_properties" class="block w-100">Характеристики</label>
                    <textarea class="w-100" rows="5" name="product_tech_properties" id="product_tech_properties"></textarea>
                </div>

                <div class="p-10 w-100">
                    <label for="search_words" class="block w-100">Слова для поиска</label>
                    <textarea class="w-100" name="search_words" id="search_words"></textarea>
                </div>

                <div class="border m-10">
                    <div class="btn-new-price p-10 flex-center-vertical cp w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                        </svg>
                        <span class="pl-5">Добавить цену</span>
                    </div>

                    <div class="price-container p-10 w-100" data-count-prices="1">
                        <div class="price flex border mb-10" data-id="1">
                            <div class="p-10 w-50">
                                <label for="count-1" class="block w-100">Измерение</label>
                                <input name="count[]" id="count-1" type="text" class="w-100" value="0">
                            </div>

                            <div class="p-10 w-50">
                                <label for="price-1" class="block w-100">Стоимость</label>
                                <input name="price[]" id="price-1" type="text" class="w-100" value="0">
                            </div>

                            <div class="btn-dell-price p-10 cp">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="p-10 w-100">
                    <label class="product-img-label text-center border"
                           for="product_img"
                           style="max-width: 300px; max-height: 300px;">Загрузите картинку (квадратная 800*800 /
                        1000*1000)</label>
                    <input class="hide w-100" id="product_img" name="product_img"
                           type="file" multiple accept="image/jpeg, image/png, image/bmp, image/webp">
                </div>

                <div class="product-images">

                </div>

                <div class="p-10">
                    <div class="toggle-button cp" data-toogle="list-fields-apply-toggle">
                        Раскрыть список применяемых полей
                    </div>
                    <div class="list-fields-apply list-fields-apply-toggle">

                        <label>
                            <input type="checkbox" name="fieldsApply[active]" checked>
                            Активный
                        </label>

                        <label>
                            <input type="checkbox" name="fieldsApply[not_only_calculator]" checked>
                            Активный для просмотра в каталоге
                        </label>

                        <label>
                            <input type="checkbox" name="fieldsApply[show_main_page]" checked>
                            Показывать на главной странице
                        </label>

                        <label>
                            <input type="checkbox" name="fieldsApply[isPopular]" checked>
                            Показывать в популярном
                        </label>

                        <label>
                            <input type="checkbox" name="fieldsApply[show_add_more]" checked>
                            Показывать кнопку добавить +1 в корзину
                        </label>

                        <label>
                            <input type="checkbox" name="fieldsApply[additional_services]" checked>
                            Доп. услуги
                        </label>

                        <label>
                            <input type="checkbox" name="fieldsApply[filters]" checked>
                            Фильтры
                        </label>

                        <label>
                            <input type="checkbox" name="fieldsApply[product_name]" checked>
                            Название продукта
                        </label>

                        <label>
                            <input type="checkbox" name="fieldsApply[product_description]" checked>
                            Описание
                        </label>
                        <label>
                            <input type="checkbox" name="fieldsApply[product_tech_properties]" checked>
                            Описание
                        </label>

                        <label>
                            <input type="checkbox" name="fieldsApply[search_words]" checked>
                            Слова для поиска
                        </label>

                        <label>
                            <input type="checkbox" name="fieldsApply[prices]" checked>
                            Цены
                        </label>

                        <label>
                            <input type="checkbox" name="fieldsApply[img]" checked>
                            Картинка
                        </label>

                    </div>
                </div>

                <div class="p-10">
                    <div class="toggle-button cp" data-toogle="list-apply-toggle">
                        Раскрыть список комбинаций к которым применить изменение
                    </div>
                    <div class="list-apply list-apply-toggle">

                        <div>
                            <label>Фильтр по названию
                                <input type="text" class="filter">
                            </label>
                        </div>

                        <label>
                            <input type="checkbox" class="select-all">
                            Выбрать все
                        </label>

                        @foreach($completeCombinations as $combination)
                            <label class="items-apply-container">
                                <input type="checkbox" class="combination-checkbox" name="product_combination[{{$combination->id}}]"
                                       value="{{$combination->id}}">
                                <span class="item-apply">{{$category->title . ' ' . $combination->title}}</span>
                            </label>
                        @endforeach

                    </div>
                </div>


                <div class="p-10 w-100">
                    <button class="create-product-btn container-btn">Сохранить</button>
                    <button class="delete-product-btn container-btn">Удалить</button>
                </div>

            </div>
        </div>

    </div>

@stop

@section('js')

    <script>

        const productCombinationContainer = document.body.querySelector('.product-combination-container');
        const activeProductField = productCombinationContainer.querySelector('input[name="active"]');
        const notOnlyCalculator = productCombinationContainer.querySelector('input[name="not_only_calculator"]');
        const showMainPage = productCombinationContainer.querySelector('input[name="show_main_page"]');
        const isPopular = productCombinationContainer.querySelector('input[name="isPopular"]');
        const showAddMore = productCombinationContainer.querySelector('input[name="show_add_more"]');
        const productCombinationForDelete = productCombinationContainer.querySelector('input[id="product_combination_for_delete"]');
        const productName = productCombinationContainer.querySelector('input[id="product_name"]');
        const productDescription = productCombinationContainer.querySelector('textarea[name="product_description"]');
        const productTechProperties = productCombinationContainer.querySelector('textarea[name="product_tech_properties"]');
        const searchWords = productCombinationContainer.querySelector('textarea[name="search_words"]');
        const labelProductImg = productCombinationContainer.querySelector('.product-img-label');

        const selectAllCombinationsButton = document.body.querySelector('.select-all');

        document.body.querySelectorAll('.product-combination-container').forEach((productCombinationContainer) => {
            let productImg = productCombinationContainer.querySelector('[name="product_img"]');

            productImg.addEventListener('input', (event) => {
                let fileReader = new FileReader();
                fileReader.addEventListener("load", () => {
                    PutImgUrlInInput(fileReader.result)
                }, false);
                fileReader.readAsDataURL(event.target.files[0]);
            });

            productCombinationContainer.querySelector('.btn-new-price').addEventListener('click', () => {
                AddPrice(productCombinationContainer)
            });

            productCombinationContainer.querySelectorAll('.btn-dell-price').forEach((el) => {
                el.addEventListener('click', (event) => {
                    DellPrice(event, productCombinationContainer);
                });
            });

            productCombinationContainer.querySelector('.create-product-btn').addEventListener('click', () => {
                LoaderShow();
                let dataForm = GetDataFormContainer('container-create-product', productCombinationContainer);

                let createProductBtn = productCombinationContainer.querySelector('.container-create-product .container-btn');
                createProductBtn.hide();

                Ajax("{{route('save-product-admin')}}", 'post', dataForm).then((response) => {
                    LoaderHide();
                    ShowFlashMessage(response.message);
                    createProductBtn.show();
                });
            });

            productCombinationContainer.querySelector('.delete-product-btn').addEventListener('click', (event) => {
                LoaderShow();
                let dataForm = GetDataFormContainer('container-create-product', productCombinationContainer);
                event.target.hide();
                Ajax("{{route('delete-product-admin')}}", 'post', dataForm).then((response) => {
                    LoaderHide();
                    ShowFlashMessage(response.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                    event.target.show();
                });
            });

        });

        document.body.querySelectorAll('.filter').forEach((filter) => {
            filter.addEventListener('input', (event) => {

                let filterValue = event.target.value;

                let listApplyContainer = event.target.closest('.list-apply');
                let itemsApplyTitle = listApplyContainer.querySelectorAll('.item-apply');

                let regExp = new RegExp(filterValue, 'ig');
                for (let i = 0; i < itemsApplyTitle.length; i++) {
                    let itemApplyTitle = itemsApplyTitle[i];

                    if (itemApplyTitle.innerHTML.match(regExp)) {
                        itemApplyTitle.closest('.items-apply-container').show();
                    } else {
                        itemApplyTitle.closest('.items-apply-container').hide();
                    }
                }

            });
        });

        selectAllCombinationsButton.addEventListener('change', (event) => {
            const checked = event.target.checked;
            event.target.closest('.list-apply').querySelectorAll('.items-apply-container:not(.hide) input').forEach((input) => {
                input.checked = checked;
            });
        });

        function PutImgUrlInInput(imgUrl) {
            if (imgUrl) {
                labelProductImg.innerHTML = '';
                labelProductImg.classList.remove('border');
                labelProductImg.style.backgroundImage = "url(" + imgUrl + ")";
            } else {
                labelProductImg.innerHTML = 'Загрузите картинку (квадратная 800*800 / 1000*1000)';
                labelProductImg.classList.add('border');
                labelProductImg.style.backgroundImage = "";
            }
        }

        function AddPrice(productCombinationContainer, count = 0, price = 0) {
            let pricesContainer = productCombinationContainer.querySelector('.price-container');
            let countPrices = pricesContainer.dataset.countPrices;
            countPrices++;

            let newPrice = document.createElement("div");
            newPrice.dataset.id = countPrices;
            newPrice.className = 'price mb-10 flex border';
            newPrice.innerHTML = '<div class="p-10 w-50">' +
                '<label for="count-' + countPrices + '" class="block w-50">Измерение</label>' +
                '<input name="count[]" id="count-' + countPrices + '" type="text" class="w-100" value="' + count + '">' +
                '</div>' +
                '<div class="p-10 w-50">' +
                '<label for="price-' + countPrices + '" class="block w-50">Стоимость</label>' +
                '<input name="price[]" id="price-' + countPrices + '" type="text" class="w-100" value="' + price + '">' +
                '</div>' +
                '<div class="btn-dell-price p-10 cp" data-id="' + countPrices + '">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">' +
                '<path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>' +
                '</svg>' +
                '</div>';

            pricesContainer.append(newPrice);
            newPrice.querySelector('.btn-dell-price').addEventListener('click', (event) => {
                DellPrice(event, productCombinationContainer);
            });
        }

        function DellPrice(event, productCombinationContainer) {
            let pricesContainer = productCombinationContainer.querySelector('.price-container');
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

        let categoryProperties = document.body.querySelectorAll('.category-property');
        categoryProperties.forEach((categoryProperty) => {
            categoryProperty.addEventListener('change', () => {
                GetValuesOnAllSelects(categoryProperties);
            });
        });

        function GetValuesOnAllSelects(categoryProperties) {

            let modification = [];
            let allSelected = true;
            categoryProperties.forEach((select) => {
                modification.push(select.value)
                if (parseInt(select.value) === 0) {
                    allSelected = false;
                }
            });
            if (allSelected === true) {
                document.body.querySelector(".code").innerHTML = `${modification.join("-")}`
                Ajax("{{route('product-modification')}}", 'post', {
                    categoryId: {{$category->id}},
                    'modification[]': modification,
                    productEdit: true,
                }).then((response) => {
                    productCombinationContainer.show();
                    SetData(response.status ? response.result : false);
                });
            } else {
                productCombinationContainer.hide();
            }
        }

        function SetData(data) {

            let pricesContainer = productCombinationContainer.querySelector('.price-container');
            pricesContainer.innerHTML = '';
            pricesContainer.dataset.countPrices = '0';

            document.body.querySelectorAll('.combination-checkbox').forEach((input) => {
                input.checked = 0;
            });

            document.body.querySelectorAll('input[name="additional_service_price[]"]').forEach((input) => {
                input.value = '';
            });

            selectAllCombinationsButton.checked = false;
            document.body.querySelectorAll('input[name="additional_service_activation[]"]').forEach((input) => {
                input.checked = 0;
            });
            document.body.querySelectorAll('input[name="filter_activation[]"]').forEach((input) => {
                input.checked = 0;
            });

            if (data !== false) {
                activeProductField.checked = data.product.active;
                notOnlyCalculator.checked = data.product.not_only_calculator;
                showMainPage.checked = data.product.show_main_page;
                isPopular.checked = data.product.isPopular;
                showAddMore.checked = data.product.show_add_more;
                productCombinationForDelete.value = data.product.modification_id;
                productName.value = data.product.title;
                productDescription.value = data.product.description;
                productTechProperties.value = data.product.tech_properties;
                searchWords.value = data.product.search_words;
                // PutImgUrlInInput(data.productImgUrl);

                data.productImagesUrls.map((imgUrl) => {
                    const productImages = document.body.querySelector('.product-images')

                    let image = document.createElement("div")
                    image.classList.add('image')
                    image.style.backgroundImage = "url(" + imgUrl + ")"
                    productImages.append(image)
                })

                Object.keys(data.product.prices).forEach((key) => {
                    const priceData = data.product.prices[key];
                    AddPrice(productCombinationContainer, priceData.count, priceData.price);
                });

                Object.keys(data.additionalProductServices).forEach((key) => {
                    const additionalProductServices = data.additionalProductServices[key];
                    document.body.querySelector('[data-additional-service-id-activation="' + additionalProductServices.additional_service_id + '"]').checked = 1;
                    document.body.querySelector('[data-additional-service-id-price="' + additionalProductServices.additional_service_id + '"]').value = additionalProductServices.price;
                });

                Object.keys(data.filtersProducts).forEach((key) => {
                    const filterProduct = data.filtersProducts[key];
                    document.body.querySelector('[data-filter-id-activation="' + filterProduct.filter_id + '"]').checked = 1;
                });

                document.body.querySelector('.combination-checkbox[name="product_combination['+data.product.modification_id+']"]').checked = 1;

            } else {
                activeProductField.checked = 0;
                notOnlyCalculator.checked = 0;
                showMainPage.checked = 0;
                showAddMore.checked = 0;
                productCombinationForDelete.value = '';
                productName.value = '';
                productDescription.value = '';
                productTechProperties.value = '';
                searchWords.value = '';
                AddPrice(productCombinationContainer, 0, 0);
                PutImgUrlInInput();
            }
        }

    </script>

@stop
