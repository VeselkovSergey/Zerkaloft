<div style="background-color: white; display: flex; justify-content: center; align-items: center; padding: 25px;">

    <div style="width: 300px; display: flex; justify-content: center; align-items: center; flex-direction: column;">

        <style>
            .radio-effect {
                background-color: white;
                position: absolute;
                width: 47%;
                opacity: 0.7;
                margin: 5px;
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
                <div style="padding: 10px;">
                    <label for="surname" style="display: block;">Фамилия</label>
                    <input id="surname" type="text" placeholder="Фамилия">
                </div>

                <div style="padding: 10px;">
                    <label for="name" style="display: block;">Имя</label>
                    <input id="name" type="text" placeholder="Имя">
                </div>

                <div style="padding: 10px;">
                    <label for="patronymic" style="display: block;">Отчество</label>
                    <input id="patronymic" type="text" placeholder="Отчество">
                </div>

                <div style="padding: 10px;">
                    <label for="email" style="display: block;">Email</label>
                    <input id="email" type="text" placeholder="Email">
                </div>

                <div style="padding: 10px;">
                    <label for="phone" style="display: block;">Телефон</label>
                    <input id="phone" type="text" placeholder="Телефон">
                </div>
            </div>

            <div class="juridical_user_input hide-el">
                <div style="padding: 10px;">
                    <label for="title_org" style="display: block;">Название</label>
                    <input id="title_org" type="text" placeholder="Название">
                </div>

                <div style="padding: 10px;">
                    <label for="inn_org" style="display: block;">ИНН</label>
                    <input id="inn_org" type="text" placeholder="ИНН">
                </div>

                <div style="padding: 10px;">
                    <label for="surname_worker" style="display: block;">Фамилия</label>
                    <input id="surname_worker" type="text" placeholder="Фамилия">
                </div>

                <div style="padding: 10px;">
                    <label for="name_worker" style="display: block;">Имя</label>
                    <input id="name_worker" type="text" placeholder="Имя">
                </div>

                <div style="padding: 10px;">
                    <label for="patronymic_worker" style="display: block;">Отчество</label>
                    <input id="patronymic_worker" type="text" placeholder="Отчество">
                </div>

                <div style="padding: 10px;">
                    <label for="email_org" style="display: block;">Email</label>
                    <input id="email_org" type="text" placeholder="Email">
                </div>

                <div style="padding: 10px;">
                    <label for="phone_org" style="display: block;">Телефон</label>
                    <input id="phone_org" type="text" placeholder="Телефон">
                </div>
            </div>

            <div style="display: flex; justify-content: center;">
                <div style="padding: 10px;">
                    <button onclick="NewUser()" class="btn-registration-user">Регистрация</button>
                </div>
            </div>

        </form>

    </div>

</div>
