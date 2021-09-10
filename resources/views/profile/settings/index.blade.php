@extends('profile.index')

@section('profile-content')

    <div>
        <div>
            <div>ID пользователя: {{$user->id}}</div>
            <div>Тип пользователя: {{$user->TypeUser()}}</div>
            <div>Email: {{$user->email}}</div>

            <div class="detailed-information-user" style="display: flex; flex-wrap: wrap; justify-content: space-between; width: 100%;">
                @if($user->type_user === 1)
                    <div style="padding: 5px; width: 25%;"><div>Фамилия:</div><input style="width: 100%;" name="surname" id="surname" type="text" value="{{$user->DetailedInformation->surname}}"></div>
                    <div style="padding: 5px; width: 25%;"><div>Имя:</div><input style="width: 100%;" name="name" id="name" type="text" value="{{$user->DetailedInformation->name}}"></div>
                    <div style="padding: 5px; width: 25%;"><div>Отчетсво:</div><input style="width: 100%;" name="patronymic" id="patronymic" type="text" value="{{$user->DetailedInformation->patronymic}}"></div>
                    <div style="padding: 5px; width: 25%;"><div>Телефон:</div><input style="width: 100%;" name="phone" id="phone" type="text" value="{{$user->DetailedInformation->phone}}"></div>
                @else
                    <div style="padding: 5px; width: 16%;"><div>Название организации:</div><input style="width: 100%;" name="title_org" id="title_org" type="text" value="{{$user->DetailedInformation->title_org}}"></div>
                    <div style="padding: 5px; width: 16%;"><div>ИНН организации:</div><input style="width: 100%;" name="inn_org" id="inn_org" type="text" value="{{$user->DetailedInformation->inn_org}}"></div>
                    <div style="padding: 5px; width: 16%;"><div>Телефон сотрудника:</div><input style="width: 100%;" name="phone_org" id="phone_org" type="text" value="{{$user->DetailedInformation->phone_org}}"></div>
                    <div style="padding: 5px; width: 16%;"><div>Фамилия сотрудника:</div><input style="width: 100%;" name="surname_worker" id="surname_worker" type="text" value="{{$user->DetailedInformation->surname_worker}}"></div>
                    <div style="padding: 5px; width: 16%;"><div>Имя сотрудника:</div><input style="width: 100%;" name="name_worker" id="name_worker" type="text" value="{{$user->DetailedInformation->name_worker}}"></div>
                    <div style="padding: 5px; width: 16%;"><div>Отчетсво сотрудника:</div><input style="width: 100%;" name="patronymic_worker" id="patronymic_worker" type="text" value="{{$user->DetailedInformation->patronymic_worker}}"></div>
                    <div style="padding: 5px; width: 50%;"><div>Юридический адрес организации:</div><input style="width: 100%;" name="address_juridical_org" id="address_juridical_org" type="text" value="{{$user->DetailedInformation->address_juridical_org}}"></div>
                    <div style="padding: 5px; width: 50%;"><div>Физический адрес организации:</div><input style="width: 100%;" name="address_physical_org" id="address_physical_org" type="text" value="{{$user->DetailedInformation->address_physical_org}}"></div>
                    <div style="padding: 5px; width: 25%;"><div>Банк организации:</div><input style="width: 100%;" name="bank_org" id="bank_org" type="text" value="{{$user->DetailedInformation->bank_org}}"></div>
                    <div style="padding: 5px; width: 25%;"><div>Бик банка:</div><input style="width: 100%;" name="bik_bank" id="bik_bank" type="text" value="{{$user->DetailedInformation->bik_bank}}"></div>
                    <div style="padding: 5px; width: 25%;"><div>Расчетный счёт:</div><input style="width: 100%;" name="payment_account_org" id="payment_account_org" type="text" value="{{$user->DetailedInformation->payment_account_org}}"></div>
                    <div style="padding: 5px; width: 25%;"><div>Корреспондентский счёт:</div><input style="width: 100%;" name="correspondent_account_org" id="correspondent_account_org" type="text" value="{{$user->DetailedInformation->correspondent_account_org}}"></div>
                    <div style="padding: 5px; width: 33%;"><div>Имя директора:</div><input style="width: 100%;" name="surname_director" id="surname_director" type="text" value="{{$user->DetailedInformation->surname_director}}"></div>
                    <div style="padding: 5px; width: 33%;"><div>Фамилия директора:</div><input style="width: 100%;" name="name_director" id="name_director" type="text" value="{{$user->DetailedInformation->name_director}}"></div>
                    <div style="padding: 5px; width: 33%;"><div>Отчетсво директора:</div><input style="width: 100%;" name="patronymic_director" id="patronymic_director" type="text" value="{{$user->DetailedInformation->patronymic_director}}"></div>
                @endif
            </div>



            <div style="display: flex; padding: 10px;">
                <div style="font-weight: bold; text-align: center;">
                    <button class="button-blue save-profile-changes" style="margin: auto;">Сохранить</button>
                </div>
            </div>

        </div>
    </div>

@stop

@section('profile-js-container')
    <script>

        document.body.querySelector('.save-profile-changes').addEventListener('click', (e) => {
            let dataForm = getDataFormContainer('detailed-information-user', false);
            if (!dataForm) {
                ShowFlashMessage('Заполните все поля!', 5000);
                return false;
            }

            Ajax("{{route('change-detail-information')}}", 'post', dataForm).then((response) => {
                ShowModal('<div style="background-color: white; padding: 25px; font-size: 20px;">' + response.message + '</div>');

            });
        });

    </script>
@stop
