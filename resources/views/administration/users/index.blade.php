@extends('administration.index')

@section('content')

    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>

    <div class="font-semibold p-10">Все пользователи</div>
    <table class="w-100">
        <tr>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Роль</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td class="text-center">{{$user->Name()}}</td>
                <td class="text-center">{{$user->Surname()}}</td>
                <td class="text-center">{{$user->Phone()}}</td>
                <td class="text-center">{{$user->email}}</td>
                <td class="text-center">
                    <select class="field-change-role w-100" name="role" data-user-id="{{$user->id}}">
                        @foreach(\App\Models\User::RoleName as $id => $role)
                            <option value="{{$id}}" @if($user->role === $id) selected @endif>{{$role}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        @endforeach
    </table>
@stop

@section('js')

    <script>
        document.body.querySelectorAll('.field-change-role').forEach((fieldInput) => {
            fieldInput.addEventListener('change', () => {
                LoaderShow();

                let selectValue = fieldInput.options[fieldInput.selectedIndex].value;
                let userId = fieldInput.dataset.userId;

                Ajax("{{route('change-role')}}", 'post', {role: selectValue, userId: userId}).then((response) => {
                    LoaderHide();
                    ShowFlashMessage(response['message']);
                });
            });
        });
    </script>

@stop
