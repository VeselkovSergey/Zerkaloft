<?php


namespace App\Http\Controllers\Calculator;


use App\Helpers\ArrayHelper;
use App\Helpers\ResultGenerate;
use App\Helpers\StringHelper;
use App\Models\Categories;
use App\Models\Products;
use App\Models\ProductsPrices;
use Illuminate\Http\Request;

class CalculatorController
{
    public function Index()
    {
        $allCategories = Categories::all();
        return view('calculator.index', [
            'allCategories' => $allCategories,
        ]);
    }

    public function CategoryProperties(Request $request)
    {
        $categoryId = $request->categoryId;
        $category = Categories::find($categoryId);
        $categoryProperties = $category->Properties;
        $categoryPropertiesWithValues = [];
        foreach ($categoryProperties as $categoryProperty) {
            $propertyValues = $categoryProperty->Values->pluck('value', 'id')->prepend('Выберите значение', 0)->toArray();
            ksort($propertyValues);

            $categoryPropertiesWithValues[] = (object)[
                'propertyId' => $categoryProperty->id,
                'propertyTitle' => $categoryProperty->title,
                'propertyTitleTransliterate' => StringHelper::TransliterateURL($categoryProperty->title),
                'propertyValues' => $propertyValues,
            ];
        }

        return ResultGenerate::Success('', $categoryPropertiesWithValues);
    }

    public function ProductModification(Request $request)
    {
        $categoryId = $request->categoryId;
        $modification = $request->modification;
        $modificationProcessed = implode('-', $modification);
        $product = Products::where('category_id', $categoryId)->where('modification_id', $modificationProcessed)->first();
        if (empty($product)) {
            return ResultGenerate::Error('Продукт не найден');
        }
        $tempProductPrice = [];
        foreach ($product->Prices as $productPrice) {
            $tempProductPrice[$productPrice->id] = $productPrice->toArray();
        }
        $product->prices = $tempProductPrice;
        return ResultGenerate::Success('', [
            'product' => $product->getAttributes(),
            'productImgUrl' => route('files', unserialize($product->img)[0])
        ]);
    }
}
