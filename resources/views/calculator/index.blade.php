@extends('app')

@section('content')

    @php
        $info = \App\Http\Controllers\Administration\SettingsController::CalculatorPageInfo();
        $text = $info->text;
        $fileId = $info->imageFileId;
        if(isset($fastOrder) && $fastOrder === true) {
            $info = \App\Http\Controllers\Administration\SettingsController::FastOrderInfo();
            $text = $info->text;
            $fileId = $info->imageFileId;
        }
    @endphp

    <div class="container-calculator flex-wrap">
        <div class="p-25">
            <div class="container-categories">
                <label for="">Категория</label>
            </div>
            <div class="container-categories-properties"></div>
        </div>
        <div class="container-found-product p-25">
            <div class="container-found-product-container">
                <div class="container-found-product-container-text">
                    {{$text}}
                </div>
                @if($fileId !== -1)
                    <img class="product-img-in-calculator" src="{{route('files', $fileId)}}" alt="">
                @endif
            </div>
        </div>

    </div>

@stop

@section('js')

    <script>

        let categoryOptions = '<option disabled selected value="0">Выберите категорию</option>';
        @foreach($allCategories as $category)
            categoryOptions += '<option value="{{$category->id}}">{{$category->title}}</option>';
        @endforeach

        let selectorCategories = CreateElement('select', {attr: {name: 'category'}, content: categoryOptions});

        selectorCategories.classList.add('p-5');
        selectorCategories.classList.add('border-radius-5');

        /*let containerCategories = */document.body.querySelector('.container-categories').append(selectorCategories);
        let containerCategoriesProperties = document.body.querySelector('.container-categories-properties');
        let containerFoundProduct = document.body.querySelector('.container-found-product');

        let containerCalculator = document.body.querySelector('.container-calculator');
        let filedCategory = containerCalculator.querySelector('select[name="category"]');
        filedCategory.addEventListener('change', (event) => {
            containerFoundProduct.innerHTML = '<div class="container-found-product-container"> <div class="container-found-product-container-text"> {{$text}} </div> @if($fileId !== -1) <img class="product-img-in-calculator" src="{{route('files', $fileId)}}" alt=""> @endif </div>';
            let select = event.target;
            let categoryId = select.value;
            if (parseInt(categoryId) !== 0) {
                Ajax("{{route('category-properties')}}", 'post', {categoryId: categoryId}).then((response) => {
                    if (response.status === true) {
                        let obj = response.result;
                        containerCategoriesProperties.innerHTML = '';
                        Object.keys(obj).forEach((key) => {
                            let propertySelector = GenerationFormSelect(obj[key].propertyValues, obj[key].propertyTitleTransliterate, 0, true);
                            propertySelector.classList.add('p-5');
                            propertySelector.classList.add('border-radius-5');

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
                                        categoryId: categoryId,
                                        'modification[]': modification
                                    }).then((response) => {
                                        if (response.status !== true) {
                                            ModalWindowFlash(response.message);
                                            setTimeout(() => {
                                                GenerationFormSpecialOrder();
                                            }, 1500);
                                            return
                                        }

                                        let res = response.result;
                                        containerFoundProduct.innerHTML = '';
                                        let product = CreateElement('div', {
                                            content: res.product.title,
                                            class: 'font-semibold'
                                        });
                                        containerFoundProduct.append(product);

                                        let productImg = CreateElement('img', {
                                            attr: {
                                                src: res.productImgUrl,
                                                class: "my-5 product-img-in-calculator"
                                            }
                                        });
                                        containerFoundProduct.append(productImg);
                                        let options = '';
                                        let i = 0;
                                        Object.keys(res.product.prices).forEach((key) => {
                                            let selectedAttr = i === 0 ? 'selected' : '';
                                            let priceTitle = res.product.prices[key]['count'] + ' ' + res.product.prices[key]['price'];
                                            let priceId = res.product.prices[key]['id']
                                            options += '<option ' + selectedAttr + ' value="' + priceId + '">' + priceTitle + '</option>';
                                            i++;
                                        });
                                        let selectorPrices = CreateElement('select', {
                                            attr: {name: name, class: 'p-5 border-radius-5'},
                                            content: options
                                        });
                                        containerFoundProduct.append(selectorPrices);

                                        let addInBasketButton = CreateElement('button', {
                                            attr: {
                                                class: 'button-blue mt-5',
                                            },
                                            content: 'Перейти товару',
                                            events: {
                                                click: () => {
                                                    location.href = res.productLink;
                                                    // let productId = res.product.id;
                                                    // let productPriceId = selectorPrices.value;
                                                    // let productFullInformation = res.product;
                                                    //
                                                    // changeCountProductInBasket({productId: productId, productPriceId: productPriceId, productFullInformation: productFullInformation});
                                                    //
                                                    // if (productFullInformation.show_add_more === 0) {
                                                    //     addInBasketButton.innerHTML = '+1 в корзину';
                                                    // } else {
                                                    //     addInBasketButton.hide();
                                                    // }
                                                    // linkBasketButton.show();
                                                }
                                            }
                                        }, containerFoundProduct);

                                        {{--let linkBasketButton = CreateElement('button', {--}}
                                        {{--    attr: {--}}
                                        {{--        class: 'button-blue mt-5 hide',--}}
                                        {{--    },--}}
                                        {{--    content: 'Перейти в корзину',--}}
                                        {{--    events: {--}}
                                        {{--        click: () => {--}}
                                        {{--            location.href = "{{route('basket-page')}}"--}}
                                        {{--        }--}}
                                        {{--    }--}}
                                        {{--}, containerFoundProduct);--}}
                                    });
                                }
                            });
                            let containerProperty = CreateElement('div', {
                                childs: [
                                    CreateElement('label', {content: obj[key].propertyTitle}),
                                    propertySelector,
                                ]
                            });
                            containerCategoriesProperties.append(containerProperty);
                        });
                    }
                });
            }
        });

    </script>

@stop
