<?php


namespace App\Http\Controllers\Products;


use App\Helpers\ArrayHelper;
use App\Helpers\Files;
use App\Helpers\ResultGenerate;
use App\Helpers\StringHelper;
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
        $product = Categories::findOrFail($request->product_id);

        $relationsCategoryAndPropertiesCategories = RelationsCategoriesAndPropertiesCategories::where('category_id', $product->id)->get('properties_categories_id');
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
                $tmpStr[] = $propertyCategories->title . ': ' .$propertyCategoriesValue->value;
                $tmpId[] = $propertyCategoriesValue->id;
            }
            $combinations[] = $tmpStr;
            $combinationsId[] = $tmpId;
        }

        $combinations = ArrayHelper::Combinations($combinations);
        $combinationsId = ArrayHelper::Combinations($combinationsId);

        $completeCombinations = [];
        $completeCombinationsOnlyId = [];
        foreach ($combinations as $k => $combination) {
            $str = '';
            $strId = '';
            foreach ($combination as $j => $value) {
                $endChar = array_key_last($combination) === $j;
                $str .= $value . ($endChar ? '' : ' ');
                $strId .= $combinationsId[$k][$j] . ($endChar ? '' : '-');
            }

            $productModification = Products::where('modification_id', $strId)->first();

            $completeCombinations[] = (object)[
                'id' => $strId,
                'title' => $str,
                'productModification' => $productModification,
            ];
            $completeCombinationsOnlyId[] = $strId;
        }

        return view('administration.products.edit', [
            'product' => $product,
            'completeCombinations' => $completeCombinations
        ]);
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
        $productCount = !empty($request->count) ? $request->count : null;
        $productPrices = !empty($request->price) ? $request->price : null;
        $productDescription = !empty($request->product_description) ? $request->product_description : null;
        $productSearchWords = !empty($request->search_words) ? $request->search_words : null;
        $productFiles = !empty($request->allFiles()) ? $request->allFiles() : [];

        $product = Products::where('category_id', $categoryId)
            ->where('modification_id', $productCombination)
            ->first();
        $productID = !empty($product->id) ? $product->id : null;

        if (!$productFiles && !$product) {
            return ResultGenerate::Error('Ошибка! Загрузите картинку!');
        }

        if (!$productName) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
        }

//        if (!$productParent) {
//            return ResultGenerate::Error('Ошибка! Выберите подкатегорию!');
//        }

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

        $uniqSemanticURL = Products::where('semantic_url', $semanticURL);
        if ($productID) {
            $uniqSemanticURL->where('id', '!=', $productID);
        }
        $uniqSemanticURL = $uniqSemanticURL->first();

        if ($uniqSemanticURL) {
            return ResultGenerate::Error('Ошибка! Название должно быть уникальным!');
        }

        $saveFiles = [];
        foreach ($productFiles as $productFile) {
            if (in_array($productFile->getMimeType(), ['image/jpeg', 'image/png', 'image/bmp', 'image/gif'])) {
                $saveFile = Files::SaveFile($productFile, $this->storagePath, $this->storageDriver);
                $saveFiles[] = $saveFile->id;
            } else {
                return ResultGenerate::Error('Ошибка! Не верный формат файла!');
            }
        }

        $serializeImgArray = serialize($saveFiles);

        $fields['title'] = $productName;
        $fields['category_id'] = $categoryId;
        $fields['modification_id'] = $productCombination;
        $fields['description'] = $productDescription;
        $fields['search_words'] = $productSearchWords;
        $fields['semantic_url'] = $semanticURL;
        $fields['active'] = $productActive === 'true' ? 1 : 0;

        if ($productID) {
            $productFind = Products::find($productID);
            if ($productFind) {
                $fields['img'] = $request->allFiles() ? $serializeImgArray : $productFind->img;
                if ($request->allFiles()) {
                    Files::DeleteFiles(unserialize($productFind->img));
                }
                $productUpdate = $productFind->update($fields);
                if ($productUpdate) {
                    ProductsPrices::where('product_id', $productID)->delete();
                    foreach ($productPrices as $key => $price) {
                        $fieldsPrices['product_id'] = $productID;
                        $fieldsPrices['price'] = $price;
                        $fieldsPrices['count'] = $productCount[$key];
                        ProductsPrices::create($fieldsPrices);
                    }
                    return ResultGenerate::Success('Продукт обновлен успешно!');
                }
                return ResultGenerate::Error('Ошибка обновления продукта!');
            }

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

                return ResultGenerate::Success('Продукт создан успешно!');
            }
            return ResultGenerate::Error('Ошибка создания продукта!');
        }

        return ResultGenerate::Error('Непредвиденная ошибка. Попробуйте позже или обратитесь в поддержку!');

    }

    public function DeleteProduct(Request $request)
    {
        $categoryId = !empty($request->category_id) ? $request->category_id : null;
        $productCombination = !empty($request->product_combination) ? $request->product_combination : null;

        $product = Products::where('category_id', $categoryId)
            ->where('modification_id', $productCombination)
            ->first();
        $productID = !empty($product->id) ? $product->id : null;

        if ($productID) {
            foreach ($product->Prices as $price) {
                $price->delete();
            }
            if ($product->delete()) {
                return ResultGenerate::Success('Продукт успешно удален!');
            }
        }
        return ResultGenerate::Error('Ошибка удаления продукта! Возможно его уже нет');
    }

    public function ProductPage(Request $request)
    {
        $product = Products::where('semantic_url', $request->product_semantic_url)->firstOrFail();
        return view('catalog.product', [
            'product' => $product,
        ]);
    }
}
