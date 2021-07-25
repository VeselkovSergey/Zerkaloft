<?php /** @noinspection ALL */


namespace App\Http\Controllers\Subcategories;


use App\Helpers\Files;
use App\Helpers\ResultGenerate;
use App\Helpers\StringHelper;
use App\Models\Categories;
use App\Models\Subcategories;
use Illuminate\Http\Request;

class SubcategoriesController
{

    public string $storagePath = 'img/subcategory';
    public string $storageDriver = 'local';

    public function SubcategoriesAdminPage()
    {
        $allSubcategories = Subcategories::all();
        return view('administration.subcategories.index', [
            'allSubcategories' => $allSubcategories
        ]);
    }

    public function CreateSubcategoryAdminPage()
    {
        $allCategories = Categories::all();
        return view('administration.subcategories.create', [
            'allCategories' => $allCategories
        ]);
    }

    public function EditSubcategoryAdminPage(Request $request)
    {
        $subcategory = Subcategories::findOrFail($request->subcategory_id);
        $category = $subcategory->Category;
        $allCategories = Categories::all();
        return view('administration.subcategories.edit', [
            'subcategory' => $subcategory,
            'category' => $category,
            'allCategories' => $allCategories
        ]);
    }

    public function SaveSubcategory(Request $request)
    {
        $subcategoryID = !empty($request->subcategory_id) ? $request->subcategory_id : null;
        $subcategoryName = !empty($request->subcategory_name) ? $request->subcategory_name : null;
        $subcategoryParent = !empty($request->subcategory_name) ? $request->subcategory_parent : null;
        $subcategoryFiles = !empty($request->allFiles()) ? $request->allFiles() : [];

        if (!$subcategoryFiles && !$subcategoryID) {
            return ResultGenerate::Error('Ошибка! Загрузите картинку!');
        }

        if (!$subcategoryName) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
        }

        if (!$subcategoryParent) {
            return ResultGenerate::Error('Ошибка! Выберите категорию!');
        }

        $semanticURL = StringHelper::TransliterateURL($subcategoryName);

        $uniqSemanticURL = Subcategories::where('semantic_url', $semanticURL);
        if ($subcategoryID) {
            $uniqSemanticURL->where('id', '!=', $subcategoryID);
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

        $fields['title'] = $subcategoryName;
        $fields['category_id'] = $subcategoryParent;
        $fields['semantic_url'] = $semanticURL;

        if (isset($request->subcategory_id)) {
            $subcategoryFind = Subcategories::find($subcategoryID);
            if ($subcategoryFind) {
                $fields['img'] = $request->allFiles() ? $serializeImgArray : $subcategoryFind->img;
                $subcategoryUpdate = $subcategoryFind->update($fields);
                if ($subcategoryUpdate) {
                    return ResultGenerate::Success('Подкатегория обновлена успешно!');
                }

                return ResultGenerate::Error('Ошибка обновления подкатегории!');
            }

        } else {
            $fields['img'] = $serializeImgArray;
            $subcategoryCreated = Subcategories::create($fields);
            if ($subcategoryCreated) {
                return ResultGenerate::Success('Подкатегория создана успешно!');
            }
            return ResultGenerate::Error('Ошибка создания подкатегории!');
        }

        return ResultGenerate::Error('Непредвиденная ошибка. Попробуйте позже или обратитесь в поддержку!');

    }

    public function DeleteSubcategory(Request $request)
    {
        $deleteSubcategory = Subcategories::find($request->subcategory_id);
        if ($deleteSubcategory->Products->count() !== 0) {
            return ResultGenerate::Error('Ошибка! На подкатегорию ссылаются продукты!');
        }
        if ($deleteSubcategory->delete()) {
            return ResultGenerate::Success('Подкатегория успешно удалена!');
        }
        return ResultGenerate::Error('Ошибка удаления подкатегории!');
    }
}
