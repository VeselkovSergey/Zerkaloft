<?php


namespace App\Http\Controllers\Management;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManagementController
{
    public function ManagementHomePage()
    {
        $authUser = auth()->check();
        $user = auth()->user();
        if (!$authUser || $user->role < 10) {
            return view('management.auth.login');
        } else {
            return view('management.index');
        }

    }

    public function ManagementLogin(Request $request)
    {
        $user = User::where('email', $request->login)->first();

        if (!$user) {
            return redirect(route('management-home-page'));
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect(route('management-home-page'));
        }

        Auth::login($user);
        $request->session()->regenerate();
        return redirect(route('management-home-page'));
    }

    public function ManagementLogout()
    {
        Auth::logout();
        return redirect(route('management-home-page'));
    }
}
