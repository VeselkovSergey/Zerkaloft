<?php


namespace App\Http\Controllers\Administration;


class AdministrationController
{
    public function AdminHomePage()
    {
        if (false) {
            return view('administration.auth.login');
        } else {
            return view('administration.index');
        }

    }

    public function AdminLogin()
    {
        dd('AdminLogin');
    }

    public function AdminLogout()
    {
        dd('AdminLogout');
    }
}
