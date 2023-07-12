<?php

use App\Helpers\MailSender;
use App\Models\User;
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

Route::get('resources/{directory}/{fileName}', [Controllers\Resources\ResourceController::class, 'GetResources']);

Route::group(['prefix' => '/'], function () {

    Route::get('/', [Controllers\HomeController::class, 'Index'])
//        ->middleware('permissions:home-page,index')
        ->name('home-page');

    Route::get('/online-order', [Controllers\HomeController::class, 'OnlineOrder'])
        ->name('online-order');

    Route::get('/about', [Controllers\HomeController::class, 'About'])
        ->name('about-page');

    Route::get('/contacts', [Controllers\HomeController::class, 'Contacts'])
        ->name('contacts-page');

    Route::get('/special-order', function () {
        return view('home.formFastOrder');
    })->name('form-special-order');

});

Route::group(['prefix' => 'auth'], function () {

    Route::group(['prefix' => 'registration'], function () {

        Route::get('/', [Controllers\Authorization\AuthorizationController::class, 'RegistrationPage'])
            ->name('registration-page');

        Route::post('/', [Controllers\Authorization\AuthorizationController::class, 'Registration'])
            ->name('registration');
    });

    Route::group(['prefix' => 'login'], function () {

        Route::get('/', [Controllers\Authorization\AuthorizationController::class, 'LoginPage'])
            ->name('login-page');

        Route::post('/', [Controllers\Authorization\AuthorizationController::class, 'Login'])
            ->name('login');
    });

    Route::group(['prefix' => 'logout'], function () {

        Route::get('/', [Controllers\Authorization\AuthorizationController::class, 'Logout'])
            ->name('logout');
    });

    Route::group(['prefix' => 'password-recovery'], function () {

        Route::get('/', [Controllers\Authorization\AuthorizationController::class, 'PasswordRecoveryPage'])
            ->name('password-recovery-page');

        Route::post('/post', [Controllers\Authorization\AuthorizationController::class, 'PasswordRecoveryRequest'])
            ->name('password-recovery-request');
    });

});

