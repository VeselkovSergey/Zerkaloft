<?php


namespace App\Http\Controllers\Categories;


use App\Helpers\ResultGenerate;
use App\Models\Categories;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;

class CategoriesController
{
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
        if (strlen($request->category_name) > 0) {
            if (isset($request->category_id)) {
                $categoryFind = Categories::find($request->category_id);
                if ($categoryFind) {
                    $fields['title'] = $request->category_name;
                    $categoryFind->update([
                        'title' => $request->category_name
                    ]);
                    if ($categoryFind) {
                        return ResultGenerate::Success('Категория обновлена успешно!');
                    }

                    return ResultGenerate::Error('Ошибка обновления категории!');
                }

            } else {
                $fields['title'] = $request->category_name;
                $category = Categories::create($fields);
                if ($category) {
                    return ResultGenerate::Success('Категория создана успешно!');
                }
                return ResultGenerate::Error('Ошибка создания категории!');
            }

        }

        return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
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
