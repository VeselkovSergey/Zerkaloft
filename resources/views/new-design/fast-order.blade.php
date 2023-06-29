{{--@php--}}
{{--    $info = \App\Http\Controllers\Administration\SettingsController::CalculatorPageInfo();--}}
{{--    $text = $info->text;--}}
{{--    $fileId = $info->imageFileId;--}}
{{--    if(isset($fastOrder) && $fastOrder === true) {--}}
{{--        $info = \App\Http\Controllers\Administration\SettingsController::FastOrderInfo();--}}
{{--        $text = $info->text;--}}
{{--        $fileId = $info->imageFileId;--}}
{{--    }--}}
{{--@endphp--}}

@php

    $bredcrumbs = [
        "Главная" => route("home-page"),
        "Быстрое оформление" => route("fast-order-page"),
    ];

    $info = \App\Http\Controllers\Administration\SettingsController::CalculatorPageInfo();
    $text = $info->text;
    $fileId = $info->imageFileId;
    if(isset($fastOrder) && $fastOrder === true) {
        $info = \App\Http\Controllers\Administration\SettingsController::FastOrderInfo();
        $text = $info->text;
        $fileId = $info->imageFileId;
    }

@endphp

@extends("new-design.app")

@section("content")

    <style>
        .order-2-4 {
            order: 2;
        }

        .order-3-2 {
            order: 3;
        }

        .order-4-3 {
            order: 4;
        }

        @media screen and (max-width: 540px) {

            .order-2-4 {
                order: 4;
            }

            .order-3-2 {
                order: 2;
            }

            .order-4-3 {
                order: 3;
            }

            .m-a-adaptive {
                margin-left: auto;
                margin-right: auto;
            }
        }
    </style>

    <div>
        @include("new-design.bredcrumbs", $bredcrumbs)
        <div class="flex-wrap mb-10 px-0-adaptive-10">
            <div class="w-35-adaptive-100 mb-10">
                <div class="mb-20 mr-10-adaptive-0 container-calculator">
                    <div>
                        <div class="p-10 h3">Категория</div>
                        <div class="container-categories">

                        </div>
                    </div>
                    <div class="container-categories-properties">

                    </div>
                </div>
            </div>

            <div class="container-text-from-settings pl-20 w-40-adaptive-100">
                {!! $text !!}
            </div>

            <div class="container-found-product hide w-40-adaptive-100">
                <div class="flex-column">
                    <div class="flex mb-10 m-a-adaptive" style="order: 1">
                        <div style="width: 300px; height: 300px;">
                            <img class="fast-order-product-img" src="" alt="">
                        </div>
                    </div>
                    <div class="font-light order-2-4">
                        <div class="h3 fast-order-product-title">Title</div>
                        <p class="fast-order-product-description">
                            description
                        </p>
                    </div>
                    <div class="flex-space-x mr-10-adaptive-0 order-3-2 w-100">
                        <div class="flex mb-10 prices-container">
                            <select name="" id="" class="select-3 font-light">
                                <option value="123" selected>1 шт - 745 р</option>
                            </select>
                        </div>
                        <div class="mb-10 w-a-adaptive-100 ml-10">
                            <a href="#" class="fast-order-product-link block border-radius-25 p-10 mt-a text-center"
                               style="background-color: white; color: black;">К ТОВАРУ
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    @include("new-design.favorite")
    @include("new-design.info")
    </div>
@endsection

