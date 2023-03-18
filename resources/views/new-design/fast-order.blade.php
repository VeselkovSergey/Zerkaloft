<?php
$bredcrumbs = [
    "Главная" => route("new-design.index"),
    "Быстрое оформление" => route("new-design.fast-order"),
];
?>

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
        <div class="px-0-adaptive-10">
            @include("new-design.bredcrumbs", $bredcrumbs)
        </div>
        <div class="flex-wrap mb-10 px-0-adaptive-10">
            <div class="w-35-adaptive-100 mb-10">
                <div class="mb-20 mr-10-adaptive-0">
                    <div>
                        <div class="p-10 h3">Категория</div>
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
                <div class="w-50-adaptive-100">
                    <div class="border-radius-25 p-10 mt-a text-center"
                         style="background-color: white; color: black">К ТОВАРУ
                    </div>
                </div>
            </div>
            <div class="flex-wrap w-40-adaptive-100">
                <div class="flex mb-10 m-a-adaptive" style="order: 1">
                    <div style="width: 300px; height: 300px; background-color: grey"></div>
                </div>
                <div class="font-light order-2-4">
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
                <div class="flex-space-x mr-10-adaptive-0 order-3-2 w-100">
                    <div class="flex mb-10">
                        <select name="" id="" class="select-3 font-light">
                            <option value="123" selected>1 шт - 745 р</option>
                        </select>
                    </div>
                    <div class="mb-10 w-a-adaptive-100 ml-10">
                        <div class="border-radius-25 p-10 mt-a text-center"
                             style="background-color: white; color: black;">В КОРЗИНУ
                        </div>
                    </div>
                </div>
                <div class="flex-space-x-adaptive-column order-4-3">
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
                </div>
            </div>
        </div>
        @include("new-design.favorite")
        @include("new-design.info")
    </div>
@endsection
