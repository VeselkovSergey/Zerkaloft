<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Панель управления</title>

    <link href="{{asset('resources/css/helpers.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/app.css')}}" rel="stylesheet">

</head>

<body class="flex-center">

<div class="flex-column-center">

    <div class="mb-10 font-semibold">Вход в панель управления</div>

    <form class="shadow border-radius-10 p-25" action="{{route('management-login')}}" method="POST">

        <div class="mb-10">
            <label for="login" style="display: block;">Email</label>
            <input id="login" name="login" type="text" placeholder="Email" class="p-5">
        </div>

        <div class="mb-10">
            <label for="password" style="display: block;">Пароль</label>
            <input id="password" name="password" type="password" placeholder="Пароль" class="p-5">
        </div>

        <div class="flex-center">
            <button class="button-blue w-100">Войти</button>
        </div>

    </form>

</div>

</body>

</html>
