@extends('app')

@section('content')

    @php($title_page = $product->title)

    @php($metaDescription = $product->description)

    <div>

        <div data-product-id="{{$product->id}}" class="product-id hide">{{$product->id}}</div>

        <div class="full-text-product text-center pb-10" style="font-size: 24px; font-weight: bold; text-transform: uppercase; border-bottom: 1px solid grey">{{$product->title}}</div>

        <div class="product-container-product-page flex-wrap mt-20">

            <div class="mb-25">
                <div class="flex-center">
                    @foreach(unserialize($product->img) as $img)
                        <img class="border-radius-15" style="max-height: calc(65vh);" src="{{route('files', $img)}}" alt="Изображение {{$product->title}}">
                    @endforeach
                </div>
            </div>

            <div class="px-25">
                <select name="price" class="need-validate w-100 p-5 border-radius-5 mb-10" id="price">
                    @if(sizeof($product->Prices))
                        @php($tempProductPrice = [])
                        @foreach($product->Prices as $productPrice)
                                @php($tempProductPrice[$productPrice->id] = $productPrice->toArray())
                            <option value="{{$productPrice->id}}" @if(($product->Prices)[0]->id == $productPrice->id) selected @endif >{{$productPrice->count . ' ' . $productPrice->price}}</option>
                        @endforeach
                        @php($product->prices = $tempProductPrice)
                    @else
                        <option disabled>Нет цен</option>
                    @endif
                </select>

                <div class="additional-services-container">
                    @foreach($product->AdditionalServicesPrice as $additionalServicePrice)
                        <label for="">
                            <input type="checkbox" name="additionalService[]" data-additional-service-id="{{$additionalServicePrice->additional_service_id}}" data-additional-service-price="{{$additionalServicePrice->price}}">
                            {{$additionalServicePrice->AdditionalServices->title}} - {{$additionalServicePrice->price}}
                        </label>
                    @endforeach
                </div>

                <div class="mt-20 flex">
                    <button class="button-add-in-basket p-5 mr-10">Добавить в корзину</button>
                    <a class="clear-a button-link-basket-page hide" href="{{route('basket-page')}}"><button class="button-blue">Перейти в корзину</button></a>
                </div>

                <div class="mt-20">
                    {{$product->description}}
                </div>

                <div class="mt-15 container-categories-properties"></div>

            </div>

        </div>

    </div>

@stop

@section('js')

    <script>

        let containerCategoriesProperties = document.body.querySelector('.container-categories-properties');

        const categoryProperties = @json($product->Category->Properties);
        console.log(categoryProperties)
            Object.keys(categoryProperties).forEach((key) => {
                const categoryProperty = categoryProperties[key];
                categoryProperty.values.unshift({value: "Выберите значение"});
                let propertySelector = GenerationFormSelect(categoryProperty.values, `property-${key}`, 0, true);
                propertySelector.className = 'p-5 border-radius-5';

                let containerProperty = CreateElement('div', {
                    childs: [
                        CreateElement('label', {content: categoryProperty.title}),
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

        const product = JSON.parse('@json($product->getAttributes(), JSON_UNESCAPED_UNICODE)');

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

    </script>

@stop
