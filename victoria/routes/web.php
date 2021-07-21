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

        Route::post('/', [Controllers\Authorization\AuthorizationController::class, 'Login'])
            ->name('login');
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

Route::group(['prefix' => 'admin'], function(){

    Route::get('/', [Controllers\Administration\AdministrationController::class, 'AdminHomePage'])
        ->name('admin-home-page');

    Route::post('login', [Controllers\Administration\AdministrationController::class, 'AdminLogin'])
        ->name('admin-login');

    Route::post('logout', [Controllers\Administration\AdministrationController::class, 'AdminLogout'])
        ->name('admin-logout');

    Route::group(['prefix' => 'categories'], function(){

        Route::get('/', [Controllers\Categories\CategoriesController::class, 'CategoriesAdminPage'])
            ->name('categories-admin-page');

        Route::get('create', [Controllers\Categories\CategoriesController::class, 'CreateCategoryAdminPage'])
            ->name('create-category-admin-page');

        Route::get('edit/{category_id}', [Controllers\Categories\CategoriesController::class, 'EditCategoryAdminPage'])
            ->name('edit-category-admin-page');

        Route::post('save', [Controllers\Categories\CategoriesController::class, 'SaveCategory'])
            ->name('save-category-admin');

        Route::post('delete', [Controllers\Categories\CategoriesController::class, 'DeleteCategory'])
            ->name('delete-category-admin');
    });

    Route::group(['prefix' => 'subcategories'], function(){

        Route::get('/', [Controllers\Subcategories\SubcategoriesController::class, 'SubcategoriesAdminPage'])
            ->name('subcategories-admin-page');

        Route::get('create', [Controllers\Subcategories\SubcategoriesController::class, 'CreateSubcategoryAdminPage'])
            ->name('create-subcategory-admin-page');

        Route::get('edit/{subcategory_id}', [Controllers\Subcategories\SubcategoriesController::class, 'EditSubcategoryAdminPage'])
            ->name('edit-subcategory-admin-page');

        Route::post('save', [Controllers\Subcategories\SubcategoriesController::class, 'SaveSubcategory'])
            ->name('save-subcategory-admin');

        Route::post('delete', [Controllers\Subcategories\SubcategoriesController::class, 'DeleteSubcategory'])
            ->name('delete-subcategory-admin');
    });

    Route::group(['prefix' => 'products'], function(){

        Route::get('/', [Controllers\Products\ProductsController::class, 'ProductsAdminPage'])
            ->name('products-admin-page');

        Route::get('create', [Controllers\Products\ProductsController::class, 'CreateProductAdminPage'])
            ->name('create-product-admin-page');

        Route::get('edit/{product_id}', [Controllers\Products\ProductsController::class, 'EditProductAdminPage'])
            ->name('edit-product-admin-page');

        Route::post('save', [Controllers\Products\ProductsController::class, 'SaveProduct'])
            ->name('save-product-admin');

        Route::post('delete', [Controllers\Products\ProductsController::class, 'DeleteProduct'])
            ->name('delete-product-admin');
    });
});

Route::group(['prefix' => 'test'], function(){

    Route::get('mail-test', function (){
        \Illuminate\Support\Facades\Mail::to('s-vesel94@ya.ru')->send(new \App\Helpers\MailSender());
    });

    Route::get('/', [Controllers\TestController::class, 'index'])
        ->name('test');

});



Route::group(['prefix' => 'files'], function(){

    Route::get('/{file_id}', [\App\Helpers\Files::class, 'GetFile'])
        ->name('files');

    Route::get('/', [Controllers\TestController::class, 'index'])
        ->name('test');

});