Route::group(['prefix' => 'profile'], function () {

//    Route::get('/', [Controllers\Profile\ProfileController::class, 'ProfilePage'])
//        ->name('profile-page');

    Route::get('/orders', [Controllers\Profile\ProfileController::class, 'UserOrdersPage'])
        ->name('user-orders-page');

    Route::group(['prefix' => 'order'], function () {

        Route::get('/{order_id}', [Controllers\Profile\ProfileController::class, 'UserOrderPage'])
            ->name('user-order-page');

    });

    Route::group(['prefix' => 'setting'], function () {

        Route::get('/', [Controllers\Profile\ProfileController::class, 'UserSettingsPage'])
            ->name('user-settings-page');

        Route::post('/change-detail-information', [Controllers\Profile\ProfileController::class, 'ChangeDetailInformation'])
            ->name('change-detail-information');
    });

});

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', [Controllers\Administration\AdministrationController::class, 'AdminHomePage'])
        ->name('admin-home-page');

    Route::post('/login', [Controllers\Administration\AdministrationController::class, 'AdminLogin'])
        ->name('admin-login');

    Route::get('/logout', [Controllers\Administration\AdministrationController::class, 'AdminLogout'])
        ->name('admin-logout');

    Route::group(['prefix' => 'properties-categories'], function () {

        Route::get('/', [Controllers\PropertiesCategories\PropertiesCategoriesController::class, 'PropertiesCategoriesAdminPage'])
            ->name('properties-categories-admin-page');

        Route::get('/create', [Controllers\PropertiesCategories\PropertiesCategoriesController::class, 'CreatePropertyCategoriesAdminPage'])
            ->name('create-property-categories-admin-page');

        Route::get('/edit/{property_categories_id}', [Controllers\PropertiesCategories\PropertiesCategoriesController::class, 'EditPropertyCategoriesAdminPage'])
            ->name('edit-property-categories-admin-page');

        Route::post('/save', [Controllers\PropertiesCategories\PropertiesCategoriesController::class, 'SavePropertyCategories'])
            ->name('save-property-categories-admin');

        Route::post('/delete', [Controllers\PropertiesCategories\PropertiesCategoriesController::class, 'DeletePropertyCategories'])
            ->name('delete-property-categories-admin');
    });

    Route::group(['prefix' => 'categories'], function () {

        Route::get('/', [Controllers\Categories\CategoriesController::class, 'CategoriesAdminPage'])
            ->name('categories-admin-page');

        Route::get('/create', [Controllers\Categories\CategoriesController::class, 'CreateCategoryAdminPage'])
            ->name('create-category-admin-page');

        Route::get('/edit/{category_id}', [Controllers\Categories\CategoriesController::class, 'EditCategoryAdminPage'])
            ->name('edit-category-admin-page');

        Route::post('/save', [Controllers\Categories\CategoriesController::class, 'SaveCategory'])
            ->name('save-category-admin');

        Route::post('/delete', [Controllers\Categories\CategoriesController::class, 'DeleteCategory'])
            ->name('delete-category-admin');

        Route::post('/change-prices', [Controllers\Categories\CategoriesController::class, 'ChangePrices'])
            ->name('change-prices-category-admin');
    });

    Route::group(['prefix' => 'additional-services'], function () {

        Route::get('/', [Controllers\AdditionalServices\AdditionalServicesController::class, 'AdditionalServicesAdminPage'])
            ->name('additional-services-admin-page');

        Route::get('/create', [Controllers\AdditionalServices\AdditionalServicesController::class, 'CreateAdditionalServiceAdminPage'])
            ->name('create-additional-service-page');

        Route::get('/edit/{additional_service_id}', [Controllers\AdditionalServices\AdditionalServicesController::class, 'EditAdditionalServiceAdminPage'])
            ->name('edit-additional-service-page');

        Route::post('/save', [Controllers\AdditionalServices\AdditionalServicesController::class, 'SaveAdditionalService'])
            ->name('save-additional-service-admin');

        Route::post('/delete', [Controllers\AdditionalServices\AdditionalServicesController::class, 'DeleteAdditionalServices'])
            ->name('delete-additional-service-admin');
    });

    Route::group(['prefix' => 'filters'], function () {

        Route::get('/', [Controllers\Filters\FiltersController::class, 'FiltersAdminPage'])
            ->name('filters-admin-page');

        Route::get('/create', [Controllers\Filters\FiltersController::class, 'CreateFiltersAdminPage'])
            ->name('create-filters-page');

        Route::get('/edit/{id}', [Controllers\Filters\FiltersController::class, 'EditFiltersAdminPage'])
            ->name('edit-filters-page');

        Route::post('/save', [Controllers\Filters\FiltersController::class, 'SaveFilters'])
            ->name('save-filters-admin');

        Route::post('/delete', [Controllers\Filters\FiltersController::class, 'DeleteFilters'])
            ->name('delete-filters-admin');
    });

    Route::group(['prefix' => 'gallery'], function () {

        Route::get('/', [Controllers\Gallery\GalleryController::class, 'GalleryAdminPage'])
            ->name('gallery-admin-page');

        Route::get('/create', [Controllers\Gallery\GalleryController::class, 'CreateGalleryAdminPage'])
            ->name('create-gallery-page');

        Route::get('/edit/{id}', [Controllers\Gallery\GalleryController::class, 'EditGalleryAdminPage'])
            ->name('edit-gallery-page');

        Route::post('/save', [Controllers\Gallery\GalleryController::class, 'SaveGallery'])
            ->name('save-gallery-admin');

        Route::post('/delete', [Controllers\Gallery\GalleryController::class, 'DeleteGallery'])
            ->name('delete-gallery-admin');
    });

    Route::group(['prefix' => 'products'], function () {

        Route::get('/', [Controllers\Products\ProductsController::class, 'ProductsAdminPage'])
            ->name('products-admin-page');

//        Route::get('/create', [Controllers\Products\ProductsController::class, 'CreateProductAdminPage'])
//            ->name('create-product-admin-page');

        Route::get('/edit/{product_id}', [Controllers\Products\ProductsController::class, 'EditProductAdminPage'])
            ->name('edit-product-admin-page');

        Route::post('/save', [Controllers\Products\ProductsController::class, 'SaveProduct'])
            ->name('save-product-admin');

        Route::post('/delete', [Controllers\Products\ProductsController::class, 'DeleteProduct'])
            ->name('delete-product-admin');

        Route::get('/to-csv', function () {
            $csvContent = chr(239) . chr(187) . chr(191);
            $csvContent .= 'Категория;Название;Идентификатор;Описание;Характеристики;Цена;' . PHP_EOL;
            $products = \App\Models\Products::all();
            foreach ($products as $product) {
                $csvContent .= str_replace([";", "\r", "\n", "&nbsp"], ".", strip_tags($product->Category->title)) . ';';
                $csvContent .= str_replace([";", "\r", "\n", "&nbsp"], ".", strip_tags($product->title)) . ';';
                $csvContent .= str_replace([";", "\r", "\n", "&nbsp"], ".", strip_tags($product->id)) . ';';
                $csvContent .= str_replace([";", "\r", "\n", "&nbsp"], ".", strip_tags($product->description)) . ';';
                //$csvContent .= str_replace([";", "\r", "\n", "&nbsp"], ".", strip_tags($product->tech_properties)) . ';';
                $csvContent .= str_replace([";", "\r", "\n", "&nbsp"], ".", strip_tags($product->Prices()->first()->price)) . ';';
                $csvContent .= PHP_EOL;
            }

            return \response($csvContent)
                ->header('Content-Type', 'text/csv; charset=utf-8')
                ->header('Content-Disposition', 'attachment; filename="Файл.csv');
        })->name('products-to-csv');
    });

    Route::group(['prefix' => 'settings'], function () {

        Route::get('/', [Controllers\Administration\SettingsController::class, 'EditPhonePage'])
            ->name('edit-phone-page');

        Route::post('/', [Controllers\Administration\SettingsController::class, 'SavePhone'])
            ->name('save-phone');

        Route::group(['prefix' => 'carousel'], function () {

            Route::get('/all-carousel-images', [Controllers\Administration\SettingsController::class, 'AllCarouselImagesPage'])
                ->name('all-carousel-images-page');

            Route::get('/create-carousel-image', [Controllers\Administration\SettingsController::class, 'CreateCarouselImagePage'])
                ->name('create-carousel-image-page');

            Route::get('/edit-carousel-image/{carouselImageId}', [Controllers\Administration\SettingsController::class, 'EditCarouselImagePage'])
                ->name('edit-carousel-image-page');

            Route::post('/save-carousel-image', [Controllers\Administration\SettingsController::class, 'SaveCarouselImage'])
                ->name('save-carousel-image-page');

            Route::post('/delete-carousel-image', [Controllers\Administration\SettingsController::class, 'DeleteCarouselImage'])
                ->name('delete-carousel-image-page');

        });

        Route::group(['prefix' => 'texts'], function () {

            Route::get('/', [Controllers\Administration\SettingsController::class, 'AllTextsPage'])
                ->name('texts');

            Route::post('/save-calculator-text', [Controllers\Administration\SettingsController::class, 'SaveCalculatorInfo'])
                ->name('save-calculator-text');

            Route::post('/save-online-order-text', [Controllers\Administration\SettingsController::class, 'SaveOnlineOrderInfo'])
                ->name('save-online-order-text');

            Route::post('/save-fast-order-text', [Controllers\Administration\SettingsController::class, 'SaveFastOrderInfo'])
                ->name('save-fast-order-text');

            Route::post('/save-about-text', [Controllers\Administration\SettingsController::class, 'SaveAboutInfo'])
                ->name('save-about-text');

            Route::post('/save-footer-text', [Controllers\Administration\SettingsController::class, 'SaveFooterInfo'])
                ->name('save-footer-text');

            Route::post('/save-header-logo', [Controllers\Administration\SettingsController::class, 'SaveHeaderLogo'])
                ->name('save-header-logo');

            Route::post('/save-body-image', [Controllers\Administration\SettingsController::class, 'SaveBodyImage'])
                ->name('save-body-image');

            Route::post('/firstBlockOnMainPage', [Controllers\Administration\SettingsController::class, 'firstBlockOnMainPage'])
                ->name('firstBlockOnMainPage');

            Route::post('/save-fast-menu', [Controllers\Administration\SettingsController::class, 'SaveFastMenu'])
                ->name('save-fast-menu');

        });

    });

    Route::group(['prefix' => 'users'], function () {

        Route::get('/', [Controllers\Administration\SettingsController::class, 'AllUsersPage'])
            ->name('all-users-page');

        Route::post('/change-role', [Controllers\Administration\SettingsController::class, 'ChangeRole'])
            ->name('change-role');

    });

});

