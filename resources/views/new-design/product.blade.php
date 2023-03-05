@extends("new-design.app")

@section("content")
    <style>
        .select-1 {
            padding: 10px 40px 10px 10px;
            border-radius: 25px;
            color: white;
            background-color: var(--main-bg-color);
            border: 1px solid white;
            font-size: 20px;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns= 'http://www.w3.org/2000/svg' viewBox= '0 0 24 24' fill= 'none' stroke= 'white' stroke-width= '2' stroke-linecap= 'round' stroke-linejoin= 'round' %3e%3cpolyline points= '6 9 12 15 18 9' %3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }

        .checkbox-wrapper-1 {
            padding: 10px;
            border: 1px solid white;
            border-radius: 25px;
            font-size: 20px;
        }

    </style>

    <style>
        /* для элемента input c type="checkbox" */
        .custom-checkbox {
            position: absolute;
            z-index: -1;
            opacity: 0;
        }

        /* для элемента label, связанного с .custom-checkbox */
        .custom-checkbox+label {
            display: inline-flex;
            align-items: center;
            user-select: none;
        }

        /* создание в label псевдоэлемента before со следующими стилями */
        .custom-checkbox+label::before {
            content: '';
            display: inline-block;
            width: 1em;
            height: 1em;
            flex-shrink: 0;
            flex-grow: 0;
            border: 1px solid #adb5bd;
            border-radius: 0.25em;
            margin-right: 0.5em;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 50% 50%;
        }

        /* стили при наведении курсора на checkbox */
        .custom-checkbox:not(:disabled):not(:checked)+label:hover::before {
            border-color: #b3d7ff;
        }

        /* стили для активного чекбокса (при нажатии на него) */
        .custom-checkbox:not(:disabled):active+label::before {
            background-color: #b3d7ff;
            border-color: #b3d7ff;
        }

        /* стили для чекбокса, находящегося в фокусе */
        .custom-checkbox:focus+label::before {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* стили для чекбокса, находящегося в фокусе и не находящегося в состоянии checked */
        .custom-checkbox:focus:not(:checked)+label::before {
            border-color: #80bdff;
        }

        /* стили для чекбокса, находящегося в состоянии checked */
        .custom-checkbox:checked+label::before {
            border-color: #0b76ef;
            background-color: #0b76ef;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3e%3c/svg%3e");
        }

        /* стили для чекбокса, находящегося в состоянии disabled */
        .custom-checkbox:disabled+label::before {
            background-color: #e9ecef;
        }
    </style>

    <main>
        <div class="flex" style="padding-left: 100px; padding-right: 100px;">
            <div class="w-60">
                <div class="flex">
                    <div style="width: 300px; height: 300px; background-color: grey"></div>
                    <div class="px-20" style="width: calc(100% - 20px - 20px - 300px)">
                        <h3>ИЗМЕНИТЬ ПАРАМЕТРЫ</h3>
                        <div>
                            <div>
                                <div class="p-10 h3">Подсветка</div>
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
                </div>
                <div class="mb-10">
                    <select name="" id="" class="select-1">
                        <option value="123" selected>1 шт - 745 р</option>
                    </select>
                </div>
                <div class="flex-space-x">
                    <div>
                        <div class="checkbox-wrapper-1 mb-10">
                            <input id="color-1" type="checkbox" class="custom-checkbox ">
                            <label for="color-1">Доп</label>
                        </div>
                        <div class="checkbox-wrapper-1 mb-10">
                            <input id="color-2" type="checkbox" class="custom-checkbox ">
                            <label for="color-2">Доп 2</label>
                        </div>
                    </div>
                    <div>
                        <div style="padding: 10px 20px; border: 1px solid black; border-radius: 25px; font-size: 20px; background-color: white; color: black;">В КОРЗИНУ</div>
                    </div>
                </div>
            </div>
            <div class="w-40">
                <h3>ОПИСАНИЕ</h3>
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
        <div>
            <div class="bg-yellow">
                <div class="p-50">
                    <div class="h2" style="color: black; border: 1px solid black; border-radius: 30px; padding: 15px; width: max-content;">ПОПУЛЯРНОЕ</div>
                </div>
                <div class="flex-wrap" style="justify-content: space-evenly;">
                    <div class="w-33 mb-5" style="background-color: grey; height: 250px; border-radius: 25px;"></div>
                    <div class="w-33 mb-5" style="background-color: grey; height: 250px; border-radius: 25px;"></div>
                    <div class="w-33 mb-5" style="background-color: grey; height: 250px; border-radius: 25px;"></div>
                    <div class="w-33 mb-5" style="background-color: grey; height: 250px; border-radius: 25px;"></div>
                    <div class="w-33 mb-5" style="background-color: grey; height: 250px; border-radius: 25px;"></div>
                    <div class="w-33 mb-5" style="background-color: grey; height: 250px; border-radius: 25px;"></div>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-yellow">
                <div class="p-50">
                    <div class="h2" style="color: black; border: 1px solid black; border-radius: 30px; padding: 15px; width: max-content;">ПОНРАВИЛОСЬ</div>
                </div>
                <div class="flex-wrap" style="justify-content: space-evenly;">
                    <div class="w-33 mb-5" style="background-color: grey; height: 250px; border-radius: 25px;"></div>
                    <div class="w-33 mb-5" style="background-color: grey; height: 250px; border-radius: 25px;"></div>
                    <div class="w-33 mb-5" style="background-color: grey; height: 250px; border-radius: 25px;"></div>
                </div>
            </div>
        </div>
        @include("new-design.info")
    </main>
@endsection
