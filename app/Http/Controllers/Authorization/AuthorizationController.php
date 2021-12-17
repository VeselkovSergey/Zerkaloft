<?php


namespace App\Http\Controllers\Authorization;

use App\Helpers\MailSender;
use App\Helpers\ResultGenerate;
use App\Helpers\ValidateFields;
use App\Models\User;
use App\Models\UserJuridicals;
use App\Models\UserPhysicals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthorizationController
{
    public function LoginPage(Request $request)
    {
        if (!Auth::user()) {
            return view('auth.login');
        }
        return ResultGenerate::Error('Вы уже авторизованы!');
    }

    public function Login(Request $request)
    {
        $user = User::where('email', $request->login)->first();

        if (!$user) {
            return ResultGenerate::Error('Пользователь не найден!');
        }

        if (!Hash::check($request->password, $user->password)) {
            return ResultGenerate::Error('Не верный пароль!');
        }

        Auth::login($user);
        $request->session()->regenerate();
        return ResultGenerate::Success('Вы авторизовались в системе!');
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        return redirect(route('home-page'));
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

        if ($res instanceof UserPhysicals || $res instanceof UserJuridicals) {
            return ResultGenerate::Success('Регистрация успешна! Пароль выслан на почту!');
        } else {
            return ResultGenerate::Error($res);
        }
    }

    public function FastRegistration(Request $request)
    {
        return $this->RegistrationUserPhysical($request);
    }

    private function RegistrationUserPhysical(Request $request)
    {
        $surname = !empty($request->surname) ? $request->surname : '-';
        $name = $request->name;
        $patronymic = !empty($request->patronymic) ? $request->patronymic : '-';
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
        $fields['surname'] = $surname;
        $fields['name'] = $name;
        $fields['patronymic'] = $patronymic;
        $fields['phone'] = preg_replace("/[^0-9]/", '', $phone);
        $userPhysical = UserPhysicals::create($fields);

        Mail::to($user->email)->send(new MailSender($password));

        return $userPhysical;
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
        $fields['email'] = $email_org;
        $user = User::create($fields);

        $fields['user_id'] = $user->id;
        $fields['title_org'] = $title_org;
        $fields['inn_org'] = $inn_org;
        $fields['phone_org'] = $phone_org;
        $fields['surname_worker'] = $surname_worker;
        $fields['name_worker'] = $name_worker;
        $fields['patronymic_worker'] = $patronymic_worker;
        $userJuridical = UserJuridicals::create($fields);

        Mail::to($user->email)->send(new MailSender($password));

        return $userJuridical;
    }


    public function PasswordRecoveryPage(Request $request)
    {
        return view('auth.password-recovery');
    }
}
