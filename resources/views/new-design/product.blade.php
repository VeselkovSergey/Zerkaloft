@extends("new-design.app")

@section("content")
    <div>
        <div class="flex" style="padding-left: 100px; padding-right: 100px;">
            <div class="w-60">
                <div class="flex mb-10">
                    <div style="width: 300px; height: 300px; background-color: grey"></div>
                    <div class="px-20" style="width: calc(100% - 20px - 20px - 300px)">
                        <div class="h3">ИЗМЕНИТЬ ПАРАМЕТРЫ</div>
                        <div>
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
                        </div>
                    </div>
                </div>
                <div class="mb-10">
                    <select name="" id="" class="select-3 font-light">
                        <option value="123" selected>1 шт - 745 р</option>
                    </select>
                </div>
                <div class="flex-space-x">
                    <div class="font-light">
                        <div class="checkbox-wrapper-1 mb-10">
                            <input id="color-1" type="checkbox" class="custom-checkbox">
                            <label for="color-1">Доп</label>
                        </div>
                        <div class="checkbox-wrapper-1 mb-10">
                            <input id="color-2" type="checkbox" class="custom-checkbox">
                            <label for="color-2">Доп 2</label>
                        </div>
                    </div>
                    <div>
                        <div class="border-radius-25 p-10 mt-a w-100 text-center"
                             style="background-color: white; color: black">В КОРЗИНУ
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-40">
                <div class="h3">Описание</div>
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
        </div>
        @include("new-design.favorite")
        @include("new-design.info")
    </div>
@endsection
