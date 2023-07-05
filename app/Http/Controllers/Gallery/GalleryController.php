<?php

namespace App\Http\Controllers\Gallery;

use App\Helpers\ArrayHelper;
use App\Helpers\Files;
use App\Helpers\ResultGenerate;
use App\Models\Filters\Filters;
use App\Models\Gallery\FiltersGallery;
use App\Models\Gallery\Gallery;
use Illuminate\Http\Request;

class GalleryController
{
    public string $storagePath = 'img/category';
    public string $storageDriver = 'local';

    public function GalleryAdminPage()
    {
        return view('administration.gallery.index', [
            'allGallery' => Gallery::all(),
        ]);
    }

    public function CreateGalleryAdminPage()
    {
        return view('administration.gallery.createOrEdit', [
            'filters' => Filters::all(),
        ]);
    }

    public function EditGalleryAdminPage(Request $request)
    {
        $itemId = $request->id;
        $item = Gallery::query()->with('filters')->findOrFail($itemId);
        return view('administration.gallery.createOrEdit', [
            'item' => $item,
            'filters' => Filters::all(),
        ]);
    }

    public function SaveGallery(Request $request)
    {
        $itemId = !empty($request->gallery_id) ? $request->gallery_id : null;
        $itemDescription = !empty($request->gallery_description) ? $request->gallery_description : null;
        $itemTechProperties = !empty($request->gallery_tech_properties) ? $request->gallery_tech_properties : null;
        $itemFiles = !empty($request->allFiles()) ? $request->allFiles() : null;

        $productFilters = !empty($request->filter_id) ? $request->filter_id : null;
        $productFiltersActivation = !empty($request->filter_activation) ? $request->filter_activation : null;

        if (!$itemFiles && !$itemId) {
            return ResultGenerate::Error('Ошибка! Загрузите картинку!');
        }

        if (!$itemDescription) {
            return ResultGenerate::Error('Ошибка! Поле "Описание" не может быть пустым!');
        }

        if (!$itemTechProperties) {
            return ResultGenerate::Error('Ошибка! Поле "Технические характеристики" не может быть пустым!');
        }

        if ($itemFiles) {
            $saveFiles = [];
            foreach ($itemFiles as $file) {
                if (in_array($file->getMimeType(), ['image/jpg', 'image/jpeg', 'image/webp', 'image/png', 'image/bmp'])) {
                    $saveFile = Files::SaveFile($file, $this->storagePath, $this->storageDriver);
                    $saveFiles[] = $saveFile->id;
                } else {
                    return ResultGenerate::Error('Ошибка! Не верный формат файла!');
                }
            }

            $serializeImgArray = serialize($saveFiles);
        }

        $fields['description'] = $itemDescription;
        $fields['tech_properties'] = $itemTechProperties;

        if ($itemId) {
            $foundItem = Gallery::find($itemId);
            if ($foundItem) {
                $fields['img'] = $itemFiles ? $serializeImgArray : $foundItem->img;
                $updatedItem = $foundItem->update($fields);
                if ($updatedItem) {
                    FiltersGallery::where('gallery_id', $foundItem->id)->delete();
                    if ($productFilters) {
                        foreach ($productFilters as $key => $filter) {
                            if ($productFiltersActivation[$key] === 'true') {
                                $fieldsFilters['gallery_id'] = $foundItem->id;
                                $fieldsFilters['filter_id'] = $filter;
                                FiltersGallery::create($fieldsFilters);
                            }
                        }
                    }
                    return ResultGenerate::Success('Обновлено успешно!');
                }
                return ResultGenerate::Error('Ошибка обновления!');
            }
        } else {
            $fields['img'] = $serializeImgArray;
            $createdItem = Gallery::create($fields);
            if ($createdItem) {
                FiltersGallery::where('gallery_id', $createdItem->id)->delete();
                if ($productFilters) {
                    foreach ($productFilters as $key => $filter) {
                        if ($productFiltersActivation[$key] === 'true') {
                            $fieldsFilters['gallery_id'] = $createdItem->id;
                            $fieldsFilters['filter_id'] = $filter;
                            FiltersGallery::create($fieldsFilters);
                        }
                    }
                }
                return ResultGenerate::Success('Создано успешно!');
            }
            return ResultGenerate::Error('Ошибка создания!');
        }
        return ResultGenerate::Error('Непредвиденная ошибка. Попробуйте позже или обратитесь в поддержку!');

    }

    public function DeleteGallery()
    {
        $itemId = \request()->post('id');
        FiltersGallery::where('gallery_id', $itemId)->delete();
        Gallery::where('id', $itemId)->delete();
        return ResultGenerate::Success();

    }

    public function IndexGallery()
    {
        $filters = Filters::all();
        if (\request()->get('filters')) {
            $requestedArrayOfFilters = explode(',', \request()->get('filters'));
            $items = Gallery::query()->whereHas("filters", function ($q) use ($requestedArrayOfFilters, $filters) {
                foreach ($requestedArrayOfFilters as $filterId) {
                    $filterId = (int)$filterId;
                    if (ArrayHelper::findAndCheckPropertyInObject($filters, 'id', $filterId)) {
                        $q->where('filter_id', $filterId);
                    }
                }
            })->get();
        } else {
            $items = Gallery::all();
        }

        return view('new-design.gallery.index', compact('items', 'filters'));
    }

    public function ItemGallery(Request $request, $id)
    {
        $item = Gallery::findOrFail($id);
        return view('new-design.gallery.item', compact('item'));
    }
}
