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
        if (empty($request->allFiles()) && !isset($request->product_id)) {
            return ResultGenerate::Error('Ошибка! Загрузите картинку!');
        }

        if (strlen($request->product_name) === 0) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
        }

        if (strlen($request->product_parent) === 0) {
            return ResultGenerate::Error('Ошибка! Выберите подкатегорию!');
        }

        if (Products::where('semantic_url', StringHelper::TransliterateURL($request->product_name))->first()) {
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

        $productFind = Products::find($request->product_id);

        if (isset($request->product_id)) {
            $productFind = Products::find($request->product_id);
            if ($productFind) {
                $fields['title'] = $request->product_name;
                $fields['subcategory_id'] = $request->product_parent;
                $fields['img'] = $request->allFiles() ? $serializeImgArray : $productFind->img;
                $fields['semantic_url'] = StringHelper::TransliterateURL($request->product_name);
                $productUpdate = $productFind->update($fields);
                if ($productUpdate) {
                    return ResultGenerate::Success('Продукт обновлен успешно!');
                }

                return ResultGenerate::Error('Ошибка обновления продукта!');
            }

        } else {
            $fields['title'] = $request->product_name;
            $fields['subcategory_id'] = $request->product_parent;
            $fields['img'] = $serializeImgArray;
            $fields['semantic_url'] = StringHelper::TransliterateURL($request->product_name);
            $product = Products::create($fields);
            if ($product) {
                return ResultGenerate::Success('Продукт создан успешно!');
            }
            return ResultGenerate::Error('Ошибка создания продукта!');
        }

        return ResultGenerate::Error('Не предвиденная ошибка. Попробуйте позже или обратитесь в поддержку!');

    }

    public function ProductPage(Request $request)
    {
        $product = Products::where('semantic_url', $request->product_semantic_url)->firstOrFail();
        return view('catalog.product', [
            'product' => $product,
        ]);
        dd($request->all(), $request->category_semantic_url, $request->product_semantic_url);
    }
}
