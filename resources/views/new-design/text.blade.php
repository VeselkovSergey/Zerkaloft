@php($title_page = 'О компании')

@extends("new-design.app")

@section("content")
    <style>
        .wrapper {
            position: relative;
            border-right: unset;
            border-radius: 50px 0 0 50px;
            height: 92px;
        }

        .wrapper .block {
            padding: 30px;
            width: 87%;
            position: absolute;
            border-radius: 50px 0 0 50px;
            left: 0;
            top: 0;
        }

        .active.wrapper {
            border: 1px solid white;
        }

        .active.wrapper .block {
            background-color: var(--main-bg-color);
        }

        .wrapper .block > div {
            border-color: white;
        }

        .active.wrapper .block > div {
            color: var(--blue-color);
            border-color: var(--blue-color);
        }

        .border-adaptive-none {
            border: 1px solid white;
        }

        @media screen and (max-width: 540px) {

            .block-adaptive-flex {
                overflow: scroll;
            }

            .active.wrapper {
                border: unset;
            }

            .wrapper .block {
                position: static;
            }

            .active.wrapper .block {
                background-color: unset;
            }

            .border-adaptive-none {
                border: unset;
            }
        }

        [data-anchor-relation]:not(.active) {
            display: none;
        }
    </style>
    <div class="mb-10">
        <div class="flex-adaptive-block">
            <div class="w-25-adaptive-100 block-adaptive-flex">
                <div class="mb-10">
                    <div class="wrapper active" data-anchor="about">
                        <div class="block">
                            <div style="border: 1px solid; border-radius: 25px; padding: 5px 25px;">
                                О компании
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-10">
                    <div class="wrapper" data-anchor="contacts">
                        <div class="block">
                            <div style="border: 1px solid; border-radius: 25px; padding: 5px 25px;">
                                Контакты
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-10">
                    <div class="wrapper" data-anchor="information">
                        <div class="block">
                            <div style="border: 1px solid; border-radius: 25px; padding: 5px 25px;">
                                Информация
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-50-adaptive-100 border-adaptive-none" style="border-radius: 0 50px 50px 50px;">
                <div data-anchor-relation="about" style="padding: 10px 30px;">
                    <h2 class="text-center">О компании</h2>
                    <p>
                        {!! $aboutPage->text !!}
                    </p>
                </div>
                <div data-anchor-relation="contacts" style="padding: 10px 30px;">
                    <h2 class="text-center">Контакты</h2>
                    <p>
                        Отдел продаж  +7 4957607606
                        +7 9857607606
                        Info@zerkaloft.ru
                        Для отзывов и предложении
                        zerkaloft@mail.ru
                        Адрес для самовывоза:
                        Фабричная ул., 1, микрорайон Пироговский, Мытищи (подъезд 3)
                        (Как проехать карта, построить маршрут в навигаторе)
                        График работы:
                        Пн –пт 10:00 – 18 00
                        Сб-вс выходной
                        Юридический адрес: 119048, г. Москва ул. Зеленодольская д.7
                        Реквизиты: ИП «Саргсян Т.С.»  ИНН 711110539427 ОГРН 315502700020690
                        ПАО «Сбербанк России» БИК банка: 044525225
                        Р/с. 40802810538000022211
                    </p>
                </div>
                <div data-anchor-relation="information" style="padding: 10px 30px;">
                    <h2 class="text-center">Информация</h2>
                    <p>
                        Пользовательское соглашение «Согласие на обработку персональных данных клиентов-физических лиц»
                        Пользователь, оставляя заявку на интернет-сайте www.zerkaloft.ru, принимает настоящее Согласие на обработку персональных данных (далее – Согласие). Действуя свободно, в своем интересе, а также подтверждая свою дееспособность, Пользователь дает свое согласие ИП «С.Т.С.» ИНН 711110539427 ОГРН 315502700020690, на обработку своих персональных данных со следующими условиями:

                        1. Данное Согласие дается на обработку персональных данных, как без использования средств автоматизации, так и с их использованием.

                        2. Согласие дается на обработку следующих моих персональных данных:

                        1) Персональные данные, не являющиеся специальными или биометрическими: номера контактных телефонов; адреса электронной̆ почты; место работы и занимаемая должность; пользовательские данные (сведения о местоположении; тип и версия ОС; тип и версия Браузера; тип устройства и разрешение его экрана; источник откуда пришел на сайт пользователь; с какого сайта или по какой рекламе; язык ОС и Браузера; какие страницы открывает и на какие кнопки нажимает пользователь; ip-адрес.

                        3. Персональные данные не являются общедоступными.

                        4. Цель обработки персональных данных: обработка входящих запросов физических лиц с целью оказания консультирования; аналитики действий физического лица на веб-сайте и функционирования веб-сайта.

                        5. Основанием для обработки персональных данных является: ст. Источник www.zerkaloft.ru 24 Конституции Российской Федерации; ст.6 Федерального закона №152-ФЗ «О персональных данных»; Устав ООО " Центр Оборудования "; настоящее согласие на обработку персональных данных.

                        6. В ходе обработки с персональными данными будут совершены следующие действия: сбор; запись; систематизация; накопление; хранение; уточнение (обновление, изменение); извлечение; использование; передача (распространение, предоставление, доступ); блокирование; удаление; уничтожение.

                        7. Обработка персональных данных может быть прекращена по запросу субъекта персональных данных. Хранение персональных данных, зафиксированных на бумажных носителях осуществляется согласно Федеральному закону №125-ФЗ «Об архивном деле в Российской Федерации» и иным нормативно правовым актам в области архивного дела и архивного хранения.

                        8. Отзыв согласия на обработку персональных данных может быть осуществлён путём направления Пользователем соответствующего распоряжения в простой письменной форме на адрес электронной почты info@zerkaloft.ru.

                        9. В случае отзыва субъектом персональных данных или его представителем согласия на обработку персональных данных Интернет – магазин зеркало LOFT  вправе продолжить обработку персональных данных без согласия субъекта персональных данных при наличии оснований, указанных в пунктах 2 – 11 части 1 статьи 6, части 2 статьи 10 и части 2 статьи 11 Федерального закона №152-ФЗ «О персональных данных» от 27.07.2006 г.

                        10. Настоящее согласие действует все время до момента прекращения обработки персональных данных, указанных в п.7 и п.8 данного Согласия.

                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script>

        let anchor = location.hash.substr(1)

        if (anchor.length > 0) {
            const findAnchor = document.body.querySelector(`[data-anchor="${anchor}"]`)
            if (findAnchor) {
                document.body.querySelectorAll(".wrapper").forEach((wrapper) => {
                    wrapper.classList.remove("active")
                })
                findAnchor.classList.add("active")
            }
        }


        const allWrapper = document.body.querySelectorAll(".wrapper")
        allWrapper.forEach((wrapper) => {

            if (wrapper.classList.contains("active")) {
                document.body.querySelector(`[data-anchor-relation='${wrapper.dataset.anchor}']`)?.classList.add("active")
            }

            wrapper.addEventListener("click", (e) => {
                allWrapper.forEach((wrapper2) => {
                    wrapper2.classList.remove("active")
                    document.body.querySelector(`[data-anchor-relation='${wrapper2.dataset.anchor}']`)?.classList.remove("active")
                })
                wrapper.classList.add("active")
                document.body.querySelector(`[data-anchor-relation='${wrapper.dataset.anchor}']`)?.classList.add("active")
                window.history.pushState({}, '', location.origin + location.pathname + '#' + wrapper.dataset.anchor)
            })
        })

    </script>
@endsection
