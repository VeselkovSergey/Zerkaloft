<?php


namespace App\Http\Controllers\Products;


use App\Helpers\ArrayHelper;
use App\Helpers\Files;
use App\Helpers\ResultGenerate;
use App\Helpers\StringHelper;
use App\Models\AdditionalServices\AdditionalProductServices;
use App\Models\AdditionalServices\AdditionalServices;
use App\Models\Categories;
use App\Models\Products;
use App\Models\ProductsPrices;
use App\Models\PropertiesCategories\PropertiesCategories;
use App\Models\Relations\RelationsCategoriesAndPropertiesCategories;
use Illuminate\Http\Request;

class ProductsController
{
    public string $storagePath = 'img/product';
    public string $storageDriver = 'local';

    public function ProductsAdminPage()
    {
        $allProducts = Categories::all();
        return view('administration.products.index', [
            'allProducts' => $allProducts
        ]);
    }

//    public function CreateProductAdminPage(Request $request)
//    {
//        $categoryId = $request->categoryId;
//        $relationsCategoryAndPropertiesCategories = RelationsCategoriesAndPropertiesCategories::where('category_id', $categoryId)->get();
//
//        $allPropertiesCategories = PropertiesCategories::all();
//        $combinations = [];
//        $combinationsId = [];
//        foreach ($allPropertiesCategories as $propertyCategories) {
//            $tmpStr = [];
//            $tmpId = [];
//            foreach ($propertyCategories->Values as $propertyCategoriesValue) {
//                $tmpStr[] = $propertyCategories->title . ': ' .$propertyCategoriesValue->value;
//                $tmpId[] = $propertyCategoriesValue->id;
//            }
//            $combinations[] = $tmpStr;
//            $combinationsId[] = $tmpId;
//        }
//
//        $combinations = ArrayHelper::Combinations($combinations);
//        $combinationsId = ArrayHelper::Combinations($combinationsId);
//
//        $completeCombinations = [];
//        foreach ($combinations as $k => $combination) {
//            $str = '';
//            $strId = '';
//            foreach ($combination as $j => $value) {
//                $endChar = array_key_last($combination) === $j;
//                $str .= $value . ($endChar ? '' : ' ');
//                $strId .= $combinationsId[$k][$j] . ($endChar ? '' : '-');
//            }
//            $completeCombinations[] = (object)[
//                'id' => $strId,
//                'title' => $str,
//            ];
//        }
//
//        return view('administration.products.create', [
//            'completeCombinations' => $completeCombinations,
//        ]);
//    }

    public function EditProductAdminPage(Request $request)
    {
        $category = Categories::findOrFail($request->product_id);
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

        $combination = self::ProductCombinations($category);
        $completeCombinations = $combination->completeCombinations;
        $allAdditionalServices = $combination->allAdditionalServices;

        return view('administration.products.edit', compact('category', 'categoryPropertiesWithValues', 'completeCombinations', 'allAdditionalServices'));
    }

    public static function ProductCombinations(Categories $category)
    {
        $relationsCategoryAndPropertiesCategories = RelationsCategoriesAndPropertiesCategories::where('category_id', $category->id)->get('properties_categories_id');
        $propertiesCategories = [];
        foreach ($relationsCategoryAndPropertiesCategories as $propertyCategories) {
            $propertiesCategories[] = $propertyCategories->properties_categories_id;
        }

        $allPropertiesCategories = PropertiesCategories::whereIn('id', $propertiesCategories)->get();
        $combinations = [];
        $combinationsId = [];
        foreach ($allPropertiesCategories as $propertyCategories) {
            $tmpStr = [];
            $tmpId = [];
            foreach ($propertyCategories->Values as $propertyCategoriesValue) {
                $tmpStr[] = $propertyCategories->title . ': ' . $propertyCategoriesValue->value;
                $tmpId[] = $propertyCategoriesValue->id;
            }
            $combinations[] = $tmpStr;
            $combinationsId[] = $tmpId;
        }

        $combinations = ArrayHelper::Combinations($combinations);
        $combinationsId = ArrayHelper::Combinations($combinationsId);

        $completeCombinations = [];
        foreach ($combinations as $k => $combination) {
            $str = '';
            $strId = '';
            foreach ($combination as $j => $value) {
                $endChar = array_key_last($combination) === $j;
                $str .= $value . ($endChar ? '' : ' ');
                $strId .= $combinationsId[$k][$j] . ($endChar ? '' : '-');
            }

            $completeCombinations[] = (object)[
                'id' => $strId,
                'title' => $str,
            ];
        }

        return (object)[
            'completeCombinations' => $completeCombinations,
            'allAdditionalServices' => AdditionalServices::all(),
        ];
    }

