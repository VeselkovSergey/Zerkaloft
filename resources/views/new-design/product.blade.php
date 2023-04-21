@php
    $category = $product->Category;

    $bredcrumbs = [
        "Главная" => route("home-page"),
        $category->title => $category->Link(),
        $product->title => $product->Link(),
    ];
@endphp

@extends("new-design.app")

@section("content")

    @php($title_page = $product->title)

    @php($metaDescription = $product->title . '. ' . $product->description)

    <style>

        .order-2-4 {
            order: 2;
        }

        .order-4-2 {
            order: 4;
        }

        @media screen and (max-width: 540px) {

            .order-2-4 {
                order: 4;
            }

            .order-4-2 {
                order: 2;
            }
        }
    </style>

    <div>

        @include("new-design.bredcrumbs", $bredcrumbs)

        <div data-product-id="{{$product->id}}" class="product-id hide">{{$product->id}}</div>

        <div class="flex-wrap px-10">
            <div class="w-25-adaptive-100" style="order: 1;">
                <div class="flex-center mb-10 mr-10-adaptive-0">
                    @foreach(unserialize($product->img) as $img)
                        <img style="max-height: calc(65vh);" src="{{route('files', $img)}}" alt="{{$product->title}}">
                    @endforeach
                </div>
            </div>
            <div class="w-35-adaptive-100 order-2-4 mb-10">
                <div class="mr-10-adaptive-0">
                    <div class="h3">ИЗМЕНИТЬ ПАРАМЕТРЫ</div>
                    <div class="container-categories-properties">
                        <!--
                        <div>
                            <div class="p-10 h3">Подсветка</div>
                            <div>
                                <select name="" id="" class="select-3 w-100 font-light">
                                    <option value="123" selected>123</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="p-10 h3">Размер</div>
                            <div>
                                <select name="" id="" class="select-3 w-100 font-light">
                                    <option value="123" selected>123</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="p-10 h3">Материал</div>
                            <div>
                                <select name="" id="" class="select-3 w-100 font-light">
                                    <option value="123" selected>123</option>
                                </select>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
            <div class="w-40-adaptive-100" style="order: 3;">
                <div class="h3">Описание</div>
                <p>{{$product->description}}</p>
            </div>
            <div class="w-60-adaptive-100 order-4-2">
                <div class="mr-10-adaptive-0" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                    <div class="flex mb-10">
                        @if(sizeof($product->Prices))
                            @php($tempProductPrice = [])
                            @if(sizeof($product->Prices) == 1)
                                @php($tempProductPrice[$product->Prices[0]->id] = $product->Prices[0]->toArray())
                                <label for="price" style="border: 1px solid white; border-radius: 25px; padding: 10px; margin-bottom: 10px;">
                                    {{$product->Prices[0]->count . ' ' . $product->Prices[0]->price}}
                                    <input class="hide" type="text" name="price" id="price" value="{{$product->Prices[0]->id}}">
                                </label>
                            @else
                                <select name="price" id="price" class="select-3 font-light">
                                    @foreach($product->Prices as $productPrice)
                                        @php($tempProductPrice[$productPrice->id] = $productPrice->toArray())
                                        <option value="{{$productPrice->id}}" @if(($product->Prices)[0]->id == $productPrice->id) selected @endif >{{$productPrice->count . ' ' . $productPrice->price}}</option>
                                    @endforeach
                                </select>
                            @endif
                            @php($product->prices = $tempProductPrice)
                        @else
                            <div style="border: 1px solid white; border-radius: 25px; padding: 10px; margin-bottom: 10px;">Нет цен</div>
                        @endif
                    </div>
                    <div class="mb-10 w-a-adaptive-100 flex" style="flex-wrap: wrap;">
                        @if(\App\Helpers\Utils::isFavourite($product->id))
                            <div class="add-favourite-button cp mr-10 flex-center border-radius-25 p-10 mb-10" style="border-color: white;">
                                <img style="height: 20px;" src="/assets/imgs/notFavourite.svg" alt="">
                                <div class="ml-10">Добавить&nbsp;в&nbsp;избранное</div>
                            </div>
                        @else
                            <div class="remove-favourite-button cp mr-10 flex-center border-radius-25 p-10 mb-10" style="border-color: white;">
                                <img style="height: 20px;" src="/assets/imgs/favourite.svg" alt="">
                                <div class="ml-10">Убрать&nbsp;из&nbsp;избранного</div>
                            </div>
                        @endif
                        <div class="button-add-in-basket border-radius-25 p-10 mt-a text-center cp mb-10"
                             style="background-color: white; color: black;">В КОРЗИНУ
                        </div>
                        <div class="button-link-basket-page hide border-radius-25 p-10 mt-a text-center cp mb-10"
                           style="background-color: white; color: black;"
                           onclick="location.href='{{route('basket-page')}}'">ПЕРЕЙТИ В КОРЗИНУ
                        </div>
                    </div>
                </div>
                <div class="flex-space-x-adaptive-column additional-services-container">
                    <div class="font-light">
                        @foreach($product->AdditionalServicesPrice as $key => $additionalServicePrice)
                        <div class="checkbox-wrapper-1 mb-10">
                            <input id="color-{{$key}}" type="checkbox" name="additionalService[]" class="custom-checkbox" data-additional-service-id="{{$additionalServicePrice->additional_service_id}}" data-additional-service-price="{{$additionalServicePrice->price}}">
                            <label for="color-{{$key}}">{{$additionalServicePrice->AdditionalServices->title}} - {{$additionalServicePrice->price}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @include("new-design.favorite")
        @include("new-design.info")
    </div>
@endsection

@section("js")
    <script>

        let containerCategoriesProperties = document.body.querySelector('.container-categories-properties');

        const categoryProperties = @json($product->Category->Properties);

        const modifications = "{{$product->modification_id}}".split('-')

        Object.keys(categoryProperties).forEach((key) => {
            const categoryProperty = categoryProperties[key];
            categoryProperty.values.unshift({value: "Выберите значение"});
            let propertySelector = GenerationFormSelect(categoryProperty.values, `property-${key}`, modifications[key], true, true);
            propertySelector.className = 'select-3 w-100 font-light';

            let containerProperty = CreateElement('div', {
                childs: [
                    CreateElement('label', {content: categoryProperty.title, class: "block p-10 h3"}),
                    propertySelector,
                ]
            });
            containerCategoriesProperties.append(containerProperty);
            if (categoryProperty.is_professional === 1) {
                containerProperty.hide();
            }
            propertySelector.addEventListener('change', () => {
                let modification = [];
                let allSelected = true;
                containerCategoriesProperties.querySelectorAll('select').forEach((property) => {
                    modification.push(property.value)
                    if (parseInt(property.value) === 0) {
                        allSelected = false;
                    }
                });
                if (allSelected === true) {
                    Ajax("{{route('product-modification')}}", 'post', {
                        categoryId: {{$product->category_id}},
                        'modification[]': modification
                    }).then((response) => {
                        if (response.status !== true) {
                            //ModalWindowFlash(response.message);
                            return
                        }
                        location.href = response.result.productLink
                    });
                }
            });
        })

        const product = @json($product->getAttributes(), JSON_UNESCAPED_UNICODE);

        let productAdded = false;
        let buttonAddInBasket = document.body.querySelector('.button-add-in-basket')
        let buttonLinkBasketPage = document.body.querySelector('.button-link-basket-page')
        buttonAddInBasket.addEventListener('click', (e) => {

            let productId = product.id;
            let productPriceId = document.body.querySelector('#price').value;
            let productFullInformation = product;

            let additionalServicesSelection = [];
            let additionalServicesSelectionPrice = [];
            let additionalServices = document.body.querySelectorAll('.additional-services-container input');
            additionalServices.forEach((additionalService) => {
                if (additionalService.checked) {
                    additionalServicesSelection.push(additionalService.dataset.additionalServiceId);
                    additionalServicesSelectionPrice.push(additionalService.dataset.additionalServicePrice);
                }
            });

            changeCountProductInBasket({
                productId: productId,
                productPriceId: productPriceId,
                productFullInformation: productFullInformation,
                additionalServicesSelection: additionalServicesSelection,
                additionalServicesSelectionPrice: additionalServicesSelectionPrice
            });
            if (!productAdded) {
                @if($product->show_add_more)
                    buttonAddInBasket.innerHTML = '+1 в корзину';
                @else
                buttonAddInBasket.hide();
                @endif
                buttonLinkBasketPage.show()
            }
        });

        document.body.querySelector(".add-favourite-button")?.addEventListener("click", () => {
            Ajax("{{route('add-favourite')}}", 'post', {
                productId: {{$product->id}},
            }).then(() => {
                location.reload()
            })
        })

        document.body.querySelector(".remove-favourite-button")?.addEventListener("click", () => {
            Ajax("{{route('remove-favourite')}}", 'post', {
                productId: {{$product->id}},
            }).then(() => {
                location.reload()
            })
        })

    </script>
@endsection
