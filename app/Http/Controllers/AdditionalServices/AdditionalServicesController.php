<?php

namespace App\Http\Controllers\AdditionalServices;

use App\Helpers\ResultGenerate;
use App\Models\AdditionalServices\AdditionalProductServices;
use App\Models\AdditionalServices\AdditionalServices;
use Illuminate\Http\Request;

class AdditionalServicesController
{
    public function AdditionalServicesAdminPage()
    {
        return view('administration.additional-services.index', [
            'allAdditionalServices' => AdditionalServices::all()
        ]);
    }

    public function CreateAdditionalServiceAdminPage()
    {
        return view('administration.additional-services.createOrEdit');
    }

    public function EditAdditionalServiceAdminPage(Request $request)
    {
        $additionalServiceId = $request->additional_service_id;
        $additionalService = AdditionalServices::query()->findOrFail($additionalServiceId);
        return view('administration.additional-services.createOrEdit', [
            'additionalService' => $additionalService
        ]);
    }

    public function SaveAdditionalService(Request $request)
    {
        $additionalServiceId = !empty($request->additional_service_id) ? $request->additional_service_id : null;
        $additionalServiceTitle = !empty($request->additional_service_title) ? $request->additional_service_title : null;
        $additionalServiceGroup = !empty($request->additional_service_group) ? $request->additional_service_group : null;

        if (!$additionalServiceTitle) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
        }

        $fields['title'] = $additionalServiceTitle;
        $fields['group'] = $additionalServiceGroup;

        if ($additionalServiceId) {
            $foundAdditionalService = AdditionalServices::find($additionalServiceId);
            if ($foundAdditionalService) {
                $updatedAdditionalService = $foundAdditionalService->update($fields);
                if ($updatedAdditionalService) {
                    return ResultGenerate::Success('Обновлено успешно!');
                }
                return ResultGenerate::Error('Ошибка обновления!');
            }

        } else {
            $createdAdditionalService = AdditionalServices::create($fields);
            if ($createdAdditionalService) {
                return ResultGenerate::Success('Создано успешно!');
            }
            return ResultGenerate::Error('Ошибка создания!');
        }
        return ResultGenerate::Error('Непредвиденная ошибка. Попробуйте позже или обратитесь в поддержку!');

    }

    public function DeleteAdditionalServices()
    {
        $additionalServiceId = \request()->post('id');
        $used = AdditionalProductServices::where('additional_service_id', $additionalServiceId)->first();
        if (!$used) {
            AdditionalServices::where('id', $additionalServiceId)->delete();
            return ResultGenerate::Success();
        }
        return ResultGenerate::Error('Услуги используются! Сначала уберите связь!');

    }
}