    public function SaveProduct(Request $request)
    {
//        dd($request->all());
//        $productID = !empty($request->product_id) ? $request->product_id : null;
        $productName = !empty($request->product_name) ? $request->product_name : null;
//        $productParent = !empty($request->product_parent) ? $request->product_parent : null;
        $categoryId = !empty($request->category_id) ? $request->category_id : null;
        $productCombination = !empty($request->product_combination) ? $request->product_combination : null;
        $productActive = !empty($request->active) ? $request->active : null;
        $productNotOnlyCalculator = !empty($request->not_only_calculator) ? $request->not_only_calculator : null;
        $productShowMainPage = !empty($request->show_main_page) ? $request->show_main_page : null;
        $productShowAddMore = !empty($request->show_add_more) ? $request->show_add_more : null;
        $productCount = !empty($request->count) ? $request->count : null;
        $productPrices = !empty($request->price) ? $request->price : null;
        $productDescription = !empty($request->product_description) ? $request->product_description : null;
        $productSearchWords = !empty($request->search_words) ? $request->search_words : null;
        $productFiles = !empty($request->allFiles()) ? $request->allFiles() : [];
        $productAdditionalServices = !empty($request->additional_service_id) ? $request->additional_service_id : null;
        $productAdditionalServicesActivation = !empty($request->additional_service_activation) ? $request->additional_service_activation : null;
        $productAdditionalServicesPrice = !empty($request->additional_service_price) ? $request->additional_service_price : null;
        $fieldsApply = !empty($request->fieldsApply) ? $request->fieldsApply : null;

        $arrCombinations = [];

        foreach ($productCombination as $combination => $boolText) {
            if ($boolText === 'true') {
                $arrCombinations[] = $combination;
            }
        }

        if (!sizeof($arrCombinations)) {
            return ResultGenerate::Error('Ошибка! Выберите хотя бы одну модификацию');
        }

//        $product = null;
//        $productID = null;
//        if (sizeof($arrCombinations) === 1) {
//            $product = Products::where('category_id', $categoryId)
//                ->where('modification_id', $arrCombinations[0])
//                ->first();
//            $productID = !empty($product->id) ? $product->id : null;
//        }
//
        if (!$productFiles && sizeof($arrCombinations) !== 1 && $fieldsApply['img'] === 'true') {
            return ResultGenerate::Error('Ошибка! Загрузите общую картинку!');
        }

        if (!$productName) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
        }

        if (!$productPrices[0] || !$productCount[0]) {
            return ResultGenerate::Error('Ошибка! Укажите стоимость!');
        }

        if (!$productDescription) {
            return ResultGenerate::Error('Ошибка! Укажите описание!');
        }

        if (!$productSearchWords) {
            return ResultGenerate::Error('Ошибка! Укажите слова для поиска!');
        }


        $semanticURL = StringHelper::TransliterateURL($productName);

        $saveFiles = [];
        foreach ($productFiles as $productFile) {
            if (in_array($productFile->getMimeType(), ['image/jpg', 'image/jpeg', 'image/webp', 'image/png', 'image/bmp', 'image/gif'])) {
                $saveFile = Files::SaveFile($productFile, $this->storagePath, $this->storageDriver);
                $saveFiles[] = $saveFile->id;
            } else {
                return ResultGenerate::Error('Ошибка! Не верный формат файла!');
            }
        }

        $serializeImgArray = serialize($saveFiles);

        if ($fieldsApply['product_name'] === 'true') {
            $fields['title'] = $productName;
        }

        if ($fieldsApply['product_description'] === 'true') {
            $fields['description'] = $productDescription;
        }

        if ($fieldsApply['search_words'] === 'true') {
            $fields['search_words'] = $productSearchWords;
        }

        if ($fieldsApply['active'] === 'true') {
            $fields['active'] = $productActive === 'true' ? 1 : 0;
        }

        if ($fieldsApply['not_only_calculator'] === 'true') {
            $fields['not_only_calculator'] = $productNotOnlyCalculator === 'true' ? 1 : 0;
        }

        if ($fieldsApply['show_main_page'] === 'true') {
            $fields['show_main_page'] = $productShowMainPage === 'true' ? 1 : 0;
        }

