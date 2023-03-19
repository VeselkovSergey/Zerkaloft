@extends("new-design.app")

@section("content")
    <div>
        <div class="px-0-adaptive-10">
            <div class="w-70-adaptive-100 mb-10">
                <div class="flex-adaptive-column" style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid white;">
                    <div class="hide-adaptive">
                        <div class="mr-10" style="background-color: grey; width: 40px; height: 40px;">

                        </div>
                    </div>
                    <div class="w-90-adaptive-100">
                        <div class="mr-10-adaptive-0">
                            <div class="flex">
                                <div class="mb-10 flex-center">
                                    <div class="show-adaptive">
                                        <div class="mr-10" style="background-color: grey; width: 40px; height: 40px;">

                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 mb-10" style="border: 1px solid white; border-radius: 25px; padding: 10px;">
                                    ОБЪЕМНАЯ БУКВА С ЛИЦЕВОЙ ПОДСВТЕКОЙ 20СМ.
                                </div>
                            </div>
                            <div class="flex-adaptive-column">
                                <div class="w-75-adaptive-100">
                                    <div class="mr-10-adaptive-0">
                                        <div class="mb-10" style="border: 1px solid white; border-radius: 25px; padding: 10px;">Dop</div>
                                        <div class="mb-10" style="border: 1px solid white; border-radius: 25px; padding: 10px;">Dop</div>
                                    </div>
                                </div>
                                <div class="w-25-adaptive-100 flex-column-end-y">
                                    <div class="flex-center" style="border: 1px solid white; border-radius: 25px; padding: 10px; margin-bottom: 10px;">1 шт 745 руб</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-10-adaptive-100">
                        <div class="flex-space-x" style="border: 1px solid white; border-radius: 25px; padding: 10px;">
                            <div class="flex-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>
                                </svg>
                            </div>
                            <div>1</div>
                            <div class="flex-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                </svg>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-adaptive-column">
                <div class="w-70-adaptive-100 mb-10" style="margin-right: auto;">
                    <div class="h3 flex-center mb-10">ОФОРМЛЕНИЕ</div>
                    <div>
                        <div class="flex-space-x-adaptive-column">
                            <div class="mb-10 w-50-adaptive-100 mr-10-adaptive-0">
                                <input type="text" placeholder="ИМЯ" style="border: 1px solid white; border-radius: 25px; padding: 10px 10px 10px 20px; width: calc(100% - 31px); background-color: var(--main-bg-color); color: white; font-size: 16px;">
                            </div>
                            <div class="mb-10 w-50-adaptive-100">
                                <input type="text" placeholder="ФАМИЛИЯ" style="border: 1px solid white; border-radius: 25px; padding: 10px 10px 10px 20px; width: calc(100% - 31px); background-color: var(--main-bg-color); color: white; font-size: 16px;">
                            </div>
                        </div>
                        <div class="flex-space-x-adaptive-column">
                            <div class="mb-10 w-50-adaptive-100 mr-10-adaptive-0">
                                <input type="text" placeholder="ТЕЛЕФОН" style="border: 1px solid white; border-radius: 25px; padding: 10px 10px 10px 20px; width: calc(100% - 31px); background-color: var(--main-bg-color); color: white; font-size: 16px;">
                            </div>
                            <div class="mb-10 w-50-adaptive-100">
                                <input type="text" placeholder="ЭЛЕКТРОННАЯ ПОЧТА" style="border: 1px solid white; border-radius: 25px; padding: 10px 10px 10px 20px; width: calc(100% - 31px); background-color: var(--main-bg-color); color: white; font-size: 16px;">
                            </div>
                        </div>
                        <div class="mb-10">
                            <textarea name="" id="" cols="30" rows="5" placeholder="КОММЕНТАРИЙ" style="resize: vertical; border: 1px solid white; border-radius: 25px; padding: 10px 10px 10px 20px; width: calc(100% - 31px); background-color: var(--main-bg-color); color: white; font-size: 16px;"></textarea>
                        </div>
                        <div class="flex-space-x-adaptive-column">
                            <div class="mb-10 w-50-adaptive-100 mr-10-adaptive-0">
                                <select name="" id="" class="select-3 w-100">
                                    <option value="123" selected>ТИП ОПЛАТЫ</option>
                                    <option value="123">ОПЛАТА ПРИ ПОЛУЧЕНИИ</option>
                                    <option value="123">ОПЛАТА ОНЛАЙН</option>
                                </select>
                            </div>
                            <div class="mb-10 w-50-adaptive-100">
                                <select name="" id="" class="select-3 w-100">
                                    <option value="123" selected>СПОСОБ ПОЛУЧЕНИЯ</option>
                                    <option value="123">САМОВЫВОЗ</option>
                                    <option value="123">ДОСТАВКА</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-10">
                            <textarea name="" id="" cols="30" rows="3" placeholder="АДРЕС" style="resize: vertical; border: 1px solid white; border-radius: 25px; padding: 10px 10px 10px 20px; width: calc(100% - 31px); background-color: var(--main-bg-color); color: white; font-size: 16px;"></textarea>
                        </div>
                    </div>
                </div>

                <div class="w-25-adaptive-100 flex-column-end-y mb-10">
                    <div class="mb-10" style="border: 1px solid white; border-radius: 25px; padding: 20px;">
                        <div class="flex-center mb-20" style="padding: 10px 20px; border: 1px solid black; border-radius: 25px; font-size: 20px; background-color: white; color: black;">ОФОРМИТЬ</div>
                        <div>
                            <span style="vertical-align: middle; color: var(--pink-color);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                </svg>
                            </span>
                            Согласен с <a href="#">условиями</a> Правил
                            пользования торговой площадкой и правилами
                            возврата и обработки персональных данных.

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include("new-design.info")
    </div>
@endsection
