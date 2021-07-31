<?php


namespace App\Http\Controllers\Basket;


use App\Helpers\ResultGenerate;
use App\Models\Products;
use Illuminate\Http\Request;

class BasketController
{

    public function BasketPage(Request $request)
    {
        $productsInBasket = json_decode(session('productsInBasket'));
        $idProductsInBasket = array_keys((array)$productsInBasket);
        $allProductsInBasket = Products::whereIn('id', $idProductsInBasket)->get();

        return view('basket.index', [
            'allProductsInBasket' => $allProductsInBasket,
            'productsInBasket' => (array)$productsInBasket,
        ]);
    }

    public function UpdateCountProducts(Request $request)
    {
        session(['productsInBasket' => $request->products_in_basket]);
        return ResultGenerate::Success();
    }

}
