<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class TestController
{
    public function index(Request $request)
    {
        dd(Hash::make('test@test.test'));
    }
}
