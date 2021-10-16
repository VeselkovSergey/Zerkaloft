<?php /** @noinspection UnknownColumnInspection */


namespace App\Http\Controllers\PropertiesCategories;


use App\Helpers\ArrayHelper;
use App\Helpers\Files;
use App\Helpers\ResultGenerate;
use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\PropertiesCategories\PropertiesCategories;
use App\Models\PropertiesCategories\PropertiesCategoriesValues;
use App\Models\Subcategories;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class PropertiesCategoriesController extends Controller
{

    public string $storagePath = 'img/property-categories';
    public string $storageDriver = 'local';

    public function PropertiesCategoriesAdminPage()
    {
        $allPropertiesCategories = PropertiesCategories::all();
        return view('administration.properties-categories.index', [
            'allPropertiesCategories' => $allPropertiesCategories
        ]);
    }

    public function CreatePropertyCategoriesAdminPage()
    {
        return view('administration.properties-categories.create');
    }

    public function EditPropertyCategoriesAdminPage(Request $request)
    {
        $propertyCategoriesId = !empty($request->property_categories_id) ? $request->property_categories_id : null;

        if ($propertyCategoriesId) {
            $propertyCategories = PropertiesCategories::findOrFail($propertyCategoriesId);
            return view('administration.properties-categories.edit', [
                'propertyCategories' => $propertyCategories
            ]);
        }

        abort(404);
        return '';
    }

    public function SavePropertyCategories(Request $request)
    {
        $propertyCategoriesId = !empty($request->property_categories_id) ? $request->property_categories_id : null;
        $propertyCategoriesTitle = !empty($request->property_categories_title) ? $request->property_categories_title : null;
        $propertyCategoriesValues = !empty($request->property_categories_values[0]) ? $request->property_categories_values : null;

        if (!$propertyCategoriesValues && !$propertyCategoriesId) {
            return ResultGenerate::Error('Ошибка! Заполните хотя бы одно значение!');
        }

        if (!$propertyCategoriesTitle) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
        }

        $fields['title'] = $propertyCategoriesTitle;

        if ($propertyCategoriesId) {
            $foundPropertyCategories = PropertiesCategories::find($propertyCategoriesId);
            if ($foundPropertyCategories) {
                $updatedPropertyCategories = $foundPropertyCategories->update($fields);
                if ($updatedPropertyCategories) {
                    return ResultGenerate::Success('Свойство обновлено успешно!');
                }
                return ResultGenerate::Error('Ошибка обновления свойства!');
            }

        } else {
            $createdPropertyCategories = PropertiesCategories::create($fields);
            if ($createdPropertyCategories) {
                foreach ($propertyCategoriesValues as $propertyCategoriesValue) {
                    $createdPropertyCategoriesValues = PropertiesCategoriesValues::create([
                        'properties_categories_id' => $createdPropertyCategories->id,
                        'value' => $propertyCategoriesValue,
                    ]);
                }
                return ResultGenerate::Success('Свойство создано успешно!');
            }
            return ResultGenerate::Error('Ошибка создания свойства!');
        }
        return ResultGenerate::Error('Непредвиденная ошибка. Попробуйте позже или обратитесь в поддержку!');
    }

    public function DeletePropertyCategories(Request $request)
    {
        $deletePropertyCategory = PropertiesCategories::find($request->property_categories_id);
        if ($deletePropertyCategory->RelationCategories->count() !== 0) {
            return ResultGenerate::Error('Свойство используется в категориях!');
        }

        $valuesPropertyCategory = $deletePropertyCategory->Values;
        foreach ($valuesPropertyCategory as $valuePropertyCategory) {
            $valuePropertyCategory->delete();
        }
        $deletePropertyCategory->delete();

        return ResultGenerate::Success('Свойство успешно удалено!');
    }

}
