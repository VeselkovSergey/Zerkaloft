<div style="background-color: white; display: flex; justify-content: center; align-items: center; padding: 25px;">

    <div style="width: 300px; display: flex; justify-content: center; align-items: center; flex-direction: column;">

        <div style="padding: 10px;">
            <label for="login" style="display: block;">Email</label>
            <input id="login" type="text" placeholder="Email">
        </div>

        <div style="padding: 10px;">
            <label for="password" style="display: block;">Пароль</label>
            <input id="password" type="text" placeholder="Пароль">
        </div>

        <div style="display: flex;">
            <div style="padding: 10px;">
                <button>Войти</button>
            </div>
            <div style="display: flex; align-items: center;">
                <a href="{{route('password-recovery-page')}}">Забыли пароль?</a>
            </div>
        </div>

        <div style="display: flex;">
            <div style="padding: 10px;">
                <button onclick="RegistrationPage();">Новый пользователь</button>
            </div>
        </div>

    </div>

</div>
