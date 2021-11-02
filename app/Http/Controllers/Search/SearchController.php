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
    public function Index(Request $request)
    {
        $context = $request->context;
        $categories = $this->Categories($context);
        $products = $this->Products($context);

        $searchResult = (object)[
            'suggestions' => array_merge($categories, $products)
        ];

        return \App\Helpers\ResultGenerate::Success('', $searchResult);
    }

    public function Products($context)
    {
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

        return $allProducts;
    }

    public function Categories($context)
    {
        if (empty($context)) {
            return ResultGenerate::Error();
        }

        $categories = Categories::query()->where('title', 'like', '%' . $context . '%')->get();

        $allCategories = [];
        foreach ($categories as $category) {
            $category->value = $category->title;
            $category->link = $category->Link();
            $allCategories[] = $category->getAttributes();
        }

        return $allCategories;
    }
}
