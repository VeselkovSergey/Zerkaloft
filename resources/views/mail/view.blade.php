<div style="text-align: center; background-image: url('{{asset('img/new-bg.jpeg')}}'); background-repeat: no-repeat; background-size: cover;">
    <div>
{{--        <img width="200" height="60" src="{{asset('icon/logo_rus.png')}}" alt="">--}}
        <img width="200" height="60" src="{{route('files', \App\Http\Controllers\Administration\SettingsController::GetHeaderLogo()->imageFileId) ?? "/assets/imgs/logo.svg"}}" alt="">
    </div>
    <div style="text-align: center; color: white;">
        <h3>Добро пожаловать</h3>
        <div>Для входа в личный кабинет используйте:</div>
        <div>Логин: <b>{{$email}}</b></div>
        <div>Пароль: <b>{{$password}}</b></div>
    </div>
</div>
