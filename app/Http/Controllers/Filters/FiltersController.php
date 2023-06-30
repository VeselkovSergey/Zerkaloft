<?php

namespace App\Http\Controllers\Filters;

use App\Helpers\ResultGenerate;
use App\Models\Filters\FiltersProducts;
use App\Models\Filters\Filters;
use App\Models\Gallery\FiltersGallery;
use Illuminate\Http\Request;

class FiltersController
{
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

        if (!$filterTitle) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
        }

        $fields['title'] = $filterTitle;

        if ($filterId) {
            $foundAdditionalService = Filters::find($filterId);
            if ($foundAdditionalService) {
                $updatedAdditionalService = $foundAdditionalService->update($fields);
                if ($updatedAdditionalService) {
                    return ResultGenerate::Success('Обновлено успешно!');
                }
                return ResultGenerate::Error('Ошибка обновления!');
            }

        } else {
            $createdAdditionalService = Filters::create($fields);
            if ($createdAdditionalService) {
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
