<div class="flex-center">

    <div class="flex-column-center">

        <form onsubmit="return false;">

            <div class="pos-rel">
                <div class="radio-effect">
                    <div class="slider"></div>
                </div>
                <div class="flex py-10 bg-grey border-radius-5" style="justify-content: space-around">
                    <div class="flex-a z-1">
                        <label class="type_user_label cp text-center color-white" for="physical_user">Физ. лицо</label>
                        <input class="type_user hide" id="physical_user" name="type_user" type="radio" checked="checked" onchange="changeRadioEffect(0);">
                    </div>
                    <div class="flex-a z-1">
                        <label class="type_user_label cp text-center color-white" for="juridical_user">Юр. лицо</label>
                        <input class="type_user hide" id="juridical_user" name="type_user" type="radio" onchange="changeRadioEffect(1);">
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
