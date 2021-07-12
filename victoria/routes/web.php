<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'home'], function(){

    Route::get('/', [Controllers\HomeController::class, 'index'])
//        ->middleware('permissions:home-page,index')
        ->name('home-page');
});

Route::group(['prefix' => 'auth'], function(){

    Route::group(['prefix' => 'registration'], function(){

        Route::get('/', [Controllers\Authorization\AuthorizationController::class, 'RegistrationPage'])
            ->name('registration-page');

        Route::post('/', [Controllers\Authorization\AuthorizationController::class, 'Registration'])
            ->name('registration');
    });

    Route::group(['prefix' => 'login'], function(){

        Route::get('/', [Controllers\Authorization\AuthorizationController::class, 'LoginPage'])
            ->name('login-page');
    });

    Route::group(['prefix' => 'logout'], function(){

        Route::get('/', [Controllers\Authorization\AuthorizationController::class, 'Logout'])
            ->name('logout');
    });

    Route::group(['prefix' => 'password-recovery'], function(){

        Route::get('/', [Controllers\Authorization\AuthorizationController::class, 'PasswordRecoveryPage'])
            ->name('password-recovery-page');
    });
});

Route::group(['prefix' => 'test'], function(){

    Route::get('/', [Controllers\TestController::class, 'index'])
        ->name('test');

});
