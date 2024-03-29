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

    $title_page = 'Кофигуратор зеркал.';
    $metaDescription = 'Конструктор зеркал. Зеркало на заказ.';

    $bredcrumbs = [
        "Главная" => route("home-page"),
        "Конфигуратор зеркал" => route("fast-order-page"),
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

        .container-calculator {

        }

        .container-text-from-settings-wrap {
            border-left: 1px solid white;
            border-right: 1px solid white;
            /*margin-right: 50px;*/
        }

        label.square {
            background-color: #A1A1A1;
            padding: 10px;
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
            min-width: 35%;
            text-align: center;
            margin-bottom: 10px;
        }

        label.square > input {
            display: none;
        }

        label.square.--checked {
            box-shadow: 0 0 25px 5px #1998AE;
        }

        .w-20-adaptive-100 {
            width: 20%;
        }

        @media screen and (max-width: 540px) {
            .m-a-adaptive {
                margin-left: auto;
                margin-right: auto;
            }

            .container-calculator {
                margin-left: unset;
            }

            .container-text-from-settings-wrap {
                margin-right: unset;
            }

            .w-20-adaptive-100 {
                width: 100%;
            }
        }

        .more-props {
            transition: all 300ms;
            transform: rotate(90deg);
        }

        .more-props.open {
            transform: rotate(0deg);
        }

        .props-container {
            height: 90px;
            overflow: hidden;
            transition: all 300ms;
        }

        .props-container.open {
            height: auto;
        }
    </style>

    <div class="px-10">
        @include("new-design.bredcrumbs", $bredcrumbs)

        <div>
            <div class="flex-center">
                <div style="border-bottom: 1px solid white; flex: 1;"></div>
                <div class="flex-center" style="background-image: url('./img/img-1.svg'); width: 400px; height: 400px;">
                    <div style="font-size: 32px;">КОНФИГУРАТОР</div>
                </div>
                <div style="border-bottom: 1px solid white; flex: 1;"></div>
            </div>
            <div class="flex-wrap" style="border: 1px solid white;">
                <div class="w-20-adaptive-100">
                    <div class="container-calculator p-20">
                        <h3>Категория</h3>
                        <div class="container-categories">
                            @foreach($allCategories as $category)
                                <label class="block mb-5">
                                    <input type="radio" value="{{$category->id}}" name="category">
                                    <span>{{$category->title}}</span>
                                </label>
                            @endforeach
                        </div>
                        <div class="container-categories-properties">

                        </div>
                    </div>
                </div>
                <div class="w-60-adaptive-100">
                    <div class="container-text-from-settings-wrap p-20">

                        <div class="container-text-from-settings pl-20">
                            <div class="text-center mb-20">
                                {!! $text !!}
                            </div>

                            <div>
                                @if($fileId !== -1)
                                    <img class="product-img-in-calculator" src="{{route('files', $fileId)}}" alt="">
                                @endif
                            </div>

                        </div>

                        <div class="container-found-product hide">
                            <div class="flex-column">
                                <div class="flex mb-10 m-a-adaptive" style="">
                                    <div>
                                        <div class="mb-10 mr-10-adaptive-0 slider-product fast-order-product-img">

                                        </div>
                                    </div>
                                </div>
                                <div class="flex-space-x mr-10-adaptive-0  w-100">
                                    <div class="flex mb-10 prices-container">
                                        <select name="" id="" class="select-3 font-light">
                                            <option value="123" selected>1 шт - 745 р</option>
                                        </select>
                                    </div>
                                    <div class="mb-10 w-a-adaptive-100 ml-10">
                                        <a href="#"
                                           class="fast-order-product-link block border-radius-25 p-10 mt-a text-center"
                                           style="background-color: white; color: black;">К ТОВАРУ
                                        </a>
                                    </div>
                                </div>
                                <div class="font-light ">
                                    <p class="fast-order-product-tech-properties">
                                        tech-properties
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-20-adaptive-100 container-found-product-text-container hide">
                    <div class="p-20">
                        <div class="h3 fast-order-product-title">Title</div>
                        <p class="fast-order-product-description">
                            description
                        </p>
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

        document.body.querySelectorAll(`input[name="category"]`).forEach((category) => {
            category.addEventListener("change", () => {
                const categoryId = parseInt(category.value)
                getCategoryProperties(categoryId)
            })
        })

        triggerEvent(document.body.querySelector(`input[name="category"]`), "change")
        document.body.querySelector(`input[name="category"]`).setAttribute("checked", "checked")

        let containerCategoriesProperties = document.body.querySelector(".container-categories-properties")
        let containerFoundProduct = document.body.querySelector(".container-found-product")
        let containerFoundProductTextContainer = document.body.querySelector(".container-found-product-text-container")
        let containerTextFromSettings = document.body.querySelector(".container-text-from-settings")

        let containerCalculator = document.body.querySelector(".container-calculator")

        let countProps = 0

        function getCategoryProperties(categoryId) {
            Ajax("{{route('category-properties')}}", "post", {categoryId: categoryId}).then((response) => {
                if (response.status !== true) {
                    return
                }

                containerCategoriesProperties.innerHTML = ""

                let obj = response.result

                countProps = Object.keys(obj).length

                Object.keys(obj).forEach((key) => {

                    const isManyValues = Object.keys(obj[key].propertyValues).length > 4

                    const containerProp = document.createElement("div")
                    containerProp.className = obj[key].propertyIsProfessional === 1 ? "hide" : (isManyValues ? " flex-wrap-center-x" : "block")

                    const labelProp = document.createElement("h3")
                    labelProp.innerHTML = obj[key].propertyTitle
                    labelProp.className = "w-100"

                    containerProp.append(labelProp)

                    const propValueContainer = document.createElement("div")
                    propValueContainer.className = "flex-wrap-center-x props-container"
                    containerProp.append(propValueContainer)

                    Object.keys(obj[key].propertyValues).forEach((key1) => {
                        const obj1 = obj[key].propertyValues[key1]

                        const labelEl = document.createElement("label")
                        labelEl.className = "block cp mb-5" + (isManyValues ? " square" : "")

                        const spanEl = document.createElement("span")
                        spanEl.innerHTML = obj1.value

                        const inputEl = document.createElement("input")
                        inputEl.value = obj1.id
                        inputEl.type = "radio"
                        inputEl.name = obj[key].propertyTitleTransliterate
                        inputEl.checked = obj1.is_default_value === 1

                        inputEl.addEventListener("change", () => {
                            containerCategoriesProperties.querySelectorAll(`input[name="${inputEl.name}"]`).forEach((el) => {
                                el.closest("label")?.classList.remove("--checked")
                            })
                            if (inputEl.checked) {
                                labelEl.classList.add("--checked")
                            }
                        })

                        labelEl.append(inputEl)
                        labelEl.append(spanEl)

                        propValueContainer.append(labelEl)
                    })

                    if (Object.keys(obj[key].propertyValues).length > 4) {
                      const morePropsButton = document.createElement("div")
                      morePropsButton.className = "more-props ml-a"
                      morePropsButton.innerHTML = "<img src='./assets/imgs/img-101.svg' alt=''>"
                      containerProp.append(morePropsButton)

                      morePropsButton.addEventListener("click", () => {
                        morePropsButton.classList.toggle('open')
                        if (morePropsButton.classList.contains("open")) {
                          morePropsButton.parentElement.querySelector(".props-container").classList.add("open")
                        } else {
                          morePropsButton.parentElement.querySelector(".props-container").classList.remove("open")
                        }
                      })
                    }

                    containerCategoriesProperties.append(containerProp)
                })

            })
        }

        containerCalculator.addEventListener("change", () => {
            setTimeout(() => {
                const checkedInputs = containerCategoriesProperties.querySelectorAll("input:checked")
                if (checkedInputs.length > 0 && checkedInputs.length === countProps) {
                    const modification = []
                    checkedInputs.forEach((checkedInput) => {
                        modification.push(checkedInput.value)
                    })
                    getProduct(document.querySelector(`input[name="category"]:checked`).value, modification)
                } else {
                    containerFoundProduct.hide()
                    containerFoundProductTextContainer.hide()
                    containerTextFromSettings.show()
                }
            }, 100)
        })

        function getProduct(categoryId, modification) {
            Ajax("{{route('product-modification')}}", "post", {
                categoryId: categoryId,
                "modification[]": modification,
            }).then((response) => {
                if (response.status !== true) {
                    ModalWindowFlash(response.message)
                    setTimeout(() => {
                        GenerationFormSpecialOrder()
                    }, 1500)
                    return
                }

                let res = response.result
                window.history.pushState({}, "", res.productLink)

                document.body.querySelector(".fast-order-product-title").innerHTML = res.product.title
                document.body.querySelector(".fast-order-product-description").innerHTML = res.product.description
                document.body.querySelector(".fast-order-product-tech-properties").innerHTML = `<p><b>Характеристики:</b></p>${res.product.tech_properties}`
                document.body.querySelector(".fast-order-product-img").innerHTML = ""
                res.productImagesUrls.map((item) => {
                    const imgEl = document.createElement("img")
                    imgEl.src = item
                    document.body.querySelector(".fast-order-product-img").append(imgEl)
                })
                slider(document.body.querySelector(".fast-order-product-img"))

                let options = ""
                let i = 0
                Object.keys(res.product.prices).forEach((key) => {
                    let selectedAttr = i === 0 ? "selected" : ""
                    let priceTitle = res.product.prices[key]["count"] + " " + res.product.prices[key]["price"]
                    let priceId = res.product.prices[key]["id"]
                    options += "<option " + selectedAttr + " value=\"" + priceId + "\">" + priceTitle + "</option>"
                    i++
                })
                let selectorPrices = CreateElement("select", {
                    attr: {name: name, class: "select-3 font-light"},
                    content: options,
                })
                document.body.querySelector(".prices-container").innerHTML = ""
                document.body.querySelector(".prices-container").append(selectorPrices)

                document.body.querySelector(".fast-order-product-link").href = res.productLink

                containerFoundProduct.show()
                containerFoundProductTextContainer.show()
                containerTextFromSettings.hide()
            })
        }

    </script>

@stop