        if ($fieldsApply['show_add_more'] === 'true') {
            $fields['show_add_more'] = $productShowAddMore === 'true' ? 1 : 0;
        }

        $fields['category_id'] = $categoryId;

        foreach ($arrCombinations as $combination) {
            $fields['semantic_url'] = $semanticURL . '-' . $combination;
            $fields['modification_id'] = $combination;

            $productFind = Products::where('category_id', $categoryId)
                ->where('modification_id', $combination)
                ->first();

            if ($productFind) {
                if ($fieldsApply['img'] === 'true') {
                    $fields['img'] = $request->allFiles() ? $serializeImgArray : $productFind->img;
                }
//                if ($request->allFiles()) {
//                    Files::DeleteFiles(unserialize($productFind->img));
//                }
                $productUpdate = $productFind->update($fields);
                if ($productUpdate) {

                    if ($fieldsApply['prices'] === 'true') {
                        ProductsPrices::where('product_id', $productFind->id)->delete();
                        foreach ($productPrices as $key => $price) {
                            $fieldsPrices['product_id'] = $productFind->id;
                            $fieldsPrices['price'] = $price;
                            $fieldsPrices['count'] = $productCount[$key];
                            ProductsPrices::create($fieldsPrices);
                        }
                    }

                    if ($fieldsApply['additional_services'] === 'true') {
                        AdditionalProductServices::where('product_id', $productFind->id)->delete();
                        if ($productAdditionalServices) {
                            foreach ($productAdditionalServices as $key => $productAdditionalService) {
                                if ($productAdditionalServicesActivation[$key] === 'true') {
                                    $fieldsPrices['product_id'] = $productFind->id;
                                    $fieldsPrices['price'] = !empty($productAdditionalServicesPrice[$key]) ? $productAdditionalServicesPrice[$key] : 0;
                                    $fieldsPrices['additional_service_id'] = $productAdditionalService;
                                    AdditionalProductServices::create($fieldsPrices);
                                }
                            }
                        }
                    }

                    //return ResultGenerate::Success('Продукт обновлен успешно!');
                }
                //return ResultGenerate::Error('Ошибка обновления продукта!');

            } else {
                $fields['img'] = $serializeImgArray;
                $productCreated = Products::create($fields);
                if ($productCreated) {
                    $productID = $productCreated->id;
                    foreach ($productPrices as $key => $price) {
                        $fieldsPrices['product_id'] = $productID;
                        $fieldsPrices['price'] = $price;
                        $fieldsPrices['count'] = $productCount[$key];
                        ProductsPrices::create($fieldsPrices);
                    }

                    AdditionalProductServices::where('product_id', $productID)->delete();
                    if ($productAdditionalServices) {
                        foreach ($productAdditionalServices as $key => $productAdditionalService) {
                            if ($productAdditionalServicesActivation[$key] === 'true') {
                                $fieldsPrices['product_id'] = $productID;
                                $fieldsPrices['price'] = $productAdditionalServicesPrice[$key];
                                $fieldsPrices['additional_service_id'] = $productAdditionalService;
                                AdditionalProductServices::create($fieldsPrices);
                            }
                        }
                    }

                    //return ResultGenerate::Success('Продукт создан успешно!');
                }
                //return ResultGenerate::Error('Ошибка создания продукта!');
            }
        }

        return ResultGenerate::Success();

    }

    public function DeleteProduct(Request $request)
    {
        $categoryId = !empty($request->category_id) ? $request->category_id : null;
        $productCombinations = !empty($request->product_combination) ? $request->product_combination : [];

        $arrCombinations = [];

        foreach ($productCombinations as $combination => $boolText) {
            if ($boolText === 'true') {
                $arrCombinations[] = $combination;
            }
        }

        foreach ($arrCombinations as $combination) {

            $product = Products::where('category_id', $categoryId)
                ->where('modification_id', $combination)
                ->first();

            if ($product) {
                foreach ($product->Prices as $price) {
                    $price->delete();
                }

                foreach ($product->AdditionalServicesPrice as $additionalServicesPrice) {
                    $additionalServicesPrice->delete();
                }

                if ($product->delete()) {

                }
            }
        }
        return ResultGenerate::Success();
    }

    public function ProductPage(Request $request)
    {
        $product = Products::query()->where('semantic_url', $request->product_semantic_url)
            ->with('Category', function ($q) {
                return $q->with('Properties', function ($q) {
                    return $q->with('Values');
                });
            })
            ->firstOrFail();

        return view('catalog.product', compact('product'));
    }
}
