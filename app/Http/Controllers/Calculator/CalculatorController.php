<?php


namespace App\Http\Controllers\Calculator;


use App\Helpers\ArrayHelper;
use App\Helpers\ResultGenerate;
use App\Helpers\StringHelper;
use App\Models\AdditionalServices\AdditionalProductServices;
use App\Models\AdditionalServices\AdditionalServices;
use App\Models\Categories;
use App\Models\Products;
use App\Models\ProductsPrices;
use Illuminate\Http\Request;

class CalculatorController
{
    public function Index()
    {
        $allCategories = Categories::orderBy('sequence')->get();
        return view('calculator.index', [
            'allCategories' => $allCategories,
        ]);
    }
    public function IndexForFastOrder()
    {
        $allCategories = Categories::orderBy('sequence')->get();
        return view('new-design.fast-order', [
            'allCategories' => $allCategories,
            'fastOrder' => true,
        ]);
        return view('calculator.index', [
            'allCategories' => $allCategories,
            'fastOrder' => true,
        ]);
    }

    public function CategoryProperties(Request $request)
    {
        $categoryId = $request->categoryId;
        $category = Categories::find($categoryId);
        $categoryProperties = $category->Properties->sortBy('sequence');
        $categoryPropertiesWithValues = [];
        foreach ($categoryProperties as $categoryProperty) {

            $propertyValues = [
                0 => (object)[
                    'value' => 'Выберите значение'
                ]
            ];

            foreach ($categoryProperty
                         ->Values()
                         ->select(['id', 'is_default_value', 'properties_categories_id', 'value'])
                         ->toBase()
                         ->get() as $categoryPropertyValue) {
                $categoryPropertyValue->is_default_value = $categoryProperty->is_professional && $categoryPropertyValue->is_default_value ? 1 : 0;
                $propertyValues[$categoryPropertyValue->id] = $categoryPropertyValue;
            }
            ksort($propertyValues);

            $categoryPropertiesWithValues[] = (object)[
                'propertyId' => $categoryProperty->id,
                'propertyTitle' => $categoryProperty->title,
                'propertyIsProfessional' => $categoryProperty->is_professional,
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
        sort($modification);
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

        $productImagesUrls = [];
        foreach (unserialize($product->img) as $img) {
            $productImagesUrls[] = route('files', $img);
        }

        return ResultGenerate::Success('', [
            'product' => $product->getAttributes(),
            'productImgUrl' => route('files', unserialize($product->img)[0]),
            'productImagesUrls' => $productImagesUrls,
            'productLink' => $product->Link(),
            'additionalProductServices' => (isset($request->productEdit) && $request->productEdit === "true") ? $product->AdditionalServicesPrice : null,
        ]);
    }
}
