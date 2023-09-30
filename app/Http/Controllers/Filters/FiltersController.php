<?php

namespace App\Http\Controllers\Filters;

use App\Helpers\Files;
use App\Helpers\ResultGenerate;
use App\Models\Filters\FiltersProducts;
use App\Models\Filters\Filters;
use App\Models\Gallery\FiltersGallery;
use Illuminate\Http\Request;

class FiltersController
{

    public string $storagePath = 'img/setting';
    public string $storageDriver = 'local';

    public function FiltersAdminPage()
    {
        return view('administration.filters.index', [
            'allFilters' => Filters::all()
        ]);
    }

    public function CreateFiltersAdminPage()
    {
        return view('administration.filters.createOrEdit');
    }

    public function EditFiltersAdminPage(Request $request)
    {
        $filterId = $request->id;
        $filter = Filters::query()->findOrFail($filterId);
        return view('administration.filters.createOrEdit', [
            'filter' => $filter
        ]);
    }

    public function SaveFilters(Request $request)
    {
        $filterId = !empty($request->filter_id) ? $request->filter_id : null;
        $filterTitle = !empty($request->filter_title) ? $request->filter_title : null;
        $filterGroup = !empty($request->filter_group) ? $request->filter_group : null;
        $images = !empty($request->allFiles()) ? $request->allFiles() : null;

        if (!$filterTitle) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
        }

        $fileIds = [];
        if (!empty($images)) {
            foreach ($images as $key => $image) {
                if (in_array($image->getMimeType(), ['image/svg+xml', 'image/jpg', 'image/jpeg', 'image/webp', 'image/png', 'image/bmp', 'image/gif'])) {
                    $saveFile = Files::SaveFile($image, $this->storagePath, $this->storageDriver);
                    $fileIds[] = $saveFile->id;
                } else {
                    return ResultGenerate::Error('Ошибка! Не верный формат файла!');
                }
            }
        }

        $fields['title'] = $filterTitle;
        $fields['group'] = $filterGroup;
        $fields['file_id'] = $fileIds[0] ?? null;

        if ($filterId) {
            $foundFilter = Filters::find($filterId);
            if ($foundFilter) {
                $fields['file_id'] = $fileIds[0] ?? $foundFilter->file_id;
                $updatedAdditionalService = $foundFilter->update($fields);
                if ($updatedAdditionalService) {
                    return ResultGenerate::Success('Обновлено успешно!');
                }
                return ResultGenerate::Error('Ошибка обновления!');
            }

        } else {
            $createdFilter = Filters::create($fields);
            if ($createdFilter) {
                return ResultGenerate::Success('Создано успешно!');
            }
            return ResultGenerate::Error('Ошибка создания!');
        }
        return ResultGenerate::Error('Непредвиденная ошибка. Попробуйте позже или обратитесь в поддержку!');

    }

    public function DeleteFilters()
    {
        $filterId = \request()->post('id');
        $used = FiltersProducts::where('filter_id', $filterId)->first();
        $used2 = FiltersGallery::where('filter_id', $filterId)->first();
        if (!$used && !$used2) {
            Filters::where('id', $filterId)->delete();
            return ResultGenerate::Success();
        }
        return ResultGenerate::Error('Используются! Сначала уберите связь!');

    }
}
