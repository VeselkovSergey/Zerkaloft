@extends("new-design.app")

@section("content")
    <div>
        <div class="flex mb-10">
            <div>Главная</div>
            <div class="mx-10">/</div>
            <div>Быстрое оформление</div>
        </div>
        <div class="flex mb-10">
            <div class="w-33">
                <div class="px-20" style="width: calc(100% - 20px - 20px)">
                    <div>
                        <div class="p-10 h3">Категория</div>
                        <div>
                            <select name="" id="" class="select-1 w-100">
                                <option value="123" selected>123</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="p-10 h3">Размер</div>
                        <div>
                            <select name="" id="" class="select-1 w-100">
                                <option value="123" selected>123</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="p-10 h3">Материал</div>
                        <div>
                            <select name="" id="" class="select-1 w-100">
                                <option value="123" selected>123</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-33">
                <div class="flex mb-10">
                    <div style="width: 300px; height: 300px; background-color: grey"></div>
                </div>
                <div class="mb-10">
                    <select name="" id="" class="select-1">
                        <option value="123" selected>1 шт - 745 р</option>
                    </select>
                </div>

                <div class="flex">
                    <div>
                        <div class="mr-10" style="padding: 10px 20px; border: 1px solid black; border-radius: 25px; font-size: 20px; background-color: white; color: black;">ПЕРЕЙТИ К ТОВАРУ</div>
                    </div>
                    <div>
                        <div style="padding: 10px 20px; border: 1px solid black; border-radius: 25px; font-size: 20px; background-color: white; color: black;">В КОРЗИНУ</div>
                    </div>
                </div>
            </div>
            <div class="w-33">
                <div>
                    <div class="h3">ОПИСАНИЕ</div>
                    <p>
                        Лицевая панель - акрил, задняя и боковые панели - ПВХ,
                        подсветка - светодиодные кластеры на задней панели.
                        Срок изготовления стандартных изделий от 3 до 5 рабочих дней,
                        Текст (буквы) собирается на профильной трубе
                        и включена в стоимость указанное на сайте,
                        сборка букв на композите стоимость считается индивидуально
                        расчёт за кв/м2 уточнить у менеджера.
                        При заказе от 15000 руб. Блок питания бесплатно.
                        Монтаж не включён в стоимость.
                    </p>
                </div>
                <div>
                    <div class="checkbox-wrapper-1 mb-10 w-max-content">
                        <input id="color-1" type="checkbox" class="custom-checkbox ">
                        <label for="color-1">Доп</label>
                    </div>
                    <div class="checkbox-wrapper-1 mb-10 w-max-content">
                        <input id="color-2" type="checkbox" class="custom-checkbox ">
                        <label for="color-2">Доп 2</label>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-yellow">
                <div class="p-50">
                    <div class="h2" style="color: black; border: 1px solid black; border-radius: 30px; padding: 15px; width: max-content;">ПОПУЛЯРНОЕ</div>
                </div>
                <div class="flex-wrap" style="justify-content: space-evenly;">
                    <div class="w-33 pos-rel product-container">
                        <div>
                            <img width="100%" src="/assets/imgs/img-1.png" alt="">
                        </div>
                        <div class="product-description z-1 pos-abs">
                            <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                                <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div class="border-radius-25 p-10 mt-a w-100 text-center"
                                     style="background-color: white; color: black">К ТОВАРУ
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 pos-rel product-container">
                        <div>
                            <img width="100%" src="/assets/imgs/img-1.png" alt="">
                        </div>
                        <div class="product-description z-1 pos-abs">
                            <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                                <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div class="border-radius-25 p-10 mt-a w-100 text-center"
                                     style="background-color: white; color: black">К ТОВАРУ
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 pos-rel product-container">
                        <div>
                            <img width="100%" src="/assets/imgs/img-1.png" alt="">
                        </div>
                        <div class="product-description z-1 pos-abs">
                            <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                                <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div class="border-radius-25 p-10 mt-a w-100 text-center"
                                     style="background-color: white; color: black">К ТОВАРУ
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 pos-rel product-container">
                        <div>
                            <img width="100%" src="/assets/imgs/img-1.png" alt="">
                        </div>
                        <div class="product-description z-1 pos-abs">
                            <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                                <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div class="border-radius-25 p-10 mt-a w-100 text-center"
                                     style="background-color: white; color: black">К ТОВАРУ
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 pos-rel product-container">
                        <div>
                            <img width="100%" src="/assets/imgs/img-1.png" alt="">
                        </div>
                        <div class="product-description z-1 pos-abs">
                            <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                                <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div class="border-radius-25 p-10 mt-a w-100 text-center"
                                     style="background-color: white; color: black">К ТОВАРУ
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 pos-rel product-container">
                        <div>
                            <img width="100%" src="/assets/imgs/img-1.png" alt="">
                        </div>
                        <div class="product-description z-1 pos-abs">
                            <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                                <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div class="border-radius-25 p-10 mt-a w-100 text-center"
                                     style="background-color: white; color: black">К ТОВАРУ
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-yellow">
                <div class="p-50">
                    <div class="h2" style="color: black; border: 1px solid black; border-radius: 30px; padding: 15px; width: max-content;">ПОНРАВИЛОСЬ</div>
                </div>
                <div class="flex-wrap" style="justify-content: space-evenly;">
                    <div class="w-33 pos-rel product-container">
                        <div>
                            <img width="100%" src="/assets/imgs/img-1.png" alt="">
                        </div>
                        <div class="product-description z-1 pos-abs">
                            <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                                <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div class="border-radius-25 p-10 mt-a w-100 text-center"
                                     style="background-color: white; color: black">К ТОВАРУ
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 pos-rel product-container">
                        <div>
                            <img width="100%" src="/assets/imgs/img-1.png" alt="">
                        </div>
                        <div class="product-description z-1 pos-abs">
                            <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                                <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div class="border-radius-25 p-10 mt-a w-100 text-center"
                                     style="background-color: white; color: black">К ТОВАРУ
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 pos-rel product-container">
                        <div>
                            <img width="100%" src="/assets/imgs/img-1.png" alt="">
                        </div>
                        <div class="product-description z-1 pos-abs">
                            <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                                <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div>свойство</div>
                                <div class="border-radius-25 p-10 mt-a w-100 text-center"
                                     style="background-color: white; color: black">К ТОВАРУ
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include("new-design.info")
    </div>
@endsection
