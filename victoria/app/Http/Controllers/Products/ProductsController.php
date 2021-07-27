<?php


namespace App\Http\Controllers\Products;


use App\Helpers\Files;
use App\Helpers\ResultGenerate;
use App\Helpers\StringHelper;
use App\Models\Products;
use App\Models\Subcategories;
use Illuminate\Http\Request;

class ProductsController
{
    public string $storagePath = 'img/product';
    public string $storageDriver = 'local';

    public function ProductsAdminPage()
    {
        $allProducts = Products::all();
        return view('administration.products.index', [
            'allProducts' => $allProducts
        ]);
    }

    public function CreateProductAdminPage()
    {
        $allSubcategories = Subcategories::all();
        return view('administration.products.create', [
            'allSubcategories' => $allSubcategories
        ]);
    }

    public function EditProductAdminPage(Request $request)
    {
        $product = Products::findOrFail($request->product_id);
        $subcategory = $product->Subcategory;
        $allSubcategories = Subcategories::all();
        return view('administration.products.edit', [
            'product' => $product,
            'subcategory' => $subcategory,
            'allSubcategories' => $allSubcategories
        ]);
    }

    public function SaveProduct(Request $request)
    {
        $productID = !empty($request->category_id) ? $request->product_id : null;
        $productName = !empty($request->category_name) ? $request->product_name : null;
        $productParent = !empty($request->product_name) ? $request->product_parent : null;
        $productFiles = !empty($request->allFiles()) ? $request->allFiles() : [];

        if (!$productFiles && !$productID) {
            return ResultGenerate::Error('Ошибка! Загрузите картинку!');
        }

        if (!$productName) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
        }

        if (!$productParent) {
            return ResultGenerate::Error('Ошибка! Выберите подкатегорию!');
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
        foreach ($request->allFiles() as $file) {
            if (in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/bmp'])) {
                $saveFile = Files::SaveFile($file, $this->storagePath, $this->storageDriver);
                $saveFiles[] = $saveFile->id;
            } else {
                return ResultGenerate::Error('Ошибка! Не верный формат файла!');
            }
        }

        $serializeImgArray = serialize($saveFiles);

        $fields['title'] = $productName;
        $fields['subcategory_id'] = $productParent;
        $fields['semantic_url'] = $semanticURL;

        if ($productID) {
            $productFind = Products::find($productID);
            if ($productFind) {
                $fields['img'] = $request->allFiles() ? $serializeImgArray : $productFind->img;
                $productUpdate = $productFind->update($fields);
                if ($productUpdate) {
                    return ResultGenerate::Success('Продукт обновлен успешно!');
                }
                return ResultGenerate::Error('Ошибка обновления продукта!');
            }

        } else {
            $fields['img'] = $serializeImgArray;
            $productCreated = Products::create($fields);
            if ($productCreated) {
                return ResultGenerate::Success('Продукт создан успешно!');
            }
            return ResultGenerate::Error('Ошибка создания продукта!');
        }

        return ResultGenerate::Error('Непредвиденная ошибка. Попробуйте позже или обратитесь в поддержку!');

    }

    public function ProductPage(Request $request)
    {
        $product = Products::where('semantic_url', $request->product_semantic_url)->firstOrFail();
        return view('catalog.product', [
            'product' => $product,
        ]);
    }
}
