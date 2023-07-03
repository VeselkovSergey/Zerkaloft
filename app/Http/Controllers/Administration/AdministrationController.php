<?php


namespace App\Http\Controllers\Administration;


use App\Helpers\ResultGenerate;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdministrationController extends Controller
{
    public function AdminHomePage()
    {
        $authUser = auth()->check();
        $user = auth()->user();
        if (!$authUser || $user->role != 99) {
            return view('administration.auth.login');
        } else {
            return view('administration.index');
        }
    }

    public function AdminLogin(Request $request)
    {
        $user = User::where('email', $request->login)->first();

        if (!$user) {
            return redirect(route('admin-home-page'));
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect(route('admin-home-page'));
        }

        Auth::login($user);
        $request->session()->regenerate();
        return redirect(route('admin-home-page'));
    }

    public function AdminLogout()
    {
        Auth::logout();
        return redirect(route('admin-home-page'));
    }
}
