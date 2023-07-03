<div class="flex-column-center">
    <div class="w-100 mb-10 flex-column">
        <label for="login">Email</label>
        <input id="login" name="login" type="text" placeholder="Email" class="p-5">
    </div>

    <div class="w-100 mb-10 flex-column">
        <label for="password">Пароль</label>
        <input id="password" name="login" type="password" placeholder="Пароль" class="p-5">
    </div>

    <div class="w-100 mb-10 flex-wrap-center" style="justify-content: space-between">
        <button onclick="Login();" class="button-blue m-5">Войти</button>
        <button onclick="PasswordRecoveryPage();" class="button-blue m-5">Забыли пароль?</button>
    </div>

    <div class="w-100 flex-center">
        <button onclick="RegistrationPage();" class="button-blue">Новый пользователь</button>
    </div>
</div>
