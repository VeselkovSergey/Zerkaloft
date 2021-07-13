<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Админ панель</title>

    </head>

    <body style="max-width: 100%;">

        <div style="background-color: white; display: flex; justify-content: center; align-items: center; padding: 25px; height: calc(100vh - 100px); flex-direction: column;">

            <div style="padding: 15px; font-size: 20px; font-weight: bold;">Вход в панель управления</div>

            <div style="width: 300px; display: flex; justify-content: center; align-items: center; flex-direction: column; border: 1px solid; border-radius: 5px;">

                <div style="padding: 10px;">
                    <label for="login" style="display: block;">Email</label>
                    <input id="login" type="text" placeholder="Email">
                </div>

                <div style="padding: 10px;">
                    <label for="password" style="display: block;">Пароль</label>
                    <input id="password" type="password" placeholder="Пароль">
                </div>

                <div style="padding: 10px;">
                    <button style="cursor: pointer;">Войти</button>
                </div>

            </div>

        </div>

    </body>

</html>





