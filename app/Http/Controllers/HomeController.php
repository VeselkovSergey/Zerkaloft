<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController
{
    public function Index(Request $request)
    {
        return view('home.index');
    }

    public function About(Request $request)
    {

        return view('home.about');
    }

    public function Contacts(Request $request)
    {
        return view('home.contacts');
    }
}
