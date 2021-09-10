<div style="background-color: white; display: flex; justify-content: center; align-items: center; padding: 25px;">

    <div style="width: 300px; display: flex; justify-content: center; align-items: center; flex-direction: column;">

{{--        <div style="padding: 10px;">--}}
{{--            <label for="login" style="display: block;">Email</label>--}}
{{--            <input id="login" type="text" placeholder="Email">--}}
{{--            --}}
{{--        </div>--}}

        <div style="width: 100%;">
            <div style="padding: 10px;">
                <label for="login">Email</label>
                <input id="login" name="login" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="text" placeholder="Email" value="">
            </div>
        </div>

        <div style="width: 100%;">
            <div style="padding: 10px;">
                <label for="password">Пароль</label>
                <input id="password" name="login" style="width: 100%; border: 1px solid black; padding: 10px; border-radius: 5px;" type="password" placeholder="Пароль" value="">
            </div>
        </div>

{{--        <div style="padding: 10px;">--}}
{{--            <label for="password" style="display: block;">Пароль</label>--}}
{{--            <input id="password" type="password" placeholder="Пароль">--}}
{{--        </div>--}}

{{--        <div style="display: flex;">--}}
{{--            <div style="padding: 10px;">--}}
{{--                <button onclick="Login();">Войти</button>--}}
{{--            </div>--}}
{{--            <div style="padding: 10px;">--}}
{{--                <button onclick="PasswordRecoveryPage();">Забыли пароль?</button>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div style="display: flex;">
            <div style="/*width: 50%;*/">
                <div style="padding: 10px;">
                    <div style="/*font-weight: bold; font-size: 20px;*/ text-align: center;">
                        <button onclick="Login();" class="button-blue" style="/*width: 80%; margin: auto;*/">Войти</button>
                    </div>
                </div>
            </div>
            <div style="/*width: 50%;*/">
                <div style="padding: 10px;">
                    <div style="/*font-weight: bold; font-size: 20px;*/ text-align: center;">
                        <button onclick="PasswordRecoveryPage();" class="button-blue" style="/*width: 80%; margin: auto;*/">Забыли пароль?</button>
                    </div>
                </div>
            </div>
        </div>

{{--        <div style="display: flex;">--}}
{{--            <div style="padding: 10px;">--}}
{{--                <button onclick="RegistrationPage();">Новый пользователь</button>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div style="display: flex;">
            <div style="/*width: 50%;*/">
                <div style="padding: 10px;">
                    <div style="/*font-weight: bold; font-size: 20px;*/ text-align: center;">
                        <button onclick="RegistrationPage();" class="button-blue" style="/*width: 80%; margin: auto;*/">Новый пользователь</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
