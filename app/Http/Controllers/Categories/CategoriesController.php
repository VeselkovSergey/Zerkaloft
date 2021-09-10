<?php /** @noinspection UnknownColumnInspection */


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
        $categoryID = !empty($request->category_id) ? $request->category_id : null;

        if ($categoryID) {
            $category = Categories::findOrFail($categoryID);
            return view('administration.categories.edit', [
                'category' => $category
            ]);
        }

        return abort(404);
    }

    public function SaveCategory(Request $request)
    {
        $categoryID = !empty($request->category_id) ? $request->category_id : null;
        $categoryName = !empty($request->category_name) ? $request->category_name : null;
        $categoryFiles = !empty($request->allFiles()) ? $request->allFiles() : [];

        if (!$categoryFiles && !$categoryID) {
            return ResultGenerate::Error('Ошибка! Загрузите картинку!');
        }

        if (!$categoryName) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
        }

        $semanticURL = StringHelper::TransliterateURL($categoryName);

        $uniqueSemanticURL = Categories::where('semantic_url', $semanticURL);
        if ($categoryID) {
            $uniqueSemanticURL->where('id', '!=', $categoryID);
        }
        $uniqueSemanticURL = $uniqueSemanticURL->first();

        if ($uniqueSemanticURL) {
            return ResultGenerate::Error('Ошибка! Название должно быть уникальным!');
        }

        $saveFiles = [];
        foreach ($categoryFiles as $file) {
            if (in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/bmp'])) {
                $saveFile = Files::SaveFile($file, $this->storagePath, $this->storageDriver);
                $saveFiles[] = $saveFile->id;
            } else {
                return ResultGenerate::Error('Ошибка! Не верный формат файла!');
            }
        }

        $serializeImgArray = serialize($saveFiles);

        $fields['title'] = $categoryName;
        $fields['semantic_url'] = $semanticURL;

        if ($categoryID) {
            $foundCategory = Categories::find($categoryID);
            if ($foundCategory) {
                $fields['img'] = $categoryFiles ? $serializeImgArray : $foundCategory->img;
                $updatedCategory = $foundCategory->update($fields);
                if ($updatedCategory) {
                    return ResultGenerate::Success('Категория обновлена успешно!');
                }
                return ResultGenerate::Error('Ошибка обновления категории!');
            }

        } else {
            $fields['img'] = $serializeImgArray;
            $createdCategory = Categories::create($fields);
            if ($createdCategory) {
                return ResultGenerate::Success('Категория создана успешно!');
            }
            return ResultGenerate::Error('Ошибка создания категории!');
        }
        return ResultGenerate::Error('Непредвиденная ошибка. Попробуйте позже или обратитесь в поддержку!');
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
        return view('catalog.category', [
            'category' => $category,
            'subcategories' => $subcategories
        ]);
    }

}
