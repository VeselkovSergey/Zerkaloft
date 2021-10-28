@extends('administration.index')

@section('content')

    <div class="font-semibold p-10">Все пользователи</div>
    <table>
        <tr>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Роль</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->Name()}}</td>
                <td>{{$user->Surname()}}</td>
                <td>{{$user->Phone()}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <select class="field-change-role" name="role" data-user-id="{{$user->id}}">
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

                let selectValue = fieldInput.options[fieldInput.selectedIndex].value;
                let userId = fieldInput.dataset.userId;

                Ajax("{{route('change-role')}}", 'post', {role: selectValue, userId: userId}).then((response) => {
                    ShowFlashMessage(response['message']);
                });
            });
        });
    </script>

@stop
