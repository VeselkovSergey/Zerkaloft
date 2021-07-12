<?php


namespace App\Http\Controllers\Authorization;

use App\Helpers\ResultGenerate;
use App\Helpers\ValidateFields;
use App\Models\User;
use App\Models\UserJuridicals;
use App\Models\UserPhysicals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthorizationController
{
    public function LoginPage(Request $request)
    {
        return view('auth.login');
    }

    public function Login(Request $request)
    {
        dd('Login');
    }

    public function Logout(Request $request)
    {
        dd('Logout');
    }

    public function RegistrationPage(Request $request)
    {
        return view('auth.registration');
    }

    public function Registration(Request $request)
    {
        $type_user = $request->type_user;

        $res = false;

        if ($type_user == 'physical_user') {
            $res = $this->RegistrationUserPhysical($request);

        } elseif($type_user == 'juridical_user') {
            $res = $this->RegistrationUserJuridical($request);
        }

        if ($res === true) {
            return ResultGenerate::Success();
        } else {
            return ResultGenerate::Error($res);
        }
    }

    private function RegistrationUserPhysical(Request $request)
    {
        $surname = $request->surname;
        $name = $request->name;
        $patronymic = $request->patronymic;
        $email = $request->email;
        $phone = $request->phone;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Не верный email!';
        }

        $valid = ValidateFields::NullAndIsset($request->all(), [
            'type_user',
            'name',
            'email',
            'phone',
        ]);

        if (!$valid) {
            return 'Заполнены не все обязательные поля!';
        }

        $user = User::query()->where('email', $email)->first();

        if ($user) {
            return 'Пользователь существует!';
        }

        $fields = $request->all();
        $password = User::PasswordGenerate();

        $fields['type_user'] = 1;
        $fields['password'] = Hash::make($password);
        $user = User::create($fields);

        $fields['user_id'] = $user->id;
        $userPhysical = UserPhysicals::create($fields);

        #toDo Отправить письмо на почту

        return true;
    }

    private function RegistrationUserJuridical(Request $request)
    {
        $title_org = $request->title_org;
        $inn_org = $request->inn_org;
        $email_org = $request->email_org;
        $phone_org = $request->phone_org;
        $surname_worker = $request->surname_worker;
        $name_worker = $request->name_worker;
        $patronymic_worker = $request->patronymic_worker;

        if (!filter_var($email_org, FILTER_VALIDATE_EMAIL)) {
            return 'Не верный email!';
        }

        $valid = ValidateFields::NullAndIsset($request->all(), [
            'title_org',
            'inn_org',
            'email_org',
            'phone_org',
            'surname_worker',
            'name_worker',
        ]);

        if (!$valid) {
            return 'Заполнены не все обязательные поля!';
        }

        $user = User::query()->where('email', $email_org)->first();

        if ($user) {
            return 'Пользователь существует!';
        }

        $fields = $request->all();

        $password = User::PasswordGenerate();

        $fields['type_user'] = 2;
        $fields['password'] = Hash::make($password);
        $user = User::create($fields);

        $fields['user_id'] = $user->id;
        $userJuridical = UserJuridicals::create($fields);

        #toDo Отправить письмо на почту
        return true;
    }


    public function PasswordRecoveryPage(Request $request)
    {
        return view('auth.password-recovery');
    }
}
