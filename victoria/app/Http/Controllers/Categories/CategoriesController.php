<?php


namespace App\Http\Controllers\Categories;


use App\Helpers\Files;
use App\Helpers\ResultGenerate;
use App\Models\Categories;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class CategoriesController
{

    public $storagePath = 'img/category';
    public $storageDriver = 'local';

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
        if (empty($request->allFiles())) {
            return ResultGenerate::Error('Ошибка! Загрузите картинку!');
        }

        if (strlen($request->category_name) === 0) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
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
                $fields['img'] = $serializeImgArray;
                $categoryUpdate = $categoryFind->update($fields);
                if ($categoryUpdate) {
                    return ResultGenerate::Success('Категория обновлена успешно!');
                }

                return ResultGenerate::Error('Ошибка обновления категории!');
            }

        } else {
            $fields['title'] = $request->category_name;
            $fields['img'] = $serializeImgArray;
            $category = Categories::create($fields);
            if ($category) {
                return ResultGenerate::Success('Категория создана успешно!');
            }
            return ResultGenerate::Error('Ошибка создания категории!');
        }


    }

    public function DeleteCategory(Request $request)
    {
        $deleteCategory = Categories::find($request->category_id);
        if ($deleteCategory->delete()) {
            return ResultGenerate::Success('Категория успешно удалена!');
        }
        return ResultGenerate::Error('Ошибка удаления категории!');
    }

}
