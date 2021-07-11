<?php


namespace App\Http\Controllers\Authorization;

use Illuminate\Http\Request;

class AuthorizationController
{
    public function LoginPage(Request $request)
    {
        dd('LoginPage');
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
        dd('RegistrationPage');
    }

    public function Registration(Request $request)
    {
        dd('Registration');
    }

    public function PasswordRecoveryPage(Request $request)
    {
        dd('PasswordRecoveryPage');
    }
}
