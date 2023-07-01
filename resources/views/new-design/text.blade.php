@php($title_page = 'О компании')

@extends("new-design.app")

@section("content")
    <style>
        pre {
            white-space: pre-wrap;       /* Since CSS 2.1 */
            white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
            white-space: -pre-wrap;      /* Opera 4-6 */
            white-space: -o-pre-wrap;    /* Opera 7 */
            word-wrap: break-word;       /* Internet Explorer 5.5+ */
        }
        .wrapper {
            position: relative;
            border-right: unset;
            border-radius: 50px;
            height: 92px;
            white-space: nowrap;
        }

        .wrapper .block {
            padding: 30px;
        }

        .active.wrapper {
            border: 1px solid white;
            box-shadow: 2px 4px 12px 1px black;
        }

        .active.wrapper .block {
            /*background-color: var(--main-bg-color);*/
        }

        .wrapper .block > div {
            border-color: white;
        }

        .active.wrapper .block > div {
            /*color: var(--blue-color);*/
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
        .texts a {
            color: white;
        }
    </style>
    <div class="mb-10">
        <div class="flex-adaptive-block">
            <div class="w-25-adaptive-100 block-adaptive-flex">
                <div class="mb-10">
                    <div class="wrapper active" data-anchor="about">
                        <div class="block">
                            <h3 class="cp" style="border: 1px solid; border-radius: 25px; padding: 5px 25px; margin: 0;">
                                О компании
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="mb-10">
                    <div class="wrapper" data-anchor="contacts">
                        <div class="block">
                            <h3 class="cp" style="border: 1px solid; border-radius: 25px; padding: 5px 25px; margin: 0;">
                                Контакты
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="mb-10">
                    <div class="wrapper" data-anchor="delivery">
                        <div class="block">
                            <h3 class="cp" style="border: 1px solid; border-radius: 25px; padding: 5px 25px; margin: 0;">
                                Доставка
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="mb-10">
                    <div class="wrapper" data-anchor="payment">
                        <div class="block">
                            <h3 class="cp" style="border: 1px solid; border-radius: 25px; padding: 5px 25px; margin: 0;">
                                Оплата
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="mb-10">
                    <div class="wrapper" data-anchor="why_we">
                        <div class="block">
                            <h3 class="cp" style="border: 1px solid; border-radius: 25px; padding: 5px 25px; margin: 0;">
                                Почему&nbsp;мы
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="mb-10">
                    <div class="wrapper" data-anchor="interesting">
                        <div class="block">
                            <h3 class="cp" style="border: 1px solid; border-radius: 25px; padding: 5px 25px; margin: 0;">
                                Полезная&nbsp;информация
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-50-adaptive-100 texts">
                <div data-anchor-relation="about" style="padding: 10px 30px;">
                    <h2 class="text-center">О компании</h2>
                    <pre class="font-regular">
{!! $aboutPage->text !!}
                    </pre>
                </div>
                <div data-anchor-relation="contacts" style="padding: 10px 30px;">
                    <h2 class="text-center">Контакты</h2>
                    <p>Отдел продаж&nbsp; +7 4957607606</p>
                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;+7 9857607606</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="mailto:Info@zerkaloft.ru">Info@zerkaloft.ru</a></span></p>
                    <p>Для отзывов и предложений</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="mailto:zerkaloft@mail.ru">zerkaloft@mail.ru</a></span></p>
                    <p>Адрес для самовывоза:</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<span>Фабричная ул., 1, микрорайон Пироговский, Мытищи (подъезд 3)</span></p>
                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
                    <div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps/213/moscow/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Москва</a><a href="https://yandex.ru/maps/1/moscow-and-moscow-oblast/house/fabrichnaya_ulitsa_1/Z04YcQNjS0cOQFtvfXV2eX9iYw==/?ll=37.743229%2C55.978317&utm_medium=mapframe&utm_source=maps&z=16.65" style="color:#eee;font-size:12px;position:absolute;top:14px;">Фабричная улица, 1 — Яндекс Карты</a><iframe src="https://yandex.ru/map-widget/v1/?ll=37.743229%2C55.978317&mode=search&ol=geo&ouri=ymapsbm1%3A%2F%2Fgeo%3Fdata%3DCgg1NjgzMDQ0NxKOAdCg0L7RgdGB0LjRjywg0JzQvtGB0LrQvtCy0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwsINCc0YvRgtC40YnQuCwg0LzQuNC60YDQvtGA0LDQudC-0L0g0J_QuNGA0L7Qs9C-0LLRgdC60LjQuSwg0KTQsNCx0YDQuNGH0L3QsNGPINGD0LvQuNGG0LAsIDEiCg0Q-RZCFczpX0I%2C&z=16.65" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>
                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
                    <p>График работы:</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Пн &ndash;Вс 10:00 &ndash; 18 00</p>
                    <p>Юридический адрес: 119048, г. Москва ул. Зеленодольская д.7</p>
                    <p>Реквизиты: ИП &laquo;Саргсян Т.С.&raquo;&nbsp;</p>
                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ИНН 711110539427&nbsp; &nbsp; &nbsp;</p>
                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ОГРН 315502700020690</p>
                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ПАО &laquo;Сбербанк России&raquo;</p>
                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; БИК банка: 044525225</p>
                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Р/с. 40802810538000022211</p>
                </div>
                <div data-anchor-relation="delivery" style="padding: 10px 30px;">
                    <h2 class="text-center">Доставка</h2>
                    <p>Оформите доставку зеркал в интернет-магазине быстро и удобно! Мы доставляем заказы по всей России и гарантируем качество и надежность нашей доставки. Наша команда профессионалов бережно упакует и доставит ваш заказ в нужное время.</p>
                    <p>При получении товаров убедитесь, что они соответствуют заказу, а упаковка не повреждена.</p>
                    <p>Доставка в пределах МКАД - 1500 руб. (без выгрузки)</p>
                    <p>Доставка за пределы МКАД - 1500 руб. + 50 руб./км (без выгрузки)</p>
                    <p>Стоимость подъема по лестнице крупногабаритных зеркал (без лифта) — от 500 руб. за 1 этаж.</p>
                    <p>Стоимость подъема на лифте - 500 руб.</p>
                    <p>Доставка заказа осуществляется на следующий день после готовности товара, но срок может измениться в зависимости от загруженности службы доставки или Ваших пожеланий.</p>
                    <p>После изготовления зеркала менеджер свяжется с Вами для уточнения сроков доставки.</p>
                    <p>Подтвердите готовность принять заказ до 12:00, и мы осуществим доставку зеркала в этот же день*.</p>
                    <p>*Данное условие только по Москве.</p>
                    <h2 class="text-center">Самовывоз</h2>
                    <p>Мы свяжемся с вами, когда ваш заказ будет готов к получению.</p>
                    <p>Пожалуйста, обратите внимание, что мы гарантируем хранение вашего заказа в течение 14 дней.</p>
                    <p>Адрес для самовывоза: МО, г. Мытищи, микрорайон Пироговский, Фабричная ул., д. 1, подъезд 3.</p>
                    <p>Самовывоз возможен с ПН по ПТ с 10:00 до 18:00.</p>
                    <h2 class="text-center">Доставка и выгрузка</h2>
                    <p>Стоимость доставки зависит от адреса, тарифа и веса товаров в заказе.</p>
                    <p>Точная стоимость доставки рассчитывается на этапе подтверждения заказа нашим сотрудником</p>
                    <p>Если вы заказываете доставку в другой регион России, наши партнерские курьерские службы готовы помочь с этим - выберите нужную опцию при оформлении заказа или обратитесь к нашему сотруднику для получения консультации.</p>
                    <p>Мы делаем все возможное, чтобы обеспечить быструю и удобную доставку ваших покупок! Интернет-магазин Zerkaloft.ru предоставляет своим клиентам удобную доставку товаров. Мы предлагаем услугу ручного проноса товаров, подъем товаров по лестнице. Стоимость услуги рассчитывается за каждый элемент проноса, каждые 100 кг веса и каждый этаж подъема. Мы гарантируем безопасную и быструю доставку Ваших покупок.</p>
                </div>
                <div data-anchor-relation="payment" style="padding: 10px 30px;">
                    <h2 class="text-center">Оплата</h2>
                    <p>Оплачивайте свои заказы в интернет-магазине быстро и безопасно через нашу онлайн платежную систему! Мы принимаем все основные кредитные карты и гарантируем безопасность вашей онлайн транзакции. Оплата производится моментально и без дополнительных комиссий, чтобы вы могли быстро и удобно оплатить заказ и получить свое новое зеркало.</p>
                    <p>Обращаем Ваше внимание, что заказ запускаются в работу после предоплаты 50%. Все заказы по России отправляются только после 100% оплаты.</p>
                    <p>После оплаты вы получите электронный чек (подтверждающий платёжный документ) по электронной почте или СМС.</p>
                    <p>Срок изготовления составляет 14 дней после оплаты, но может быть увеличен по инициативе продавца.</p>
                    <p>Также предоставляем безналичный расчет для юридических лиц.</p>
                    <h2 class="text-center">Условия возврата</h2>
                    <p>Приобретение товаров в интернет-магазине регулируется ст. 26.1 Закона РФ от 7 февраля 1992 г. № 2300-I "О защите прав потребителей" (далее – закон о защите прав потребителей). Возникшие проблемы с покупками в сети нужно решать, опираясь на этот закон. Недобросовестный продавец, услышав вашу осведомленность в своих правах, может пересмотреть свою позицию. Основные пункты, которые должен знать каждый покупатель в Интернете: Договор розничной купли-продажи может быть заключен на основании ознакомления потребителя с предложенным продавцом описанием товара посредством каталогов, проспектов, буклетов, фотоснимков, средств связи (телевизионной, почтовой, радиосвязи и других) или иными исключающими возможность непосредственного ознакомления потребителя с товаром либо образцом товара при заключении такого договора (дистанционный способ продажи товара) способами. (в ред. Федерального закона от 25.10.2007 N 234-ФЗ) Потребитель вправе отказаться от товара в любое время до его передачи. Возврат товара надлежащего качества возможен в случае, если сохранены его товарный вид, потребительские свойства, а также документ, подтверждающий факт и условия покупки указанного товара. Отсутствие у потребителя документа, подтверждающего факт и условия покупки товара, не лишает его возможности ссылаться на другие доказательства приобретения товара у данного продавца. Отказаться невозможно только от товара, который сделан под заказ, по вашим индивидуальным параметрам. Если причиной возврата товара служит претензия к его свойствам, продавец вправе заказать проведение экспертизы качества. Если он будет настаивать на этой мере, срок обмена увеличивается и будет равным 20 дням (п. 1 ст. 21 закона о защите прав потребителей). Как правило, экспертиза проводится за счет продавца. Так как именно он оспаривает тот факт, что товар не соответствует первоначальным характеристикам. Если результат экспертизы не удовлетворяет покупателя, он имеет право оспорить это решение в суде, предоставив вывод других квалификационных структур. Если экспертиза подтвердила, что брак со стороны продавца, то товар будет заменён за счёт продавца.</p>
                    <h2 class="text-center">Пользовательское соглашение</h2>
                    <p>Пользовательское соглашение «Согласие на обработку персональных данных клиентов-физических лиц» Пользователь, оставляя заявку на интернет-сайте www.zerkaloft.ru, принимает настоящее Согласие на обработку персональных данных (далее – Согласие). Действуя свободно, в своем интересе, а также подтверждая свою дееспособность, Пользователь дает свое согласие ИП «С.Т.С.» ИНН 711110539427 ОГРН 315502700020690, на обработку своих персональных данных со следующими условиями: Данное Согласие дается на обработку персональных данных, как без использования средств автоматизации, так и с их использованием. Согласие дается на обработку следующих моих персональных данных: 1) Персональные данные, не являющиеся специальными или биометрическими: номера контактных телефонов; адреса электронной̆ почты; место работы и занимаемая должность; пользовательские данные (сведения о местоположении; тип и версия ОС; тип и версия Браузера; тип устройства и разрешение его экрана; источник откуда пришел на сайт пользователь; с какого сайта или по какой рекламе; язык ОС и Браузера; какие страницы открывает и на какие кнопки нажимает пользователь; ip-адрес. Персональные данные не являются общедоступными. Цель обработки персональных данных: обработка входящих запросов физических лиц с целью оказания консультирования; аналитики действий физического лица на веб-сайте и функционирования веб-сайта. В ходе обработки с персональными данными будут совершены следующие действия: сбор; запись; систематизация; накопление; хранение; уточнение (обновление, изменение); извлечение; использование; передача (распространение, предоставление, доступ); блокирование; удаление; уничтожение. Обработка персональных данных может быть прекращена по запросу субъекта персональных данных. Хранение персональных данных, зафиксированных на бумажных носителях осуществляется согласно Федеральному закону №125-ФЗ «Об архивном деле в Российской Федерации» и иным нормативно правовым актам в области архивного дела и архивного хранения. Отзыв согласия на обработку персональных данных может быть осуществлён путём направления Пользователем соответствующего распоряжения в простой письменной форме на адрес электронной почты info@zerkaloft.ru. В случае отзыва субъектом персональных данных или его представителем согласия на обработку персональных данных Интернет – магазин зеркало LOFT вправе продолжить обработку персональных данных без согласия субъекта персональных данных при наличии оснований, указанных в пунктах 2 – 11 части 1 статьи 6, части 2 статьи 10 и части 2 статьи 11 Федерального закона №152-ФЗ «О персональных данных» от 27.07.2006 г. настоящее согласие действует все время до момента прекращения обработки персональных данных, указанных в п.7 и п.8 данного Согласия.</p>
                </div>
                <div data-anchor-relation="why_we" style="padding: 10px 30px;">
                    <h2 class="text-center">Почему мы</h2>
                    <p>Зеркало - это не просто предмет интерьера, но и неотъемлемая часть повседневной жизни. В нашем магазине вы найдете разнообразные по стилю и форме модели зеркал, которые помогут вам создать уютную и функциональную обстановку в любом помещении. У нас вы найдете зеркала разных форматов: от маленьких настольных до больших напольных. Также мы предлагаем зеркала с различными рамами: от классических деревянных до современных металлических, в разных цветах и оттенках. Наши зеркала отличаются высоким качеством и долговечностью, что позволяет наслаждаться ими многие годы. Не стесняйтесь выбирать свое идеальное зеркало и делать ваш дом или офис еще более уютным и привлекательным. Наш интернет-магазин предлагает широкий выбор зеркал различных форм и размеров. Мы гарантируем высокое качество товаров и быструю доставку в любой регион России. У нас вы найдете зеркала для всех помещений: от ванных комнат до гостиных и спален. В нашем каталоге представлены зеркала различных форм: круглые, овальные, прямоугольные и другие, а также зеркала с подсветкой и без. Мы готовы предложить индивидуальные условия для дизайнеров и строительных компаний, которые занимаются созданием интерьеров и ремонтом. Оформление заказа у нас простое и удобное. Если у вас возникнут вопросы, наши менеджеры готовы помочь в любое время суток. Заказывайте зеркала в нашем интернет-магазине и дополните свой интерьер красивыми и функциональными элементами!</p>
                </div>
                <div data-anchor-relation="interesting" style="padding: 10px 30px;">
                    <h2 class="text-center">Полезная информация</h2>
                    <h2>Выезд Замерщика</h2>
                    <p>Часто бывает сложно определиться с размером и формой зеркала.</p>
                    <p>Наш замерщик профессионально выполнит замеры, учтет все ваши предпочтения и рекомендации, а также даст ценные советы по выбору дизайна и стиля зеркала.</p>
                    <p>Как это работает? Очень просто!</p>
                    <p>Вы оставляете заявку на нашем сайте, указывая удобные для вас дату и время. Наш замерщик свяжется с вами для подтверждения встречи.</p>
                    <p>Оставьте заявку на нашем сайте или свяжитесь с нами по указанным контактным данным. Мы с удовольствием поможем вам создать стильное и функциональное пространство с помощью прекрасных зеркал.</p>
                    <p>Стоимость услуги:*</p>
                    <p>В пределах МКАД - 2500 руб.</p>
                    <p>За пределы МКАД - 2500 руб. + 50 руб./км</p>
                    <p>.* При заказе зеркал от 30000руб. данная услуга не входит в стоимость.</p>
                    <h2>Монтаж</h2>
                    <p>Мы также предлагаем профессиональные монтажные работы. Наши опытные специалисты обеспечат качественную и надежную установку зеркала в вашем помещении. Мы уделяем особое внимание точности и эстетическому вида монтажа, чтобы зеркало стало не только функциональным элементом, но и стильным акцентом в вашем интерьере.</p>
                    <p>Наша компания гарантирует высокое качество зеркал и профессиональное исполнение монтажных работ.</p>
                    <p>Чтобы заказать монтажные работы, просто сообщите нашему сотруднику о ваших пожеланиях или оставьте комментарий с подробностями при оформлении заказа. Мы готовы принять вызов и превратить ваши идеи в реальность. Доверьте ваш проект опытным профессионалам и наслаждайтесь результатом.</p>
                    <p>Не откладывайте, заказывайте зеркало и наслаждайтесь его красотой и функциональностью уже сегодня!</p>
                    <p>Стоимость услуги:</p>
                    <p>От 20% от стоимости зеркала, но не менее от 3000руб.</p>
                    <h2>Нестандартные решения</h2>
                    <p>Помимо стандартных зеркал, мы также предлагаем индивидуальный заказ, реализуя нестандартные решения.</p>
                    <p>Если вы представляете дизайн-студию, то мы можем предложить вам специальные зеркала, созданные с учетом всех требований профессионалов в данной сфере.</p>
                    <p>Мы также предлагаем зеркала, идеально подходящие для танцевальных студий, обеспечивая тем самым безопасность и комфорт во время тренировок.</p>
                    <p>В нашем ассортименте имеются разнообразные типы зеркал: напольные, зеркальные панно, а также зеркала с фотопечатью и декоративные зеркала. Мы готовы предложить вам самые современные технологии и инновации в области зеркальных изделий.</p>
                    <p>Предлагаем широкий выбор деревянных рам, чтобы подчеркнуть элегантность и уникальность вашего зеркала.</p>
                    <p>Наша компания также специализируется на зеркалах как зеркала в дизайнерской раме, зеркало для гримерной, зеркала под старину, и много другое.</p>
                    <p>Не важно, какие требования у вас есть к зеркалам, наша цель - обеспечить высокое качество продукции и превзойти ваши ожидания. Свяжитесь с нами уже сегодня, чтобы получить профессиональную помощь и надежный сервис по производству и установке зеркал.</p>
                    <p>Закажите зеркало у нашей компании прямо сейчас и убедитесь сами в высоком качестве наших услуг и продукции. Мы гарантируем полную удовлетворенность каждого клиента и индивидуальный подход к каждому заказу.</p>
                    <p>Сотрудничество с нами - это надежность, профессионализм и стиль.</p>
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

        const timer = setInterval(() => {
            if (anchor !== location.hash.substr(1)) {
                anchor = location.hash.substr(1)
                const findAnchor = document.body.querySelector(`[data-anchor="${anchor}"]`)
                if (findAnchor) {
                    document.body.querySelectorAll(".wrapper").forEach((wrapper2) => {
                        wrapper2.classList.remove("active")
                        document.body.querySelector(`[data-anchor-relation='${wrapper2.dataset.anchor}']`)?.classList.remove("active")
                    })
                    findAnchor.classList.add("active")
                    document.body.querySelector(`[data-anchor-relation='${findAnchor.dataset.anchor}']`)?.classList.add("active")
                }
            }
        }, 100)


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