@section('js')

    <script>

        let categoryOptions = '<option disabled selected value="0">Выберите категорию</option>';
        @foreach($allCategories as $category)
            categoryOptions += '<option value="{{$category->id}}">{{$category->title}}</option>';
        @endforeach

        let selectorCategories = CreateElement('select', {attr: {name: 'category'}, content: categoryOptions});

        selectorCategories.className = "select-3 w-100 font-light"

        /*let containerCategories = */
        document.body.querySelector('.container-categories').append(selectorCategories);
        let containerCategoriesProperties = document.body.querySelector('.container-categories-properties');
        let containerFoundProduct = document.body.querySelector('.container-found-product');
        let containerTextFromSettings = document.body.querySelector('.container-text-from-settings');

        let containerCalculator = document.body.querySelector('.container-calculator');
        let filedCategory = containerCalculator.querySelector('select[name="category"]');
        filedCategory.addEventListener('change', (event) => {
            containerFoundProduct.hide()
            containerTextFromSettings.show()
            {{--containerFoundProduct.innerHTML = '<div class="container-found-product-container"> <div class="container-found-product-container-text"> {{$text}} </div> @if($fileId !== -1) <img class="product-img-in-calculator" src="{{route('files', $fileId)}}" alt=""> @endif </div>';--}}
            let select = event.target;
            let categoryId = select.value;
            if (parseInt(categoryId) === 0) {
                return
            }

            Ajax("{{route('category-properties')}}", 'post', {categoryId: categoryId}).then((response) => {
                if (response.status === true) {
                    let obj = response.result;
                    containerCategoriesProperties.innerHTML = '';
                    Object.keys(obj).forEach((key) => {
                        let propertySelector = GenerationFormSelect(obj[key].propertyValues, obj[key].propertyTitleTransliterate, 0, true);
                        propertySelector.className = 'select-3 w-100 font-light';

                        let containerProperty = CreateElement('div', {
                            childs: [
                                CreateElement('div', {content: obj[key].propertyTitle, class: "p-10 h3"}),
                                propertySelector,
                            ]
                        });
                        containerCategoriesProperties.append(containerProperty);

                        propertySelector.addEventListener('change', () => {
                            let modification = [];
                            let allSelected = true;

                            containerCategoriesProperties.querySelectorAll('select').forEach((property) => {
                                modification.push(property.value)
                                if (!parseInt(property.value)) {
                                    allSelected = false;
                                }
                            });

                            if (allSelected !== true) {
                                return
                            }

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
                                window.history.pushState({}, '', res.productLink)

                                document.body.querySelector('.fast-order-product-title').innerHTML = res.product.title
                                document.body.querySelector('.fast-order-product-description').innerHTML = res.product.description
                                document.body.querySelector('.fast-order-product-img').src = res.productImgUrl

                                // // containerFoundProduct.innerHTML = '';
                                // let product = CreateElement('div', {
                                //     content: res.product.title,
                                //     class: 'font-semibold'
                                // });
                                // // containerFoundProduct.append(product);

                                // let productImg = CreateElement('img', {
                                //     attr: {
                                //         src: res.productImgUrl,
                                //         class: "my-5 product-img-in-calculator"
                                //     }
                                // });
                                // // containerFoundProduct.append(productImg);
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
                                    attr: {name: name, class: 'select-3 font-light'},
                                    content: options
                                });
                                document.body.querySelector('.prices-container').innerHTML = ""
                                document.body.querySelector('.prices-container').append(selectorPrices)

                                document.body.querySelector('.fast-order-product-link').href = res.productLink

                                containerFoundProduct.show()
                                containerTextFromSettings.hide()
                                // containerFoundProduct.append(selectorPrices);

                                // let addInBasketButton = CreateElement('button', {
                                //     attr: {
                                //         class: 'button-blue mt-5',
                                //     },
                                //     content: 'Перейти товару',
                                //     events: {
                                //         click: () => {
                                //             location.href = res.productLink;
                                //             // let productId = res.product.id;
                                //             // let productPriceId = selectorPrices.value;
                                //             // let productFullInformation = res.product;
                                //             //
                                //             // changeCountProductInBasket({productId: productId, productPriceId: productPriceId, productFullInformation: productFullInformation});
                                //             //
                                //             // if (productFullInformation.show_add_more === 0) {
                                //             //     addInBasketButton.innerHTML = '+1 в корзину';
                                //             // } else {
                                //             //     addInBasketButton.hide();
                                //             // }
                                //             // linkBasketButton.show();
                                //         }
                                //     }
                                // }, containerFoundProduct);

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
                        });

                        // если быстрый заказ то скрываем профессиональные поля
                        if (obj[key].propertyIsProfessional === 1 && {{isset($fastOrder) && $fastOrder === true ? 'true' : 'false'}}) {
                            containerProperty.hide();
                        }
                    });
                }
            });
        });

    </script>

@stop
