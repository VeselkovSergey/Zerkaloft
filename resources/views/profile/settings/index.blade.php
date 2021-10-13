@extends('profile.index')

@section('profile-content')

    <div>ID пользователя: {{$user->id}}</div>
    <div>Тип пользователя: {{$user->TypeUser()}}</div>
    <div>Email: {{$user->email}}</div>

    <div class="detailed-information-user">
        @if($user->type_user === 1)
            <div><label>Фамилия:</label><input name="surname" id="surname" type="text" value="{{$user->DetailedInformation->surname}}"></div>
            <div><label>Имя:</label><input name="name" id="name" type="text" value="{{$user->DetailedInformation->name}}"></div>
            <div><label>Отчетсво:</label><input name="patronymic" id="patronymic" type="text" value="{{$user->DetailedInformation->patronymic}}"></div>
            <div><label>Телефон:</label><input name="phone" id="phone" type="text" class="phone-mask" maxlength="17" placeholder="+7(999)-999-99-99" value="{{$user->DetailedInformation->phone}}"></div>
        @else
            <div><label>Название организации:</label><input name="title_org" id="title_org" type="text" value="{{$user->DetailedInformation->title_org}}"></div>
            <div><label>ИНН организации:</label><input name="inn_org" id="inn_org" type="text" value="{{$user->DetailedInformation->inn_org}}"></div>
            <div><label>Телефон сотрудника:</label><input name="phone_org" id="phone_org" type="text" value="{{$user->DetailedInformation->phone_org}}"></div>
            <div><label>Фамилия сотрудника:</label><input name="surname_worker" id="surname_worker" type="text" value="{{$user->DetailedInformation->surname_worker}}"></div>
            <div><label>Имя сотрудника:</label><input name="name_worker" id="name_worker" type="text" value="{{$user->DetailedInformation->name_worker}}"></div>
            <div><label>Отчетсво сотрудника:</label><input name="patronymic_worker" id="patronymic_worker" type="text" value="{{$user->DetailedInformation->patronymic_worker}}"></div>
            <div><label>Юридический адрес организации:</label><input name="address_juridical_org" id="address_juridical_org" type="text" value="{{$user->DetailedInformation->address_juridical_org}}"></div>
            <div><label>Физический адрес организации:</label><input name="address_physical_org" id="address_physical_org" type="text" value="{{$user->DetailedInformation->address_physical_org}}"></div>
            <div><label>Банк организации:</label><input name="bank_org" id="bank_org" type="text" value="{{$user->DetailedInformation->bank_org}}"></div>
            <div><label>Бик банка:</label><input name="bik_bank" id="bik_bank" type="text" value="{{$user->DetailedInformation->bik_bank}}"></div>
            <div><label>Расчетный счёт:</label><input name="payment_account_org" id="payment_account_org" type="text" value="{{$user->DetailedInformation->payment_account_org}}"></div>
            <div><label>Корреспондентский счёт:</label><input name="correspondent_account_org" id="correspondent_account_org" type="text" value="{{$user->DetailedInformation->correspondent_account_org}}"></div>
            <div><label>Имя директора:</label><input name="surname_director" id="surname_director" type="text" value="{{$user->DetailedInformation->surname_director}}"></div>
            <div><label>Фамилия директора:</label><input name="name_director" id="name_director" type="text" value="{{$user->DetailedInformation->name_director}}"></div>
            <div><label>Отчетсво директора:</label><input name="patronymic_director" id="patronymic_director" type="text" value="{{$user->DetailedInformation->patronymic_director}}"></div>
        @endif
    </div>

    <div style="display: flex; padding: 10px;">
        <div style="font-weight: bold; text-align: center;">
            <button class="button-blue save-profile-changes" style="margin: auto;">Сохранить</button>
        </div>
    </div>

@stop

@section('profile-js-container')
    <script>

        document.body.querySelector('.save-profile-changes').addEventListener('click', (e) => {

            if (!CheckingFieldForEmptiness('detailed-information-user')) {
                return false;
            }

            let dataForm = GetDataFormContainer('detailed-information-user');

            Ajax("{{route('change-detail-information')}}", 'post', dataForm).then((response) => {
                ModalWindow(response.message);
            });
        });

        startTrackingNumberInput();

    </script>
@stop