Route::group(['prefix' => 'management'], function () {

    Route::get('/', [Controllers\Management\ManagementController::class, 'ManagementHomePage'])
        ->name('management-home-page');

    Route::post('/login', [Controllers\Management\ManagementController::class, 'ManagementLogin'])
        ->name('management-login');

    Route::get('/logout', [Controllers\Management\ManagementController::class, 'ManagementLogout'])
        ->name('management-logout');

    Route::group(['prefix' => 'orders'], function () {

        Route::get('/', [Controllers\Orders\OrdersController::class, 'OrdersManagementPage'])
            ->name('orders-management-page');

        Route::post('/get-orders-by-phone', [Controllers\Orders\OrdersController::class, 'GetOrdersByPhone'])
            ->name('get-orders-by-phone');

        Route::post('/get-orders-by-string', [Controllers\Orders\OrdersController::class, 'GetOrdersByString'])
            ->name('get-orders-by-string');

        Route::get('/detail-order/{order_id}', [Controllers\Orders\OrdersController::class, 'DetailOrdersManagementPage'])
            ->name('detail-order-management-page');

        Route::post('/change-order-properties-management/{order_id}', [Controllers\Orders\OrdersController::class, 'ChangeOrderProperties'])
            ->name('change-order-properties-management');

        Route::post('/change-count-product-in-order-management/{order_id}', [Controllers\Orders\OrdersController::class, 'ChangeCountProductInOrder'])
            ->name('change-count-product-in-order-management');

        Route::post('/new-order-file', [Controllers\Orders\OrdersController::class, 'NewOrderFile'])
            ->name('new-order-file');

        Route::post('/delete-order-file', [Controllers\Orders\OrdersController::class, 'DeleteOrderFile'])
            ->name('delete-order-file');

    });

    Route::group(['prefix' => 'callback-orders'], function () {

        Route::get('/all', [Controllers\CallbackOrders\CallbackOrdersController::class, 'AllCallbackOrders'])
            ->name('all-callback-orders');

    });

    Route::group(['prefix' => 'online-payments'], function () {

        Route::get('/create-payment-link', function () {
            return view('management.onlinePayments.create');
        })->name('create-payment-link');

    });

});

