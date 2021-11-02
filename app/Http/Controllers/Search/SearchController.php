<?php


namespace App\Http\Controllers\Search;


use App\Helpers\ArrayHelper;
use App\Helpers\ResultGenerate;
use App\Helpers\StringHelper;
use App\Models\Categories;
use App\Models\Products;
use App\Models\ProductsPrices;
use Illuminate\Http\Request;

class SearchController
{
    public function Products(Request $request)
    {
        $context = $request->context;
        if (empty($context)) {
            return ResultGenerate::Error();
        }

        $products = Products::query()->where('search_words', 'like', '%' . $context . '%')->get();

        $allProducts = [];
        foreach ($products as $product) {
            $tempProductPrice = [];
            foreach ($product->Prices as $productPrice) {
                $tempProductPrice[$productPrice->id] = $productPrice->toArray();
            }
            $product->prices = $tempProductPrice;
            $product->value = $product->title;
            $product->link = $product->Link();
            $allProducts[] = $product->getAttributes();
        }


        $searchResult = (object)[
            'suggestions' => $allProducts,
        ];

        return \App\Helpers\ResultGenerate::Success('', $searchResult);
    }
}
