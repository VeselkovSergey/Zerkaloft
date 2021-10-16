<div class="flex-center">

    <div class="flex-column-center">

        <style>
            .radio-effect {
                background-color: #1976d2;
                position: absolute;
                width: 47%;
                opacity: 0.7;
                margin: 5px 5px 5px 10px;
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

            <div class="physical_user_input show">
                <div class="mb-10">
                    <label for="name">Имя</label>
                    <input id="name" name="name" type="text" placeholder="Имя" class="p-5">
                </div>
                <div class="mb-10">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" placeholder="Email" class="p-5">
                </div>
                <div class="mb-10">
                    <label for="phone">Телефон</label>
                    <input id="phone" name="phone" type="text" class="phone-mask p-5" maxlength="17" placeholder="Телефон">
                </div>

            </div>

            <div class="juridical_user_input hide">
                <div class="mb-10">
                    <label for="title_org">Название</label>
                    <input id="title_org" name="title_org" type="text" placeholder="Название" class="p-5">
                </div>
                <div class="mb-10">
                    <label for="inn_org">ИНН</label>
                    <input id="inn_org" name="inn_org" type="text" placeholder="ИНН" class="p-5">
                </div>
                <div class="mb-10">
                    <label for="surname_worker">Фамилия</label>
                    <input id="surname_worker" name="surname_worker" type="text" placeholder="Фамилия" class="p-5">
                </div>
                <div class="mb-10">
                    <label for="name_worker">Имя</label>
                    <input id="name_worker" name="name_worker" type="text" placeholder="Имя" class="p-5">
                </div>
                <div class="mb-10">
                    <label for="patronymic_worker">Отчество</label>
                    <input id="patronymic_worker" name="patronymic_worker" type="text" placeholder="Отчество" class="p-5">
                </div>
                <div class="mb-10">
                    <label for="email_org">Email</label>
                    <input id="email_org" name="email_org" type="text" placeholder="Email" class="p-5">
                </div>
                <div class="mb-10">
                    <label for="phone_org">Телефон</label>
                    <input id="phone_org" name="phone_org" class="phone-mask p-5" maxlength="17" type="text" placeholder="Телефон">
                </div>

            </div>

            <div class="flex-center">
                <button  onclick="NewUser()" class="button-blue">Регистрация</button>
            </div>

        </form>

    </div>

</div>