Route::group(['prefix' => 'files'], function () {

    Route::get('/{file_id}', [\App\Helpers\Files::class, 'GetFileHTTP'])
        ->name('files');

});

Route::group(['prefix' => 'catalog'], function () {

    Route::post('/add-favourite', [App\Http\Controllers\Products\ProductsController::class, 'addFavourite'])
        ->name('add-favourite');

    Route::post('/remove-favourite', [App\Http\Controllers\Products\ProductsController::class, 'removeFavourite'])
        ->name('remove-favourite');

    Route::get('/', [App\Http\Controllers\Categories\CategoriesController::class, 'CatalogPage'])
        ->name('catalog');

    Route::get('/{category_semantic_url}', [App\Http\Controllers\Categories\CategoriesController::class, 'CategoryPage'])
        ->name('category');

    Route::get('/{category_semantic_url}/{product_semantic_url}', [App\Http\Controllers\Products\ProductsController::class, 'ProductPage'])
        ->name('product');

});

Route::group(['prefix' => 'gallery'], function () {

    Route::get('/', [Controllers\Gallery\GalleryController::class, 'IndexGallery'])
        ->name('gallery');

    Route::get('/{id}', [Controllers\Gallery\GalleryController::class, 'ItemGallery'])
        ->name('gallery-item');

});

Route::group(['prefix' => 'basket'], function () {

    Route::get('/', [Controllers\Basket\BasketController::class, 'BasketPage'])
        ->name('basket-page');

    Route::post('/update-count-products', [Controllers\Basket\BasketController::class, 'UpdateCountProducts'])
        ->name('update-count-products');

});

Route::group(['prefix' => 'orders'], function () {

    Route::post('/', [Controllers\Orders\OrdersController::class, 'CreateOrder'])
        ->name('create-order');

});

Route::group(['prefix' => 'calculator'], function () {

    Route::get('/', [Controllers\Calculator\CalculatorController::class, 'Index'])
        ->name('calculator-page');

    Route::post('/category-properties', [Controllers\Calculator\CalculatorController::class, 'CategoryProperties'])
        ->name('category-properties');

    Route::post('/product-modification', [Controllers\Calculator\CalculatorController::class, 'ProductModification'])
        ->name('product-modification');

});

Route::group(['prefix' => 'fast-order'], function () {

    Route::get('/', [Controllers\Calculator\CalculatorController::class, 'IndexForFastOrder'])
        ->name('fast-order-page');

});

Route::group(['prefix' => 'search'], function () {

    Route::post('/', [Controllers\Search\SearchController::class, 'Index'])
        ->name('suggestion-categories-and-products');

});

Route::group(['prefix' => 'callback-orders'], function () {

    Route::post('/create', [Controllers\CallbackOrders\CallbackOrdersController::class, 'CreateCallbackOrderRequest'])
        ->name('create-callback-order');

});

