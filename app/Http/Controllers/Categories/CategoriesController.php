<?php /** @noinspection UnknownColumnInspection */


namespace App\Http\Controllers\Categories;


use App\Helpers\Files;
use App\Helpers\ResultGenerate;
use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\PropertiesCategories\PropertiesCategories;
use App\Models\Relations\RelationsCategoriesAndPropertiesCategories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
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
        $allPropertiesCategories = PropertiesCategories::all();
        return view('administration.categories.create', [
            'allPropertiesCategories' => $allPropertiesCategories
        ]);
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

        abort(404);
        return '';
    }

    public function SaveCategory(Request $request)
    {
        $categoryID = !empty($request->category_id) ? $request->category_id : null;
        $categoryName = !empty($request->category_name) ? $request->category_name : null;
        $categoryAdditionalLinks = !empty($request->additional_links) ? $request->additional_links : null;
        $categorySearchWords = !empty($request->search_words) ? $request->search_words : null;
        $categorySequence = !empty($request->sequence) ? $request->sequence : null;
        $categoryFiles = !empty($request->allFiles()) ? $request->allFiles() : null;
        $usedProperties = !empty($request->usedProperties) ? $request->usedProperties : null;

        if (!$categoryFiles && !$categoryID) {
            return ResultGenerate::Error('Ошибка! Загрузите картинку!');
        }

        if (!$categoryName) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
        }

        if (!$categorySearchWords) {
            return ResultGenerate::Error('Ошибка! Заполните слова для поиска!');
        }

        if (!$categorySequence) {
            return ResultGenerate::Error('Ошибка! Заполните очередность!');
        }

        if (!$categoryID) {
            $usedPropertiesError = true;
            if (!$usedProperties) {
                return ResultGenerate::Error('Нужны свойства');
            }
            foreach ($usedProperties as $propertyId => $usedProperty) {
                if ($usedProperty === 'true') {
                    $usedPropertiesError = false;
                    break;
                }
            }
            if ($usedPropertiesError) {
                return ResultGenerate::Error('Ошибка! Выберите хотя бы одно свойство!');
            }
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

        if ($categoryFiles) {
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
        }

        $fields['title'] = $categoryName;
        $fields['semantic_url'] = $semanticURL;
        $fields['additional_links'] = $categoryAdditionalLinks;
        $fields['search_words'] = $categorySearchWords;
        $fields['sequence'] = $categorySequence;

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
                $fields = [];
                foreach ($usedProperties as $propertyId => $usedProperty) {
                    if ($usedProperty === 'true') {
                        $fields[] = [
                            'category_id' => $createdCategory->id,
                            'properties_categories_id' => $propertyId,
                        ];
                    }
                }
                RelationsCategoriesAndPropertiesCategories::insert($fields);
                return ResultGenerate::Success('Категория создана успешно!');
            }
            return ResultGenerate::Error('Ошибка создания категории!');
        }
        return ResultGenerate::Error('Непредвиденная ошибка. Попробуйте позже или обратитесь в поддержку!');
    }

    public function DeleteCategory(Request $request)
    {
        $deleteCategory = Categories::find($request->category_id);
        if ($deleteCategory->Products->count() !== 0) {
            return ResultGenerate::Error('Ошибка! На категорию ссылаются продукты!');
        }
        foreach ($deleteCategory->RelationsWithProperties as $relation) {
            $relation->delete();
        }
        if ($deleteCategory->delete()) {
            return ResultGenerate::Success('Категория успешно удалена!');
        }
        return ResultGenerate::Error('Ошибка удаления категории!');
    }

    public function CategoryPage(Request $request)
    {
        $category = Categories::where('semantic_url', $request->category_semantic_url)->firstOrFail();
        $products = $category->Products;
        $categoryAdditionalLinks = explode(';', $category->additional_links);
        return view('catalog.category', [
            'category' => $category,
            'products' => $products,
            'categoryAdditionalLinks' => $categoryAdditionalLinks
        ]);
    }

}
