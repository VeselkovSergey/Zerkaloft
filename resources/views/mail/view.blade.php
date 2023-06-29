<div style="text-align: center; background-image: url('{{asset('img/new-bg.jpeg')}}'); background-repeat: no-repeat; background-size: contain;">
    <div>
{{--        <img width="200" height="60" src="{{asset('icon/logo_rus.png')}}" alt="">--}}
        <img width="200" height="60" src="{{route('files', \App\Http\Controllers\Administration\SettingsController::GetHeaderLogo()->imageFileId) ?? "/assets/imgs/logo.svg"}}" alt="">
    </div>
    <div style="text-align: center;">
        <h3>Добро пожаловать</h3>
        <div>Для входа в личный кабинет используйте:</div>
        <div><span style="color: #2e3192;">Логин:</span> {{$email}}</div>
        <div><span style="color: #2e3192;">Пароль:</span> {{$password}}</div>
    </div>
</div>