Route::group(['prefix' => 'online-payment'], function () {


    Route::get('/get-payment-link', function () {

        // toDo https://snipp.ru/php/tinkoff-pay

        // toDo https://www.tinkoff.ru/kassa/develop/api/payments/init-description/

        try {
            // Индификатор терминала.
            $terminalKey = env('TINKOFF_TERMINAL_KEY');

            // Сумма в рублях.
            $sum = request()->get('sum') ?? 1;

            // Номер заказа.
            $orderId = request()->get('orderId') ?? time();

            $data = [
                "TerminalKey" => $terminalKey,
                "Amount" => $sum * 100,
                "OrderId" => $orderId,
                "SuccessURL" => \route("online-payment.success"),
                "PayType" => 'O',
                "Receipt" => [
                    "Email" => "not@not.not",
                    "Taxation" => "usn_income_outcome",
                    "Items" => [
                        [
                            "Name" => "Предоплата в размере 100%",
                            "Quantity" => 1,
                            "Amount" => $sum * 100,
                            "Price" => $sum * 100,
                            "PaymentMethod " => "full_prepayment ",
                            "Tax" => "none",
                        ]
                    ]
                ]
            ];

            $ch = curl_init('https://securepay.tinkoff.ru/v2/Init');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $res = curl_exec($ch);
            curl_close($ch);

            $res = json_decode($res);

            $paymentLink = $res->PaymentURL;

            return compact('orderId', 'paymentLink');
        } catch (Exception $e) {
            return abort(404);
        }
    })->name('online-payment.get-payment-link');

    Route::get('/success', function () {
        $text = 'Платеж успешно проведен.<br />С вами скоро свяжутся.';
        $redirectRoute = \route('home-page');
        return view('layout.text-and-redirect', compact('redirectRoute', 'text'));
    })->name('online-payment.success');

});

//Route::get('/debug-phpinfo', function () {
//    phpinfo();
//});

Route::get('sitemap.xml', [Controllers\HomeController::class, 'SiteMap'])->name('sitemap');


//Route::group(['prefix' => 'new-design'], function () {
//
//    Route::get('/', function () {
//        return view("new-design.index");
//    })->name("new-design.index");
//
//    Route::get('/catalog', function () {
//        return view("new-design.catalog");
//    })->name("new-design.catalog");
//
//    Route::get('/product', function () {
//        return view("new-design.product");
//    })->name("new-design.product");
//
//    Route::get('/fast-order', function () {
//        return view("new-design.fast-order");
//    })->name("new-design.fast-order");
//
//    Route::get('/basket', function () {
//        return view("new-design.basket");
//    })->name("new-design.basket");
//
//    Route::get('/text', function () {
//        return view("new-design.text");
//    })->name("new-design.text");
//
//});

//Route::get('/test', function () {
//
//    header('Content-Type:application/json');
//    $url = "https://www.consultant.ru/law/ref/calendar/proizvodstvennye/2023/";
//
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//
//    $res = curl_exec($ch);
//
//    curl_close($ch);
//
//    $dom = new DomDocument();
//    @ $dom->loadHTML($res);
//
//    $table = $dom->getElementsByTagName('h1'); //DOMElement
//    foreach( $table as $h2 ) {
//        echo $h2->textContent . "\n";
//    }
//    return;
////    $child_elements = $table->getElementsByTagName('tr'); //DOMNodeList
////    $row_count = $child_elements->length - 1;
//
//    echo "No. of rows in the table is " . $row_count;
//
//
//
//
//
//    $httpClient = new \GuzzleHttp\Client();
//    $response = $httpClient->get("https://www.consultant.ru/law/ref/calendar/proizvodstvennye/2023/");
//    $htmlString = (string)$response->getBody();
////add this line to suppress any warnings
//    libxml_use_internal_errors(true);;
//    $doc = new DOMDocument();
//    $doc->loadHTML($htmlString);
//    $xpath = new DOMXPath($doc);
//
////    $titles = $xpath->evaluate('//ol[@class="row"]//li//article//h3/a');
//    $titles = $xpath->query('//*[@id="content"]/div[5]/div[1]/div[2]/table/tbody');
//    $extractedTitles = [];
//    foreach ($titles as $title) {
//        dd($title, $xpath->query('/td'), $title);
//        foreach ($title->childNodes as $children) {
//            dd($children);
//        }
//        $extractedTitles[] = $title->textContent . PHP_EOL;
//        echo $title->textContent . PHP_EOL;
//    }
//
//    dd($extractedTitles);
//
//});


//Route::group(['prefix' => 'test'], function () {
//
//    Route::get('/', [Controllers\TestController::class, 'index'])
//        ->name('test');
//
//    Route::get('/mail', function () {
//        \Illuminate\Support\Facades\Mail::to('s-vesel94@ya.ru')->send(new MailSender(User::PasswordGenerate()));
//    });
//
//    Route::get('/mail-view', function () {
//        return view('mail.view', ['email' => 's-vesel94@ya.ru', 'password' => '123']);
//    });
//
//});
