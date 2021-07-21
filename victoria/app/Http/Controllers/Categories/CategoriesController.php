<?php


namespace App\Http\Controllers\Categories;


use App\Helpers\Files;
use App\Helpers\ResultGenerate;
use App\Helpers\StringHelper;
use App\Models\Categories;
use App\Models\Subcategories;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class CategoriesController
{

    public string $storagePath = 'img/category';
    public string $storageDriver = 'local';

    public function CategoriesAdminPage()
    {
        $allCategories = Categories::all();
        return view('administration.categories.index', [
            'allCategories' => $allCategories
        ]);
    }

    public function CreateCategoryAdminPage()
    {
        return view('administration.categories.create');
    }

    public function EditCategoryAdminPage(Request $request)
    {
        $category = Categories::findOrFail($request->category_id);
        return view('administration.categories.edit', [
            'category' => $category
        ]);
    }

    public function SaveCategory(Request $request)
    {
        if (empty($request->allFiles()) && !isset($request->category_id)) {
            return ResultGenerate::Error('Ошибка! Загрузите картинку!');
        }

        if (strlen($request->category_name) === 0) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
        }

        if (Categories::where('semantic_url', StringHelper::TransliterateURL($request->category_name))->first()) {
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

        if (isset($request->category_id)) {
            $categoryFind = Categories::find($request->category_id);
            if ($categoryFind) {
                $fields['title'] = $request->category_name;
                $fields['img'] = $request->allFiles() ? $serializeImgArray : $categoryFind->img;
                $fields['semantic_url'] = StringHelper::TransliterateURL($request->category_name);
                $categoryUpdate = $categoryFind->update($fields);
                if ($categoryUpdate) {
                    return ResultGenerate::Success('Категория обновлена успешно!');
                }

                return ResultGenerate::Error('Ошибка обновления категории!');
            }

        } else {
            $fields['title'] = $request->category_name;
            $fields['img'] = $serializeImgArray;
            $fields['semantic_url'] = StringHelper::TransliterateURL($request->category_name);
            $category = Categories::create($fields);
            if ($category) {
                return ResultGenerate::Success('Категория создана успешно!');
            }
            return ResultGenerate::Error('Ошибка создания категории!');
        }

        return ResultGenerate::Error('Не предвиденная ошибка. Попробуйте позже или обратитесь в поддержку!');

    }

    public function DeleteCategory(Request $request)
    {
        $deleteCategory = Categories::find($request->category_id);
        if ($deleteCategory->Subcategories->count() !== 0) {
            return ResultGenerate::Error('Ошибка! На категорию ссылаются подкатегории!');
        }
        if ($deleteCategory->delete()) {
            return ResultGenerate::Success('Категория успешно удалена!');
        }
        return ResultGenerate::Error('Ошибка удаления категории!');
    }

    public function CategoryPage(Request $request)
    {
        $category = Categories::where('semantic_url', $request->category_semantic_url)->firstOrFail();
        $subcategories = $category->Subcategories;
        return view('category.index', [
            'category' => $category,
            'subcategories' => $subcategories
        ]);
    }

}
