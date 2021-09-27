<?php


namespace App\Http\Controllers\Basket;


use App\Helpers\ArrayHelper;
use App\Helpers\ResultGenerate;
use App\Models\Products;
use App\Models\ProductsPrices;
use Illuminate\Http\Request;

class BasketController
{

    public function BasketPage(Request $request)
    {
        $productsInBasket = json_decode(session('productsInBasket'));
        $productsInBasket = ArrayHelper::ObjectToArray($productsInBasket);

        $allProductsInBasket = [];
        if (!empty($productsInBasket)) {
            $idProductsInBasket = [];
            $idProductPricesInBasket = [];
            foreach ($productsInBasket as $productId => $productPrices) {
                foreach ($productPrices as $productPriceId => $productPrice) {
                    $idProductPricesInBasket[] = preg_replace("/[^0-9]/", '', $productPriceId);
                }
                $idProductsInBasket[] = preg_replace("/[^0-9]/", '', $productId);
            }

            $allProductsInBasket = ProductsPrices::query()
                ->select('*', 'products_prices.id as price_id')
                ->whereIn('products_prices.id', $idProductPricesInBasket)
                ->leftJoin('products', 'products_prices.product_id', '=', 'products.id')
                ->get();
        }

        return view('basket.index', [
            'allProductsInBasket' => $allProductsInBasket,
            'productsInBasket' => $productsInBasket,
        ]);
    }

    public function UpdateCountProducts(Request $request)
    {
        session(['productsInBasket' => $request->products_in_basket]);
        return ResultGenerate::Success();
    }

}
