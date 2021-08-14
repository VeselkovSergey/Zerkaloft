<div style="background-color: white; display: flex; justify-content: center; align-items: center; padding: 25px;">

    <div style="width: 300px; display: flex; justify-content: center; align-items: center; flex-direction: column;">

        <style>
            .radio-effect {
                background-color: #1976d2;
                position: absolute;
                width: 47%;
                opacity: 0.7;
                margin: 5px 5px 5px 10px;
                /*margin-left: 50%;*/
                height: calc(100% - 10px);
                transition: margin 300ms;
                border-radius: 10px;
            }
        </style>

        <form onsubmit="return false;">

            <div style="display: flex; position: relative;">
                <div class="radio-effect"></div>
                <div style="display: flex; width: 100%; background-color: rgba(0, 0, 0, 0.2); padding: 10px; border-radius: 10px;">
                    <div style="width: 50%; text-align: center; z-index: 1;">
                        <label class="type_user_label" for="physical_user" style="display: block; cursor: pointer;">Физ. лицо</label>
                        <input class="type_user" id="physical_user" name="type_user" type="radio" style="display: none;" checked="checked" onchange="changeRadioEffect(0);">
                    </div>

                    <div style="width: 50%; text-align: center; z-index: 1;">
                        <label class="type_user_label" for="juridical_user" style="display: block; cursor: pointer;">Юр. лицо</label>
                        <input class="type_user" id="juridical_user" name="type_user" type="radio" style="display: none;" onchange="changeRadioEffect(1);">
                    </div>
                </div>
            </div>

            <div class="physical_user_input show-el">

                <div style="width: 100%;">
                    <div style="padding: 10px;">
                        <label for="surname">Фамилия</label>
                        <input id="surname" name="surname" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Фамилия" value="">
                    </div>
                </div>

                <div style="width: 100%;">
                    <div style="padding: 10px;">
                        <label for="name">Имя</label>
                        <input id="name" name="name" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Имя" value="">
                    </div>
                </div>

                <div style="width: 100%;">
                    <div style="padding: 10px;">
                        <label for="patronymic">Отчество</label>
                        <input id="patronymic" name="patronymic" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Отчество" value="">
                    </div>
                </div>

                <div style="width: 100%;">
                    <div style="padding: 10px;">
                        <label for="email">Email</label>
                        <input id="email" name="email" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Email" value="">
                    </div>
                </div>

                <div style="width: 100%;">
                    <div style="padding: 10px;">
                        <label for="phone">Телефон</label>
                        <input id="phone" name="phone" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" class="phone-mask" maxlength="17" placeholder="Телефон" value="">
                    </div>
                </div>

            </div>

            <div class="juridical_user_input hide-el">

                <div style="width: 100%;">
                    <div style="padding: 10px;">
                        <label for="title_org">Название</label>
                        <input id="title_org" name="title_org" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Название" value="">
                    </div>
                </div>

                <div style="width: 100%;">
                    <div style="padding: 10px;">
                        <label for="inn_org">ИНН</label>
                        <input id="inn_org" name="inn_org" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="ИНН" value="">
                    </div>
                </div>

                <div style="width: 100%;">
                    <div style="padding: 10px;">
                        <label for="surname_worker">Фамилия</label>
                        <input id="surname_worker" name="surname_worker" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Фамилия" value="">
                    </div>
                </div>

                <div style="width: 100%;">
                    <div style="padding: 10px;">
                        <label for="name_worker">Имя</label>
                        <input id="name_worker" name="name_worker" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Имя" value="">
                    </div>
                </div>

                <div style="width: 100%;">
                    <div style="padding: 10px;">
                        <label for="patronymic_worker">Отчество</label>
                        <input id="patronymic_worker" name="patronymic_worker" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Отчество" value="">
                    </div>
                </div>

                <div style="width: 100%;">
                    <div style="padding: 10px;">
                        <label for="email_org">Email</label>
                        <input id="email_org" name="email_org" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Email" value="">
                    </div>
                </div>

                <div style="width: 100%;">
                    <div style="padding: 10px;">
                        <label for="phone_org">Телефон</label>
                        <input id="phone_org" name="phone_org" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" class="phone-mask" maxlength="17" type="text" placeholder="Телефон" value="">
                    </div>
                </div>

            </div>

            <div style="display: flex;">
                <div style="width: 100%;">
                    <div style="padding: 10px;">
                        <div style="/*font-weight: bold; font-size: 20px;*/ text-align: center;">
                            <button  onclick="NewUser()" class="button-blue" style="width: 100%;/*width: 80%; margin: auto;*/">Регистрация</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>

</div>
